@extends('layouts.main')

@section('title', 'Monitoring Group')

@section('content')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="container mt-4">
        <h2 class="mb-4">Monitoring Group</h2>

        {{-- Filter Bulan --}}

        <form action="" method="GET">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="month" class="form-label">Pilih Bulan</label>
                    <input type="month" name="month" id="month" class="form-control" value="{{ request('month') }}"
                        onchange="this.form.submit()">
                </div>

                <div class="col-md-6 d-flex justify-content-end align-items-end">
                    <label class="form-label d-block invisible">.</label>
                    <a href="{{ route('generateDailyAchievement', [$bulan ?? "1111-11"]) }}" target="_blank"
                        class="btn btn-success d-flex align-items-center gap-2">
                        <i class="bi bi-file-earmark-arrow-down"></i> Generate Achievement
                    </a>
                </div>
            </div>
        </form>

        <div class="row">
            @php
                use Carbon\Carbon;
            @endphp

            {{-- Kolom Kiri: Data Harian --}}
            <div class="col-md-8 mb-4">
                <div class="card shadow-sm rounded">
                    <div class="card-body">
                        <h5 style="font-size: 16px" class="mb-3">Achievement Harian</h5>

                        @if ($results != null && $results->count() > 0)
                            <div class="row">
                                @foreach ($results as $data)
                                    <div class="col-md-4 mb-3">
                                        <div class="card shadow-sm border-0 h-100" style="font-size: 12px;">
                                            <div class="card-body p-3">
                                                <h6 class="card-title">Nama : {{ $data['operator_name'] }}</h6>
                                                <hr>
                                                <p class="mb-1"><strong>Group:</strong> {{ $data['division'] }}</p>
                                                <p class="mb-1"><strong>Tanggal:</strong>
                                                    {{ Carbon::parse($data['date'])->format('d F Y') }}</p>
                                                <div class="progress" style="height: 16px;">
                                                    <div class="progress-bar
                                                        @if ($data['average_achievement'] >= 95) bg-success
                                                        @elseif ($data['average_achievement'] >= 50) bg-warning text-dark
                                                        @else bg-danger @endif"
                                                        role="progressbar"
                                                        style="width: {{ $data['average_achievement'] }}%;"
                                                        aria-valuenow="{{ $data['average_achievement'] }}" aria-valuemin="0"
                                                        aria-valuemax="100">
                                                        {{ $data['average_achievement'] }}%
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <p class="text-center mt-4">Data tidak tersedia untuk bulan ini.</p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Rata-rata Per Operator --}}
            <div class="col-md-4 mb-4">
                <div class="card shadow-sm rounded">
                    <div class="card-body">
                        <h5 style="font-size: 14px" class="mb-3">Persentase Achievement (Bulan)</h5>

                        @if ($finalResults->count() > 0)
                            {{-- Grafik ditampilkan di bawah halaman --}}
                            @foreach ($finalResults as $index => $data)
                                <div class="card shadow-sm rounded mb-3">
                                    <div class="card-body p-3 d-flex align-items-center">
                                        {{-- <canvas id="pieChart" width="60" height="60"></canvas> --}}
                                        <canvas id="pieChart-{{ $index }}" width="60" height="60"></canvas>
                                        <div class="ms-3">
                                            <h6 class="card-title mb-1">{{ $data['operator_name'] }}</h6>
                                            <p class="mb-0">Rata-rata:
                                                <strong>{{ $data['average_achievement'] }}%</strong>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <p class="text-center mt-4">Belum ada data rata-rata.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        {{-- Grafik Operator --}}

    </div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    {{-- 
    <script>
        const ctx = document.getElementById('pieChart').getContext('2d');
        const pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: ['Admin', 'User Aktif', 'User Nonaktif'],
                datasets: [{
                    label: 'Kategori Pengguna',
                    data: [10, 80, 10],
                    backgroundColor: ['#3498db', '#2ecc71', '#e74c3c'],
                    borderColor: '#fff',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
    </script> --}}

    {{-- <script>
        // Ambil data dari PHP ke JavaScript
        const pieLabels = {!! json_encode($finalResults->pluck('operator_name')) !!};
        const pieData = {!! json_encode($finalResults->pluck('average_achievement')) !!};

        const ctx = document.getElementById('pieChart').getContext('2d');
        const pieChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: pieLabels,
                datasets: [{
                    label: "Rata - Rata Pencapaian",
                    data: [pieData, 100 - pieData],
                    backgroundColor: [
                        '#2ecc71',
                        '#3498db',
                        // '#e74c3c',
                        // '#f1c40f',
                        // '#9b59b6',
                        // '#1abc9c',
                        // '#34495e'
                    ],
                    borderColor: '#fff',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: false,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                }
            }
        });
    </script> --}}

    <script>
        const finalResults = {!! json_encode($finalResults) !!};

        finalResults.forEach((data, index) => {
            const ctx = document.getElementById(`pieChart-${index}`).getContext('2d');
            new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: ['Pencapaian', 'Sisa'],
                    datasets: [{
                        data: [data.average_achievement, 100 - data.average_achievement],
                        backgroundColor: ['#2ecc71', '#3498db'],
                        borderColor: '#fff',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: false,
                    maintainAspectRatio: false,
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
