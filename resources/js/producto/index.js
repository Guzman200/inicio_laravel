import Swal from "sweetalert2";
import {  loaderIn, loaderOut, responseAxios, sweetDelete, datatablesJSON, sweetInfo } from "./../helpers";


$(document).ready(() => {

    const formBuscar = $("#form-busqueda");
    
    let tablaProductos;  

    // Inicializamos la tabla sucursales
    tablaProductos = $("#tabla_productos").DataTable({
        "responsive": true,
        "autoWidth": false,
        "serverSide": true,
        "language": datatablesJSON, // Se traduce la datatables a español
        "lengthChange": false, // Ocultamos el paginado
        "ajax": {
            "url": "../productos",
            "type": "GET"
        },
        "columns": [
            { "data": "id" },
            { "data": "codigo" },
            { "data": "nombre" },
            { "data": "categoria.nombre" },
            { "data": "precio_venta", visible : false },
            { "data": "precio_venta_render"},
            { "data": "stock_en_dinero", visible : false },
            { "data": "stock_en_dinero_render"},
            { "data": "stock", visible : false },
            { "data": "stock_render" },
            { "data": "quiebre_stock" },
            { "defaultContent" : ""}
        ],
        "columnDefs": [
            {
                "targets": 11,
                "render": function ( data, type, row ) {
                    return ` 
                    <button class="btn btn-sm" type="button" 
                            data-toggle="dropdown"  aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <a class="dropdown-item" href="#" data-edit_sucursal='${row.id}'>Editar</a>
                        <a class="dropdown-item" href="#" data-delete_sucursal='${row.id}' data-sucursal='${row.nombre}'>Eliminar</a>
                    </div>`;
                }
            }
        ]
    })

    
    // Agregar un nuevo proveedor
    $("button[data-add_sucursal]")
        .off()
        .click(function () {
            Livewire.emit('agregar');
        });


    // Editar un proveedor
    $(document).on('click', 'a[data-edit_sucursal]', function () {

        let id = $(this).data("edit_sucursal");
        Livewire.emit('editar',id);
        
    })

    // Eliminar sucursal
    $(document).on('click', 'a[data-delete_sucursal]', function () {

        let id = $(this).data("delete_sucursal");
        let sucursal = $(this).data("sucursal");

        sweetDelete("¿Eliminar sucursal?", `¡Se eliminara la sucursal <b>${sucursal}</b>!`, function () {
            Livewire.emit('eliminar', id);
        });

    })


    /** Actualiza la tabla de transportadores al actulaizar o registrar un proveedor */
    Livewire.on('actualizar_tabla', () =>{
        tablaSucursales.ajax.reload(null,false);
    });


    Livewire.on('abrirModal', () => {
        $("#modalSucursales").modal({backdrop: "static"});
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
        tablaProductos.search(this.value).draw();
    });

    // En realidad esto no hace casi nada (Podria o no estar)
    formBuscar.submit(event => {
        event.preventDefault();
        $("#busqueda").keyup();
    })
    

});