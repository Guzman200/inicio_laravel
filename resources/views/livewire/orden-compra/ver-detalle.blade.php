<div>

    <!-- MODAL ORDEND DE COMRPA -->
    <div wire:ignore.self class="modal fade" id="modalDetalleOrdenesDeCompra" tabindex="-1"
        aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Orden de compra #1</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    <div wire:ignore.self class="accordion" id="accordionExample">

                        {{-- DATOS DE LA ORDEN DE COMPRA --}}
                        <div wire:ignore.self class="card">
                            <div class="card-header bg-teal" id="headingOne">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left" type="button"
                                        data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                                        aria-controls="collapseOne">
                                        <span class="fas fa-angle-down"></span>
                                        Datos generales
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                data-parent="#accordionExample">
                                <div class="card-body">

                                    <!-- DATOS DE LA ORDEN DE COMPRA -->
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Número pagos</th>
                                                    <th scope="col">Número de facturas</th>
                                                    <th scope="col">Centro de costo</th>
                                                    <th scope="col">Cotización</th>
                                                    <th scope="col">Proyecto</th>
                                                    <th scope="col">Total</th>
                                                    <th scope="col">Total neto</th>
                                                    <th scope="col">Subtotal</th>
                                                    <th scope="col">Descuento</th>
                                                    <th scope="col">Estatus</th>
                                                    <th scope="col">IVA</th>
                                                    <th scope="col">Proveedor</th>
                                                    <th scope="col">Creador</th>
                                                    <th scope="col">Fecha creación</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($orden)
                                                    <tr>
                                                        <th scope="row">{{ $orden->id }}</th>
                                                        <td>{{ $orden->num_pagos }}</td>
                                                        <td>{{ $orden->num_facturas }}</td>
                                                        <td>{{ $orden->centro_costo }}</td>
                                                        <td>{{ $orden->cotizacion }}</td>
                                                        <td>{{ $orden->proyecto }}</td>
                                                        <td>{{ $orden->total }}</td>
                                                        <td>{{ $orden->total_neto }}</td>
                                                        <td>{{ $orden->subtotal }}</td>
                                                        <td>{{ $orden->descuento }}%</td>
                                                        <td>
                                                            @if ($orden->status == 'por pagar')
                                                                <span class="badge badge-warning">Por pagar</span>
                                                            @else
                                                                <span class="badge badge-success">Pagada</span>
                                                            @endif
                                                        </td>
                                                        <td>{{ $orden->iva->porcentaje }}%</td>
                                                        <td>{{ $orden->proveedor->proveedor }}</td>
                                                        <td>{{ $orden->user->nombres . ' ' . $orden->user->ap_paterno }}
                                                        </td>
                                                        <td>{{ $orden->created_at->format('d-m-Y') }}</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>


                                </div>
                            </div>
                        </div>

                        {{-- DETALLE DE ORDEN DE COMPRA --}}
                        <div wire:ignore.self class="card">
                            <div class="card-header bg-teal" id="headingTwo">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                                        data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false"
                                        aria-controls="collapseTwo">
                                        <span class="fas fa-angle-down"></span>
                                        Detalle
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                data-parent="#accordionExample">
                                <div class="card-body">

                                    <!-- DETALLE ORDEN DE COMPRA -->
                                    <div class="row mt-4">
                                        <div class="col-12 col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Unidad</th>
                                                            <th scope="col">Cantidad</th>
                                                            <th scope="col">Descripción</th>
                                                            <th scope="col">Valor Unitario</th>
                                                            <th scope="col">Valor total</th>
                                                        </tr>
                                                    </thead>
                                                    @if ($orden)
                                                        <tbody>
                                                            @foreach ($orden->detalleOrdenCompra as $detalle)
                                                                <tr>
                                                                    <th scope="row">{{ $detalle->id }}</th>
                                                                    <td>{{ $detalle->unidad }}</td>
                                                                    <td>{{ $detalle->cantidad }}</td>
                                                                    <td>{{ $detalle->descripcion }}</td>
                                                                    <td>{{ $detalle->valor_unitario }}</td>
                                                                    <td>{{ $detalle->valor_unitario * $detalle->cantidad }}
                                                                    </td>
                                                                </tr>
                                                            @endforeach

                                                        </tbody>
                                                    @endif
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- PAGOS DE LA ORDEN DE COMPRA --}}
                        <div wire:ignore.self class="card">
                            <div class="card-header bg-teal" id="headingThree">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                                        data-toggle="collapse" data-target="#collapseThree" aria-expanded="false"
                                        aria-controls="collapseThree">
                                        <span class="fas fa-angle-down"></span>
                                        Pagos
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                data-parent="#accordionExample">
                                <div class="card-body">

                                    <!-- PAGOS DE LA ORDEN DE COMPRA -->
                                    <div class="row mt-4">
                                        <div class="col-12 col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Forma de pago</th>
                                                            <th scope="col">Monto</th>
                                                            <th scope="col">Fecha del pago</th>
                                                            <th scope="col">Fecha en que se pago</th>
                                                            <th scope="col">Estatus</th>
                                                        </tr>
                                                    </thead>
                                                    @if ($orden)
                                                        <tbody>
                                                            @foreach ($orden->pagos as $pago)
                                                                <tr>
                                                                    <th scope="row">{{ $pago->id }}</th>
                                                                    <td>{{ $pago->tipoDePago->descripcion }}</td>
                                                                    <td>{{ $pago->cantidad }}</td>
                                                                    <td>{{ $pago->fecha->format('d-m-Y') }}</td>
                                                                    <td>
                                                                        @if (is_null($pago->fecha_en_que_se_pago))
                                                                            Pendiente por pagar
                                                                        @else
                                                                            {{ $pago->fecha_en_que_se_pago->format('d-m-Y') }}
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        @if ($pago->status == 'por pagar')
                                                                            <span class="badge badge-warning">Por
                                                                                pagar</span>
                                                                        @else
                                                                            <span
                                                                                class="badge badge-success">Pagado</span>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            @endforeach

                                                        </tbody>
                                                    @endif
                                                </table>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        {{-- FACTURAS DE LA ORDEN DE COMPRA DE LA ORDEN DE COMPRA --}}
                        <div wire:ignore.self class="card">
                            <div class="card-header bg-teal" id="headingThree">
                                <h2 class="mb-0">
                                    <button class="btn btn-link btn-block text-left collapsed" type="button"
                                        data-toggle="collapse" data-target="#collapseFacturas" aria-expanded="false"
                                        aria-controls="collapseFacturas">
                                        <span class="fas fa-angle-down"></span>
                                        Facturas de la orden de compra
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseFacturas" class="collapse" aria-labelledby="headingThree"
                                data-parent="#accordionExample">
                                <div class="card-body">

                                    <!-- FACTURAS DE LA ORDEN DE COMPRA -->
                                    <div class="row mt-4">
                                        <div class="col-12 col-md-12">
                                            <div class="table-responsive">
                                                <table class="table table-sm table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th scope="col">#</th>
                                                            <th scope="col">Factura</th>
                                                            <th scope="col">Fecha en que se adjunto</th>
                                                            <th scope="col">Descargar</th>
                                                            <th scope="col">Eliminar</th>
                                                        </tr>
                                                    </thead>
                                                    @if ($orden)
                                                        <tbody>
                                                            @foreach ($orden->facturas as $factura)
                                                                <tr>
                                                                    <th scope="row">{{ $factura->id }}</th>
                                                                    <td>{{ $factura->nombre_factura}}</td>
                                                                    <td>{{ $factura->created_at->format('d-m-Y') }}</td>
                                                                    <td>
                                                                        <a href="{{route("descargarFactura", ['factura' => $factura->id])}}" title="Descargar factura" class="btn btn-sm btn-primary">
                                                                            <span class="fas fa-download"></span>
                                                                        </a>
                                                                    </td>
                                                                    <td>
                                                                        <button 
                                                                            wire:click="eliminarFactura('{{$factura->id}}')"
                                                                            title="Eliminar factura" 
                                                                            class="btn btn-sm btn-danger">
                                                                            <span class="fas fa-trash-alt"></span>
                                                                        </button>
                                                                    </td>
                                                                </tr>
                                                            @endforeach

                                                        </tbody>
                                                    @endif
                                                </table>
                                            </div>
                                        </div>
                                    </div>

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
    $(document).ready(() => {


        // Ver detalle de orden de compra
        $(document).on('click', 'a[data-ver_detalle]', function() {

            let id = $(this).data("ver_detalle");

            Livewire.emit('verDetalleOrden', id);
        })

        Livewire.on('abrirModalDetalle', () => {
            $("#modalDetalleOrdenesDeCompra").modal({
                backdrop: "static"
            });
        })

    })

</script>
