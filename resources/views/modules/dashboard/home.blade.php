@extends('layouts.main')

@section('titulo', $titulo)

@section('contenido')
    <main id="main" class="main">
        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <!-- Tarjeta de Bienvenida -->
                    <div class="card border-0 shadow-sm mb-4 welcome-card">  <!-- Fondo claro con sombra -->
                      <div class="card-body p-4">  <!-- Más padding interno -->
                          <div class="d-flex align-items-center gap-3">  <!-- Espaciado entre elementos -->
                              <!-- Icono decorativo -->
                              <div class="bg-opacity-10 p-3 rounded-circle">  <!-- Círculo de fondo -->
                                  <i class="bi bi-speedometer2 fs-4"></i>  <!-- Icono dashboard -->
                              </div>
                              
                              <div class="flex-grow-1">
                                  <!-- Título más destacado -->
                                  <h3 class="card-title mb-2">¡Hola {{ Auth::user()->name }}! 👋</h3>  <!-- Tamaño más grande -->
                                  <p class="mb-0 text-muted small">Resumen de actividades - {{ now()->format('d M Y') }}</p>  <!-- Fecha actual -->
                              </div>
                              
                              <!-- Botón más moderno -->
                              <button class="btn btn-outline-primary d-flex align-items-center py-2">
                                  <i class="bi bi-file-pdf me-2"></i>  <!-- Icono PDF -->
                                  <span>Exportar Reporte</span>  <!-- Texto visible -->
                              </button>
                          </div>
                      </div>
                  </div>

                    <!-- Tarjetas de Métricas -->
                    <div class="row">
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card metric-card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="card-title mb-2">Total Ventas</h6>
                                            <h2 class="mb-0">${{ number_format($totalVentas, 2) }}</h2>
                                        </div>
                                        <div class="icon-shape bg-primary text-white rounded-circle">
                                            <i class="bi bi-currency-dollar fs-4"></i>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <span class="text-success"><i class="bi bi-arrow-up"></i> 12.5%</span>
                                        <span class="text-muted ms-2">vs mes anterior</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card metric-card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="card-title mb-2">Transacciones</h6>
                                            <h2 class="mb-0">{{ $cantidadVentas }}</h2>
                                        </div>
                                        <div class="icon-shape bg-success text-white rounded-circle">
                                            <i class="bi bi-cart-check fs-4"></i>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <span class="text-success"><i class="bi bi-arrow-up"></i> 8.3%</span>
                                        <span class="text-muted ms-2">vs mes anterior</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card metric-card h-100">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="card-title mb-2">Bajo Stock</h6>
                                            <h2 class="mb-0">{{ count($productosBajosStock) }}</h2>
                                        </div>
                                        <div class="icon-shape bg-warning text-white rounded-circle">
                                            <i class="bi bi-exclamation-triangle fs-4"></i>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <a href="#" class="text-decoration-none">
                                            <span class="text-danger">Reabastecer <i class="bi bi-arrow-right"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sección del gráfico -->
                    <div class="row">  <!-- Contenedor row principal -->
                      <!-- Gráfico 1 - Ventas Mensuales -->
                      <div class="col-xl-6 col-md-12 mb-4">  <!-- Mitad del ancho en pantallas grandes -->
                          <div class="card h-100">  <!-- Altura completa para alineación -->
                              <div class="card-body">
                                  <h5 class="card-title">Ventas Mensuales</h5>
                                  <div style="position: relative; height: 300px;">
                                      <canvas id="ventasChart"></canvas>
                                  </div>
                              </div>
                          </div>
                      </div>
                  
                      <!-- Gráfico 2 - Espacio para tu nuevo gráfico -->
                      <div class="col-xl-6 col-md-12 mb-4">  <!-- Mismas especificaciones -->
                          <div class="card h-100">
                              <div class="card-body">
                                <h6 class="card-title mb-3">Ganancias Mensuales</h6>
                                <div style="position: relative; height: 300px;">
                                    <canvas id="gananciasChart"></canvas>
                                </div>
                              </div>
                          </div>
                      </div>
                  </div>


                    <!-- Últimas Ventas -->
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="card-title mb-0">Últimas Transacciones</h5>
                                <a href="#" class="btn btn-link text-decoration-none">Ver todas <i
                                        class="bi bi-arrow-right"></i></a>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover table-borderless">
                                    <thead class="bg-light">
                                        <tr>
                                            <th>ID Venta</th>
                                            <th>Fecha</th>
                                            <th>Total</th>
                                            <th>Estado</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($ventasRecientes as $item)
                                            <tr>
                                                <td>#{{ $item->id }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y') }}</td>
                                                <td>${{ number_format($item->total_venta, 2) }}</td>
                                                <td><span class="badge bg-success">Completada</span></td>
                                                <td class="text-end">
                                                    <button class="btn btn-sm btn-outline-primary">
                                                        <i class="bi bi-eye"></i> Detalles
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

  <style>
      .welcome-card {
        background: #f8f9fa;  /* Fondo gris claro */
        border-left: 4px solid #d0ddf0 !important;  /* Borde lateral azul */
        transition: transform 0.2s;  /* Efecto hover */
      }

      .welcome-card:hover {
    transform: translateY(-2px);  /* Levantar ligeramente al pasar el mouse */
    }

    .card-title {
    color: #2c3e50 !important;  /* Azul oscuro profesional */
    font-weight: 600;
      }

    .bg-opacity-10 {
      background-color: rgba(13, 110, 253, 0.1) !important;  /* Transparencia suave */
    }

        .metric-card {
            border: none;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
        }

        .metric-card:hover {
            transform: translateY(-5px);
        }

        .icon-shape {
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .welcome-card {
            background: linear-gradient(45deg, #a9b6dd, #797f91);
            color: white;
            border: none;
        }

        .table-borderless td,
                .table-borderless th {
            border: none;
        }

        .bg-light {
            background-color: #f8f9fa !important;
        }

        .badge {
            padding: 0.5em 0.75em;
            font-weight: 500;
        }
    </style>


<!-- Primero Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Luego Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">

<!-- Código del gráfico -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('ventasChart').getContext('2d');
        const ventasData = @json($ventasMensuales);

        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ventasData.map(item => item.mes),
                datasets: [{
                    label: 'Ventas en $',
                    data: ventasData.map(item => item.total),
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1,
                    borderRadius: 5 // Barras redondeadas
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '$' + value.toLocaleString('es-ES');
                            }
                        }
                    }
                },
                plugins: {
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return '$' + context.raw.toLocaleString('es-ES');
                            }
                        }
                    }
                }
            }
        });
    });
