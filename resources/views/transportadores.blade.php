@extends('layouts.crud')

@section('styles')
    @livewireStyles
@endsection

@section('nombre_modulo', 'Transportadores')

@section('data_modal', 'data-add_transportador=""')

@section('nombre_boton', 'Nuevo transportador')

@section('id_tabla', 'tabla_transportadores')

@section('cabezeras_tabla')
    <th scope="col">#</th>
    <th scope="col">Nombres</th>
    <th scope="col">Apellidos</th>
    <th scope="col">Telefono</th>
    <th scope="col">Correo</th>
    <th scope="col">Acciones</th>
@endsection

@section('modales')
    {{-- Importacioón de los modales --}}
    @include('modales.transportadores')
@endsection

@section('scripts')
    <script src="{{ asset('js/transportadores.js') }}"></script>
    @livewireScripts
@endsection
