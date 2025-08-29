{{--
/**
 * Item Edit Page - Halaman Edit Barang
 * 
 * File: resources/views/items/edit.blade.php
 * Deskripsi: Form untuk mengedit data barang yang sudah ada
 * Fitur: Pre-filled form, validation, room change, responsive design
 * 
 * Komponen yang ditampilkan:
 * - Page header dengan nama barang yang diedit
 * - Form edit dengan data yang sudah terisi
 * - Room selection dengan current room highlighted
 * - Condition dan status update options
 * - Validation error display
 * - Save dan Cancel buttons
 * 
 * @author Sistem Manajemen Barang KPU
 * @version 1.0
 * @since August 2025
 */
--}}
@extends('layouts.app') {{-- Menggunakan layout aplikasi utama --}}

@section('title', 'Edit Barang - ' . $item->brand . ' ' . $item->type) {{-- Mengatur judul halaman dengan detail barang --}}

@section('content') {{-- Memulai bagian konten utama --}}
{{-- Bagian Header Halaman --}}
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                {{-- Judul halaman untuk tampilan edit barang --}}
                <h1 class="mb-0">
                    <i class="fas fa-edit me-3"></i>
                    Edit Barang
                </h1>
                {{-- Menampilkan merk dan tipe barang yang sedang diedit --}}
                <p class="lead mb-0">{{ $item->brand }} - {{ $item->type }}</p>
            </div>
            <div class="col-auto">
                {{-- Grup tombol aksi (Kembali ke detail barang atau daftar barang) --}}
                <div class="btn-group" role="group">
                    <a href="{{ route('items.show', $item->id) }}" class="btn btn-light">
                        <i class="fas fa-arrow-left me-2"></i>
                        Kembali
                    </a>
                    <a href="{{ route('items.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-list me-2"></i>
                        Daftar Barang
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                {{-- Header card form --}}
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-form me-2"></i>
                        Form Edit Barang
                    </h5>
                </div>
                <div class="card-body">
                    {{-- Form untuk mengedit data barang --}}
                    <form action="{{ route('items.update', $item->id) }}" method="POST" novalidate>
                        @csrf {{-- Token CSRF untuk keamanan form --}}
                        @method('PUT') {{-- Metode PUT untuk update resource --}}
                        
                        {{-- Input untuk Kode QR --}}
                        <div class="mb-3">
                            <label for="qr_code" class="form-label">
                                <i class="fas fa-qrcode me-1"></i>
                                Kode QR <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('qr_code') is-invalid @enderror" 
                                   id="qr_code" 
                                   name="qr_code" 
                                   value="{{ old('qr_code', $item->qr_code) }}" {{-- Mengisi nilai lama atau dari data barang --}}
                                   placeholder="Masukkan kode QR barang"
                                   required
                                   maxlength="255">
                            {{-- Menampilkan pesan error validasi untuk qr_code --}}
                            @error('qr_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <div class="invalid-feedback" id="qr_code-error"></div>
                            @enderror
                            {{-- Teks informasi tambahan untuk Kode QR --}}
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Kode QR harus unik untuk setiap barang
                            </div>
                        </div>

                        {{-- Input untuk Merk Barang --}}
                        <div class="mb-3">
                            <label for="brand" class="form-label">
                                <i class="fas fa-tag me-1"></i>
                                Merk Barang <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('brand') is-invalid @enderror" 
                                   id="brand" 
                                   name="brand" 
                                   value="{{ old('brand', $item->brand) }}" {{-- Mengisi nilai lama atau dari data barang --}}
                                   placeholder="Contoh: Dell, HP, Canon, dsb"
                                   required
                                   maxlength="255">
                            {{-- Menampilkan pesan error validasi untuk brand --}}
                            @error('brand')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <div class="invalid-feedback" id="brand-error"></div>
                            @enderror
                        </div>

                        {{-- Input untuk Tipe Barang --}}
                        <div class="mb-3">
                            <label for="type" class="form-label">
                                <i class="fas fa-cube me-1"></i>
                                Tipe Barang <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('type') is-invalid @enderror" 
                                   id="type" 
                                   name="type" 
                                   value="{{ old('type', $item->type) }}" {{-- Mengisi nilai lama atau dari data barang --}}
                                   placeholder="Contoh: Laptop, Printer, Monitor, dsb"
                                   required
                                   maxlength="255">
                            {{-- Menampilkan pesan error validasi untuk type --}}
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <div class="invalid-feedback" id="type-error"></div>
                            @enderror
                        </div>

                        {{-- Dropdown pilihan Ruangan --}}
                        <div class="mb-3">
                            <label for="room_id" class="form-label">
                                <i class="fas fa-door-open me-1"></i>
                                Ruangan <span class="text-danger">*</span>
                            </label>
                            <select class="form-select @error('room_id') is-invalid @enderror" 
                                    id="room_id" 
                                    name="room_id" 
                                    required>
                                <option value="">Pilih ruangan...</option>
                                {{-- Loop untuk menampilkan daftar ruangan --}}
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}" 
                                            {{ old('room_id', $item->room_id) == $room->id ? 'selected' : '' }}> {{-- Menandai ruangan yang dipilih sebelumnya --}}
                                        {{ $room->name }}
                                        @if($room->floor) - {{ $room->floor }} @endif {{-- Menampilkan lantai jika ada --}}
                                    </option>
                                @endforeach
                            </select>
                            {{-- Menampilkan pesan error validasi untuk room_id --}}
                            @error('room_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <div class="invalid-feedback" id="room_id-error"></div>
                            @enderror
                        </div>

                        {{-- Input untuk Deskripsi Barang --}}
                        <div class="mb-4">
                            <label for="description" class="form-label">
                                <i class="fas fa-align-left me-1"></i>
                                Deskripsi <span class="text-muted">(Opsional)</span>
                            </label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="3"
                                      placeholder="Tambahan informasi tentang barang (kondisi, spesifikasi, dsb)">{{ old('description', $item->description) }}</textarea> {{-- Mengisi nilai lama atau dari data barang --}}
                            {{-- Menampilkan pesan error validasi untuk description --}}
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <div class="invalid-feedback" id="description-error"></div>
                            @enderror
                        </div>

                        {{-- Tombol Aksi (Batal dan Update) --}}
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('items.show', $item->id) }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i>
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>
                                Update Barang
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            {{-- Card Informasi Tambahan --}}
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Informasi Tambahan
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        {{-- Waktu penambahan barang --}}
                        <div class="col-md-6">
                            <h6 class="text-muted">
                                <i class="fas fa-calendar-plus me-2"></i>
                                Ditambahkan
                            </h6>
                            <p class="mb-0">{{ $item->created_at->format('d M Y, H:i') }}</p>
                            <small class="text-muted">{{ $item->created_at->diffForHumans() }}</small>
                        </div>
                        {{-- Waktu terakhir update barang --}}
                        <div class="col-md-6">
                            <h6 class="text-muted">
                                <i class="fas fa-edit me-2"></i>
                                Terakhir Diupdate
                            </h6>
                            <p class="mb-0">{{ $item->updated_at->format('d M Y, H:i') }}</p>
                            <small class="text-muted">{{ $item->updated_at->diffForHumans() }}</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection {{-- Mengakhiri bagian konten utama --}}