</script>

{{-- <script>
  document.addEventListener('DOMContentLoaded', function() {
      const ctx = document.getElementById('gananciasChart').getContext('2d');
      const gananciasData = @json($gananciasMensuales);

      new Chart(ctx, {
          type: 'bar',
          data: {
              labels: gananciasData.map(item => item.mes),
              datasets: [
                  {
                      label: 'Ventas ($)',
                      data: gananciasData.map(item => item.ventas),
                      backgroundColor: 'rgba(54, 162, 235, 0.7)', // Azul
                      borderColor: 'rgba(54, 162, 235, 1)',
                      borderWidth: 1
                  },
                  {
                      label: 'Costos ($)',
                      data: gananciasData.map(item => item.costos),
                      backgroundColor: 'rgba(255, 99, 132, 0.7)', // Rojo
                      borderColor: 'rgba(255, 99, 132, 1)',
                      borderWidth: 1
                  },
                  {
                      label: 'Ganancia ($)',
                      data: gananciasData.map(item => item.ganancia),
                      backgroundColor: 'rgba(75, 192, 192, 0.7)', // Verde
                      borderColor: 'rgba(75, 192, 192, 1)',
                      borderWidth: 1
                  }
              ]
          },
          options: {
              responsive: true,
              maintainAspectRatio: false,
              scales: {
                  y: {
                      beginAtZero: true,
                      ticks: {
                          callback: function(value) {
                              return '$' + value.toLocaleString('es-ES');
                          }
                      }
                  }
              },
              plugins: {
                  tooltip: {
                      callbacks: {
                          label: function(context) {
                              return context.dataset.label + ': $' + context.raw.toLocaleString('es-ES');
                          }
                      }
                  }
              }
          }
      });
  });
</script> --}}
@endsection
