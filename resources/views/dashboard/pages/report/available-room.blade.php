@extends('dashboard.layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Laporan Ketersediaan Kamar</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <form action="/report/available-rooms" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="date">Tanggal</label>
                                            <input type="date" class="form-control" id="date" name="date"
                                                required value="{{ request()->get('date') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="status">Status</label>
                                            <select name="status" id="status" class="form-control" required>
                                                <option value="" selected disabled>Pilih Status</option>
                                                <option value="1"
                                                    {{ request()->get('status') == 1 ? 'selected' : '' }}>Tersedia</option>
                                                <option value="2"
                                                    {{ request()->get('status') == 2 ? 'selected' : '' }}>Dipesan</option>
                                                <option value="3"
                                                    {{ request()->get('status') == 3 ? 'selected' : '' }}>Tidak Tersedia
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <label style="visibility: hidden;">Buttons</label>
                                        <div class="">
                                            <button type="submit" class="btn btn-info">Filter</button>
                                            @php
                                                $get = '?';
                                                
                                                if (request()->get('status') && request()->get('date')) {
                                                    $get .= 'status=' . request()->get('status') . '&date=' . request()->get('date');
                                                }
                                            @endphp
                                            <a href="/print/available-rooms{{ $get }}" target="_blank" class="btn btn-success">
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
                                        <th class="text-center">Tipe Kamar</th>
                                        <th class="text-center">Nomor Kamar</th>
                                        <th class="text-center">Lantai Kamar</th>
                                        <th class="text-center">Status Kamar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rooms as $room)
                                        <tr>
                                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                                            <td class="text-center align-middle">{{ $room->roomType->name }}</td>
                                            <td class="text-center align-middle">Kamar Nomor {{ $room->number }}</td>
                                            <td class="text-center align-middle">Lantai {{ $room->number }}</td>
                                            <td class="text-center align-middle">
                                                @if ($room->status === 1)
                                                    <span class="badge badge-success">Tersedia</span>
                                                @elseif ($room->status === 2)
                                                    <span class="badge badge-warning">Dipesan</span>
                                                @elseif ($room->status === 3)
                                                    <span class="badge badge-danger">Tidak Tersedia</span>
                                                @endif
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
