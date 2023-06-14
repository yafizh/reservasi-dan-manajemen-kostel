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
        <h4 class="text-center">Laporan Pegawai</h4>
    </section>
    <main>
        <table class="table table-striped table-bordered">
            <thead class="text-center">
                <th class="text-center align-middle">No</th>
                <th class="text-center align-middle">NIK</th>
                <th class="text-center align-middle">Nama</th>
                <th class="text-center align-middle">Nomor Telepon</th>
                <th class="text-center align-middle">Tanggal Lahir</th>
                <th class="text-center align-middle">Tempat Lahir</th>
            </thead>
            <tbody>
                @if ($employees->count())
                    @foreach ($employees as $employee)
                        <tr>
                            <td class="text-center align-middle">{{ $loop->iteration }}</td>
                            <td class="text-center align-middle">{{ $employee->id_number }}</td>
                            <td class="text-center align-middle">{{ $employee->name }}</td>
                            <td class="text-center align-middle">{{ $employee->phone_number }}</td>
                            <td class="text-center align-middle">{{ $employee->birth_date }}</td>
                            <td class="text-center align-middle">{{ $employee->birth_place }}</td>
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
