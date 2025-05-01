@extends('layouts.main')

@section('title', 'Laporan Produksi')

@section('content')
    <div class="row mb-4 shadow-sm p-2 bg-white rounded d-flex justify-content-between">
        <div class="d-flex justify-content-between">
            <div>
                <h4>Laporan Produksi</h4>
                <small class="text-muted">Informasi semua laporan produksi dari operator.</small>
            </div>
            
            <div class="d-flex align-items-center">
                <!-- Search Form -->
                <form method="GET" action="{{ route('production.index') }}" class="me-3">
                    <div class="input-group">
                        <input type="text" id="search-input" name="search" class="form-control"
                            placeholder="Cari Produksi..." value="{{ request()->get('search') }}">
                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    </div>
                </form>
            </div>
        </div>

    </div>


    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
        </div>
    @endif


    <div class="shadow-sm p-2 bg-white rounded mb-2" style="overflow-x: auto; white-space: nowrap; height: 70vh;">
        <table class="table">
            <thead class="thead-light">
                <tr>
                    <th style="white-space: nowrap; text-align: center;">No</th>
                    <th style="white-space: nowrap; text-align: center;">Operator</th>
                    <th style="white-space: nowrap; text-align: center;">Nama Operator</th>
                    <th style="white-space: nowrap; text-align: center;">Tanggal</th>
                    <th style="white-space: nowrap; text-align: center;">Shift</th>
                    <th style="white-space: nowrap; text-align: center;">Leader</th>
                    <th style="white-space: nowrap; text-align: center;">Status</th>
                    <th style="white-space: nowrap; text-align: center;">Actions</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $i = ($reports->currentPage() - 1) * $reports->perPage();
                @endphp
                @foreach ($reports as $production)
                    <tr class="text-center">
                        <td>{{ ++$i }}</td>
                        <td>{{ $production->division->name }}</td>
                        <td>{{ $production->report->name }}</td>
                        <td>{{ \Carbon\Carbon::parse($production->report->date_production)->format('d F Y') }}</td>
                        <td>{{ $production->report->shift }}</td>
                        <td>{{ $production->approval->name }}</td>
                        <td>
                            @if ($production->status == 'Approve')
                                <button style="width: 100px"
                                    class="btn btn-sm bordered btn-success">{{ $production->status }}</button>
                            @elseif ($production->status == 'Reject')
                                <button style="width: 100px"
                                    class="btn btn-sm bordered btn-danger">{{ $production->status }}</button>
                            @else
                                <button style="width: 100px"
                                    class="btn btn-sm bordered btn-primary">{{ $production->status }}</button>
                            @endif

                        </td>
                        <td>
                            <div class="dropdown">
                                <a href="#" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-three-dots" style="font-size: 1.5rem; cursor: pointer;"></i>
                                </a>
                                <ul class="dropdown-menu z-50" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item" href="{{ route('updateProduction', $production->id) }}">
                                            <i class="bi bi-eye"></i> Check Data</a></li>

                                </ul>

                                {{-- <form id="delete-form-{{ $production->id }}"
                                    action="{{ route('deleteProduction', $production->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form> --}}
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{ $reports->links('vendor.pagination.bootstrap-4') }}
    <p>Menampilkan data {{ $reports->firstItem() }} sampai {{ $reports->lastItem() }} dari total
        {{ $reports->total() }} data.</p>
@endsection

@section('scripts')
    <script>
        function openModal() {
            document.getElementById("reportModal").style.display = "flex";
        }

        function closeModal() {
            document.getElementById("reportModal").style.display = "none";
        }

        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                document.getElementById('delete-form-' + id).submit();
            }
        }
    </script>
@endsection
