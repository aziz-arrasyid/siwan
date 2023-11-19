

<!doctype html>
<html lang="en">
  <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>
        {{-- admin page --}}
        @if (Route::is('admin'))
        Dashboard-Admin
        @elseif(Route::is('violations.index'))
        Data-Pelanggaran
        @elseif(Route::is('sekolah.index'))
        Data-Sekolah
        @elseif(Route::is('competences.index'))
        Data-Jurusan
        @elseif(Route::is('teachers.index'))
        Data-Guru
        @elseif(Route::is('classroom.index'))
        Data-Kelas
        @elseif(Route::is('students.index'))
        Data-Siswa
        {{-- kreator page --}}
        @elseif(Route::is('kreator'))
        Dashboard-Kreator
        @elseif(Route::is('kreator.index'))
        Data-Berita
        {{-- guru page --}}
        @elseif(Route::is('teacher'))
        Dashboard-Guru
        @elseif(Route::is('siswa.biodata'))
        Biodata-Siswa
        @elseif(Route::is('siswa.pelanggaran'))
        Pelanggaran-Siswa
        @elseif(Route::is('panggilan-ortu-wali.index'))
        Panggilan-Ortu/Wali
        {{-- siswa page --}}
        @elseif(Route::is('siswa'))
        Dashboard-Siswa
        @elseif(Route::is('pelanggaran'))
        Data-Pelanggaran
        @elseif(Route::is('dataPanggilan'))
        Data-panggilan-Ortu/Wali
        @endif
    </title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('/assets/images/favicon.ico') }}" />
    <link rel="stylesheet" href="{{ asset('/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/css/backend.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/vendor/remixicon/fonts/remixicon.css') }}">

    <link rel="stylesheet" href="{{ asset('/assets/vendor/tui-calendar/tui-calendar/dist/tui-calendar.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/vendor/tui-calendar/tui-date-picker/dist/tui-date-picker.css') }}">
    <link rel="stylesheet" href="{{ asset('/assets/vendor/tui-calendar/tui-time-picker/dist/tui-time-picker.css') }}">

    {{-- css url --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.22/dist/sweetalert2.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@x.x.x/dist/select2-bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

  </head>
  <body class="  ">
  <!-- loader Start -->
  {{-- <div id="loading">
      <div id="loading-center">
      </div>
</div> --}}
<!-- loader END -->
<!-- Wrapper Start -->
<div class="wrapper">
    <div class="iq-sidebar sidebar-default ">
        @include('layouts.components.sidebar')
    </div>
    <div class="iq-top-navbar">
        <div class="iq-navbar-custom">
            <nav class="navbar navbar-expand-lg navbar-light p-0">
                <div class="iq-navbar-logo d-flex align-items-center justify-content-between">
            <i class="ri-menu-line wrapper-menu"></i>
            <a href="" class="header-logo">
                <h4 class="logo-title text-uppercase">SIWAN</h4>

            </a>
        </div>
        @include('layouts.components.topbar')
    </div>
</nav>
</div>
</div>
<div class="content-page">
    <div class="container-fluid">
          @yield('content')
      </div>
    </div>
  </div>
  <!-- Wrapper End-->

  <!-- footer start -->
  <footer class="iq-footer">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-6">
          <ul class="list-inline mb-0">
            <li class="list-inline-item"><a href="#">Privacy Policy</a></li>
            <li class="list-inline-item"><a href="#">Terms of Use</a></li>
          </ul>
        </div>
        <div class="col-lg-6 text-right">
          <span class="mr-1"><script>document.write(new Date().getFullYear())</script>©</span> <a href="#" class="">SMK Negeri 4 Tanjungpinang</a>.
        </div>
      </div>
    </div>
  </footer>
  <!-- Backend Bundle JavaScript -->
  <script src="{{ asset('/assets/js/backend-bundle.min.js') }}"></script>

  <!-- Table Treeview JavaScript -->
  <script src="{{ asset('/assets/js/table-treeview.js') }}"></script>

  <!-- Chart Custom JavaScript -->
  <script src="{{ asset('/assets/js/customizer.js') }}"></script>

  <!-- Chart Custom JavaScript -->
  <script async src="{{ asset('/assets/js/chart-custom.js') }}"></script>
  <!-- Chart Custom JavaScript -->
  <script async src="{{ asset('/assets/js/slider.js') }}"></script>

  <!-- app JavaScript -->
  <script src="{{ asset('/assets/js/app.js') }}"></script>

  {{-- URL JavaScript --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>
  <script src="https://momentjs.com/downloads/moment-with-locales.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  @stack('scripts')

   {{-- My JavaScript --}}
  <script>
    $(document).ready(function() {
      document.getElementById('logout').addEventListener('click', function(event) {
          event.preventDefault();
          Swal.fire({
            title: 'Apa kamu yakin ingin logout?',
            text: "Jika logout maka harus login lagi",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Iya, saya logout'
            }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                  'Berhasil logout!',
                  'Harus login jika mau masuk ke halaman ini',
                  'success'
                ).then(() => {
                  window.location.href = '{{ route('logout') }}';
                })
            }
          });
      });
    });
  </script>
  </body>
</html>
