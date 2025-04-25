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
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="small-box" style="background-color: #3498db; color: white; height: 180px; padding: 20px;">
                                <div class="inner">
                                    <h3>{{ count($users ?? []) }}</h3>
                                    <p>Usuarios</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-users"></i>
                                </div>
                                <a href="{{ url('users') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="small-box" style="background-color: #2ecc71; color: white; height: 250px; padding: 20px;">
                                <div class="inner">
                                    <h3>{{ $ventas ?? 0 }}</h3>
                                    <p>Ventas</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <canvas id="salesChart" style="height: 100px;"></canvas>
                                <a href="{{ url('ventas') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="small-box" style="background-color: #9b59b6; color: white; height: 250px; padding: 20px;">
                                <div class="inner">
                                    <h3>{{ $pedidos ?? 0 }}</h3>
                                    <p>Pedidos</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <canvas id="ordersChart" style="height: 100px;"></canvas>
                                <a href="{{ url('pedidos') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="small-box" style="background-color: #d88909; color: white; height: 180px; padding: 20px;">
                                <div class="inner">
                                    <h3>{{ count($categorias ?? []) }}</h3>
                                    <p>Categorías</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-tags"></i>
                                </div>
                                <a href="{{ url('categorias') }}" class="small-box-footer">Más información <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 20px;">
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Datos dinámicos para el gráfico de ventas
        var salesData = {
            labels: @json($labelsVentas),
            datasets: [{
                label: 'Ventas Mensuales',
                data: @json($dataVentas),
                backgroundColor: 'rgba(46, 204, 113, 0.2)',
                borderColor: 'rgba(46, 204, 113, 1)',
                borderWidth: 1
            }]
        };

        // Configuración del gráfico de ventas
        var salesChart = new Chart(document.getElementById('salesChart'), {
            type: 'line',
            data: salesData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });

        // Datos dinámicos para el gráfico de pedidos
        var ordersData = {
            labels: @json($labelsPedidos),
            datasets: [{
                label: 'Pedidos Mensuales',
                data: @json($dataPedidos),
                backgroundColor: 'rgba(155, 89, 182, 0.2)',
                borderColor: 'rgba(155, 89, 182, 1)',
                borderWidth: 1
            }]
        };

        // Configuración del gráfico de pedidos
        var ordersChart = new Chart(document.getElementById('ordersChart'), {
            type: 'line',
            data: ordersData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    });
</script>
@endsection