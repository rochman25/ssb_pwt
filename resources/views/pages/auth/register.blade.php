@extends('layouts.app_empty')
@section('title', 'Sign-up-one')

@section('css')
@endsection

@section('style')
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-5">
                <img class="bg-img-cover bg-center" src="{{ asset('assets/images/other-images/auth-bg-1.jpg') }}"
                    alt="looginpage">
            </div>
            <div class="col-xl-7 p-0">
                <div class="login-card">
                    <div>
                        <div><a class="logo" href="{{ route('index') }}"><img class="img-fluid for-light" width="250px"
                                    src="{{ asset('assets/images/other-images/logo-login.png') }}" alt="looginpage"><img
                                    class="img-fluid for-dark" width="250px" src="{{ asset('assets/images/logo/logo_dark.png') }}"
                                    alt="looginpage"></a></div>
                        <div class="login-main">
                            <form class="theme-form" action="{{ route('register.post') }}" method="POST">
                                @csrf
                                <h4>Buat Akun Baru.</h4>
                                <p>Lengkapi form berikut untuk membuat akun baru.</p>
                                @component('components.alert-danger')
                                @endcomponent
                                <div class="form-group">
                                    <label class="col-form-label pt-0">Nama Lengkap</label>
                                    <div class="form-row">
                                        <div class="col-6">
                                            <input class="form-control" type="text" name="first_name" required=""
                                                value="{{ old('first_name') }}" placeholder="Nama Depan">
                                        </div>
                                        @error('first_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <div class="col-6">
                                            <input class="form-control" name="last_name" type="text" required=""
                                                value="{{ old('last_name') }}" placeholder="Nama Belakang">
                                        </div>
                                        @error('last_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Username</label>
                                    <input class="form-control" name="username" type="text" required=""
                                        value="{{ old('username') }}" placeholder="test">
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Email</label>
                                    <input class="form-control" name="email" type="email" required=""
                                        value="{{ old('email') }}" placeholder="Test@gmail.com">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <input class="form-control" type="password" name="password" required=""
                                        placeholder="*********">
                                    <div class="show-hide"><span class="show"></span></div>
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Konfirmasi Password</label>
                                    <input class="form-control" type="password" name="password_confirmation" required=""
                                        placeholder="*********">
                                    <div class="show-hide"><span class="show"></span></div>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-group mb-0">
                                    <button class="btn btn-primary btn-block" type="submit">Buat Akun</button>
                                </div>
                                <p class="mt-4 mb-0">Sudah Punya Akun?<a class="ml-2" href="{{ route('login') }}">Sign
                                        in</a></p>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
