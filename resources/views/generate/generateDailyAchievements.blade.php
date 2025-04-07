<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Bulanan Achievement</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ffffff;
        }

        .container {
            width: 100%;
            max-width: 800px;
            margin: 30px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            align-items: center;
            border-bottom: 2px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }

        .header img {
            height: 70px;
            margin-right: 15px;
        }

        .header-text {
            display: flex;
            flex-direction: column;
        }

        .header-text h1 {
            font-size: 24px;
            color: #333;
            margin: 0;
        }

        .header-text p {
            font-size: 14px;
            color: #666;
            margin: 4px 0 0 0;
        }

        .content p.intro {
            font-size: 14px;
            line-height: 1.6;
            color: #444;
            margin-bottom: 25px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            font-size: 14px;
        }

        th,
        td {
            padding: 8px 12px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
            text-align: center;
        }

        td {
            text-align: left;
        }

        .footer {
            margin-top: 30px;
            font-size: 13px;
        }

        .signature {
            text-align: right;
            margin-top: 60px;
            font-size: 14px;
        }

        .signature div {
            margin-top: 40px;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <img src="{{ public_path('assets/images/akku-logo.png') }}" alt="Logo PT Aneka Komkar Utama">
            <div class="header-text">
                <h1>PT Aneka Komkar Utama</h1>
                <p>Rubber Component Manufacturing</p>
            </div>
        </div>

        <!-- Intro -->
        <div class="content">
            <p class="intro">
                Berikut ini merupakan <strong>Laporan Bulanan Achievement</strong> yang memuat pencapaian setiap
                operator selama periode berjalan.
                Laporan ini disusun berdasarkan data harian yang telah dikumpulkan, kemudian dikelompokkan berdasarkan
                nama dan grup masing-masing.
                Kami berharap laporan ini dapat menjadi bahan evaluasi dan acuan untuk peningkatan performa di periode
                mendatang.
            </p>

            <!-- Tabel -->
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Group</th>
                        <th>Nama</th>
                        <th>Tanggal</th>
                        <th>Persentase</th>
                    </tr>
                </thead>
                {{-- <tbody>
                    @php
                        use Carbon\Carbon;
                        use App\Models\MainGroup;
                        $no = 0;
                        $groupedResults = $result->groupBy('operator_id');
                    @endphp

                    @foreach ($groupedResults as $operatorId => $dataGroup)
                        @php
                            $userName = $dataGroup->first()->operator->name;
                            $groupCode = MainGroup::where('user_id', $operatorId)->first()->group->code ?? '-';
                            $totalAchievement = $dataGroup->sum('achievement');
                        @endphp

                        @foreach ($dataGroup as $data)
                            <tr>
                                <td style="text-align: center;">{{ ++$no }}</td>
                                <td style="text-align: center;">{{ $groupCode }}</td>
                                <td style="text-align: center;">{{ $userName }}</td>
                                <td style="text-align: center;">
                                    {{ Carbon::parse($data->date_production)->format('d F Y') }}</td>
                                <td style="text-align: center;">{{ $data->achievement }}%</td>
                            </tr>
                        @endforeach

                        <tr>
                            <td colspan="4" style="text-align: right; font-weight: bold;">Total untuk
                                {{ $userName }}</td>
                            <td style="font-weight: bold; text-align: center;">{{ $totalAchievement }}%</td>
                        </tr>
                    @endforeach
                </tbody> --}}

                <tbody>
                    @php
                        use App\Models\MainGroup;
                        use Carbon\Carbon;
                        $no = 0;
                        $groupedResults = $result->groupBy('operator_id');
                    @endphp

                    @foreach ($groupedResults as $operatorId => $dataGroup)
                        @php
                            $userName = $dataGroup->first()->operator->name;
                            $groupCode = MainGroup::where('user_id', $operatorId)->first()->group->code ?? '-';
                            $totalAchievement = $dataGroup->sum('achievement');
                            $groupByDate = $dataGroup->groupBy('date_production');
                        @endphp

                        @foreach ($groupByDate as $date => $items)
                            @php
                                $sumAchievementPerDate = $items->sum('achievement');
                            @endphp
                            <tr>
                                <td style="text-align: center;">{{ ++$no }}</td>
                                <td style="text-align: center;">{{ $groupCode }}</td>
                                <td style="text-align: center;">{{ $userName }}</td>
                                <td style="text-align: center;">{{ Carbon::parse($date)->format('d F Y') }}</td>
                                <td style="text-align: center;">{{ $sumAchievementPerDate }}%</td>
                            </tr>
                        @endforeach

                        <tr>
                            <td colspan="4" style="text-align: right; font-weight: bold;">Total untuk
                                {{ $userName }}</td>
                            <td style="font-weight: bold; text-align: center;">{{ $totalAchievement }}%</td>
                        </tr>
                    @endforeach
                </tbody>


            </table>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>Tanggal Cetak:</strong> {{ now()->format('d F Y') }}</p>
        </div>

        <!-- Tanda Tangan -->
        <div class="signature">
            <p>Hormat Kami,</p>
            <div>
                <p>__________________________</p>
                <p><strong>( .......................)</strong></p>
            </div>
        </div>
    </div>
</body>

</html>
