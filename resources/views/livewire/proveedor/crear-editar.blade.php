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

                        {{-- Proveedor --}}
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="has-float-label">
                                    <input wire:model.defer="proveedor" name="proveedor" type="text"
                                        class="form-control hide-placeholder @error('proveedor') is-invalid @enderror"
                                        placeholder="proveedor">
                                    <span>Proveedor</span>
                                </label>
                                @error('proveedor')
                                    <div class="invalid-feedback text-right d-block">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Rut --}}
                        <div class="form-group">
                            <label class="has-float-label">
                                <input wire:model.defer="rut" name="rut" type="text"
                                    class="form-control hide-placeholder @error('rut') is-invalid @enderror"
                                    placeholder="Rut">
                                <span>Rut</span>
                            </label>
                            @error('rut')
                                <div class="invalid-feedback text-right d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Giro --}}
                        <div class="form-group">
                            <label class="has-float-label">
                                <input wire:model.defer="giro" name="giro" type="text"
                                    class="form-control hide-placeholder @error('giro') is-invalid @enderror"
                                    placeholder="giro">
                                <span>Giro</span>
                            </label>
                            @error('giro')
                                <div class="invalid-feedback text-right d-block">{{ $message }}</div>
                            @enderror
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

                        {{-- Contacto --}}
                        <div class="form-group">
                            <label class="has-float-label">
                                <input wire:model.defer="contacto" name="contacto" type="text"
                                    class="form-control hide-placeholder @error('contacto') is-invalid @enderror"
                                    placeholder="contacto">
                                <span>Contacto</span>
                            </label>
                            @error('contacto')
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
