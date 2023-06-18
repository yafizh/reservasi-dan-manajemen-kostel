@extends('dashboard.layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Laporan Check Out</h1>
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
                            <form action="/report/check-outs" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="from">Dari Tanggal Check Out</label>
                                            <input type="date" class="form-control" id="from" name="from"
                                                required value="{{ request()->get("from") }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="to">Sampai Tanggal Check Out</label>
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
                                            <a href="/print/check-outs{{ $get }}" target="_blank" class="btn btn-primary">
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
                                        <th class="text-center">Tanggal Check Out</th>
                                        <th class="text-center">Nomor Kamar</th>
                                        <th class="text-center">NIK Penghuni</th>
                                        <th class="text-center">Nama Penghuni</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($checkOuts as $checkOut)
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $checkOut->check_out_date }}</td>
                                            <td class="text-center">Kamar Nomor {{ $checkOut->checkIn->room->number }}</td>
                                            <td class="text-center">{{ $checkOut->checkIn->id_number }}</td>
                                            <td class="text-center">{{ $checkOut->checkIn->name }}</td>
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
