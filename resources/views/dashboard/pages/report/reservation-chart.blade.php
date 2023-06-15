@extends('dashboard.layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Laporan Grafik Pemesanan</h1>
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
                            <form action="/report/reservation-chart" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="year">Tahun</label>
                                            <input type="number" class="form-control" min="0" id="year"
                                                name="year" required value="{{ request()->get('year') ?? Date('Y') }}">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-4">
                                        <div class="form-group">
                                            <label for="quarter">Kuarter</label>
                                            <select name="quarter" id="quarter" class="form-control" required>
                                                <option value="" disabled selected>Pilih Kuarter</option>
                                                <option value="1"
                                                    {{ request()->get('quarter') == 1 ? 'selected' : '' }}>
                                                    Kuarter 1 (Januari - Maret)
                                                </option>
                                                <option value="2"
                                                    {{ request()->get('quarter') == 2 ? 'selected' : '' }}>
                                                    Kuarter 2 (April - Juni)
                                                </option>
                                                <option value="3"
                                                    {{ request()->get('quarter') == 3 ? 'selected' : '' }}>
                                                    Kuarter 3 (Juli - September)
                                                </option>
                                                <option value="4"
                                                    {{ request()->get('quarter') == 4 ? 'selected' : '' }}>
                                                    Kuarter 4 (Oktober - Desember)
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
                                                
                                                if (request()->get('year') && request()->get('quarter')) {
                                                    $get .= 'year=' . request()->get('year') . '&quarter=' . request()->get('quarter');
                                                }
                                            @endphp
                                            <a href="/print/reservations-chart{{ $get }}" target="_blank"
                                                class="btn btn-success">
                                                Cetak
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        @if (!is_null($chart))
                            <div class="card-body">
                                {!! $chart->container() !!}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
    @if (!is_null($chart))
        {!! $chart->script() !!}
    @endif
@endsection
