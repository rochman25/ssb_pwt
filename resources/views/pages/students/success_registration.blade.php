@extends('layouts.app')
@section('title', 'Sample Page')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Dashboard Siswa</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Siswa</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 xl-100">
                <div class="card bg-primary">
                    <div class="card-body">
                        <div class="media faq-widgets">
                            <div class="media-body">
                                <h5>Selamat Pendaftaran Anda Berhasil.</h5>
                                <p>Selamat pendaftaran anda sudah berhasil terkirim, <br /> mohon tunggu sampai admin kami memproses data pendaftaran anda atau anda dapat konfirmasi melalui kontak admin kami di email berikut <br /><a style="color: white; font-weight: bold" href="mailto:ssbindonesiamudapwt@gmail.com">ssbindonesiamudapwt@gmail.com</a> <br />Terima Kasih.</p>
                            </div><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-file-text">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
