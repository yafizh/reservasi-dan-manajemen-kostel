@extends('dashboard.layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Laporan Pemesanan</h1>
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
                        <div class="card-header">
                            <form action="/report/reservations" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="from">Dari Tanggal Pemesanan</label>
                                            <input type="date" class="form-control" id="from" name="from"
                                                required value="{{ request()->get("from") }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="to">Sampai Tanggal Pemesanan</label>
                                            <input type="date" class="form-control" id="to" name="to"
                                                required value="{{ request()->get("to") }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label style="visibility: hidden;">Buttons</label>
                                        <div class="">
                                            <button type="submit" class="btn btn-info">Filter</button>
                                            @php
                                                $get = '?';
                                                
                                                if (request()->get('from') && request()->get('to')) {
                                                    $get .= 'from=' . request()->get('from') . '&to=' . request()->get('to');
                                                }
                                            @endphp
                                            <a href="/print/reservations{{ $get }}" target="_blank" class="btn btn-primary">
                                                Cetak
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="td-fit text-center">No</th>
                                        <th class="text-center">Tanggal Pemesanan</th>
                                        <th class="text-center">Tanggal Check In</th>
                                        <th class="text-center">NIK</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Nomor Telepon</th>
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
