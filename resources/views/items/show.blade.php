{{--
/**
 * Item Detail Page - Halaman Detail Barang
 * 
 * File: resources/views/items/show.blade.php
 * Deskripsi: Halaman untuk menampilkan detail lengkap suatu barang
 * Fitur: Responsive design, QR code display, item information, action buttons
 * 
 * Komponen yang ditampilkan:
 * - Page header dengan nama barang (responsive)
 * - Navigation buttons (Kembali, Edit)
 * - Detailed item information dalam card layout
 * - QR code display dengan copy function
 * - Room information dengan link
 * - Action buttons untuk edit dan delete
 * 
 * @author Sistem Manajemen Barang KPU
 * @version 1.0
 * @since August 2025
 */
--}}
@extends('layouts.app')

@section('title', 'Detail Barang - ' . $item->brand . ' ' . $item->type)

@section('content')
{{-- Page Header --}}
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="mb-0">
                    <i class="fas fa-box me-2 d-none d-md-inline"></i>
                    <span class="d-md-none">📦</span>
                    Detail Barang
                </h1>
                <!-- Desktop subtitle only -->
                <p class="lead mb-0 d-none d-md-block">{{ $item->brand }} - {{ $item->type }}</p>
            </div>
            <div class="col-auto">
                <div class="btn-group" role="group">
                    <a href="{{ route('items.index') }}" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left me-1 d-none d-md-inline"></i>
                        <span class="d-md-none">←</span>
                        <span class="d-none d-md-inline">Kembali</span>
                    </a>
                    <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit me-1 d-none d-md-inline"></i>
                        <span class="d-md-none">✏️</span>
                        <span class="d-none d-md-inline">Edit</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3">
    <div class="row g-3">
        <!-- Main Content Card - Mobile First -->
        <div class="col-12 col-lg-8 order-1">
            <div class="card">
                <div class="card-header bg-gradient-orange text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Informasi Barang
                    </h5>
                </div>
                <div class="card-body">
                    <!-- Mobile-optimized info display -->
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <div class="info-item border-bottom pb-2 mb-2">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <label class="form-label fw-bold text-muted small mb-1">
                                            <i class="fas fa-qrcode me-1"></i>Kode QR
                                        </label>
                                        <div class="d-flex align-items-center gap-2">
                                            <code class="bg-light p-2 rounded flex-grow-1 small text-break">{{ $item->qr_code }}</code>
                                            <button class="btn btn-outline-secondary btn-sm" onclick="copyToClipboard('{{ $item->qr_code }}')" title="Salin kode">
                                                <i class="fas fa-copy"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-6">
                            <div class="info-item border-bottom pb-2 mb-2">
                                <label class="form-label fw-bold text-muted small mb-1">
                                    <i class="fas fa-tag me-1"></i>Merk
                                </label>
                                <p class="mb-0 fw-bold text-primary fs-5">{{ $item->brand }}</p>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-6">
                            <div class="info-item border-bottom pb-2 mb-2">
                                <label class="form-label fw-bold text-muted small mb-1">
                                    <i class="fas fa-cube me-1"></i>Tipe
                                </label>
                                <p class="mb-0 fw-bold text-primary fs-5">{{ $item->type }}</p>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-6">
                            <div class="info-item border-bottom pb-2 mb-2">
                                <label class="form-label fw-bold text-muted small mb-1">
                                    <i class="fas fa-door-open me-1"></i>Ruangan
                                </label>
                                <div>
                                    @if($item->room)
                                        <a href="{{ route('rooms.show', $item->room->id) }}" class="text-decoration-none">
                                            <span class="badge bg-info fs-6 p-2">
                                                {{ $item->room->name }}
                                            </span>
                                        </a>
                                    @else
                                        <span class="text-muted">-</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description Section -->
                    @if($item->description)
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="info-item">
                                <label class="form-label fw-bold text-muted small mb-2">
                                    <i class="fas fa-align-left me-1"></i>Deskripsi
                                </label>
                                <div class="bg-light p-3 rounded">
                                    <p class="mb-0">{{ $item->description }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Timestamps Section -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <hr>
                            <div class="row g-2">
                                <div class="col-12 col-sm-6">
                                    <small class="text-muted d-block">
                                        <i class="fas fa-calendar-plus me-1"></i>
                                        <strong>Dibuat:</strong> {{ $item->created_at->format('d M Y, H:i') }}
                                    </small>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <small class="text-muted d-block">
                                        <i class="fas fa-calendar-edit me-1"></i>
                                        <strong>Diubah:</strong> {{ $item->updated_at->format('d M Y, H:i') }}
                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Sidebar - Mobile Responsive -->
        <div class="col-12 col-lg-4 order-2">
            <!-- QR Code Card -->
            <div class="card mb-3">
                <div class="card-header bg-gradient-red text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-qrcode me-2"></i>
                        QR Code
                    </h6>
                </div>
                <div class="card-body text-center p-3">
                    <div class="qr-container mb-3">
                        <canvas id="qrcode" class="d-inline-block mx-auto"></canvas>
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary btn-sm" onclick="downloadQR()">
                            <i class="fas fa-download me-1"></i>
                            <span class="d-none d-sm-inline">Download QR</span>
                            <span class="d-sm-none">Download</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Actions Card -->
            <div class="card">
                <div class="card-header bg-gradient-orange text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-cogs me-2"></i>
                        Aksi
                    </h6>
                </div>
                <div class="card-body p-3">
                    <div class="d-grid gap-2">
                        <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>
                            <span class="d-none d-sm-inline">Edit Barang</span>
                            <span class="d-sm-none">Edit</span>
                        </a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="fas fa-trash me-2"></i>
                            <span class="d-none d-sm-inline">Hapus Barang</span>
                            <span class="d-sm-none">Hapus</span>
                        </button>
                        <a href="{{ route('items.index') }}" class="btn btn-secondary">
                            <i class="fas fa-list me-2"></i>
                            <span class="d-none d-sm-inline">Daftar Barang</span>
                            <span class="d-sm-none">Daftar</span>
                        </a>
                        @if($item->room)
                        <a href="{{ route('rooms.show', $item->room->id) }}" class="btn btn-info">
                            <i class="fas fa-door-open me-2"></i>
                            <span class="d-none d-sm-inline">Lihat Ruangan</span>
                            <span class="d-sm-none">Ruangan</span>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Peringatan!</strong> Tindakan ini tidak dapat dibatalkan.
                </div>
                <p>Apakah Anda yakin ingin menghapus barang berikut?</p>
                <div class="bg-light p-3 rounded">
                    <strong>{{ $item->brand }}</strong> - {{ $item->type }}
                    <br>
                    <small class="text-muted">QR Code: {{ $item->qr_code }}</small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Batal
                </button>
                <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>Ya, Hapus Barang
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.1/build/qrcode.min.js"></script>
<script>
let qrCodeCanvasElement = null; // Global variable to store the QR code canvas

document.addEventListener('DOMContentLoaded', function() {
    // Generate QR Code
    const qrCodeContainer = document.getElementById('qrcode');
    
    if (qrCodeContainer) {
        QRCode.toCanvas(qrCodeContainer, '{{ $item->qr_code }}', {
            width: 150,
            height: 150,
            margin: 1,
            color: {
                dark: '#dc3545',
                light: '#ffffff'
            }
        }, function (error, canvas) { // Add 'canvas' parameter to the callback
            if (error) {
                console.error(error);
                qrCodeContainer.innerHTML = '<div class="text-muted"><i class="fas fa-exclamation-triangle"></i><br>Gagal generate QR</div>';
            } else {
                qrCodeCanvasElement = canvas; // Store the generated canvas
            }
        });
    }
});

function downloadQR() {
    if (!qrCodeCanvasElement) {
        showToast('QR Code tidak ditemukan untuk diunduh.', 'error');
        return;
    }

    const link = document.createElement('a');
    link.download = 'qr-{{ $item->qr_code }}.png';
    link.href = qrCodeCanvasElement.toDataURL('image/png');
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    showToast('QR Code berhasil diunduh!', 'success');
}

function copyToClipboard(text) {
    if (navigator.clipboard) {
        navigator.clipboard.writeText(text).then(function() {
            showToast('QR Code berhasil disalin!', 'success');
        }).catch(function() {
            // Fallback for older browsers
            const textArea = document.createElement('textarea');
            textArea.value = text;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
            showToast('QR Code disalin ke clipboard!', 'info');
        });
    } else {
        // Fallback if clipboard API is not available at all
        const textArea = document.createElement('textarea');
        textArea.value = text;
        document.body.appendChild(textArea);
        textArea.select();
        document.execCommand('copy');
        document.body.removeChild(textArea);
        showToast('QR Code disalin ke clipboard! (via fallback)', 'info');
    }
}
</script>
@endpush
