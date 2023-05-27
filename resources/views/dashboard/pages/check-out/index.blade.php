@extends('dashboard.layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Check Out</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="example3" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="td-fit text-center">No</th>
                                        <th class="text-center">Tanggal Check In</th>
                                        <th class="text-center">Tanggal Check Out</th>
                                        <th class="text-center">NIK Penghuni</th>
                                        <th class="text-center">Nama Penghuni</th>
                                        <th class="td-fit text-center">Aksi</th>
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
