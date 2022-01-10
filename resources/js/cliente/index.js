import Swal from "sweetalert2";
import {  loaderIn, loaderOut, responseAxios, sweetDelete, datatablesJSON, sweetInfo } from "./../helpers";


$(document).ready(() => {

    const formBuscar = $("#form-busqueda");
    
    let tablaClientes;  

    // Inicializamos la tabla clients
    tablaClientes = $("#tabla_clientes").DataTable({
        "responsive": true,
        "autoWidth": false,
        "serverSide": true,
        "language": datatablesJSON, // Se traduce la datatables a español
        "lengthChange": false, // Ocultamos el paginado
        "ajax": {
            "url": "../clientes",
            "type": "GET"
        },
        "columns": [
            { "data": "id" },
            { "data": "nombre" },
            { "data": "telefono" }, 
            { "data": "email" },
            { "data": "direccion"},
            { "data": "fecha_nacimiento" },
            { "defaultContent" : ""}
        ],
        "columnDefs": [
            {
                "targets": 6,
                "render": function ( data, type, row ) {
                    return ` 
                    <button class="btn btn-sm" type="button" 
                            data-toggle="dropdown"  aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#" data-edit_cliente='${row.id}'>Editar</a>
                        <a class="dropdown-item" href="#" data-delete_cliente='${row.id}' data-cliente='${row.nombre}'>Eliminar</a>
                    </div>`;
                }
            }
        ]
    })

    
    // Agregar un nuevo cliente
    $("button[data-add_cliente]")
        .off()
        .click(function () {
            Livewire.emit('agregar');
        });


    // Editar un cliente
    $(document).on('click', 'a[data-edit_cliente]', function () {

        let id = $(this).data("edit_cliente");
        Livewire.emit('editar',id);
    
    })

    // Eliminar cliente
    $(document).on('click', 'a[data-delete_cliente]', function () {

        let id = $(this).data("delete_cliente");
        let cliente = $(this).data("cliente");

        sweetDelete("¿Eliminar cliente?", `¡Se eliminara el cliente <b>${cliente}</b>!`, function () {
            Livewire.emit('eliminar', id);
        });

    })


    /** Actualiza la tabla de transportadores al actulaizar o registrar un proveedor */
    Livewire.on('actualizar_tabla', () =>{
        tablaClientes.ajax.reload(null,false);
    });


    Livewire.on('abrirModal', () => {
        $("#modalClientes").modal({backdrop: "static"});
    })

    Livewire.on('sweetAlert', (title, message, icon) => {
        Swal.fire(
            title,
            message,
            icon
        )
    })

    Livewire.on('siguienteInputFocus', (inputId) => {
        $(inputId).focus();
    })
    
    /** ================================> Datatables <=========================================  */ 

    // Agregamos nuestro input personalizado para buscar en la datatable
    $("#busqueda").on("keyup search input paste cut", function () {
        tablaClientes.search(this.value).draw();
    });

    // En realidad esto no hace casi nada (Podria o no estar)
    formBuscar.submit(event => {
        event.preventDefault();
        $("#busqueda").keyup();
    })
    

});