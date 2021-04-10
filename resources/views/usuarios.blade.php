@extends('layouts.crud')

@section('styles')
    @livewireStyles
@endsection

@section('nombre_modulo', 'Usuarios')

@section('data_modal', 'data-add_usuario=""')

@section('nombre_boton', 'Nuevo usuario')

@section('id_tabla', 'tabla_usuarios')

@section('cabezeras_tabla')
    <th scope="col">#</th>
    <th scope="col">Nombre</th>
    <th scope="col">Telefono</th>
    <th scope="col">Correo</th>
    <th scope="col">Estatus</th>
    <th scope="col">Acciones</th>
@endsection

@section('componentes_livewire')

    {{-- Editar crear usuarios --}}
    @livewire('usuario.crear-editar')
    
@endsection

@section('scripts')
    <script src="{{ asset('js/usuarios.js') }}"></script>
    @livewireScripts
@endsection
