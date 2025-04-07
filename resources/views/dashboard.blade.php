@extends('layouts.main')

@section('title', 'Laporan Produksi')

@section('content')
    
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
