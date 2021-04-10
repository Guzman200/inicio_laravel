@extends('layouts.login')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">Registro</div>

                <div class="card-body">
                    <form id="form-registro">
                        @csrf

                        

                        <div class="form-group">
                           
                            <label class="has-float-label">
                                <input type="text" class="form-control hide-placeholder" name="nombres" required autofocus autocomplete="off" placeholder="Nombres">
                                <span>Nombres</span>
                            </label>

                        </div>

                        <div class="form-group">
                           
                            <label class="has-float-label">
                                <input type="text" class="form-control hide-placeholder" name="ap_paterno" required autocomplete="off" placeholder="Apellido paterno">
                                <span>Apellido paterno</span>
                            </label>

                        </div>

                        <div class="form-group">
                           
                            <label class="has-float-label">
                                <input type="text" class="form-control hide-placeholder" name="ap_materno" required autocomplete="off" placeholder="Apellido materno">
                                <span>Apellido materno</span>
                            </label>

                        </div>

                        <div class="form-group">
                           
                            <label class="has-float-label">
                                <input type="text" class="form-control hide-placeholder" name="telefono" autocomplete="off" placeholder="Teléfono">
                                <span>Teléfono</span>
                            </label>

                        </div>

                        <div class="form-group">
                            
                            <label class="has-float-label">
                                <input id="email" type="email" class="form-control hide-placeholder" name="email" required autocomplete="email" placeholder="Email">
                                <span>Email</span>
                            </label>

                        </div>

                        <div class="form-group">
                           
                            <label class="has-float-label">
                                <input type="text" class="form-control hide-placeholder" name="nombre_usuario" required autocomplete="off" placeholder="Usuario">
                                <span>Usuario</span>
                            </label>

                        </div>

                        <div class="form-group">
                            <label class="has-float-label">
                                <input id="password" type="password" class="form-control hide-placeholder" name="password" required autocomplete="new-password" placeholder="Contraseña">
                                <span>Contraseña</span>
                            </label>
                               
                        </div>

                        <div class="form-group">
                            

                            <label class="has-float-label">
                                <input id="password-confirm" type="password" class="form-control hide-placeholder" name="password_confirmation" required autocomplete="new-password" placeholder="Confirmación">
                                <span>Confirmación</span>
                            </label>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrarse
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="{{asset('js/register.js')}}"></script>
@endsection
