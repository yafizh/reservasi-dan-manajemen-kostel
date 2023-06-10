@extends('dashboard.layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Check Out</h1>
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
                </div>
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="example3" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="td-fit text-center">No</th>
                                        <th class="text-center">Tanggal Check Out</th>
                                        <th class="text-center">Nomor Kamar</th>
                                        <th class="text-center">NIK</th>
                                        <th class="text-center">Nama</th>
                                        <th class="td-fit text-center">Aksi</th>
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
                                            <td>
                                                <div class="td-fit d-flex">
                                                    <a href="/check-outs/{{ $checkOut->id }}"
                                                        class="btn btn-info btn-sm mr-1">Lihat</a>
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
