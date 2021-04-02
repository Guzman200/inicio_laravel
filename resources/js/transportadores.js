import Swal from "sweetalert2";
import {  loaderIn, loaderOut, responseAxios, sweetDelete, datatablesJSON, sweetInfo } from "./helpers";


$(document).ready(() => {

    const formBuscar = $("#form-busqueda");
    
    let tablaTransportadores;  

    // Inicializamos la tabla transportadores
    tablaTransportadores = $("#tabla_transportadores").DataTable({
        "responsive": true,
        "autoWidth": false,
        "serverSide": true,
        "language": datatablesJSON, // Se traduce la datatables a español
        "lengthChange": false, // Ocultamos el paginado
        "ajax": {
            "url": "../transportadores",
            "type": "GET"
        },
        "columns": [
            { "data": "id" },
            { "data": "nombres" },
            { "data": "apellidos" },
            { "data": "telefono" },
            { "data": "correo" },
            { "defaultContent" : ""}
        ],
        "columnDefs": [ 
            {
                "targets": 5,
                "render": function ( data, type, row ) {
                    return ` 
                    <button class="btn btn-sm" type="button" 
                            data-toggle="dropdown"  aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#" data-edit_transportador='${row.id}'>Editar</a>
                        <a class="dropdown-item" href="#" data-delete_transportador='${row.id}' data-nombres='${row.nombres}'>Eliminar</a>
                    </div>`;
                }
            }
        ]
    })

    
    // Agregar un nuevo transportador
    $("button[data-add_transportador]")
        .off()
        .click(function () {
            Livewire.emit('agregar');
        });


    // Editar un transportador
    $(document).on('click', 'a[data-edit_transportador]', function () {

        let id = $(this).data("edit_transportador");
        Livewire.emit('editar',id);
        
    })

    /// Eliminar transportador
    $(document).on('click', 'a[data-delete_transportador]', function () {

        let id = $(this).data("delete_transportador");
        let nombre = $(this).data("nombres");

        sweetDelete("¿Eliminar transportador?", `¡Se eliminara el transportador <b>${nombre}</b>!`, function () {
            Livewire.emit('eliminar', id);
        });

    })


    /** Actualiza la tabla de transportadores al actulaizar o registrar un transportador */
    Livewire.on('actualizar_tabla', () =>{
        tablaTransportadores.ajax.reload(null,false);
    });


    Livewire.on('abrirModal', () => {
        $("#modalTransportadores").modal({backdrop: "static"});
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
        tablaTransportadores.search(this.value).draw();
    });

    // En realidad esto no hace casi nada (Podria o no estar)
    formBuscar.submit(event => {
        event.preventDefault();
        $("#busqueda").keyup();
    })
    

});