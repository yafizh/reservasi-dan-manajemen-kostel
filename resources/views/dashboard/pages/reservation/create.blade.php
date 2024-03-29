@extends('dashboard.layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 justify-content-center text-center">
                <div class="col-sm-6">
                    <h1 class="m-0">Pemesanan</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <form action="/reservations" method="POST">
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
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="id_number">NIK</label>
                                    <input type="text" class="form-control" id="id_number" name="id_number" required
                                        value="{{ old('id_number') }}">
                                </div>
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control" id="name" name="name" required
                                        value="{{ old('name') }}">
                                </div>
                                <div class="form-group">
                                    <label for="phone_number">Nomor Telepon</label>
                                    <input type="text" class="form-control" id="phone_number" name="phone_number"
                                        required value="{{ old('phone_number') }}">
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="room_id">Kamar</label>
                                    <select class="form-control" name="room_id" id="room_id" required>
                                        <option value="" disabled selected>Pilih Kamar</option>
                                        @foreach ($roomTypes as $roomType)
                                            <optgroup label="{{ $roomType->name }}"
                                                data-image="{{ is_null($roomType->images) ? '' : asset('storage/' . $roomType->images[0]->filename) }}">
                                                @foreach ($roomType->availableRooms as $room)
                                                    <option value="{{ $room->id }}" @selected(old('room_id') == $room->id)>
                                                        Kamar Nomor {{ $room->number }} | Lantai {{ $room->floor }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="check_in_date">Tanggal Check In</label>
                                    <input type="date" class="form-control" id="check_in_date" name="check_in_date"
                                        required value="{{ old('check_in_date') }}">
                                </div>
                                <div class="form-group">
                                    <label for="down_payment">Uang Muka</label>
                                    <input type="text" class="form-control" id="down_payment" name="down_payment"
                                        required value="{{ old('down_payment') }}">
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="/{{ request()->segment(1) }}" class="btn btn-secondary float-left">Kembali</a>
                                <button type="submit" class="btn btn-primary float-right">Tambah</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <script>
        document.querySelector('input[name=down_payment]').addEventListener("keypress", function(evt) {
            if (evt.which < 48 || evt.which > 57) {
                evt.preventDefault();
                return;
            }
            this.addEventListener('input', function() {
                const down_payment = Number(((this.value).split('.')).join(''));
                this.value = formatNumberWithDot.format(down_payment);
            });
        });
    </script>
    <script>
        const roomImage = document.getElementById("room-image");
        document.getElementById('room_id').addEventListener('change', function() {
            console.log(this[this.selectedIndex].parentElement.getAttribute('data-image'))
            roomImage.setAttribute('src', this[this.selectedIndex].parentElement.getAttribute('data-image'));
        });
    </script>
@endsection
