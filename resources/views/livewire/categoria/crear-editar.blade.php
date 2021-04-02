<div>

    @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('message')}}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <form autocomplete="off" id="form-categorias">
    
        {{-- Descripción --}}
        <div class="form-group row">
            <div class="col-sm-12">
                <label class="has-float-label">
                    <input wire:model.defer="descripcion" name="descripcion" type="text" class="form-control hide-placeholder" placeholder="Descripción">
                    <span>Descripción</span>
                </label>
                @if ($errors->has('descripcion'))
                <small class="form-text text-danger">{{ $errors->first('nombres') }}</small>
                @endif
            </div>
        </div>
        

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>

    </form>


</div>
