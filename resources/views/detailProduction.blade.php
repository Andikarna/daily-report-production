@extends('layouts.main')

@section('title', 'Buat Laporan Produksi')

@section('content')
    <div class="container">
        <h1>Detail Produksi</h1>
        <table class="table">
            <tr>
                <th>Jenis Produksi</th>
                <td>{{ $detailProduction->type_productions }}</td>
            </tr>
            <tr>
                <th>Nama</th>
                <td>{{ $detailProduction->name }}</td>
            </tr>
            <tr>
                <th>Tanggal Produksi</th>
                <td>{{ \Carbon\Carbon::parse($detailProduction->date_production)->format('d F Y') }}</td>
            </tr>
            <tr>
                <th>Shift</th>
                <td>{{ $detailProduction->shift }}</td>
            </tr>
            <tr>
                <th>IP</th>
                <td>{{ $detailProduction->ip }}</td>
            </tr>
            <tr>
                <th>No Lot</th>
                <td>{{ $detailProduction->no_lot }}</td>
            </tr>
            <tr>
                <th>OK</th>
                <td>{{ $detailProduction->ok }}</td>
            </tr>
            <tr>
                <th>NG</th>
                <td>{{ $detailProduction->ng }}</td>
            </tr>
            <tr>
                <th>Total</th>
                <td>{{ $detailProduction->ok + $detailProduction->ng }}</td>
            </tr>
            <tr>
                <th>Deskripsi</th>
                <td>{{ $detailProduction->description }}</td>
            </tr>
        </table>
        <a href="{{ route('production.index') }}"href="#" class="btn btn-primary">Kembali</a>
    </div>
@endsection
