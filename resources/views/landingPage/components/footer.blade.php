
    <footer class="text-center text-lg-start bg-body-tertiary text-muted">
		<!-- Section: Social media -->
		<section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
			<!-- Left -->
			<div class="me-5 d-none d-lg-block">
				<span>Terhubung Bersama Kami:</span>
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
							Tentang
						</h6>
						<p>
							<a href="{{ route('landing.page.index') }}" class="text-reset">Home</a>
						</p>
						<p>
							<a href="{{ route('berita.index') }}" class="text-reset">Berita</a>
						</p>
					</div>
					<!-- Grid column -->

					<!-- Grid column -->
					<div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
						<!-- Links -->
						<h6 class="text-uppercase fw-bold mb-4">
							Panduan
						</h6>
						<p>
							<a href="{{ route('visi.misi.index') }}" class="text-reset">Visi Misi</a>
						</p>
						<p>
							<a href="{{ route('tata.tertib.index') }}" class="text-reset">Tata Tertib Siswa</a>
						</p>
						<p>
							<a href="{{ route('poin.pelanggaran.index') }}" class="text-reset">Poin Pelanggaran</a>
						</p>
					</div>
					<!-- Grid column -->

					<!-- Grid column -->
					<div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
						<!-- Links -->
						<h6 class="text-uppercase fw-bold mb-4">Kontak</h6>
                        @if ($sekolah != null && $sekolah->alamatSekolah != null && $sekolah->email != null && $sekolah->telepon)
                            <p>
                                <i class="fas fa-home me-3"></i>{{ $sekolah->alamatSekolah }}
                            </p>
                            <p>
                                <i class="fas fa-envelope me-3"></i>{{ $sekolah->email }}
                            </p>
                            <p>
                                <i class="fas fa-phone me-3"></i>{{ $sekolah->telepon }}
                            </p>
                        @else
                            <p>
                                <i class="fas fa-home me-3"></i>Jl. Nusantara No.KM.14, Batu IX, Kec. Tanjungpinang Tim., Kota Tanjung Pinang, Kepulauan Riau 29157
                            </p>
                            <p>
                                <i class="fas fa-envelope me-3"></i>smkntpi4@gmail.com
                            </p>
                            <p>
                                <i class="fas fa-phone me-3"></i>tel:0771-4440844
                            </p>
                        @endif
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
	</footer>
