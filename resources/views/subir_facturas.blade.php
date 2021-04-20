@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dropzone.css') }}">
@endsection

@section('content')


    <div class="card border border-info rounded">
        <div class="card-header bg-info text-primary font-weight-bold">
            Adjuntar facturas a la orden de compra #{{ $orden->id }}
        </div>
        <div class="card-body">

            <!-- Adjuntar facturas a la orden de compra -->
            <form   action="{{ route('subirFacturasPOST', ['orden' => $orden->id]) }}" 
                    enctype="multipart/form-data"
                    method="POST" 
                    class="dropzone" 
                    id="my-awesome-dropzone">

                @csrf
            </form>

        </div>
    </div>




@endsection

@section('scripts')
    <script src="{{ asset('js/dropzone.js') }}"></script>

    <script>

        Dropzone.options.myAwesomeDropzone = {
            //autoProcessQueue : false, // evitar que se suban los archivos solo al seleccinarlos 
            dictDefaultMessage : "¡ Arrastra las facturas a esta zona ó da click aquí !",
            acceptedFiles : "application/pdf"
        }
    
    </script>
@endsection
