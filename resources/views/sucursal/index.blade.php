@extends('layouts.crud')

@section('styles')
    @livewireStyles
@endsection

@section('nombre_modulo', 'Sucursales')

@section('data_modal', 'data-add_sucursal=""')

@section('nombre_boton', 'Nueva sucursal')

@section('id_tabla', 'tabla_sucursales')

@section('cabezeras_tabla')
    <th scope="col">#</th>
    <th scope="col">Código</th>
    <th scope="col">Nombre</th>
    <th scope="col">Dirección</th>
    <th scope="col">Teléfono</th>
    <th scope="col">Correo electrónico</th>
    <th scope="col">Acciones</th>
@endsection

@section('componentes_livewire')

    @livewire('sucursal.crear-editar')

@endsection

@section('scripts')
    <script src="{{ asset('js/sucursal/index.js') }}"></script>
    @livewireScripts
@endsection
