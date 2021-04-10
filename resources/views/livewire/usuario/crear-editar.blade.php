<div>

    <!-- MODAL USUARIOS -->
    <div wire:ignore.self class="modal fade" id="modalUsuarios" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">{{ $this->usuario_id ? 'Editar usuario' : 'Crear Usuario'}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">

                    @if (session()->has('message'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <strong>{{ session('message') }}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form autocomplete="off" id="form-usuarios">


                        {{-- Nombres --}}
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="has-float-label">
                                    <input wire:model.defer="nombres" name="nombres" type="text"
                                        class="form-control hide-placeholder @error('nombres') is-invalid @enderror"
                                        placeholder="Nombres">
                                    <span>Nombres</span>
                                </label>
                                @error('nombres')
                                    <div class="invalid-feedback text-right d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Apellido paterno --}}
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="has-float-label">
                                    <input wire:model.defer="ap_paterno" type="text"
                                        class="form-control hide-placeholder @error('ap_paterno') is-invalid @enderror"
                                        placeholder="Apellido paterno">
                                    <span>Apellido peterno</span>
                                </label>
                                @error('ap_paterno')
                                    <div class="invalid-feedback text-right d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Apellido materno --}}
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="has-float-label">
                                    <input wire:model.defer="ap_materno" type="text"
                                        class="form-control hide-placeholder @error('ap_materno') is-invalid @enderror"
                                        placeholder="Apellido materno">
                                    <span>Apellido meterno</span>
                                </label>
                                @error('ap_materno')
                                    <div class="invalid-feedback text-right d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Teléfono --}}
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="has-float-label">
                                    <input wire:model.defer="telefono" name="telefono" type="text"
                                        class="form-control hide-placeholder @error('telefono') is-invalid @enderror"
                                        placeholder="Teléfono">
                                    <span>Teléfono</span>
                                </label>
                                @error('telefono')
                                    <div class="invalid-feedback text-right d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Email --}}
                        <div class="form-group">
                            <label class="has-float-label">
                                <input wire:model.defer="email" type="email"
                                    class="form-control hide-placeholder @error('email') is-invalid @enderror"
                                    placeholder="Email">
                                <span>Email</span>
                            </label>
                            @error('email')
                                <div class="invalid-feedback text-right d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Usuario --}}
                        <div class="form-group">
                            <label class="has-float-label">
                                <input wire:model.defer="nombre_usuario" type="text"
                                    class="form-control hide-placeholder @error('nombre_usuario') is-invalid @enderror"
                                    placeholder="Email">
                                <span>Usuario</span>
                            </label>
                            @error('nombre_usuario')
                                <div class="invalid-feedback text-right d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Contraseña --}}
                        <div class="form-group">
                            <label class="has-float-label">
                                <input wire:model.defer="password" type="password"
                                    class="form-control hide-placeholder @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="new-password" placeholder="Contraseña">
                                <span>Contraseña</span>
                            </label>
                            @error('password')
                                <div class="invalid-feedback text-right d-block">{{ $message }}</div>
                            @enderror

                        </div>

                        {{-- Confirmación de contraseña --}}
                        <div class="form-group">
                            <label class="has-float-label">
                                <input wire:model.defer="password_confirmation" type="password"
                                    class="form-control hide-placeholder @error('password_confirmation') is-invalid @enderror"
                                    name="password_confirmation" required autocomplete="new-password"
                                    placeholder="Confirmación">
                                <span>Confirmación contraseña</span>
                            </label>
                            @error('password_confirmation')
                                <div class="invalid-feedback text-right d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button wire:click.prevent="storeUpdate" wire:loading.remove type="submit"
                                class="btn btn-primary">{{ $this->usuario_id ? 'Guardar cambios' : 'Guardar'}}</button>

                            <!-- Se muestra mientra se completa la petición -->
                            <div wire:loading.delay wire:target="storeUpdate">
                                <button disabled type="button" class="btn btn-primary">
                                    <span class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span>
                                    {{ $this->usuario_id ? 'Guardando cambios ...' : 'Guardando ...'}}
                                </button>
                            </div>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>


</div>
