@extends('layouts.main')

@section('title', 'Detail Laporan')

@section('content')
    <div class="container mt-5">
        <h3 class="mb-4 fw-bold">Detail Laporan Produksi</h3>

        <!-- Informasi Utama Report_Production -->
        <div class="card shadow-sm mb-4 rounded-3">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Informasi Laporan</h5>
            </div>
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <strong>Operator:</strong> {{ $report->division->name }}
                    </div>
                    <div class="col-md-6">
                        <strong>Leader:</strong> {{ $report->leader->name }}
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-6">
                        <strong>Tanggal Produksi:</strong> {{ \Carbon\Carbon::parse($report->date)->format('d F Y') }}
                    </div>
                    <div class="col-md-6">
                        <strong>Nama Operator:</strong> {{ $report->name }}
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <strong>Shift:</strong> {{ $report->shift }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabel Report_Detail_Production -->
        <div class="card shadow-sm mb-5 rounded-3">
            <div class="card-header bg-success text-white">
                <h5 class="mb-0">Detail Produksi</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th style="width: 5%;">No</th>
                                <th>IP</th>
                                <th style="width: 15%;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($details as $detail)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $detail->ip }}</td>
                                    <td>
                                        <button class="btn btn-outline-info btn-sm" data-bs-toggle="collapse"
                                            data-bs-target="#lotDetail{{ $detail->id }}">
                                            Lihat Lot
                                        </button>
                                    </td>
                                </tr>

                                <!-- Detail Lot -->
                                <tr id="lotDetail{{ $detail->id }}" class="collapse">
                                    <td colspan="3">
                                        <div class="card card-body bg-light">
                                            <table class="table table-sm table-striped table-bordered">
                                                <thead class="table-secondary">
                                                    <tr>
                                                        <th>No Lot</th>
                                                        <th>OK</th>
                                                        <th>NG</th>
                                                        <th>Total</th>
                                                        <th>Keterangan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($detail->lotDetails as $lot)
                                                        <tr>
                                                            <td>{{ $lot->no_lot }}</td>
                                                            <td>{{ $lot->ok }}</td>
                                                            <td>{{ $lot->ng }}</td>
                                                            <td>{{ $lot->total }}</td>
                                                            <td>{{ $lot->description }}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tombol Kembali -->
        <div class="d-flex justify-content-end">
            <a href="{{ route('report_approval') }}" class="btn btn-secondary px-4 py-2">Kembali</a>
        </div>
    </div>
@endsection
