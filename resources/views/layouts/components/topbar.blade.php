<div class="navbar-breadcrumb">
    <h5>Dashboard</h5>
</div>
<div class="d-flex align-items-center">
    <button class="navbar-toggler" type="button" data-toggle="collapse"
    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
    aria-label="Toggle navigation">
    <i class="ri-menu-3-line"></i>
</button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
@if (auth()->user()->role == 'admin')
    <ul class="navbar-nav ml-auto navbar-list align-items-center">
        <li class="nav-item nav-icon dropdown caption-content">
            <a href="#" class="search-toggle dropdown-toggle  d-flex align-items-center" id="dropdownMenuButton4"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="{{ asset('/assets/images/user/1.jpg') }}" class="img-fluid rounded-circle" alt="user">
            <div class="caption ml-3">
                <h6 class="mb-0 line-height">{{ auth()->user()->username }}<i class="las la-angle-down ml-2"></i></h6>
            </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-right border-none" aria-labelledby="dropdownMenuButton">
            <li class="dropdown-item d-flex svg-icon">
                <svg class="svg-icon mr-0 text-primary" id="h-01-p" width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <a href="{{ route('profile') }}">My Profile</a>
            </li>
            <li class="dropdown-item  d-flex svg-icon border-top" id="logout">
                <svg class="svg-icon mr-0 text-primary" id="h-05-p" width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <a href="" >Logout</a>
            </li>
        </ul>
    </li>
</ul>
@endif
@if (auth()->user()->role == 'kreator')
<ul class="navbar-nav ml-auto navbar-list align-items-center">
        <li class="nav-item nav-icon dropdown caption-content">
            <a href="#" class="search-toggle dropdown-toggle  d-flex align-items-center" id="dropdownMenuButton4"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="{{ asset('/assets/images/user/1.jpg') }}" class="img-fluid rounded-circle" alt="user">
            <div class="caption ml-3">
                <h6 class="mb-0 line-height">{{ auth()->user()->username }}<i class="las la-angle-down ml-2"></i></h6>
            </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-right border-none" aria-labelledby="dropdownMenuButton">
            <li class="dropdown-item d-flex svg-icon">
                <svg class="svg-icon mr-0 text-primary" id="h-01-p" width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <a href="{{ route('profile') }}">My Profile</a>
            </li>
            <li class="dropdown-item  d-flex svg-icon border-top" id="logout">
                <svg class="svg-icon mr-0 text-primary" id="h-05-p" width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <a href="" >Logout</a>
            </li>
        </ul>
    </li>
</ul>
@endif
@if (auth()->user()->role == 'guruPiket')
    <ul class="navbar-nav ml-auto navbar-list align-items-center">
        <li class="nav-item nav-icon dropdown caption-content">
            <a href="#" class="search-toggle dropdown-toggle  d-flex align-items-center" id="dropdownMenuButton4"
            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="{{ asset('/assets/images/user/1.jpg') }}" class="img-fluid rounded-circle" alt="user">
            <div class="caption ml-3">
                <h6 class="mb-0 line-height">{{ auth()->user()->username }}<i class="las la-angle-down ml-2"></i></h6>
            </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-right border-none" aria-labelledby="dropdownMenuButton">
            <li class="dropdown-item d-flex svg-icon">
                <svg class="svg-icon mr-0 text-primary" id="h-01-p" width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <a href="{{ route('profile') }}">My Profile</a>
            </li>
            <li class="dropdown-item  d-flex svg-icon border-top" id="logout">
                <svg class="svg-icon mr-0 text-primary" id="h-05-p" width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <a href="" >Logout</a>
            </li>
        </ul>
    </li>
</ul>
@endif
@if (auth()->user()->role == 'siswa')
<ul class="navbar-nav ml-auto navbar-list align-items-center">
    <li class="nav-item nav-icon dropdown caption-content">
        <a href="#" class="search-toggle dropdown-toggle  d-flex align-items-center" id="dropdownMenuButton4"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img src="{{ asset('/assets/images/user/1.jpg') }}" class="img-fluid rounded-circle" alt="user">
        <div class="caption ml-3">
            <h6 class="mb-0 line-height">{{ $DataDiri->full_name }}<i class="las la-angle-down ml-2"></i></h6>
        </div>
    </a>
    <ul class="dropdown-menu dropdown-menu-right border-none" aria-labelledby="dropdownMenuButton">
        <li class="dropdown-item d-flex svg-icon">
            <svg class="svg-icon mr-0 text-primary" id="h-01-p" width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <a href="{{ route('profile') }}">My Profile</a>
        </li>
        <li class="dropdown-item  d-flex svg-icon border-top" id="logout">
            <svg class="svg-icon mr-0 text-primary" id="h-05-p" width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            <a href="" >Logout</a>
        </li>
    </ul>
</li>
</ul>
@endif
@if (auth()->user()->role == 'guru')
<ul class="navbar-nav ml-auto navbar-list align-items-center">
    <li class="nav-item nav-icon dropdown caption-content">
        <a href="#" class="search-toggle dropdown-toggle  d-flex align-items-center" id="dropdownMenuButton4"
        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <img src="{{ asset('/assets/images/user/1.jpg') }}" class="img-fluid rounded-circle" alt="user">
        <div class="caption ml-3">
            <h6 class="mb-0 line-height">{{ $DataDiri->full_name }}<i class="las la-angle-down ml-2"></i></h6>
        </div>
    </a>
    <ul class="dropdown-menu dropdown-menu-right border-none" aria-labelledby="dropdownMenuButton">
        <li class="dropdown-item d-flex svg-icon">
            <svg class="svg-icon mr-0 text-primary" id="h-01-p" width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <a href="{{ route('profile') }}">My Profile</a>
        </li>
        <li class="dropdown-item  d-flex svg-icon border-top" id="logout">
            <svg class="svg-icon mr-0 text-primary" id="h-05-p" width="20" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
            </svg>
            <a href="" >Logout</a>
        </li>
    </ul>
</li>
</ul>
@endif
</div>
</div>
