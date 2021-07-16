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
            </ul>
        </div>
        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </nav>
</div>
