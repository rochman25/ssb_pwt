@extends('layouts.app')
@section('title', 'Sample Page')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Pengguna</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">System</li>
    <li class="breadcrumb-item">Pengguna</li>
    <li class="breadcrumb-item active">Tambah Pengguna</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Tambah Pengguna</h5>
                        <span>berikut form data pengguna.</span>
                    </div>
                    <div class="card-body">
                        @component('components.alert-danger')
                        @endcomponent
                        <form action="{{ route('users.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationServer01">Nama Lengkap</label>
                                    <input class="form-control @error('username') is-invalid @enderror" name="name"
                                        id="validationServer01" type="text" value="{{ old('name') }}" required="">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationServer02">Username</label>
                                    <input class="form-control @error('username') is-invalid @enderror"
                                        id="validationServer02" type="text" value="{{ old('username') }}" name="username"
                                        required="">
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="validationServer03">Email</label>
                                    <input class="form-control form-control @error('email') is-invalid @enderror"
                                        id="validationServer03" type="email" name="email" value="{{ old('email') }}"
                                        required="">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationServer04">Role</label>
                                    <select
                                        class="custom-select form-control form-control @error('role') is-invalid @enderror"
                                        id="validationServer04" name="role" required="">
                                        <option selected="" disabled="" value="">Pilih Role Pengguna</option>
                                        @foreach ($roles as $item)
                                            <option value="{{ $item->id }}" @if (old('role') == $item->id) selected @endif>
                                                {{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('role')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationServer05">Password</label>
                                    <input class="form-control @error('role') is-invalid @enderror" name="password"
                                        id="validationServer05" type="password" required="">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationServer05">Confirm Password</label>
                                    <input class="form-control @error('role') is-invalid @enderror"
                                        name="password_confirmation" id="validationServer05" type="password" required="">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
