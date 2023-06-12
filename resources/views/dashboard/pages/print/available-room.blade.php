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
        <h4 class="text-center">Laporan Ketersediaan Kamar</h4>
        <strong>
            <span style="width: 150px; display: inline-block;">Filter</span>
        </strong>
        <br>
        <span style="width: 150px; display: inline-block;">Tanggal</span>
        @if (empty($filters['date']))
            <span>: Seluruh Tanggal</span>
        @else
            <span>: {{ $filters['date'] }}</span>
        @endif
        <br>
        <span style="width: 150px; display: inline-block;">Status</span>
        @if (empty($filters['status']))
            <span>: Seluruh Status</span>
        @else
            <span>: {{ $filters['status'] }}</span>
        @endif
    </section>
    <main>
        <table class="table table-striped table-bordered">
            <thead class="text-center">
                <th class="text-center align-middle">No</th>
                <th class="text-center align-middle">Tipe Kamar</th>
                <th class="text-center align-middle">Nomor Kamar</th>
                <th class="text-center align-middle">Lantai Kamar</th>
                <th class="text-center align-middle">Status Kamar</th>
            </thead>
            <tbody>
                @if ($rooms->count())
                    @foreach ($rooms as $room)
                        <tr>
                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                            <td class="text-center align-middle">{{ $room->roomType->name }}</td>
                            <td class="text-center align-middle">Kamar Nomor {{ $room->number }}</td>
                            <td class="text-center align-middle">Lantai {{ $room->number }}</td>
                            <td class="text-center align-middle">
                                @if ($room->status === 1)
                                    Tersedia
                                @elseif ($room->status === 2)
                                    Dipesan
                                @elseif ($room->status === 3)
                                    Tidak Tersedia
                                @endif
                            </td>
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
