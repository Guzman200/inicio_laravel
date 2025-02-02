<?php

namespace App\Http\Livewire\OrdenCompra;

use App\Models\DetalleOrdenCompra;
use App\Models\Iva;
use App\Models\OrdenCompra;
use App\Models\Pago;
use App\Models\Proveedor;
use App\Models\TipoPago;
use App\Services\OrdenCompra\CrearOrdenCompra;
use App\Services\OrdenCompra\EditarOrdenCompra;
use App\Services\Pago\CrearPago;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Crear extends Component
{

    //
    public $tipoOperacion; // 1 es crear, 2 es editar
    public $orden_id = null;

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

        $this->validarProveedorYCotizacion();
        $this->validarCentroCostoYProyecto();

        if (!$this->hayItemsEnLaOrden()) {
            session()->flash('error', 'No hay items en la orden de compra.');
            return 0;
        }

        if (!$this->estanLosPagosDistribuidosCorrectamente()) {
            session()->flash('error', 'Los pagos no esta distribuidos correctamente.');
            return 0;
        }

        $this->crearOrden();
        $this->limpiarDatos();

        $this->emit('actualizar_tabla');
        $this->emit('sweetAlert', 'Orden de compra creada', '', 'success');
    }

    private function crearOrden()
    {

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

            // Creamos la orden de compra
            $orden = $crearOrden->crear();

            // Guardamos el detalle de la orden
            foreach ($this->items as $item) {

                $crearOrden->crearDetalle(
                    $item['descripcion'],
                    $item['unidad'],
                    $item['cantidad'],
                    $item['valor_unitario']
                );
            }

            // Guardamos los pagos de la orden
            foreach ($this->pagos as $item) {

                $pago = new CrearPago(
                    $item['fecha'],
                    $item['monto'],
                    $orden->id,
                    $item['tipo_pago_id']
                );

                $pago->crear();
            }
        });
    }

    public function eliminar($id)
    {
        $orden = OrdenCompra::find($id);
        // Si existe la orden
        if ($orden) {

            // Obtenemos todas las facturas adjuntas de la orden
            foreach ($orden->facturas as $factura) {
                // Eliminamos los PDF
                unlink($factura->direccion_factura);
            }

            $orden->delete();
            $this->emit('actualizar_tabla');
            $this->emit('sweetAlert', 'Orden de compra eliminada', '', 'success');
        }
    }

    /**
     * Cuando se presiona el boton de la vista "Nueva orden de compra"
     * 
     * @return void
     */
    public function agregar()
    {

        $this->limpiarDatos();

        $this->tipoOperacion = 1; // agregar

        // Limpiamos los errores de validacion en caso existan
        $this->resetErrorBag();
        $this->resetValidation();

        $this->emit('abrirModal');
    }

    /**
     * Cuando se presiona el boton de la vista "Editar"
     * 
     * @return void
     */
    public function editar($id)
    {
        $this->tipoOperacion = 2; // editar

        $orden = OrdenCompra::find($id);

        if ($orden) {

            $this->orden_id = $orden->id;

            // Mapeamos los datos del proveedor
            $this->proveedor_id = $orden->proveedor->id;
            $this->proveedor    = $orden->proveedor->proveedor;
            $this->rut          = $orden->proveedor->rut;
            $this->giro         = $orden->proveedor->giro;
            $this->direccion    = $orden->proveedor->direccion;
            $this->telefono     = $orden->proveedor->telefono;
            $this->contacto     = $orden->proveedor->contacto;

            // Mapeamos los datos de la orden de compra
            $this->cotizacion            = $orden->cotizacion;
            $this->fecha                 = $orden->fecha;
            $this->centro_costo          = $orden->centro_costo;
            $this->proyecto              = $orden->proyecto;
            $this->observaciones         = $orden->observaciones;
            $this->subtotal              = $orden->subtotal;  
            $this->total_neto            = $orden->total_neto;
            $this->descuento             = $orden->descuento; // en porcentaje
            $this->descuento_en_cantidad = ($orden->subtotal * $orden->descuento) / 100;
            $this->iva_id                = $orden->iva_id;
            $this->iva_en_cantidad       = ($orden->total_neto * $orden->iva->porcentaje) / 100;
            $this->total                 = $orden->total;

            $this->items = [];

            // Mapeamos los items de la orden de compra
            foreach ($orden->detalleOrdenCompra as $item){

                // Agregamos el item
                $this->items[] = [
                    'id'             => $item->id,
                    'descripcion'    => $item->descripcion,
                    'cantidad'       => $item->cantidad,
                    'valor_unitario' => $item->valor_unitario,
                    'unidad'         => $item->unidad,
                    'valor_total'    => $item->cantidad * $item->valor_unitario
                ];

            }

            $this->pagos = [];

            // Mapeamos los pagos
            foreach($orden->pagos as $pago)
            {
                $this->pagos[] = [
                    'id'           => $pago->id,
                    'monto'        => $pago->cantidad,
                    'fecha'        => $pago->fecha->format('Y-m-d'),
                    'tipo_pago_id' => $pago->tipos_de_pago_id,
                    'descripcion'  => $pago->tipoDePago->descripcion
                ];
            }
           

            // Limpiamos los errores de validacion en caso existan
            $this->resetErrorBag();
            $this->resetValidation();

            $this->emit('abrirModal');
        }
    }

    /**
     * Cuando el usuario presiona editar orden de compra (ya para guardar los cambios)
     */
    public function editarOrden()
    {

        $this->validarProveedorYCotizacion();
        $this->validarCentroCostoYProyecto();

        if (!$this->hayItemsEnLaOrden()) {
            session()->flash('error', 'No hay items en la orden de compra.');
            return 0;
        }

        if (!$this->estanLosPagosDistribuidosCorrectamente()) {
            session()->flash('error', 'Los pagos no esta distribuidos correctamente.');
            return 0;
        }

        $this->editarOrdenCasoUso();

        $this->emit('actualizar_tabla');
        $this->emit('sweetAlert', 'Orden de compra actualizada', '', 'success');

    }

    private function editarOrdenCasoUso()
    {
        $num_pagos = count($this->pagos);
        $user_id = auth()->user()->id;

        $editarOrden = new EditarOrdenCompra(
            $this->orden_id,
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

        DB::transaction(function () use ($editarOrden) {

            // Editamos la orden de compra
            $orden = $editarOrden->editar();

            // Eliminamos todos los detalles
            DetalleOrdenCompra::where('ordenes_de_compra_id',$orden->id)->delete();

            // Creamos los nuevos detalles
            foreach ($this->items as $item) {

                $editarOrden->crearDetalle(
                    $item['descripcion'],
                    $item['unidad'],
                    $item['cantidad'],
                    $item['valor_unitario'],
                );
            }
           
            // Eliminamos todos los pagos
            Pago::where('ordenes_de_compra_id',$orden->id)->delete();
           
            // Creamos los nuevos pagos
            foreach ($this->pagos as $item) {
                $pago = new CrearPago(
                    $item['fecha'],
                    $item['monto'],
                    $orden->id,
                    $item['tipo_pago_id'],
                );

                $pago->crear();
            }
        });
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

    public function validarCentroCostoYProyecto()
    {
        // Validamos los datos de la orden de compra
        $this->validate([
            'centro_costo' => 'required',
            'proyecto'     => 'required'
        ], [], ['centro_costo' => 'centro de costo']);
    }

    public function limpiarDatos()
    {


         //
        $this->tipoOperacion = null; // 1 es crear, 2 es editar
        $this->orden_id      = null;

        // Datos del proveedor
        $this->proveedor_id = "";
        $this->proveedor    = null;
        $this->rut          = null;
        $this->giro         = null;
        $this->direccion    = null;
        $this->telefono     = null;
        $this->contacto     = null;


        // Datos de la orden de compra
        $this->cotizacion            = null;
        $this->fecha                 = null;
        $this->centro_costo          = null;
        $this->proyecto              = null;
        $this->observaciones         = null;
        $this->subtotal              = 0;
        $this->total_neto            = 0;
        $this->descuento             = 0; // en porcentaje
        $this->descuento_en_cantidad = 0;
        $this->iva_id                = 1; // default 0%
        $this->iva_en_cantidad       = 0;
        $this->total                 = 0;

        // Datos para los items de la orden de compra
        $this->items          = [];
        $this->descripcion    = null;
        $this->cantidad       = null;
        $this->valor_unitario = null;
        $this->unidad         = null;

        // Datos para los pagos
        $this->pagos = [];
        $this->monto_pago   = null;
        $this->fecha_pago   = null;
        $this->tipo_pago_id = null;

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
