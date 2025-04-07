@extends('layouts.main')

@section('title', 'Buat Laporan Produksi')

@section('content')

    <div class="mb-3">
        <a href="{{ route('production.index') }}" class="btn btn-secondary">Kembali</a>
    </div>

    <form action="{{ route('create_production') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="type_production" class="mb-1 mt-2">Produksi:</label>
                    <input type="text" class="form-control" id="type_productions" name="type_productions" required>
                </div>

                <div class="form-group">
                    <label for="date_production" class="mb-1 mt-2">Tanggal:</label>
                    <input type="date" class="form-control" id="date_production" name="date_production" required>
                </div>

                <div class="form-group">
                    <label for="ip" class="mb-1 mt-2">IP:</label>
                    <input type="text" class="form-control" id="ip" name="ip" required>
                </div>

                <div class="form-group">
                    <label for="ok" class="mb-1 mt-2">OK:</label>
                    <input type="number" class="form-control" id="ok" name="ok" required>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="name" class="mb-1 mt-2">Nama Karyawan:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="shift" class="mb-1 mt-2">Shift:</label>
                    <input type="text" class="form-control" id="shift" name="shift" required>
                </div>

                <div class="form-group">
                    <label for="no_lot" class="mb-1 mt-2">No. Lot:</label>
                    <input type="text" class="form-control" id="no_lot" name="no_lot" required>
                </div>

                <div class="form-group">
                    <label for="ng" class="mb-1 mt-2">NG:</label>
                    <input type="number" class="form-control" id="ng" name="ng" required>
                </div>
                
            </div>
        </div>

        <div class="form-group">
            <label for="description" class="mb-1 mt-2">Keterangan:</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>

        <div class="mt-2 mb-2 text-end">
            <button type="submit" class="btn btn-primary">Tambah Laporan</button>
        </div>
    </form>

@endsection

@section('scripts')
    <script>
        function openModal() {
            document.getElementById("reportModal").style.display = "flex";
        }

        function closeModal() {
            document.getElementById("reportModal").style.display = "none";
        }
    </script>
@endsection
