<div>

    <!-- MODAL ORDEND DE COMRPA -->
    <div wire:ignore.self class="modal fade" id="modalOrdenesDeCompra" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">
                        {{ $tipoOperacion == 1 ? 'Crear orden de compra' : 'Editar orden de compra'}}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">


                    <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">

                        <!-- PROVEEDORES -->
                        <li class="nav-item" role="presentation">
                            <a wire:ignore.self class="nav-link active" id="pills-home-tab" data-toggle="pill"
                                href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
                                @if ($errors->has('proveedor_id') || $errors->has('cotizacion'))
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </button>
                                @endif
                                Proveedor
                            </a>
                        </li>

                        <!-- DATOS DE LA ORDEN DE COMPRA -->
                        <li class="nav-item" role="presentation">
                            <a wire:ignore.self class="nav-link" id="pills-profile-tab" data-toggle="pill"
                                href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">
                                @if ($errors->has('centro_costo') || $errors->has('proyecto'))
                                    <button class="btn btn-danger btn-sm">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </button>
                                @endif
                                Datos orden de compra
                            </a>
                        </li>

                        <!-- ITEMS DE LA ORDEN DE COMPRA -->
                        <li class="nav-item" role="presentation">
                            <a wire:ignore.self class="nav-link" id="pills-contact-tab" data-toggle="pill"
                                href="#pills-contact" role="tab" aria-controls="pills-contact"
                                aria-selected="false">Items</a>
                        </li>

                        <!-- PAPGOS DE LA ORDEN DE COMPRA -->
                        <li class="nav-item" role="presentation">
                            <a wire:ignore.self class="nav-link" id="pills-pagos-tab" data-toggle="pill"
                                href="#pills-pagos" role="tab" aria-controls="pills-contact"
                                aria-selected="false">Pagos</a>
                        </li>

                    </ul>
                    <div class="tab-content" id="pills-tabContent">

                        <!-- PROVEEDORES -->
                        <div wire:ignore.self class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">

                            <div class="row justify-content-md-center">
                                {{-- DATOS DEL PROVEEDOR --}}
                                <div class="col-12 col-md-6">

                                    <div class="card">
                                        <div class="card-header">
                                            Proveedor
                                        </div>
                                        <div class="card-body">

                                            {{-- SELECT PROVEEDOR --}}
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label class="has-float-label">
                                                        <select wire:model="proveedor_id"
                                                            class="form-control hide-placeholder @error('proveedor_id') is-invalid @enderror custom-select"
                                                            placeholder="Proveedor">
                                                            <option value="" selected>Selecciona un proveedor
                                                            </option>
                                                            @foreach ($proveedores as $item)
                                                                <option value="{{ $item->id }}">
                                                                    {{ $item->proveedor }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        <span>Proveedor {{ $proveedor_id }}</span>
                                                    </label>
                                                    @error('proveedor_id')
                                                        <div class="invalid-feedback text-right d-block">
                                                            {{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>


                                            {{-- RUT --}}
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label class="has-float-label">
                                                        <input wire:model.defer="rut" name="rut" type="text"
                                                            class="form-control hide-placeholder @error('rut') is-invalid @enderror"
                                                            placeholder="Rut" disabled>
                                                        <span>Rut</span>
                                                    </label>
                                                    @error('rut')
                                                        <div class="invalid-feedback text-right d-block">
                                                            {{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            {{-- GIRO --}}
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label class="has-float-label">
                                                        <input wire:model.defer="direccion" name="direccion" type="text"
                                                            class="form-control hide-placeholder @error('direccion') is-invalid @enderror"
                                                            placeholder="Dirección" disabled>
                                                        <span>Giro</span>
                                                    </label>
                                                    @error('direccion')
                                                        <div class="invalid-feedback text-right d-block">
                                                            {{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row">
                                                {{-- TELÉFONO --}}
                                                <div class="col-12 col-sm-12 col-md-6">


                                                    <div class="form-group ">

                                                        <label class="has-float-label">
                                                            <input wire:model.defer="telefono" name="telefono"
                                                                type="text"
                                                                class="form-control hide-placeholder @error('telefono') is-invalid @enderror"
                                                                placeholder="Teléfono" disabled>
                                                            <span>Teléfono</span>
                                                        </label>
                                                        @error('telefono')
                                                            <div class="invalid-feedback text-right d-block">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror

                                                    </div>

                                                </div>
                                                {{-- CONTACTO --}}
                                                <div class="col-12 col-sm-12 col-md-6">


                                                    <div class="form-group">
                                                        <label class="has-float-label">
                                                            <input wire:model.defer="contacto" name="contacto"
                                                                type="text"
                                                                class="form-control hide-placeholder @error('contacto') is-invalid @enderror"
                                                                placeholder="contacto" disabled>
                                                            <span>Contacto</span>
                                                        </label>
                                                        @error('contacto')
                                                            <div class="invalid-feedback text-right d-block">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>

                                                </div>
                                            </div>

                                            {{-- COTIZACIÓN --}}
                                            <div class="form-group row">
                                                <div class="col-sm-12">
                                                    <label class="has-float-label">
                                                        <input wire:model.defer="cotizacion" name="cotizacion"
                                                            type="text"
                                                            class="form-control hide-placeholder @error('cotizacion') is-invalid @enderror"
                                                            placeholder="cotizacion">
                                                        <span>Cotización</span>
                                                    </label>
                                                    @error('cotizacion')
                                                        <div class="invalid-feedback text-right d-block">
                                                            {{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>

                        <!-- DATOS DE LA ORDEN DE COMPRA -->
                        <div wire:ignore.self class="tab-pane fade" id="pills-profile" role="tabpanel"
                            aria-labelledby="pills-profile-tab">

                            <div class="row justify-content-md-center">

                                <div class="col-12 col-md-9">
                                    <div class="card">
                                        <div class="card-header">
                                            Orden de compra
                                        </div>
                                        <div class="card-body">


                                            <div class="row">

                                                <div class="col-12 col-md-4">

                                                    {{-- FECHA --}}
                                                    <div class="form-group">

                                                        <label class="has-float-label">
                                                            <input wire:model.defer="fecha" name="fecha" type="date"
                                                                class="form-control hide-placeholder @error('fecha') is-invalid @enderror"
                                                                placeholder="Fecha" disabled>
                                                            <span>Fecha</span>
                                                        </label>
                                                        @error('fecha')
                                                            <div class="invalid-feedback text-right d-block">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror

                                                    </div>

                                                </div>

                                                <div class="col-12 col-md-4">

                                                    {{-- CENTRO DE COSTO --}}
                                                    <div class="form-group">

                                                        <label class="has-float-label">
                                                            <input wire:model.defer="centro_costo" name="centro_costo"
                                                                type="text"
                                                                class="form-control hide-placeholder @error('centro_costo') is-invalid @enderror"
                                                                placeholder="centro_costo">
                                                            <span>Centro de costo</span>
                                                        </label>
                                                        @error('centro_costo')
                                                            <div class="invalid-feedback text-right d-block">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror

                                                    </div>

                                                </div>

                                                <div class="col-12 col-md-4">

                                                    {{-- PROYECTO --}}
                                                    <div class="form-group">

                                                        <label class="has-float-label">
                                                            <input wire:model.defer="proyecto" name="proyecto"
                                                                type="text"
                                                                class="form-control hide-placeholder @error('proyecto') is-invalid @enderror"
                                                                placeholder="proyecto">
                                                            <span>Proyecto</span>
                                                        </label>
                                                        @error('proyecto')
                                                            <div class="invalid-feedback text-right d-block">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror

                                                    </div>

                                                </div>

                                            </div>

                                            <div class="row">
                                                <div class="col-12">

                                                    {{-- OBSERVACIONES --}}
                                                    <div class="form-group">

                                                        <label class="has-float-label">
                                                            <textarea wire:model.defer="observaciones"
                                                                name="observaciones" type="text"
                                                                class="form-control hide-placeholder @error('observaciones') is-invalid @enderror"
                                                                placeholder="observaciones" cols="30"
                                                                rows="5"></textarea>
                                                            <span>Observaciones</span>
                                                        </label>
                                                        @error('observaciones')
                                                            <div class="invalid-feedback text-right d-block">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror

                                                    </div>

                                                </div>
                                            </div>



                                        </div>
                                    </div>
                                </div>


                            </div>

                        </div>

                        <!-- ITEMS DE LA ORDEN DE COMPRA -->
                        <div wire:ignore.self class="tab-pane fade" id="pills-contact" role="tabpanel"
                            aria-labelledby="pills-contact-tab">

                            {{-- FORMULARIO PARA AGREGAR UN ITEM A LA ORDEN DE COMPRA --}}
                            <form wire:submit.prevent>

                                <div class="row">
                                    {{-- DESCRIPCION --}}
                                    <div class="col-12 col-lg-3">
                                        <label class="has-float-label">
                                            <input type="text" id="descripcion" wire:model.defer="descripcion"
                                                wire:keydown.enter.prevent="siguienteInputFocus('#cantidad')"
                                                class="form-control hide-placeholder @error('descripcion') is-invalid @enderror"
                                                placeholder="descripcion">
                                            <span>Descripción</span>
                                        </label>
                                        @error('descripcion')
                                            <div class="invalid-feedback text-right d-block">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- CANTIDAD --}}
                                    <div class="col-12 col-lg-2">
                                        <label class="has-float-label">
                                            <input type="number" id="cantidad"
                                                wire:keydown.enter.prevent="siguienteInputFocus('#valor_unitario')"
                                                wire:model.defer="cantidad"
                                                class="form-control hide-placeholder @error('cantidad') is-invalid @enderror"
                                                placeholder="cantidad">
                                            <span>Cantidad</span>
                                        </label>
                                        @error('cantidad')
                                            <div class="invalid-feedback text-right d-block">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- VALOR UNITARIO --}}
                                    <div class="col-12 col-lg-3">
                                        <label class="has-float-label">
                                            <input type="number" id="valor_unitario"
                                                wire:keydown.enter.prevent="siguienteInputFocus('#unidad')"
                                                wire:model.defer="valor_unitario"
                                                class="form-control hide-placeholder @error('valor_unitario') is-invalid @enderror"
                                                placeholder="valor_unitario">
                                            <span>Valor unitario</span>
                                        </label>
                                        @error('valor_unitario')
                                            <div class="invalid-feedback text-right d-block">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- UNIDAD DE MEDIDA --}}
                                    <div class="col-12 col-lg-2">
                                        <label class="has-float-label">
                                            <input type="text" id="unidad" wire:keydown.enter.prevent="agregarItem"
                                                wire:model.defer="unidad"
                                                class="form-control hide-placeholder @error('unidad') is-invalid @enderror"
                                                placeholder="valor_unitario">
                                            <span>Unidad</span>
                                        </label>
                                        @error('unidad')
                                            <div class="invalid-feedback text-right d-block">
                                                {{ $message }}</div>
                                        @enderror
                                    </div>

                                    {{-- AGREGAR ITEM --}}
                                    <div class="col-12 col-lg-2">
                                        <button wire:click.prevent="agregarItem"
                                            class="btn btn-success btn-sm btn-block">Agregar</button>
                                    </div>
                                </div>

                            </form>


                            {{-- FORMULARIO PARA APLICAR DESCUENTO E IVA --}}
                            <div class="row mt-3">

                                {{-- DESCUENTO EN % --}}
                                <div class="col-12 col-md-6 col-lg-3 mb-2">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                                <i class="fas fa-percent"></i>
                                            </span>
                                        </div>
                                        <input wire:model.lazy="descuento" title="Presione ENTER para aplicar descuento"
                                            type="number" class="form-control text-center" max="100">
                                    </div>
                                </div>

                                {{-- IVA EN % --}}
                                <div class="col-12 col-md-6 col-lg-3">
                                    <label class="has-float-label">

                                        <select wire:model="iva_id" wire:change="aplicarIva"
                                            class="form-control hide-placeholder text-center" placeholder="Iva">

                                            @foreach ($ivas as $item)
                                                <option value="{{ $item->id }}">{{ $item->porcentaje }} %
                                                </option>
                                            @endforeach
                                        </select>
                                        <span>Iva</span>
                                    </label>
                                </div>


                            </div>

                            <!-- TABLA DE LOS ITEMS AGREGADOS A LA ORDEN DE COMPRA -->
                            <div class="row mt-4">
                                <div class="col-12 col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Eliminar</th>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Unidad</th>
                                                    <th scope="col">Cantidad</th>
                                                    <th scope="col">Descripción</th>
                                                    <th scope="col">Valor Unitario</th>
                                                    <th scope="col">Valor total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($items as $key => $item)
                                                    <tr>
                                                        <td>
                                                            <button wire:click="eliminarItem({{ $key }})"
                                                                class="btn btn-sm btn-danger">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </td>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td>{{ $item['unidad'] }}</td>
                                                        <td>{{ $item['cantidad'] }}</td>
                                                        <td>{{ $item['descripcion'] }}</td>
                                                        <td>{{ $item['valor_unitario'] }}</td>
                                                        <td>{{ $item['valor_total'] }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td class="text-left" colspan="5">
                                                    <th class="text-left">
                                                        Subtotal
                                                    </th>
                                                    <td>{{ $subtotal }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left" colspan="5">
                                                    <th class="text-left">
                                                        Descuento
                                                    </th>
                                                    <td>
                                                        {{ $descuento_en_cantidad }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left" colspan="5">
                                                    <th class="text-left">
                                                        Neto
                                                    </th>
                                                    <td>{{ $total_neto }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left" colspan="5">
                                                    <th class="text-left">
                                                        IVA
                                                    </th>
                                                    <td>{{ $iva_en_cantidad }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="text-left" colspan="5">
                                                    <th class="text-left bg-secondary">
                                                        TOTAL
                                                    </th>
                                                    <th class="bg-secondary">{{ $total }}</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <!-- PAGOS DE LA ORDEN DE COMPRA -->
                        <div wire:ignore.self class="tab-pane fade" id="pills-pagos" role="tabpanel"
                            aria-labelledby="pills-pagos-tab">

                            @if (session()->has('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ session('error') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            {{-- FORMULARIO PARA APLICAR DESCUENTO E IVA --}}
                            <div class="row">


                                {{-- TOTAL ORDEN DE COMPRA --}}
                                <div class="col-12 col-md-4 col-lg-3">
                                    <label class="has-float-label">
                                        <input type="text" class="form-control hide-placeholder text-center"
                                            value="$ {{ $total }}" disabled>
                                        <span>Total</span>
                                    </label>
                                </div>

                                {{-- MONTO DEL PAGO --}}
                                <div class="col-12 col-md-4 col-lg-2">
                                    <label class="has-float-label">
                                        <input type="number" wire:model.lazy="monto_pago"
                                            class="form-control hide-placeholder @error('monto_pago') is-invalid @enderror"
                                            placeholder="Monto pago">
                                        <span>Monto</span>
                                        @error('monto_pago')
                                            <div class="invalid-feedback text-right d-block">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </label>

                                </div>

                                {{-- TIPO DE PAGO --}}
                                <div class="col-12 col-md-4 col-lg-3">
                                    <label class="has-float-label">

                                        <select name="tipo_pago_id" wire:model.lazy="tipo_pago_id"
                                            class="form-control hide-placeholder text-center @error('tipo_pago_id') is-invalid @enderror custom-select"
                                            placeholder="Forma de pago">

                                            <option selected value="">Seleccione una forma de pago</option>
                                            @foreach ($tipos_de_pago as $item)
                                                <option value="{{ $item->id }}">{{ $item->descripcion }}
                                                </option>
                                            @endforeach

                                        </select>
                                        <span>Forma de pago</span>
                                    </label>
                                    @error('tipo_pago_id')
                                        <div class="invalid-feedback text-right d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- FECHA DEL PAGO --}}
                                <div class="col-12 col-md-6 col-lg-2">
                                    <label class="has-float-label">
                                        <input type="date" wire:model.lazy="fecha_pago"
                                            class="form-control hide-placeholder text-center @error('fecha_pago') is-invalid @enderror"
                                            placeholder="Fecha">
                                        <span>Fecha</span>
                                    </label>
                                    @error('fecha_pago')
                                        <div class="invalid-feedback text-right d-block">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                {{-- AGREGAR PAGO --}}
                                <div class="col-12 col-md-6 col-lg-2">
                                    <button wire:click="agregarPago" class="btn btn-success btn-lg btn-block">
                                        Agregar pago
                                    </button>
                                </div>


                            </div>

                            <!-- TABLA DE LOS ITEMS AGREGADOS A LA ORDEN DE COMPRA -->
                            <div class="row mt-4">
                                <div class="col-12 col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-hover">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Eliminar</th>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Monto</th>
                                                    <th scope="col">Forma de pago</th>
                                                    <th scope="col">Fecha del pago</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($pagos as $key => $item)
                                                    <tr>
                                                        <td>
                                                            <button wire:click="eliminarPago({{ $key }})"
                                                                class="btn btn-sm btn-danger">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </td>
                                                        <th scope="row">{{ $loop->iteration }}</th>
                                                        <td>{{ $item['monto'] }}</td>
                                                        <td>{{ $item['descripcion'] }}</td>
                                                        <td>{{ $item['fecha'] }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td class="text-left" colspan="3">
                                                    <th class="text-left bg-secondary">
                                                        Falta pagar
                                                    </th>
                                                    <th class="text-left bg-secondary">
                                                        {{ $total - array_sum(array_column($this->pagos, 'monto')) }}
                                                    </th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            {{-- BOTON GENERAR ORDEN DE COMPRA --}}
                            <div class="row justify-content-end">
                                <div class="col-12 col-md-7 col-lg-4">


                                    <button  
                                        @if($tipoOperacion == 1)
                                            wire:click="generarOrden"
                                        @else
                                            wire:click="editarOrden"
                                        @endif
                                        wire:loading.remove
                                        class="btn btn-primary form-control">
                                        {{ $tipoOperacion == 1 ? 'Generar orden de compra' : 'Guardar cambios'}}
                                    </button>

                                    <!-- Se muestra mientra se completa la petición -->
                                    <button disabled type="button" wire:loading.delay 
                                        @if($tipoOperacion == 1)
                                            wire:target="generarOrden"
                                        @else
                                            wire:target="editarOrden"
                                        @endif
                                        class="btn btn-primary btn-block form-control">
                                        <span class="spinner-border spinner-border-sm" role="status"
                                            aria-hidden="true"></span>
                                        Guardando ...
                                    </button>

                                </div>
                            </div>






                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>


</div>

<script>
    //import Swal from "sweetalert2";

    $(document).ready(() => {

        Livewire.on('siguienteInputFocus', (inputId) => {
            $(inputId).focus();
        })

    })

</script>
