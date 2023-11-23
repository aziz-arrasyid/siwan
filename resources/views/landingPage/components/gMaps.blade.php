<section class="section section-padding" id="gmps">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="section-header text-center pb-5">
						<h2 class="kucing">Google Map</h2>
						<p>SMK Negeri 4 Tanjungpinang</p>
					</div>
				</div>
			</div>
            <div class="row">
				<div class="col-lg-3 col-sm-2 col-md-1">
                    {{--  --}}
				</div>
				<div class="col-lg-6 col-sm-8 col-md-10">
                    @if ($sekolah != null && $sekolah->latitude != null && $sekolah->longitude != null)
                    <div id="google-maps" class="text-center"></div>
                    @else
                        <h5 class="text-center">Data maps kosong</h5>
                    @endif
				</div>
				<div class="col-lg-3 col-sm-2 col-md-1">
                    {{--  --}}
				</div>
			</div>
		</div>
	</section>
