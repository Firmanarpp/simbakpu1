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
@extends('layouts.app') {{-- Menggunakan layout aplikasi utama --}}

@section('title', 'Detail Barang - ' . $item->brand . ' ' . $item->type) {{-- Mengatur judul halaman dengan detail barang --}}

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
                    Detail Barang
                </h1>
                {{-- Subjudul untuk desktop: Menampilkan merk dan tipe barang --}}
                <p class="lead mb-0 d-none d-md-block">{{ $item->brand }} - {{ $item->type }}</p>
            </div>
            <div class="col-auto">
                {{-- Grup tombol navigasi (Kembali dan Edit) --}}
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
        {{-- Kolom utama konten detail barang --}}
        <div class="col-12 col-lg-8 order-1">
            <div class="card">
                {{-- Header card informasi barang --}}
                <div class="card-header bg-gradient-orange text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Informasi Barang
                    </h5>
                </div>
                <div class="card-body">
                    {{-- Tampilan informasi yang dioptimalkan untuk mobile --}}
                    <div class="row g-3">
                        {{-- Bagian Kode QR --}}
                        <div class="col-12 col-md-6">
                            <div class="info-item border-bottom pb-2 mb-2">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <label class="form-label fw-bold text-muted small mb-1">
                                            <i class="fas fa-qrcode me-1"></i>Kode QR
                                        </label>
                                        <div class="d-flex align-items-center gap-2">
                                            <code class="bg-light p-2 rounded flex-grow-1 small text-break">{{ $item->qr_code }}</code>
                                            {{-- Tombol untuk menyalin kode QR ke clipboard --}}
                                            <button class="btn btn-outline-secondary btn-sm" onclick="copyToClipboard('{{ $item->qr_code }}')" title="Salin kode">
                                                <i class="fas fa-copy"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        {{-- Bagian Merk Barang --}}
                        <div class="col-12 col-md-6">
                            <div class="info-item border-bottom pb-2 mb-2">
                                <label class="form-label fw-bold text-muted small mb-1">
                                    <i class="fas fa-tag me-1"></i>Merk
                                </label>
                                <p class="mb-0 fw-bold text-primary fs-5">{{ $item->brand }}</p>
                            </div>
                        </div>
                        
                        {{-- Bagian Tipe Barang --}}
                        <div class="col-12 col-md-6">
                            <div class="info-item border-bottom pb-2 mb-2">
                                <label class="form-label fw-bold text-muted small mb-1">
                                    <i class="fas fa-cube me-1"></i>Tipe
                                </label>
                                <p class="mb-0 fw-bold text-primary fs-5">{{ $item->type }}</p>
                            </div>
                        </div>
                        
                        {{-- Bagian Ruangan --}}
                        <div class="col-12 col-md-6">
                            <div class="info-item border-bottom pb-2 mb-2">
                                <label class="form-label fw-bold text-muted small mb-1">
                                    <i class="fas fa-door-open me-1"></i>Ruangan
                                </label>
                                <div>
                                    @if($item->room)
                                        {{-- Link ke detail ruangan --}}
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

                    {{-- Bagian Deskripsi --}}
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

                    {{-- Bagian Timestamp (Dibuat dan Diubah) --}}
                    <div class="row mt-3">
                        <div class="col-12">
                            <hr>
                            <div class="row g-2">
                                {{-- Waktu pembuatan barang --}}
                                <div class="col-12 col-sm-6">
                                    <small class="text-muted d-block">
                                        <i class="fas fa-calendar-plus me-1"></i>
                                        <strong>Dibuat:</strong> {{ $item->created_at->format('d M Y, H:i') }}
                                    </small>
                                </div>
                                {{-- Waktu terakhir update barang --}}
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

        {{-- Kolom sidebar untuk aksi (QR Code dan Tombol Aksi) --}}
        <div class="col-12 col-lg-4 order-2">
            {{-- Card QR Code --}}
            <div class="card mb-3">
                <div class="card-header bg-gradient-red text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-qrcode me-2"></i>
                        QR Code
                    </h6>
                </div>
                <div class="card-body text-center p-3">
                    {{-- Container untuk canvas QR Code --}}
                    <div class="qr-container mb-3">
                        <canvas id="qrcode" class="d-inline-block mx-auto"></canvas>
                    </div>
                    {{-- Tombol Download QR Code --}}
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary btn-sm" onclick="downloadQR()">
                            <i class="fas fa-download me-1"></i>
                            <span class="d-none d-sm-inline">Download QR</span>
                            <span class="d-sm-none">Download</span>
                        </button>
                    </div>
                </div>
            </div>

            {{-- Card Aksi --}}
            <div class="card">
                <div class="card-header bg-gradient-orange text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-cogs me-2"></i>
                        Aksi
                    </h6>
                </div>
                <div class="card-body p-3">
                    <div class="d-grid gap-2">
                        {{-- Tombol Edit Barang --}}
                        <a href="{{ route('items.edit', $item->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>
                            <span class="d-none d-sm-inline">Edit Barang</span>
                            <span class="d-sm-none">Edit</span>
                        </a>
                        {{-- Tombol Hapus Barang (memicu modal konfirmasi) --}}
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="fas fa-trash me-2"></i>
                            <span class="d-none d-sm-inline">Hapus Barang</span>
                            <span class="d-sm-none">Hapus</span>
                        </button>
                        {{-- Tombol untuk melihat daftar barang --}}
                        <a href="{{ route('items.index') }}" class="btn btn-secondary">
                            <i class="fas fa-list me-2"></i>
                            <span class="d-none d-sm-inline">Daftar Barang</span>
                            <span class="d-sm-none">Daftar</span>
                        </a>
                        {{-- Tombol untuk melihat detail ruangan jika barang terkait dengan ruangan --}}
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

