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
                    <button type="button" class="btn btn-success mt-2" id="button-tambah-data">{{ $addData }}</button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive rounded bg-white">
                    <table id="tableYearSemesters" class="table data-table table-striped">
                        <thead>
                            <tr class="light">
                                <th>No</th>
                                <th>Nama</th>
                                <th>Status panggilan</th>
                                <th>permasalahan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($Panggilan as $panggilan)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $panggilan->student->full_name }}</td>
                                <td>{{ $panggilan->statusPanggilan == 'I' ? 'Panggilan I' : 'Panggilan II' }}</td>
                                <td>{{ $panggilan->permasalahan }}</td>
                                <td>
                                    <div class="btn-group btn-group-toggle btn-group-flat">
                                        <a class="button btn button-icon bg-warning editData" href="#" data-id="{{ $panggilan->id }}" data-toggle="modal" data-target="#modal-edit-data">Edit</a>
                                        <a class="button btn button-icon bg-danger deleteData" data-id="{{ $panggilan->id }}" href="#">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Modal for Add Data capture photo -->
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
                                <form id="form-tambah-panggilan-ortu-wali">
                                    @csrf
                                    <div class="card">
                                        <div class="card-body">
                                            <p class="h5">Preview photo</p>
                                            <img id="preview-foto" class="img-fluid rounded" alt="Responsive image">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="student_id" class="h5">nama siswa</label>
                                        <select id="student_id" name="student_id" class="form-control">
                                            <option selected disabled>Pilih Salah satu</option>
                                            @foreach($Student as $student)
                                            <option value="{{$student->id}}">{{$student->full_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="status_panggilan" class="h5">Tahapan panggilan</label>
                                        <select id="status_panggilan" name="statusPanggilan" class="form-control">
                                            <option selected disabled>Pilih Salah satu</option>
                                            <option value="I">Panggilan I</option>
                                            <option value="II">Panggilan II</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="permasalahan" class="h5">Permasalahan/pelanggaran</label>
                                        <textarea name="permasalahan" class="form-control" id="permasalahan" cols="30" rows="5"></textarea>
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
                <!-- Modal for Add Data input photo -->
                <div class="modal fade modal-add-data-input-foto" tabindex="-1" role="dialog"  aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">{{ $addData }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="form-tambah-panggilan-ortu-wali-input-foto">
                                    @csrf
                                    <div class="card">
                                        <div class="card-body">
                                            <p class="h5">Preview photo</p>
                                            <div class="input-group mb-4">
                                                <div class="input-group-prepend">
                                                <span class="input-group-text">Upload</span>
                                                </div>
                                                <div class="custom-file">
                                                <input type="file" class="custom-file-input" name="dokumentasi" id="input_foto">
                                                <label class="custom-file-label" for="input_foto">Choose file</label>
                                                </div>
                                            </div>
                                            <img id="preview-foto-input" class="img-fluid rounded mt-2" alt="Responsive image">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="student_id-input" class="h5">nama siswa</label>
                                        <select id="student_id-input" name="student_id" class="form-control">
                                            <option selected disabled>Pilih Salah satu</option>
                                            @foreach($Student as $student)
                                            <option value="{{$student->id}}">{{$student->full_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="status_panggilan-input" class="h5">Tahapan panggilan</label>
                                        <select id="status_panggilan-input" name="statusPanggilan" class="form-control">
                                            <option selected disabled>Pilih Salah satu</option>
                                            <option value="I">Panggilan I</option>
                                            <option value="II">Panggilan II</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="permasalahan-input" class="h5">Permasalahan/pelanggaran</label>
                                        <textarea name="permasalahan" class="form-control" id="permasalahan-input" cols="30" rows="5"></textarea>
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
            </div>
        </div>
    </div>
</div>

<div id="pembungkus-camera" style="display: none; position: absolute; top: 55%; left: 50%; transform: translate(-50%, -50%);">
    <div class="card d-flex align-items-center justify-content-center">
        <video id="video" width="640" height="480" style="transform: scaleX(-1)"></video>
        <div class="card-body">
            <button type="button" class="btn btn-success mt-2" id="capture">Foto</button>
            <button type="button" class="btn btn-success mt-2" id="switch">switch camera</button>
            <button type="button" class="btn btn-success mt-2" id="cancel-foto">Cancel</button>
        </div>
    </div>
</div>

<canvas id="canvas" width="640" height="480" style="display: none;"></canvas>

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
                <form id="form-edit-panggilan-ortu-wali">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-body">
                            <p class="h5">Preview photo</p>
                            <img id="preview-foto-edit" class="img-fluid rounded" alt="Responsive image">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="student_id" class="h5">nama siswa</label>
                        <select id="student_id_edit" name="student_id" class="form-control">
                            <option selected disabled>Pilih Salah satu</option>
                            @foreach($Student as $student)
                            <option value="{{$student->id}}">{{$student->full_name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="status_panggilan" class="h5">Tahapan panggilan</label>
                        <select id="status_panggilan_edit" name="statusPanggilan" class="form-control">
                            <option selected disabled>Pilih Salah satu</option>
                            <option value="I">Panggilan I</option>
                            <option value="II">Panggilan II</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="permasalahan" class="h5">Permasalahan/pelanggaran</label>
                        <textarea name="permasalahan" class="form-control" id="permasalahan_edit" cols="30" rows="5"></textarea>
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

<!-- Modal for Info Data -->
<div class="modal fade modal-info-data" tabindex="-1" id="modal-edit-data" role="dialog"  aria-hidden="true">
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
                        <label for="namaSiswaEdit" class="h5">nama siswa</label>
                        <select id="namaSiswaEdit" name="student_id" class="form-control">
                            <option selected disabled>Pilih Salah satu</option>
                            {{-- @foreach($Student as $student)
                            <option value="{{$student->id}}">{{$student->full_name}}</option>
                            @endforeach --}}
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="pelanggaranEdit" class="h5">Jenis pelanggaran</label>
                        <select id="pelanggaranEdit" name="violation_id" class="form-control">
                            <option selected disabled>Pilih Salah satu</option>
                            {{-- @foreach($Violation as $violation)
                            <option value="{{$violation->id}}">{{$violation->nama_pelanggaran}}</option>
                            @endforeach --}}
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
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            let previewStream;
            let panggilan_ortu_wali;
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
            //close modal then reload halaman
            $(document).on('click', '#close-modal', function() {
                window.location.reload();
            })
            //button tambah data
            $(document).on('click', '#button-tambah-data', function() {
                Swal.fire({
                    title: "Apa kamu ingin menggunakan camera foto?",
                    text: "",
                    icon: "warning",
                    width: 750,
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Iya, saya ingin menggunakan camera",
                    cancelButtonText: "Cancel",
                    denyButtonText: `Tidak, saya ingin input foto manual`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        try
                        {
                            navigator.mediaDevices.getUserMedia({video: true}).then((stream) => {
                                const video = $('#video')[0];
                                $('#pembungkus-camera').css('display', 'block');
                                video.srcObject = stream;
                                video.play();
                                previewStream = stream;
                            }).catch((error) => {
                                console.log('Error accessing camera:', error);
                                swal.fire('Akses kamera ditolak', 'Izinkan akses camera', 'error');
                            });
                        }catch(error)
                        {
                            console.log('error accessing camera: ', error);
                            swal.fire('Akses camera ditolak', 'Terjadi kesalahan', 'error');
                        }
                    }else if(result.isDenied){
                        $('.modal-add-data-input-foto').modal('show');
                        $('#preview-foto-input').css('display', 'none');
                    }
                });
            })
            //cancel foto
            $(document).on('click', '#cancel-foto', function() {
                const video = $('#video')[0];
                if(video.srcObject)
                {
                    const tracks = video.srcObject.getTracks();
                    tracks.forEach(track => track.stop());
                    video.srcObject = null;
                    $('#pembungkus-camera').css('display', 'none');
                }
            })
            //capture foto
            $(document).on('click', '#capture', function() {
                const player = document.getElementById('video');
                const canvas = document.getElementById('canvas');
                const context = canvas.getContext('2d');
                context.translate(canvas.width, 0);
                context.scale(-1, 1);
                context.drawImage(player, 0, 0, canvas.width, canvas.height);

                let capturedImage = canvas.toDataURL('image/jpeg');

                player.srcObject.getVideoTracks().forEach(track => track.stop());
                $('#preview-foto').attr('src', capturedImage);

                $('#pembungkus-camera').css('display', 'none');
                $('.modal-add-data').modal('show');
            })
            //input foto preview image
            $(document).on('change', '#input_foto', function() {
                let fileInput = $(this)[0];
                let file = fileInput.files[0];

                if(file)
                {
                    let urlImage = URL.createObjectURL(file);

                    $('#preview-foto-input').css('display', 'block');
                    $('#preview-foto-input').attr('src', urlImage);
                }
            })
            //form tambah data
            document.getElementById('form-tambah-panggilan-ortu-wali').addEventListener('submit', function(event) {
                event.preventDefault();
                const modal = $('.modal-add-data');

                let imageURL = $('#preview-foto').attr('src');
                let permasalahan = $('#permasalahan').val();
                let statusPanggilan = $('#status_panggilan').val();
                let student_id = $('#student_id').val();
                // console.log('imageURL:', imageURL);

                axios.post(`/dashboard-guru/panggilan-ortu-wali`, {
                    dokumentasi: imageURL,
                    permasalahan: permasalahan,
                    statusPanggilan: statusPanggilan,
                    student_id: student_id,
                }).then(response => {
                    modal.modal('hide');
                    swal.fire('Data berhasil ditambahkan', '', 'success').then(() => {
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
                        if(error.response.data.error){
                            Swal.fire('Data gagal di tambah', error.response.data.error, 'error').then(() => {
                                modal.modal('show');
                            })
                        }else{
                            Swal.fire('Data gagal di tambah', errorMessage, 'error').then(() => {
                                modal.modal('show');
                            });
                        }
                    }else{
                        Swal.fire('Data gagal di tambah', 'Terjadi kesalahan pada sisi server, hubungi kami segera', 'error');
                    }
                    console.error(error);
                })
            })
            //form tambah data input foto
            document.getElementById('form-tambah-panggilan-ortu-wali-input-foto').addEventListener('submit', function(event) {
                event.preventDefault();
                const modal = $('.modal-add-data-input-foto');

                let inputFotoGet = $('#input_foto')[0]; // atau document.getElementById('input_foto');
                let imageURL = inputFotoGet.files[0];

                let permasalahan = $('#permasalahan-input').val();
                let statusPanggilan = $('#status_panggilan-input').val();
                let student_id = $('#student_id-input').val();
                console.log('imageURL:', imageURL);

                // Create FormData object
                let formData = new FormData();
                formData.append('dokumentasi', imageURL);
                formData.append('permasalahan', permasalahan);
                formData.append('statusPanggilan', statusPanggilan);
                formData.append('student_id', student_id);

                axios.post(`/dashboard-guru/panggilan-ortu-wali`, formData).then(response => {
                    modal.modal('hide');
                    swal.fire('Data berhasil ditambahkan', '', 'success').then(() => {
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
                        if(error.response.data.error){
                            Swal.fire('Data gagal di tambah', error.response.data.error, 'error').then(() => {
                                modal.modal('show');
                            })
                        }else{
                            Swal.fire('Data gagal di tambah', errorMessage, 'error').then(() => {
                                modal.modal('show');
                            });
                        }
                    }else{
                        Swal.fire('Data gagal di tambah', 'Terjadi kesalahan pada sisi server, hubungi kami segera', 'error');
                    }
                    console.error(error);
                })
            })
            //tampil data edit
            $(document).on('click', '.editData', function() {
                panggilan_ortu_wali = $(this).data('id');

                axios.get(`/dashboard-guru/panggilan-ortu-wali/${panggilan_ortu_wali}/edit`).then(response => {
                    $('#student_id_edit').val(response.data.student_id);
                    $('#status_panggilan_edit').val(response.data.statusPanggilan);
                    $('#permasalahan_edit').val(response.data.permasalahan);
                    $('#preview-foto-edit').attr('src', '{{ asset('storage/images') }}/' + response.data.dokumentasi);
                })
            })
            //form edit data
            document.getElementById('form-edit-panggilan-ortu-wali').addEventListener('submit', function(event) {
                event.preventDefault(event);
                const modal = $('.modal-edit-data');

                // let panggilan_ortu_wali = $(this).data('id');
                let student_id = $('#student_id_edit').val();
                let statusPanggilan = $('#status_panggilan_edit').val();
                let permasalahan = $('#permasalahan_edit').val();
                axios.put(`/dashboard-guru/panggilan-ortu-wali/${panggilan_ortu_wali}`, {
                    student_id: student_id,
                    statusPanggilan: statusPanggilan,
                    permasalahan: permasalahan,
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
                        if(error.response.data.error){
                            Swal.fire('Data gagal di edit', error.response.data.error, 'error').then(() => {
                                modal.modal('show');
                            })
                        }else{
                            Swal.fire('Data gagal di edit', errorMessage, 'error').then(() => {
                                modal.modal('show');
                            });
                        }
                    }else{
                        Swal.fire('Data gagal di edit', 'Terjadi kesalahan pada sisi server, hubungi kami segera', 'error');
                    }
                    console.error(error);
                })
            })
            //delete data
            $(document).on('click', '.deleteData', function() {
                panggilan_ortu_wali = $(this).data('id');
                Swal.fire({
                    title: "Apa kamu ingin hapus data?",
                    text: "Data yang sudah dihapus tidak bisa dikembalikan",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Iya, saya mau hapus"
                    }).then((result) => {
                    if (result.isConfirmed) {
                        axios.delete(`/dashboard-guru/panggilan-ortu-wali/${panggilan_ortu_wali}`).then(response => {
                            Swal.fire({
                            title: "Data berhasil dihapus",
                            text: "",
                            icon: "success"
                            }).then(() => {
                                window.location.reload();
                            });
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
                                Swal.fire('Data gagal di tambah', errorMessage, 'error').then(() => {
                                    modal.modal('show');
                                });
                            }else{
                                Swal.fire('Data gagal di tambah', 'Terjadi kesalahan pada sisi server, hubungi kami segera', 'error');
                            }
                            console.error(error);
                        })
                    }
                });
            })
        })
    </script>
@endpush
