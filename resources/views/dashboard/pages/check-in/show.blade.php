@extends('dashboard.layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 justify-content-center text-center">
                <div class="col-sm-6">
                    <h1 class="m-0">Detail Check In</h1>
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
                                <label>NIK</label>
                                <input type="text" class="form-control" disabled value="{{ $checkIn->id_number }}" />
                            </div>
                            <div class="form-group">
                                <label>Nama</label>
                                <input type="text" class="form-control" disabled value="{{ $checkIn->name }}">
                            </div>
                            <div class="form-group">
                                <label>Nomor Telepon</label>
                                <input type="text" class="form-control" disabled value="{{ $checkIn->id_number }}">
                            </div>
                        </div>

                        <div class="card-footer">
                            <a href="/{{ request()->segment(1) }}" class="btn btn-secondary float-left">Kembali</a>
                            <form action="/check-ins/{{ $checkIn->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger float-right ml-1">Hapus</button>
                            </form>
                            <a href="/check-ins/{{ $checkIn->id }}/edit" class="btn btn-warning float-right mr-1">
                                Edit
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Tanggal Check In</label>
                                <input type="text" class="form-control" disabled value="{{ $checkIn->check_in_date }}">
                            </div>
                            <div class="form-group">
                                <label>Nomor Kamar</label>
                                <input type="text" class="form-control" disabled value="{{ $checkIn->room->number }}">
                            </div>
                            <div class="form-group">
                                <label>Lantai</label>
                                <input type="text" class="form-control" disabled value="{{ $checkIn->room->floor }}">
                            </div>
                            <div class="form-group">
                                <label>Jenis Penyewaan</label>
                                @if ($checkIn->reservationType->name == 1)
                                    <input type="text" class="form-control" disabled value="Bulanan">
                                @elseif ($checkIn->reservationType->name == 2)
                                    <input type="text" class="form-control" disabled value="Mingguan">
                                @elseif ($checkIn->reservationType->name == 3 || $checkIn->reservationType->name == 4)
                                    <input type="text" class="form-control" disabled value="Harian">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
