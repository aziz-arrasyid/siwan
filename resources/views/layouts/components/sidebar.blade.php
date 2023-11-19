    <div class="iq-sidebar-logo d-flex align-items-center">
      <a href="" class="header-logo">
        <img src="{{ asset('/assets/images/logo.svg') }}" alt="logo">
        <h3 class="logo-title light-logo">SIWAN</h3>
      </a>
      <div class="iq-menu-bt-sidebar ml-0">
        <i class="las la-bars wrapper-menu"></i>
      </div>
    </div>
    @if (auth()->user()->role == 'admin')
    <div class="data-scrollbar" data-scroll="1">
      <nav class="iq-sidebar-menu">
        <ul id="iq-sidebar-toggle" class="iq-menu">
          <li class="{{ Route::is('admin') ? 'active' : '' }}">
            <a href="{{ route('admin') }}" class="svg-icon">
              <svg class="svg-icon" width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
              </svg>
              <span class="ml-4">Dashboards</span>
            </a>
          </li>
          <li class="{{ Route::is('violations.index') ? 'active' : '' }}">
            <a href="{{ route('violations.index') }}" class="svg-icon">
              <svg class="svg-icon" id="p-dash11" width="20" height="20" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
              </svg>
              <span class="ml-4">Data Pelanggaran</span>
            </a>
          </li>
          <li class="">
              <a href="#DataMaster" class="collapsed svg-icon" data-toggle="collapse" aria-expanded="false">
                <svg class="svg-icon" id="p-dash13" width="20" height="20"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                </svg>
                <span class="ml-4">Data Master</span>
                <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
              </a>
              <ul id="DataMaster" class="iq-submenu collapse">
                <li class="{{ route::is('sekolah.index') ? 'active' : '' }}">
                    <a href="{{ route('sekolah.index') }}" class="svg-icon">
                      <i class="las la-minus"></i><span class="">Data Sekolah</span>
                    </a>
                </li>
                <li class="{{ route::is('competences.index') ? 'active' : '' }}">
                    <a href="{{ route('competences.index') }}" class="svg-icon">
                      <i class="las la-minus"></i><span class="">Data Jurusan</span>
                    </a>
                </li>
                <li class="{{ route::is('teachers.index') ? 'active' : '' }}">
                  <a href="{{ route('teachers.index') }}">
                    <i class="las la-minus"></i><span class="">Data Guru</span>
                  </a>
                </li>
                <li class="{{ route::is('classroom.index') ? 'active' : '' }}">
                    <a href="{{ route('classroom.index') }}" class="svg-icon">
                      <i class="las la-minus"></i><span class="">Data Kelas</span>
                    </a>
                </li>
                <li class="{{ route::is('students.index') ? 'active' : '' }}">
                    <a href="{{ route('students.index') }}" class="svg-icon">
                      <i class="las la-minus"></i><span class="">Data Siswa</span>
                    </a>
                </li>
              </ul>
          </li>
        </ul>
      </nav>
      <div class="pt-5 pb-2"></div>
    </div>
    @endif
    @if (auth()->user()->role == 'kreator')
    <div class="data-scrollbar" data-scroll="1">
      <nav class="iq-sidebar-menu">
        <ul id="iq-sidebar-toggle" class="iq-menu">
          <li class="{{ Route::is('kreator') ? 'active' : '' }}">
            <a href="{{ route('kreator') }}" class="svg-icon">
              <svg class="svg-icon" width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
              </svg>
              <span class="ml-4">Dashboards</span>
            </a>
          </li>
          <li class="{{ Route::is('kreator.index') ? 'active' : '' }}">
            <a href="{{ route('kreator.index') }}" class="svg-icon">
              <svg class="svg-icon" width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
              </svg>
              <span class="ml-4">Data berita</span>
            </a>
          </li>
          {{-- <li class="">
              <a href="#DataMaster" class="collapsed svg-icon" data-toggle="collapse" aria-expanded="false">
                <svg class="svg-icon" id="p-dash13" width="20" height="20"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                </svg>
                <span class="ml-4">Data Master</span>
                <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
              </a>
              <ul id="DataMaster" class="iq-submenu collapse">
                <li class="{{ route::is('sekolah.index') ? 'active' : '' }}">
                    <a href="{{ route('sekolah.index') }}" class="svg-icon">
                      <i class="las la-minus"></i><span class="">Data Sekolah</span>
                    </a>
                </li>
                <li class="{{ route::is('competences.index') ? 'active' : '' }}">
                    <a href="{{ route('competences.index') }}" class="svg-icon">
                      <i class="las la-minus"></i><span class="">Data Jurusan</span>
                    </a>
                </li>
                <li class="{{ route::is('teachers.index') ? 'active' : '' }}">
                  <a href="{{ route('teachers.index') }}">
                    <i class="las la-minus"></i><span class="">Data Guru</span>
                  </a>
                </li>
                <li class="{{ route::is('classroom.index') ? 'active' : '' }}">
                    <a href="{{ route('classroom.index') }}" class="svg-icon">
                      <i class="las la-minus"></i><span class="">Data Kelas</span>
                    </a>
                </li>
                <li class="{{ route::is('students.index') ? 'active' : '' }}">
                    <a href="{{ route('students.index') }}" class="svg-icon">
                      <i class="las la-minus"></i><span class="">Data Siswa</span>
                    </a>
                </li>
              </ul>
          </li> --}}
        </ul>
      </nav>
      <div class="pt-5 pb-2"></div>
    </div>
    @endif
    @if (auth()->user()->role == 'guruPiket')
    <div class="data-scrollbar" data-scroll="1">
      <nav class="iq-sidebar-menu">
        <ul id="iq-sidebar-toggle" class="iq-menu">
          <li class="{{ Route::is('guru.piket') ? 'active' : '' }}">
            <a href="{{ route('guru.piket') }}" class="svg-icon">
              <svg class="svg-icon" width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
              </svg>
              <span class="ml-4">Dashboards</span>
            </a>
          </li>
          <li class="{{ Route::is('siswa.pelanggaran.piket') ? 'active' : '' }}">
            <a href="{{ route('siswa.pelanggaran.piket') }}" class="svg-icon">
              <svg class="svg-icon" width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
              </svg>
              <span class="ml-4">Pelanggaran</span>
            </a>
          </li>
        </ul>
      </nav>
      <div class="pt-5 pb-2"></div>
    </div>
    @endif
    @if (auth()->user()->role == 'guru')
    <div class="data-scrollbar" data-scroll="1">
      <nav class="iq-sidebar-menu">
        <ul id="iq-sidebar-toggle" class="iq-menu">
          <li class="{{ Route::is('teacher') ? 'active' : '' }}">
            <a href="{{ route('teacher') }}" class="svg-icon">
              <svg class="svg-icon" width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
              </svg>
              <span class="ml-4">Dashboards</span>
            </a>
          </li>
          @php
            $teacher = \App\Models\Teacher::where('user_id', auth()->user()->id)->first();
            //tentukan apakah dia guru wali kelas atau bukan
          @endphp
          @if (\App\Models\Classroom::where('teacher_id', $teacher->id)->exists())
          <li class="">
              <a href="#DataMaster" class="collapsed svg-icon" data-toggle="collapse" aria-expanded="false">
                <svg class="svg-icon" id="p-dash13" width="20" height="20"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                  <path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect>
                </svg>
                <span class="ml-4">Siswa</span>
                <i class="las la-angle-right iq-arrow-right arrow-active"></i>
                <i class="las la-angle-down iq-arrow-right arrow-hover"></i>
              </a>
              <ul id="DataMaster" class="iq-submenu collapse">
                <li class="{{ route::is('siswa.biodata') ? 'active' : '' }}">
                    <a href="{{ route('siswa.biodata') }}" class="svg-icon">
                      <i class="las la-minus"></i><span class="">Biodata</span>
                    </a>
                </li>
                <li class="{{ route::is('siswa.pelanggaran') ? 'active' : '' }}">
                  <a href="{{ route('siswa.pelanggaran') }}">
                    <i class="las la-minus"></i><span class="">Pelanggaran</span>
                  </a>
                </li>
                <li class="{{ route::is('panggilan-ortu-wali.index') ? 'active' : '' }}">
                  <a href="{{ route('panggilan-ortu-wali.index') }}">
                    <i class="las la-minus"></i><span class="">Panggilan Ortu/wali</span>
                  </a>
                </li>
              </ul>
          </li>
          @endif
        </ul>
      </nav>
      <div class="pt-5 pb-2"></div>
    </div>
    @endif
    @if (auth()->user()->role == 'siswa')
    <div class="data-scrollbar" data-scroll="1">
      <nav class="iq-sidebar-menu">
        <ul id="iq-sidebar-toggle" class="iq-menu">
          <li class="{{ Route::is('siswa') ? 'active' : '' }}">
            <a href="{{ route('siswa') }}" class="svg-icon">
              <svg class="svg-icon" width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
              </svg>
              <span class="ml-4">Dashboards</span>
            </a>
          </li>
          <li class="{{ Route::is('pelanggaran') ? 'active' : '' }}">
            <a href="{{ route('pelanggaran') }}" class="svg-icon">
              <svg class="svg-icon" width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
              </svg>
              <span class="ml-4">Data pelanggaran</span>
            </a>
          </li>
          <li class="{{ Route::is('dataPanggilan') ? 'active' : '' }}">
            <a href="{{ route('dataPanggilan') }}" class="svg-icon">
              <svg class="svg-icon" width="25" height="25" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                <polyline points="9 22 9 12 15 12 15 22"></polyline>
              </svg>
              <span class="ml-4">Data panggilan</span>
            </a>
          </li>
        </ul>
      </nav>
      <div class="pt-5 pb-2"></div>
    </div>
    @endif
