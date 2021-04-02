@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Home</div>

                    <div class="card-body">

                        <div class="alert alert-success" role="alert">
                            Bienvendio al sistema (aun estamos en desarrollo)!
                        </div>

                        <p>

                            <button class="btn btn-primary" type="button" data-toggle="collapse"
                                data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                Datos de la empresa
                            </button>
                        </p>
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">

                                {{-- Formulario datos de la empresa --}}
                                <form autocomplete="off" id="form-datos_empresa">

                                    {{-- Nombre --}}
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="has-float-label">
                                                <input name="nombre" type="text"
                                                    class="form-control hide-placeholder" placeholder="Nombre">
                                                <span>Nombre</span>
                                            </label>
                                        </div>
                                    </div>

                                    {{-- Dirección --}}
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="has-float-label">
                                                <input name="direccion" type="text"
                                                    class="form-control hide-placeholder" placeholder="Dirección">
                                                <span>Dirección</span>
                                            </label>
                                        </div>
                                    </div>

                                    {{-- Correo --}}
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="has-float-label">
                                                <input name="correo" type="email"
                                                    class="form-control hide-placeholder" placeholder="Correo">
                                                <span>Correo</span>
                                            </label>
                                        </div>
                                    </div>

                                    {{-- Teléfono --}}
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="has-float-label">
                                                <input name="telefono" type="text"
                                                    class="form-control hide-placeholder" placeholder="Teléfono">
                                                <span>Teléfono</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="custom-file">
                                                <input type="file" accept="image/*" class="custom-file-input form-control" id="customFile">
                                                <label class="custom-file-label" for="customFile">Elige un logo</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary form-control">Actualizar datos</button>
                                    </div>

                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')



@endsection
