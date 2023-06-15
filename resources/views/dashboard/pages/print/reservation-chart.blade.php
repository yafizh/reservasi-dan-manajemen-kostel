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
        <h4 class="text-center">Laporan Grafik Pemesanan</h4>
        <strong>
            <span style="width: 150px; display: inline-block;">Filter</span>
        </strong>
        <br>
        <span style="width: 150px; display: inline-block;">Tahun</span>
        <span>: {{ $filters['year'] }}</span>
        <br>
        <span style="width: 150px; display: inline-block;">Kuarter</span>
        <span>: {{ $filters['quarter'] }}</span>
    </section>
    <main>
        {!! $chart->container() !!}
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    @if (!is_null($chart))
        {!! $chart->script() !!}
    @endif
@endsection
