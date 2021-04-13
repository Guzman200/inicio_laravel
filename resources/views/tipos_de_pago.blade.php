@extends('layouts.crud')

@section('styles')
    @livewireStyles
@endsection

@section('nombre_modulo', 'Formas de pago')

@section('data_modal', 'data-add_forma_pago=""')

@section('nombre_boton', 'Nuevo forma de pago')

@section('id_tabla', 'tabla_formas_de_pago')

@section('cabezeras_tabla')
    <th scope="col">#</th>
    <th scope="col">Forma de pago</th>
    <th scope="col">Acciones</th>
@endsection

@section('componentes_livewire')
    @livewire('tipo-pago.crear-editar') 
@endsection

@section('scripts')
    <script src="{{ asset('js/formas_pago.js') }}"></script>
    @livewireScripts
@endsection
