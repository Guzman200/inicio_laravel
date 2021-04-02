<div>

    
    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{ session('message') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form autocomplete="off" id="form-materiales">

        {{-- Nombre --}}
        <div class="form-group row">
            <div class="col-sm-12">
                <label class="has-float-label">
                    <input  wire:model.defer="nombre" name="nombre" type="text" 
                            class="form-control hide-placeholder @error('nombre') is-invalid @enderror"
                            placeholder="Nombre">
                    <span>Nombre</span>
                </label>
                @error('nombre')
                    <div class="invalid-feedback text-right d-block">{{$message}}</div>
                @enderror
            </div>
            
        </div>

        {{-- Categoria del material --}}
        <div class="form-group row">
            <div class="col-sm-12">
                <label class="has-float-label">
                    <select wire:model.defer="categoria_id" name="categoria_id" 
                            class="form-control hide-placeholder custom-select @error('categoria_id') is-invalid @enderror">
                        <option value="">Selecciona una categoría</option>
                        @foreach ($categorias as $item)
                            <option value="{{ $item->id }}">{{ $item->descripcion }}</option>
                        @endforeach
                    </select>
                    <span>Categoría</span>
                </label>
                @error('categoria_id')
                    <div class="invalid-feedback text-right d-block">{{$message}}</div>
                @enderror
            </div>
        </div>

        {{-- Acabado --}}
        <div class="form-group row">
            <div class="col-sm-12">
                <label class="has-float-label">
                    <input wire:model.defer="acabado" name="acabado" type="text" 
                           class="form-control hide-placeholder @error('acabado') is-invalid @enderror"
                        placeholder="Acabado">
                    <span>Acabado</span>
                </label>
                @error('acabado')
                    <div class="invalid-feedback text-right d-block">{{$message}}</div>
                @enderror
            </div>
        </div>

        {{-- Cantidad --}}
        <div class="form-group">
            <label class="has-float-label">
                <input wire:model.defer="cantidad" name="cantidad" type="number" 
                       class="form-control hide-placeholder @error('cantidad') is-invalid @enderror"
                    placeholder="Cantidad">
                <span>Cantidad</span>
            </label>
            @error('cantidad')
                <div class="invalid-feedback text-right d-block">{{$message}}</div>
            @enderror
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button wire:click.prevent="storeUpdate" wire:loading.remove type="submit" 
                    class="btn btn-primary">Guardar
            </button>

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
