@extends('register.layouts.main')

@section('content')
    <section class="container">
        <header>Daftar <span>SIWAN</span></header>
        <form class="daftar" action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-box">
                <label>NIS</label>
                <input type="number" name="nis" placeholder="2983"/>
            </div>
            <div class="input-box">
                <label>Nama Lengkap</label>
                <input type="text" name="full_name" placeholder="Shichatul Muaw'wanah"/>
            </div>
            <div class="input-box">
                <label>Tempat Lahir</label>
                <input type="text" name="birthplace" placeholder="Tanjungpinang"/>
            </div>
            <div class="input-box">
                <label>Tanggal Lahir</label>
                <input type="date" name="birthdate"/>
            </div>
            <div class="jk-box">
                <h3>Jenis Kelamin</h3>
                {{-- <div class="jk-option">
                    <div class="gender">
                        <input type="radio" id="lk" name="gender" checked />
                        <label for="lk">Laki-laki</label>
                    </div>
                    <div class="gender">
                        <input type="radio" id="pr" name="gender"/>
                        <label for="pr">Perempaun</label>
                    </div>
                </div> --}}
                <div class="religion-box">
                    <select name="gender">
                        <option selected disabled>Pilih salah satu</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
            </div>
            <div class="jk-box">
                <h3>Agama</h3>
                <div class="religion-box">
                    <select name="religion">
                        <option selected disabled>Pilih salah satu</option>
                        <option value="Islam">Islam</option>
                        <option value="Kristen Protestan">Kristen Protestan</option>
                        <option value="Kristen Katolik">Kristen Katolik</option>
                        <option value="Buddha">Buddha</option>
                        <option value="Hindu">Hindu</option>
                    </select>
                </div>
            </div>
            <div class="jk-box">
                <h3>Jurusan</h3>
                <div class="religion-box">
                    <select name="competence_id" id="competence_id">
                        <option selected disabled>Pilih salah satu</option>
                        @foreach ($Jurusan as $jurusan)
                        <option value="{{ $jurusan->id }}">{{ $jurusan->inisial_jurusan }} ({{ $jurusan->nama_jurusan }})</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="jk-box">
                <h3>Kelas</h3>
                <div class="religion-box">
                    <select name="classroom_id" id="classroom_id">
                        <option selected disabled>Pilih salah satu</option>
                    </select>
                </div>
            </div>
            <div class="input-box">
                <label>Kontak/WA</label>
                <input type="number" name="contact" placeholder="081234567833"/>
            </div>
            <div class="input-box">
                <label>Alamat</label>
                <input type="text" name="address" placeholder="Jl. Nusantara, Km. 14"/>
            </div>
            <button type="submit">Daftar</button>
        </form>
    </section>
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
