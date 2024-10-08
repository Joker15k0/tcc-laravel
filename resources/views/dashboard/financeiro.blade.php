@extends('dashboard.layouts.layout')
@section('title', 'Dashboard')
@section('link', '/css/dashboard/fina.css')

@section('breadcrumb')
    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
        aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Monitoramento </li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="table-group">
        <div class="table-header">
            <div class="table-desc">
                <div class="title">
                    Entradas
                </div>
            </div>
            <div class="action">
                <div class="search-box">
                    <span class="icon">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" name="search" id="search" placeholder="Buscar">
                </div>
                <button id="novo">Exportar</button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Codigo</th>
                        <th scope="col">Data</th>
                        <th scope="col">Produto</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Seção</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($entradas as $entrada)
                        <tr>
                            <th scope="row">
                                @if ($entrada->historicoable)
                                    {{ $entrada->historicoable->codigo ?? $entrada->historicoable->id }}
                                @else
                                    N/A
                                @endif
                            </th>
                            <th scope="row">{{ $entrada->created_at->format('d/m/Y') }}</th>
                            <th scope="row">
                                <!-- Acionador do Modal -->
                                <button type="button" class="btn btn-link" data-bs-toggle="modal"
                                    data-bs-target="#produto-{{ $entrada->id }}">
                                    <i class="bi bi-eye"></i> Visualizar
                                </button>
                            </th>
                            <th scope="row">
                                {{ $entrada->quantidade }}
                            </th>
                            <th scope="row">
                                {{ class_basename($entrada->historicoable_type) }}
                            </th>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="produto-{{ $entrada->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detalhes do Produto</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if ($entrada->historicoable)
                                            @php
                                                $detalhes = $entrada->historicoable;
                                                $tipo = class_basename($entrada->historicoable_type);
                                            @endphp
                                            <p>Código: {{ $detalhes->codigo ?? 'N/A' }} </p>
                                            @if ($tipo === 'Camiseta')
                                                <p>Tamanho: {{ $detalhes->tamanho ?? 'N/A' }}</p>
                                                <p>Cor: {{ $detalhes->cor ?? 'N/A' }}</p>
                                                <p>Categoria: {{ $detalhes->categoria ?? 'N/A' }}</p>
                                                <p>Quantidade: {{ $detalhes->quantidade ?? 'N/A' }}</p>
                                                <p>Fornecedor: {{ $detalhes->fornecedor->nome ?? 'N/A' }}</p>
                                            @elseif ($tipo === 'Tecido')
                                                <p>Medida: {{ $detalhes->medida ?? 'N/A' }}</p>
                                                <p>Cor: {{ $detalhes->cor ?? 'N/A' }}</p>
                                                <p>Quantidade: {{ $detalhes->quantidade ?? 'N/A' }}</p>
                                                <p>Fornecedor: {{ $detalhes->fornecedor->nome ?? 'N/A' }}</p>
                                            @elseif ($tipo === 'Tinta')
                                                <p>Cor: {{ $detalhes->cor ?? 'N/A' }}</p>
                                                <p>Capacidade: {{ $detalhes->capacidade ?? 'N/A' }}</p>
                                                <p>Quantidade: {{ $detalhes->quantidade ?? 'N/A' }} </p>
                                                <p>Fornecedor: {{ $detalhes->fornecedor->nome ?? 'N/A' }}</p>
                                            @endif
                                        @else
                                            <p>N/A</p>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="table-group">
        <div class="table-header">
            <div class="table-desc">
                <div class="title">
                    Saídas
                </div>
            </div>
            <div class="action">
                <div class="search-box">
                    <span class="icon">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" name="search" id="search" placeholder="Buscar">
                </div>
                <button id="novo">Exportar</button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Codigo</th>
                        <th scope="col">Data</th>
                        <th scope="col">Produto</th>
                        <th scope="col">Quantidade</th>
                        <th scope="col">Seção</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($saidas as $saida)
                        <tr>
                            <th scope="row">
                                @if ($saida->historicoable)
                                    {{ $saida->historicoable->codigo ?? $saida->historicoable->id }}
                                @else
                                    N/A
                                @endif
                            </th>
                            <th scope="row">{{ $saida->created_at->format('d/m/Y') }}</th>
                            <th scope="row">
                                <button type="button" class="btn btn-link" data-bs-toggle="modal"
                                    data-bs-target="#produto-{{ $saida->id }}">
                                    <i class="bi bi-eye"></i> Visualizar
                                </button>
                            </th>
                            <th scope="row">{{ $saida->quantidade }}</th>
                            <th scope="row">{{ class_basename($saida->historicoable_type) }}</th>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="produto-{{ $saida->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Detalhes do Produto</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if ($saida->historicoable)
                                            @php
                                                $detalhes = $saida->historicoable;
                                                $tipo = class_basename($saida->historicoable_type);
                                            @endphp
                                            <p>Código: {{ $detalhes->codigo ?? 'N/A' }} </p>
                                            @if ($tipo === 'Camiseta')
                                                <p>Tamanho: {{ $detalhes->tamanho ?? 'N/A' }}</p>
                                                <p>Cor: {{ $detalhes->cor ?? 'N/A' }}</p>
                                                <p>Categoria: {{ $detalhes->categoria ?? 'N/A' }}</p>
                                                <p>Quantidade: {{ $detalhes->quantidade ?? 'N/A' }}</p>
                                                <p>Fornecedor: {{ $detalhes->fornecedor->nome ?? 'N/A' }}</p>
                                            @elseif ($tipo === 'Tecido')
                                                <p>Medida: {{ $detalhes->medida ?? 'N/A' }}</p>
                                                <p>Cor: {{ $detalhes->cor ?? 'N/A' }}</p>
                                                <p>Quantidade: {{ $detalhes->quantidade ?? 'N/A' }}</p>
                                                <p>Fornecedor: {{ $detalhes->fornecedor->nome ?? 'N/A' }}</p>
                                            @elseif ($tipo === 'Tinta')
                                                <p>Cor: {{ $detalhes->cor ?? 'N/A' }}</p>
                                                <p>Capacidade: {{ $detalhes->capacidade ?? 'N/A' }}</p>
                                                <p>Quantidade: {{ $detalhes->quantidade ?? 'N/A' }} </p>
                                                <p>Fornecedor: {{ $detalhes->fornecedor->nome ?? 'N/A' }}</p>
                                            @endif
                                        @else
                                            <p>N/A</p>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Fechar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('graficos')
    <div class="graficos">
        <div class="grafico-1">
            <div class="graphLabel">
                Comparativo de Entradas e Saídas
            </div>
            <canvas id="myChart"></canvas>
        </div>
        <div class="grafico-2">
            <div class="graphLabel">
                Produtos cadastrados
            </div>
            <canvas id="categoriasChart"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const ctx = document.getElementById('myChart');
            const bbl = document.getElementById('categoriasChart');

            var entradasPorMes = @json($entradasPM);
            var totalCamisetas = @json($totalCamisetas);
            var totalTecidos = @json($totalTecidos);
            var totalTintas = @json($totalTintas);
            var saidasPorMes = @json($saidasPM);

            new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [
                        'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto',
                        'Setembro',
                        'Outubro', 'Novembro', 'Dezembro'
                    ],
                    datasets: [{
                            label: 'Entradas por Mês',
                            data: entradasPorMes,
                            borderWidth: 1,
                            borderColor: 'rgba(75, 192, 192, 1)',
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        },
                        {
                            label: 'Saídas por Mês',
                            data: saidasPorMes,
                            borderWidth: 1,
                            borderColor: 'rgba(255, 99, 132, 1)',
                            backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        }
                    ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

            var labels = @json($labels);
            var data = @json($data);

            new Chart(bbl, {
                type: 'doughnut',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Registros',
                        data: data,
                        borderWidth: 1
                    }]
                },

            });

        });
    </script>
@endpush
