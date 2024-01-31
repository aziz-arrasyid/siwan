@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-sm-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">{{ $dataTitle }}</h4>
                </div>
                <div class="pl-3 btn-new border-left" style="display: none" id="kembali_button">
                    <button type="button" class="btn btn-warning mt-2">Kembali</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive rounded bg-white" id="waktu_absensi_table">
                    <table id="tableYearSemesters" class="table data-table table-striped">
                        <thead>
                            <tr class="light">
                                <th class="text-center">No</th>
                                <th class="text-center">Kelas</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Kelas as $kelas)
                            <tr>
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $kelas->classroom_name }}</td>
                                <td class="text-center">
                                    <div class="btn-group btn-group-toggle btn-group-flat">
                                        <a class="button btn button-icon bg-success editData" id="absensi_button" href="#" data-id="{{ $kelas->id }}">Absensi</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="table-responsive rounded bg-white" id="absensi_table" style="display: none">
                    <table id="tableYearSemesters" class="table data-table table-striped">
                        <thead>
                            <tr class="light">
                                <th class="text-center">No</th>
                                <th class="text-center">Hari</th>
                                <th class="text-center">Tanggal</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_waktu_absensi">
                            {{--  --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Edit Data -->
<div class="modal fade modal-edit-data" id="modal-absensi-data" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title absensi-judul">Absensi kelas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form_absensi" enctype="multipart/form-data">
                    <div class="row align-items-center">
                        <div class="form-group col-sm-6">
                            <span class="text-danger error" id="error_guru" style="display: none">Guru kosong</span>
                            <select id="teacher_id" name="teacher_id" class="form-control">
                                <option selected disabled>Pilih salah satu</option>
                                @foreach ($Guru as $guru)
                                <option value="{{ $guru->id }}">{{ $guru->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <span class="text-danger error" id="error_status_guru" style="display: none">Absensi guru kosong</span>
                            <select id="status_guru" name="status_guru" class="form-control">
                                <option selected disabled>Pilih salah satu</option>
                                <option value="Hadir">Hadir</option>
                                <option value="Izin">Izin</option>
                                <option value="Sakit">Sakit</option>
                                <option value="Alpha">Alpha</option>
                            </select>
                        </div>
                    </div>
                    <div id="data_siswa">
                        {{--  --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" id="close-modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal for Edit Data -->
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        let id
        let isAdaData
        let waktu_absensi_id
        let get_siswa_absensi
        let nama_kelas

        $('#modal-absensi-data').on('shown.bs.modal', function () {
            $('#teacher_id').select2({
                width: '100%',
                theme: 'bootstrap4'
            });
        });

        $(document).on('click', '#absensi_button', function() {
            id = $(this).data('id')
            $('#absensi_table').css('display', 'block')
            $('#kembali_button').css('display', 'block')
            $('#waktu_absensi_table').css('display', 'none')

            //create waktu absensi atomatis
            $.ajax({
                url: '{{ route('waktuabsensi.store') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    classroom_id: id
                },
                success: function(response) {
                    //
                },
                error: function(err) {
                    //
                }
            })

            //show waktu absensi/jurusan
            $.ajax({
                url: `/dashboard-guru-piket/waktu-absensi/${id}`,
                method: 'GET',
                success: function(response) {
                    let container = $('#tbody_waktu_absensi')
                    container.empty()

                    response.forEach(function(item, index) {
                        let html = `
                        <tr>
                            <td class="text-center">${index + 1}</td>
                            <td class="text-center">${item.hari}</td>
                            <td class="text-center">${item.tanggal}</td>
                            <td class="text-center">
                                <div class="btn-group btn-group-toggle btn-group-flat">
                                    <a class="button btn button-icon bg-success editData" id="absensi_kelas_button" data-nama="${item.classroom.classroom_name}" href="#" data-classroom="${item.classroom_id}" data-id="${item.id}" data-toggle="modal" data-target="#modal-absensi-data">Absensi kelas</a>
                                    <a class="button btn button-icon bg-danger deleteData" id="delete_button" data-id="${item.id}">Delete</a>
                                </div>
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

        $(document).on('click', '#kembali_button', function() {
            $('#absensi_table').css('display', 'none')
            $('#kembali_button').css('display', 'none')
            $('#waktu_absensi_table').css('display', 'block')
        })

        $(document).on('click', '#absensi_kelas_button', function() {
            id = $(this).data('classroom')
            nama_kelas = $(this).data('nama')
            waktu_absensi_id = $(this).data('id')

            $('#error_guru').css('display', 'none')
            $('#error_status_guru').css('display', 'none')
            $.ajax({
                url: `/dashboard-guru-piket/get-siswa-absensi/${waktu_absensi_id}`,
                method: 'GET',
                success: function(response) {
                    let container = $('#data_siswa')
                    container.empty()
                    $('#teacher_id').val('Pilih salah satu')
                    $('#status_guru').val('Pilih salah satu')
                    get_siswa_absensi = response.count

                    if(response.count > 0) {
                        $('#teacher_id').val(response.data_teacher.teacher_id)
                        $('#status_guru').val(response.data_teacher.status_guru)
                        $('.absensi-judul').text('Absensi' + ' ' + nama_kelas + ' ' + response.data_teacher.waktu_absensi.hari + ' ' + response.data_teacher.waktu_absensi.tanggal)
                        response.getSiswaAbsensi.forEach(function(item, index) {
                            let html = `
                            <div class="row align-items-center">
                                <div class="form-group col-sm-6">
                                    <label class="h5">${item.student.full_name}</label>
                                    <input type="text" id="student_id" class="form-control student-id" hidden value="${item.student.id}">
                                    <span class="text-danger error_${item.student.id}" id="error" style="display: none">Absensi siswa ini kosong</span>
                                </div>
                                <div class="form-group col-sm-6">
                                    <select id="${item.status}" name="status" class="form-control status">
                                        <option selected disabled>Pilih salah satu absensi</option>
                                        <option ${item.status == 'Hadir' ? 'selected' : ''} value="Hadir">Hadir</option>
                                        <option ${item.status == 'Izin' ? 'selected' : ''} value="Izin">Izin</option>
                                        <option ${item.status == 'Sakit' ? 'selected' : ''} value="Sakit">Sakit</option>
                                        <option ${item.status == 'Alpha' ? 'selected' : ''} value="Alpha">Alpha</option>
                                    </select>
                                </div>
                            </div>
                            `
                            container.append(html)
                        })
                    }else{
                        //
                    }

                    if(get_siswa_absensi == 0) {
                    $.ajax({
                        url: `/dashboard-guru-piket/get-siswa/${id}`,
                        method: 'GET',
                        success: function(response) {
                            if(response != null) {
                                response.forEach(function(item, index) {
                                    let html = `
                                    <div class="row align-items-center">
                                        <div class="form-group col-sm-6">
                                            <label class="h5">${item.full_name}</label>
                                            <input type="text" id="student_id" class="form-control student-id" hidden value="${item.id}">
                                            <span class="text-danger error_${item.id}" id="error" style="display: none">Absensi siswa ini kosong</span>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <select id="${item.id}" name="status" class="form-control status">
                                                <option selected disabled>Pilih salah satu absensi</option>
                                                <option value="Hadir">Hadir</option>
                                                <option value="Sakit">Sakit</option>
                                                <option value="Alpha">Alpha</option>
                                            </select>
                                        </div>
                                    </div>
                                    `
                                    container.append(html)
                                })
                            }else{
                                //
                            }
                        },
                        error: function(error) {
                            console.log(error)
                        }
                        })
                    }
                },
                error: function(error) {

                }
            })
        })

        document.getElementById('form_absensi').addEventListener('submit', function(e) {
            e.preventDefault()

            let data_array = []
            let teacher_id = $('#teacher_id').val()
            let status_guru = $('#status_guru').val()

            $('.student-id').each(function(index) {
                let student_id = $(this).val();
                let status = $('.status').eq(index).val();

                data_array.push({student_id, status, teacher_id, status_guru, waktu_absensi_id})

            });
            console.log(data_array)
            $.ajax({
                url: '{{ route('absensi.store') }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    data_array
                },
                success: function(response) {
                    $('#modal-absensi-data').modal('hide')
                    Swal.fire({
                        title: "Berhasil di absensi",
                        text: "",
                        icon: "success"
                    }).then(() => {
                        window.location.reload()
                    })
                },
                error: function(error) {
                    if(teacher_id === null) {
                        $('#error_guru').css('display', 'block')
                    }else{
                        $('#error_guru').css('display', 'none')
                    }

                    if(status_guru === null) {
                        $('#error_status_guru').css('display', 'block')
                    }else{
                        $('#error_status_guru').css('display', 'none')
                    }

                    if(teacher_id != null && status_guru != null && data_array == 0) {
                        $('#modal-absensi-data').modal('hide')
                        Swal.fire({
                            title: "Data absensi murid kosong",
                            text: "",
                            icon: "error"
                        })
                    }
                    $('.status').each(function(index, element) {
                        let input = $(element)

                        if (input.val() === null) {
                            let inputId = input.attr('id')
                            let status = $(`.error_${inputId}`).css('display', 'block');
                        }else {
                            let inputId = input.attr('id')
                            let status = $(`.error_${inputId}`).css('display', 'none');
                        }
                    });
                }
            })
        })

        $(document).on('click', '#delete_button', function() {
            id = $(this).data('id')
            Swal.fire({
                title: "Apa kamu ingin hapus?",
                text: "",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Iya, saya mau hapus"
            }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: `/dashboard-guru-piket/waktuabsensi/${id}`,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function() {
                        Swal.fire({
                            title: "Dihapus",
                            text: "",
                            icon: "success"
                        }).then(() => {
                            window.location.reload()
                        })
                    },
                    error: function(error) {
                        console.log(error)
                    }
                })
            }
            });
        })
    })
</script>
@endpush
