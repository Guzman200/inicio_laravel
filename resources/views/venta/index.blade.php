@extends('layouts.app')

@section('styles')


    <!-- Select2 css -->
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <script src="{{asset('plugins/select2/js/select2.full.js')}}"></script>

    <!-- Libreria español de select2 -->
    <script src="{{asset('plugins/select2/js/i18n/es.js')}}"></script>
    @livewireStyles

@endsection

@section('content')
    @livewire('venta.crear-venta')
@endsection

@section('scripts')
    @livewireScripts
@endsection
