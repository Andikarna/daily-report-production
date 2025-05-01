@extends('layouts.main')

@section('title', 'Laporan Bulanan Produksi')

@section('content')
    <div class="container">
        <div class="row bg-white shadow rounded py-3 px-3 mb-3">
            <h4>Laporan Bulanan Produksi</h4>
            <small class="text-muted">Informasi mengenai laporan dalam periode bulan.</small>
        </div>

        <div class="row shadow bg-white p-3 rounded mb-3">
            {{-- Form Pencarian --}}
            <div class="col-md-3">
                <form method="GET" action="{{ route('reportMonthly') }}" id="search-form">
                    <label for="search-input" class="form-label">Cari Produksi</label>
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Masukkan kata kunci..."
                            value="{{ request()->get('search') }}" id="search-input">
                        <button class="btn btn-outline-secondary" type="submit">Cari</button>
                    </div>
                </form>
            </div>

            {{-- Form Filter Divisi dan Tanggal --}}
            <div class="col-md-6">
                <form method="GET" action="{{ route('reportMonthly') }}">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="divisiFilter" class="form-label">Filter Divisi</label>
                            <select name="divisi" id="divisiFilter" class="form-control" onchange="this.form.submit()">
                                <option value="">Semua Divisi</option>
                                @foreach ($division as $data)
                                    <option value="{{ $data->id }}"
                                        {{ request()->get('divisi') == $data->id ? 'selected' : '' }}>
                                        {{ $data->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="bulanFilter" class="form-label">Filter Bulan & Tahun</label>
                            <input type="month" name="bulan" id="bulanFilter" class="form-control"
                                value="{{ $bulan }}" onchange="this.form.submit()">
                        </div>
                    </div>
                </form>
            </div>

            {{-- Form Generate Report --}}
            <div class="col-md-3 d-flex align-items-end justify-content-end">
                <form>
                    @csrf
                    {{-- Hidden input untuk membawa filter pencarian yang sedang aktif --}}
                    {{-- <input type="hidden" name="search" value="{{ request()->get('search') }}">
                    <input type="hidden" name="divisi" value="{{ request()->get('divisi') }}">
                    <input type="hidden" name="tanggal" value="{{ request()->get('tanggal') }}"> --}}

                    <a href="{{ route('generate', [$bulan ?? now()->format('Y-m-d')]) }}" type="submit"
                        class="btn btn-success w-100" target="_blank">
                        <i class="bi bi-file-earmark-arrow-down"></i> Cetak Laporan
                    </a>
                </form>
            </div>

        </div>

        <div class="row bg-white shadow rounded p-3 mb-3">
            <table class="table table-striped">
                <thead class="thead-dark">
                    <tr>
                        <th>No</th>
                        <th>Nama IP</th>
                        <th>Nama Leader</th>
                        <th>Divisi</th>
                        <th>Achievement</th>
                        <th>Tanggal</th>
                    </tr>
                </thead>
                <tbody id="reportTableBody">
                    @php
                        use App\Models\User;
                        use App\Models\Division;
                        use Carbon\Carbon;

                        $i = ($produksi->currentPage() - 1) * $produksi->perPage();
                    @endphp
                    <!-- Data laporan produksi akan dimasukkan di sini -->
                    @foreach ($produksi as $item)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $item->ip }}</td>
                            <td>{{ User::where('id', $item->reportApproval->approval_id)->pluck('name')->first() }}</td>
                            <td>{{ Division::where('id', $item->reportApproval->divisi_id)->pluck('name')->first() }}</td>
                            <td>{{ $item->achievement }}%</td>
                            <td>{{ \Carbon\Carbon::parse($item->date_production)->translatedFormat('l, d F Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{ $produksi->links('vendor.pagination.bootstrap-4') }}
        <p>Menampilkan data {{ $produksi->firstItem() }} sampai {{ $produksi->lastItem() }} dari total
            {{ $produksi->total() }} data.</p>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const input = document.getElementById("search-input");
            let timer;
            const delay = 700; // waktu tunggu setelah user selesai ngetik (dalam milidetik)

            input.addEventListener("input", function() {
                clearTimeout(timer);
                timer = setTimeout(() => {
                    document.getElementById("search-form").submit();
                }, delay);
            });

            // Set fokus ke input saat halaman reload
            input.focus();
            // Letakkan cursor di akhir teks
            const val = input.value;
            input.value = '';
            input.value = val;
        });
    </script>
@endsection

<style>
    .table {
        border-radius: 0.5rem;
        overflow: hidden;
    }

    .table th,
    .table td {
        border: 1px solid #dee2e6;
    }

    .table th {
        background-color: #343a40;
        color: white;
    }

    /* .container {
        background-color: #f8f9fa;
        border-radius: 0.5rem;
        padding: 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    } */
</style>
