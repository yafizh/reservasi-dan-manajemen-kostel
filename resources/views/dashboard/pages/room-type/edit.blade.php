@extends('dashboard.layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 justify-content-center text-center">
                <div class="col-sm-6">
                    <h1 class="m-0">Ubah Tipe Kamar</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <form action="/room-types/{{ $roomType->id }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
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
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Tipe Kamar</label>
                                    <input type="text" class="form-control" id="name" name="name" required
                                        value="{{ old('name', $roomType->name) }}">
                                </div>
                                <div class="form-group">
                                    <label for="summernote">Fasilitas Kamar</label>
                                    <textarea id="summernote" name="facilities" required>
                                        {!! old('facilites', $roomType->facilities) !!}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="order">Urutan</label>
                                    <input type="number" min="1" class="form-control" id="order" name="order"
                                        required value="{{ old('order', $roomType->order) }}">
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                @foreach ($reservationTypes as $reservationType)
                                    <div class="form-group">
                                        <label for="room-type-{{ $reservationType->name }}">
                                            @if ($reservationType->name == 1)
                                                Harga Bulanan
                                            @elseif($reservationType->name == 2)
                                                Harga Mingguan
                                            @elseif($reservationType->name == 3)
                                                Harga Harian (Senin - Kamis)
                                            @elseif($reservationType->name == 4)
                                                Harga Harian (Jum'at - Minggu)
                                            @endif
                                        </label>
                                        @foreach ($roomType->prices as $roomTypePrice)
                                            @if ($reservationType->id == $roomTypePrice->reservation_type_id)
                                                <input type="number" class="form-control"
                                                    id="room-type-{{ $reservationType->name }}"
                                                    name="room-type-{{ $reservationType->name }}" required
                                                    value="{{ old('room-type-' . $reservationType->name, $roomTypePrice->price) }}">
                                            @endif
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                            <div class="card-footer">
                                <a href="/{{ request()->segment(1) }}" class="btn btn-secondary float-left">Kembali</a>
                                <button type="submit" class="btn btn-primary float-right">Perbaharui</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <input type="file" credits="false" name="images[]" multiple required />
                    </div>
                </div>
            </form>
        </div>
    </section>
    <script src="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.js"></script>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

    <script>
        const roomTypeImages = {{ Js::from($roomType->images) }};

        const files = [];
        roomTypeImages.forEach((value) => {
            files.push({
                source: value.filename,

                // set type to local to indicate an already uploaded file
                options: {
                    type: 'local',
                    file: {
                        name: value.filename_original,
                    },
                    metadata: {
                        poster: value.filename,
                    },
                },
            });
        });

        FilePond.registerPlugin(FilePondPluginFilePoster);
        FilePond.registerPlugin(FilePondPluginImagePreview);
        FilePond.registerPlugin(FilePondPluginFileValidateType);
        // Get a reference to the file input element
        const inputElement = document.querySelector('input[type="file"]');

        const pond = FilePond.create(inputElement);
        pond.setOptions({
            acceptedFileTypes: ['image/*'],
            fileValidateTypeDetectType: (source, type) =>
                new Promise((resolve, reject) => {
                    resolve(type);
                }),
            files: files,
            server: {
                url: 'http://127.0.0.1:8000/room-types',
                process: '/uploads/process',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
                },
            },
            allowMultiple: true,
        });
    </script>
@endsection
