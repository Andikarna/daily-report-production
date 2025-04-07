@extends('layouts.main')

@section('title', 'Update Laporan')

@section('content')
    <div class="container mt-4">
        <h3 class="mb-4">Detail Laporan Produksi</h3>

        <!-- Informasi Utama Report_Production -->
        <div class="card mb-4">
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
        <div class="card mb-4">
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

        <div class="d-flex justify-content-between align-items-center">
          <a href="{{ route('report_approval') }}" class="btn btn-secondary">Kembali</a>
          <form action="{{ route('report_approve', ['id' => $report->id]) }}" method="POST">
              @csrf
              <button type="submit" class="btn btn-success">Approve</button>
          </form>
      </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Tambahkan script jika diperlukan
    </script>
@endsection
