@extends('layouts.app')
@section('title', 'Sample Page')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Siswa</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Master Data</li>
    <li class="breadcrumb-item">Siswa</li>
    <li class="breadcrumb-item active">Edit Siswa</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Siswa</h5>
                        <span>berikut form data siswa.</span>
                    </div>
                    <div class="card-body">
                        @component('components.alert-danger')
                        @endcomponent
                        <form action="{{ route('students.update', $student->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method("PUT")
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationServer01">Nama Lengkap</label>
                                    <input class="form-control @error('fullname') is-invalid @enderror" name="fullname"
                                        id="validationServer01" type="text"
                                        value="{{ old('fullname', $student->fullname) }}" required="">
                                    @error('fullname')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationServer02">Jenis Kelamin</label>
                                    <div class="row">
                                        <div class="col">
                                            <label class="d-block" for="edo-ani">
                                                <input class="radio_animated" id="edo-ani" type="radio" value="L" @if (old('gender', $student->gender) == 'L') checked @endif name="gender" checked=""> Laki -
                                                Laki
                                            </label>
                                            <label class="d-block" for="edo-ani1">
                                                <input class="radio_animated" id="edo-ani1" type="radio" value="P" @if (old('gender', $student->gender) == 'P') checked @endif name="gender">
                                                Perempuan
                                            </label>
                                        </div>
                                    </div>
                                    @error('gender')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationServer01">Tanggal Lahir</label>
                                    <input class="form-control @error('dob') is-invalid @enderror" name="dob"
                                        id="validationServer01" type="date" value="{{ old('dob', $student->dob) }}"
                                        required="">
                                    @error('dob')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationServer02">Tempat Lahir</label>
                                    <input class="form-control @error('pob') is-invalid @enderror" id="validationServer02"
                                        type="text" value="{{ old('pob', $student->pob) }}" name="pob" required="">
                                    @error('pob')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationServer03">Email</label>
                                    <input class="form-control form-control @error('email') is-invalid @enderror"
                                        id="validationServer03" type="email" name="email"
                                        value="{{ old('email', $student->email) }}" required="">
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationServer04">Nomor Telphone</label>
                                    <input type="number"
                                        class="form-control form-control @error('phone_number') is-invalid @enderror"
                                        id="validationServer04" name="phone_number"
                                        value="{{ old('phone_number', $student->phone_number) }}" required="">
                                    @error('phone_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationServer03">Alamat</label>
                                    <textarea class="form-control form-control @error('address') is-invalid @enderror"
                                        id="validationServer03" name="address"
                                        required="">{{ old('address', $student->address) }}</textarea>
                                    @error('address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationServer03">Nama Orang Tua / Wali</label>
                                    <input class="form-control form-control @error('parent_name') is-invalid @enderror"
                                        id="validationServer03" type="text" name="parent_name"
                                        value="{{ old('parent_name', $student->parent_name) }}" required="">
                                    @error('parent_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationServer04">Nomor Telphone Orang Tua / Wali </label>
                                    <input type="number"
                                        class="custom-select form-control form-control @error('parent_phone_number') is-invalid @enderror"
                                        id="validationServer04" name="parent_phone_number"
                                        value="{{ old('parent_phone_number', $student->parent_phone_number) }}"
                                        required="">
                                    @error('parent_phone_number')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationServer03">Alamat Orang Tua / Wali</label>
                                    <textarea
                                        class="form-control form-control @error('parent_address') is-invalid @enderror"
                                        id="validationServer03" name="parent_address"
                                        required="">{{ old('parent_address', $student->parent_address) }}</textarea>
                                    @error('parent_address')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationServer03">Photo Profil</label>
                                    <input type="file" class="form-control" name="photo_profil">
                                    @error('photo_profil')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <img src="{{ asset($student->photo_profil) }}" height="100px">
                                </div>
                            </div>
                            <hr class="mt-4 mb-4">
                            <h6 class="pb-2">Akun Siswa</h6>
                            <hr class="mb-2">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationServer02">Username</label>
                                    <input class="form-control @error('username') is-invalid @enderror"
                                        id="validationServer02" type="text"
                                        value="{{ old('username', $student->user->username) }}" name="username" required="">
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationServer05">Password</label>
                                    <input class="form-control @error('password') is-invalid @enderror" name="password"
                                        id="validationServer05" type="password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationServer05">Confirm Password</label>
                                    <input class="form-control @error('password') is-invalid @enderror"
                                        name="password_confirmation" id="validationServer05" type="password">
                                    @error('password')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <hr class="mt-4 mb-4">
                            <h6 class="pb-2">Pendaftaran Siswa</h6>
                            <hr class="mb-2">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationServer01">Tanggal Daftar</label>
                                    <input class="form-control @error('register_date') is-invalid @enderror" name="register_date"
                                        id="validationServer01" type="date" value="{{ old('register_date', $student->register_date) }}"
                                        required="">
                                    @error('register_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationServer01">Status</label>
                                    <select name="status" class="form-control @error('status') is-invalid @enderror">
                                        <option value="">Pilih Status</option>
                                        @foreach ($status as $index => $item)
                                            <option value="{{ $index }}" @if($index == old('status',$student->status)) selected @endif>{{ $item }}</option>
                                        @endforeach
                                    </select>
                                    @error('status')
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
