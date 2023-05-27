@extends('dashboard.layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pegawai</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body" data-route="employees">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="td-fit text-center">No</th>
                                        <th class="text-center">NIK</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Nomor Telepon</th>
                                        <th class="text-center">Jenis Kelamin</th>
                                        <th class="text-center">Tanggal Lahir</th>
                                        <th class="text-center">Tempat Lahir</th>
                                        <th class="td-fit">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
