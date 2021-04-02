@extends('layouts.app')


@section('content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card border border-info rounded">
                    <div class="card-header bg-info text-primary font-weight-bold">@yield('nombre_modulo')</div>

                    <div class="card-body">

                        <div class="row">

                            <div class="col-12 col-sm-6 col-lg-6 col-xl-4">
                                @include('layouts.fragments.barraBusqueda')
                            </div>

                            <div class="col-12 col-sm-6 col-lg-6 col-xl-8">
                                <div class="row">
                                    <div class="col-12 col-sm-10 offset-sm-2 col-md-12 offset-md-0">
                                        <button class="btn btn-primary float-right mt-1" @yield('data_modal')>
                                            <i class="fas fa-plus-circle mr-1"></i> @yield('nombre_boton')
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>

                        
                        <table id=@yield('id_tabla') class="table table-hover border border-teal rounded">
                            <thead class="bg-teal text-primary font-weight-bold">
                                <tr>
                                    @yield('cabezeras_tabla')
                                </tr>
                            </thead>
                            <tbody class="table-sm">
                    
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>


    @yield('modales')

@endsection




