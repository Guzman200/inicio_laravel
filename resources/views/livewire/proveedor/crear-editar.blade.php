<div>

    <!-- MODAL PROVEEDORES -->
    <div wire:ignore.self class="modal fade" id="modalProveedores" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Crear proveedor</h5>
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

                    <form autocomplete="off" id="form-proveedores">

                        {{-- Id transportador 
                        <input type="hidden" name="proveedor" value="{{ $transportador_id }}">
                        --}}

                        {{-- Nombre --}}
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="has-float-label">
                                    <input wire:model.defer="nombre" name="nombre" type="text"
                                        class="form-control hide-placeholder @error('nombres') is-invalid @enderror"
                                        placeholder="Nombre">
                                    <span>Nombre</span>
                                </label>
                                @error('nombre')
                                    <div class="invalid-feedback text-right d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Dirección --}}
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="has-float-label">
                                    <input wire:model.defer="direccion" name="direccion" type="text"
                                        class="form-control hide-placeholder @error('direccion') is-invalid @enderror"
                                        placeholder="Dirección">
                                    <span>Dirección</span>
                                </label>
                                @error('direccion')
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

                        {{-- Correo --}}
                        <div class="form-group">
                            <label class="has-float-label">
                                <input wire:model.defer="correo" name="correo" type="email"
                                    class="form-control hide-placeholder @error('correo') is-invalid @enderror"
                                    placeholder="Correo">
                                <span>Correo</span>
                            </label>
                            @error('correo')
                                <div class="invalid-feedback text-right d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            <button wire:click.prevent="storeUpdate" wire:loading.remove type="submit"
                                class="btn btn-primary">Guardar</button>

                            <!-- Se muestra mientra se completa la petición -->
                            <div wire:loading.delay wire:target="storeUpdate">
                                <button disabled type="button" class="btn btn-primary">
                                    <span class="spinner-border spinner-border-sm" role="status"
                                        aria-hidden="true"></span>
                                    Cargando...
                                </button>
                            </div>
                        </div>

                    </form>

                </div>

            </div>
        </div>
    </div>


</div>
