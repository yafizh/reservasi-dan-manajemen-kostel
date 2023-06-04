@extends('dashboard.layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 justify-content-center text-center">
                <div class="col-sm-6">
                    <h1 class="m-0">Ubah Kamar</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="card">
                        <form action="/room-types/{{ $roomType->id }}/rooms/{{ $room->id }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                @if ($errors->any())
                                    @foreach ($errors->all() as $error)
                                        <div class="alert alert-danger" role="alert">
                                            {{ $error }}
                                        </div>
                                    @endforeach
                                @endif
                                <div class="form-group">
                                    <label for="number">Nomor Kamar</label>
                                    <input type="number" class="form-control" id="number" name="number" required
                                        value="{{ old('number', $room->number) }}" min="1">
                                </div>
                                <div class="form-group">
                                    <label for="floor">Nomor Lantai</label>
                                    <input type="number" class="form-control" id="floor" name="floor" required
                                        value="{{ old('floor', $room->floor) }}" min="1">
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="/{{ request()->segment(1) }}/{{ request()->segment(2) }}/{{ request()->segment(3) }}"
                                    class="btn btn-secondary float-left">Kembali</a>
                                <button type="submit" class="btn btn-primary float-right">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
