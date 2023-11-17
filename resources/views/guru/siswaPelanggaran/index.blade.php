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
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jenis pelanggaran</th>
                                <th>Waktu pelanggaran</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Pelanggaran as $pelanggaran)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $pelanggaran->student->full_name }}</td>
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
                                        <label for="namaSiswa" class="h5">nama siswa</label>
                                        <select id="namaSiswa" name="student_id" class="form-control">
                                            <option selected disabled>Pilih Salah satu</option>
                                            @foreach($Student as $student)
                                            <option value="{{$student->id}}">{{$student->full_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="pelanggaran" class="h5">Jenis pelanggaran</label>
                                        <select id="pelanggaran" name="violation_id" class="form-control">
                                            <option selected disabled>Pilih Salah satu</option>
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
                        <label for="namaSiswa" class="h5">nama siswa</label>
                        <select id="namaSiswaEdit" name="student_id" class="form-control">
                            <option selected disabled>Pilih Salah satu</option>
                            @foreach($Student as $student)
                            <option value="{{$student->id}}">{{$student->full_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pelanggaran" class="h5">Jenis pelanggaran</label>
                        <select id="pelanggaranEdit" name="violation_id" class="form-control">
                            <option selected disabled>Pilih Salah satu</option>
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

        // toastr:: success notification
        @if(Session('success'))
        toastr.success('{{ session('success') }}');
        @endif
        //reload halaman ketika close modal
        $(document).on('click', '#close-modal', function() {
            window.location.reload();
        })
        //fungsi tambah data pelanggaran
        document.getElementById('form-tambah-pelanggaran').addEventListener('submit', function(event) {
            event.preventDefault();
            const modal = $('.modal-add-data');
            const formData = new FormData(this);
            axios.post(`/pelanggaran`, formData).then(response => {
                modal.modal('hide');
                swal.fire('Data berhasil di tambah', '', 'success').then(() => {
                    window.location.href = '{{ route('siswa.pelanggaran') }}';
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
        //fungsi tampil data pada edit data modal
        $(document).on('click', '.editData', function() {
            pelanggaran = $(this).data('id');
            axios.get(`/pelanggaran/${pelanggaran}/edit`).then(response => {

                console.log(response.data);
                $('#namaSiswaEdit').val(response.data.student_id);
                $('#pelanggaranEdit').val(response.data.violation_id);
            }).catch(error => {
                console.error('error fetching data: ', error)
            })
        })
        //fungsi update data
        document.getElementById('form-edit').addEventListener('submit', function(event) {
            event.preventDefault();
            const modal = $('.modal-edit-data');
            const formData = new FormData(this);

            let student_id = $('#namaSiswaEdit').val();
            let violation_id = $('#pelanggaranEdit').val();

            modal.modal('hide');
            axios.put(`/pelanggaran/${pelanggaran}`, {
                student_id: student_id,
                violation_id: violation_id
            }).then(response => {
                modal.modal('hide');
                swal.fire('Data berhasil di edit', '', 'success').then(() => {
                    window.location.href = '{{ route('siswa.pelanggaran') }}';
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
        //fungsi delete data
        $(document).on('click', '.deleteData', function() {
            pelanggaran = $(this).data('id');

            Swal.fire({
                title: "Apa kamu ingin hapus data?",
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
                            window.location.href = '{{ route('siswa.pelanggaran') }}';
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
                }
            });
        })
    })
</script>
@endpush
