@extends('layouts.crud')

@section('styles')
    @livewireStyles
@endsection

@section('nombre_modulo', 'Categorias')

@section('data_modal', 'data-add_categoria=""')

@section('nombre_boton', 'Nueva categoría')

@section('id_tabla', 'tabla_categorias')

@section('cabezeras_tabla')
    <th scope="col">#</th>
    <th scope="col">Código</th>
    <th scope="col">Nombre</th>
    <th scope="col">Productos</th>
    <th scope="col">Acciones</th>
@endsection

@section('componentes_livewire')

    @livewire('categoria.crear-editar')

@endsection

@section('scripts')
    <script src="{{ mix('js/categoria/index.js') }}"></script>
    @livewireScripts
@endsection
