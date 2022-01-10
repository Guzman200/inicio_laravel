@extends('layouts.crud')

@section('styles')
    @livewireStyles
@endsection

@section('nombre_modulo', 'Clientes')

@section('data_modal', 'data-add_cliente=""')

@section('nombre_boton', 'Nuevo cliente')

@section('id_tabla', 'tabla_clientes')

@section('cabezeras_tabla')
    <th scope="col">#</th>
    <th scope="col">Nombre</th>
    <th scope="col">Teléfono</th>
    <th scope="col">Correo</th>
    <th scope="col">Dirección</th>
    <th scope="col">Fecha de cumpleaños</th>
    <th scope="col">Acciones</th>
@endsection

@section('componentes_livewire')

    @livewire('cliente.crear-editar')

@endsection

@section('scripts')
    <script src="{{ mix('js/cliente/index.js') }}"></script>
    @livewireScripts
@endsection
