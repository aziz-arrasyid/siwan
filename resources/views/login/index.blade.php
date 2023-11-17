@extends('login.layouts.master')

@section('content')
<section class="login-content">
    <div class="container">
        <div class="row align-items-center justify-content-center height-self-center">
            <div class="col-lg-8">
                <div class="card auth-card">
                    <div class="card-body p-0">
                        <div class="d-flex align-items-center auth-content">
                            <div class="col-lg-6 bg-primary content-left">
                                <div class="p-3">
                                    <h2 class="mb-2 text-white">Login</h2>
                                    <p>Login to Stay Connected.</p>
                                    <form action="{{ route('authenticate') }}" method="post" id="formLogin">
                                        @csrf
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="floating-label form-group">
                                                    <input class="floating-input form-control" id="username" name="username" type="text" placeholder=" ">
                                                    <label>Username</label>
                                                </div>
                                            </div>
                                            <div class="col-lg-12">
                                                <div class="floating-label form-group">
                                                    <input class="floating-input form-control" name="password" id="passwordInput" type="password" placeholder=" ">
                                                    <label>Password</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-6"></div>
                                            <div class="col-lg-1">
                                                <span id="showPassword" class="">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor">
                                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                                                        <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
                                                    </svg>
                                                </span>
                                            </div>
                                            <div class="col-lg-5">
                                                <span class="user-select-none">Show Password</span>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-white me-3">Login</button>
                                    </form>
                                    {{-- <button type="button" id="face" class="btn btn-white me-3 mt-3">Face sign in</button> --}}
                                    {{-- <video id="camera" autoplay style="display: none;"></video> --}}
                                </div>
                            </div>
                            <div class="col-lg-6 content-right">
                                <img src="{{ asset('/assets/images/login/logoSKANPAT.png') }}" class="img-fluid image-right user-select-none" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="center-camera" style="display: none;">
    <video id="camera" autoplay></video>
    <div>
        <button id="cancel" class="btn btn-danger">Cancel</button>
    </div>
</div>
@endsection

@push('scripts')
<script>
    const passwordCheckbox = document.getElementById('showPassword');
    const passwordInput = document.getElementById('passwordInput');

    function change() {
        if(passwordInput.type == 'password'){
            passwordCheckbox.innerHTML = `<svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-slash-fill" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path d="M10.79 12.912l-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7.029 7.029 0 0 0 2.79-.588zM5.21 3.088A7.028 7.028 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474L5.21 3.089z"/>
                <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829l-2.83-2.829zm4.95.708l-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829z"/>
                <path fill-rule="evenodd" d="M13.646 14.354l-12-12 .708-.708 12 12-.708.708z"/>
            </svg>`;
            passwordInput.type = 'text';
        }else{
            passwordCheckbox.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-eye-fill" fill="currentColor">
                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z" />
                <path fill-rule="evenodd" d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z" />
            </svg>`;
            passwordInput.type = 'password';
        }
    }
    passwordCheckbox.addEventListener('click', change);

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
        @if(Session('gagal'))
        Swal.fire('Gagal login', '{{ session('gagal') }}', 'error');
        @endif
        @if(Session('successRegister'))
        toastr.success('{{ session('successRegister') }}');
        @endif

        @if($errors->any())
        const errorMessages = @json($errors->all());

        let errorMessage = '';

        let isFirstError = true; // Flag to track the first error
        for (const field in errorMessages) {
            if (!isFirstError) {
                errorMessage += ', '; // Add a comma before the error message
            } else {
                isFirstError = false;
            }
            errorMessage += errorMessages[field];
        }

        Swal.fire('Data gagal disimpan', errorMessage, 'error');
        @endif

        // document.getElementById('face').addEventListener('click', function() {
        //     axios.get(`/face`)
        //         .then(function (response) {
        //             // Tangani respons dari server jika diperlukan
        //             console.log(response.data);
        //             console.log("tes");
        //         })
        //         .catch(function (error) {
        //             // Tangani kesalahan jika diperlukan
        //             console.error(error);
        //         });
        // });

        // document.getElementById('face').addEventListener('click', function() {
        //     navigator.mediaDevices.getUserMedia({ video: true })
        //     .then(function (stream) {
        //         const camera = document.getElementById('camera');
        //         document.querySelector('.center-camera').style.display = 'block';
        //         camera.srcObject = stream;
        //     })
        //     .catch(function (error) {
        //          Swal.fire({
        //             icon: 'error',
        //             title: 'Aksess ditolak',
        //             text: 'Kamu harus izinkan camera di browser',
        //         });
        //     });
        // })

        // const videoElement = document.getElementById('camera');
        // const canvas = document.createElement('canvas');
        // const context = canvas.getContext('2d');
        // canvas.width = videoElement.videoWidth;
        // canvas.height = videoElement.videoHeight;

        // videoElement.addEventListener('play', () => {
        //     setInterval(() => {
        //         context.drawImage(videoElement, 0, 0, canvas.width, canvas.height);
        //         const imageData = canvas.toDataURL('image/jpg');

        //         // Kirim gambar ke server menggunakan permintaan HTTP
        //         // fetch('/face', {
        //         //     method: 'POST',
        //         //     body: JSON.stringify({ image: imageData }),
        //         //     headers: {
        //         //         'Content-Type': 'application/json',
        //         //     },
        //         // });
        //         axios.post(`/face`, {image: imageData}).then(function(response) {

        //         })
        //     }, 1000); // Mengirim gambar setiap 1 detik
        // });; // Mengirim gambar setiap 1 detik

        // document.getElementById('cancel').addEventListener('click', function() {
        //     // Menyembunyikan elemen kamera dan tombol "Cancel"
        //     const cameraContainer = document.querySelector('.center-camera');
        //     cameraContainer.style.display = 'none';

        //     // Hentikan aliran video kamera (opsional)
        //     const stream = camera.srcObject;
        //     if (stream) {
        //         const tracks = stream.getTracks();
        //         tracks.forEach(track => track.stop());
        //         camera.srcObject = null;
        //     }
        // })

    });
</script>
@endpush
