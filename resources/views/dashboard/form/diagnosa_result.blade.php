@extends('layouts.appV1')

@push('styles-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .progress-bar-custom {
            height: 20px;
            font-size: 14px;
        }

        .card-header {
            font-weight: bold;
        }

        .tooltip-info {
            cursor: pointer;
            color: #007bff;
        }

        .table th,
        .table td {
            vertical-align: middle;
        }

        .alert-error {
            font-size: 1.1rem;
        }
    </style>
@endpush

@section('content')
    <div class="container my-5">
        <!-- Judul Utama -->
        <div class="text-center mb-4">
            <h2 class="fw-bold">Hasil Diagnosa Anak Berkebutuhan Khusus</h2>
            <p class="text-muted">
                Berikut adalah hasil analisis berdasarkan gejala yang Anda masukkan.
                Sistem telah memproses data menggunakan metode <i>Forward Chaining</i> untuk mendeteksi potensi kebutuhan
                khusus.
            </p>
        </div>

        <!-- Tampilkan pesan error jika ada -->
        @if ($error_message)
            <div class="alert alert-danger alert-error text-center">
                {{ $error_message }}
                <br>
                Silakan masukkan gejala lain atau hubungi profesional untuk evaluasi lebih lanjut.
            </div>
            <div class="text-end">
                <a href="/dashboard" class="btn btn-primary btn-lg">
                    <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>
        @else
            <!-- Hasil Diagnosa -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-primary">
                    <h4 class="mb-0 text-white">Ringkasan Diagnosa</h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>ID Diagnosa</th>
                                <th>Jenis Kebutuhan Khusus</th>
                                <th>Tingkat Kepastian</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>{{ $diagnosa->diagnosa_id }}</td>
                                <td>
                                    {{ $diagnosa_dipilih['kode_abk']->nama_abk }}
                                    <small class="text-muted">({{ $diagnosa_dipilih['kode_abk']->kode_abk }})</small>
                                </td>
                                <td>
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-custom bg-success" role="progressbar"
                                            style="width: {{ round($diagnosa_dipilih['value'] * 100, 2) }}%"
                                            aria-valuenow="{{ round($diagnosa_dipilih['value'] * 100, 2) }}"
                                            aria-valuemin="0" aria-valuemax="100">
                                            {{ round($diagnosa_dipilih['value'] * 100, 2) }}%
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Detail Diagnosa -->
            <div class="row">
                <!-- Data Pakar -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-primary">
                            <h5 class="mb-0 text-white">Penilaian Pakar</h5>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="table-primary">
                                    <tr>
                                        <th>No</th>
                                        <th>Gejala</th>
                                        <th>MB <i class="fas fa-info-circle tooltip-info"
                                                title="Measure of belief (tingkat keyakinan)"></i></th>
                                        <th>MD <i class="fas fa-info-circle tooltip-info"
                                                title="Measure of disbelief (tingkat ketidakyakinan)"></i></th>
                                        <th>Nilai Keyakinan <i class="fas fa-info-circle tooltip-info" title="MB - MD"></i>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pakar as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->kode_gejala }}</td>
                                            <td>{{ number_format($item->mb, 2) }}</td>
                                            <td>{{ number_format($item->md, 2) }}</td>
                                            <td>{{ number_format($item->mb - $item->md, 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <small class="text-muted">
                                <i class="fas fa-info-circle"></i> MB: Keyakinan pakar bahwa gejala benar. MD:
                                Ketidakyakinan pakar terhadap gejala.
                            </small>
                        </div>
                    </div>
                </div>

                <!-- Data Gejala Pengguna -->
                <div class="col-md-6 mb-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-danger">
                            <h5 class="mb-0 text-white">Gejala yang Dimasukkan</h5>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead class="table-danger">
                                    <tr>
                                        <th>Kode Gejala</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($gejala_by_user as $key)
                                        <tr>
                                            <td>{{ $key[0] }}</td>
                                            <td>{{ number_format($key[1], 2) }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <small class="text-muted">
                                <i class="fas fa-info-circle"></i> Nilai menunjukkan tingkat kepastian gejala berdasarkan
                                input pengguna.
                            </small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kesimpulan Akhir -->
            <div class="card mb-4 shadow-sm">
                <div class="card-header bg-success">
                    <h5 class="mb-0 text-white">Kesimpulan Diagnosa</h5>
                </div>
                <div class="card-body">
                    <h5 class="fw-bold">{{ $diagnosa_dipilih['kode_abk']->nama_abk }}</h5>
                    <p>
                        Berdasarkan analisis, anak memiliki potensi mengalami
                        <strong>{{ $diagnosa_dipilih['kode_abk']->nama_abk }}</strong>
                        dengan tingkat kepastian
                        <span class="fw-bold text-success fs-4">{{ round($diagnosa_dipilih['value'] * 100, 2) }}%</span>.
                    </p>
                    <p class="text-muted">
                        <i class="fas fa-info-circle"></i> Hasil ini hanya sebagai deteksi awal.
                        Konsultasikan dengan profesional (psikolog atau dokter) untuk penanganan lebih lanjut.
                    </p>
                </div>
            </div>

            <!-- Tombol Aksi -->
            <div class="text-end">
                <a href="/dashboard" class="btn btn-primary btn-lg">
                    <i class="fas fa-arrow-left"></i> Kembali ke Dashboard
                </a>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.table').DataTable({
                "paging": false,
                "searching": false,
                "info": false
            });
        });
    </script>
@endpush
