<?php

namespace App\Http\Livewire\OrdenCompra;

use App\DTOs\DetalleOrdenCompraDTO;
use App\Facades\OrdenCompra;
use App\Models\Iva;
use App\Models\Proveedor;
use App\Models\TipoPago;
use App\Services\OrdenCompra\CrearOrdenCompra;
use App\Services\OrdenCompra\OrdenCompraService;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Crear extends Component
{

    // Datos del proveedor
    public $proveedor_id = "";
    public $proveedor;
    public $rut;
    public $giro;
    public $direccion;
    public $telefono;
    public $contacto;


    // Datos de la orden de compra
    public $cotizacion;
    public $fecha;
    public $centro_costo;
    public $proyecto;
    public $observaciones;
    public $subtotal = 0;
    public $total_neto = 0;
    public $descuento = 0; // en porcentaje
    public $descuento_en_cantidad = 0;
    public $iva_id = 1; // default 0%
    public $iva_en_cantidad = 0;
    public $total = 0;

    // Datos para los items de la orden de compra
    public $items = [];
    public $descripcion;
    public $cantidad;
    public $valor_unitario;
    public $unidad;

    // Datos para los pagos
    public $pagos = [];
    public $monto_pago;
    public $fecha_pago;
    public $tipo_pago_id;

    protected $listeners = ['editar', 'agregar', 'eliminar', 'storeUpdate'];


    public function render()
    {

        $this->fecha = Date('Y-m-d');

        $proveedores = Proveedor::get();
        $this->actualizarDatosProveedor();

        $tipos_de_pago = TipoPago::get();

        $ivas = Iva::get();

        return view(
            'livewire.orden-compra.crear',
            compact('proveedores', 'tipos_de_pago', 'ivas')
        );
    }

    /**
     * Se genera la orden y se guarda en BD
     * 
     * @return void
     */
    public function generarOrden()
    {

        //$this->validarProveedorYCotizacion();
        //$this->validarCentroCostoYProtecto();
        /*
        if (!$this->hayItemsEnLaOrden()) {
            session()->flash('error', 'No hay items en la orden de compra.');
            return 0;
        }

        if (!$this->estanLosPagosDistribuidosCorrectamente()) {
            session()->flash('error', 'Los pagos no esta distribuidos correctamente.');
            return 0;
        }
        */

        $this->crearOrden();

        $this->emit('actualizar_tabla');
        $this->emit('sweetAlert', 'Orden de compra creada', '', 'success');
    }

    private function crearOrden()
    {

        sleep(4);

        return 0;

        $num_pagos = count($this->pagos);
        $user_id = auth()->user()->id;

        $crearOrden = new CrearOrdenCompra(
            $num_pagos,
            0,
            $this->centro_costo,
            $this->cotizacion,
            $this->proyecto,
            $this->total,
            $this->total_neto,
            $this->subtotal,
            $this->descuento,
            $this->iva_id,
            $this->proveedor_id,
            $user_id,
            $this->observaciones
        );

        DB::transaction(function () use ($crearOrden) {

            $orden = $crearOrden->crear();

            foreach ($this->items as $item) {

                $detalleDTO = new DetalleOrdenCompraDTO(
                    $item['descripcion'],
                    $item['unidad'],
                    $item['cantidad'],
                    $item['valor_unitario'],
                    $orden->id
                );

                $crearOrden->crearDetalle($detalleDTO);
            }
        });
    }

    /**
     * Cuando se presiona el boton de la vista "Nueva orden de compra"
     * 
     * @return void
     */
    public function agregar()
    {

        // Limpiamos los errores de validacion en caso existan
        $this->resetErrorBag();
        $this->resetValidation();

        $this->emit('abrirModal');
    }

    public function actualizarDatosProveedor()
    {
        $proveedor = Proveedor::find($this->proveedor_id);

        // Si el proveedor existe
        if ($proveedor) {

            $this->proveedor_id  = $proveedor->id;
            $this->proveedor = $proveedor->proveedor;
            $this->direccion = $proveedor->direccion;
            $this->telefono  = $proveedor->telefono;
            $this->contacto  = $proveedor->contacto;
            $this->giro      = $proveedor->giro;
            $this->rut       = $proveedor->rut;
        }
    }

    public function agregarItem()
    {

        $this->validarItem();

        // Agregamos el item
        $this->items[] = [
            'descripcion'    => $this->descripcion,
            'cantidad'       => $this->cantidad,
            'valor_unitario' => $this->valor_unitario,
            'unidad'         => $this->unidad,
            'valor_total'    => $this->cantidad * $this->valor_unitario
        ];

        $this->limpiarDatosItem();

        // Calculamos nuevamente el subtotal
        $this->subtotal = array_sum(array_column($this->items, 'valor_total'));

        $this->aplicarDescuento();

        $this->siguienteInputFocus("#descripcion");
    }

    /**
     * Elimina un item de la lista de items
     * 
     * @param key del item
     */
    public function eliminarItem($key)
    {
        unset($this->items[$key]);

        // Calculamos nuevamente el subtotal
        $this->subtotal = array_sum(array_column($this->items, 'valor_total'));
        $this->aplicarDescuento();
    }

    public function validarItem()
    {

        $this->validate([
            'descripcion'    => 'required',
            'cantidad'    => 'required|numeric',
            'valor_unitario'  => 'required|numeric',
            'unidad'  => 'required'
        ]);
    }

    public function siguienteInputFocus($inputId)
    {
        $this->emit('siguienteInputFocus', $inputId);
    }

    public function limpiarDatosItem()
    {
        $this->descripcion    = "";
        $this->cantidad       = "";
        $this->valor_unitario = "";
        $this->unidad         = "";
    }

    public function aplicarDescuento()
    {

        if ((is_numeric($this->descuento) && $this->esRangoEntreCeroYCien($this->descuento))) {


            // Calculamos el descuento en cantidad
            $this->descuento_en_cantidad = ($this->subtotal * $this->descuento) / 100;
            // Recalculamos el total neto y le descontamos el descuento
            $this->total_neto = $this->subtotal - $this->descuento_en_cantidad;

            // Ahora simplemente aplicar iva al total neto
            $this->aplicarIva();
        }
    }

    public function esRangoEntreCeroYCien($value)
    {
        return $value >= 0 && $value <= 100;
    }

    /**
     * Cuando se termina de modificar la variables $descuento
     */
    public function updatedDescuento()
    {
        if (!(is_numeric($this->descuento) && $this->esRangoEntreCeroYCien($this->descuento))) {
            $this->descuento = 0;
        }

        $this->aplicarDescuento();
    }


    public function aplicarIva()
    {
        if ((is_numeric($this->iva_id))) {

            $iva = Iva::find($this->iva_id);

            // Si iva existe
            if ($iva) {

                // Calculamos el iva a pagar por el total neto
                $this->iva_en_cantidad = ($this->total_neto * $iva->porcentaje) / 100;

                // Calculamos el total de la orden de compra
                $this->actualizarTotal();
            }
        }
    }

    public function actualizarTotal()
    {
        $this->total = $this->total_neto + $this->iva_en_cantidad;
    }

    public function agregarPago()
    {

        // Validamos los campos para agregar un pago
        $this->validarPago();

        if ($this->sumaPagosSobrePasaTotalOrdenCompra()) {
            session()->flash('error', 'La suma de todos los pagos sobrepasa el total de la orden de compra.');
            return 0;
        }

        $pago = TipoPago::find($this->tipo_pago_id);

        // Si el tipo de pago existe
        if ($pago) {

            $this->pagos[] = [
                'monto'        => $this->monto_pago,
                'fecha'        => $this->fecha_pago,
                'tipo_pago_id' => $this->tipo_pago_id,
                'descripcion'  => $pago->descripcion
            ];
        }
    }

    public function eliminarPago($key)
    {
        unset($this->pagos[$key]);
    }

    public function validarPago()
    {
        $this->validate([
            'monto_pago' => 'required|numeric|gte:1',
            'fecha_pago' => 'required|date',
            'tipo_pago_id' => 'required'
        ], [], [
            'monto_pago'   => 'monto',
            'fecha_pago'   => 'fecha',
            'tipo_pago_id' => 'forma de pago'
        ]);
    }

    /**
     * Verifica si la suma de todos los pagos mas el que se quiere agregar
     * sobrepasa el total de la orden de compra
     * 
     * @return bool
     */
    public function sumaPagosSobrePasaTotalOrdenCompra()
    {

        // Obtenemos el total que sumas los montos de todos los pagos hasta el momento
        $monto_total_pago = array_sum(array_column($this->pagos, 'monto'));

        // Si la suma de los montos de todos los pagos mas el nuevo pago es mayor al total de la orden de compra
        if (($monto_total_pago + $this->monto_pago) > $this->total) {
            return true;
        }

        return false;
    }

    public function validarProveedorYCotizacion()
    {
        // Validamos los datos del proveedor y cotizacion
        $this->validate([
            'proveedor_id' => 'required|numeric',
            'cotizacion'   => 'required'
        ], [], ['proveedor_id' => 'proveedor', 'cotizacion' => 'cotización']);
    }

    public function validarCentroCostoYProtecto()
    {
        // Validamos los datos de la orden de compra
        $this->validate([
            'centro_costo' => 'required',
            'proyecto'     => 'required'
        ], [], ['centro_costo' => 'centro de costo']);
    }

    /**
     * @return bool
     */
    public function hayItemsEnLaOrden()
    {
        return count($this->items) == 0 ? false : true;
    }

    /**
     * @return bool
     */
    public function estanLosPagosDistribuidosCorrectamente()
    {
        return ($this->total - array_sum(array_column($this->pagos, 'monto'))) != 0 ? false : true;
    }
}
