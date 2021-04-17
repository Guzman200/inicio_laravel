import Swal from "sweetalert2";
import { loaderIn, loaderOut, responseAxios, sweetDelete, datatablesJSON, sweetInfo } from "./helpers";


$(document).ready(() => {

    const formBuscar = $("#form-busqueda");

    let tablaPagos;

    // Inicializamos la tabla pagos
    tablaPagos = $("#tabla_pagos").DataTable({
        "responsive": true,
        "autoWidth": false,
        "serverSide": true,
        "language": datatablesJSON, // Se traduce la datatables a español
        "lengthChange": false, // Ocultamos el paginado
        "ajax": {
            "url": "../pagos",
            "type": "GET"
        },
        "columns": [
            { "data": "id" },
            { "data": "fecha" },
            { "data": "fecha_en_que_se_pago" },
            { "data": "status" },
            { "data": "cantidad" },
            { "data": "orden_de_compra.proyecto", name: "ordenDeCompra.proyecto" },
            { "data": "tipo_de_pago.descripcion", name: "tipoDePago.descripcion" },
            { "defaultContent": "" }
        ],
        "columnDefs": [
            {
                "targets": 7,
                "render": function (data, type, row) {
                    return ` 
                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                        <button data-pagar="${row.id}" type="button" class="btn btn-success">
                        <i class="fas fa-money-bill-wave"></i>  Pagar</button>
                    </div>
                    `;
                }
            }
        ]
    })


    // Cuando el usuario marca como pagado un pago
    $(document).on("click", "button[data-pagar]", function () {

        let pago_id = $(this).data("pagar");

        sweetDelete("¿Marcar como pagado?", `¡Se cambiara a estatus pagado el pago <b>#${pago_id}</b>!`, function () {

            modificarStatusPagoAPagado(pago_id);

        }, 'warning', 'Si, Cambiar a estatus pagado!');

    })

    function modificarStatusPagoAPagado(pago_id) {

        let url = `/api/pago/${pago_id}/marcar-pagado`;

        let form = new FormData();
        form.append('__method', 'put');

        loaderIn();
        axios
            .put(url, form)
            .then((res) => {
                tablaPagos.ajax.reload(null,false);
                sweetInfo('Modificación de estatus correcta','','success', '1800');
            })
            .catch(({ response }) => {
                console.log(response);
                responseAxios(response);
            }).then(() => {
                loaderOut();
            });
    }

    /** ================================> Datatables <=========================================  */

    // Agregamos nuestro input personalizado para buscar en la datatable
    $("#busqueda").on("keyup search input paste cut", function () {
        tablaPagos.search(this.value).draw();
    });

    // En realidad esto no hace casi nada (Podria o no estar)
    formBuscar.submit(event => {
        event.preventDefault();
        $("#busqueda").keyup();
    })


});