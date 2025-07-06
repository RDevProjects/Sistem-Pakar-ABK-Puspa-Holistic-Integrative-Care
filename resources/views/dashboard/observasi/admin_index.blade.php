@extends('layouts.appV1')

@push('styles-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endpush

@section('content')
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <h1 class="h3 d-inline align-middle">Daftar Observasi Semua User</h1>
        <h5 class="p-2 bg-white rounded-pill h5">
            {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
        </h5>
    </div>
@endsection

@section('content2')
    <div class="col-md-8 col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="align-middle me-2" data-feather="users"></i>
                    <h5 class="card-title mb-0">Data Observasi Semua User</h5>
                </div>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="col-md-8 col-xl-12 mb-3">
                    <table id="observasiAdminTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama User</th>
                                <th>Nama Anak</th>
                                <th>Usia (bulan)</th>
                                <th>Tanggal</th>
                                <th>Total Skor</th>
                                <th>Kategori</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($observasi as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->user->name ?? '-' }}</td>
                                    <td>{{ $item->nama_anak }}</td>
                                    <td>{{ $item->usia }}</td>
                                    <td>{{ $item->tanggal }}</td>
                                    <td>{{ $item->hasil->first()->total_skor ?? '-' }}</td>
                                    <td>{{ $item->hasil->first()->kategori ?? '-' }}</td>
                                    <td>
                                        <a href="{{ route('observasi.result', $item->id_observasi) }}" class="btn btn-sm btn-info">Detail</a>
                                        <a href="{{ route('observasi.download', $item->id_observasi) }}" class="btn btn-sm btn-success">Download PDF</a>
                                        <form action="{{ route('observasi.destroy', $item->id_observasi) }}" method="POST" style="display:inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Belum ada data observasi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#observasiAdminTable').DataTable();
        });
    </script>
@endpush 