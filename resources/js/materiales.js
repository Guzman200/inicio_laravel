import Swal from "sweetalert2";
import {  loaderIn, loaderOut, responseAxios, sweetDelete, datatablesJSON, sweetInfo } from "./helpers";


$(document).ready(() => {

   const formBuscar = $("#form-busqueda");
   const formMateriales = $("#form-materiales");

   let tablaMateriales;   

    // Inicializamos la tabla transportadores
    tablaMateriales = $("#tabla_materiales").DataTable({
        "responsive": true,
        "autoWidth": false,
        "serverSide": true,
        "language": datatablesJSON, // Se traduce la datatables a español
        "lengthChange": false, // Ocultamos el paginado
        "ajax": {
            "url": "../materiales",
            "type": "GET"
        },
        "columns": [
            { "data": "id" },
            { "data": "nombre" },
            { "data": "categoria.descripcion", name : "categoria.descripcion" },
            { "data": "acabado" },
            { "data": "cantidad" },
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
                        <a class="dropdown-item" href="#" data-edit_material='${row.id}'>Editar</a>
                        <a class="dropdown-item" href="#" data-delete_material='${row.id}' data-nombre='${row.nombre}'>Eliminar</a>
                    </div>`;
                }
            }
        ]
    })
   
    // Agregar un nuevo material
    $("button[data-add_material]")
        .off()
        .click(function () {
            Livewire.emit('agregar');
        });

    // Editar un material
    $(document).on('click', 'a[data-edit_material]', function () {

        let id = $(this).data("edit_material");
        Livewire.emit('editar',id);
        
    })

    // Eliminar material
    $(document).on('click', 'a[data-delete_material]', function () {

        let id = $(this).data("delete_material");
        let nombre = $(this).data("nombre");

        sweetDelete("¿Eliminar material?", `¡Se eliminara el material <b>${nombre}</b>!`, function () {
            loaderIn();
            Livewire.emit('eliminar', id);
        });

    })

    /** Actualiza la tabla de materiales al actulaizar o registrar un material */
    Livewire.on('actualizar_tabla', () =>{
        tablaMateriales.ajax.reload(null,false);
    });


    Livewire.on('abrirModal', () => {
        $("#modalMateriales").modal({backdrop: "static"});
    })

    Livewire.on('sweetAlert', (title, message, icon) => {
        loaderOut();
        Swal.fire(
            title,
            message,
            icon
        )
    })



    /** ================================> Datatables <=========================================  */ 

    // Agregamos nuestro input personalizado para buscar en la datatable
    $("#busqueda").on("keyup search input paste cut", function () {
        tablaMateriales.search(this.value).draw();
    });

    // En realidad esto no hace casi nada (Podria o no estar)
    formBuscar.submit(event => {
        event.preventDefault();
        $("#busqueda").keyup();
    })

    
   
    

});