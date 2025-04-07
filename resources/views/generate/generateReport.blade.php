<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Laporan Produksi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 40px;
        }

        .header {
            text-align: center;
            margin-bottom: 10px;
        }

        .header h1 {
            margin: 0;
            font-size: 24pt;
            font-weight: bold;
        }

        .header h2 {
            margin: 0;
            font-size: 16pt;
            font-weight: normal;
        }

        h3 {
            text-align: center;
            margin: 30px 0 20px;
        }

        .table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }

        .table th,
        .table td {
            padding: 0.75rem;
            vertical-align: top;
            border: 1px solid #dee2e6;
        }

        .table thead th {
            background-color: #f8f9fa;
            font-weight: bold;
            text-align: left;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: #f2f2f2;
        }

        .footer {
            text-align: right;
            margin-top: 40px;
            font-size: 10pt;
        }
    </style>
</head>
<body>

    <!-- Header Perusahaan -->
    <div class="header">
        <h1>PT Aneka Komkar Utama</h1>
        <h2>Laporan Produksi</h2>
    </div>

    <!-- Tabel Data -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>IP</th>
                <th>Achievement</th>
                <th>Tanggal Produksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $item->ip }}</td>
                    <td>{{ $item->achievement }}%</td>
                    <td>{{ \Carbon\Carbon::parse($item->date_production)->translatedFormat('l, d F Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Footer -->
    <div class="footer">
        Dicetak pada: {{ \Carbon\Carbon::now()->translatedFormat('l, d F Y H:i') }}
    </div>

</body>
</html>
