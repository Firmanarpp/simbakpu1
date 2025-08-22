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
@extends('layouts.app')

@section('title', 'Edit Barang - ' . $item->brand . ' ' . $item->type)

@section('content')
{{-- Page Header --}}
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="mb-0">
                    <i class="fas fa-edit me-3"></i>
                    Edit Barang
                </h1>
                <p class="lead mb-0">{{ $item->brand }} - {{ $item->type }}</p>
            </div>
            <div class="col-auto">
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
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-form me-2"></i>
                        Form Edit Barang
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('items.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- QR Code -->
                        <div class="mb-3">
                            <label for="qr_code" class="form-label">
                                <i class="fas fa-qrcode me-1"></i>
                                Kode QR <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('qr_code') is-invalid @enderror" 
                                   id="qr_code" 
                                   name="qr_code" 
                                   value="{{ old('qr_code', $item->qr_code) }}"
                                   placeholder="Masukkan kode QR barang"
                                   required>
                            @error('qr_code')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Kode QR harus unik untuk setiap barang
                            </div>
                        </div>

                        <!-- Brand -->
                        <div class="mb-3">
                            <label for="brand" class="form-label">
                                <i class="fas fa-tag me-1"></i>
                                Merk Barang <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('brand') is-invalid @enderror" 
                                   id="brand" 
                                   name="brand" 
                                   value="{{ old('brand', $item->brand) }}"
                                   placeholder="Contoh: Dell, HP, Canon, dsb"
                                   required>
                            @error('brand')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Type -->
                        <div class="mb-3">
                            <label for="type" class="form-label">
                                <i class="fas fa-cube me-1"></i>
                                Tipe Barang <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('type') is-invalid @enderror" 
                                   id="type" 
                                   name="type" 
                                   value="{{ old('type', $item->type) }}"
                                   placeholder="Contoh: Laptop, Printer, Monitor, dsb"
                                   required>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Room -->
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
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}" 
                                            {{ old('room_id', $item->room_id) == $room->id ? 'selected' : '' }}>
                                        {{ $room->name }}
                                        @if($room->floor) - {{ $room->floor }} @endif
                                    </option>
                                @endforeach
                            </select>
                            @error('room_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="form-label">
                                <i class="fas fa-align-left me-1"></i>
                                Deskripsi <span class="text-muted">(Opsional)</span>
                            </label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" 
                                      name="description" 
                                      rows="3"
                                      placeholder="Tambahan informasi tentang barang (kondisi, spesifikasi, dsb)">{{ old('description', $item->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
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
            
            <!-- Info Card -->
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Informasi Tambahan
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6 class="text-muted">
                                <i class="fas fa-calendar-plus me-2"></i>
                                Ditambahkan
                            </h6>
                            <p class="mb-0">{{ $item->created_at->format('d M Y, H:i') }}</p>
                            <small class="text-muted">{{ $item->created_at->diffForHumans() }}</small>
                        </div>
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
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Form validation
    const form = document.querySelector('form');
    const roomSelect = document.getElementById('room_id');
    
    form.addEventListener('submit', function(e) {
        if (roomSelect.value === '') {
            e.preventDefault();
            alert('Silakan pilih ruangan terlebih dahulu!');
            roomSelect.focus();
        }
    });
    
    // Show confirmation for important changes
    const qrCodeInput = document.getElementById('qr_code');
    const originalQrCode = '{{ $item->qr_code }}';
    
    qrCodeInput.addEventListener('change', function() {
        if (this.value !== originalQrCode && this.value !== '') {
            const confirm = window.confirm('Anda mengubah kode QR. Pastikan kode QR baru ini benar dan unik.');
            if (!confirm) {
                this.value = originalQrCode;
            }
        }
    });
});
</script>
@endpush
