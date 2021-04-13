<div>

    <!-- MODAL FORMAS DE PAGO -->
    <div wire:ignore.self class="modal fade" id="modalFormasDePago" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Crear forma de pago</h5>
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

                    <form autocomplete="off" id="form-tipos_pago">

                        {{-- Descripción --}}
                        <div class="form-group row">
                            <div class="col-sm-12">
                                <label class="has-float-label">
                                    <input wire:model.defer="descripcion" name="descripcion" type="text"
                                        class="form-control hide-placeholder @error('descripcion') is-invalid @enderror" placeholder="Forma de pago">
                                    <span>Forma de pago</span>
                                </label>
                                @error('descripcion')
                                    <div class="invalid-feedback text-right d-block">{{ $message }}</div>
                                @enderror
                            </div>
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
