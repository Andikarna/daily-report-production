@extends('layouts.main')

@section('title', 'Dashboard Admin')

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
                    <div class="card-header bg-primary text-white text-center">
                        <strong>Grafik Total Pencapaian per Grup</strong>
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
                        @php
                            $percent = round(($group['actual'] / $group['target']) * 100);
                            $bgColor =
                                $percent < 50
                                    ? 'bg-danger'
                                    : ($percent > 95
                                        ? 'bg-success'
                                        : ($percent < 95
                                            ? 'bg-warning'
                                            : 'bg-dark'));
                        @endphp
                        <div class="col-12">
                            <div class="card shadow-sm border-0 cursor-pointer" data-bs-toggle="modal"
                                data-bs-target="#detailModal-{{ $group['leader_id'] }}">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <h6 class="mb-0">{{ $group['name'] }}</h6>
                                        <span class="badge {{ $bgColor }} text-white">{{ $percent }}%</span>
                                    </div>
                                    <small class="text-muted">Target: {{ $group['target'] }} | Aktual:
                                        {{ $group['actual'] }}</small>
                                    <div class="progress mt-2" style="height: 8px;">
                                        <div class="progress-bar {{ $bgColor }}" style="width: {{ $percent }}%">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="detailModal-{{ $group['leader_id'] }}" tabindex="-1"
                            aria-labelledby="detailModalLabel-{{ $group['leader_id'] }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content shadow">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title" id="detailModalLabel-{{ $group['leader_id'] }}">Detail
                                            Pencapaian</h5>
                                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <h5 class="mb-3">{{ $group['name'] }}</h5>
                                        <p><strong>Target:</strong> {{ $group['target'] }}</p>
                                        <p><strong>Aktual:</strong> {{ $group['actual'] }}</p>
                                        <p><strong>Pencapaian:</strong> {{ $percent }}%</p>
                                        <table class="table table-bordered table-striped mt-3">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama</th>
                                                    <th>Rata-rata</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $groupedData = collect($dataProductionsAll)
                                                        ->filter(
                                                            fn($item) => $item->reportApproval->approval_id ==
                                                                $group['leader_id'],
                                                        )
                                                        ->groupBy(fn($item) => $item->reportApproval->report->name)
                                                        ->map(
                                                            fn($items, $name) => [
                                                                'name' => $name,
                                                                'achievement_sum' => $items->sum('achievement'),
                                                            ],
                                                        )
                                                        ->values();
                                                    $index = 1;
                                                @endphp
                                                @foreach ($groupedData as $data)
                                                    <tr>
                                                        <td>{{ $index++ }}</td>
                                                        <td>{{ $data['name'] }}</td>
                                                        <td>{{ round($data['achievement_sum']) }}%</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
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
        const data = chartData.map(item => item.actual);
        const dataCount = data.length;
        const categoryPercentage = dataCount <= 3 ? 0.5 : 0.8;
        const barPercentage = dataCount <= 3 ? 0.5 : 0.9;

        const ctx = document.getElementById('chartTotal').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Total Pencapaian',
                    data: data,
                    backgroundColor: ['#00b894', '#0984e3', '#fdcb6e', '#636e72'],
                    borderWidth: 1,
                    categoryPercentage: categoryPercentage,
                    barPercentage: barPercentage,
                    barThickness: 50,
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 10
                        }
                    }
                }
            }
        });
    </script>
@endsection
