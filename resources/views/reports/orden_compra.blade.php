<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Orden de compra</title>
    <link rel="stylesheet" href="{{ asset('css/estilos_factura.css') }}">
</head>

<body>
    <!--
    <img class="anulada" src="img/anulado.png" alt="Anulada">
    -->
    <div id="page_pdf">
        <table id="factura_head">
            <tr>
                <td class="logo_factura">
                    <div>
                        <img src="{{ asset('images/logo_empresa.png') }}" alt="logo empresa">
                    </div>
                </td>
                <td class="info_empresa">
                    <div>
                        <span class="h2">ID CHILE SERVICIOS Spa</span>
                        <p>76.738.857-8</p>
                        <p>Tte. Luis Uribe 636, Oficina 901</p>
                        <p>Antofagasta - Chile</p>
                        <p>+56 228948004 / +56 938719170</p>
                        <p>info@idchileservicios.cl</p>
                    </div>
                </td>
                <!-- Datos de la orden de compra -->
                <td class="info_factura">
                    <div class="round">
                        <span class="h3">Orden de compra</span>
                        <p>No. orden: <strong>{{$orden->id}}</strong></p>
                        <p>Fecha: {{$orden->created_at->format('d-m-Y')}}</p>
                        <p>Centro de costo: {{$orden->centro_costo}}</p>
                        <p>Proyecto: {{$orden->proyecto}}</p>
                    </div>
                </td>
            </tr>
        </table>

        <!-- DATOS DEL PROVEEDOR -->
        <table id="factura_cliente">
            <tr>
                <td class="info_cliente">
                    <div class="round">
                        <span class="h3">Proveedor</span>
                        <table class="datos_cliente">
                            <tr>
                                <td><label>Proveedor:</label>
                                    <p>{{$orden->proveedor->proveedor}}</p>
                                </td>
                                <td><label>Rut:</label>
                                    <p>{{$orden->proveedor->rut}}</p>
                                </td>

                            </tr>
                            <tr>
                                <td><label>Giro:</label>
                                    <p>{{$orden->proveedor->giro}}</p>
                                </td>
                                <td><label>Teléfono:</label>
                                    <p>{{$orden->proveedor->telefono}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Cotización:</label>
                                    <p>{{$orden->cotizacion}}</p>
                                </td>
                                <td><label>Contacto:</label>
                                    <p>{{$orden->proveedor->contacto}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Dirección:</label>
                                    <p>{{$orden->proveedor->direccion}}</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>

            </tr>
        </table>



        <!-- CONDICIONES COMERCIALES  -->
        <table style="float : left;" class="condiciones_comerciales">
            <tr>
                <td width="100%">
                    <div class="round">
                        <span class="h3">Condiciones comerciales</span>
                        <table class="datos_cliente">
                            <tr>
                                <td><label>Creadar por:</label>
                                    <p>{{$orden->user->nombres . " " . $orden->user->ap_paterno . " " . $orden->user->ap_materno}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td><label>No. Pagos:</label>
                                    <p>{{$orden->num_pagos}}</p>
                                </td>
                            </tr>
                            <tr>
                                <td><label>Observaciones:</label>
                                    <p>{{$orden->observaciones}}</p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </td>

            </tr>
        </table>

        <!-- FACTURAR A  -->
        <table style="float : right;" class="condiciones_comerciales">
            <tr>
                <td width="100%">

                    <div class="round">
                        <span class="h3">Facturar a</span>
                        <p>ID CHILE SERVICIOS Spa<strong></strong></p>
                        <p>76.738.857-8</p>
                        <p>GIRO SERVICIOS A LA MINERIA</p>
                        <p>Tte. LUIS URIBE 636, Of. 901, ANTOFAGASTA, CHILE</p>
                    </div>

                </td>

            </tr>
        </table>


        <!-- DETALLE DE LA ORDEN DE COMPRA -->
        <table id="factura_detalle" style="clear:both; margin-top : 0.5rem;">
            <thead>
                <tr>
                    <th width="50px">#</th>
                    <th width="50px">Unidad</th>
                    <th width="50px">Cantidad</th>
                    <th class="textleft">Descripción</th>
                    <th class="textright" width="150px">Valor Unitario.</th>
                    <th class="textright" width="150px">Valor Total</th>
                </tr>
            </thead>
            <tbody id="detalle_productos">
                @foreach($orden->detalleOrdenCompra as $detalle)
                    <tr>
                        <td class="textcenter">{{$loop->iteration}}</td>
                        <td class="textcenter">{{$detalle->unidad}}</td>
                        <td class="textcenter">{{$detalle->cantidad}}</td>
                        <td>{{$detalle->descripcion}}</td>
                        <td class="textright">{{$detalle->valor_unitario}}</td>
                        <td class="textright">{{$detalle->cantidad * $detalle->valor_unitario}}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot id="detalle_totales">
                <tr>
                    <td colspan="5" class="textright"><span>SUBTOTAL $</span></td>
                    <td class="textright"><span>{{$orden->subtotal}}</span></td>
                </tr>
                <tr>
                    <td colspan="5" class="textright"><span>DESCUENTO $</span></td>
                    <td class="textright"><span>{{($orden->descuento * $orden->subtotal ) /100}}</span></td>
                </tr>
                <tr>
                    <td colspan="5" class="textright"><span>NETO $</span></td>
                    <td class="textright"><span>{{$orden->total_neto}}</span></td>
                </tr>
                <tr>
                    <td colspan="5" class="textright"><span>IVA ({{$orden->iva->porcentaje}}%) $</span></td>
                    <td class="textright"><span>{{($orden->iva->porcentaje * $orden->total_neto) /100}}</span></td>
                </tr>
                <tr>
                    <td colspan="5" class="textright"><span>TOTAL $</span></td>
                    <td class="textright"><span>{{$orden->total}}</span></td>
                </tr>
            </tfoot>
        </table>


        <!-- Importante y firma -->
        <div>
            <p class="nota" style="display : inline; color : red;">IMPORTANTE</p>
            <p class="nota">ENVIAR FACTURA EN FORMATO PDF A MANUEL.ACUNA@IDCHILESERVICIOS.CL, ADJUNTANDO ORDEN DE COMPRA
                Y DATOS PARA REALIZAR PAGO CORRESPONDIENTE.</p>
            <!--<h4 class="label_gracias">¡Gracias por su compra!</h4>-->
        </div>

        <footer style="margin-top : 10rem;">
            <table width="50%" style="margin : 0 auto;">
                <tr align="center">
                    <td>
                        <hr class="hr">
                    </td>
                </tr>
                <tr align="center">
                    <td align="center"><strong>Nombre y firma</strong> </td>
                </tr>
            </table>
        </footer>





</body>

</html>
