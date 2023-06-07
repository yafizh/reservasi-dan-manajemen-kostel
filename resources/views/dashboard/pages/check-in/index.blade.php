@extends('dashboard.layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Check In</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body" data-route="check-ins">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="td-fit text-center">No</th>
                                        <th class="text-center">Tanggal Check In</th>
                                        <th class="text-center">Nomor Kamar</th>
                                        <th class="text-center">NIK Penghuni</th>
                                        <th class="text-center">Nama Penghuni</th>
                                        <th class="td-fit text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($checkIns as $checkIn)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $checkIn->check_in_date }}</td>
                                            <td class="text-center">Kamar Nomor {{ $checkIn->room->number }}</td>
                                            <td class="text-center">{{ $checkIn->id_number }}</td>
                                            <td class="text-center">{{ $checkIn->name }}</td>
                                            <td>
                                                <div class="td-fit d-flex">
                                                    <a href="/check-ins/{{ $checkIn->id }}"
                                                        class="btn btn-info btn-sm mr-1">Lihat</a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
