@extends('dashboard.layouts.main')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 justify-content-center text-center">
                <div class="col-sm-6">
                    <h1 class="m-0">Ganti Password</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <form action="/change-password" method="POST">
                @csrf
                <div class="row justify-content-center">
                    <div class="col-12 col-md-6">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger" role="alert">
                                    {{ $error }}
                                </div>
                            @endforeach
                        @endif
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="old_password">Password lama</label>
                                    <input type="password" class="form-control" id="old_password" name="old_password"
                                        required />
                                </div>
                                <div class="form-group">
                                    <label for="new_password">Password Baru</label>
                                    <input type="password" class="form-control" id="new_password" name="new_password"
                                        required />
                                </div>
                                <div class="form-group">
                                    <label for="confirm_new_password">Konfirmasi Password Baru</label>
                                    <input type="password" class="form-control" id="confirm_new_password"
                                        name="confirm_new_password" required />
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary float-right">Perbaharui Password</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
@endsection
