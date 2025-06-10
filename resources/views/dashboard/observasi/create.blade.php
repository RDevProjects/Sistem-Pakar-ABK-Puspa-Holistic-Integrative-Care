<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Form Observasi Puspa HIC</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 p-6">
    <div class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <img src="{{ asset('assets/logo-puspa.webp') }}" alt="Logo Puspa HIC" class="w-auto h-16">
        <div class="my-6 text-center">
            <h1 class="text-2xl font-bold">Form Observasi (Usia 2-5 Tahun)</h1>
            {{ \Carbon\Carbon::parse(now())->translatedFormat('d F Y, H:i') }} WIB
        </div>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 rounded mb-6">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('observasi.store') }}" method="POST" class="space-y-6">
            @csrf
            <!-- Observation Metadata -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-gray-700">Nama Anak</label>
                    <input type="text" name="nama_anak" value="{{ old('nama_anak') }}"
                        class="w-full p-2 border rounded" required placeholder="Masukkan nama anak">
                </div>
                <div>
                    <label class="block text-gray-700">Usia</label>
                    <input type="number" name="usia" value="{{ old('usia') }}" class="w-full p-2 border rounded"
                        min="2" max="5" required placeholder="Masukkan usia anak (2-5 tahun)">
                </div>
                <div>
                    <label class="block text-gray-700">Tanggal Observasi</label>
                    <input type="date" name="tanggal" value="{{ old('tanggal') }}" class="w-full p-2 border rounded"
                        required>
                </div>
                <div>
                    <label class="block text-gray-700">Koordinator</label>
                    <input type="text" name="koordinator" value="{{ old('koordinator') }}"
                        class="w-full p-2 border rounded" required placeholder="Masukkan nama koordinator">
                </div>
                <div>
                    <label class="block text-gray-700">Observer</label>
                    <input type="text" name="observer" value="{{ old('observer') }}"
                        class="w-full p-2 border rounded" required placeholder="Masukkan nama observer">
                </div>
            </div>

            <!-- Observation Points -->
            @foreach ($poin as $aspek => $items)
                <h2 class="text-xl font-semibold mt-6">{{ $aspek }}</h2>
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-200">
                            <th class="border p-2">Yang Diamati</th>
                            <th class="border p-2">Jawaban</th>
                            <th class="border p-2">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr>
                                <td class="border p-2">{{ $item->deskripsi }} (Skor: {{ $item->skor }})</td>
                                <td class="border p-2">
                                    <select name="jawaban[{{ $item->id_poin }}]" class="w-full p-2 border rounded"
                                        required>
                                        <option value="" disabled selected>Pilih Jawaban</option>
                                        <option value="YA"
                                            {{ old('jawaban.' . $item->id_poin) == 'YA' ? 'selected' : '' }}>YA
                                        </option>
                                        <option value="TIDAK"
                                            {{ old('jawaban.' . $item->id_poin) == 'TIDAK' ? 'selected' : '' }}>TIDAK
                                        </option>
                                    </select>
                                    <!-- Hidden Keyakinan field set to 100% -->
                                    <input type="hidden" name="keyakinan[{{ $item->id_poin }}]" value="100">
                                    {{-- <td class="border p-2">
                                    <input type="number" name="keyakinan[{{ $item->id_poin }}]"
                                        value="{{ old('keyakinan.' . $item->id_poin, 100) }}"
                                        class="w-full p-2 border rounded" min="0" max="100" required>
                                </td> --}}
                                </td>
                                <td class="border p-2">
                                    <input type="text" name="keterangan[{{ $item->id_poin }}]"
                                        value="{{ old('keterangan.' . $item->id_poin) }}"
                                        class="w-full p-2 border rounded" placeholder="Masukkan keterangan (opsional)">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach

            <!-- Conclusion -->
            <div>
                <label class="block text-gray-700">Kesimpulan</label>
                <textarea name="kesimpulan" class="w-full p-2 border rounded" placeholder="Masukkan kesimpulan (opsional)">{{ old('kesimpulan') }}</textarea>
            </div>

            <button type="submit" class="bg-purple-900 text-white font-semibold p-2 rounded w-full">Proses
                Observasi</button>
        </form>
    </div>
</body>

</html>
