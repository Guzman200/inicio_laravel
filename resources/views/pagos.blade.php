@extends('layouts.crud')

@section('styles')
    
@endsection

@section('nombre_modulo', 'Pagos')

@section('add_class', 'd-none')

@section('id_tabla', 'tabla_pagos')

@section('cabezeras_tabla')
    <th scope="col">#</th>
    <th scope="col">Fecha en que se debe pagar</th>
    <th scope="col">Fecha en que se pago</th>
    <th scope="col">Estatus</th>
    <th scope="col">Monto</th>
    <th scope="col">Orden de compra</th>
    <th scope="col">Forma de pago</th>
    <th scope="col">Acciones</th>
@endsection



@section('scripts')
    <script src="{{ asset('js/pagos.js') }}"></script>
    @livewireScripts
@endsection
