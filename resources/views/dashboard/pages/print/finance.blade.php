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
        <h4 class="text-center">Laporan Keuangan</h4>
        <strong>
            <span style="width: 150px; display: inline-block;">Filter</span>
        </strong>
        <br>
        <span style="width: 150px; display: inline-block;">Tanggal Check In</span>
        @if (empty($filters['from']) && empty($filters['to']))
            <span>: Seluruh Check In</span>
        @else
            <span>: {{ $filters['from'] }} - {{ $filters['to'] }}</span>
        @endif
    </section>
    <main>
        <table class="table table-striped table-bordered">
            <thead class="text-center">
                <th class="text-center align-middle">No</th>
                <th class="text-center align-middle">Tanggal Check In</th>
                <th class="text-center align-middle">Tipe Kamar</th>
                <th class="text-center align-middle">Tipe Pemesanan</th>
                <th class="text-center align-middle">Harga</th>
            </thead>
            <tbody>
                @if ($finances->count())
                    @foreach ($finances as $finance)
                        <tr>
                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                            <td class="text-center align-middle">{{ $finance->check_in_date }}</td>
                            <td class="text-center align-middle">{{ $finance->room->roomType->name }}</td>
                            <td class="text-center align-middle">{{ $finance->reservationType->name }}</td>
                            <td class="text-center align-middle">{{ $finance->price() }}</td>
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
