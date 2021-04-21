<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.css') }}">

    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">

    <!-- Estilos de la app -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Scripts de la app -->
    <script src="{{ asset('js/app.js') }}"></script>

    <style>
        {{-- Oculta el input search del datatable --}} 
        .dataTables_filter {
            display: none;
        }

        {{-- Hace mas delgado la etiqueta span de los input float --}}
        label:not(.form-check-label):not(.custom-file-label) {
            font-weight: 300 !important;
        }
    </style>

    @yield('styles')


</head>

<body class="hold-transition sidebar-mini sidebar-closed layout-fixed text-sm">

    <div class="wrapper">

        <!-- Barra de navegación -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>


            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">

                <!-- Perfil de usuario (Cierre de sesion) -->
                <li class="nav-item dropdown">
                    <a class="nav-link ml-4 mb-2" data-toggle="dropdown" href="#">

                        <button class="btn btn-sm btn-primary">
                            <span class="fas fa-user"></span>
                            {{ auth()->user()->nombres }}
                        </button>

                    </a>

                    <div class="dropdown-menu dropdown-menu-right">
                        <div class="dropdown-item text-center">
                            <img id="imgPerfil" 
                                style="width: 70px; height: 70px" 
                                data-img_perfil=""
                                class="rounded-circle"  
                                @if (true) 
                                src="https://ui-avatars.com/api/?name={{ auth()->user()->nombres }}&background=0275d8&color=fff" 
                                @else
                                src="{{ asset('uploads/' . auth()->user()->img_perfil) }}" @endif
                                alt="img-perfil">
                            <small class="form-text text-muted">{{ auth()->user()->name }}</small>
                        </div>
                        <a class="dropdown-item" href="#" data-toggle="modal"
                            data-target="#modalCambiarContraseña">Cambiar contraseña</a>
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalPerfilUsuario">Mi
                            perfil de usuario</a>
                        <div role="separator" class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-logout>Cerrar sesión</a>
                    </div>

                </li>


            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{route('home')}}" class="brand-link">
                <img src="{{asset("dist/img/AdminLTELogo.png")}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">Sistema</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="{{asset("dist/img/user2-160x160.jpg")}}" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">Pedro Guzmán</a>
                    </div>
                </div>

                <!-- Formualario busqueda de modulos -->
                <div class="form-inline">
                    <div class="input-group" data-widget="sidebar-search">
                        <input class="form-control form-control-sidebar" type="search" placeholder="Search"
                            aria-label="Search">
                        <div class="input-group-append">
                            <button class="btn btn-sidebar">
                                <i class="fas fa-search fa-fw"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- MODULOS -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                        <li class="nav-item menu-open">
                            <a href="{{route('home')}}" class="nav-link {{request()->is('/') ? 'active' : ''}}">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Inicio
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('ordenes_compra')}}" class="nav-link {{request()->is('ordenes_compra') ? 'active' : ''}}">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <!-- fas fa-file-invoice-dollar -->
                                <p>
                                    Ordenes de compra
                                    <span class="right badge badge-danger">New</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('pagos')}}" class="nav-link {{request()->is('pagos') ? 'active' : ''}}">
                                <i class="nav-icon fas fa-donate"></i>
                                <p>
                                    Pagos
                                    <span class="right badge badge-danger">New</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('proveedores')}}" class="nav-link {{request()->is('proveedores') ? 'active' : ''}}">
                                <i class="nav-icon fas fa-truck"></i>
                                <p>
                                    Proveedores
                                    <span class="right badge badge-danger">New</span>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('formas_pago')}}" class="nav-link {{request()->is('formas_pago') ? 'active' : ''}}">
                                <i class="nav-icon fas fa-wallet"></i>
                                <p>
                                    Formas de pago
                                    <span class="right badge badge-danger">New</span>
                                </p>
                            </a>
                        </li>
                        
                        <li class="nav-item">
                            <a href="{{route('usuarios')}}" class="nav-link {{request()->is('usuarios') ? 'active' : ''}}">
                                <i class="nav-icon fas fa-users"></i>
                                <p>
                                    Usuarios
                                    <span class="right badge badge-danger">New</span>
                                </p>
                            </a>
                        </li>
                        
                        
                    </ul>
                </nav>
                <!-- /.MODULOS -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            
            <!-- Main content -->
            <section class="content mt-4">
                @yield('content')
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">
            <strong>Copyright &copy; 2021-{{ date('Y') }} <a href="#">System Inventory</a>.</strong>
            Todos los derechos reservados.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 1.0.0
            </div>
        </footer>

        {{-- loader peticiones asincronas --}}
        <div id="loader">
            <img src="{{ asset('images/loader.gif') }}" alt="loader">
        </div>

    </div>
    <!-- ./wrapper -->



    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>

    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button)
    </script>

    <!-- ChartJS -->
    <script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
    <!-- daterangepicker -->
    <script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
    <script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
    <!-- Summernote -->
    <script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
    <!-- overlayScrollbars -->
    <script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

    {{-- Datatables--}}
    <link rel="stylesheet" href="{{asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
    <link rel="stylesheet" href="{{asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
    <script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>

    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    {{-- AdminLTE dashboard demo (This is only for demo purposes) 
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script> --}}

    @yield('scripts')


</body>

</html>
