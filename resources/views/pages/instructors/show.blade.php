@extends('layouts.app')
@section('title', 'Edit Profile')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Biodata Pelatih</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Biodata Pelatih</li>
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
                            <form action="{{ route('users.update', Auth::user()->id) }}" method="POST">
                                @csrf
                                @method("PUT")
                                <input type="hidden" name="name" value="{{ $instructor->name }}">
                                <div class="row mb-2">
                                    <div class="col-auto"><img class="img-70 rounded-circle" alt=""
                                            src="{{ asset('assets/images/user/2.jpg') }}"></div>
                                    <div class="col">
                                        <h3 class="mb-1">{{ $instructor->name }}</h3>
                                        <p class="mb-4">{{ $instructor->class->class->name ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Username</label>
                                    <input class="form-control @error('username') is-invalid @enderror" type="text" name="username"
                                        value="{{ $instructor->user->username }}" placeholder="">
                                    @error('username')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Email-Address</label>
                                    <input class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $instructor->user->email }}"
                                        placeholder="your-email@domain.com">
                                    @error('email')
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
                <div class="col-lg-8">
                    <form class="card" action="{{ route('instructors.update', $instructor->id) }}" method="POST"
                        enctype="multipart/form-data">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Biodata Anda</h4>
                            <div class="card-options"><a class="card-options-collapse" href="#"
                                    data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a
                                    class="card-options-remove" href="#" data-toggle="card-remove"><i
                                        class="fe fe-x"></i></a></div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    @component('components.alert-danger')
                                    @endcomponent
                                    @csrf
                                    @method("PUT")
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validationServer01">Nama Lengkap</label>
                                            <input class="form-control @error('name') is-invalid @enderror"
                                                name="name" id="validationServer01" type="text"
                                                value="{{ old('name', $instructor->name) }}" required="">
                                            @error('name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="validationServer02">Jenis Kelamin</label>
                                            <div class="row">
                                                <div class="col">
                                                    <label class="d-block" for="edo-ani">
                                                        <input class="radio_animated" id="edo-ani" type="radio" value="L"
                                                            @if (old('gender', $instructor->gender) == 'L') checked @endif name="gender" checked="">
                                                        Laki -
                                                        Laki
                                                    </label>
                                                    <label class="d-block" for="edo-ani1">
                                                        <input class="radio_animated" id="edo-ani1" type="radio" value="P"
                                                            @if (old('gender', $instructor->gender) == 'P') checked @endif name="gender">
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
                                                id="validationServer01" type="date"
                                                value="{{ old('dob', $instructor->dob) }}" required="">
                                            @error('dob')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="validationServer02">Tempat Lahir</label>
                                            <input class="form-control @error('pob') is-invalid @enderror"
                                                id="validationServer02" type="text"
                                                value="{{ old('pob', $instructor->pob) }}" name="pob" required="">
                                            @error('pob')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validationServer04">Nomor Telphone</label>
                                            <input type="number"
                                                class="form-control form-control @error('phone_number') is-invalid @enderror"
                                                id="validationServer04" name="phone_number"
                                                value="{{ old('phone_number', $instructor->phone_number) }}" required="">
                                            @error('phone_number')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12 mb-3">
                                            <label for="validationServer03">Alamat</label>
                                            <textarea
                                                class="form-control form-control @error('address') is-invalid @enderror"
                                                id="validationServer03" name="address"
                                                required="">{{ old('address', $instructor->address) }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <button class="btn btn-primary" type="submit">Update Biodata</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
