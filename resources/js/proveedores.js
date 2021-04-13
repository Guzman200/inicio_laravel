import Swal from "sweetalert2";
import {  loaderIn, loaderOut, responseAxios, sweetDelete, datatablesJSON, sweetInfo } from "./helpers";


$(document).ready(() => {

    const formBuscar = $("#form-busqueda");
    
    let tablaProveedores;  

    // Inicializamos la tabla transportadores
    tablaProveedores = $("#tabla_proveedores").DataTable({
        "responsive": true,
        "autoWidth": false,
        "serverSide": true,
        "language": datatablesJSON, // Se traduce la datatables a español
        "lengthChange": false, // Ocultamos el paginado
        "ajax": {
            "url": "../proveedores",
            "type": "GET"
        },
        "columns": [
            { "data": "id" },
            { "data": "nombre" },
            { "data": "direccion" },
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
                        <a class="dropdown-item" href="#" data-edit_proveedor='${row.id}'>Editar</a>
                        <a class="dropdown-item" href="#" data-delete_proveedor='${row.id}' data-nombre='${row.nombre}'>Eliminar</a>
                    </div>`;
                }
            }
        ]
    })

    
    // Agregar un nuevo proveedor
    $("button[data-add_proveedor]")
        .off()
        .click(function () {
            Livewire.emit('agregar');
        });


    // Editar un proveedor
    $(document).on('click', 'a[data-edit_proveedor]', function () {

        let id = $(this).data("edit_proveedor");
        Livewire.emit('editar',id);
        
    })

    /// Eliminar transportador
    $(document).on('click', 'a[data-delete_proveedor]', function () {

        let id = $(this).data("delete_proveedor");
        let nombre = $(this).data("nombre");

        sweetDelete("¿Eliminar transportador?", `¡Se eliminara el proveedor <b>${nombre}</b>!`, function () {
            Livewire.emit('eliminar', id);
        });

    })


    /** Actualiza la tabla de transportadores al actulaizar o registrar un proveedor */
    Livewire.on('actualizar_tabla', () =>{
        tablaProveedores.ajax.reload(null,false);
    });


    Livewire.on('abrirModal', () => {
        $("#modalProveedores").modal({backdrop: "static"});
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
        tablaProveedores.search(this.value).draw();
    });

    // En realidad esto no hace casi nada (Podria o no estar)
    formBuscar.submit(event => {
        event.preventDefault();
        $("#busqueda").keyup();
    })
    

});