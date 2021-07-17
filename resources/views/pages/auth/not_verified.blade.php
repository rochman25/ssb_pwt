@extends('layouts.app_empty')
@section('title', 'Unlock')

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
            <!-- Unlock page start-->
            <div class="authentication-main mt-0">
                <div class="row">
                    <div class="col-12">
                        <div class="login-card">
                            <div>
                                <div><a class="logo" href="{{ route('login') }}"><img class="img-fluid for-light"
                                            src="{{ asset('assets/images/logo/logo_dark.png') }}" alt="looginpage"><img
                                            class="img-fluid for-dark" src="{{ asset('assets/images/logo/logo_dark.png') }}"
                                            alt="looginpage"></a></div>
                                <div class="login-main">
                                    <form class="theme-form">
                                        <h4 class="text-center">Akun Anda Belum Terverifikasi. </h4>
                                        <div class="form-group">
                                            <p class="col-form-label">Mohon cek email anda untuk verifikasi akun anda</p>
                                        </div>
                                        <div class="form-group mb-0 text-center">
                                            <a class="btn btn-primary" href="{{ route('login') }}">Kembali</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Unlock page end-->
        </div>
    </div>
@endsection

@section('script')
@endsection
