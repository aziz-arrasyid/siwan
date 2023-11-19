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
                                <th>nis</th>
                                <th>Nama</th>
                                <th>Jenis kelamin</th>
                                <th>Agama</th>
                                <th>Tempat lahir</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Student as $student)
                            <tr data-id="{{ $student->id }}" id="tr-data">
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $student->nis }}</td>
                                <td>{{ $student->full_name }}</td>
                                <td>{{ $student->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                                <td>{{ $student->religion }}</td>
                                <td>{{ $student->birthplace }}</td>
                                <td class="button">
                                    <div class="btn-group btn-group-toggle btn-group-flat">
                                        <a class="button btn button-icon bg-warning editData" href="#" data-id="{{ $student->id }}" data-toggle="modal" data-target="#modal-edit-data">Edit</a>
                                        <a class="button btn button-icon bg-danger deleteData" data-id="{{ $student->id }}" href="#">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Modal for Add Data -->
                <div class="modal fade modal-add-data" id="modal-add-data" tabindex="-1" role="dialog"  aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ $addData }}</h5>
                                <button type="button" id="x-modal" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('tambah.siswa') }}" method="POST" enctype="multipart/form-data">
                                    {{csrf_field()}}
                                    <div class="row">
                                        <div class="col">
                                            <label class="h5">NIS</label>
                                            <input type="text" class="form-control" name="nis" placeholder="NIS">
                                        </div>
                                        <div class="col">
                                            <label class="h5">Nama Lengkap</label>
                                            <input type="text" class="form-control" name="full_name" placeholder="Nama Lengkap">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label class="h5">Tempat Lahir</label>
                                            <input type="text" class="form-control" name="birthplace" placeholder="Tempat Lahir">
                                        </div>
                                        <div class="col">
                                            <label class="h5">Tanggal Lahir</label>
                                            <input name="birthdate" type="date" class="form-control" placeholder="Tanggal Lahir">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <label class="h5">Jenis kelamin</label>
                                            <select name="gender" class="form-control mb-3">
                                                <option value="" selected disabled>Pilih salah satu</option>
                                                <option value="L">Laki-laki</option>
                                                <option value="P">Perempuan</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label class="h5">Agama</label>
                                            <select name="religion" class="form-control mb-3">
                                                <option value="" selected disabled>Pilih salah satu</option>
                                                <option value="Islam">Islam</option>
                                                <option value="Kristen Protestan">Kristen Protestan</option>
                                                <option value="Kristen Katolik">Kristen Katolik</option>
                                                <option value="Buddha">Buddha</option>
                                                <option value="Hindu">Hindu</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="h5">Kontak/WA</label>
                                        <input type="text" class="form-control" name="contact">
                                    </div>
                                    <div class="form-group">
                                        <label class="h5">Alamat</label>
                                        <textarea name="address" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                                    </div>
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
                <button type="button" id="x-modal" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-edit">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col">
                            <label class="h5">NIS</label>
                            <input type="text" class="form-control" name="nis" id="nisEdit" placeholder="NIS">
                        </div>
                        <div class="col">
                            <label class="h5">Nama Lengkap</label>
                            <input type="text" class="form-control" name="full_name" id="full_nameEdit" placeholder="Nama Lengkap">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="h5">Tempat Lahir</label>
                            <input type="text" class="form-control" name="birthplace" id="birthplaceEdit" placeholder="Tempat Lahir">
                        </div>
                        <div class="col">
                            <label class="h5">Tanggal Lahir</label>
                            <input name="birthdate" id="birthdateEdit" type="date" class="form-control" placeholder="Tanggal Lahir">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="h5">Jenis kelamin</label>
                            <select name="gender" id="genderEdit" class="form-control mb-3">
                                <option value="" selected disabled>Pilih salah satu</option>
                                <option value="L">Laki-laki</option>
                                <option value="P">Perempuan</option>
                            </select>
                        </div>
                        <div class="col">
                            <label class="h5">Agama</label>
                            <select name="religion" id="religionEdit" class="form-control mb-3">
                                <option value="" selected disabled>Pilih salah satu</option>
                                <option value="Islam">Islam</option>
                                <option value="Kristen Protestan">Kristen Protestan</option>
                                <option value="Kristen Katolik">Kristen Katolik</option>
                                <option value="Buddha">Buddha</option>
                                <option value="Hindu">Hindu</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="h5">Kontak/WA</label>
                        <input type="text" class="form-control" name="contact" id="contactEdit">
                    </div>
                    <div class="form-group">
                        <label class="h5">Alamat</label>
                        <textarea name="address" id="addressEdit" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
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
<!-- Modal for info Data -->
<div class="modal fade modal-info-data" tabindex="-1" id="modal-info-data" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Informasi siswa</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                        <div class="col">
                            <label class="h5" for="nis_info">NIS</label>
                            <input type="text" class="form-control" readonly id="nis_info">
                        </div>
                        <div class="col">
                            <label class="h5" for="full_name_info">Nama Lengkap</label>
                            <input type="text" class="form-control"readonly id="full_name_info">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="h5" for="birthplace_info">Tempat Lahir</label>
                            <input type="text" class="form-control" readonly id="birthplace_info">
                        </div>
                        <div class="col">
                            <label class="h5" for="birthdate_info">Tanggal Lahir</label>
                            <input id="birthdate_info" readonly type="date" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <label class="h5" for="jenis_kelamin_info">Jenis kelamin</label>
                            <input type="text" class="form-control" readonly id="jenis_kelamin_info">
                        </div>
                        <div class="col">
                            <label class="h5" for="agama_info">Agama</label>
                            <input type="text" class="form-control" readonly id="agama_info">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="h5" for="contact_info">Kontak/WA</label>
                        <input type="text" class="form-control" readonly name="contact" id="contact_info">
                    </div>
                    <div class="form-group">
                        <label class="h5" for="address_info">Alamat</label>
                        <textarea name="address" class="form-control" readonly id="address_info" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
        </div>
    </div>
