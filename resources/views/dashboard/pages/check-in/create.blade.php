@extends('dashboard.layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 justify-content-center text-center">
                <div class="col-sm-6">
                    <h1 class="m-0">Check In</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <form>
                <div class="row justify-content-center">
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="id_number">NIK</label>
                                    <input type="text" class="form-control" id="id_number" name="id_number" required
                                        value="{{ old('id_number') }}">
                                </div>
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name" required
                                        value="{{ old('name') }}">
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                                        required value="{{ old('phone_number') }}">
                                </div>
                            </div>

                            <div class="card-footer">
                                <a href="/{{ request()->segment(1) }}" class="btn btn-secondary float-left">Kembali</a>
                                <button type="submit" class="btn btn-primary float-right">Tambah</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="room_id">Kamar</label>
                                    <select class="form-control" name="room_id" id="room_id" required>
                                        <option value="" disabled selected>Pilih Kamar</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="reservation_id">Jenis Pembayaran</label>
                                    <select class="form-control" name="reservation_id" id="reservation_id" required>
                                        <option value="" disabled selected>Pilih Jenis Pembayaran</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
