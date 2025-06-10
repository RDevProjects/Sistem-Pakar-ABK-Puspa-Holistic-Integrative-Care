@extends('layouts.appV1')

@section('content')
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <h1 class="h3 d-inline align-middle">Tambah Aturan</h1>
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
                    <i class="align-middle me-2" data-feather="plus"></i>
                    <h5 class="card-title mb-0">Tambah Aturan</h5>
                </div>
                <a href="{{ route('aturan.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('aturan.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Kondisi</label>
                        <input type="text" name="kondisi" class="form-control" value="{{ old('kondisi') }}" required>
                        <small class="text-muted">Contoh: total_skor >= 8 AND total_skor <= 14</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <input type="text" name="kategori" class="form-control" value="{{ old('kategori') }}" required>
                        <small class="text-muted">Contoh: Ringan</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rekomendasi</label>
                        <input type="text" name="rekomendasi" class="form-control" value="{{ old('rekomendasi') }}"
                            required>
                        <small class="text-muted">Contoh: Asesmen Lanjutan</small>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="align-middle me-2" data-feather="save"></i> Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
