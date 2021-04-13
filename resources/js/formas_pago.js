import Swal from "sweetalert2";
import {  loaderIn, loaderOut, responseAxios, sweetDelete, datatablesJSON, sweetInfo } from "./helpers";


$(document).ready(() => {

    const formBuscar = $("#form-busqueda");
    
    let tablaFormasPago;  

    // Inicializamos la tabla formas de pago
    tablaFormasPago = $("#tabla_formas_de_pago").DataTable({
        "responsive": true,
        "autoWidth": false,
        "serverSide": true,
        "language": datatablesJSON, // Se traduce la datatables a español
        "lengthChange": false, // Ocultamos el paginado
        "ajax": {
            "url": "../formas_de_pago",
            "type": "GET"
        },
        "columns": [
            { "data": "id" },
            { "data": "descripcion" },
            { "defaultContent" : ""}
        ],
        "columnDefs": [ 
            {
                "targets": 2,
                "render": function ( data, type, row ) {
                    return `<button class="btn btn-sm" type="button" 
                            data-toggle="dropdown"  aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <a class="dropdown-item" href="#" data-edit_forma_pago='${row.id}'>Editar</a>
                                <a class="dropdown-item" href="#" data-delete_forma_pago='${row.id}' data-descripcion='${row.descripcion}'>Eliminar</a>
                            </div>`;
                }
            }
        ]
    })
    
   
    // Agregar una nueva categoria
    $("button[data-add_forma_pago]")
        .off()
        .click(function () {
            Livewire.emit('agregar');
        });


    // Editar una categoria
    $(document).on('click', 'a[data-edit_forma_pago]', function () {

        let id = $(this).data("edit_forma_pago");
        Livewire.emit('editar',id);
        
    })

    /// Eliminar categoria
    $(document).on('click', 'a[data-delete_forma_pago]', function () {

        let id = $(this).data("delete_forma_pago");
        let descripcion = $(this).data("descripcion");

        sweetDelete("¿Eliminar forma de pago?", `¡Se eliminara la forma de pago <b>${descripcion}</b>!`, function () {
            Livewire.emit('eliminar', id);
        });

    })


    /** Actualiza la tabla de transportadores al actulaizar o registrar un trnasportador */
    Livewire.on('actualizar_tabla', () =>{
        tablaFormasPago.ajax.reload(null,false);
    });


    Livewire.on('abrirModal', () => {
        $("#modalFormasDePago").modal({backdrop: "static"});
    })

    Livewire.on('sweetAlert', (title, message, icon) => {
        Swal.fire(
            title,
            message,
            icon
        )
    })

  

    
    /** ================================> Datatables <=========================================  */ 

    // Agregamos nuestro input personalizado para buscar en la datatable
    $("#busqueda").on("keyup search input paste cut", function () {
        tablaFormasPago.search(this.value).draw();
    });

    // En realidad esto no hace casi nada (Podria o no estar)
    formBuscar.submit(event => {
        event.preventDefault();
        $("#busqueda").keyup();
    })
    

});