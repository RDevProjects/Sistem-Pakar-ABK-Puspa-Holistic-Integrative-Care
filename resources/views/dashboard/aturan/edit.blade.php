@extends('layouts.appV1')

@section('content')
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <h1 class="h3 d-inline align-middle">Edit Aturan</h1>
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
                    <i class="align-middle me-2" data-feather="edit"></i>
                    <h5 class="card-title mb-0">Edit Aturan</h5>
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

                <form action="{{ route('aturan.update', $aturan->id_aturan) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label class="form-label">Kondisi</label>
                        <input type="text" name="kondisi" class="form-control"
                            value="{{ old('kondisi', $aturan->kondisi) }}" required>
                        <small class="text-muted">Contoh: total_skor >= 8 AND total_skor <= 14</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kategori</label>
                        <input type="text" name="kategori" class="form-control"
                            value="{{ old('kategori', $aturan->kategori) }}" required>
                        <small class="text-muted">Contoh: Ringan</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Rekomendasi</label>
                        <input type="text" name="rekomendasi" class="form-control"
                            value="{{ old('rekomendasi', $aturan->rekomendasi) }}" required>
                        <small class="text-muted">Contoh: Asesmen Lanjutan</small>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="align-middle me-2" data-feather="save"></i> Update
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
