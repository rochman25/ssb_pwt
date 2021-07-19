<div class="sidebar-wrapper">
    <div class="logo-wrapper">
        <a href="{{ route('index') }}"><img class="img-fluid for-light"
                src="{{ asset('assets/images/logo/logo.png') }}" alt=""><img class="img-fluid for-dark"
                src="../assets/images/logo/logo_dark.png" alt=""></a>
        <div class="back-btn"><i class="fa fa-angle-left"></i></div>
        <div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
    </div>
    <div class="logo-icon-wrapper"><a href="{{ route('index') }}"><img class="img-fluid"
                src="{{ asset('assets/images/logo/logo-icon.png') }}" alt=""></a></div>
    <nav class="sidebar-main">
        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
        <div id="sidebar-menu">
            <ul class="sidebar-links custom-scrollbar">
                <li class="back-btn">
                    <a href="{{ route('home.index') }}"><img class="img-fluid"
                            src="{{ asset('assets/images/logo/logo-icon.png') }}" alt=""></a>
                    <div class="mobile-back text-right"><span>Back</span><i class="fa fa-angle-right pl-2"
                            aria-hidden="true"></i></div>
                </li>
                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title {{ Route::currentRouteName() == 'home.index' ? 'active' : '' }}"
                        style="cursor: pointer;" href="{{ route('home.index') }}">
                        <i data-feather="home"></i>
                        <span class="lan-3"> Dashboard </span>
                    </a>
                </li>
                
                @hasrole('siswa')
                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title {{ Route::currentRouteName() == 'students.show' ? 'active' : '' }}"
                        style="cursor: pointer;" href="{{ route('students.show',Auth::user()->student->id) }}">
                        <i data-feather="user"></i>
                        <span class="lan-3"> Biodata Siswa </span>
                    </a>
                </li>
                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title {{ Route::currentRouteName() == 'schedules.show' ? 'active' : '' }}"
                        style="cursor: pointer;" href="{{ route('schedules.show',Auth::user()->student->id) }}">
                        <i data-feather="calendar"></i>
                        <span class="lan-3"> Jadwal </span>
                    </a>
                </li>
                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title {{ Route::currentRouteName() == 'student_payments.show' ? 'active' : '' }}"
                        style="cursor: pointer;" href="{{ route('student_payments.show',Auth::user()->id) }}">
                        <i data-feather="credit-card"></i>
                        <span class="lan-3"> Kartu SPP </span>
                    </a>
                </li>
                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title {{ Route::currentRouteName() == 'student_payments.create' ? 'active' : '' }}"
                        style="cursor: pointer;" href="{{ route('student_payments.create') }}">
                        <i data-feather="dollar-sign"></i>
                        <span class="lan-3"> Pembayaran SPP </span>
                    </a>
                </li>
                @endhasrole

                @hasrole('instructor')
                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title {{ Route::currentRouteName() == 'instructors.show' ? 'active' : '' }}"
                        style="cursor: pointer;" href="{{ route('instructors.show',Auth::user()->instructor->id) }}">
                        <i data-feather="user"></i>
                        <span class="lan-3"> Biodata Pelatih </span>
                    </a>
                </li>
                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title {{ Route::currentRouteName() == 'schedules.index' ? 'active' : '' }}"
                        style="cursor: pointer;" href="{{ route('schedules.index') }}">
                        <i data-feather="calendar"></i>
                        <span class="lan-3"> Jadwal </span>
                    </a>
                </li>
                @endhasrole

                @hasrole('Admin')
                <li class="sidebar-main-title">
                    <div>
                        <h6>Master Data</h6>
                    </div>
                </li>
                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title {{ Route::currentRouteName() == 'students.index' ? 'active' : '' }}"
                        style="cursor: pointer;" href="{{ route('students.index') }}">
                        <i data-feather="users"></i>
                        <span class="lan-3"> Siswa </span>
                    </a>
                </li>
                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title {{ Route::currentRouteName() == 'instructors.index' ? 'active' : '' }}"
                        style="cursor: pointer;" href="{{ route('instructors.index') }}">
                        <i data-feather="users"></i>
                        <span class="lan-3"> Pelatih </span>
                    </a>
                </li>
                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title {{ Route::currentRouteName() == 'classes.index' ? 'active' : '' }}"
                        style="cursor: pointer;" href="{{ route('classes.index') }}">
                        <i data-feather="layers"></i>
                        <span class="lan-3"> Kelas </span>
                    </a>
                </li>
                <li class="sidebar-main-title">
                    <div>
                        <h6>Kegiatan</h6>
                    </div>
                </li>
                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title {{ Route::currentRouteName() == 'schedules.index' ? 'active' : '' }}"
                        style="cursor: pointer;" href="{{ route('schedules.index') }}">
                        <i data-feather="calendar"></i>
                        <span class="lan-3"> Jadwal </span>
                    </a>
                </li>
                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title {{ Route::currentRouteName() == 'student_payments.index' ? 'active' : '' }}"
                        style="cursor: pointer;" href="{{ route('student_payments.index') }}">
                        <i data-feather="credit-card"></i>
                        <span class="lan-3"> Pembayaran SPP </span>
                    </a>
                </li>
                <li class="sidebar-main-title">
                    <div>
                        <h6>System</h6>
                    </div>
                </li>
                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title {{ Route::currentRouteName() == 'roles.index' ? 'active' : '' }}"
                        style="cursor: pointer;" href="{{ route('roles.index') }}">
                        <i data-feather="edit"></i>
                        <span class="lan-3"> Role </span>
                    </a>
                </li>
                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title {{ Route::currentRouteName() == 'users.index' ? 'active' : '' }}"
                        style="cursor: pointer;" href="{{ route('users.index') }}">
                        <i data-feather="users"></i>
                        <span class="lan-3"> Pengguna </span>
                    </a>
                </li>
                @endhasrole
            </ul>
        </div>
        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </nav>
</div>
