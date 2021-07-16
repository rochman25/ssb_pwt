@extends('layouts.app')
@section('title', 'Sample Page')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Role</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">System</li>
    <li class="breadcrumb-item active">Role</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Data Role</h5>
                        <span>berikut list data role.</span>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Terakhir diupdate</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($roles as $index => $item)
                                        <tr>
                                            <th scope="row">{{ ++$index }}</th>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y H:i:s') }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
