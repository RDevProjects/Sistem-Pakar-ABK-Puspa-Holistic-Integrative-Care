@extends('layouts.appV1')

@section('content')
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <h1 class="h3 d-inline align-middle">Tambah Poin Observasi</h1>
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
                    <h5 class="card-title mb-0">Tambah Poin Observasi</h5>
                </div>
                <a href="{{ route('poin_observasi.index') }}" class="btn btn-secondary btn-sm">Kembali</a>
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

                <form action="{{ route('poin_observasi.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Aspek</label>
                        <select name="aspek" class="form-control" required>
                            <option value="" disabled selected>Pilih Aspek</option>
                            <option value="Perilaku dan Emosi" {{ old('aspek') == 'Perilaku dan Emosi' ? 'selected' : '' }}>
                                Perilaku dan Emosi</option>
                            <option value="Fisik dan Motorik" {{ old('aspek') == 'Fisik dan Motorik' ? 'selected' : '' }}>
                                Fisik dan Motorik</option>
                            <option value="Bahasa dan Bicara" {{ old('aspek') == 'Bahasa dan Bicara' ? 'selected' : '' }}>
                                Bahasa dan Bicara</option>
                            <option value="Kognitif dan Akademik"
                                {{ old('aspek') == 'Kognitif dan Akademik' ? 'selected' : '' }}>Kognitif dan Akademik
                            </option>
                            <option value="Sosialisasi" {{ old('aspek') == 'Sosialisasi' ? 'selected' : '' }}>Sosialisasi
                            </option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Deskripsi</label>
                        <input type="text" name="deskripsi" class="form-control" value="{{ old('deskripsi') }}" required>
                        <small class="text-muted">Contoh: Hiperaktif atau bergerak tidak bertujuan</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Skor</label>
                        <select name="skor" class="form-control" required>
                            <option value="" disabled selected>Pilih Skor</option>
                            <option value="1" {{ old('skor') == '1' ? 'selected' : '' }}>1</option>
                            <option value="2" {{ old('skor') == '2' ? 'selected' : '' }}>2</option>
                            <option value="3" {{ old('skor') == '3' ? 'selected' : '' }}>3</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="align-middle me-2" data-feather="save"></i> Simpan
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
