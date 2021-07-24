@extends('layouts.app')
@section('title', 'Creative Card')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Kartu SPP</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item active">Kartu SPP</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12 col-xl-12">
			<div class="card">
				<div class="card-header b-t-success">
					<h5>Kartu SPP</h5>
                    <p>berikut list data pembayaran spp anda.</p>
				</div>
				<div class="card-body">
                    <a href="{{ route('student_payments.print',Auth::user()->student->id) }}" class="btn btn-sm btn-info" style="float: right; margin-bottom:10px"><i class="fa fa-print"></i> Cetak</a>
					<div class="table-responsive">
                        <table class="table">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Bulan</th>
                                    <th scope="col">Tanggal Pembayaran</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Nominal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($payments as $index => $item)
                                    <tr>
                                        <th scope="row">{{ ++$index }}</th>
                                        <td>{{ \Carbon\Carbon::parse($item->month)->format("M-Y") }}</td>
                                        <td>{{ \Carbon\Carbon::parse($item->payment_date)->format('d-m-Y') }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td>{{ "Rp ".number_format($item->amount,0,".",".") }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Belum ada data.</td>
                                    </tr>
                                @endforelse
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

