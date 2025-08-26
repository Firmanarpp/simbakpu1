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
@extends('layouts.app')

@section('title', 'Daftar Barang - Sistem Manajemen Barang Kantor')

@section('content')
{{-- Page Header --}}
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="mb-0">
                    <i class="fas fa-box me-2 d-none d-md-inline"></i>
                    <span class="d-md-none">📦</span>
                    Daftar Barang
                </h1>
                <p class="lead mb-0 d-none d-md-block">Kelola semua barang yang ada di gedung kantor</p>
                <p class="mb-0 d-md-none"><small>Kelola barang kantor</small></p>
            </div>
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
        <div class="card-header bg-gradient-orange text-white">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>
                        <span class="d-none d-md-inline">Total {{ $items->total() }} Barang</span>
                        <span class="d-md-none">{{ $items->total() }} Items</span>
                    </h5>
                </div>
                <div class="col-auto">
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

        {{-- Search and Filter Form --}}
        <div class="card-body bg-light border-bottom p-3">
            <form action="{{ route('items.index') }}" method="GET" class="row g-3 align-items-center">
                <div class="col-12 col-md-6 col-lg-4">
                    <label for="search" class="visually-hidden">Cari Barang</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search"></i></span>
                        <input type="text" name="search" id="search" class="form-control border-start-0" placeholder="Cari merk, tipe, atau QR Code..." value="{{ request('search') }}">
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <label for="room_id" class="visually-hidden">Filter Ruangan</label>
                    <select name="room_id" id="room_id" class="form-select form-select-sm">
                        <option value="">Semua Ruangan</option>
                        @foreach($rooms as $room)
                            <option value="{{ $room->id }}" {{ request('room_id') == $room->id ? 'selected' : '' }}>
                                {{ $room->name }} ({{ $room->floor }})
                            </option>
                        @endforeach
                    </select>
                </div>
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
            @if($items->count() > 0)
                <!-- Mobile Card View -->
                <div class="d-block d-lg-none">
                    @foreach($items as $item)
                    <div class="border-bottom p-3">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h6 class="mb-0 fw-bold text-primary">{{ $item->brand }}</h6>
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
                                    <li><a class="dropdown-item text-danger" href="#" onclick="deleteItem({{ $item->id }})">
                                        <i class="fas fa-trash me-2"></i>Hapus
                                    </a></li>
                                </ul>
                            </div>
                        </div>
                        <div>
                            <p class="mb-1 text-muted small">{{ $item->type }}</p>
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

                <!-- Desktop Table View -->
                <div class="d-none d-lg-block">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                        <thead class="table-dark">
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
                            @foreach($items as $index => $item)
                                <tr>
                                    <td>{{ $items->firstItem() + $index }}</td>
                                    <td>
                                        <code class="bg-light p-1 rounded small">{{ $item->qr_code }}</code>
                                    </td>
                                    <td>
                                        <strong class="text-primary">{{ $item->brand }}</strong>
                                    </td>
                                    <td>{{ $item->type }}</td>
                                    <td>
                                        <span class="badge bg-info">
                                            <i class="fas fa-door-open me-1"></i>
                                            {{ $item->room->name ?? 'No Room' }}
                                        </span>
                                        @if($item->room && $item->room->floor)
                                            <br>
                                            <small class="text-muted">{{ $item->room->floor }}</small>
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->description)
                                            <span class="text-muted small">{{ Str::limit($item->description, 50) }}</span>
                                        @else
                                            <span class="text-muted font-italic">-</span>
                                        @endif
                                    </td>
                                    <td>
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
                                            <button type="button" 
                                                    class="btn btn-outline-danger btn-sm"
                                                    onclick="deleteItem({{ $item->id }})"
                                                    title="Hapus Barang"
                                                    data-bs-toggle="tooltip">
                                                <i class="fas fa-trash"></i>
                                                <span class="d-none d-xl-inline ms-1">Hapus</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
            @else
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
            
            @if($items->count() > 0)
                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-3 px-3 pb-3">
                    {{ $items->links('pagination.custom') }}
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus barang ini?</p>
                <div id="deleteItemInfo" class="alert alert-warning"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Check if FontAwesome is loaded
    const checkFontAwesome = () => {
        const icons = document.querySelectorAll('.fas, .far, .fab');
        icons.forEach(icon => {
            if (getComputedStyle(icon).fontFamily.indexOf('Font Awesome') === -1) {
                console.warn('FontAwesome may not be loaded properly');
                // Fallback for specific icons
                if (icon.classList.contains('fa-chevron-left')) {
                    icon.innerHTML = '‹';
                } else if (icon.classList.contains('fa-chevron-right')) {
                    icon.innerHTML = '›';
                }
            }
        });
    };
    
    // Check FontAwesome after DOM is loaded
    setTimeout(checkFontAwesome, 100);
});

function deleteItem(itemId) {
    // Set form action
    document.getElementById('deleteForm').action = `/items/${itemId}`;
    
    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
</script>
@endsection
