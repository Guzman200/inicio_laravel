@extends('layouts.crud')

@section('styles')
    @livewireStyles
@endsection

@section('nombre_modulo', 'Proveedores')

@section('data_modal', 'data-add_proveedor=""')

@section('nombre_boton', 'Nuevo proveedor')

@section('id_tabla', 'tabla_proveedores')

@section('cabezeras_tabla')
    <th scope="col">#</th>
    <th scope="col">Proveedor</th>
    <th scope="col">Rut</th>
    <th scope="col">Giro</th>
    <th scope="col">Dirección</th>
    <th scope="col">Telefono</th>
    <th scope="col">Contacto</th>
    <th scope="col">Acciones</th>
@endsection

@section('componentes_livewire')

    @livewire('proveedor.crear-editar')

@endsection

@section('scripts')
    <script src="{{ asset('js/proveedores.js') }}"></script>
    @livewireScripts
@endsection
