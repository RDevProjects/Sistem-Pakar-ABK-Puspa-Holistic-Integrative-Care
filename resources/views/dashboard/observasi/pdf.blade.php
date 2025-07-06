<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hasil Observasi Puspa HIC</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            font-size: 12px;
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo {
            width: 80px;
            height: auto;
        }
        .title {
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
        }
        .date {
            font-size: 12px;
            color: #666;
        }
        .section {
            margin-bottom: 20px;
        }
        .section-title {
            font-size: 14px;
            font-weight: bold;
            margin-bottom: 10px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }
        .info-grid {
            display: table;
            width: 100%;
            margin-bottom: 15px;
        }
        .info-row {
            display: table-row;
        }
        .info-cell {
            display: table-cell;
            padding: 3px 10px 3px 0;
            vertical-align: top;
        }
        .info-label {
            font-weight: bold;
            width: 120px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            font-size: 10px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 6px;
            text-align: left;
        }
        th {
            background-color: #f5f5f5;
            font-weight: bold;
        }
        .page-break {
            page-break-before: always;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ public_path('assets/logo-puspa.webp') }}" alt="Logo Puspa HIC" class="logo">
        <div class="title">Hasil Observasi Puspa HIC</div>
        <div class="date">{{ \Carbon\Carbon::parse($observasi->created_at)->translatedFormat('d F Y, H:i') }} WIB</div>
    </div>

    <div class="section">
        <div class="section-title">Data Observasi</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-cell info-label">Nama Anak:</div>
                <div class="info-cell">{{ $observasi->nama_anak }}</div>
            </div>
            <div class="info-row">
                <div class="info-cell info-label">Usia:</div>
                <div class="info-cell">{{ $observasi->usia }} bulan</div>
            </div>
            <div class="info-row">
                <div class="info-cell info-label">Tanggal:</div>
                <div class="info-cell">{{ $observasi->tanggal }}</div>
            </div>
            <div class="info-row">
                <div class="info-cell info-label">Koordinator:</div>
                <div class="info-cell">{{ $observasi->koordinator }}</div>
            </div>
            <div class="info-row">
                <div class="info-cell info-label">Observer:</div>
                <div class="info-cell">{{ $observasi->observer }}</div>
            </div>
        </div>
    </div>

    <div class="section">
        <div class="section-title">Hasil Observasi</div>
        <div class="info-grid">
            <div class="info-row">
                <div class="info-cell info-label">Total Skor:</div>
                <div class="info-cell">{{ number_format($observasi->hasil->first()->total_skor, 2) }}</div>
            </div>
            <div class="info-row">
                <div class="info-cell info-label">Kategori:</div>
                <div class="info-cell">{{ $observasi->hasil->first()->kategori }}</div>
            </div>
            <div class="info-row">
                <div class="info-cell info-label">Rekomendasi:</div>
                <div class="info-cell">{{ $observasi->hasil->first()->rekomendasi }}</div>
            </div>
            @if($observasi->hasil->first()->kesimpulan)
            <div class="info-row">
                <div class="info-cell info-label">Kesimpulan:</div>
                <div class="info-cell">{{ $observasi->hasil->first()->kesimpulan }}</div>
            </div>
            @endif
        </div>
    </div>

    <div class="section">
        <div class="section-title">Detail Jawaban Observasi</div>
        <table>
            <thead>
                <tr>
                    <th>Aspek</th>
                    <th>Yang Diamati</th>
                    <th>Jawaban</th>
                    <th>Keyakinan</th>
                    <th>CF</th>
                    <th>Skor Hasil</th>
                    <th>Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($observasi->jawaban as $jawaban)
                    <tr>
                        <td>{{ $jawaban->poin->aspek }}</td>
                        <td>{{ $jawaban->poin->deskripsi }}</td>
                        <td>{{ $jawaban->jawaban }}</td>
                        <td>{{ ($jawaban->jawaban == 'YA' ? $jawaban->mb : $jawaban->md) * 100 }}%</td>
                        <td>{{ number_format($jawaban->cf, 2) }}</td>
                        <td>{{ number_format($jawaban->skor_hasil, 2) }}</td>
                        <td>{{ $jawaban->keterangan ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="footer">
        <p>Dokumen ini digenerate secara otomatis oleh sistem Puspa HIC</p>
        <p>Tanggal: {{ date('d/m/Y H:i') }}</p>
    </div>
</body>
</html> 