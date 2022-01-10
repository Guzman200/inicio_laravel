import Swal from "sweetalert2";
import {  loaderIn, loaderOut, responseAxios, sweetDelete, datatablesJSON, sweetInfo } from "./../helpers";


$(document).ready(() => {

    const formBuscar = $("#form-busqueda");
    
    let tablaCategorias;  

    // Inicializamos la tabla categorias
    tablaCategorias = $("#tabla_categorias").DataTable({
        "responsive": true,
        "autoWidth": false,
        "serverSide": true,
        "language": datatablesJSON, // Se traduce la datatables a español
        "lengthChange": false, // Ocultamos el paginado
        "ajax": {
            "url": "../categorias",
            "type": "GET"
        },
        "columns": [
            { "data": "id" },
            { "data": "codigo" },
            { "data": "nombre" },
            { "data": "productos" },
            { "defaultContent" : ""}
        ],
        "columnDefs": [
            {
                "targets": 4,
                "render": function ( data, type, row ) {
                    return ` 
                    <button class="btn btn-sm" type="button" 
                            data-toggle="dropdown"  aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#" data-edit_categoria='${row.id}'>Editar</a>
                        <a class="dropdown-item" href="#" data-delete_categoria='${row.id}' data-categoria='${row.nombre}'>Eliminar</a>
                    </div>`;
                }
            }
        ]
    })

    
    // Agregar una nueva categorias
    $("button[data-add_categoria]")
        .off()
        .click(function () {
            Livewire.emit('agregar');
        });


    // Editar una categoria
    $(document).on('click', 'a[data-edit_categoria]', function () {

        let id = $(this).data("edit_categoria");
        Livewire.emit('editar',id);
        
    })

    // Eliminar sucursal
    $(document).on('click', 'a[data-delete_categoria]', function () {

        let id = $(this).data("delete_categoria");
        let categoria = $(this).data("categoria");

        sweetDelete("¿Eliminar categoría?", `¡Se eliminara la categoría <b>${categoria}</b>!`, function () {
            Livewire.emit('eliminar', id);
        });

    })


    /** Actualiza la tabla de transportadores al actulaizar o registrar un proveedor */
    Livewire.on('actualizar_tabla', () =>{
        tablaCategorias.ajax.reload(null,false);
    });


    Livewire.on('abrirModal', () => {
        $("#modalCategorias").modal({backdrop: "static"});
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
        tablaCategorias.search(this.value).draw();
    });

    // En realidad esto no hace casi nada (Podria o no estar)
    formBuscar.submit(event => {
        event.preventDefault();
        $("#busqueda").keyup();
    })
    

});