</div>
</div>
<!-- Modal for info Data -->
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        //global var
        let student;
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
        //info data ketika pencet tr-data
        $(document).on('click', '#tr-data', function(event) {
                if(!$(event.target).hasClass('button'))
                {
                    let student_id = $(this).data('id');
                    // console.log(student_id);
                    axios.get(`/dashboard-guru/informasi-siswa/${student_id}`).then(response => {
                        const modal = $('#modal-info-data');
                        modal.modal('show');
                        // console.log(response.data);
                        // $('#preview-foto-info').attr('src', '{{ asset('storage/images') }}/' + response.data.dokumentasi);
                        $('#nis_info').val(response.data.nis);
                        $('#full_name_info').val(response.data.full_name);
                        $('#birthplace_info').val(response.data.birthplace);
                        $('#birthdate_info').val(response.data.birthdate);
                        $('#jenis_kelamin_info').val(response.data.gender);
                        $('#agama_info').val(response.data.religion);
                        $('#contact_info').val(response.data.contact);
                        $('#address_info').val(response.data.address);
                    })
                }
            })
        //close modal reload
        $(document).on('click', '#close-modal, #x-modal', function() {
            window.location.reload();
        })
        //ketika pencet diluar modal maka reload halaman
        $(document).click(function(e) {
            if($(e.target).is('#modal-add-data, #modal-edit-data'))
            {
                window.location.reload();
            }
        })
        // toastr:: success notification
        @if(Session('success'))
        toastr.success('{{ session('success') }}');
        @endif
        // toastr:: error notification
        @if($errors->any())
        @foreach($errors->all() as $error)
        toastr.error('{{ $error }}');
        @endforeach
        @endif
        //tampil data edit
        $(document).on('click', '.editData', function() {
            student = $(this).data('id');
            axios.get(`/dashboard-guru/tampil-data-siswa/${student}`).then(response => {
                $('#nisEdit').val(response.data.nis);
                $('#full_nameEdit').val(response.data.full_name);
                $('#birthplaceEdit').val(response.data.birthplace);
                $('#birthdateEdit').val(response.data.birthdate);
                $('#genderEdit').val(response.data.gender);
                $('#religionEdit').val(response.data.religion);
                $('#contactEdit').val(response.data.contact);
                $('#addressEdit').val(response.data.address);
            }).catch(error => {
                console.error('error fetching data: ', error);
            })
        })
        //update data
        document.getElementById('form-edit').addEventListener('submit', function(event) {
            event.preventDefault();
            const modal = $('#modal-edit-data');
            const formData = new FormData(this);

            let nis = $('#nisEdit').val();
            let full_name = $('#full_nameEdit').val();
            let birthplace = $('#birthplaceEdit').val();
            let birthdate = $('#birthdateEdit').val();
            let gender = $('#genderEdit').val();
            let religion = $('#religionEdit').val();
            let contact = $('#contactEdit').val();
            let address = $('#addressEdit').val();


            axios.put(`/dashboard-guru/update-data-siswa/${student}`, {
                nis: nis,
                full_name: full_name,
                birthplace: birthplace,
                birthdate: birthdate,
                gender: gender,
                religion: religion,
                contact: contact,
                address: address
            }).then(response => {
                modal.modal('hide');
                swal.fire('Data berhasil di edit', '', 'success').then(() => {
                    window.location.href = '{{ route('siswa.biodata') }}';
                })
            })
            .catch(error => {
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
                    if(error.response.data.error)
                    {
                        Swal.fire('Data gagal di edit', error.response.data.error, 'error').then(() => {
                            modal.modal('show');
                        });
                    }else{
                        Swal.fire('Data gagal di edit', errorMessage, 'error').then(() => {
                            modal.modal('show');
                        });
                    }
                }else{
                    Swal.fire('Data gagal di edit', 'Terjadi kesalahan pada sisi server, hubungi kami segera', 'error');
                }
                console.error(error);
            });
        })
        //delete data
        $(document).on('click', '.deleteData', function() {
            student = $(this).data('id');
            Swal.fire({
                title: "Apa kamu ingin hapus?",
                text: "Data akan terhapus permanen",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Iya, saya mau hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete(`/dashboard-guru/delete-data-siswa/${student}`).then(response => {
                        Swal.fire('Data berhasil dihapus', '', 'success').then(() => {
                            window.location.href = '{{ route('siswa.biodata') }}';
                        });
                    }).catch(error => {
                        Swal.fire('Data gagal di dihapus', 'Terjadi kesalahan pada sisi server, hubungi kami segera', 'error');
                        console.error('Error updating data: ', error);
                    })
                }
            });
        })

    })
</script>
@endpush
