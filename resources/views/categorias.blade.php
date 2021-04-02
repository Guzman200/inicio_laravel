@extends('layouts.crud')

@section('styles')
    @livewireStyles
@endsection

@section('nombre_modulo', 'Categorías')

@section('data_modal', 'data-add_categoria=""')

@section('nombre_boton', 'Nueva categoría')

@section('id_tabla', 'tabla_categorias')

@section('cabezeras_tabla')
    <th scope="col">#</th>
    <th scope="col">Descripción</th>
    <th scope="col">Acciones</th>
@endsection

@section('modales')
    {{-- Importacioón de los modales --}}
    @include('modales.categorias')
@endsection

@section('scripts')
    <script src="{{ asset('js/categorias.js') }}"></script>
    @livewireScripts
@endsection
