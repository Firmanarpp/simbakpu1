{{--
/**
 * Items Index Page - Halaman Daftar Barang
 * 
 * File: resources/views/items/index.blade.php
 * Deskripsi: Halaman untuk menampilkan daftar semua barang dalam sistem
 * Fitur: Responsive table/card view, pagination, search, quick actions
 * 
 * Komponen yang ditampilkan:
 * - Page header dengan total count
 * - Quick action buttons (Tambah, Scan QR)
 * - Mobile-friendly card view untuk layar kecil
 * - Desktop table view untuk layar besar
 * - Pagination controls
 * - Delete confirmation modal
 * 
 * @author Sistem Manajemen Barang KPU
 * @version 1.0
 * @since August 2025
 */
--}}
@extends('layouts.app') {{-- Menggunakan layout aplikasi utama --}}

@section('title', 'Daftar Barang - Sistem Manajemen Barang Kantor') {{-- Mengatur judul halaman --}}

@section('content') {{-- Memulai bagian konten utama --}}
{{-- Bagian Header Halaman --}}
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                {{-- Judul halaman untuk tampilan desktop dan mobile --}}
                <h1 class="mb-0">
                    <i class="fas fa-box me-2 d-none d-md-inline"></i>
                    <span class="d-md-none">📦</span>
                    Daftar Barang
                </h1>
                {{-- Deskripsi halaman untuk tampilan desktop dan mobile --}}
                <p class="lead mb-0 d-none d-md-block">Kelola semua barang yang ada di gedung kantor</p>
                <p class="mb-0 d-md-none"><small>Kelola barang kantor</small></p>
            </div>
            {{-- Tombol Tambah Barang --}}
            <div class="col-auto">
                <a href="{{ route('items.create') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-plus me-1 d-none d-sm-inline"></i>
                    <span class="d-sm-none">+</span>
                    <span class="d-none d-sm-inline">Tambah Barang</span>
                    <span class="d-sm-none">Tambah</span>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3">
    <div class="card">
        {{-- Header card dengan total barang dan tombol aksi cepat --}}
        <div class="card-header bg-gradient-orange text-white">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>
                        {{-- Menampilkan total jumlah barang --}}
                        <span class="d-none d-md-inline">Total {{ $items->total() }} Barang</span>
                        <span class="d-md-none">{{ $items->total() }} Items</span>
                    </h5>
                </div>
                <div class="col-auto">
                    {{-- Grup tombol aksi cepat (Tambah Barang dan Scan QR) --}}
                    <div class="btn-group" role="group">
                        <a href="{{ route('items.create') }}" class="btn btn-white btn-sm shadow-sm border">
                            <i class="fas fa-plus me-1 d-none d-sm-inline text-primary"></i>
                            <span class="d-sm-none">+</span>
                            <span class="d-none d-sm-inline text-dark fw-bold">Tambah</span>
                        </a>
                        <a href="{{ route('qr-scan.index') }}" class="btn btn-white btn-sm shadow-sm border">
                            <i class="fas fa-qrcode me-1 d-none d-sm-inline text-primary"></i>
                            <span class="d-sm-none">📷</span>
                            <span class="d-none d-sm-inline text-dark fw-bold">Scan QR</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Form Pencarian dan Filter --}}
        <div class="card-body bg-light border-bottom p-3">
            <form action="{{ route('items.index') }}" method="GET" class="row g-3 align-items-center">
                {{-- Input pencarian berdasarkan merk, tipe, atau QR Code --}}
                <div class="col-12 col-md-6 col-lg-4">
                    <label for="search" class="visually-hidden">Cari Barang</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search"></i></span>
                        <input type="text" name="search" id="search" class="form-control border-start-0" placeholder="Cari merk, tipe, atau QR Code..." value="{{ request('search') }}">
                    </div>
                </div>
                {{-- Dropdown filter berdasarkan Ruangan --}}
                <div class="col-12 col-md-6 col-lg-4">
                    <label for="room_id" class="visually-hidden">Filter Ruangan</label>
                    <select name="room_id" id="room_id" class="form-select form-select-sm">
                        <option value="">Semua Ruangan</option>
                        {{-- Loop untuk menampilkan opsi ruangan --}}
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}" {{ request('room_id') == $room->id ? 'selected' : '' }}>
                                {{ $room->name }} ({{ $room->floor }})
                            </option>
                        @endforeach
                    </select>
                </div>
                {{-- Tombol Filter dan Reset --}}
                <div class="col-12 col-lg-4 text-end">
                    <button type="submit" class="btn btn-primary btn-sm me-2">
                        <i class="fas fa-filter me-1"></i> Filter
                    </button>
                    <a href="{{ route('items.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-sync-alt me-1"></i> Reset
                    </a>
                </div>
            </form>
        </div>

        <div class="card-body p-0">
            @if($items->count() > 0) {{-- Memeriksa apakah ada barang untuk ditampilkan --}}
                {{-- Tampilan Card untuk Mobile (layar kecil) --}}
                <div class="d-block d-lg-none">
                    @foreach($items as $item)
                    <div class="border-bottom p-3">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h6 class="mb-0 fw-bold text-primary">{{ $item->brand }}</h6>
                            {{-- Dropdown untuk aksi (Lihat, Edit) --}}
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="{{ route('items.show', $item->id) }}">
                                        <i class="fas fa-eye me-2"></i>Lihat
                                    </a></li>
                                    <li><a class="dropdown-item" href="{{ route('items.edit', $item->id) }}">
                                        <i class="fas fa-edit me-2"></i>Edit
                                    </a></li>
                                    <li><hr class="dropdown-divider"></li>
                                </ul>
                            </div>
                        </div>
                        <div>
                            <p class="mb-1 text-muted small">{{ $item->type }}</p>
                            {{-- Badge untuk ruangan, kondisi, dan status --}}
                            <div class="d-flex gap-2 mb-2">
                                <span class="badge bg-info small">{{ $item->room->name ?? 'No Room' }}</span>
                                <span class="badge bg-secondary small">{{ $item->condition }}</span>
                                <span class="badge bg-primary small">{{ ucfirst($item->status) }}</span>
                            </div>
                            <code class="small">{{ $item->qr_code }}</code>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Tampilan Tabel untuk Desktop (layar besar) --}}
                <div class="d-none d-lg-block">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                        <thead class="table-dark"> {{-- Header tabel --}}
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">QR Code</th>
                                <th width="15%">Merk</th>
                                <th width="15%">Tipe</th>
                                <th width="15%">Ruangan</th>
                                <th width="20%">Deskripsi</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- Loop untuk menampilkan setiap barang dalam tabel --}}
                            @foreach($items as $index => $item)
                                <tr>
                                    <td>{{ $items->firstItem() + $index }}</td> {{-- Nomor urut barang --}}
                                    <td>
                                        <code class="bg-light p-1 rounded small">{{ $item->qr_code }}</code>
                                    </td>
                                    <td>
                                        <strong class="text-primary">{{ $item->brand }}</strong>
                                    </td>
                                    <td>{{ $item->type }}</td>
                                    <td>
                                        {{-- Badge untuk nama ruangan --}}
                                        <span class="badge bg-info">
                                            <i class="fas fa-door-open me-1"></i>
                                            {{ $item->room->name ?? 'No Room' }}
                                        </span>
                                        {{-- Menampilkan lantai ruangan jika ada --}}
                                        @if($item->room && $item->room->floor)
                                            <br>
                                            <small class="text-muted">{{ $item->room->floor }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- Menampilkan deskripsi barang (dibatasi 50 karakter) --}}
                                        @if($item->description)
                                            <span class="text-muted small">{{ Str::limit($item->description, 50) }}</span>
                                        @else
                                            <span class="text-muted font-italic">-</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{-- Grup tombol aksi (Lihat dan Edit) --}}
                                        <div class="btn-group" role="group" aria-label="Actions">
                                            <a href="{{ route('items.show', $item->id) }}" 
                                               class="btn btn-outline-primary btn-sm"
                                               title="Lihat Detail"
                                               data-bs-toggle="tooltip">
                                                <i class="fas fa-eye"></i>
                                                <span class="d-none d-xl-inline ms-1">Lihat</span>
                                            </a>
                                            <a href="{{ route('items.edit', $item->id) }}" 
                                               class="btn btn-outline-warning btn-sm"
                                               title="Edit Barang"
                                               data-bs-toggle="tooltip">
                                                <i class="fas fa-edit"></i>
                                                <span class="d-none d-xl-inline ms-1">Edit</span>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
            @else {{-- Jika tidak ada barang ditemukan --}}
                {{-- Pesan kosong dan tombol untuk menambahkan barang --}}
                <div class="text-center py-5">
                    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada barang yang ditambahkan</h5>
                    <p class="text-muted">Mulai dengan menambahkan barang pertama atau scan QR code barang yang sudah ada.</p>
                    <div class="mt-3">
                        <a href="{{ route('items.create') }}" class="btn btn-primary me-2">
                            <i class="fas fa-plus me-1"></i>Tambah Barang
                        </a>
                        <a href="{{ route('qr-scan.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-qrcode me-1"></i>Scan QR Code
                        </a>
                    </div>
                </div>
            @endif
            
            @if($items->count() > 0) {{-- Menampilkan paginasi jika ada barang --}}
                {{-- Bagian Paginasi --}}
                <div class="d-flex justify-content-center mt-3 px-3 pb-3">
                    {{ $items->links('pagination.custom') }} {{-- Menggunakan custom pagination view --}}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection {{-- Mengakhiri bagian konten utama --}}

@section('scripts') {{-- Memulai bagian JavaScript --}}
<script>
// Event listener untuk memastikan DOM sudah dimuat sepenuhnya
document.addEventListener('DOMContentLoaded', function() {
    // Inisialisasi Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Fungsi untuk memeriksa apakah FontAwesome dimuat dengan benar
    const checkFontAwesome = () => {
        const icons = document.querySelectorAll('.fas, .far, .fab');
        icons.forEach(icon => {
            // Jika FontAwesome tidak dimuat, berikan fallback teks untuk ikon tertentu
            if (getComputedStyle(icon).fontFamily.indexOf('Font Awesome') === -1) {
                console.warn('FontAwesome may not be loaded properly');
                if (icon.classList.contains('fa-chevron-left')) {
                    icon.innerHTML = '‹';
                } else if (icon.classList.contains('fa-chevron-right')) {
                    icon.innerHTML = '›';
                }
            }
        });
    };
    
    // Panggil fungsi pemeriksaan FontAwesome setelah DOM dimuat dan sedikit penundaan
    setTimeout(checkFontAwesome, 100);
});
</script>
@endsection {{-- Mengakhiri bagian JavaScript --}}
