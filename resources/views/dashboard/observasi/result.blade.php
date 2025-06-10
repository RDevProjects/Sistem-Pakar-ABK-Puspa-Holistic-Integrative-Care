<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hasil Observasi Puspa HIC</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-2xl font-bold mb-6 text-center">Hasil Observasi</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Observation Metadata -->
        <div class="mb-6">
            <h2 class="text-xl font-semibold">Data Observasi</h2>
            <p><strong>Nama Anak:</strong> {{ $observasi->nama_anak }}</p>
            <p><strong>Usia:</strong> {{ $observasi->usia }} tahun</p>
            <p><strong>Tanggal:</strong> {{ $observasi->tanggal }}</p>
            <p><strong>Koordinator:</strong> {{ $observasi->koordinator }}</p>
            <p><strong>Observer:</strong> {{ $observasi->observer }}</p>
        </div>

        <!-- Observation Answers -->
        <h2 class="text-xl font-semibold mb-4">Jawaban Observasi</h2>
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

        <!-- Result -->
        <div class="mt-6">
            <h2 class="text-xl font-semibold">Hasil</h2>
            <p><strong>Total Skor:</strong> {{ number_format($observasi->hasil->first()->total_skor, 2) }}</p>
            <p><strong>Kategori:</strong> {{ $observasi->hasil->first()->kategori }}</p>
            <p><strong>Rekomendasi:</strong> {{ $observasi->hasil->first()->rekomendasi }}</p>
            <p><strong>Kesimpulan:</strong> {{ $observasi->hasil->first()->kesimpulan ?? '-' }}</p>
        </div>

        <a href="{{ route('observasi.create') }}"
            class="mt-4 inline-block bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Kembali ke Form</a>
    </div>
</body>

</html>
