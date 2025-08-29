@extends('layouts.app')

@section('title', 'Login - Sistem Manajemen Barang Kantor')

@section('content')
<div class="container d-flex flex-column" style="min-height: 100vh;">
    <div class="row align-items-center justify-content-center flex-grow-1">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-lg p-3 mb-5 bg-body rounded border-0">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="{{ asset('logo-kpu.png') }}" alt="Logo KPU" class="img-fluid mb-3" style="max-height: 80px;">
                        <h4 class="card-title text-maroon fw-bold mb-1">Sistem Manajemen Barang</h4>
                        <p class="text-muted">KPU Provinsi Jawa Tengah</p>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label text-maroon">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="password" class="form-label text-maroon">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required autocomplete="current-password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-maroon btn-lg">Login</button>
                        </div>

                        <div class="text-center mt-3">
                            <p class="text-muted">Belum punya akun? <a href="{{ route('register') }}" class="text-maroon fw-bold">Daftar Akun Baru</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
