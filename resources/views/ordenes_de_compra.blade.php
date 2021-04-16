@extends('layouts.crud')

@section('styles')
    @livewireStyles
@endsection

@section('nombre_modulo', 'Ordenes de compra')

@section('data_modal', 'data-add_orden_de_compra=""')

@section('nombre_boton', 'Nueva orden de compra')

@section('id_tabla', 'tabla_ordenes_de_compra')

@section('cabezeras_tabla')
    <th scope="col">#</th>
    <th scope="col">Proyecto</th>
    <th scope="col">Centro de costo</th>
    <th scope="col">Cotización</th>
    <th scope="col">Número de pagos</th>
    <th scope="col">Pagos</th>
    <th scope="col">Número de facturas</th>
    <th scope="col">Total</th>
    <th scope="col">Acciones</th>
@endsection

@section('componentes_livewire')

    @livewire('orden-compra.crear')
    @livewire('orden-compra.ver-detalle')

@endsection

@section('scripts')
    <script src="{{ asset('js/orden_de_compra.js') }}"></script>
    @livewireScripts
@endsection
