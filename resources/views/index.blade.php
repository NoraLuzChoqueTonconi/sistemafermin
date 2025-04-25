@extends('layouts.admin')

@section('content')
<div id="page-content">
    <div class="row">
        <div class="col-lg-12">
            <div class="panel">
                <div class="panel-heading">
                    <h3 class="panel-title">Página Principal</h3>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="small-box" style="background-color: #3498db; color: white; height: 180px; padding: 20px; border-radius: 10px;">
                                <div class="inner">
                                    <h3>{{ $userCount }}</h3>
                                    <p>Usuarios</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <a href="{{ url('users') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="small-box" style="background-color: #2ecc71; color: white; height: 180px; padding: 20px; border-radius: 10px;">
                                <div class="inner">
                                    <h3>{{ $categoriaCount}}</h3>
                                    <p>Categorías</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-tags"></i>
                                </div>
                                <a href="{{ url('categorias') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="small-box" style="background-color: #f39c12; color: white; height: 180px; padding: 20px; border-radius: 10px;">
                                <div class="inner">
                                    <h3>{{ $clienteCount }}</h3>
                                    <p>Clientes</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <a href="{{ url('clientes') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 20px;">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="small-box" style="background-color: #e61cc7; color: white; height: 180px; padding: 20px; border-radius: 10px;">
                                <div class="inner">
                                    <h3>{{ $compraCount}}</h3>
                                    <p>Compras</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-shopping-bag"></i>
                                </div>
                                <a href="{{ url('compras') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="small-box" style="background-color: #6299cd; color: white; height: 180px; padding: 20px; border-radius: 10px;">
                                <div class="inner">
                                    <h3>{{ $pedidoCount }}</h3>
                                    <p>Pedidos</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <a href="{{ url('pedidos') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="small-box" style="background-color: #cf0ff1; color: white; height: 180px; padding: 20px; border-radius: 10px;">
                                <div class="inner">
                                    <h3>{{ $productoCount}}</h3>
                                    <p>Productos</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-box"></i>
                                </div>
                                <a href="{{ url('productos') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>

                    <div class="row" style="margin-top: 20px;">
                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="small-box" style="background-color: #16c898; color: white; height: 180px; padding: 20px; border-radius: 10px;">
                                <div class="inner">
                                    <h3>{{ $proveedorCount}}</h3>
                                    <p>Proveedores</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-truck"></i>
                                </div>
                                <a href="{{ url('proveedores') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="small-box" style="background-color: #f7db06; color: white; height: 180px; padding: 20px; border-radius: 10px;">
                                <div class="inner">
                                    <h3>{{ $ventaCount }}</h3>
                                    <p>Ventas</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <a href="{{ url('ventas') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>

                        <div class="col-md-4 col-sm-6 col-xs-12">
                            <div class="small-box" style="background-color: #d71b89; color: white; height: 180px; padding: 20px; border-radius: 10px;">
                                <div class="inner">
                                    <h3>{{ $permissionCount }}</h3>
                                    <p>Permisos</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-key"></i>
                                </div>
                                <a href="{{ url('permission') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection