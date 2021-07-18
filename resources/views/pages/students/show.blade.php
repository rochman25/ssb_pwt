@extends('layouts.app')
@section('title', 'Edit Profile')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Biodata Siswa</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item active">Biodata Siswa</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="edit-profile">
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
                            <form>
                                <div class="row mb-2">
                                    <div class="col-auto"><img class="img-70 rounded-circle" alt=""
                                            src="{{ asset($student->photo_profil) }}"></div>
                                    <div class="col">
                                        <h3 class="mb-1">{{ $student->fullname }}</h3>
                                        <p class="mb-4">{{ $student->class->class->name ?? '-' }}</p>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Username</label>
                                    <input class="form-control" type="text" name="username"
                                        value="{{ $student->user->username }}" placeholder="">
                                </div>
                                <div class="form-group mb-3">
                                    <label class="form-label">Email-Address</label>
                                    <input class="form-control" name="email" value="{{ $student->user->email }}"
                                        placeholder="your-email@domain.com">
                                </div>
                                <div class="form-footer">
                                    <button class="btn btn-primary btn-block">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <form class="card" action="{{ route('students.update', $student->id) }}" method="POST"
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
                                    <h6 class="pb-2">Pendaftaran Siswa</h6>
                                    <hr class="mb-2">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validationServer01">Tanggal Daftar</label>
                                            <input class="form-control @error('register_date') is-invalid @enderror"
                                                name="register_date" id="validationServer01" type="date"
                                                value="{{ old('register_date', $student->register_date) }}" required="">
                                            @error('register_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="validationServer01">Status</label>
                                            <h6>
                                                @if ($student->status == 'acc')
                                                    {{ 'Diterima' }}
                                                @elseif($student->status == "fail")
                                                    {{ 'Ditolak' }}
                                                @else
                                                    {{ 'Sedang diproses' }}
                                                @endif
                                            </h6>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validationServer01">Nama Lengkap</label>
                                            <input class="form-control @error('fullname') is-invalid @enderror"
                                                name="fullname" id="validationServer01" type="text"
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
                                                        <input class="radio_animated" id="edo-ani" type="radio" value="L"
                                                            @if (old('gender', $student->gender) == 'L') checked @endif name="gender" checked="">
                                                        Laki -
                                                        Laki
                                                    </label>
                                                    <label class="d-block" for="edo-ani1">
                                                        <input class="radio_animated" id="edo-ani1" type="radio" value="P"
                                                            @if (old('gender', $student->gender) == 'P') checked @endif name="gender">
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
                                                value="{{ old('dob', $student->dob) }}" required="">
                                            @error('dob')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="validationServer02">Tempat Lahir</label>
                                            <input class="form-control @error('pob') is-invalid @enderror"
                                                id="validationServer02" type="text"
                                                value="{{ old('pob', $student->pob) }}" name="pob" required="">
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
                                                value="{{ old('phone_number', $student->phone_number) }}" required="">
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
                                                required="">{{ old('address', $student->address) }}</textarea>
                                            @error('address')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label for="validationServer03">Nama Orang Tua / Wali</label>
                                            <input
                                                class="form-control form-control @error('parent_name') is-invalid @enderror"
                                                id="validationServer03" type="text" name="parent_name"
                                                value="{{ old('parent_name', $student->parent_name) }}" required="">
                                            @error('parent_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label for="validationServer04">Nomor Telphone Orang Tua / Wali
                                            </label>
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
