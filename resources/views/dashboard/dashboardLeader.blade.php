@extends('layouts.main')

@section('title', 'Dashboard Leader')

@section('content')
    <div class="container-fluid">
        <!-- FILTER SECTION -->
        <form method="GET" class="row mb-4 shadow-sm p-2 bg-white rounded">
            <div class="d-flex align-items-center justify-content-between w-100">
                <!-- Judul -->
                <div>
                    <h4 class="mb-0 me-3">
                        Dashboard Pencapaian
                    </h4>
                    <small class="text-muted fs-10">
                        {{ \Carbon\Carbon::parse($bulan)->translatedFormat('F Y') ?? 'Semua Bulan' }}
                    </small>
                </div>

                <!-- Input Bulan -->
                <div class="col-md-4">
                    <input type="month" id="bulan" name="bulan" class="form-control" onchange="this.form.submit()"
                        value="{{ request('bulan') }}">
                </div>
            </div>
        </form>


        <div class="row">
            <!-- CHART -->
            <div class="col-md-8 mb-4">
                <div class="row bg-white p-3 shadow-lg border-0 rounded-4">
                    <div class="card-header text-center">
                        <strong>Grafik Laporan Harian Operator</strong>
                    </div>
                    <div class="card-body">
                        <canvas id="chartTotal" height="180"></canvas>
                    </div>
                </div>
            </div>

            <!-- CARD PER GRUP -->
            <div class="col-md-4">
                <div class="row g-3">
                    @foreach ($results as $index => $group)
                        
                    @endforeach
                    
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const chartData = @json($results);
        const labels = chartData.map(item => item.name);
        const data = chartData.map(item => item.count);

        const ctx = document.getElementById('chartTotal').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Pencapaian',
                    data: data,
                    backgroundColor: 'rgba(0, 184, 148, 0.2)',
                    borderColor: '#00b894',
                    borderWidth: 2,
                    pointBackgroundColor: '#0984e3',
                    pointBorderColor: '#fdcb6e',
                    pointBorderWidth: 2,
                    pointRadius: 5,
                    tension: 0.5,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        labels: {
                            color: '#636e72',
                            font: {
                                size: 14
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return ` ${context.label}: ${context.raw}`;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        grid: {
                            display: false
                        },
                        ticks: {
                            color: '#636e72',
                            font: {
                                size: 12
                            }
                        }
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 10,
                            color: '#636e72',
                            font: {
                                size: 12
                            }
                        },
                        grid: {
                            borderDash: [5, 5],
                        }
                    }
                },
                animation: {
                    duration: 1000,
                    easing: 'easeInOutQuart'
                }
            }
        });
    </script>


@endsection
