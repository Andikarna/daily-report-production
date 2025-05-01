@extends('layouts.main')

@section('title', 'Detail Laporan')

@section('content')
    <div class="container">

        <div class="bg-white shadow py-3 px-4 gap-3 rounded mb-4 d-flex align-items-center">
            <div class="col-auto">
                <a href="{{ url()->previous() }}" class="btn btn-link text-decoration-none p-0">
                    <i class="bi bi-arrow-left fs-4 fw-bold text-dark"></i>
                </a>
            </div>

            <h5>Detail Laporan Produksi</h5>
        </div>
        
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
    </div>
@endsection
