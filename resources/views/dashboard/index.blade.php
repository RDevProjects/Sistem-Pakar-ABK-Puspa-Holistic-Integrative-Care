@extends('layouts.appV1')

@push('styles-css')
@endpush

@section('title')
    <div class="mb-4 d-flex justify-content-between align-items-center">
        <div>
            <h1 class="h3"><strong>Selamat Datang di {{ env('APP_NAME') }}</strong></h1>
            <h3 class="h4">Sistem pakar analisa ABK yang digunakan untuk mendeteksi awal gejala pada anak.
            </h3>
        </div>
        <div>
            <h5 class="p-2 bg-white rounded-pill h5">
                {{ \Carbon\Carbon::now()->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</h5>
        </div>
    </div>
@endsection

@section('content')
    <div class="col-xl-12 col-xxl-12 d-flex">
        <div class="w-100">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="mt-0 col">
                                    <h5 class="card-title">Data Users</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="align-middle" data-feather="users"></i>
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-1 mb-3">{{ $users }}</h1>
                            <div class="mb-0">
                                <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>
                                    {{ $users }}</span>
                                <span class="text-muted">Data yang ada didatabase</span>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="mt-0 col">
                                    <h5 class="card-title">Data Aturan</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="align-middle" data-feather="book"></i>
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-1 mb-3">{{ $aturan }}</h1>
                            <div class="mb-0">
                                <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>
                                    {{ $aturan }}</span>
                                <span class="text-muted">Data yang ada didatabase</span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="mt-0 col">
                                    <h5 class="card-title">Data Point Observasi</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="align-middle" data-feather="book"></i>
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-1 mb-3">{{ $poin }}</h1>
                            <div class="mb-0">
                                <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>{{ $poin }}
                                </span>
                                <span class="text-muted">Data yang ada didatabase</span>
                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="mt-0 col">
                                    <h5 class="card-title">Data Hasil Observasi</h5>
                                </div>

                                <div class="col-auto">
                                    <div class="stat text-primary">
                                        <i class="align-middle" data-feather="check-circle"></i>
                                    </div>
                                </div>
                            </div>
                            <h1 class="mt-1 mb-3">{{ $hasil }}</h1>
                            <div class="mb-0">
                                <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> {{ $hasil }}
                                </span>
                                <span class="text-muted">Data yang ada didatabase</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content3')
    <div class="col-12 col-lg-12 col-xxl-12 d-flex">
        <div class="card flex-fill">
            <div class="card-header">

                <h5 class="mb-0 card-title">Data Obeservasi</h5>
            </div>
            <table class="table my-0 table-hover">
                <thead>
                    <tr>
                        <th>No</th>
                        <th class="d-none d-xl-table-cell">ID Observasi</th>
                        <th class="d-none d-xl-table-cell">Total Skor Observasi</th>
                        <th class="d-none d-xl-table-cell">Kategori</th>
                        <th class="d-none d-xl-table-cell">Rekomendasi</th>
                        <th class="d-none d-xl-table-cell">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $no = 1;
                    @endphp
                    @foreach ($dataHasil as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td class="d-none d-xl-table-cell">{{ $item->id_observasi }}</td>
                            <td class="d-none d-xl-table-cell">{{ $item->total_skor }} Skor</td>
                            <td class="d-none d-xl-table-cell">{{ $item->kategori }}</td>
                            <td class="d-none d-xl-table-cell">{{ $item->rekomendasi }}</td>
                            <td class="d-none d-xl-table-cell">
                                <a class="btn btn-sm btn-primary"
                                    href="{{ route('observasi.result', $item->id_observasi) }}">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000);
            var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
            document.getElementById("datetimepicker-dashboard").flatpickr({
                inline: true,
                prevArrow: "<span title=\"Previous month\">&laquo;</span>",
                nextArrow: "<span title=\"Next month\">&raquo;</span>",
                defaultDate: defaultDate
            });
        });
    </script>
@endpush
