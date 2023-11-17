@extends('layouts.main')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <div class="header-title">
                    <h4 class="card-title">Data Sekolah</h4>
                </div>
                @if ($dataSekolah !== null)
                <button type="button" data-id="{{ $dataSekolah->id }}" id="data_sekolah" class="btn btn-primary mt-2 float-right" data-toggle="modal" data-target=".modal-edit-data">Edit Data Sekolah</button>
                @else
                <button type="button" class="btn btn-primary mt-2 float-right" data-toggle="modal" data-target=".modal-edit-data">Edit Data Sekolah</button>
                @endif
            </div>
            <div class="card-body">
                @if ($dataSekolah !== null)
                <div class=" row align-items-center">
                    <div class="form-group col-sm-6">
                        <label for="name_view">Nama:</label>
                        <input type="text" readonly class="form-control" id="name_view" value="{{ $dataSekolah->name }}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="kepala_sekolah_view">Kepala Sekolah:</label>
                        <input type="text" readonly class="form-control" id="kepala_sekolah_view" value="{{ $dataSekolah->teacher->full_name }}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="email_view">Email:</label>
                        <input type="text" readonly class="form-control" id="email_view" value="{{ $dataSekolah->email }}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="telepon_view">Telepon:</label>
                        <input type="text" readonly class="form-control" id="telepon_view" value="{{ $dataSekolah->telepon }}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="latitude_view">Latitude:</label>
                        <input type="text" readonly class="form-control" id="latitude_view" value="{{ $dataSekolah->latitude }}">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="longitude_view">Longitude:</label>
                        <input type="text" readonly class="form-control" id="longitude_view" value="{{ $dataSekolah->longitude }}">
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="alamat_view">Alamat:</label>
                        <input type="text" readonly class="form-control" id="alamat_view" value="{{ $dataSekolah->alamatSekolah }}">
                    </div>
                </div>
                @else
                <div class=" row align-items-center">
                    <div class="form-group col-sm-6">
                        <label for="name_view">Nama:</label>
                        <input type="text" readonly class="form-control" id="name_view" value="kosong">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="kepala_sekolah_view">Kepala sekolah:</label>
                        <input type="text" readonly class="form-control" id="kepala_sekolah_view" value="kosong">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="email_view">Email:</label>
                        <input type="text" readonly class="form-control" id="email_view" value="kosong">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="telepon_view">Telepon:</label>
                        <input type="text" readonly class="form-control" id="telepon_view" value="kosong">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="latitude_view">Latitude:</label>
                        <input type="text" readonly class="form-control" id="latitude_view" value="kosong">
                    </div>
                    <div class="form-group col-sm-6">
                        <label for="longitude_view">Longitude:</label>
                        <input type="text" readonly class="form-control" id="longitude_view" value="kosong">
                    </div>
                    <div class="form-group col-sm-12">
                        <label for="alamat_view">Alamat:</label>
                        <input type="text" readonly class="form-control" id="alamat_view" value="kosong">
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

{{-- modal untuk edit --}}
<div class="modal fade modal-edit-data" id="modal-edit-data" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ $editData }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="form-edit" action="{{ route('sekolah.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row align-items-center">
                        <div class="form-group col-sm-6">
                            <label class="h5" for="nama_sekolah">Nama:</label>
                            <input type="text" class="form-control" name="name" id="nama_sekolah" placeholder="">
                            <input type="text" class="form-control" name="id" id="id" hidden placeholder="">
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="h5" for="kepala_sekolah">Kepala Sekolah:</label>
                            <select id="kepala_sekolah" name="teacher_id" class="form-control">
                                @foreach ($Guru as $guru)
                                <option value="{{ $guru->id }}">{{ $guru->full_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="h5" for="email">Email:</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="">
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="h5" for="telepon">Telepon:</label>
                            <input type="text" class="form-control" name="telepon" id="telepon" placeholder="">
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="h5" for="latitude">Latitude:</label>
                            <input type="text" class="form-control" name="latitude" id="latitude" placeholder="">
                        </div>
                        <div class="form-group col-sm-6">
                            <label class="h5" for="longitude">Longitude:</label>
                            <input type="text" class="form-control" name="longitude" id="longitude" placeholder="">
                        </div>
                        <div class="form-group col-sm-12">
                            <label class="h5" for="alamat_sekolah">Alamat:</label>
                            <textarea class="form-control" name="alamatSekolah" id="alamat_sekolah"></textarea>
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
            @if($errors->any())
            @foreach($errors->all() as $error)
            toastr.error('{{ $error }}');
            @endforeach
            @endif
            $('#kepala_sekolah').select2({
                width: '100%',
                theme: 'bootstrap4'
            });

            $(document).on('click', '#data_sekolah', function() {
                let sekolah = $(this).data('id');

                axios.get(`/dashboard-admin/sekolah/${sekolah}/edit`).then(response => {
                    $('#nama_sekolah').val(response.data.name);
                    $('#kepala_sekolah').val(response.data.teacher_id).trigger('change');
                    $('#email').val(response.data.email);
                    $('#telepon').val(response.data.telepon);
                    $('#latitude').val(response.data.latitude);
                    $('#longitude').val(response.data.longitude);
                    $('#alamat_sekolah').val(response.data.alamatSekolah);
                    $('#id').val(response.data.id);
                })
            })


        })
    </script>
@endpush

