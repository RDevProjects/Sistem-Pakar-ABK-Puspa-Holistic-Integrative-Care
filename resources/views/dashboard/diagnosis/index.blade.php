@extends('layouts.appV1')

@push('styles-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endpush

@section('content')
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <h1 class="h3 d-inline align-middle">Data Diagnosis</h1>
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
                    <h5 class="card-title mb-0">Data Diagnosis</h5>
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
                <div class="col-md-8 col-xl-12 mb-3">
                    <table id="userTable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Diagnosa ID</th>
                                <th>Tingkat Depresi</th>
                                <th>Persentase</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                use App\Models\JenisAbk;

                                $no = 1;
                                $jenisAbkMap = JenisAbk::all()->keyBy('kode_abk');
                            @endphp

                            @if ($dataDiagnosis->count() === 0)
                                <tr>
                                    <td colspan="5" class="text-center">Tidak ada data</td>
                                </tr>
                            @else
                                @foreach ($dataDiagnosis as $item)
                                    @php
                                        $data_diagnosa = json_decode($item->data_diagnosa, true);
                                        $diagnosa_dipilih = collect($data_diagnosa)->sortByDesc('value')->first();
                                        $kodeAbk = $jenisAbkMap[$diagnosa_dipilih['kode_abk']] ?? null;
                                    @endphp
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $item->diagnosa_id }}</td>
                                        <td>
                                            @if ($kodeAbk)
                                                {{ $kodeAbk->kode_abk }} | {{ $kodeAbk->nama_abk }}
                                            @else
                                                <em>Data tidak ditemukan</em>
                                            @endif
                                        </td>
                                        <td>{{ number_format($diagnosa_dipilih['value'] * 100, 2) }} %</td>
                                        <td>
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ route('spk.result', ['diagnosa_id' => $item->diagnosa_id]) }}">Detail</a>
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

    {{-- <!-- Modal Delete Diagnosis -->
    <div class="modal fade" id="deleteGejalaModal" tabindex="-1" aria-labelledby="deleteGejalaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteGejalaModalLabel">Delete Diagnosis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus gejala ini beserta relasinya?
                </div>
                <div class="modal-footer">
                    <form id="deleteGejalaForm" action="" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="hidden" name="user_id" id="deleteGejalaId" value="">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $('#userTable').DataTable();
    </script>
    {{-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#deleteGejalaModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var gejalaId = button.data('gejala-id');

                var modal = $(this);
                modal.find('#deleteGejalaId').val(gejalaId);
                modal.find('#deleteGejalaForm').attr('action', '/dashboard/gejala/destroy/' + gejalaId);
            });
        });
    </script> --}}
@endpush
