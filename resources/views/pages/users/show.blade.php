@extends('layouts.app')
@section('title', 'Edit Profile')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Akun Admin</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Detail Akun</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="edit-profile">
            @component('components.alert-success')
            @endcomponent
            <div class="row">
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Akun Anda</h4>
                            <div class="card-options"><a class="card-options-collapse" href="#"
                                    data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                                    class="card-options-remove" href="#" data-toggle="card-remove"><i
                                        class="fe fe-x"></i></a></div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('users.update', $user->id) }}" method="POST">
                                @csrf
                                @method("PUT")
                                <input type="hidden" name="type" value="{{ "account" }}">
                                <div class="row mb-2">
                                    <div class="col-auto"><img class="img-70 rounded-circle" alt=""
                                            src="{{ asset('assets/images/dashboard/profile.jpg') }}"></div>
                                    <div class="col">
                                        <h3 class="mb-1">{{ $user->name }}</h3>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Username</label>
                                    <input class="form-control @error('username') is-invalid @enderror" type="text"
                                        name="username" value="{{ $user->username }}" placeholder="">
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Nama</label>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text"
                                        name="name" value="{{ $user->name }}" placeholder="">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Email-Address</label>
                                    <input class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ $user->email }}" placeholder="your-email@domain.com">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Password</label>
                                    <input class="form-control @error('password') is-invalid @enderror" name="password"
                                        value="" placeholder="******" type="password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Konfirmasi Password</label>
                                    <input class="form-control @error('password') is-invalid @enderror" name="password_confirmation"
                                        value="" placeholder="*****" type="password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-footer">
                                    <button class="btn btn-primary btn-block" type="submit">Simpan</button>
                                </div>
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
