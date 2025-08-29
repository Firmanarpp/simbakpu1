{{--
/**
 * Room Edit Page - Halaman Edit Ruangan
 *
 * File: resources/views/rooms/edit.blade.php
 * Deskripsi: Form untuk mengedit data ruangan yang sudah ada
 * Fitur: Pre-filled form, validation, responsive design
 *
 * Komponen yang ditampilkan:
 * - Page header dengan nama ruangan yang diedit
 * - Form edit dengan data yang sudah terisi
 * - Validation error display
 * - Save dan Cancel buttons
 *
 * @author Sistem Manajemen Barang KPU
 * @version 1.0
 * @since August 2025
 */
--}}
@extends('layouts.app')

@section('title', 'Edit Ruangan - ' . $room->name)

@section('content')
{{-- Page Header --}}
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="mb-0">
                    <i class="fas fa-edit me-3"></i>
                    Edit Ruangan
                </h1>
                <p class="lead mb-0">{{ $room->name }}</p>
            </div>
            <div class="col-auto">
                <div class="btn-group" role="group">
                    <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-light">
                        <i class="fas fa-arrow-left me-2"></i>
                        Kembali
                    </a>
                    <a href="{{ route('rooms.index') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-list me-2"></i>
                        Daftar Ruangan
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
                        Form Edit Ruangan
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('rooms.update', $room->id) }}" method="POST" novalidate>
                        @csrf
                        @method('PUT')
                        
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                <i class="fas fa-door-open me-1"></i>
                                Nama Ruangan <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', $room->name) }}"
                                   placeholder="Contoh: Ruang Meeting A, Ruang IT, Lobby, dsb"
                                   required
                                   maxlength="255">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <div class="invalid-feedback" id="name-error"></div>
                            @enderror
                        </div>

                        <!-- Floor -->
                        <div class="mb-3">
                            <label for="floor" class="form-label">
                                <i class="fas fa-building me-1"></i>
                                Lantai <span class="text-muted">(Opsional)</span>
                            </label>
                            <input type="text" 
                                   class="form-control @error('floor') is-invalid @enderror" 
                                   id="floor" 
                                   name="floor" 
                                   value="{{ old('floor', $room->floor) }}"
                                   placeholder="Contoh: Lantai 1, Lantai 2, Basement, dsb"
                                   maxlength="255">
                            @error('floor')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <div class="invalid-feedback" id="floor-error"></div>
                            @enderror
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Informasi lantai untuk memudahkan lokasi ruangan
                            </div>
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
                                      placeholder="Tambahan informasi tentang ruangan (kapasitas, fungsi, dsb)">{{ old('description', $room->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <div class="invalid-feedback" id="description-error"></div>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('rooms.show', $room->id) }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i>
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>
                                Update Ruangan
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
                            <p class="mb-0">{{ $room->created_at->format('d M Y, H:i') }}</p>
                            <small class="text-muted">{{ $room->created_at->diffForHumans() }}</small>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">
                                <i class="fas fa-edit me-2"></i>
                                Terakhir Diupdate
                            </h6>
                            <p class="mb-0">{{ $room->updated_at->format('d M Y, H:i') }}</p>
                            <small class="text-muted">{{ $room->updated_at->diffForHumans() }}</small>
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
    // Pastikan DOM sudah dimuat sepenuhnya sebelum menjalankan skrip
    document.addEventListener('DOMContentLoaded', function() {
        // Mendapatkan referensi ke elemen input form
        const nameInput = document.getElementById('name');
        const floorInput = document.getElementById('floor');
        const descriptionInput = document.getElementById('description');
        const form = document.querySelector('form');

        // Fungsi helper untuk menampilkan pesan error validasi
        function showValidationError(inputElement, message) {
            inputElement.classList.add('is-invalid'); // Tambah kelas untuk styling error
            const errorElement = document.getElementById(inputElement.id + '-error');
            if (errorElement) {
                errorElement.textContent = message; // Tampilkan pesan error
            }
        }

        // Fungsi helper untuk menghapus pesan error validasi
        function clearValidationError(inputElement) {
            inputElement.classList.remove('is-invalid'); // Hapus kelas styling error
            const errorElement = document.getElementById(inputElement.id + '-error');
            if (errorElement) {
                errorElement.textContent = ''; // Kosongkan pesan error
            }
        }

        // Menambahkan listener untuk validasi real-time saat input berubah
        // Validasi untuk input Nama Ruangan
        nameInput.addEventListener('input', function() {
            if (nameInput.value.trim() === '') {
                showValidationError(nameInput, 'Nama ruangan wajib diisi.');
            } else if (nameInput.value.length > 255) {
                showValidationError(nameInput, 'Nama ruangan tidak boleh lebih dari 255 karakter.');
            } else {
                clearValidationError(nameInput);
            }
        });

        // Validasi untuk input Lantai
        floorInput.addEventListener('input', function() {
            if (floorInput.value.length > 255) {
                showValidationError(floorInput, 'Lantai tidak boleh lebih dari 255 karakter.');
            } else {
                clearValidationError(floorInput);
            }
        });

        // Validasi untuk input Deskripsi
        descriptionInput.addEventListener('input', function() {
            if (descriptionInput.value.length > 0 && descriptionInput.value.length > 1000) {
                showValidationError(descriptionInput, 'Deskripsi tidak boleh lebih dari 1000 karakter.');
            } else {
                clearValidationError(descriptionInput);
            }
        });
        
        // Data untuk saran otomatis pada input Lantai
        const suggestions = ['Lantai 1', 'Lantai 2', 'Lantai 3', 'Ground Floor', 'Basement'];
        
        // Membuat elemen datalist untuk saran lantai
        const datalist = document.createElement('datalist');
        datalist.id = 'floor-suggestions';
        suggestions.forEach(suggestion => {
            const option = document.createElement('option');
            option.value = suggestion;
            datalist.appendChild(option);
        });
        // Menambahkan datalist ke body dokumen
        document.body.appendChild(datalist);
        // Mengaitkan datalist dengan input Lantai
        floorInput.setAttribute('list', 'floor-suggestions');

        // Validasi saat form disubmit
        form.addEventListener('submit', function(e) {
            let isValid = true; // Flag untuk status validasi form

            // Validasi akhir untuk Nama Ruangan
            if (nameInput.value.trim() === '') {
                showValidationError(nameInput, 'Nama ruangan wajib diisi.');
                isValid = false;
            } else if (nameInput.value.length > 255) {
                showValidationError(nameInput, 'Nama ruangan tidak boleh lebih dari 255 karakter.');
                isValid = false;
            } else {
                clearValidationError(nameInput);
            }

            // Validasi akhir untuk Lantai
            if (floorInput.value.length > 255) {
                showValidationError(floorInput, 'Lantai tidak boleh lebih dari 255 karakter.');
                isValid = false;
            } else {
                clearValidationError(floorInput);
            }

            // Validasi akhir untuk Deskripsi
            if (descriptionInput.value.length > 0 && descriptionInput.value.length > 1000) {
                showValidationError(descriptionInput, 'Deskripsi tidak boleh lebih dari 1000 karakter.');
                isValid = false;
            } else {
                clearValidationError(descriptionInput);
            }

            // Jika ada input yang tidak valid, cegah form untuk disubmit dan scroll ke input pertama yang bermasalah
            if (!isValid) {
                e.preventDefault(); // Mencegah pengiriman form
                const firstInvalid = document.querySelector('.is-invalid');
                if (firstInvalid) {
                    firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' }); // Scroll ke elemen yang tidak valid
                }
            }
        });
    });
</script>
@endpush
