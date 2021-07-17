@extends('layouts.app')
@section('title', 'Sample Page')

@section('css')
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/select2.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Pembayaran SPP Siswa</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Master Data</li>
    <li class="breadcrumb-item">Pembayaran SPP</li>
    <li class="breadcrumb-item active">Tambah Pembayaran SPP</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Tambah Pembayaran SPP</h5>
                        <span>berikut form data pembayaran spp siswa.</span>
                    </div>
                    <div class="card-body">
                        @component('components.alert-danger')
                        @endcomponent
                        <form action="{{ route('student_payments.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationServer02">Siswa</label>
                                    <select name="student_id" class="js-example-basic-single col-sm-12">
                                        <option value="">Pilih Siswa</option>
                                        @foreach ($students as $item)
                                            <option value="{{ $item->id }}" @if (old('student_id') == $item->id) selected @endif>{{ $item->fullname }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationServer02">Tanggal Bayar</label>
                                    <input type="date"
                                        class="custom-select form-control form-control @error('payment_date') is-invalid @enderror"
                                        id="validationServer04" name="payment_date" value="{{ old('payment_date') }}" required="">
                                    @error('payment_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 mb-3">
                                    <label for="validationServer02">Total Bayar</label>
                                    <input type="number"
                                        class="custom-select form-control form-control @error('amount') is-invalid @enderror"
                                        id="validationServer04" name="amount" value="{{ old('amount') }}" required="">
                                    @error('amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationServer02">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="">Pilih Status Pembayaran</option>
                                        @foreach ($status as $item)
                                            <option value="{{ $item }}" @if (old('status') == $item) selected @endif>{{ $item }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('estimate_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationServer02">Deskripsi Pembayaran</label>
                                    <textarea
                                        class="form-control form-control @error('description') is-invalid @enderror"
                                        id="validationServer03" name="description"
                                        required="">{{ old('description') }}</textarea>
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
    <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
@endsection
