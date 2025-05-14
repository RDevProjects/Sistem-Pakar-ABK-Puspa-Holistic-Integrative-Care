@extends('layouts.appV1')

@push('styles-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endpush

@section('content')
    <div class="container my-4">
        {{-- Hasil Diagnosa --}}
        <div class="card mb-4 shadow">
            <div class="card-header bg-primary">
                <h4 class="mb-0 text-light">Hasil Diagnosa</h4>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Diagnosa ID</th>
                            <th>Tingkat Depresi</th>
                            <th>Persentase</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>{{ $diagnosa->diagnosa_id }}</td>
                            <td>{{ $diagnosa_dipilih['kode_abk']->kode_abk }} |
                                {{ $diagnosa_dipilih['kode_abk']->nama_abk }}</td>
                            <td><strong>{{ round($diagnosa_dipilih['value'] * 100, 2) }}%</strong></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Detail Pakar, User, CF Gabungan --}}
        <div class="row">
            {{-- Data Pakar --}}
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-header bg-primary">
                        <h5 class="mb-0 text-light">Data Pakar</h5>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-primary">
                                <tr>
                                    <th>No</th>
                                    <th>Gejala</th>
                                    <th>MB - MD</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pakar as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->kode_gejala }} | {{ $item->kode_abk }}</td>
                                        <td>{{ $item->mb - $item->md }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="fst-italic">
                            <span
                                title="MB (Measure of Belief) menunjukkan seberapa percaya seorang pakar terhadap suatu fakta atau aturan adalah benar, berdasarkan bukti">MB
                                (Measure of Belief)
                            </span> | <span
                                title="MD (Measure of Disbelief) menunjukkan seberapa tidak percaya (penolakan) terhadap fakta atau aturan yang diberikan.">MD
                                (Measure of Disbelief)</span>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Data User --}}
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-header bg-danger">
                        <h5 class="mb-0 text-light">Data User</h5>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-danger">
                                <tr>
                                    <th>Gejala</th>
                                    <th>Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($gejala_by_user as $key)
                                    <tr>
                                        <td>{{ $key[0] }}</td>
                                        <td>{{ $key[1] }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- CF Gabungan --}}
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-header bg-info">
                        <h5 class="mb-0 text-light">Certainty Factor (CF) Gabungan</h5>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table table-bordered table-striped table-hover">
                            <thead class="table-info">
                                <tr>
                                    <th>Nilai CF</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cf_kombinasi['cf'] as $key)
                                    <tr>
                                        <td>{{ $key }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kesimpulan --}}
        <div class="card mb-4 shadow">
            <div class="card-header bg-success">
                <h5 class="mb-0 text-light">Kesimpulan Akhir</h5>
            </div>
            <div class="card-body">
                <h5>
                    {{ $diagnosa_dipilih['kode_abk']->kode_abk }} |
                    {{ $diagnosa_dipilih['kode_abk']->nama_abk }}
                </h5>
                <p>
                    Dapat disimpulkan bahwa anak mengalami
                    <strong>{{ $diagnosa_dipilih['kode_abk']->nama_abk }}</strong>
                    dengan tingkat kepastian sebesar
                    <span class="fw-bold fs-4 text-success">{{ round($hasil['value'] * 100, 2) }}%</span>.
                </p>
            </div>
        </div>

        {{-- Tombol Kembali --}}
        <div class="text-end">
            <a href="/dashboard" class="btn btn-primary">KEMBALI</a>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
@endpush
