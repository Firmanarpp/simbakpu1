{{--
/**
 * Rooms Index Page - Halaman Daftar Ruangan
 * 
 * File: resources/views/rooms/index.blade.php
 * Deskripsi: Halaman untuk menampilkan daftar semua ruangan dalam sistem
 * Fitur: Responsive grid layout, room statistics, quick actions
 * 
 * Komponen yang ditampilkan:
 * - Page header dengan total ruangan
 * - Add new room button
 * - Grid layout untuk desktop dan mobile
 * - Room cards dengan informasi:
 *   - Nama ruangan dan lantai
 *   - Jumlah barang di ruangan
 *   - Quick action buttons (Lihat, Edit)
 * - Empty state jika belum ada ruangan
 * 
 * @author Sistem Manajemen Barang KPU
 * @version 1.0
 * @since August 2025
 */
--}}
@extends('layouts.app')

@section('title', 'Daftar Ruangan - Sistem Manajemen Barang Kantor')

@section('content')
{{-- Page Header --}}
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="mb-0">
                    <i class="fas fa-door-open me-2 d-none d-md-inline"></i>
                    <span class="d-md-none">🚪</span>
                    Daftar Ruangan
                </h1>
                <p class="lead mb-0 d-none d-md-block">Kelola ruangan di gedung kantor</p>
                <p class="mb-0 d-md-none"><small>Kelola ruangan kantor</small></p>
            </div>
            <div class="col-auto">
                <a href="{{ route('rooms.create') }}" class="btn btn-light btn-sm">
                    <i class="fas fa-plus me-1 d-none d-sm-inline"></i>
                    <span class="d-sm-none">+</span>
                    <span class="d-none d-sm-inline">Tambah Ruangan</span>
                    <span class="d-sm-none">Tambah</span>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3">
    @if($rooms->count() > 0)
        <div class="row g-3">
            @foreach($rooms as $room)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="card-header bg-gradient-orange text-white">
                            <h6 class="mb-0">
                                <i class="fas fa-door-open me-2"></i>
                                {{ $room->name }}
                            </h6>
                        </div>
                        <div class="card-body text-center p-4">
                            <div class="display-4 text-warning mb-3">
                                <i class="fas fa-door-open"></i>
                            </div>
                            
                            @if($room->floor)
                                <div class="mb-2">
                                    <span class="badge bg-secondary">
                                        <i class="fas fa-building me-1"></i>{{ $room->floor }}
                                    </span>
                                </div>
                            @endif
                            
                            <h5 class="card-title">{{ $room->name }}</h5>
                            
                            @if($room->description)
                                <p class="card-text text-muted small">
                                    {{ Str::limit($room->description, 80) }}
                                </p>
                            @endif
                            
                            <div class="row text-center mt-3">
                                <div class="col">
                                    <div class="display-6 text-primary fw-bold">
                                        {{ $room->items_count }}
                                    </div>
                                    <small class="text-muted">Barang</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="row g-2">
                                <div class="col-6">
                                    <a href="{{ route('rooms.show', $room->id) }}" 
                                       class="btn btn-outline-primary btn-sm w-100">
                                        <i class="fas fa-eye me-1"></i>Detail
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="{{ route('rooms.edit', $room->id) }}" 
                                       class="btn btn-outline-warning btn-sm w-100">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        <!-- Pagination -->
        @if($rooms->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $rooms->links('pagination.custom') }}
        </div>
        @endif
    @else
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="fas fa-door-open fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Belum ada ruangan yang ditambahkan</h5>
                <p class="text-muted">Mulai dengan menambahkan ruangan pertama untuk sistem manajemen barang Anda.</p>
                <a href="{{ route('rooms.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Tambah Ruangan Pertama
                </a>
            </div>
        </div>
    @endif
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Ruangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Peringatan!</strong> Tindakan ini tidak dapat dibatalkan.
                </div>
                <p>Apakah Anda yakin ingin menghapus ruangan ini?</p>
                <div id="roomInfo" class="bg-light p-3 rounded"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Batal
                </button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>Ya, Hapus Ruangan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function deleteRoom(roomId, roomName) {
    // Set form action
    document.getElementById('deleteForm').action = `/rooms/${roomId}`;
    
    // Set room info
    document.getElementById('roomInfo').innerHTML = `<strong>${roomName}</strong>`;
    
    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
</script>
@endsection
