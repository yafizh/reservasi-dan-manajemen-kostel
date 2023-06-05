@extends('dashboard.layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 justify-content-center text-center">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Pemesanan</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger" role="alert">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Tanggal Pemesanan</label>
                                <input type="text" class="form-control" value="{{ $reservation->reservation_date }}"
                                    disabled>
                            </div>
                            <div class="form-group">
                                <label>Tanggal Check In</label>
                                <input type="text" class="form-control" value="{{ $reservation->check_in_date }}"
                                    disabled>
                            </div>
                            <div class="form-group">
                                <label>NIK</label>
                                <input type="text" class="form-control" value="{{ $reservation->id_number }}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" value="{{ $reservation->name }}" disabled>
                            </div>
                            <div class="form-group">
                                <label>Nomor Telepon</label>
                                <input type="text" class="form-control" value="{{ $reservation->phone_number }}"
                                    disabled>
                            </div>
                        </div>
                        <div class="card-footer">
                            <a href="/{{ request()->segment(1) }}" class="btn btn-secondary float-left">Kembali</a>
                            <form action="/reservations/{{ $reservation->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger float-right ml-1">Hapus</button>
                            </form>
                            <a href="/reservations/{{ $reservation->id }}/edit" class="btn btn-warning float-right mr-1">
                                Edit
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="room_id">Nomor Kamar</label>
                                <input type="text" class="form-control"
                                    value="Kamar Nomor {{ $reservation->room->number }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="room_id">Lokasi Kamar</label>
                                <input type="text" class="form-control" value="Lantai {{ $reservation->room->floor }}"
                                    disabled>
                            </div>
                            <div class="form-group">
                                <label>Uang Muka</label>
                                <input type="text" class="form-control" value="{{ $reservation->down_payment }}"
                                    disabled>
                            </div>
                            <div class="form-group">
                                <label class="d-block">Status</label>
                                @if ($reservation->status == 1)
                                    <span class="badge badge-info">Menunggu</span>
                                @elseif ($reservation->status == 2)
                                    <span class="badge badge-success">Telah Check In</span>
                                @elseif ($reservation->status == 3)
                                    <span class="badge badge-danger">Dibatalkan</span>
                                @elseif ($reservation->status == 4)
                                    <span class="badge badge-secondary">Tidak Ada Kabar</span>
                                @endif
                            </div>
                        </div>
                        @if ($reservation->status == 1)
                            <div class="card-footer d-flex justify-content-end" style="gap: .4rem;">
                                <form action="/reservations/missing-client/{{ $reservation->id }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-secondary">Tidak Ada Kabar</button>
                                </form>
                                <form action="/reservations/cancel/{{ $reservation->id }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-danger">Pembatalan</button>
                                </form>
                                <a href="/check-ins/create?reservation_id={{ $reservation->id }}" class="btn btn-success">
                                    Check In
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
