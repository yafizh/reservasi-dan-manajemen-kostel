@extends('dashboard.layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 justify-content-center text-center">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Check Out</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>NIK</label>
                                <input type="text" class="form-control" disabled
                                    value="{{ $checkOut->checkIn->id_number }}" />
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" disabled value="{{ $checkOut->checkIn->name }}">
                            </div>
                            <div class="form-group">
                                <label>Nomor Telepon</label>
                                <input type="text" class="form-control" disabled
                                    value="{{ $checkOut->checkIn->id_number }}">
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="/{{ request()->segment(1) }}" class="btn btn-secondary float-left">Kembali</a>
                            <form action="/check-outs/{{ $checkOut->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger float-right ml-1">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Tanggal Check In</label>
                                <input type="text" class="form-control" disabled
                                    value="{{ $checkOut->checkIn->check_in_date }}">
                            </div>
                            <div class="form-group">
                                <label>Tanggal Check Out</label>
                                <input type="text" class="form-control" disabled value="{{ $checkOut->check_out_date }}">
                            </div>
                            <div class="form-group">
                                <label>Nomor Kamar</label>
                                <input type="text" class="form-control" disabled
                                    value="Kamar Nomor {{ $checkOut->checkIn->room->number }}">
                            </div>
                            <div class="form-group">
                                <label>Lantai</label>
                                <input type="text" class="form-control" disabled
                                    value="Lantai {{ $checkOut->checkIn->room->floor }}">
                            </div>
                            <div class="form-group">
                                <label>Jenis Penyewaan</label>
                                @if ($checkOut->checkIn->reservationType->name == 1)
                                    <input type="text" class="form-control" disabled value="Bulanan">
                                @elseif ($checkOut->checkIn->reservationType->name == 2)
                                    <input type="text" class="form-control" disabled value="Mingguan">
                                @elseif ($checkOut->checkIn->reservationType->name == 3 || $checkOut->checkIn->reservationType->name == 4)
                                    <input type="text" class="form-control" disabled value="Harian">
                                @endif
                            </div>
                            <div class="form-group">
                                <label>Biaya Sewa</label>
                                <input type="text" class="form-control" disabled
                                    value="{{ number_format($checkOut->checkIn->price(), 0, ',', '.') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
