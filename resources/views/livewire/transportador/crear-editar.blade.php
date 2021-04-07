<div>

    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('message') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form autocomplete="off" id="form-transportadores">

        {{-- Id transportador --}}
        <input type="hidden" name="transportador_id" value="{{$transportador_id}}">

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

        {{-- Apellidos --}}
        <div class="form-group row">
            <div class="col-sm-12">
                <label class="has-float-label">
                    <input wire:model.defer="apellidos" name="apellidos" type="text"
                        class="form-control hide-placeholder @error('apellidos') is-invalid @enderror"
                        placeholder="Apellidos">
                    <span>Apellidos</span>
                </label>
                @error('apellidos')
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
                    class="form-control hide-placeholder @error('correo') is-invalid @enderror" placeholder="Correo">
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
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Cargando...
                </button>
            </div>
        </div>

    </form>


</div>
