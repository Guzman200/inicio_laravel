<div>
    <div class="container-fluid">

        {{-- CLIENTE Y TIPO DE VENTA --}}
        <div class="card">
            <div class="card-body mb-4">
                <div class="row">
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <select id="selectCliente" class="form-control">
                                @foreach ($clientes as $cliente)
                                    <option {{ $cliente->id == 1 ? 'selected' : '' }} value="{{ $cliente->id }}">
                                        {{ $cliente->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <div class="form-group">
                            <label class="has-float-label">
                                <select class="form-control custom-select hide-placeholder" disabled>
                                    @foreach ($tipo_ventas as $item)
                                        <option selected value="{{ $item->id }}">{{ $item->tipo }}</option>
                                    @endforeach
                                </select>
                                <span>Tipo de venta</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- BUSCADOR Y TABLA DE PRODUCTO AGREGADOS A LA VENTA --}}
        <div class="card">
            <div class="card-body">
                {{-- BUSCADOR DE PRODUCTOS --}}
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <input wire:model.debounce.500ms="search" type="search" class="form-control"
                                placeholder="Buscar producto">
                        </div>
                        @if (count($arrayProductos) > 0)
                            <table class="table table-sm table-hover">
                                <thead>
                                    <tr>
                                        <th>Productos encontrados</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($arrayProductos as $item)
                                        <tr>
                                            <td wire:click="agregarProducto('{{ $item['codigo'] }}','{{ $item['nombre'] }}', {{ $item['precio_venta'] }}, 1)"
                                                style="cursor: pointer;">{{ $item['codigo'] }} - {{ $item['nombre'] }}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </ul>
                                </tbody>
                            </table>
                        @endif
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
                                        <th scope="col">Descripción</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Descuento %</th>
                                        <th scope="col">Valor Unitario</th>
                                        <th scope="col">Valor total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($productosAgregados as $key => $item)
                                        <tr>
                                            <td>
                                                <button wire:click="eliminarProducto({{ $key }})"
                                                    class="btn btn-sm btn-danger" title="Eliminar producto de la lista">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </td>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>{{ $item['nombre'] }}</td>
                                            <td>
                                                <!-- data-render es usado para forzar el render de este input (solo para ese fin) -->
                                                <input data-render="{{ rand() }}"
                                                    data-cantidad="{{ $item['cantidad'] }}"
                                                    data-key="{{ $key }}" type="number"
                                                    value="{{ $item['cantidad'] }}" class="form-control inputCantidad">
                                            </td>
                                            <td>
                                                <input data-render="{{ rand() }}"
                                                    data-descuento="{{ $item['descuento'] }}"
                                                    data-key="{{ $key }}" type="number"
                                                    value="{{ $item['descuento'] }}"
                                                    class="form-control inputDescuento">
                                            </td>
                                            <td>${{ number_format($item['precio'], 2, '.', ',') }}</td>
                                            <td>${{ number_format($item['total'], 2, '.', ',') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td class="text-left" colspan="4">
                                        </td>
                                        <th class="text-left">
                                            Subtotal
                                        </th>
                                        <td>${{ number_format(array_sum(array_column($productosAgregados, 'total_sin_descuento')), 2, '.', ',') }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-left" colspan="4">
                                        </td>
                                        <th class="text-left">
                                            Descuento
                                        </th>
                                        <td>
                                            ${{ number_format(array_sum(array_column($productosAgregados, 'descuento_en_pesos')), 2, '.', ',') }}
                                        </td>
                                    </tr>
                                    <!--<tr>
                                        <td class="text-left" colspan="4">
                                        </td>
                                        <th class="text-left">
                                            Neto
                                        </th>
                                        <td>10000</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left" colspan="4">
                                        </td>
                                        <th class="text-left">
                                            IVA
                                        </th>
                                        <td>0</td>
                                    </tr>
                                    -->
                                    <tr>
                                        <td class="text-left" colspan="4">
                                        </td>
                                        <th class="text-left bg-secondary">
                                            TOTAL
                                        </th>
                                        <th class="bg-secondary">
                                            ${{ number_format(array_sum(array_column($productosAgregados, 'total')), 2, '.', ',') }}
                                        </th>
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
                                    <input type="text" class="form-control" placeholder="$0.00" readonly
                                        value="${{ number_format(array_sum(array_column($productosAgregados, 'total')), 2, '.', ',') }}">
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

<script>
    $(document).ready(function() {

        $('#selectCliente').select2({
            language: "es",
            tags: false,
            placeholder: "Selecciona un cliente",
            width: '100%',
            theme: 'bootstrap4'
        });

        /* Para poner el focus en el search de busqueda del select2 */
        $(document).on('select2:open', () => {
            document.querySelector('.select2-search__field').focus();
        });

        /* Modificando cantiddd de productos */
        $(document).on('change', '.inputCantidad', function(event) {

            let key = $(this).data('key'); // key del producto en el array de producto agregados
            let cantidad_anterior = event.target.getAttribute("data-cantidad");
            let cantidad = event.target.value;

            if (cantidad == "" || cantidad == "0" || cantidad == 0) {
                Livewire.emit('updateCantidad', key, cantidad_anterior);
                console.log('Old cantidad');
            } else {
                Livewire.emit('updateCantidad', key, cantidad);
                console.log('New cantidad');
            }
        });

        /** Modificando descuento de productos */
        $(document).on('change', '.inputDescuento', function(event) {

            let key = $(this).data('key'); // key del producto en el array de producto agregados
            let descuento_anterior = event.target.getAttribute("data-descuento");
            let descuento = event.target.value;

            if (descuento == "" || descuento == undefined) {
                Livewire.emit('updateDescuento', key, descuento_anterior);
                console.log('Old descuento');
            } else {

                if(Number(descuento) >= 0 && Number(descuento) <= 100){
                    Livewire.emit('updateDescuento', key, descuento);
                    console.log('New descuento');
                }else{
                    Livewire.emit('updateDescuento', key, descuento_anterior);
                    console.log('Old descuento');
                }
                
            }
        });

    })

</script>
