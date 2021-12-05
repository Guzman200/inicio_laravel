@extends('layouts.crud')

@section('styles')
    @livewireStyles
@endsection

@section('nombre_modulo', 'Productos')

@section('data_modal', 'data-add_producto=""')

@section('nombre_boton', 'Nuevo producto')

@section('id_tabla', 'tabla_productos')

@section('cabezeras_tabla')
    <th scope="col">#</th>
    <th scope="col">Código</th>
    <th scope="col">Nombre</th>
    <th scope="col">Categoría</th>
    <th scope="col">Precio de venta</th>
    <th scope="col">Precio de venta</th> <!-- render -->
    <th scope="col">Stock en dinero</th>
    <th scope="col">Stock en dinero</th> <!-- render -->
    <th scope="col">Stock</th>
    <th scope="col">Stock</th>  <!-- render -->
    <th scope="col">Quiebre de stock</th>
    <th scope="col">Acciones</th>
@endsection

@section('componentes_livewire')

    {{--@livewire('sucursal.crear-editar')--}}

@endsection

@section('scripts')
    <script src="{{ mix('js/producto/index.js') }}"></script>
    @livewireScripts
@endsection
