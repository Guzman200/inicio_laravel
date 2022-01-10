<div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-body mb-4">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label class="has-float-label">
                                <select class="form-control custom-select hide-placeholder">
                                    @foreach ($clientes as $cliente)
                                        <option {{ $cliente->id == 1 ? 'selected' : ''}} value="{{$cliente->id}}">{{$cliente->nombre}}</option>
                                    @endforeach
                                </select>
                                <span>Cliente</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label class="has-float-label">
                                <select class="form-control custom-select hide-placeholder" disabled>
                                    @foreach ($tipo_ventas as $item)
                                        <option selected value="{{$item->id}}">{{$item->tipo}}</option>
                                    @endforeach
                                </select>
                                <span>Tipo de venta</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <input type="search" class="form-control" placeholder="Buscar producto">
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12 col-md-8">
                        <div class="table-responsive">
                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">Eliminar</th>
                                        <th scope="col">#</th>
                                        <th scope="col">Unidad</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Descripción</th>
                                        <th scope="col">Valor Unitario</th>
                                        <th scope="col">Valor total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <button wire:click="eliminarItem(0)" class="btn btn-sm btn-danger">
                                                <svg class="svg-inline--fa fa-times fa-w-11" aria-hidden="true"
                                                    focusable="false" data-prefix="fas" data-icon="times" role="img"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512"
                                                    data-fa-i2svg="">
                                                    <path fill="currentColor"
                                                        d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z">
                                                    </path>
                                                </svg><!-- <i class="fas fa-times"></i> Font Awesome fontawesome.com -->
                                            </button>
                                        </td>
                                        <th scope="row">1</th>
                                        <td>PIEZA</td>
                                        <td>1000</td>
                                        <td>DEMO</td>
                                        <td>10</td>
                                        <td>10000</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <button wire:click="eliminarItem(0)" class="btn btn-sm btn-danger">
                                                <svg class="svg-inline--fa fa-times fa-w-11" aria-hidden="true"
                                                    focusable="false" data-prefix="fas" data-icon="times" role="img"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512"
                                                    data-fa-i2svg="">
                                                    <path fill="currentColor"
                                                        d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z">
                                                    </path>
                                                </svg><!-- <i class="fas fa-times"></i> Font Awesome fontawesome.com -->
                                            </button>
                                        </td>
                                        <th scope="row">1</th>
                                        <td>PIEZA</td>
                                        <td>1000</td>
                                        <td>DEMO</td>
                                        <td>10</td>
                                        <td>10000</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <button wire:click="eliminarItem(0)" class="btn btn-sm btn-danger">
                                                <svg class="svg-inline--fa fa-times fa-w-11" aria-hidden="true"
                                                    focusable="false" data-prefix="fas" data-icon="times" role="img"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 352 512"
                                                    data-fa-i2svg="">
                                                    <path fill="currentColor"
                                                        d="M242.72 256l100.07-100.07c12.28-12.28 12.28-32.19 0-44.48l-22.24-22.24c-12.28-12.28-32.19-12.28-44.48 0L176 189.28 75.93 89.21c-12.28-12.28-32.19-12.28-44.48 0L9.21 111.45c-12.28 12.28-12.28 32.19 0 44.48L109.28 256 9.21 356.07c-12.28 12.28-12.28 32.19 0 44.48l22.24 22.24c12.28 12.28 32.2 12.28 44.48 0L176 322.72l100.07 100.07c12.28 12.28 32.2 12.28 44.48 0l22.24-22.24c12.28-12.28 12.28-32.19 0-44.48L242.72 256z">
                                                    </path>
                                                </svg><!-- <i class="fas fa-times"></i> Font Awesome fontawesome.com -->
                                            </button>
                                        </td>
                                        <th scope="row">1</th>
                                        <td>PIEZA</td>
                                        <td>1000</td>
                                        <td>DEMO</td>
                                        <td>10</td>
                                        <td>10000</td>
                                    </tr>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="text-left" colspan="5">
                                        </td>
                                        <th class="text-left">
                                            Subtotal
                                        </th>
                                        <td>10000</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left" colspan="5">
                                        </td>
                                        <th class="text-left">
                                            Descuento
                                        </th>
                                        <td>
                                            0
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left" colspan="5">
                                        </td>
                                        <th class="text-left">
                                            Neto
                                        </th>
                                        <td>10000</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left" colspan="5">
                                        </td>
                                        <th class="text-left">
                                            IVA
                                        </th>
                                        <td>0</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left" colspan="5">
                                        </td>
                                        <th class="text-left bg-secondary">
                                            TOTAL
                                        </th>
                                        <th class="bg-secondary">10000</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Total de la venta</label>
                                    <input type="text" class="form-control" placeholder="$0.00" readonly>
                                </div>
                                <div class="form-group">
                                    <label>Total recibo</label>
                                    <input type="text" class="form-control" placeholder="$0.00">
                                </div>
                                <div class="form-group">
                                    <label>Total cambio</label>
                                    <input type="text" class="form-control" placeholder="$0.00" readonly>
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-success btn-block">Generar venta</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
