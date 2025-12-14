<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Kegiatan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            font-size: 9pt;
            line-height: 1.4;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 3px solid #2563eb;
        }

        .header h1 {
            font-size: 18pt;
            color: #1e40af;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .header p {
            font-size: 9pt;
            color: #666;
        }

        .filter-info {
            background-color: #f3f4f6;
            padding: 10px 15px;
            margin-bottom: 15px;
            border-radius: 5px;
            border-left: 4px solid #3b82f6;
        }

        .filter-info h3 {
            font-size: 10pt;
            color: #1e40af;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .filter-item {
            display: inline-block;
            margin-right: 20px;
            margin-bottom: 5px;
        }

        .filter-item strong {
            color: #374151;
        }

        .filter-item span {
            color: #6b7280;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            background-color: white;
        }

        thead {
            background-color: #1e40af;
            color: white;
        }

        thead th {
            padding: 10px 8px;
            text-align: left;
            font-weight: bold;
            font-size: 9pt;
            border: 1px solid #1e3a8a;
        }

        tbody td {
            padding: 8px;
            border: 1px solid #e5e7eb;
            font-size: 8pt;
        }

        tbody tr:nth-child(even) {
            background-color: #f9fafb;
        }

        tbody tr:hover {
            background-color: #eff6ff;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .status-badge {
            display: inline-block;
            padding: 3px 8px;
            border-radius: 3px;
            font-size: 7pt;
            font-weight: bold;
            text-align: center;
        }

        .status-belum {
            background-color: #fef3c7;
            color: #92400e;
        }

        .status-berlangsung {
            background-color: #dbeafe;
            color: #1e40af;
        }

        .status-selesai {
            background-color: #d1fae5;
            color: #065f46;
        }

        .lpj-disetujui {
            background-color: #d1fae5;
            color: #065f46;
        }

        .lpj-belum {
            background-color: #fee2e2;
            color: #991b1b;
        }

        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 2px solid #e5e7eb;
            text-align: center;
            font-size: 8pt;
            color: #6b7280;
        }

        .summary {
            background-color: #eff6ff;
            padding: 10px 15px;
            margin-top: 15px;
            border-radius: 5px;
            border-left: 4px solid #3b82f6;
        }

        .summary-item {
            display: inline-block;
            margin-right: 25px;
            font-size: 9pt;
        }

        .summary-item strong {
            color: #1e40af;
        }

        .no-data {
            text-align: center;
            padding: 40px;
            color: #9ca3af;
            font-style: italic;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="header">
        <h1>LAPORAN REKAPITULASI KEGIATAN</h1>
        <p>Dicetak pada: {{ $generatedAt }}</p>
    </div>

    <!-- Filter Info -->
    @if (count($filterInfo) > 0)
        <div class="filter-info">
            <h3>Filter yang Diterapkan:</h3>
            @foreach ($filterInfo as $key => $value)
                <div class="filter-item">
                    <strong>{{ $key }}:</strong> <span>{{ $value }}</span>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Table -->
    @if (count($data) > 0)
        <table>
            <thead>
                <tr>
                    <th width="4%" class="text-center">No</th>
                    <th width="15%">Lembaga</th>
                    <th width="25%">Kegiatan</th>
                    <th width="10%" class="text-center">Tgl Mulai</th>
                    <th width="10%" class="text-center">Tgl Selesai</th>
                    <th width="13%" class="text-right">Dana Disetujui</th>
                    <th width="12%" class="text-center">Status Kegiatan</th>
                    <th width="11%" class="text-center">Status LPJ</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $totalDana = 0;
                @endphp
                @foreach ($data as $index => $item)
                    @php
                        $now = now()->format('Y-m-d');
                        if ($item->start_date > $now) {
                            $activityStatus = 'Belum Dimulai';
                            $statusClass = 'status-belum';
                        } elseif ($item->end_date < $now) {
                            $activityStatus = 'Selesai';
                            $statusClass = 'status-selesai';
                        } else {
                            $activityStatus = 'Berlangsung';
                            $statusClass = 'status-berlangsung';
                        }

                        $totalDana += $item->funds_approved;
                    @endphp
                    <tr>
                        <td class="text-center">{{ $index + 1 }}</td>
                        <td>{{ $item->organization_name }}</td>
                        <td>{{ $item->activity_name }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($item->start_date)->format('d M Y') }}</td>
                        <td class="text-center">{{ \Carbon\Carbon::parse($item->end_date)->format('d M Y') }}</td>
                        <td class="text-right">Rp {{ number_format($item->funds_approved, 0, ',', '.') }}</td>
                        <td class="text-center">
                            <span class="status-badge {{ $statusClass }}">{{ $activityStatus }}</span>
                        </td>
                        <td class="text-center">
                            @if ($item->lpj_status == 'Disetujui')
                                <span class="status-badge lpj-disetujui">Disetujui</span>
                            @elseif($item->lpj_status == 'Belum Disetor')
                                <span class="status-badge lpj-belum">Belum Disetor</span>
                            @else
                                <span>-</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Summary -->
        <div class="summary">
            <div class="summary-item">
                <strong>Total Kegiatan:</strong> {{ count($data) }} kegiatan
            </div>
            <div class="summary-item">
                <strong>Total Dana:</strong> Rp {{ number_format($totalDana, 0, ',', '.') }}
            </div>
        </div>
    @else
        <div class="no-data">
            <p>Tidak ada data kegiatan yang sesuai dengan filter yang diterapkan.</p>
        </div>
    @endif

    <!-- Footer -->
    <div class="footer">
        <p>Dokumen ini digenerate secara otomatis oleh sistem | Confidential Document</p>
    </div>
</body>

</html>
