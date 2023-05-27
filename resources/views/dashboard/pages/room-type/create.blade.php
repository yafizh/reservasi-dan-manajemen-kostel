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
            <form>
                <div class="row justify-content-center">
                    <div class="col-12 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Tipe Kamar</label>
                                    <input type="text" class="form-control" id="name" name="name" required
                                        value="{{ old('name') }}">
                                </div>
                                <div class="form-group">
                                    <label for="username">Harga Harian (Senin - Kamis)</label>
                                    <input type="text" class="form-control" id="username" name="username" required
                                        value="{{ old('username') }}">
                                </div>
                                <div class="form-group">
                                    <label for="username">Harga Harian (Jum'at - Minggu)</label>
                                    <input type="text" class="form-control" id="username" name="username" required
                                        value="{{ old('username') }}">
                                </div>
                                <div class="form-group">
                                    <label for="username">Harga Mingguan</label>
                                    <input type="text" class="form-control" id="username" name="username" required
                                        value="{{ old('username') }}">
                                </div>
                                <div class="form-group">
                                    <label for="username">Harga Bulanan</label>
                                    <input type="text" class="form-control" id="username" name="username" required
                                        value="{{ old('username') }}">
                                </div>
                                <div class="form-group">
                                    <label for="summernote">Fasilitas Kamar</label>
                                    <textarea id="summernote">
                                        Place <em>some</em> <u>text</u> <strong>here</strong>
                                    </textarea>
                                </div>
                            </div>

                            <div class="card-footer">
                                <a href="/{{ request()->segment(1) }}" class="btn btn-secondary float-left">Kembali</a>
                                <button type="submit" class="btn btn-primary float-right">Tambah</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <input type="file" name="images" multiple />
                    </div>
                </div>
            </form>
        </div>
    </section>
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>

    <script>
        FilePond.registerPlugin(FilePondPluginImagePreview);
        // Get a reference to the file input element
        const inputElement = document.querySelector('input[type="file"]');

        // Create a FilePond instance
        const pond = FilePond.create(inputElement);
    </script>
@endsection
