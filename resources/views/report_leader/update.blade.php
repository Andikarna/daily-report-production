@extends('layouts.main')

@section('title', 'Update Laporan')

@section('content')
    <div class="container">
        <div class="bg-white shadow py-3 px-4 gap-3 rounded mb-2 d-flex align-items-center">
            <div class="col-auto">
                <a href="{{ url()->previous() }}" class="btn btn-link text-decoration-none p-0">
                    <i class="bi bi-arrow-left fs-4 fw-bold text-dark"></i>
                </a>
            </div>

            <h5>Detail Laporan Produksi</h5>
        </div>

        <div class="bg-white py-2 px-2 card rounded shadow mb-2">

            <div class="card-header">
                <h5>Informasi Laporan</h5>
            </div>

            <div class="card-body">
                <p><strong>Operator :</strong> {{ $report->division->name }}</p>
                <p><strong>Leader :</strong> {{ $report->leader->name }}</p>
                <p><strong>Tanggal Produksi :</strong> {{ \Carbon\Carbon::parse($report->date)->format('d F Y') }}</p>
                <p><strong>Nama Operator :</strong> {{ $report->name }}</p>
                <p><strong>Shift :</strong> {{ $report->shift }}</p>
            </div>
        </div>

        <!-- Tabel Report_Detail_Production -->
        <div class="bg-white py-2 px-2 shadow rounded card mb-4 shadow">
            <div class="card-header">
                <h5>Detail Produksi</h5>
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>IP</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($details as $detail)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $detail->ip }}</td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-bs-toggle="collapse"
                                        data-bs-target="#lotDetail{{ $detail->id }}">
                                        Lihat Lot
                                    </button>
                                </td>
                            </tr>

                            <!-- Tabel Detail_Lot_Production -->
                            <tr id="lotDetail{{ $detail->id }}" class="collapse">
                                <td colspan="3">
                                    <table class="table table-striped">
                                        <thead>
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
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <form id="approveForm" action="{{ route('report_approve', ['id' => $report->id]) }}" method="POST">
            @csrf
            <div class="d-flex justify-content-end align-items-center">
                <button type="button" class="btn btn-success" id="approveButton">Approve</button>
            </div>
        </form>

        <div class="modal fade" id="verifyModal" tabindex="-1" aria-labelledby="verifyModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-success text-white">
                        <h5 class="modal-title" id="verifyModalLabel">Konfirmasi Approve</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <img src="{{ asset('assets/images/verifikasi.jpg') }}" alt="verifikasi"
                            style="width: 300px; height: 300px;">
                        <p>Apakah Anda yakin ingin approve laporan ini?</p>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" id="confirmApprove" class="btn btn-success">Ya, Approve</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById('approveButton').addEventListener('click', function() {
            // Tampilkan modal verifikasi
            const verifyModal = new bootstrap.Modal(document.getElementById('verifyModal'));
            verifyModal.show();
        });

        document.getElementById('confirmApprove').addEventListener('click', function() {
            document.getElementById('approveForm').submit();
        });
    </script>
@endsection
