@extends('layouts.app')
@section('title', 'Sample Page')

@section('css')
@endsection

@section('style')
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/vendors/sweetalert2.css') }}">
@endsection

@section('breadcrumb-title')
    <h3>Siswa</h3>
@endsection

@section('breadcrumb-items')
    <li class="breadcrumb-item">Master Data</li>
    <li class="breadcrumb-item active">Siswa</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>Data Siswa</h5>
                        <span>berikut list data siswa.</span>
                        <a href="{{ route('students.create') }}" class="btn btn-primary mt-3"><i class="fa fa-plus"></i>
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
                                        <th scope="col">Nama Lengkap</th>
                                        <th scope="col">Jenis Kelamin</th>
                                        <th scope="col">Alamat</th>
                                        <th scope="col">Terakhir diupdate</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($students as $index => $item)
                                        <tr>
                                            <th scope="row">{{ ++$index }}</th>
                                            <td>{{ $item->fullname }}</td>
                                            <td>{{ $item->gender }}</td>
                                            <td>{{ $item->address }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->updated_at)->format('d-m-Y H:i:s') }}</td>
                                            <td>
                                                <a href="{{ route('students.edit', $item->id) }}"
                                                    class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Edit</a>
                                                <button data-url="{{ route('students.destroy', $item->id) }}"
                                                    class="btn btn-sm btn-danger btn-hapus"><i class="fa fa-trash"></i>
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
                            {{ $students->links() }}
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
