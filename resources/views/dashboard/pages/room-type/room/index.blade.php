@extends('dashboard.layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Kamar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/{{ request()->segment(1) }}/rooms">Tipe Kamar</a></li>
                        <li class="breadcrumb-item active">Kamar</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body" data-route="room-types/{{ $roomType->id }}/rooms">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="td-fit text-center">No</th>
                                        <th class="text-center">Nomor Kamar</th>
                                        <th class="text-center">Lantai</th>
                                        <th class="text-center">Status</th>
                                        <th class="td-fit text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rooms as $room)
                                        <tr>
                                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                            <td class="text-center align-middle">Kamar Nomor {{ $room->number }}</td>
                                            <td class="text-center align-middle">Lantai {{ $room->floor }}</td>
                                            <td class="text-center align-middle">
                                                @if ($room->status === 1)
                                                    <span class="badge badge-success">Tersedia</span>
                                                @elseif ($room->status === 2)
                                                    <span class="badge badge-warning">Dipesan</span>
                                                @elseif ($room->status === 3)
                                                    <span class="badge badge-danger">Tidak Tersedia</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="td-fit d-flex">
                                                    <a href="/room-types/{{ $roomType->id }}/rooms/{{ $room->id }}/edit"
                                                        class="btn btn-warning btn-sm mr-1">Ubah</a>
                                                    <form action="/room-types/{{ $roomType->id }}/rooms/{{ $room->id }}"
                                                        method="POST">
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
@endsection
