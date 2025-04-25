<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema Fermin</title>

    <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="{{ asset('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{ asset('https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet"
        href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- JQVMap -->
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <!-- summernote -->
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">

    <!-- jquery -->
    <script src="{{ asset('/plugins/jquery/jquery.js') }}"></script>
    <!-- iconos de bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <!-- datetables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">

    <style>
        .main-sidebar {
            background-color: #f9f9f9 !important;
        }
        .main-sidebar.sidebar-light {
            background-color: rgba(183, 206, 125, 0.792) !important;
            color: black !important;
        }
    
        .main-sidebar.sidebar-light .nav-link {
            color: black;
        }
    
        .main-sidebar.sidebar-light .brand-link {
            color: black;
        }
    
        /* Estilo para los submenús */
        .main-sidebar.sidebar-light .nav-item ul.nav.nav-treeview {
            background-color: #FFFACD; /* Amarillo claro (Lemon Chiffon) */
        }
    
        /* Estilo para los elementos individuales del submenú */
        .main-sidebar.sidebar-light .nav-item ul.nav.nav-treeview li.nav-item {
            background-color: #FFFACD; /* Mismo amarillo claro para consistencia */
        }
    
        /* Estilo para el icono del submenú */
        .far.fa-circle.nav-icon {
            color: #FAFAD2; /* Amarillo claro (Light Goldenrod Yellow) */
        }
    </style>
    </head>

    <body class="hold-transition sidebar-mini layout-fixed">
        <div class="wrapper">
    {{-- sweetalert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ url('dist/img/cinco.jpg') }}" alt="cinco"
                height="60" width="60">
        </div>

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i
                            class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
          
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                {{-- <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search"
                                    aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                        <i class="fas fa-expand-arrows-alt"></i>
                    </a>
                </li>


                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="padding: 9px;">
                        {{ Auth::user()->name }}
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li>
                            <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-power" style="font-size: 20px; color: rgb(221, 6, 6); text-shadow: 1px 1px 2px rgb(221, 12, 12);"></i>
                                Cerrar Sesión
                            </a>
                        </li>
                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li> 
            </ul>
        </nav>
        <!-- /.navbar -->
        

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="{{ url('/') }}" class="brand-link">
                <img src="{{ url('dist/img/cinco.jpg') }}" alt="cinco"
                    class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light" style="color: #211e1e">SISTEMA FERRETERIA</span>

            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                       
                    </div>
                    <div class="info">
                        @if(Auth::check())
                        <a href="#" class="d-block">{{ Auth::user()->name }}</a>
                    @else
                        <a href="#">Invitado</a>
                    @endif
                    
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                @can('users')
               <li class="nav-item ">
                <a href="#" class="nav-link active" style="color: #222222; background-color: #FFCC00;">
                    <i class="bi bi-clipboard-check-fill"></i>
                    <p>
                       Usuarios
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    {{-- <li class="nav-item">
                        <a href="{{ url('users/create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Nuevos  Usuarios</p>
                        </a>
                    </li> --}}
                    <li class="nav-item">
                        <a href="{{ url('users') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Listado de Usuarios</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('roles') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Roles</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('permisos') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Permisos</p>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            {{-- <li class="nav-item ">
                <a href="#" class="nav-link active" style="color: #222222; background-color: #FFCC00;">
                    <i class="bi bi-truck"></i>
                    <p>
                       Permisos
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('permisos/create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Nuevos Permisos</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('permisos') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Listado de permisos</p>
                        </a>
                    </li>
                </ul>
            </li> --}}
                @can('ventas')
               <li class="nav-item"> 
                <a href="#" class="nav-link active" style="color: #222222; background-color: #FFCC00;">
                    <i class="bi bi-truck"></i>
                    <p>
                        Ventas
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('ventas/create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Nuevas Ventas</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('ventas') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Listado de Ventas</p>
                        </a>
                    </li>
                    <li class="nav-item menu-open">
                        <a href="#" class="nav-link">
                            <i class="bi bi-rulers"></i>
                            <p>
                                Medidas
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('/medidas/create') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Nueva Medida</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('/medidas') }}" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Listado de Medidas</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li> 
            @endcan
            
            @can('pedidos')
            <li class="nav-item ">
                <a href="#" class="nav-link active" style="color: #222222; background-color: #FFCC00;">
                    <i class="bi bi-truck"></i>
                    <p>
                       Pedidos
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{ url('pedidos/create') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Nuevos Pedidos</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('pedidos') }}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Listado de Pedidos</p>
                        </a>
                    </li>
                </ul>
            </li>
            @endcan
            
                            @can('categorias')
                            <li class="nav-item ">
                            <a href="#" class="nav-link active" style="color: #222222; background-color: #FFCC00;">
                                <i class="bi bi-card-checklist"></i>      
                                <p>
                                   Categorias 
                                   <i class="right fas fa-angle-left"></i>
                                  
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('categorias/create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Nueva Categoria</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('categorias') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Categoria</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan
                        @can('productos')
                        <li class="nav-item ">
                            <a href="#" class="nav-link active" style="color: #222222; background-color: #FFCC00;">
                                <i class="bi bi-truck"></i>
                                <p>
                                   Productos
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('productos/create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Nuevos Productos</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('productos') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Productos</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan

                        @can('compras')
                        <li class="nav-item ">
                            <a href="#" class="nav-link active" style="color: #222222; background-color: #FFCC00;">
                                <i class="bi bi-truck"></i>
                                <p>
                                   Compras
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('compras/create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Nueva compra</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('compras') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Compras</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan

                        @can('proveedores')
                        <li class="nav-item ">
                            <a href="#" class="nav-link active" style="color: #222222; background-color: #FFCC00;">
                                <i class="bi bi-truck"></i>
                                <p>
                                   Proveedores
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('proveedores/create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Nuevo Proveedor</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('proveedores') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Proveedores</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan
                        @can('clientes')
                        <li class="nav-item ">
                            <a href="#" class="nav-link active" style="color: #222222; background-color: #FFCC00;">
                                <i class="bi bi-hammer"></i>
                                <p>
                                   Clientes
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ url('clientes/create') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Nuevos Clientes</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('clientes') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Listado de Clientes</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        @endcan
                        

                        {{-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                style="background-color: rgb(27, 112, 224)">
                                <i class="nav-icon">
                                    <i class="bi bi-door-closed-fill"></i>
                                </i>
                                CERRAR SESION
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li> --}}
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <br>
            <div class="content">
                @yield('content')
            </div>
        </div>
        <!-- /.content-wrapper 
       <footer class="main-footer">
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>-->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>

    <!-- jQuery UI 1.11.4 -->
    <script src="plugins/jquery-ui/jquery-ui.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>
    <!-- Sparkline -->
    <script src="plugins/sparklines/sparkline.js"></script>
    <!-- JQVMap -->
    <script src="plugins/jqvmap/jquery.vmap.min.js"></script>
    <script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
    <!-- jQuery Knob Chart -->
    <script src="plugins/jquery-knob/jquery.knob.min.js"></script>
    <!-- daterangepicker -->
    <script src="plugins/moment/moment.min.js"></script>
    <script src="plugins/daterangepicker/daterangepicker.js"></script>
    <!-- Tempusdominus Bootstrap 4 -->
    <script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
    <!-- Summernote -->
    <script src="plugins/summernote/summernote-bs4.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    {{-- <script src="{{ asset('dist/js/demo.js') }}"></script> --}}
    <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
    <script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>

    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

    <!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    
</body>

</html>