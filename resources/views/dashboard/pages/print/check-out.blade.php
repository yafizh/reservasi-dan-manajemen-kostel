@extends('dashboard.pages.print.layouts.main')

@section('content')
    <style>
        @media print {
            @page {
                size: landscape
            }
        }
    </style>
    <section class="my-3">
        <h4 class="text-center">Laporan Check Out</h4>
        <strong>
            <span style="width: 150px; display: inline-block;">Filter</span>
        </strong>
        <br>
        <span style="width: 150px; display: inline-block;">Tanggal Check Out</span>
        @if (empty($filters['from']) && empty($filters['to']))
            <span>: Seluruh Check Out</span>
        @else
            <span>: {{ $filters['from'] }} - {{ $filters['to'] }}</span>
        @endif
    </section>
    <main>
        <table class="table table-striped table-bordered">
            <thead class="text-center">
                <th class="text-center align-middle">No</th>
                <th class="text-center align-middle">Tanggal Check Out</th>
                <th class="text-center align-middle">Nomor Kamar</th>
                <th class="text-center align-middle">NIK Penghuni</th>
                <th class="text-center align-middle">Nama Penghuni</th>
            </thead>
            <tbody>
                @if ($checkOuts->count())
                    @foreach ($checkOuts as $checkOut)
                        <tr>
                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                            <td class="text-center align-middle">{{ $checkOut->check_out_date }}</td>
                            <td class="text-center align-middle">Kamar Nomor {{ $checkOut->checkIn->room->number }}</td>
                            <td class="text-center align-middle">{{ $checkOut->checkIn->id_number }}</td>
                            <td class="text-center align-middle">{{ $checkOut->checkIn->name }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="5" class="text-center">Data Kosong</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </main>
@endsection
