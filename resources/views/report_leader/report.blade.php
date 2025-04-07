@extends('layouts.main')

@section('title', 'Laporan Harian')

@section('content')
    <div class="card shadow rounded p-4" style="height: 90vh;">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Laporan Operator</h2>
            <form method="GET" id="filterForm" action="{{ route('report_approval') }}" class="d-flex gap-2 flex-wrap">
                <select name="filter_operator" class="form-select rounded" style="max-width: 200px;"
                    onchange="document.getElementById('filterForm').submit()">
                    <option value="">-- Filter Operator --</option>
                    @foreach ($divisions as $division)
                        <option value="{{ $division->id }}"
                            {{ request('filter_operator') == $division->id ? 'selected' : '' }}>
                            {{ $division->name }}
                        </option>
                    @endforeach
                </select>

                <div class="input-group">
                    <input type="text" name="search" class="form-control rounded-start" placeholder="Cari Produksi..."
                        value="{{ request()->get('search') }}" oninput="document.getElementById('filterForm').submit()">
                    <button class="btn btn-outline-secondary rounded-end" type="submit">Cari</button>
                </div>
            </form>
        </div>

        {{-- Notifikasi --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded shadow-sm" role="alert">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show rounded shadow-sm" role="alert">
                {{ session('error') }}
            </div>
        @endif

        {{-- Tabel --}}
        <div class="table-responsive" style="max-height: 70vh; overflow-y: auto;">
            <table class="table table-hover table-bordered align-middle rounded shadow-sm">
                <thead class="table-dark text-center sticky-top">
                    <tr>
                        <th>No</th>
                        <th>Operator</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Shift</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = ($reports->currentPage() - 1) * $reports->perPage(); @endphp
                    @foreach ($reports as $report)
                        <tr class="text-center">
                            <td>{{ ++$i }}</td>
                            <td>{{ $report->division->name }}</td>
                            <td>{{ $report->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($report->date_production)->format('d F Y') }}</td>
                            <td>{{ $report->shift }}</td>
                            <td>
                                <span
                                    class="badge {{ $report->status == 'Belum Approve' ? 'bg-danger' : 'bg-success' }} rounded-pill px-3 py-2">
                                    {{ $report->status }}
                                </span>
                            </td>
                            <td>
                                <div class="dropdown dropstart">
                                    <a href="#" id="dropdownMenuButton" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="bi bi-three-dots-vertical"
                                            style="font-size: 1.5rem; cursor: pointer;"></i>
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <li><a class="dropdown-item" href="{{ route('detail_report', $report->id) }}"><i
                                                    class="bi bi-eye"></i> Lihat Data</a></li>
                                        @if ($report->status != 'Sudah Approve')
                                            <li><a class="dropdown-item" href="{{ route('edit_report', $report->id) }}"><i
                                                        class="bi bi-pencil"></i> Edit Data</a></li>
                                        @endif
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-3">
            {{ $reports->links('vendor.pagination.bootstrap-4') }}
            <p class="text-muted">Menampilkan data {{ $reports->firstItem() }} sampai {{ $reports->lastItem() }} dari
                total
                {{ $reports->total() }} data.</p>
        </div>
    </div>
@endsection
