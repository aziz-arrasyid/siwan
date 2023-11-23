<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{ $berita->title }}</title>
        {{-- favicon icon --}}
        <link rel="shortcut icon" href="{{ asset('/assets/images/favicon.ico') }}" />
        {{-- url css --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
        {{-- my css --}}
        <link href="{{ asset('/assets/css/landingPage/landingPage.css') }}" rel="stylesheet">
    </head>
    <body>
        <!-- Navigasi -->
        <nav class="navbar fixed-top navbar-expand-lg bg">
            <div class="container">
                <a class="navbar-brand fs-3" href="{{ route('landing.page.index') }}"><span class="text-white siwan">SIWAN</span></a>
                <button class="btn btn-light navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                {{-- <span class="navbar-toggler-icon"></span> --}}
                <i class="fa-solid fa-bars text-white"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item">
                        <a class="nav-link text-white" aria-current="page" href="{{ route('landing.page.index') }}">Home</a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('berita.index') }}">Berita</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- BERITAAAAAAAAAAAAAAAAAAA -->
        <div class="container">
            <div class="post">
                <img class="mangga" src="{{ asset('/storage/images/'. $berita->picture) }}">
                <h1 class="post-title">{{ $berita->title }}</h1>
                <p class="post-meta">Diposting pada <span class="font-weight-bold">{{ \Carbon\Carbon::parse($berita->created_at)->translatedFormat('d F Y') }}</span></p>
                <div class="post-content">
                    <p>{{ $berita->content }}</p>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <footer class="text-center text-lg-start bg-body-tertiary text-muted">
            <section class="d-flex justify-content-center justify-content-lg-between p-4 border-bottom">
                <div class="me-5 d-none d-lg-block">
                    <span>Lihat berita lainnya:</span>
                </div>
                <div>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="" class="me-4 text-reset">
                        <i class="fab fa-github"></i>
                    </a>
                </div>
            </section>
            <section class="">
                <div class="container text-center text-md-start mt-5">
                    <div class="row mt-3">
                        <div class="related-posts">
                            @foreach ($BeritaRandom as $beritaRandom)
                                <div class="related-post">
                                    <a href="{{ route('berita.single', ['title' => $beritaRandom->title]) }}" class="link-offset-2 link-underline link-underline-opacity-0">
                                        <img src="{{ asset('/storage/images/'. $beritaRandom->picture) }}" width="100%" height="225" style="object-fit: cover" alt="{{ $beritaRandom->title }}">
                                        <p class="ayam text-info">{{ $beritaRandom->title }}</p>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
            <!-- Copyright -->
            <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
                © 2023 SIWAN
                <a class="text-reset fw-bold" href="https://smkn4-tanjungpinang.sch.id/">SMK Negeri 4 Tanjungpinang</a>
                All Rights Reserved
            </div>
            <!-- Copyright -->
        </footer>
        <!-- Footer -->
    </body>
    {{-- url js --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</html>
