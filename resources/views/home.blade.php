@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        {{-- <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Home</div>

                    <div class="card-body">

                        <div class="alert alert-success" role="alert">
                            Bienvendio al sistema (aun estamos en desarrollo)!
                        </div>

                        <p>

                            <button class="btn btn-primary" type="button" data-toggle="collapse"
                                data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                                Datos de la empresa
                            </button>
                        </p>
                        <div class="collapse" id="collapseExample">
                            <div class="card card-body">

                                {{-- Formulario datos de la empresa 
                                <form autocomplete="off" id="form-datos_empresa">

                                    {{-- Nombre -
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="has-float-label">
                                                <input name="nombre" type="text" class="form-control hide-placeholder"
                                                    placeholder="Nombre">
                                                <span>Nombre</span>
                                            </label>
                                        </div>
                                    </div>

                                    {{-- Dirección 
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="has-float-label">
                                                <input name="direccion" type="text" class="form-control hide-placeholder"
                                                    placeholder="Dirección">
                                                <span>Dirección</span>
                                            </label>
                                        </div>
                                    </div>

                                    {{-- Correo 
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="has-float-label">
                                                <input name="correo" type="email" class="form-control hide-placeholder"
                                                    placeholder="Correo">
                                                <span>Correo</span>
                                            </label>
                                        </div>
                                    </div>

                                    {{-- Teléfono 
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label class="has-float-label">
                                                <input name="telefono" type="text" class="form-control hide-placeholder"
                                                    placeholder="Teléfono">
                                                <span>Teléfono</span>
                                            </label>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <div class="custom-file">
                                                <input type="file" accept="image/*" class="custom-file-input form-control"
                                                    id="customFile">
                                                <label class="custom-file-label" for="customFile">Elige un logo</label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary form-control">Actualizar datos</button>
                                    </div>

                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div> --}}

        <div class="row">

            <!-- PAGOS PENDIENTES -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-donate"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Pagos pendientes</span>
                        <span class="info-box-number">
                            {{ $pagos_pendientes }}
                        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->


            <!-- PROVEEDORES -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-truck"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Proveedores</span>
                        <span class="info-box-number">{{ $proveedores }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <!-- ORDENES DE COMPRA -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Ordenes de compra</span>
                        <span class="info-box-number">{{ $ordenes }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- USUARIOS -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Usuarios activos</span>
                        <span class="info-box-number">{{ $usuarios }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>


        <!-- GRAFICA ORDENES DE COMPRA -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Ordenes de compra</h5>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <div class="btn-group">
                                <button type="button" class="btn btn-tool dropdown-toggle" data-toggle="dropdown">
                                    <i class="fas fa-wrench"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" role="menu">
                                    <a href="#" class="dropdown-item">Action</a>
                                    <a href="#" class="dropdown-item">Another action</a>
                                    <a href="#" class="dropdown-item">Something else here</a>
                                    <a class="dropdown-divider"></a>
                                    <a href="#" class="dropdown-item">Separated link</a>
                                </div>
                            </div>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p class="text-center">
                                    <strong>Ordenes de compra: {{ date('Y') }}</strong>
                                </p>

                                <div class="chart">
                                    <!-- Ordenes de compra Chart Canvas -->
                                    <canvas id="ordenesChart" height="180" style="height: 180px;"></canvas>
                                </div>
                                <!-- /.chart-responsive -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->


        <!-- ULTIMAS ORDENES DE COMPRA -->
        <div class="row">

            <div class="col-12 col-md-6">
                <div class="card">
                    <div class="card-header border-transparent">
                        <h3 class="card-title">Ultimas ordenes de compra</h3>

                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table m-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Proyecto</th>
                                        <th>Status</th>
                                        <th>Popularity</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($ordenes_compra as $item)
                                        <tr>
                                            <td><a href="#">{{$item->id}}</a></td>
                                            <td>{{$item->proyecto}}</td>
                                            <td>
                                                @if ($item->status == "por pagar")
                                                    <span class="badge badge-warning">Por pagar</span>
                                                @else
                                                    <span class="badge badge-success">Pagada</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="sparkbar" data-color="#00a65a" data-height="20">
                                                    {{$item->total}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                        <a href="{{route('ordenes_compra')}}" class="btn btn-sm btn-secondary float-right">Ver todas las ordenes</a>
                    </div>
                    <!-- /.card-footer -->
                </div>
            </div>

        </div>

    </div>
@endsection

@section('scripts')

    <script src="{{ asset('js/home.js') }}"></script>

@endsection
