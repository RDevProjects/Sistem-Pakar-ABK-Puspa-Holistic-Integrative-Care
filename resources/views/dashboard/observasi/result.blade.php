<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hasil Observasi Puspa HIC</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @media print {
            body { margin: 0; padding: 20px; }
            .no-print { display: none !important; }
            .print-break { page-break-before: always; }
            table { page-break-inside: avoid; }
        }
    </style>
</head>

<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <img src="{{ asset('assets/logo-puspa.webp') }}" alt="Logo Puspa HIC" class="w-auto h-16">
        <div class="my-6 text-center">
            <h1 class="text-2xl font-bold">Hasil Observasi</h1>
            {{ \Carbon\Carbon::parse($observasi->created_at)->translatedFormat('d F Y, H:i') }} WIB
        </div>
        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Observation Metadata -->
        <div class="flex mb-6 space-x-6">
            <div class="w-1/2">
                <h2 class="text-xl font-bold">Data Observasi</h2>
                <p><strong>Nama Anak:</strong> {{ $observasi->nama_anak }}</p>
                <p><strong>Usia:</strong> {{ $observasi->usia }} bulan</p>
                <p><strong>Tanggal:</strong> {{ $observasi->tanggal }}</p>
                <p><strong>Koordinator:</strong> {{ $observasi->koordinator }}</p>
                <p><strong>Observer:</strong> {{ $observasi->observer }}</p>
            </div>
            <div class="w-1/2">
                <h2 class="text-xl font-bold">Hasil</h2>
                <p><strong>Total Skor:</strong> {{ number_format($observasi->hasil->first()->total_skor, 2) }}</p>
                <p><strong>Kategori:</strong> {{ $observasi->hasil->first()->kategori }}</p>
                <p><strong>Rekomendasi:</strong> {{ $observasi->hasil->first()->rekomendasi }}</p>
                <p><strong>Kesimpulan:</strong> {{ $observasi->hasil->first()->kesimpulan ?? '-' }}</p>
            </div>
        </div>

        <!-- Observation Answers -->
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold">Jawaban Observasi</h2>
            <div class="flex space-x-2 no-print">
                <button onclick="window.print()" class="inline-block bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path>
                    </svg>
                    Print
                </button>
                <a href="{{ route('observasi.download', $observasi->id_observasi) }}" class="inline-block bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                    </svg>
                    Download PDF
                </a>
                <a href="{{ Auth::user()->role == 'admin' ? route('observasi.admin.index') : route('observasi.user.index') }}" class="inline-block bg-purple-900 text-white px-4 py-2 rounded hover:bg-purple-800">
                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Aspek</th>
                    <th class="border p-2">Yang Diamati</th>
                    <th class="border p-2">Jawaban</th>
                    <th class="border p-2">Keyakinan</th>
                    <th class="border p-2">CF</th>
                    <th class="border p-2">Skor Hasil</th>
                    <th class="border p-2">Keterangan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($observasi->jawaban as $jawaban)
                    <tr>
                        <td class="border p-2">{{ $jawaban->poin->aspek }}</td>
                        <td class="border p-2">{{ $jawaban->poin->deskripsi }}</td>
                        <td class="border p-2">{{ $jawaban->jawaban }}</td>
                        <td class="border p-2">{{ ($jawaban->jawaban == 'YA' ? $jawaban->mb : $jawaban->md) * 100 }}%
                        </td>
                        <td class="border p-2">{{ number_format($jawaban->cf, 2) }}</td>
                        <td class="border p-2">{{ number_format($jawaban->skor_hasil, 2) }}</td>
                        <td class="border p-2">{{ $jawaban->keterangan ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>
