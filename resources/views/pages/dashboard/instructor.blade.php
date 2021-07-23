@extends('layouts.app')
@section('title', 'Sample Page')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Dashboard Pelatih</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Dashboard</li>
    <li class="breadcrumb-item active">Pelatih</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-12 xl-100">
                <div class="card bg-primary">
                    <div class="card-body">
                        <div class="media faq-widgets">
                            <div class="media-body">
                                <h5>Selamat Datang</h5>
                                <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget
                                    dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes,
                                    nascetur ridiculus mus.</p>
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
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Jadwal Latihan</h5>
                        <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
                    </div>
                    <div class="card-body">
                        @foreach ($jadwal as $index => $item)
                            <div class="bg-gray-100 dcd-rounded-4 p-3 mb-3 ">
                                <table class="table-borderless table-responsive--collapse w-100">
                                    <tbody>
                                        <tr>
                                            <td class="align-middle action">
                                                <span class="" style="font-weight: 600">
                                                    Sedang dipelajari
                                                </span>
                                                <br>
                                                <p class="mb-0 mt-1 text-ellipsis-two-row">Belajar Fundamental Aplikasi
                                                    Back-End
                                                </p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
