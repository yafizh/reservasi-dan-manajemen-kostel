@extends('dashboard.layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 justify-content-center text-center">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Tipe Kamar</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <form action="/room-types" method="POST" enctype="multipart/form-data">
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
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Tipe Kamar</label>
                                    <input type="text" class="form-control" id="name" name="name" required
                                        value="{{ old('name') }}">
                                </div>
                                <div class="form-group">
                                    <label for="summernote">Fasilitas Kamar</label>
                                    <textarea id="summernote" name="facilities" required>
                                        {!! old('facilites') !!}
                                    </textarea>
                                </div>
                                <div class="form-group">
                                    <label for="order">Urutan</label>
                                    <input type="number" min="1" class="form-control" id="order" name="order"
                                        required value="{{ old('order') }}">
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
                                        <input type="number" class="form-control"
                                            id="room-type-{{ $reservationType->name }}"
                                            name="room-type-{{ $reservationType->name }}" required
                                            value="{{ old('room-type-' . $reservationType->name) }}">
                                    </div>
                                @endforeach
                            </div>
                            <div class="card-footer">
                                <a href="/{{ request()->segment(1) }}" class="btn btn-secondary float-left">Kembali</a>
                                <button type="submit" class="btn btn-primary float-right">Tambah</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <input type="file" name="images[]" multiple required />
                    </div>
                </div>
            </form>
        </div>
    </section>
    <script src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

    <script>
        FilePond.registerPlugin(FilePondPluginImagePreview);
        FilePond.registerPlugin(FilePondPluginFileValidateType);
        // Get a reference to the file input element
        const inputElement = document.querySelector('input[type="file"]');

        const pond = FilePond.create(inputElement).setOptions({
            acceptedFileTypes: ['image/*'],
            fileValidateTypeDetectType: (source, type) =>
                new Promise((resolve, reject) => {
                    resolve(type);
                }),
            server: {
                process: './uploads/process',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('input[name=_token]').value,
                },
            },
            allowMultiple: true,
        });
        // // Create a FilePond instance
        // const pond = FilePond.create(inputElement, {
        //     acceptedFileTypes: ['image/png'],
        //     fileValidateTypeDetectType: (source, type) =>
        //         new Promise((resolve, reject) => {
        //             // Do custom type detection here and return with promise

        //             resolve(type);
        //         }),
        // });
    </script>
@endsection
