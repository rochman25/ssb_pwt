@extends('layouts.app')
@section('title', 'Sample Page')

@section('css')
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/select2.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Pembayaran SPP</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Pembayaran SPP</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Pembayaran SPP</h5>
                        <span>berikut form data pembayaran spp siswa.</span>
                    </div>
                    <div class="card-body">
                        @component('components.alert-danger')
                        @endcomponent
                        <form action="{{ route('student_payments.store.student',Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationServer02">Bulan</label>
                                    <input type="month"
                                        class="custom-select form-control form-control @error('month') is-invalid @enderror"
                                        id="validationServer04" name="month" value="{{ old('month') }}" required="">
                                    @error('month')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
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
                                <div class="col-md-6 mb-3">
                                    <label for="validationServer02">Total Bayar</label>
                                    <input type="number"
                                        class="custom-select form-control form-control @error('amount') is-invalid @enderror"
                                        id="validationServer04" name="amount" value="{{ old('amount') }}" placeholder="" required="">
                                    @error('amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationServer03">Bukti Pembayaran</label>
                                    <input type="file" class="form-control" name="payment_proof">
                                    @error('payment_proof')
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
    <script src="{{ asset('assets/js/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('assets/js/select2/select2-custom.js') }}"></script>
@endsection
