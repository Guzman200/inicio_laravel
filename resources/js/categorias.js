import Swal from "sweetalert2";
import {  loaderIn, loaderOut, responseAxios, sweetDelete, datatablesJSON, sweetInfo } from "./helpers";


$(document).ready(() => {

    const formBuscar = $("#form-busqueda");
    const formCategorias = $("#form-categorias");
    
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
            { "data": "descripcion" },
            { "defaultContent" : ""}
        ],
        "columnDefs": [ 
            {
                "targets": 2,
                "render": function ( data, type, row ) {
                    return `<div class='text-center'><button data-edit_categoria='${row.id}' class='btn btn-primary btn-sm'><i class='fas fa-edit'></i></button><button data-descripcion='${row.descripcion}' data-delete_categoria='${row.id}' class='btn btn-danger btn-sm ml-1'><i class='fas fa-trash'></i></button></div>`;
                }
            }
        ]
    })
    
   
    // Agregar una nueva categoria
    $("button[data-add_categoria]")
        .off()
        .click(function () {
            Livewire.emit('agregar');
        });


    // Editar una categoria
    $(document).on('click', 'button[data-edit_categoria]', function () {

        let id = $(this).data("edit_categoria");
        Livewire.emit('editar',id);
        
    })

    /// Eliminar categoria
    $(document).on('click', 'button[data-delete_categoria]', function () {

        let id = $(this).data("delete_categoria");
        let descripcion = $(this).data("descripcion");

        sweetDelete("¿Eliminar categoría?", `¡Se eliminara la categoría <b>${descripcion}</b>!`, function () {
            Livewire.emit('eliminar', id);
        });

    })


    /** Actualiza la tabla de transportadores al actulaizar o registrar un trnasportador */
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

   formCategorias.submit((event) => {

        event.preventDefault();

        if(!formCategorias.valid()){
            return false;
        }

        Livewire.emit('storeUpdate');
    });

    // validaciones del formulario transportadores
    formCategorias.validate({
        rules: {
            descripcion: {
                required : true,
            }
        }
    });

    
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