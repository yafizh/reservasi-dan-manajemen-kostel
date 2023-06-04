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
                                        @foreach ($roomTypes as $roomType)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $roomType->name }}</td>
                                                <td class="text-center">{{ $roomType->rooms->count() }}</td>
                                                <td>
                                                    <a href="/room-types/{{ $roomType->id }}/rooms" class="btn btn-info btn-sm">Lihat</a>
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
    @else
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
                                        @foreach ($roomTypes as $roomType)
                                            <tr>
                                                <td class="text-center">{{ $loop->iteration }}</td>
                                                <td class="text-center">{{ $roomType->name }}</td>
                                                <td class="text-center">{{ $roomType->prices[0]->price }}</td>
                                                <td class="text-center">{{ $roomType->prices[1]->price }}</td>
                                                <td class="text-center">{{ $roomType->prices[2]->price }}</td>
                                                <td class="text-center">{{ $roomType->prices[3]->price }}</td>
                                                <td>
                                                    <div class="td-fit d-flex">
                                                        <a href="/room-types/{{ $roomType->id }}/edit"
                                                            class="btn btn-warning btn-sm mr-1">Ubah</a>
                                                        <form action="/room-types/{{ $roomType->id }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger btn-sm ml-1">Hapus</button>
                                                        </form>
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
    @endif
@endsection
