@extends('layouts.app')
@section('title', 'Sample Page')

@section('css')
@endsection

@section('style')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/select2.css')}}">
<!-- Plugins css Ends-->
@endsection

@section('breadcrumb-title')
    <h3>Kelas</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Master Data</li>
    <li class="breadcrumb-item">Kelas</li>
    <li class="breadcrumb-item active">Edit Kelas</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Edit Kelas</h5>
                        <span>berikut form data kelas.</span>
                    </div>
                    <div class="card-body">
                        @component('components.alert-danger')
                        @endcomponent
                        <form action="{{ route('classes.update',$class->id) }}" method="POST">
                            @csrf
                            @method("PUT")
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="validationServer01">Nama Kelas</label>
                                    <input class="form-control @error('name') is-invalid @enderror" name="name"
                                        id="validationServer01" type="text" value="{{ old('name',$class->name) }}" required="">
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationServer02">Aktif</label>
                                    <div class="row">
                                        <div class="col">
                                            <label class="d-block" for="edo-ani">
                                                <input class="radio_animated" id="edo-ani" type="radio" value="0" @if(old('is_active',$class->is_active) == '0') checked @endif name="is_active"
                                                    checked=""> Ya
                                            </label>
                                            <label class="d-block" for="edo-ani1">
                                                <input class="radio_animated" id="edo-ani1" type="radio" value="1" @if(old('is_active',$class->is_active) == '1') checked @endif name="is_active">
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
                                <div class="col-md-6 mb-3">
                                    <label for="validationServer02">Pelatih</label>
                                    <select name="instructor_id" class="js-example-basic-single col-sm-12">
                                        <option value="">Pilih Pelatih</option>
                                        @foreach ($instructors as $item)
                                            <option value="{{ $item->id }}" @if(old('insturctor_id',$class->detail->instructor->id)) selected @endif>{{ $item->name. "-" .$item->email }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="validationServer02">Siswa</label>
                                    <select class="js-example-basic-multiple col-sm-12" name="students[]" multiple="multiple">
                                        @foreach ($students as $item)
                                            <option value="{{ $item->id }}" @if(!empty($item->class) && $item->class->class_id == $class->id) selected @endif>{{ $item->fullname }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="validationServer03">Deskripsi</label>
                                    <textarea class="form-control form-control @error('description') is-invalid @enderror"
                                        id="validationServer03" name="description"
                                        required="">{{ old('description',$class->description) }}</textarea>
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
<script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
<script src="{{asset('assets/js/select2/select2-custom.js')}}"></script>
@endsection
