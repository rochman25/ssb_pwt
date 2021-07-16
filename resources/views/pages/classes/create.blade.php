@extends('layouts.app')
@section('title', 'Sample Page')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Kelas</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Master Data</li>
    <li class="breadcrumb-item">Kelas</li>
    <li class="breadcrumb-item active">Tambah Kelas</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Tambah Kelas</h5>
                        <span>berikut form data kelas.</span>
                    </div>
                    <div class="card-body">
                        @component('components.alert-danger')
                        @endcomponent
                        <form action="{{ route('classes.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationServer01">Nama Kelas</label>
                                    <input class="form-control @error('name') is-invalid @enderror" name="name"
                                        id="validationServer01" type="text" value="{{ old('name') }}" required="">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationServer02">Aktif</label>
                                    <div class="row">
                                        <div class="col">
                                            <label class="d-block" for="edo-ani">
                                                <input class="radio_animated" id="edo-ani" type="radio" value="0" @if(old('is_active') == '0') checked @endif name="is_active"
                                                    checked=""> Ya
                                            </label>
                                            <label class="d-block" for="edo-ani1">
                                                <input class="radio_animated" id="edo-ani1" type="radio" value="1" @if(old('is_active') == '1') checked @endif name="is_active">
                                                Tidak
                                            </label>
                                        </div>
                                    </div>
                                    @error('is_active')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationServer03">Deskripsi</label>
                                    <textarea class="form-control form-control @error('description') is-invalid @enderror"
                                        id="validationServer03" name="description"
                                        required="">{{ old('description') }}</textarea>
                                    @error('description')
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
