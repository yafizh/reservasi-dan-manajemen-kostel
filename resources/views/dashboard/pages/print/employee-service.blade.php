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
        <h4 class="text-center">Laporan Pelayanan Pegawai</h4>
        <strong>
            <span style="width: 150px; display: inline-block;">Filter</span>
        </strong>
        <br>
        <span style="width: 150px; display: inline-block;">Tanggal</span>
        @if (empty($filters['from']) && empty($filters['to']))
            <span>: Seluruh Pelayanan</span>
        @else
            <span>: {{ $filters['from'] }} - {{ $filters['to'] }}</span>
        @endif
    </section>
    <main>
        <table class="table table-striped table-bordered">
            <thead class="text-center">
                <th class="text-center align-middle">No</th>
                <th class="text-center align-middle">NIK</th>
                <th class="text-center align-middle">Nama</th>
                <th class="text-center align-middle">Pemesanan</th>
                <th class="text-center align-middle">Check In</th>
                <th class="text-center align-middle">Check Out</th>
            </thead>
            <tbody>
                @if ($employees->count())
                    @foreach ($employees as $employee)
                        <tr>
                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                            <td class="text-center align-middle">{{ $employee->id_number }}</td>
                            <td class="text-center align-middle">{{ $employee->name }}</td>
                            <td class="text-center align-middle">{{ $employee->serviceReservation }}</td>
                            <td class="text-center align-middle">{{ $employee->serviceCheckIn }}</td>
                            <td class="text-center align-middle">{{ $employee->serviceCheckOut }}</td>
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
