@extends('layouts.appV1')

@push('styles-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <style>
        .form-check-input:checked+.form-check-label {
            background-color: #154b5e !important;
            /* Warna lebih gelap atau sesuai keinginan */
            color: white !important;
            /* Warna teks ketika aktif */
            border-color: #154b5e !important;
        }

        .form-check-label {
            transition: all 0.3s ease;
        }

        .form-check-label:hover {
            color: #154b5e !important;
        }
    </style>
@endpush

@section('content')
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <h1 class="h3 d-inline align-middle">Diagnosa Anak Kebutuhan Khusus</h1>
        <h5 class="p-2 bg-white rounded-pill h5">
            {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</h5>
    </div>
@endsection
@section('content2')
    <div class="col-md-8 col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center">
                    <i class="align-middle me-2" data-feather="book"></i>
                    <h5 class="card-title mb-0">Diagnosa Anak Kebutuhan Khusus</h5>
                </div>
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
                <form method="post" enctype="multipart/form-data" action="{{ route('spk.store') }}" novalidate>
                    @csrf
                    <div class="mb-4 text-center fs-4">
                        <span><strong>Dalam 2 minggu terakhir</strong>, seberapa sering masalah-masalah berikut ini
                            mengganggu
                            kamu?</span><br>
                        <span class="text-muted">Tidak semua field harus diisi, jadi pastikan untuk memberikan jawaban yang
                            tepat sesuai dengan pengalamanmu.</span>
                    </div>

                    @foreach ($gejala as $item)
                        <div class="mb-4">
                            <label class="form-label text-center d-block fw-bold fs-4">
                                {{ $loop->iteration }}. Apakah anda merasa anak anda mengalami {{ $item->nama_gejala }}?
                                <span class="text-danger">*</span>
                            </label>

                            <div class="d-flex justify-content-center flex-wrap gap-2">
                                @foreach ($kondisi_user as $kondisi)
                                    <div class="form-check form-check-inline mt-2">
                                        <input class="form-check-input visually-hidden" type="radio"
                                            name="input_{{ $loop->parent->iteration }}"
                                            id="choice_{{ $loop->parent->iteration }}_{{ $loop->iteration }}"
                                            value="{{ $kondisi->nilai }}"
                                            onchange="document.getElementById('kondisi_{{ $item->kode_gejala }}{{ $loop->parent->iteration }}').value = this.value">

                                        <label class="form-check-label btn btn-outline-info px-3 py-2 rounded-pill"
                                            for="choice_{{ $loop->parent->iteration }}_{{ $loop->iteration }}"
                                            style="background-color: #f1f4f5; border-color: #d0d9e3;"
                                            onmouseover="this.style.color='#154b5e'"
                                            onmouseout="this.style.color='#17a2b8'">
                                            {{ $kondisi->kondisi }}
                                        </label>
                                    </div>
                                @endforeach

                                <input type="hidden" name="kondisi[{{ $item->kode_gejala }}]"
                                    id="kondisi_{{ $item->kode_gejala }}{{ $loop->iteration }}" value="" />
                            </div>
                        </div>
                    @endforeach

                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-outline-info p-3 w-25 rounded-pill"
                            style="background-color: #f1f4f5; border-color: #d0d9e3;"
                            onmouseover="this.style.color='#154b5e'" onmouseout="this.style.color='#17a2b8'">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
@endpush
