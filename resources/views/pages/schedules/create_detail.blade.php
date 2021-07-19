@extends('layouts.app')
@section('title', 'Sample Page')

@section('css')
@endsection

@section('style')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/select2.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Kegiatan</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Jadwal</li>
    <li class="breadcrumb-item active">Tambah Kegiatan</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Tambah Kegiatan</h5>
                        <span>berikut form data kegiatan.</span>
                    </div>
                    <div class="card-body">
                        @component('components.alert-danger')
                        @endcomponent
                        <form action="{{ route('schedules.detail.store', $schedule->id) }}" method="POST">
                            @csrf
                            @foreach ($days as $index => $item)
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="validationServer02">Hari</label>
                                        <div class="col">
                                            <div class="form-group m-t-15 m-checkbox-inline mb-0">
                                                <div class="checkbox checkbox-dark">
                                                    <input id="inline-{{ $index }}" name="days[]"
                                                        value="{{ $item }}" type="checkbox">
                                                    <label for="inline-{{ $index }}">{{ $item }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="validationServer02">Aktifitas</label>
                                        <textarea class="form-control @error('activity') is-invalid @enderror"
                                            name="activity[]"></textarea>
                                    </div>
                                </div>
                            @endforeach

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
