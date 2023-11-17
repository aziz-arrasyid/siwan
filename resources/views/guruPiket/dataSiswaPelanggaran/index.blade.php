@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-sm-12 col-lg-12 col-md-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">{{ $dataTitle }}</h4>
                </div>
                <div class="pl-3 btn-new border-left">
                    <button type="button" class="btn btn-success mt-2" data-toggle="modal" data-target=".modal-add-data">{{ $addData }}</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive rounded bg-white">
                    <table id="tableYearSemesters" class="table data-table table-striped">
                        <thead>
                            <tr class="light">
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Kelas</th>
                                <th class="text-center">Jenis pelanggaran</th>
                                <th class="text-center">Waktu pelanggaran</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Pelanggaran as $pelanggaran)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $pelanggaran->student->full_name }}</td>
                                <td>{{ $pelanggaran->student->classroom->classroom_name }}</td>
                                <td>{{ $pelanggaran->violation->nama_pelanggaran }}</td>
                                <td>{{ $pelanggaran->created_at->format('j F Y \p\u\k\u\l H:i') }}</td>
                                <td>
                                    <div class="btn-group btn-group-toggle btn-group-flat">
                                        <a class="button btn button-icon bg-warning editData" href="#" data-id="{{ $pelanggaran->id }}" data-toggle="modal" data-target="#modal-edit-data">Edit</a>
                                        <a class="button btn button-icon bg-danger deleteData" data-id="{{ $pelanggaran->id }}" href="#">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Modal for Add Data -->
                <div class="modal fade modal-add-data" tabindex="-1" role="dialog"  aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ $addData }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="form-tambah-pelanggaran">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label class="h5">Filter nama siswa</label>
                                    </div>
                                    <div class="row align-items-center">
                                        <div class="form-group col-sm-6">
                                            <select id="competence_id" name="competence_id" class="form-control">
                                                <option selected disabled>Pilih salah satu jurusan</option>
                                                @foreach ($Jurusan as $jurusan)
                                                <option value="{{ $jurusan->id }}">{{ $jurusan->inisial_jurusan. ' ('.$jurusan->nama_jurusan.')' }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-sm-6">
                                            <select id="classroom_id" name="classroom_id" class="form-control">
                                                <option selected disabled>Pilih salah satu kelas</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="student_id" class="h5">nama siswa</label>
                                        <select id="student_id" name="student_id" class="form-control">
                                            <option selected disabled>Pilih salah satu</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="pelanggaran" class="h5">Jenis pelanggaran</label>
                                        <select id="pelanggaran" name="violation_id" class="form-control">
                                            <option selected disabled>Pilih salah satu</option>
                                            @foreach($Violation as $violation)
                                            <option value="{{$violation->id}}">{{$violation->nama_pelanggaran}}</option>
                                            @endforeach
                                        </select>
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
                <!-- Modal for Add Data -->
            </div>
        </div>
    </div>
</div>

<!-- Modal for Edit Data -->
<div class="modal fade modal-edit-data" tabindex="-1" id="modal-edit-data" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $editData }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-edit">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label class="h5">Filter nama siswa</label>
                    </div>
                    <div class="row align-items-center">
                        <div class="form-group col-sm-6">
                            <select id="competence_id-edit" name="competence_id" class="form-control">
                                <option selected disabled>Pilih salah satu jurusan</option>
                                @foreach ($Jurusan as $jurusan)
                                <option value="{{ $jurusan->id }}">{{ $jurusan->inisial_jurusan. ' ('.$jurusan->nama_jurusan.')' }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <select id="classroom_id-edit" name="classroom_id" class="form-control">
                                <option selected disabled>Pilih salah satu kelas</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="student_id-edit" class="h5">nama siswa</label>
                        <select id="student_id-edit" name="student_id" class="form-control">
                            <option selected disabled>Pilih salah satu</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pelanggaran-edit" class="h5">Jenis pelanggaran</label>
                        <select id="pelanggaran-edit" name="violation_id" class="form-control">
                            <option selected disabled>Pilih salah satu</option>
                            @foreach($Violation as $violation)
                            <option value="{{$violation->id}}">{{$violation->nama_pelanggaran}}</option>
                            @endforeach
                        </select>
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
        //deklarasi var
        let pelanggaran;
        toastr.options = {
            "closeButton": true,
            "newestOnTop": false,
            "progressBar": true,
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        //close modal
        // $(document).on('click', '#close-modal', function() {
        //     window.location.reload();
        // })
        // toastr:: success notification
        @if(Session('success'))
        toastr.success('{{ session('success') }}');
        @endif
        //filter jurusan untuk menemukan kelas in add data
        $('#competence_id').change(function() {
            $('#student_id').empty();
            $("#student_id").append('<option selected disabled>Pilih salah satu nama siswa</option>');
            let id = $(this).val();

            axios.get(`/dashboard-guru-piket/get-classroom/${id}`).then(response => {
                $('#classroom_id').empty();
                $("#classroom_id").append('<option selected disabled>Pilih salah satu kelas</option>');
                response.data.forEach(classroom => {
                    console.log(classroom.classroom_name);

                    const option = $('<option>');
                    option.val(classroom.id);
                    option.text(classroom.classroom_name);

                    $('#classroom_id').append(option);
                });
            })
        })
        //filter untuk menemukan nama siswa dari jurusan x kelas in add data
        $('#classroom_id').change(function() {
            let id = $(this).val();
            axios.get(`/dashboard-guru-piket/get-siswa/${id}`).then(response => {
                $('#student_id').empty();
                $("#student_id").append('<option selected disabled>Pilih salah satu nama siswa</option>');
                response.data.forEach(student => {
                    console.log(student.student_name);

                    const option = $('<option>');
                    option.val(student.id);
                    option.text(student.full_name);

                    $('#student_id').append(option);
                });
            })
        })
        //form add data
        document.getElementById('form-tambah-pelanggaran').addEventListener('submit', function(event) {
            event.preventDefault();

            const modal = $('.modal-add-data');
            const formData = new FormData(this);
            axios.post(`/pelanggaran`, formData).then(response => {
                modal.modal('hide');
                swal.fire('Data berhasil di tambah', '', 'success').then(() => {
                    window.location.href = '{{ route('siswa.pelanggaran.piket') }}';
                })
            }).catch(error => {
                console.error('Error updating data: ', error);
                modal.modal('hide');
                if(error.response && error.response.status === 422){
                    const errorMessages = error.response.data.errors;
                    let errorMessage = '';
                    let isFirstError = true; // Flag to track the first error
                    for (const field in errorMessages) {
                        if (!isFirstError) {
                            errorMessage += ', '; // Add a comma before the error message
                        } else {
                            isFirstError = false;
                        }
                        errorMessage += errorMessages[field][0];
                    }
                    Swal.fire('Data gagal di edit', errorMessage, 'error').then(() => {
                        modal.modal('show');
                    });
                }else{
                    Swal.fire('Data gagal di edit', 'Terjadi kesalahan pada sisi server, hubungi kami segera', 'error');
                }
                console.error(error);
            })
        })
        //filter jurusan untuk menemukan kelas in edit data
        $('#competence_id-edit').change(function() {
            $('#student_id-edit').empty();
            $("#student_id-edit").append('<option selected disabled>Pilih salah satu nama siswa</option>');
            let id = $(this).val();

            axios.get(`/dashboard-guru-piket/get-classroom/${id}`).then(response => {
                $('#classroom_id-edit').empty();
                $("#classroom_id-edit").append('<option selected disabled>Pilih salah satu kelas</option>');
                response.data.forEach(classroom => {

                    const option = $('<option>');
                    option.val(classroom.id);
                    option.text(classroom.classroom_name);

                    $('#classroom_id-edit').append(option);
                });
            })
        })
        //filter untuk menemukan nama siswa dari jurusan x kelas in edit data
        $('#classroom_id-edit').change(function() {
            let id = $(this).val();
            axios.get(`/dashboard-guru-piket/get-siswa/${id}`).then(response => {
                $('#student_id-edit').empty();
                $("#student_id-edit").append('<option selected disabled>Pilih salah satu nama siswa</option>');
                response.data.forEach(student => {

                    const option = $('<option>');
                    option.val(student.id);
                    option.text(student.full_name);

                    $('#student_id-edit').append(option);
                });
            })
        })
        //tampil data edit
        $(document).on('click', '.editData', function() {
            pelanggaran = $(this).data('id');
            axios.get(`/pelanggaran/${pelanggaran}/edit`).then(response => {
                $('#competence_id-edit').val(response.data.student.competence_id);
                //var untuk mendapatkan kelas
                let classroom_id = response.data.student.classroom_id;
                let get_classroom_id = response.data.student.competence_id;
                //var untuk filter mendapatkan siswa
                let student_id = response.data.student_id;
                let get_student_id = response.data.student.classroom_id;
                //filter mendapatkan kelas dari jurusan
                axios.get(`/dashboard-guru-piket/get-classroom/${get_classroom_id}`).then(response => {
                    $('#classroom_id-edit').empty();
                    response.data.forEach(classroom => {
                        console.log(classroom.classroom_name);

                        const option = $('<option>');
                        option.val(classroom.id);
                        option.text(classroom.classroom_name);

                        if (classroom.id === classroom_id) {
                            option.prop('selected', true);
                        }
                        $('#classroom_id-edit').append(option);
                    });
                })
                //filter mendapatkan siswa dari jurusan x kelas
                axios.get(`/dashboard-guru-piket/get-siswa/${get_student_id}`).then(response => {
                    $('#student_id-edit').empty();
                    response.data.forEach(student => {

                        const option = $('<option>');
                        option.val(student.id);
                        option.text(student.full_name);

                        if(student.id === student_id){
                            option.prop('selected', true);
                        }
                        $('#student_id-edit').append(option);
                    });
                })
                $('#pelanggaran-edit').val(response.data.violation_id);
            })
        })
        //update data
        document.getElementById('form-edit').addEventListener('submit', function(event) {
            event.preventDefault();

            const modal = $('.modal-edit-data');
            let violation_id = $('#pelanggaran-edit').val();
            let student_id = $('#student_id-edit').val();
            axios.put(`/pelanggaran/${pelanggaran}`, {
                violation_id: violation_id,
                student_id: student_id,
            }).then(response => {
                modal.modal('hide');
                swal.fire('Data berhasil di edit', '', 'success').then(() => {
                    window.location.reload();
                })
            }).catch(error => {
                console.error('Error updating data: ', error);
                modal.modal('hide');
                if(error.response && error.response.status === 422){
                    const errorMessages = error.response.data.errors;
                    let errorMessage = '';
                    let isFirstError = true; // Flag to track the first error
                    for (const field in errorMessages) {
                        if (!isFirstError) {
                            errorMessage += ', '; // Add a comma before the error message
                        } else {
                            isFirstError = false;
                        }
                        errorMessage += errorMessages[field][0];
                    }
                    Swal.fire('Data gagal di edit', errorMessage, 'error').then(() => {
                        modal.modal('show');
                    });
                }else{
                    Swal.fire('Data gagal di edit', 'Terjadi kesalahan pada sisi server, hubungi kami segera', 'error');
                }
                console.error(error);
            })
        })
        //delete data
        $(document).on('click', '.deleteData', function() {
            pelanggaran = $(this).data('id');
            Swal.fire({
                title: "Apa kamu yakin ingin hapus data?",
                text: "Data akan terhapus permanen",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Iya, saya mau hapus!"
                }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/pelanggaran/${pelanggaran}`).then(response => {
                        swal.fire('Data berhasil dihapus', '', 'success').then(() => {
                            window.location.reload();
                        })
                    }).catch(error => {
                        swal.fire('Data gagal dihapus', 'terjadi kesalahan pada sisi server, segera hubungi developer kami', 'error').then(() => {
                            window.location.reload();
                        })
                    })
                }
            });
        })
    })
</script>
@endpush
