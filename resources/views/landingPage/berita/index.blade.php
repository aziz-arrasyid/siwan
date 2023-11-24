<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="siwan" content="width=device-width, initial-scale=1.0">
	<title>SIWAN Berita</title>
    {{-- favicon icon --}}
    <link rel="shortcut icon" href="{{ asset('/assets/images/favicon.ico') }}" />
    {{-- url css --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.22/dist/sweetalert2.min.css" rel="stylesheet">
    {{-- my css --}}
	<link href="{{ asset('/assets/css/landingPage/landingPage.css') }}" rel="stylesheet">
    <style>
        #google-maps {
            height: 450px; /* Tentukan tinggi peta */
            width: 600px; /* Tentukan lebar peta */
        }
    </style>
</head>

<body>
    <!-- Navigasi -->
	<nav class="navbar fixed-top navbar-expand-lg navbar-dark p-md-3">
		<div class="container">
		  	<a class="navbar-brand" href="{{ route('landing.page.index') }}"><span class="siwan">SIWAN</span></a>
		  	<button class="navbar-toggler" id="hamburger" type="button" data-bs-toggle="collapse" data-bs-target="#navigasi" aria-controls="navigasi" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  	</button>
		  	<div class="collapse navbar-collapse" id="navigasi">
				<div class="mx-auto"></div>
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link text-white" href="#berita">Berita</a>
					</li>
					<li class="nav-item">
						<a class="nav-link text-white" href="#populer">Terpopuler</a>
					</li>
					<li class="nav-item">
						<button type="button" class="btn btn-outline-light mx-2" data-bs-toggle="modal" data-bs-target="#modal-login-data">
                            Bergabung
                        </button>
					</li>
				</ul>
		  	</div>
		</div>
	</nav>
	<!-- Modal Bergabung-->
	@include('landingPage.components.modalBergabung')

	<!-- Gambar -->
	<section class="siyongmai">
		<div class="cincau">
			<img class="mangga" src="{{ asset('/assets/images/landingPage/bg-siwan.svg') }}">
		</div>
		<div class="apel">
			<h1 class="meongg">Selamat Datang di</h1>
			<h1 class="kucinggg">SIWAN Berita</h1>
			<p class="text text-center">“Cerita: Bersama Membangun Karakter, Meraih Prestasi”</p>
		</div>
	</section>

	<!-- Berita -->
	<section class="section section-padding" id="berita">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-header text-center pb-5">
						<h2 class="kucing">Berita</h2>
						<p>Album: di sini seluruh cerita inspiratif kita</p>
					</div>
				</div>
			</div>
			<div class="container my-4">
				<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @if ($Berita->isNotEmpty())
                        @foreach ($Berita as $berita)
                        <div class="col">
                            <div class="cardd">
                                <img src="{{ asset('/storage/images/'. $berita->picture) }}" class="bd-placeholder-img card-img-top" width="100%" height="225" style="object-fit: cover">
                                <div class="card-body p-4">
                                    <p class="card-text">{{ Str::substr($berita->content, 0, 100) }}{{ Str::length($berita->content) > 100 ? '...' : ''}}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                        <a href="{{ route('berita.single', ['title' => $berita->title]) }}" class="button-selengkapnya">Selengkapnya</a>
                                        </div>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('d F Y') }}</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                    <div class="col-md-12">
                        <h5 class="text-center">Data berita kosong</h5>
                    </div>
                    @endif
				</div>
                <div class="mt-5">
                    {{ $Berita->links() }}
                </div>
			</div>
		</div>
	</section>

	<!-- Berita Terpopuler -->
	<section class="section section-padding" id="populer">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-header text-center pb-5">
						<h2 class="kucing">Berita Terpopuler</h2>
						<p>Cerita terdepan untuk kita</p>
					</div>
				</div>
			</div>
			<div class="container my-4">
				<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
                    @if ($BeritaPopuler->isNotEmpty())
                        @foreach ($BeritaPopuler as $beritaPopuler)
                        <div class="col">
                        <div class="cardd">
                                <img src="{{ asset('storage/images/'. $beritaPopuler->picture) }}" class="bd-placeholder-img card-img-top" width="100%" height="225" style="object-fit: cover">
                                <div class="card-body p-4">
                                <p class="card-text">{{ Str::substr($beritaPopuler->content, 0, 100) }}{{ Str::length($beritaPopuler->content) > 100 ? '...' : ''}}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                        <div class="btn-group">
                                        <a href="{{ route('berita.single', ['title' => $beritaPopuler->title]) }}" class="button-selengkapnya">Selengkapnya</a>
                                        </div>
                                        <small class="text-muted">{{ \Carbon\Carbon::parse($beritaPopuler->created_at)->translatedFormat('d F Y') }}</small>
                                </div>
                                </div>
                        </div>
                        </div>
                        @endforeach
                    @else
                    <div class="col-md-12">
                        <h5 class="text-center">Data berita populer kosong</h5>
                    </div>
                    @endif
				</div>
			</div>
		</div>
	</section>

	<!-- G-Maps -->
	@include('landingPage.components.gMaps')

	<!-- Footer -->
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            document.querySelectorAll('.pagination a').forEach(function(link) {
                const url = new URL(link.href);
                const page = url.searchParams.get('page');
                link.href = `/berita-siwan?page=${page}#berita`;
            });
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
            Swal.fire('Gagal login', errorMessage, 'error').then(() => {
                $('#modal-login-data').modal('show');
            });
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
            //navbar scroll ganti warna
            var nav = document.querySelector('nav');
            window.addEventListener('scroll', function () {
                if (window.pageYOffset > 100) {
                    nav.classList.add('bg-dark', 'shadow');
                } else {
                    nav.classList.remove('bg-dark', 'shadow');
                }
            });
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
