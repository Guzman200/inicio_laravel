@extends('layouts.crud')

@section('styles')
    @livewireStyles
@endsection

@section('nombre_modulo', 'Materiales')

@section('data_modal', 'data-add_material=""')

@section('nombre_boton', 'Nuevo material')

@section('id_tabla', 'tabla_materiales')

@section('cabezeras_tabla')
    <th scope="col">#</th>
    <th scope="col">Material</th>
    <th scope="col">Categoría</th>
    <th scope="col">Acabado</th>
    <th scope="col">Cantidad</th>
    <th scope="col">Acciones</th>
@endsection

@section('modales')
    {{-- Importacioón de los modales --}}
    @include('modales.materiales')
@endsection

@section('scripts')
    <script src="{{ asset('js/materiales.js') }}"></script>
    @livewireScripts
@endsection
