@extends('layouts.appV1')

@push('styles-css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
@endpush

@section('content')
    <div class="mb-3 d-flex justify-content-between align-items-center">
        <h1 class="h3 d-inline align-middle">Data Gejala</h1>
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
                    <h5 class="card-title mb-0">Data Gejala</h5>
                </div>
                <button type="button" class="btn btn-md btn-success d-flex align-items-center" data-bs-toggle="modal"
                    data-bs-target="#addGejalaModal"><i class="align-middle me-2" data-feather="book"></i>Tambah
                    Data</button>
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
                                <th>Kode Gejala</th>
                                <th>Nama Gejala</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($dataGejala as $gejala)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $gejala->kode_gejala }}</td>
                                    <td>{{ $gejala->nama_gejala }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#editGejalaModal"
                                            data-gejala-id="{{ $gejala->id }}">Edit</button>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteGejalaModal"
                                            data-gejala-id="{{ $gejala->id }}">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Add Gejala -->
    <div class="modal fade" id="addGejalaModal" tabindex="-1" aria-labelledby="addGejalaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addGejalaModalLabel">Tambah Data Gejala</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('gejala.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="kode_gejala" class="form-label">Kode Gejala</label><span
                                class="text-danger">*</span>
                            <input type="text" class="form-control" id="kode_gejala" name="kode_gejala" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_gejala" class="form-label">Nama Gejala</label><span
                                class="text-danger">*</span>
                            <input type="text" class="form-control" id="nama_gejala" name="nama_gejala" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Edit Gejala -->
    <div class="modal fade" id="editGejalaModal" tabindex="-1" aria-labelledby="editGejalaModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editGejalaModalLabel">Edit Data Gejala</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editGejalaForm" action="{{ route('gejala.update', $gejala->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="kode_gejala" class="form-label">Kode Gejala</label><span
                                class="text-danger">*</span>
                            <input type="text" class="form-control" id="kode_gejala" name="kode_gejala"
                                value="{{ $gejala->kode_gejala }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="nama_gejala" class="form-label">Nama Gejala</label><span
                                class="text-danger">*</span>
                            <input type="text" class="form-control" id="nama_gejala" name="nama_gejala"
                                value="{{ $gejala->nama_gejala }}" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Delete Gejala -->
    <div class="modal fade" id="deleteGejalaModal" tabindex="-1" aria-labelledby="deleteGejalaModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteGejalaModalLabel">Delete Gejala</h5>
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
    </div>
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script>
        $('#userTable').DataTable();
    </script>
    <script>
        $(document).ready(function() {
            $('[data-bs-target="#editGejalaModal"]').on('click', function() {
                var gejalaId = $(this).data('gejala-id');

                $.ajax({
                    url: '/dashboard/gejala/show/' + gejalaId,
                    method: 'GET',
                    success: function(data) {
                        $('#editGejalaModal #kode_gejala').val(data.kode_gejala);
                        $('#editGejalaModal #nama_gejala').val(data.nama_gejala);

                        // $('#editGejalaForm').attr('action', '/dashboard/gejala/update/' +
                        //     gejalaId);
                    },
                    error: function(xhr) {
                        alert('Terjadi kesalahan saat memuat data gejala: ' + xhr.responseText);
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('#deleteGejalaModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var gejalaId = button.data('gejala-id');

                var modal = $(this);
                modal.find('#deleteGejalaId').val(gejalaId);
                modal.find('#deleteGejalaForm').attr('action', '/dashboard/gejala/destroy/' + gejalaId);
            });
        });
    </script>
@endpush
