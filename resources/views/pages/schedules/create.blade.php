@extends('layouts.app')
@section('title', 'Sample Page')

@section('css')
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/select2.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Jadwal Latihan</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Master Data</li>
    <li class="breadcrumb-item">Jadwal</li>
    <li class="breadcrumb-item active">Tambah Jadwal</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Tambah Jadwal</h5>
                        <span>berikut form data jadwal.</span>
                    </div>
                    <div class="card-body">
                        @component('components.alert-danger')
                        @endcomponent
                        <form action="{{ route('schedules.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationServer02">Kelas</label>
                                    <select name="class_instructor_id" class="js-example-basic-single col-sm-12">
                                        <option value="">Pilih Kelas</option>
                                        @foreach ($classes as $item)
                                            <option value="{{ $item->id }}" @if (old('class_instructor_id') == $item->id) selected @endif>{{ $item->class->name . '-' . $item->instructor->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationServer02">Bulan</label>
                                    <input type="month"
                                        class="custom-select form-control form-control @error('month') is-invalid @enderror"
                                        id="validationServer04" name="month" value="{{ old('month') }}" required="">
                                    @error('month')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="validationServer02">Jumlah Minggu</label>
                                    <input type="number"
                                        class="custom-select form-control form-control @error('week') is-invalid @enderror"
                                        id="validationServer04" name="week" value="{{ old('week') }}" required="">
                                    @error('week')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationServer02">Estimasi Waktu per minggu (menit)</label>
                                    <input type="number"
                                        class="custom-select form-control form-control @error('estimate_time') is-invalid @enderror"
                                        id="validationServer04" name="estimate_time" value="{{ old('estimate_time') }}" required="">
                                    @error('estimate_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationServer02">Hari</label>
                                    <div class="col">
                                        <div class="form-group m-t-15 m-checkbox-inline mb-0">
                                            @foreach ($days as $index => $item)
                                                <div class="checkbox checkbox-dark">
                                                    <input id="inline-{{ $index }}" name="days[]" value="{{ $item }}" type="checkbox">
                                                    <label for="inline-{{ $index }}">{{ $item }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
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
