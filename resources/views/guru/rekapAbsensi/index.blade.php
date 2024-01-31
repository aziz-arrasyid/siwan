@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-sm-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">{{ $dataTitle }}</h4>
                </div>
                {{-- <div class="pl-3 btn-new border-left">
                    <button type="button" class="btn btn-success mt-2" data-toggle="modal" data-target=".modal-add-data">{{ $addData }}</button>
                </div> --}}
            </div>
            <div class="card-body">
                <div class="table-responsive rounded bg-white">
                    <table id="tableYearSemesters" class="table data-table table-striped">
                        <thead>
                            <tr class="light">
                                <th>No</th>
                                <th>Hari</th>
                                <th>Tanggal</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($WaktuAbsensiKelas as $waktuAbsensiKelas)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $waktuAbsensiKelas->hari }}</td>
                                <td>{{ $waktuAbsensiKelas->tanggal }}</td>
                                <td>
                                    <div class="btn-group btn-group-toggle btn-group-flat">
                                        <a class="button btn button-icon bg-primary" id="rekap_absensi_button" data-id="{{ $waktuAbsensiKelas->id }}" data-toggle="modal" data-target="#modal_rekap_absensi" href="#">Rekap absensi</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Modal for rekap absensi -->
                <div class="modal fade modal-rekap-absensi" tabindex="-1" role="dialog" id="modal_rekap_absensi" aria-hidden="true">
                    <div class="modal-dialog modal-xl">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <div class="table-responsive">
                                <div class="row justify-content-between">
                                    <div class="col-sm-6 col-md-6">
                                        <div id="user_list_datatable_info" class="dataTables_filter">
                                        <form class="mr-3 position-relative">
                                            <div class="form-group mb-0">
                                                <input type="text" class="form-control" id="input_search" placeholder="Search"
                                                    aria-controls="user-list-table">
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <div class="user-list-files d-flex">
                                        <a class="bg-primary" href="#" id="pdfAbsensi">
                                            PDF
                                        </a>
                                        </div>
                                    </div>
                                </div>
                                <table id="user-list-table" class="table table-striped dataTable mt-4" role="grid"
                                    aria-describedby="user-list-page-info">
                                    <thead>
                                        <tr class="ligth">
                                            <th>Guru</th>
                                            <th>Jenis kelamin</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_absensi_guru_kelas">
                                        <tr>
                                            <td id="nama_guru"></td>
                                            <td id="jenis_kelamin_guru"></td>
                                            <td id="status_guru"></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table id="user-list-table" class="table table-striped dataTable mt-4" role="grid"
                                    aria-describedby="user-list-page-info">
                                    <thead>
                                        <tr class="ligth">
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Jenis kelamin</th>
                                        <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody id="table_absensi_siswa_kelas">
                                        {{--  --}}
                                    </tbody>
                                </table>
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Modal for rekap absensi -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        let id
        $(document).on('click', '#rekap_absensi_button', function() {
            id = $(this).data('id')
            let container = $('#table_absensi_siswa_kelas')
            container.empty()

            $('#nama_guru').text('')
            $('#jenis_kelamin_guru').text('')
            $('#status_guru').text('')
            $.ajax({
                url: `/dashboard-guru/get-absensi-kelas/${id}`,
                method: 'GET',
                success: function(response) {
                    if(response.absensiFirst) {
                        $('#nama_guru').text(response.absensiFirst.teacher.full_name)
                        $('#jenis_kelamin_guru').text(response.absensiFirst.teacher.gender == 'L' ? 'Laki-laki' : 'Perempuan')
                        $('#status_guru').html(`<span class="${response.absensiFirst.status_guru == 'Hadir' ? 'badge bg-success-light' :
                        (response.absensiFirst.status_guru == 'Izin' ? 'badge bg-primary' :
                        (response.absensiFirst.status_guru == 'Sakit' ? 'badge bg-warning-light' : 'badge bg-danger-light'))}">${response.absensiFirst.status_guru}</span>`)
                    }
                    response.absensikelas.forEach(function(item, index) {
                        let html = `
                        <tr class="tr_absensi_kelas">
                            <td>${index + 1}</td>
                            <td>${item.student.full_name}</td>
                            <td>${item.student.gender == 'L' ? 'Laki-laki' : 'Perempuan'}</td>
                            <td><span class="${item.status == 'Hadir' ? 'badge bg-success-light' :
                                (item.status == 'Izin' ? 'badge bg-primary' : (item.status == 'Sakit' ? 'badge bg-warning-light' : 'badge bg-danger-light'))}">
                                ${item.status}
                                </span>
                            </td>
                        </tr>
                        `
                        container.append(html)
                    })
                },
                error: function(error) {
                    console.log(error)
                }
            })
        })

        $(document).on('click', '#pdfAbsensi', function() {
            $.ajax({
                url: `/dashboard-guru/cek-pdf-absensi/${id}`,
                method: 'GET',
                success: function(response) {
                    window.location.href = `/dashboard-guru/pdf-absensi/${id}`
                },
                error: function(error) {
                    $('#modal_rekap_absensi').modal('hide')
                    Swal.fire({
                        title: `${error.responseJSON.error}`,
                        text: "",
                        icon: "error"
                    });
                }
            })
        })

        $(document).on('input', '#input_search', function() {
            const search = $(this).val().toLowerCase()
            $('.tr_absensi_kelas').each(function() {
                const $row = $(this);
                const rowText = $row.text().toLowerCase();

                // Tentukan apakah baris harus ditampilkan atau disembunyikan
                if (rowText.indexOf(search) !== -1) {
                    $row.show();
                } else {
                    $row.hide();
                }
            });
        })
    })
</script>
@endpush
