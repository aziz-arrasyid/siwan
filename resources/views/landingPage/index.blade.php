<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="siwan" content="width=device-width, initial-scale=1.0">
	<title>SIWAN</title>
    {{-- favicon icon --}}
    <link rel="shortcut icon" href="{{ asset('/assets/images/favicon.ico') }}" />
    {{-- url css --}}
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.22/dist/sweetalert2.min.css" rel="stylesheet">
    {{-- my css --}}
	<link href="{{ asset('/assets/css/landingPage/landingPage.css') }}" rel="stylesheet">
    <style>
        #google-maps {
            height: 450px; /* Tentukan tinggi peta */
            width: auto; /* Tentukan lebar peta */
        }
    </style>
</head>

<body>
    <!-- Navigasi -->
	<nav class="navbar fixed-top navbar-expand-lg navbar-dark p-md-3">
		<div class="container">
		  	<a class="navbar-brand" href="#"><span class="siwan">SIWAN</span></a>
		  	<button class="navbar-toggler" id="hamburger" type="button" data-bs-toggle="collapse" data-bs-target="#navigasi" aria-controls="navigasi" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  	</button>
		  	<div class="collapse navbar-collapse" id="navigasi">
				<div class="mx-auto"></div>
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link text-white" href="#Tentang">Tentang</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-white" href="#Pelayanan">Pelayanan</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-white" href="#Panduan">Panduan</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-white" href="#faq">FAQ's</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-white" href="{{ route('berita.index') }}">Berita</a>
					</li>
				</ul>
		  	</div>
		</div>
	</nav>

	<!-- Gambar -->
	<section class="siyongmai">
		<div class="cincau">
			<img class="mangga" src="{{ asset('/assets/images/landingPage/bg-siwan.svg') }}">
		</div>
		<div class="apel">
			<h1 class="meongg">Selamat Datang di</h1>
			<h1 class="kucinggg">SIWAN</h1>
			<p class="text text-center">“Membangun Karakter Siswa untuk Masa Depan”</p>
		</div>
	</section>

    <!-- Tentang -->
    @include('landingPage.components.tentang')
	<!-- Modal Bergabung-->
    @include('landingPage.components.modalBergabung')

	<!-- Pelayanan -->
    @include('landingPage.components.pelayanan')

	<!-- Panduan -->
    @include('landingPage.components.panduan')

	<!-- F.A.Q -->
    @include('landingPage.components.faq')

	<!-- G-Maps -->
    @include('landingPage.components.gMaps')

	<!-- Footer -->
	{{-- <footer class="text-center text-lg-start bg-body-tertiary text-muted">
		<!-- Section: Social media -->
		<section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
			<!-- Left -->
			<div class="me-5 d-none d-lg-block">
				<span>Get connected with us on social networks:</span>
			</div>
			<!-- Left -->

			<!-- Right -->
			<div>
				<a href="" class="me-4 text-reset">
					<i class="fab fa-instagram"></i>
				</a>
				<a href="" class="me-4 text-reset">
					<i class="fab fa-github"></i>
				</a>
			</div>
			<!-- Right -->
		</section>
		<!-- Section: Social media -->

		<!-- Section: Links  -->
		<section class="">
			<div class="container text-center text-md-start mt-5">
				<!-- Grid row -->
				<div class="row mt-3">
					<!-- Grid column -->
					<div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
						<!-- Content -->
						<h6 class="text-uppercase fw-bold mb-4">
							SIWAN
						</h6>
						<p>
						Sahabat setia dalam perjalanan membangun masa depan siswa
						</p>
					</div>
					<!-- Grid column -->

					<!-- Grid column -->
					<div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
						<!-- Links -->
						<h6 class="text-uppercase fw-bold mb-4">
							Products
						</h6>
						<p>
							<a href="#!" class="text-reset">Angular</a>
						</p>
						<p>
							<a href="#!" class="text-reset">React</a>
						</p>
						<p>
							<a href="#!" class="text-reset">Vue</a>
						</p>
						<p>
							<a href="#!" class="text-reset">Laravel</a>
						</p>
					</div>
					<!-- Grid column -->

					<!-- Grid column -->
					<div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
						<!-- Links -->
						<h6 class="text-uppercase fw-bold mb-4">
							Useful links
						</h6>
						<p>
							<a href="#!" class="text-reset">Pricing</a>
						</p>
						<p>
							<a href="#!" class="text-reset">Settings</a>
						</p>
						<p>
							<a href="#!" class="text-reset">Orders</a>
						</p>
						<p>
							<a href="#!" class="text-reset">Help</a>
						</p>
					</div>
					<!-- Grid column -->

					<!-- Grid column -->
					<div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
						<!-- Links -->
						<h6 class="text-uppercase fw-bold mb-4">Contact</h6>
						<p><i class="fas fa-home me-3"></i> New York, NY 10012, US</p>
						<p>
							<i class="fas fa-envelope me-3"></i>
							info@example.com
						</p>
						<p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
						<p><i class="fas fa-print me-3"></i> + 01 234 567 89</p>
					</div>
					<!-- Grid column -->
				</div>
				<!-- Grid row -->
			</div>
		</section>
		<!-- Section: Links  -->

		<!-- Copyright -->
		<div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
			© 2023 SIWAN
			<a class="text-reset fw-bold" href="https://smkn4-tanjungpinang.sch.id/">SMK Negeri 4 Tanjungpinang</a>
			All Rights Reserved
		</div>
		<!-- Copyright -->
	</footer> --}}
    @include('landingPage.components.footer')

    <!-- JavaScript -->
    @if ($sekolah != null && $sekolah->latitude != null && $sekolah->longitude != null && $sekolah->name != null)
    <script>
         let map;

        function initMap() {
            const latitude = parseFloat("{{$sekolah->latitude}}");
            const longitude = parseFloat("{{$sekolah->longitude}}");

            map = new google.maps.Map(document.getElementById("google-maps"), {
                center: { lat: latitude, lng: longitude },
                zoom: 18,
            });

            new google.maps.Marker({
                position: { lat: latitude, lng: longitude },
                map: map,
                title: "{{$sekolah->name}}",
            });
        }
    </script>
    @else
    <script>
        let map;

        function initMap() {
            const latitude = parseFloat("0.9093097961632389");
            const longitude = parseFloat("104.54413752571158");

            map = new google.maps.Map(document.getElementById("google-maps"), {
                center: { lat: latitude, lng: longitude },
                zoom: 18,
            });

            new google.maps.Marker({
                position: { lat: latitude, lng: longitude },
                map: map,
                title: "SMKN 4 Tanjungpinang",
            });
        }
    </script>
    @endif
    <script async defer src="https://maps.googleapis.com/maps/api/js?key={{ env('API_KEY_MAPS') }}&callback=initMap&libraries=maps,marker&v=beta"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
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
            //toastr succes bikin akun
            @if(Session('successRegister'))
            toastr.success('{{ session('successRegister') }}');
            @endif
            //show/hide pass
            $(document).on('change', '#lpass', function() {
                const passwordInput = document.getElementById('password');
                if (this.checked) {
                    passwordInput.type = 'text';
                } else {
                    passwordInput.type = 'password';
                }
            })
            //clear value on modal
            $('#modal-login-data').on('hidden.bs.modal', function(e) {
                $(this).find('input[type="text"], input[type="password"]').val('');
                $(this).find('input[type=checkbox]').prop('checked', false);
            })
            //notif error login
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

            window.location.href = "{{ url('/#Tentang') }}";

            Swal.fire('Gagal login', errorMessage, 'error').then(() => {
                $('#modal-login-data').modal('show');
            });
            @endif

            var nav = document.querySelector('nav');
            window.addEventListener('scroll', function () {
                if (window.pageYOffset > 100) {
                    nav.classList.add('bg-dark', 'shadow');
                } else {
                    nav.classList.remove('bg-dark', 'shadow');
                }
            });
            const buttons = document.querySelectorAll('#faq_button');
                buttons.forEach( button =>{
                    button.addEventListener('click',()=>{
                    const faq = button.nextElementSibling;
                    const icon = button.children[1];
                    faq.classList.toggle('show');
                    icon.classList.toggle('rotate');
                })
            })
        })
    </script>

    <script type="text/javascript">

    </script>
</body>
</html>
