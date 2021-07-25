@extends('layouts.app')
@section('title', 'Sample Page')

@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/datatables.css') }}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
    <h3>Kelas</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Master Data</li>
    <li class="breadcrumb-item active">Kelas</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Data Kelas</h5>
                        <span>berikut list data kelas.</span>
                        <a href="{{ route('classes.create') }}" class="btn btn-primary mt-3"><i class="fa fa-plus"></i>
                            Tambah</a>
                        <a href="{{ route('classes.print') }}" class="btn btn-md btn-info mt-3" style="float: right"><i
                                class="fa fa-print"></i> Cetak</a>
                    </div>
                    <div class="card-body">
                        @component('components.alert-success')
                        @endcomponent
                        <div class="table-responsive">
                            <table class="table" id="basic-1">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Kode Kelas</th>
                                        <th scope="col">Deskripsi</th>
                                        {{-- <th scope="col">Status</th> --}}
                                        <th scope="col">Pelatih</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($classes as $index => $item)
                                        <tr>
                                            <th scope="row">{{ ++$index }}</th>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->description }}</td>
                                            {{-- <td>{{ $item->is_active == "0" ? "Aktif" : "Tidak Aktif" }}</td> --}}
                                            <td>{{ $item->detail->instructor->name ?? '-' }}</td>
                                            <td>
                                                <a href="{{ route('classes.edit', $item->id) }}"
                                                    class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Edit</a>
                                                <button data-url="{{ route('classes.destroy', $item->id) }}"
                                                    class="btn-hapus btn btn-sm btn-danger"><i class="fa fa-trash"></i>
                                                    Hapus</button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Belum ada data.</td>
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
<script src="{{ asset('assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('assets/js/datatable/datatables/datatable.custom.js') }}"></script>
@endsection