{{-- Modal Konfirmasi Hapus --}}
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                {{-- Peringatan bahwa tindakan tidak dapat dibatalkan --}}
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Peringatan!</strong> Tindakan ini tidak dapat dibatalkan.
                </div>
                <p>Apakah Anda yakin ingin menghapus barang berikut?</p>
                {{-- Detail barang yang akan dihapus --}}
                <div class="bg-light p-3 rounded">
                    <strong>{{ $item->brand }}</strong> - {{ $item->type }}
                    <br>
                    <small class="text-muted">QR Code: {{ $item->qr_code }}</small>
                </div>
            </div>
            <div class="modal-footer">
                {{-- Tombol Batal --}}
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Batal
                </button>
                {{-- Form untuk mengirim permintaan DELETE --}}
                <form action="{{ route('items.destroy', $item->id) }}" method="POST" class="d-inline">
                    @csrf {{-- Token CSRF untuk keamanan form --}}
                    @method('DELETE') {{-- Metode DELETE untuk menghapus resource --}}
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>Ya, Hapus Barang
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection {{-- Mengakhiri bagian konten utama --}}

@push('scripts') {{-- Memulai bagian JavaScript --}}
<script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.1/build/qrcode.min.js"></script> {{-- Memuat library QRCode.js --}}
<script>
let qrCodeCanvasElement = null; // Variabel global untuk menyimpan elemen canvas QR code yang digenerate

document.addEventListener('DOMContentLoaded', function() {
    // Menginisialisasi Tooltips Bootstrap
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // Menggenerate QR Code saat DOM dimuat
    const qrCodeContainer = document.getElementById('qrcode');
    
    if (qrCodeContainer) {
        QRCode.toCanvas(qrCodeContainer, '{{ $item->qr_code }}', { // Menggenerate QR code ke dalam elemen canvas
            width: 150,
            height: 150,
            margin: 1,
            color: {
                dark: '#dc3545', // Warna gelap QR code (merah)
                light: '#ffffff' // Warna terang QR code (putih)
            }
        }, function (error, canvas) { // Callback setelah QR code digenerate
            if (error) {
                console.error(error);
                // Menampilkan pesan error jika gagal generate QR
                qrCodeContainer.innerHTML = '<div class="text-muted"><i class="fas fa-exclamation-triangle"></i><br>Gagal generate QR</div>';
            } else {
                qrCodeCanvasElement = canvas; // Menyimpan elemen canvas yang digenerate
            }
        });
    }
});

// Fungsi untuk mengunduh QR Code sebagai gambar PNG
function downloadQR() {
    if (!qrCodeCanvasElement) {
        showToast('QR Code tidak ditemukan untuk diunduh.', 'error'); // Menampilkan pesan toast jika QR tidak ada
        return;
    }

    const link = document.createElement('a'); // Membuat elemen tautan
    link.download = 'qr-{{ $item->qr_code }}.png'; // Nama file unduhan
    link.href = qrCodeCanvasElement.toDataURL('image/png'); // Mengatur href ke data URL gambar PNG
    document.body.appendChild(link); // Menambahkan tautan ke body dokumen
    link.click(); // Memicu klik untuk mengunduh
    document.body.removeChild(link); // Menghapus tautan dari body
    showToast('QR Code berhasil diunduh!', 'success'); // Menampilkan pesan sukses
}

// Fungsi untuk menyalin teks ke clipboard
function copyToClipboard(text) {
    // Menggunakan Clipboard API modern jika tersedia
    if (navigator.clipboard) {
        navigator.clipboard.writeText(text).then(function() {
            showToast('QR Code berhasil disalin!', 'success'); // Menampilkan pesan sukses
        }).catch(function() {
            // Fallback untuk browser lama jika Clipboard API gagal
            const textArea = document.createElement('textarea');
            textArea.value = text;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy'); // Eksekusi perintah copy
            document.body.removeChild(textArea);
            showToast('QR Code disalin ke clipboard! (via fallback)', 'info');
        });
    } else {
        // Fallback jika Clipboard API sama sekali tidak tersedia
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
@endpush {{-- Mengakhiri bagian JavaScript --}}
