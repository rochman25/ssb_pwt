@extends('layouts.app_empty')
@section('title', 'Login-one')

@section('css')
@endsection

@section('style')
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-7"><img class="bg-img-cover bg-center"
                    src="{{ asset('assets/images/other-images/auth-bg-1.jpg') }}" alt="looginpage"></div>
            <div class="col-xl-5 p-0">
                <div class="login-card">
                    <div>
                        <div><a class="logo text-left" href="{{ route('index') }}"><img class="img-fluid for-light"
                                    src="{{ asset('assets/images/other-images/logo-login.png') }}" alt="looginpage"><img
                                    class="img-fluid for-dark" src="{{ asset('assets/images/logo/logo_dark.png') }}"
                                    alt="looginpage"></a></div>
                        @if (Session::has('error'))
                            <x-danger-alert-message :message="session()->get('error')" />
                        @endif
                        <div class="login-main">
                            <form class="theme-form" action="{{ route('login.post') }}" method="POST">
                                @csrf
                                <h4>{{ __('messages.sign_in') }}</h4>
                                <p>{{ __('messages.sign_in_message') }}</p>
                                <div class="form-group">
                                    <label class="col-form-label">Username</label>
                                    <input class="form-control @error('username') is-invalid @enderror" required=""
                                        value="{{ old('username') }}" name="username" type="text"
                                        placeholder="{{ __('messages.placeholder_username') }}">
                                    @error('username')
                                        <x-invalid-form-message :message="$message" />
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label class="col-form-label">Password</label>
                                    <input class="form-control @error('password') is-invalid @enderror" type="password"
                                        name="password" required="" placeholder="*********">
                                    <div class="show-hide"><span class="show"></span></div>
                                    @error('password')
                                        <x-invalid-form-message :message="$message" />
                                    @enderror
                                </div>
                                <div class="form-group mb-0">
                                    <div class="checkbox p-0">
                                        <input id="checkbox1" name="remember_me" type="checkbox">
                                        <label class="text-muted" for="checkbox1">Remember Me</label>
                                    </div>
                                    <button class="btn btn-primary btn-block" type="submit">Sign in</button>
                                </div>
                                {{-- <p class="mt-4 mb-0">Don't have account?<a class="ml-2" href="{{ route('sign-up') }}">Create Account</a></p> --}}
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
