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
                                <form class="theme-form" action="{{ route('password.update') }}" method="POST">
                                    @csrf
                                    <h4>Reset Password</h4>
                                    <input type="hidden" name="token" value="{{ $token }}">
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
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Password</label>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input class="form-control mb-1" type="password" name="password" value=""
                                                    required>
                                            </div>
                                            @error('password')
                                                <x-invalid-form-message :message="$message" />
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Konfirmasi Password</label>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <input class="form-control mb-1" type="password"
                                                    name="password_confirmation" value="{{ old('password') }}"
                                                    placeholder="" required>
                                            </div>
                                            @error('password')
                                                <x-invalid-form-message :message="$message" />
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-12">
                                                <button class="btn btn-primary btn-block m-t-10" type="submit">Reset</button>
                                            </div>
                                        </div>
                                    </div>
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
