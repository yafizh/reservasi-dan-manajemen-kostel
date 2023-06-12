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
        <h4 class="text-center">Laporan Pemesanan</h4>
        <strong>
            <span style="width: 150px; display: inline-block;">Filter</span>
        </strong>
        <br>
        <span style="width: 150px; display: inline-block;">Tanggal Pemesanan</span>
        @if (empty($filters['from']) && empty($filters['to']))
            <span>: Seluruh Pemesanan</span>
        @else
            <span>: {{ $filters['from'] }} - {{ $filters['to'] }}</span>
        @endif
    </section>
    <main>
        <table class="table table-striped table-bordered">
            <thead class="text-center">
                <th class="text-center align-middle">No</th>
                <th class="text-center align-middle">Tanggal Pemesanan</th>
                <th class="text-center align-middle">Tanggal Check In</th>
                <th class="text-center align-middle">NIK</th>
                <th class="text-center align-middle">Nama</th>
                <th class="text-center align-middle">Nomor Telepon</th>
            </thead>
            <tbody>
                @if ($reservations->count())
                    @foreach ($reservations as $reservation)
                        <tr>
                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                            <td class="text-center align-middle">{{ $reservation->reservation_date }}</td>
                            <td class="text-center align-middle">{{ $reservation->check_in_date }}</td>
                            <td class="text-center align-middle">{{ $reservation->id_number }}</td>
                            <td class="text-center align-middle">{{ $reservation->name }}</td>
                            <td class="text-center align-middle">{{ $reservation->phone_number }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6" class="text-center">Data Kosong</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </main>
@endsection
