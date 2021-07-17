@extends('layouts.app')
@section('title', 'Sample Page')

@section('css')
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Pembayaran SPP Siswa</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Kegiatan</li>
    <li class="breadcrumb-item active">Pembayaran SPP</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Data Pembayaran SPP Siswa</h5>
                        <span>berikut list data pembayaran spp siswa.</span>
                        <a href="{{ route('student_payments.create') }}" class="btn btn-primary mt-3"><i class="fa fa-plus"></i>
                            Tambah</a>
                    </div>
                    <div class="card-body">
                        @component('components.alert-success')
                        @endcomponent
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Siswa</th>
                                        <th scope="col">Tanggal Pembayaran</th>
                                        <th scope="col">Deskripsi</th>
                                        <th scope="col">Jumlah</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Terakhir diupdate</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($payments as $index => $item)
                                        <tr>
                                            <th scope="row">{{ ++$index }}</th>
                                            <td>{{ $item->student->fullname }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->payment_date)->format('d-m-Y') }}</td>
                                            <td>{{ $item->description }}</td>
                                            <td>{{ $item->amount }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y H:i:s') }}</td>
                                            <td>
                                                <a href="{{ route('student_payments.edit', $item->id) }}"
                                                    class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Edit</a>
                                                <button data-url="{{ route('student_payments.destroy', $item->id) }}"
                                                    class="btn btn-sm btn-danger btn-hapus"><i class="fa fa-trash"></i>
                                                    Hapus</button>
                                            </td>
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
    <script src="{{ asset('assets/js/sweet-alert/sweetalert.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Delete a record
            $('.btn-hapus').on('click', function(e) {
                // e.preventDefault();
                swal({
                    title: '{{ 'Hapus Data' }}',
                    text: '{{ 'Apakah Anda Yakin Menghapus Data Ini?' }}',
                    icon: 'error',
                    buttons: {
                        cancel: {
                            text: 'No',
                            value: null,
                            visible: true,
                            className: 'btn btn-default',
                            closeModal: true,
                        },
                        confirm: {
                            text: 'Yes',
                            value: true,
                            visible: true,
                            className: 'btn btn-danger',
                            closeModal: true
                        }
                    }
                }).then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "DELETE",
                            url: $(this).data('url'),
                            data: {
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(data) {
                                console.log(data);
                                if (data.status) {
                                    swal("{{ 'Data Berhasil Dihapus' }}", {
                                        icon: "success",
                                    });
                                    window.location.reload();
                                } else {
                                    swal("{{ 'Data Gagal Dihapus' }}", {
                                        icon: "error",
                                    });
                                }
                            }
                        });
                    }
                });
            });
        });
    </script>
@endsection
