<?php

namespace App\Http\Livewire\OrdenCompra;

use App\Facades\OrdenCompra;
use App\Models\Proveedor;
use App\Models\TipoPago;
use App\Services\OrdenCompra\OrdenCompraService;
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
    public $iva = 0; // en porcentaje
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

        return view('livewire.orden-compra.crear', compact('proveedores','tipos_de_pago'));
    }

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

    public function updatedIva()
    {

        if (!(is_numeric($this->iva) && $this->esRangoEntreCeroYCien($this->iva))) {
            $this->iva = 0;
        }

        $this->aplicarIva();
    }

    public function aplicarIva()
    {
        if ((is_numeric($this->iva) && $this->esRangoEntreCeroYCien($this->iva))) {

            // Calculamos el iva a pagar por el total neto
            $this->iva_en_cantidad = ($this->total_neto * $this->iva) / 100;

            // Calculamos el total de la orden de compra
            $this->actualizarTotal();
        }
    }

    public function actualizarTotal()
    {
        $this->total = $this->total_neto + $this->iva_en_cantidad;
    }

    public function agregarPago(){

        // Validamos los campos para agregar un pago
        $this->validarPago();


    }

    public function validarPago()
    {
        $this->validate([
            'monto_pago' => 'required|numeric',
            'fecha_pago' => 'required|date',
            'tipo_pago_id' => 'required'
        ],[],[
            'monto_pago'   => 'monto',
            'fecha_pago'   => 'fecha',
            'tipo_pago_id' => 'forma de pago'
        ]);
    }
}
