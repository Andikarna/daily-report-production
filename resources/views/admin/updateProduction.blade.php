@extends('layouts.main')

@section('title', 'Lihat Detail Produksi')

@php
    use Carbon\Carbon;
    use App\Models\ReportDetailLot;
    use App\Models\MasterProductEnginering;
@endphp

@section('content')

    <div class="container">
        <!-- Header Section -->
        <div class="d-flex justify-content-between align-items-center row mb-4 shadow-sm p-3 bg-white rounded">
            <!-- Tombol Back (Left-Aligned) -->
            <div class="col-auto">
                <a href="{{ url()->previous() }}" class="btn btn-link text-decoration-none p-0">
                    <i class="bi bi-arrow-left fs-4 fw-bold text-dark"></i>
                </a>
            </div>

            <!-- Judul Laporan (Centered) -->
            <div class="col text-center">
                <h3 class="mb-0">Production Report {{ $production->division->name }}</h3>
            </div>

            <!-- Reject Button (Right-Aligned) -->
            @if ($production->status == "Baru")
                <div class="col-auto">
                <form id="reject_production" action="{{ route('reject_production', [$production->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn btn-danger">
                        Reject <i class="bi bi-x-circle"></i>
                    </button>
                </form>
            </div>
            @endif
            
        </div>

        <form action="{{ route('create_production', [$production->id]) }}" method="POST" style="">
            @csrf

            <!-- Card Section -->
            <div class="shadow-sm p-3 bg-white rounded mb-4">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <!-- Additional Info -->
                        <div>
                            <p class="mb-1"><strong>Divisi:</strong> {{ $production->division->name }}</p>
                            <p class="mb-1"><strong>Tanggal:</strong>
                                {{ Carbon::parse($production->report->date_production)->format('d-m-Y') }}</p>
                            <p class="mb-1"><strong>Leader Approval:</strong> {{ $production->approval->name }}</p>
                        </div>

                        <!-- Leader Approval -->
                        <div class="text-end">
                            <p class="mb-1"><strong>Operator:</strong> {{ $production->report->name }}</p>
                            <i class="bi bi-person-circle" style="font-size: 40px;"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Report Table -->
            <div class="shadow-sm p-3 bg-white rounded" style="overflow-x: auto; height: 50vh;">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered text-center">
                            <thead class="table-primary">
                                <tr>
                                    <th rowspan="2">IP</th>
                                    <th rowspan="2">Target</th>
                                    <th rowspan="2">Jam</th>
                                    <th rowspan="2">Standard Output (Pcs)</th>
                                    <th colspan="2">Actual Output - GOOD</th>
                                    <th colspan="2">Actual Output - REJECT</th>
                                    <th rowspan="2">Total Output (Pcs)</th>
                                    <th rowspan="2">Achievement (%)</th>
                                </tr>
                                <tr>
                                    <th>(Pcs)</th>
                                    <th>(%)</th>
                                    <th>(Pcs)</th>
                                    <th>(%)</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- @foreach ($reportDetail as $data)
                                    @php
                                        $masterProduct = MasterProductEnginering::where('ip', $data->ip)
                                            ->where('divisi_id', $production->divisi_id)
                                            ->first();

                                        $reportDetailLot = ReportDetailLot::where(
                                            'report_detail_id',
                                            $data->id,
                                        )->first();
                                        $timeInHours = $reportDetailLot->time / 60;
                                        $standardOutput =
                                            ($masterProduct->result_of_time * $reportDetailLot->time) / 60;
                                        $percentOfOk = round(($reportDetailLot->ok / $standardOutput) * 100);
                                        $total = $reportDetailLot->ok + $reportDetailLot->ng;
                                        $percentOfNg = round(($reportDetailLot->ng / $total) * 100);
                                        $achievements = round(($total / $standardOutput) * 100);
                                    @endphp
                                    <tr>
                                        <td>
                                            <input type="hidden" name="ip[]" value="{{ $data->ip }}">
                                            {{ $data->ip }}
                                        </td>
                                        <td>
                                            <input type="hidden" name="goal[]"
                                                value="{{ $masterProduct->result_of_time }}">
                                            {{ $masterProduct->result_of_time }}
                                        </td>
                                        <td>
                                            <input type="hidden" name="time[]" value="{{ $timeInHours }}">
                                            {{ $timeInHours }}
                                        </td>
                                        <td>
                                            <input type="hidden" name="standart[]" value="{{ $standardOutput }}">
                                            {{ $standardOutput }}
                                        </td>
                                        <td>
                                            <input type="hidden" name="ok[]" value="{{ $reportDetailLot->ok }}">
                                            {{ $reportDetailLot->ok }}
                                        </td>
                                        <td>
                                            <input type="hidden" name="percentok[]" value="{{ $percentOfOk }}">
                                            {{ $percentOfOk }}%
                                        </td>
                                        <td>
                                            <input type="hidden" name="ng[]" value="{{ $reportDetailLot->ng }}">
                                            {{ $reportDetailLot->ng }}
                                        </td>
                                        <td>
                                            <input type="hidden" name="percentng[]" value="{{ $percentOfNg }}">
                                            {{ $percentOfNg }}%
                                        </td>
                                        <td>
                                            <input type="hidden" name="total[]" value="{{ $total }}">
                                            {{ $total }}
                                        </td>
                                        <td id="achievement-{{ $loop->index }}" data-value="{{ $achievements }}">
                                            0%
                                        </td>
                                        <input type="hidden" name="achievement[]" value="{{ $achievements }}">

                                    </tr>
                                @endforeach --}}

                                @foreach ($reportDetail as $data)
                                    @php
                                        $masterProduct = MasterProductEnginering::where('ip', $data->ip)
                                            ->where('divisi_id', $production->divisi_id)
                                            ->first();

                                        $reportDetailLot = ReportDetailLot::where(
                                            'report_detail_id',
                                            $data->id,
                                        )->first();

                                        $timeInHours = $reportDetailLot->time > 0 ? $reportDetailLot->time / 60 : 0;

                                        $standardOutput =
                                            $reportDetailLot->time > 0
                                                ? ($masterProduct->result_of_time * $reportDetailLot->time) / 60
                                                : 0;

                                        $percentOfOk =
                                            $standardOutput > 0
                                                ? round(($reportDetailLot->ok / $standardOutput) * 100)
                                                : 0;

                                        $total = $reportDetailLot->ok + $reportDetailLot->ng;

                                        $percentOfNg = $total > 0 ? round(($reportDetailLot->ng / $total) * 100) : 0;

                                        $achievements =
                                            $standardOutput > 0 ? round(($total / $standardOutput) * 100) : 0;
                                    @endphp
                                    <tr>
                                        <td>
                                            <input type="hidden" name="ip[]" value="{{ $data->ip }}">
                                            {{ $data->ip }}
                                        </td>
                                        <td>
                                            <input type="hidden" name="goal[]"
                                                value="{{ $masterProduct->result_of_time }}">
                                            {{ $masterProduct->result_of_time }}
                                        </td>
                                        <td>
                                            <input type="hidden" name="time[]" value="{{ $timeInHours }}">
                                            {{ $timeInHours }}
                                        </td>
                                        <td>
                                            <input type="hidden" name="standart[]" value="{{ $standardOutput }}">
                                            {{ $standardOutput }}
                                        </td>
                                        <td>
                                            <input type="hidden" name="ok[]" value="{{ $reportDetailLot->ok }}">
                                            {{ $reportDetailLot->ok }}
                                        </td>
                                        <td>
                                            <input type="hidden" name="percentok[]" value="{{ $percentOfOk }}">
                                            {{ $percentOfOk }}%
                                        </td>
                                        <td>
                                            <input type="hidden" name="ng[]" value="{{ $reportDetailLot->ng }}">
                                            {{ $reportDetailLot->ng }}
                                        </td>
                                        <td>
                                            <input type="hidden" name="percentng[]" value="{{ $percentOfNg }}">
                                            {{ $percentOfNg }}%
                                        </td>
                                        <td>
                                            <input type="hidden" name="total[]" value="{{ $total }}">
                                            {{ $total }}
                                        </td>
                                        <td id="achievement-{{ $loop->index }}" data-value="{{ $achievements }}">
                                            {{ $achievements }}%
                                        </td>
                                        <input type="hidden" name="achievement[]" value="{{ $achievements }}">
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Approve and Reject Buttons -->
            <div class="text-end mt-4">
                <!-- Tombol Reject (jika status 'Baru') -->
                @if ($production->status == 'Baru')
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle"></i> Approve
                    </button>
                @endif
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const animateAchievements = () => {
                const achievementElements = document.querySelectorAll("td[id^='achievement-']");

                achievementElements.forEach((element) => {
                    const targetValue = parseFloat(element.getAttribute("data-value"));
                    let currentValue = 0;

                    const increment = targetValue / 50; // Durasi animasi dibagi menjadi 50 langkah
                    const updateValue = () => {
                        currentValue += increment;
                        if (currentValue >= targetValue) {
                            element.textContent = `${targetValue.toFixed(2)}%`;
                        } else {
                            element.textContent = `${currentValue.toFixed(2)}%`;
                            requestAnimationFrame(updateValue);
                        }
                    };

                    requestAnimationFrame(updateValue);
                });
            };

            animateAchievements();
        });
    </script>
@endsection
