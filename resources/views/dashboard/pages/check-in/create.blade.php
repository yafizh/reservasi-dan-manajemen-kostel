@extends('dashboard.layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 justify-content-center text-center">
                <div class="col-sm-6">
                    <h1 class="m-0">Check In</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <form action="/check-ins?reservation_id={{ request()->get('reservation_id') }}" method="POST">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-12">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="d-flex justify-content-center">
                            <img id="room-image" src="{{ asset('placeholder_room.png') }}" class="img-thumbnail mb-3"
                                style="width: 100%; height: 20rem; object-fit: contain;">
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="id_number">NIK</label>
                                    <input type="text" class="form-control" id="id_number" name="id_number" required
                                        value="{{ old('id_number', $reservation->id_number ?? '') }}"
                                        @disabled(!is_null($reservation)) />
                                </div>
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name" required
                                        value="{{ old('name', $reservation->name ?? '') }}" @disabled(!is_null($reservation))>
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                                        required value="{{ old('phone_number', $reservation->phone_number ?? '') }}"
                                        @disabled(!is_null($reservation))>
                                </div>
                            </div>

                            <div class="card-footer">
                                <a href="/{{ request()->segment(1) }}" class="btn btn-secondary float-left">Kembali</a>
                                <button type="submit" class="btn btn-primary float-right">Tambah</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="room_id">Kamar</label>
                                    <select class="form-control" name="room_id" id="room_id" required
                                        @disabled(!is_null($reservation))>
                                        <option value="" disabled selected>Pilih Kamar</option>
                                        @foreach ($roomTypes as $roomType)
                                            <optgroup label="{{ $roomType->name }}"
                                                data-image="{{ is_null($roomType->images) ? '' : asset('storage/' . $roomType->images[0]->filename) }}">
                                                @foreach ($roomType->availableRooms as $room)
                                                    <option value="{{ $room->id }}" @selected(old('room_id', $reservation->room->id ?? '') == $room->id)>
                                                        {{ $roomType->name }} | Kamar Nomor {{ $room->number }} | Lantai
                                                        {{ $room->floor }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="reservation_type_id">Jenis Penyewaan</label>
                                    <select class="form-control" name="reservation_type_id" id="reservation_type_id"
                                        required>
                                        <option value="" disabled selected>Pilih Jenis Pembayaran</option>
                                        @foreach ($reservationTypes as $reservationType)
                                            <option value="{{ $reservationType->id }}">
                                                @if ($reservationType->name == 1)
                                                    Bulanan
                                                @elseif ($reservationType->name == 2)
                                                    Mingguan
                                                @elseif ($reservationType->name == 3)
                                                    Harian (Senin - Kamis)
                                                @elseif ($reservationType->name == 4)
                                                    Harian (Jum'at - Minggu)
                                                @endif
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="d-block">Harga</label>
                                    @foreach ($roomTypes as $roomType)
                                        <h6>{{ $roomType->name }}</h6>
                                        <ul>
                                            @foreach ($roomType->prices as $roomTypePrice)
                                                <li>
                                                    @if ($roomTypePrice->reservationType->name == 1)
                                                        Bulanan:
                                                    @elseif ($roomTypePrice->reservationType->name == 2)
                                                        Mingguan:
                                                    @elseif ($roomTypePrice->reservationType->name == 3)
                                                        Harian (Senin - Kamis):
                                                    @elseif ($roomTypePrice->reservationType->name == 4)
                                                        Harian (Jum'at - Minggu):
                                                    @endif
                                                    Rp {{ $roomTypePrice->price }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <script>
        const roomImage = document.getElementById("room-image");
        document.getElementById('room_id').addEventListener('change', function() {
            console.log(this[this.selectedIndex].parentElement.getAttribute('data-image'))
            roomImage.setAttribute('src', this[this.selectedIndex].parentElement.getAttribute('data-image'));
        });
    </script>
@endsection
