import Swal from "sweetalert2";
import {  loaderIn, loaderOut, responseAxios, sweetDelete, datatablesJSON, sweetInfo } from "./helpers";


$(document).ready(() => {

    const formBuscar = $("#form-busqueda");
    
    let tablaUsuarios;  

    // Inicializamos la tabla usuarios
    tablaUsuarios = $("#tabla_usuarios").DataTable({
        "responsive": true,
        "autoWidth": false,
        "serverSide": true,
        "language": datatablesJSON, // Se traduce la datatables a español
        "lengthChange": false, // Ocultamos el paginado
        "ajax": {
            "url": "../usuarios",
            "type": "GET"
        },
        "columns": [
            { "data": "id" },
            { "data": "full_name", name: "full_name"},
            { "data": "telefono" },
            { "data": "email" },
            { "data": "status" },
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
                        <a class="dropdown-item" href="#" data-edit_usuario='${row.id}'>Editar</a>
                        <a class="dropdown-item" href="#" data-delete_usuario='${row.id}' data-nombres='${row.nombres}'>Eliminar</a>
                        <a class="dropdown-item" href="#" data-desactivar_usuario='${row.id}' 
                            data-nombres='${row.nombres}'>Cambiar estatus</a>
                    </div>`;
                }
            }
        ]
    })

    
    // Agregar un nuevo usuarios
    $("button[data-add_usuario]")
        .off()
        .click(function () {
            Livewire.emit('agregar');
        });


    // Editar un usuarios
    $(document).on('click', 'a[data-edit_usuario]', function () {

        let id = $(this).data("edit_usuario");
        Livewire.emit('editar',id);
        
    })

    /// Eliminar usuario
    $(document).on('click', 'a[data-delete_usuario]', function () {

        let id = $(this).data("delete_usuario");
        let nombre = $(this).data("nombres");

        sweetDelete("¿Eliminar usuario?", `¡Se eliminara el usuario <b>${nombre}</b>!`, function () {
            Livewire.emit('eliminar', id);
        });

    })

    // Cambiar estatus de usuario
    $(document).on('click', 'a[data-desactivar_usuario]', function (){

        let id = $(this).data("desactivar_usuario");
        let nombre = $(this).data("nombres");

        sweetDelete("¿Cambiar estatus?", `¡Se cambiara el estatus del usuario <b>${nombre}</b>!`, function () {
            Livewire.emit('cambiarStatus', id);
        },'question','Cambiar estatus');
    })

    /** Actualiza la tabla de transportadores al actulaizar o registrar un transportador */
    Livewire.on('actualizar_tabla', () =>{
        tablaUsuarios.ajax.reload(null,false);
    });


    Livewire.on('abrirModal', () => {
        $("#modalUsuarios").modal({backdrop: "static"});
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
        tablaUsuarios.search(this.value).draw();
    });

    // En realidad esto no hace casi nada (Podria o no estar)
    formBuscar.submit(event => {
        event.preventDefault();
        $("#busqueda").keyup();
    })
    

});