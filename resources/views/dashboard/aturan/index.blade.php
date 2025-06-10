@extends('layouts.appV1')

@push('styles-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endpush

@section('content')
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <h1 class="h3 d-inline align-middle">Data Aturan</h1>
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
                    <i class="align-middle me-2" data-feather="book"></i>
                    <h5 class="card-title mb-0">Data Aturan</h5>
                </div>
                <a href="{{ route('aturan.create') }}" class="btn btn-primary btn-sm">
                    <i class="align-middle me-2" data-feather="plus"></i> Tambah Aturan
                </a>
            </div>
            <div class="card-body">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="col-md-8 col-xl-12 mb-3">
                    <table id="aturanTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kondisi</th>
                                <th>Kategori</th>
                                <th>Rekomendasi</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($aturan->count() === 0)
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data</td>
                                </tr>
                            @else
                                @foreach ($aturan as $index => $item)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $item->kondisi }}</td>
                                        <td>{{ $item->kategori }}</td>
                                        <td>{{ $item->rekomendasi }}</td>
                                        <td>
                                            <a href="{{ route('aturan.edit', $item->id_aturan) }}"
                                                class="btn btn-sm btn-warning">
                                                <i class="align-middle" data-feather="edit"></i> Edit
                                            </a>
                                            <form action="{{ route('aturan.destroy', $item->id_aturan) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Yakin ingin menghapus aturan ini?')">
                                                    <i class="align-middle" data-feather="trash-2"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
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
            $('#aturanTable').DataTable();
        });
    </script>
@endpush
