@extends('dashboard.layouts.main')

@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tipe Kamar</h1>
                </div>
            </div>
        </div>
    </section>

    @if (request()->segment(2) === 'rooms')
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="td-fit text-center">No</th>
                                            <th class="text-center">Tipe Kamar</th>
                                            <th class="text-center">Jumlah Kamar</th>
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
    @else
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body" data-route="room-types">
                                <table id="example2" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="td-fit text-center">No</th>
                                            <th class="text-center">Tipe Kamar</th>
                                            <th class="text-center">Harga Bulanan</th>
                                            <th class="text-center">Harga Mingguan</th>
                                            <th class="text-center">Harga Harian (Senin - Kamis)</th>
                                            <th class="text-center">Harga Harian (Jum'at - Minggu)</th>
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
    @endif
@endsection
