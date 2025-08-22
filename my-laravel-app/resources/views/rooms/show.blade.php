{{--
/**
 * Room Detail Page - Halaman Detail Ruangan
 * 
 * File: resources/views/rooms/show.blade.php
 * Deskripsi: Halaman untuk menampilkan detail ruangan dan barang di dalamnya
 * Fitur: Room info sidebar, items list, action buttons, delete protection
 * 
 * Komponen yang ditampilkan:
 * - Page header dengan nama ruangan dan deskripsi
 * - Navigation button (Kembali saja, Edit dipindah ke sidebar)
 * - Sidebar dengan informasi ruangan dan aksi:
 *   - Info ruangan (nama, lantai, total barang)
 *   - Action buttons (Edit, Tambah Barang, Scan QR, Hapus)
 * - Main content dengan daftar barang di ruangan
 * - Delete confirmation modal dengan validasi
 * 
 * @author Sistem Manajemen Barang KPU
 * @version 1.0
 * @since August 2025
 */
--}}
@extends('layouts.app')

@section('title', 'Detail Ruangan - ' . $room->name)

@section('content')
{{-- Page Header --}}
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="mb-0">
                    <i class="fas fa-door-open me-3"></i>
                    {{ $room->name }}
                </h1>
                <p class="lead mb-0">
                    @if($room->floor)
                        <i class="fas fa-building me-1"></i>{{ $room->floor }}
                    @endif
                    @if($room->floor && $room->description) • @endif
                    @if($room->description)
                        {{ Str::limit($room->description, 100) }}
                    @endif
                </p>
            </div>
            <div class="col-auto">
                <a href="{{ route('rooms.index') }}" class="btn btn-light">
                    <i class="fas fa-arrow-left me-2"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <!-- Room Info -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Informasi Ruangan
                    </h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="display-4 text-warning">
                            <i class="fas fa-door-open"></i>
                        </div>
                    </div>
                    
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td class="fw-bold text-muted">Nama:</td>
                            <td>{{ $room->name }}</td>
                        </tr>
                        @if($room->floor)
                            <tr>
                                <td class="fw-bold text-muted">Lantai:</td>
                                <td>
                                    <span class="badge bg-secondary">
                                        <i class="fas fa-building me-1"></i>{{ $room->floor }}
                                    </span>
                                </td>
                            </tr>
                        @endif
                        <tr>
                            <td class="fw-bold text-muted">Total Barang:</td>
                            <td>
                                <span class="badge bg-primary fs-6">
                                    {{ $room->items->count() }} barang
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">Dibuat:</td>
                            <td>
                                {{ $room->created_at->format('d M Y') }}
                                <br>
                                <small class="text-muted">{{ $room->created_at->diffForHumans() }}</small>
                            </td>
                        </tr>
                    </table>
                    
                    @if($room->description)
                        <div class="border-top pt-3 mt-3">
                            <h6 class="fw-bold text-muted mb-2">Deskripsi:</h6>
                            <p class="text-muted">{{ $room->description }}</p>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Actions -->
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-cogs me-2"></i>
                        Aksi
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>
                            Edit Ruangan
                        </a>
                        
                        <a href="{{ route('items.create', ['room_id' => $room->id]) }}" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>
                            Tambah Barang di Ruangan Ini
                        </a>
                        
                        <a href="{{ route('qr-scan.index') }}" class="btn btn-outline-primary">
                            <i class="fas fa-qrcode me-2"></i>
                            Scan QR Code
                        </a>
                        
                        <hr>
                        
                        @if($room->items->count() == 0)
                            <button type="button" 
                                    class="btn btn-outline-danger"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteModal">
                                <i class="fas fa-trash me-2"></i>
                                Hapus Ruangan
                            </button>
                        @else
                            <button type="button" class="btn btn-outline-secondary" disabled>
                                <i class="fas fa-trash me-2"></i>
                                Tidak dapat dihapus (ada barang)
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Items List -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="mb-0">
                                <i class="fas fa-box me-2"></i>
                                Barang di Ruangan Ini ({{ $room->items->count() }})
                            </h6>
                        </div>
                        <div class="col-auto">
                            <a href="{{ route('items.create', ['room_id' => $room->id]) }}" 
                               class="btn btn-primary btn-sm">
                                <i class="fas fa-plus me-1"></i>Tambah Barang
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @if($room->items->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>QR Code</th>
                                        <th>Merk</th>
                                        <th>Tipe</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($room->items as $index => $item)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>
                                                <code class="bg-light p-1 rounded">{{ $item->qr_code }}</code>
                                            </td>
                                            <td><strong>{{ $item->brand }}</strong></td>
                                            <td>{{ $item->type }}</td>
                                            <td>
                                                @if($item->description)
                                                    <span class="text-muted">{{ Str::limit($item->description, 40) }}</span>
                                                @else
                                                    <span class="text-muted font-italic">-</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('items.show', $item->id) }}" 
                                                       class="btn btn-outline-primary btn-sm"
                                                       title="Lihat Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('items.edit', $item->id) }}" 
                                                       class="btn btn-outline-warning btn-sm"
                                                       title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                            <h6 class="text-muted">Belum ada barang di ruangan ini</h6>
                            <p class="text-muted">Mulai dengan menambahkan barang pertama untuk ruangan {{ $room->name }}.</p>
                            <div class="mt-3">
                                <a href="{{ route('items.create', ['room_id' => $room->id]) }}" 
                                   class="btn btn-primary me-2">
                                    <i class="fas fa-plus me-1"></i>Tambah Barang
                                </a>
                                <a href="{{ route('qr-scan.index') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-qrcode me-1"></i>Scan QR Code
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
@if($room->items->count() == 0)
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle text-danger me-2"></i>
                    Konfirmasi Hapus Ruangan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h6><i class="fas fa-warning me-2"></i>Peringatan!</h6>
                    <p class="mb-0">Tindakan ini tidak dapat dibatalkan. Ruangan akan dihapus secara permanen dari sistem.</p>
                </div>
                
                <p>Apakah Anda yakin ingin menghapus ruangan <strong>{{ $room->name }}</strong>?</p>
                
                <div class="card">
                    <div class="card-body">
                        <table class="table table-sm table-borderless mb-0">
                            <tr>
                                <td class="fw-bold" style="width: 30%;">Nama:</td>
                                <td>{{ $room->name }}</td>
                            </tr>
                            @if($room->floor)
                                <tr>
                                    <td class="fw-bold">Lantai:</td>
                                    <td>{{ $room->floor }}</td>
                                </tr>
                            @endif
                            <tr>
                                <td class="fw-bold">Total Barang:</td>
                                <td>{{ $room->items->count() }} barang</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Batal
                </button>
                <form action="{{ route('rooms.destroy', $room->id) }}" method="POST" class="d-inline">
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
@endif
@endsection
