@extends('dashboard.layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Pemesanan</h1>
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
                        <div class="card-body" data-route="reservations">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="td-fit text-center">No</th>
                                        <th class="text-center">Tanggal Pemesanan</th>
                                        <th class="text-center">Tanggal Check In</th>
                                        <th class="text-center">NIK</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Nomor Telepon</th>
                                        <th class="td-fit text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reservations as $reservation)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $reservation->reservation_date }}</td>
                                            <td class="text-center">{{ $reservation->check_in_date }}</td>
                                            <td class="text-center">{{ $reservation->id_number }}</td>
                                            <td class="text-center">{{ $reservation->name }}</td>
                                            <td class="text-center">{{ $reservation->phone_number }}</td>
                                            <td>
                                                <div class="td-fit d-flex">
                                                    <a href="/reservations/{{ $reservation->id }}"
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
