@extends('layouts.app_empty')
@section('title', 'Forget-password')

@section('css')
@endsection

@section('style')
@endsection


@section('content')
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper">
        <div class="container-fluid p-0">
            <div class="row">
                <div class="col-12">
                    <div class="login-card">
                        <div>
                            <div><a class="logo" href="{{ route('index') }}"><img class="img-fluid for-light"
                                        src="{{ asset('assets/images/other-images/logo-login.png') }}"
                                        alt="looginpage"><img class="img-fluid for-dark"
                                        src="{{ asset('assets/images/logo/logo_dark.png') }}" alt="looginpage"></a></div>
                            <div class="login-main">
                                <form class="theme-form" action="{{ route('password.email') }}" method="POST">
                                    @csrf
                                    <h4>Reset Password</h4>
                                    <div class="form-group">
                                        <label class="col-form-label">Masukkan Email Anda</label>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input class="form-control mb-1" type="email" name="email"
                                                    value="{{ old('email') }}" placeholder="test@mail.com" required>
                                            </div>
                                            @error('email')
                                                <x-invalid-form-message :message="$message" />
                                            @enderror
                                            <div class="col-12">
                                                <button class="btn btn-primary btn-block m-t-10" type="submit">Send</button>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-4 mb-0">Sudah ingat Password Anda?<a class="ml-2"
                                            href="{{ route('login') }}">Sign in</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/js/sidebar-menu.js') }}"></script>
@endsection
