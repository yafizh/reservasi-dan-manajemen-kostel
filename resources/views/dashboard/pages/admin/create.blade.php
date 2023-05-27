@extends('dashboard.layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 justify-content-center text-center">
                <div class="col-sm-6">
                    <h1 class="m-0">Tambah Admin</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="card">
                        <form>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input type="text" class="form-control" id="username" name="username" required
                                        value="{{ old('username') }}">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>
                            </div>

                            <div class="card-footer">
                                <a href="/{{ request()->segment(1) }}" class="btn btn-secondary float-left">Kembali</a>
                                <button type="submit" class="btn btn-primary float-right">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