@push('scripts') {{-- Memulai bagian JavaScript --}}
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Mendapatkan referensi elemen-elemen form
    const qrCodeInput = document.getElementById('qr_code');
    const brandInput = document.getElementById('brand');
    const typeInput = document.getElementById('type');
    const roomSelect = document.getElementById('room_id');
    const descriptionInput = document.getElementById('description');
    const form = document.querySelector('form');

    // Fungsi helper untuk menampilkan pesan error validasi
    function showValidationError(inputElement, message) {
        inputElement.classList.add('is-invalid'); // Menambah kelas styling error
        const errorElement = document.getElementById(inputElement.id + '-error');
        if (errorElement) {
            errorElement.textContent = message; // Menampilkan pesan error
        }
    }

    // Fungsi helper untuk menghapus pesan error validasi
    function clearValidationError(inputElement) {
        inputElement.classList.remove('is-invalid'); // Menghapus kelas styling error
        const errorElement = document.getElementById(inputElement.id + '-error');
        if (errorElement) {
            errorElement.textContent = ''; // Mengosongkan pesan error
        }
    }

    // Menambahkan event listener untuk validasi real-time saat input berubah
    // Validasi untuk Kode QR
    qrCodeInput.addEventListener('input', function() {
        if (qrCodeInput.value.trim() === '') {
            showValidationError(qrCodeInput, 'Kode QR wajib diisi.');
        } else if (qrCodeInput.value.length > 255) {
            showValidationError(qrCodeInput, 'Kode QR tidak boleh lebih dari 255 karakter.');
        } else {
            clearValidationError(qrCodeInput);
        }
    });

    // Validasi untuk Merk Barang
    brandInput.addEventListener('input', function() {
        if (brandInput.value.trim() === '') {
            showValidationError(brandInput, 'Merk barang wajib diisi.');
        } else if (brandInput.value.length > 255) {
            showValidationError(brandInput, 'Merk barang tidak boleh lebih dari 255 karakter.');
        } else {
            clearValidationError(brandInput);
        }
    });

    // Validasi untuk Tipe Barang
    typeInput.addEventListener('input', function() {
        if (typeInput.value.trim() === '') {
            showValidationError(typeInput, 'Tipe barang wajib diisi.');
        } else if (typeInput.value.length > 255) {
            showValidationError(typeInput, 'Tipe barang tidak boleh lebih dari 255 karakter.');
        } else {
            clearValidationError(typeInput);
        }
    });

    // Validasi untuk pilihan Ruangan
    roomSelect.addEventListener('change', function() {
        if (roomSelect.value === '') {
            showValidationError(roomSelect, 'Ruangan wajib dipilih.');
        } else {
            clearValidationError(roomSelect);
        }
    });

    // Validasi untuk Deskripsi Barang
    descriptionInput.addEventListener('input', function() {
        // Deskripsi bersifat opsional, validasi hanya jika diisi dan melebihi panjang maksimum
        if (descriptionInput.value.length > 0 && descriptionInput.value.length > 1000) { // Diasumsikan panjang maksimal 1000 karakter
            showValidationError(descriptionInput, 'Deskripsi tidak boleh lebih dari 1000 karakter.');
        } else {
            clearValidationError(descriptionInput);
        }
    });

    // Validasi form saat disubmit
    form.addEventListener('submit', function(e) {
        let isValid = true; // Flag untuk status validasi form

        // Memicu validasi manual untuk semua field saat submit
        // Validasi Kode QR
        if (qrCodeInput.value.trim() === '') {
            showValidationError(qrCodeInput, 'Kode QR wajib diisi.');
            isValid = false;
        } else if (qrCodeInput.value.length > 255) {
            showValidationError(qrCodeInput, 'Kode QR tidak boleh lebih dari 255 karakter.');
            isValid = false;
        } else {
            clearValidationError(qrCodeInput);
        }

        // Validasi Merk Barang
        if (brandInput.value.trim() === '') {
            showValidationError(brandInput, 'Merk barang wajib diisi.');
            isValid = false;
        } else if (brandInput.value.length > 255) {
            showValidationError(brandInput, 'Merk barang tidak boleh lebih dari 255 karakter.');
            isValid = false;
        } else {
            clearValidationError(brandInput);
        }

        // Validasi Tipe Barang
        if (typeInput.value.trim() === '') {
            showValidationError(typeInput, 'Tipe barang wajib diisi.');
            isValid = false;
        } else if (typeInput.value.length > 255) {
            showValidationError(typeInput, 'Tipe barang tidak boleh lebih dari 255 karakter.');
            isValid = false;
        } else {
            clearValidationError(typeInput);
        }

        // Validasi Pilihan Ruangan
        if (roomSelect.value === '') {
            showValidationError(roomSelect, 'Ruangan wajib dipilih.');
            isValid = false;
        } else {
            clearValidationError(roomSelect);
        }

        // Validasi Deskripsi Barang
        if (descriptionInput.value.length > 0 && descriptionInput.value.length > 1000) {
            showValidationError(descriptionInput, 'Deskripsi tidak boleh lebih dari 1000 karakter.');
            isValid = false;
        } else {
            clearValidationError(descriptionInput);
        }

        // Jika ada input yang tidak valid, cegah pengiriman form dan scroll ke field pertama yang invalid
        if (!isValid) {
            e.preventDefault(); // Mencegah pengiriman form
            // Scroll ke field yang pertama kali tidak valid
            const firstInvalid = document.querySelector('.is-invalid');
            if (firstInvalid) {
                firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    });
    
    // Menyimpan nilai QR Code asli untuk konfirmasi perubahan
    const originalQrCode = '{{ $item->qr_code }}';
    
    // Menambahkan event listener untuk konfirmasi perubahan Kode QR
    qrCodeInput.addEventListener('change', function() {
        if (this.value !== originalQrCode && this.value.trim() !== '') {
            // Menampilkan konfirmasi kepada pengguna jika kode QR diubah
            const confirmChange = window.confirm('Anda mengubah kode QR. Pastikan kode QR baru ini benar dan unik.');
            if (!confirmChange) {
                this.value = originalQrCode; // Mengembalikan nilai asli jika tidak dikonfirmasi
                clearValidationError(this); // Menghapus pesan validasi jika input dikembalikan
            }
        }
    });
});
</script>
@endpush {{-- Mengakhiri bagian JavaScript --}}
