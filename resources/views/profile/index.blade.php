@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body p-0">
                <div class="iq-edit-list usr-edit">
                    <ul class="iq-edit-profile d-flex nav nav-pills">
                        <li class="col-md-3 p-0">
                            <a class="nav-link active" data-toggle="pill" href="#personal-information">
                                Personal Information
                            </a>
                        </li>
                        <li class="col-md-3 p-0">
                            <a class="nav-link" data-toggle="pill" href="#change-password">
                                Change Password
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="iq-edit-list-data">
            <div class="tab-content">
                <div class="tab-pane fade active show" id="personal-information" role="tabpanel">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Personal Information</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            @if (auth()->user()->role == 'admin' || auth()->user()->role == 'guruPiket' || auth()->user()->role == 'kreator')
                            <div class=" row align-items-center">
                                <div class="form-group col-sm-6">
                                    <label for="name">Nama:</label>
                                    <input type="text" readonly class="form-control" id="name" value="{{ auth()->user()->username }}">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="role">Role:</label>
                                    <input type="text" readonly class="form-control" id="role" value="{{ auth()->user()->role }}">
                                </div>
                            </div>
                            @endif
                            @if (auth()->user()->role == 'guru')
                            <form id="form-edit-profile-guru" data-id="{{ $DataDiri->id }}">
                                @csrf
                                @method('PUT')
                                <div class="row align-items-center">
                                    <div class="form-group col-sm-6">
                                        <label for="full_name">Nama:</label>
                                        <input type="text" class="form-control" name="full_name" id="full_name" value="{{ $DataDiri->full_name }}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="username">Username:</label>
                                        <input type="text" class="form-control" name="username" id="username" value="{{ auth()->user()->username }}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="reg_number">NIP/NUPTK/NRHS:</label>
                                        <input type="text" class="form-control" name="reg_number" id="reg_number" value="{{ $DataDiri->reg_number }}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="role">Role:</label>
                                        <input type="text" class="form-control" readonly id="role" value="{{ ucwords(auth()->user()->role) }}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="birthplace">Tempat lahir:</label>
                                        <input type="text" class="form-control" name="birthplace" id="birthplace" value="{{ ucwords($DataDiri->birthplace) }}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="gender">L/P:</label>
                                        <select name="gender" id="gender" class="form-control mb-3">
                                            <option value="L" {{ $DataDiri->gender == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="P" {{ $DataDiri->gender == 'P' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="birthdate">tanggal lahir:</label>
                                        <input type="date" name="birthdate" class="form-control" id="birthdate" value="{{ $DataDiri->birthdate }}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="contact">Nomor HP:</label>
                                        <input  class="form-control" name="contact" id="contact" value="{{ $DataDiri->contact }}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="religion">Agama:</label>
                                        {{-- <input  class="form-control" id="agama" value="{{ $DataDiri->religion }}"> --}}
                                        <select name="religion" id="religion" class="form-control mb-3">
                                            <option value="Islam" {{ $DataDiri->religion == 'Islam' ? 'selected' : '' }}>Islam</option>
                                            <option value="Kristen Protestan" {{ $DataDiri->religion == 'Kristen Protestan' ? 'selected' : '' }}>Kristen Protestan</option>
                                            <option value="Kristen Katolik" {{ $DataDiri->religion == 'Kristen Katolik' ? 'selected' : '' }}>Kristen Katolik</option>
                                            <option value="Buddha" {{ $DataDiri->religion == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                            <option value="Hindu" {{ $DataDiri->religion == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="address">Alamat:</label>
                                        <textarea class="form-control" name="address" id="address" rows="5" style="line-height: 22px;">{{ $DataDiri->address }}</textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button type="reset" class="btn iq-bg-danger">Cancel</button>
                            </form>
                            @endif
                            @if (auth()->user()->role == 'siswa')
                            <form id="form-edit-profile-siswa" data-id="{{ $DataDiri->id }}">
                                <div class=" row align-items-center">
                                    <div class="form-group col-sm-6">
                                        <label for="full_name_siswa">Nama:</label>
                                        <input type="text" class="form-control" id="full_name_siswa" value="{{ $DataDiri->full_name }}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="nis">NIS:</label>
                                        <input type="text" class="form-control" readonly id="nis" value="{{ $DataDiri->nis }}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="competence_id_siswa">Jurusan:</label>
                                        {{-- <select id="competence_id_siswa" class="form-control mb-3">
                                            @foreach ($Jurusan as $jurusan)
                                            <option value="{{ $jurusan->id }}" {{ $jurusan->id == $DataDiri->competence_id ? 'selected' : '' }}>{{ $jurusan->inisial_jurusan }} ({{ $jurusan->nama_jurusan }})</option>
                                            @endforeach
                                        </select> --}}
                                        <input type="text" class="form-control" readonly id="competence_id_siswa" value="{{ $DataDiri->competence->inisial_jurusan }} ({{ $DataDiri->competence->nama_jurusan }})">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="classroom_id_siswa">Kelas:</label>
                                        {{-- <select id="classroom_id_siswa" class="form-control mb-3">
                                            <option selected disabled>Plih salah satu</option>
                                        </select> --}}
                                        <input type="text" class="form-control" readonly id="classroom_id_siswa" value="{{ $DataDiri->classroom->classroom_name }}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="religion_siswa">Agama:</label>
                                        <select name="religion" id="religion_siswa" class="form-control mb-3">
                                            <option value="Islam" {{ $DataDiri->religion == 'Islam' ? 'selected' : '' }}>Islam</option>
                                            <option value="Kristen Protestan" {{ $DataDiri->religion == 'Kristen Protestan' ? 'selected' : '' }}>Kristen Protestan</option>
                                            <option value="Kristen Katolik" {{ $DataDiri->religion == 'Kristen Katolik' ? 'selected' : '' }}>Kristen Katolik</option>
                                            <option value="Buddha" {{ $DataDiri->religion == 'Buddha' ? 'selected' : '' }}>Buddha</option>
                                            <option value="Hindu" {{ $DataDiri->religion == 'Hindu' ? 'selected' : '' }}>Hindu</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="gender_siswa">Jenis kelamin:</label>
                                        <select name="gender" id="gender_siswa" class="form-control mb-3">
                                            <option value="L" {{ $DataDiri->gender == 'L' ? 'selected' : '' }}>Laki-laki</option>
                                            <option value="P" {{ $DataDiri->gender == 'P' ? 'selected' : '' }}>Perempuan</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="role">Role:</label>
                                        <input  class="form-control" id="role" readonly value="{{ ucwords(auth()->user()->role) }}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="nomor_hp_siswa">Nomor HP:</label>
                                        <input  class="form-control" id="nomor_hp_siswa" value="{{ $DataDiri->contact }}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="tanggal_lahir_siswa">Tanggal lahir:</label>
                                        <input type="date" class="form-control" id="tanggal_lahir_siswa" value="{{ $DataDiri->birthdate }}">
                                    </div>
                                    <div class="form-group col-sm-6">
                                        <label for="tempat_lahir_siswa">Tempat lahir:</label>
                                        <input  class="form-control" id="tempat_lahir_siswa" value="{{ ucwords($DataDiri->birthplace) }}">
                                    </div>
                                    <div class="form-group col-sm-12">
                                        <label for="alamat_siswa">Address:</label>
                                        <textarea class="form-control" name="address" id="alamat_siswa" rows="5" style="line-height: 22px;">{{ $DataDiri->address }}</textarea>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button type="reset" class="btn iq-bg-danger">Cancel</button>
                            </form>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="change-password" role="tabpanel">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="iq-header-title">
                                <h4 class="card-title">Change Password</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('change.password') }}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="current-password">Current Password:</label>
                                    <span id="showCurrentPassword" class="float-right" style="cursor: default">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                            <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                        </svg>
                                        show current password
                                    </span>
                                    <input type="Password" name="current_password" class="form-control" id="current-password" value="">
                                </div>
                                <div class="form-group">
                                    <label for="new-password">New Password:</label>
                                    <span id="showNewPassword" class="float-right" style="cursor: default">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                            <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                        </svg>
                                        show new password
                                    </span>
                                    <input type="Password" name="password" class="form-control" id="new-password" value="">
                                </div>
                                <div class="form-group">
                                    <label for="verify-password">Verify Password:</label>
                                    <span id="showVerifyPassword" class="float-right" style="cursor: default">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor">
                                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                            <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                        </svg>
                                        show verify password
                                    </span>
                                    <input type="Password" name="password_confirmation" class="form-control" id="verify-password" value="">
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                <button type="reset" class="btn iq-bg-danger">Cancel</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
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
        // toastr:: error notification
        @if(Session('error'))
        toastr.error('{{ session('error') }}');
        @endif
        // toastr:: error notification
        @if($errors->any())
        @foreach($errors->all() as $error)
        toastr.error('{{ $error }}');
        @endforeach
        @endif
        //deklarasi var
        let password;

        //current passowrd
        $(document).on('click', '#showCurrentPassword', function() {
            password = $('#current-password');

            if(password.prop('type') == 'password'){
                this.innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                    <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>
                    <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
                </svg> show current password`;
                password.prop('type', 'text');
            }else{
                this.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor">
                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                    <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                </svg> show current password`;
                password.prop('type', 'password');
            }
        })
        //new password
        $(document).on('click', '#showNewPassword', function() {
            password = $('#new-password');

            if(password.prop('type') == 'password'){
                this.innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                    <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>
                    <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
                </svg> show new password`;
                password.prop('type', 'text');
            }else{
                this.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor">
                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                    <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                </svg> show new password`;
                password.prop('type', 'password');
            }
        })
        //verify passowrd
        $(document).on('click', '#showVerifyPassword', function() {
            password = $('#verify-password');

            if(password.prop('type') == 'password'){
                this.innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                    <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>
                    <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
                </svg> show verify password`;
                password.prop('type', 'text');
            }else{
                this.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor">
                    <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                    <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                </svg> show verify password`;
                password.prop('type', 'password');
            }
        })

        @if(auth()->user()->role == 'guru')
        //edit profile guru
        document.getElementById('form-edit-profile-guru').addEventListener('submit', function(event) {
            event.preventDefault();

            let teacher = $(this).data('id');
            let full_name = $('#full_name').val();
            let username = $('#username').val();
            let reg_number = $('#reg_number').val();
            let birthplace = $('#birthplace').val();
            let gender = $('#gender').val();
            let birthdate = $('#birthdate').val();
            let contact = $('#contact').val();
            let religion = $('#religion').val();
            let address = $('#address').val();

            axios.put(`/dashboard-guru/update-profile/${teacher}`, {
                full_name: full_name,
                username: username,
                reg_number: reg_number,
                birthplace: birthplace,
                gender: gender,
                birthdate: birthdate,
                contact: contact,
                religion: religion,
                address: address,
            }).then(response => {
                swal.fire('Data berhasil di edit', '', 'success').then(() => {
                    window.location.reload();
                })
            }).catch(error => {
                console.error('Error updating data: ', error);
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
                if(error.response.data.error){
                Swal.fire('Data gagal di edit', error.response.data.error, 'error');
                }else{
                    Swal.fire('Data gagal di edit', errorMessage, 'error');
                }
                }else{
                Swal.fire('Data gagal di edit', 'Terjadi kesalahan pada sisi server, hubungi kami segera', 'error');
                }
                console.error(error);
            })
        })
        @endif
        @if(auth()->user()->role == 'siswa')
        //filter untuk mendapatkan kelas
        let competence_id = {{ $DataDiri->competence_id }};
        axios.get(`/data-get-kelas-profile/${competence_id}`).then(response => {
            $('#classroom_id_siswa').empty();
            response.data.forEach(classroom => {
                const option = $('<option>');
                option.val(classroom.id);
                option.text(classroom.classroom_name);

                if (classroom.id === {{ $DataDiri->classroom_id }}) {
                    option.prop('selected', true);
                }
                $('#classroom_id_siswa').append(option);
            })
        })
        //on change jurusan to get kelas
        $(document).on('change', '#competence_id_siswa', function() {
            axios.get(`/data-get-kelas-profile/${$(this).val()}`).then(response => {
                $('#classroom_id_siswa').empty();
                $('#classroom_id_siswa').append('<option selected disabled>Pilih salah satu</option>');
                response.data.forEach(classroom => {
                    const option = $('<option>');
                    option.val(classroom.id);
                    option.text(classroom.classroom_name);
                    $('#classroom_id_siswa').append(option);
                })
            })
        })
        //edit profile siswa
        document.getElementById('form-edit-profile-siswa').addEventListener('submit', function(event) {
            event.preventDefault();

            let student = $(this).data('id');

            let full_name = $('#full_name_siswa').val();
            let religion = $('#religion_siswa').val();
            let gender = $('#gender_siswa').val();
            let contact = $('#nomor_hp_siswa').val();
            let birthdate = $('#tanggal_lahir_siswa').val();
            let birthplace = $('#tempat_lahir_siswa').val();
            let address = $('#alamat_siswa').val();

            axios.put(`/dashboard-siswa/edit-profile-siswa/${student}`, {
                full_name: full_name,
                religion: religion,
                gender: gender,
                contact: contact,
                birthdate: birthdate,
                birthplace: birthplace,
                address: address,
            }).then(response => {
                swal.fire('Data berhasil di edit', '', 'success').then(() => {
                    window.location.reload();
                })
            }).catch(error => {
                console.error('Error updating data: ', error);
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
                    Swal.fire('Data gagal di tambahkan', errorMessage, 'error');
                }else{
                    Swal.fire('Data gagal di tambahkan', 'Terjadi kesalahan pada sisi server, hubungi kami segera', 'error');
                }
                console.error(error);
            })

        })
        @endif
    })
</script>
@endpush
