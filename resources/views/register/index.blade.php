@extends('register.layouts.main')

@section('content')
<div class="container">
        <div class="cardy">
            <div class="cardy-body">
                <h3 class="kucing">Daftar</h3>
                <form action="{{ route('register.store') }}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="nis">NIS</label>
                                <input type="number" class="form-control" id="nis" name="nis"/>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="form-group">
                                <label for="full_name">Nama Lengkap</label>
                                <input type="text" class="form-control" id="full_name" name="full_name"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="competence_id">Jurusan</label>
                                <select class="form-control" id="competence_id" name="competence_id"/>
                                    <option disabled selected>Pilih salah satu</option>
                                    @foreach ($Jurusan as $jurusan)
                                    <option value="{{ $jurusan->id }}">{{ $jurusan->inisial_jurusan }} ({{ $jurusan->nama_jurusan }})</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="classroom_id">Kelas</label>
                                <select class="form-control" id="classroom_id" name="classroom_id"/>
                                    <option disabled selected>Pilih salah satu</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="birthdate">Tanggal Lahir</label>
                                <input type="date" class="form-control" id="birthdate" name="birthdate"/>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="birthplace">Tempat Lahir</label>
                                <input type="text" class="form-control" id="birthplace" name="birthplace"/>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="gender">Jenis Kelamin</label>
                                <select class="form-control" id="gender" name="gender"/>
                                    <option disabled selected>Pilih salah satu</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-7">
                            <div class="form-group">
                                <label for="religion">Agama</label>
                                <select class="form-control" id="religion" name="religion"/>
                                    <option disabled selected>Pilih salah satu</option>
                                    <option value="Islam">Islam</option>
                                    <option value="Kristen Protestan">Kristen Protestan</option>
                                    <option value="Kristen Katolik">Kristen Katolik</option>
                                    <option value="Buddha">Buddha</option>
                                    <option value="Hindu">Hindu</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="contact">Nomor Telepon</label>
                        <input type="number" class="form-control" id="contact" name="contact"/>
                    </div>
                    <div class="form-group">
                        <label for="address">Alamat</label>
                        <textarea class="form-control" name="address" id="address" cols="30" rows="3"></textarea>
                    </div>
                    <div class="form-group d-flex justify-content-between">
                        <button type="submit" class="button-selengkapnya">Daftar</button>
                        <button type="button" id="close-register" class="btn btn-danger">close</button>
                    </div>
                </form>
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
            //back to landing page from this page
            $(document).on('click', '#close-register', function() {
                // window.location.href = '{{ route('landing.page.index') }}';
                window.history.back();
            })
            // toastr:: error notification
            @if($errors->any())
            @foreach($errors->all() as $error)
            toastr.error('{{ $error }}');
            @endforeach
            @endif

            @if(Session('error'))
            toastr.error('{{ session('error') }}');
            @endif

            $('#competence_id').on('change', function() {
                let competence_id = $(this).val();

                axios.get(`/get-class-register/${competence_id}`).then(response => {
                    console.log(response.data);
                    $('#classroom_id').empty();

                    if(response.data == 0)
                    {
                        $('#classroom_id').append('<option selected disabled>Data kelas kosong</option>')
                    }else
                    {
                        $('#classroom_id').append('<option selected disabled>Pilih salah satu</option>')
                    }

                    response.data.forEach(classroom => {
                        $('#classroom_id').append(`<option value="${classroom.id}">${classroom.classroom_name}</option>`);
                    });
                }).catch(error => {
                    console.log(error);
                })
            })
        })
    </script>
@endpush
