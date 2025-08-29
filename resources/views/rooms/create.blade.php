@extends('layouts.app')

@section('title', 'Tambah Ruangan - Sistem Manajemen Barang Kantor')

@section('content')
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="mb-0">
                    <i class="fas fa-plus-circle me-3"></i>
                    Tambah Ruangan Baru
                </h1>
                <p class="lead mb-0">Tambahkan ruangan baru ke dalam sistem</p>
            </div>
            <div class="col-auto">
                <a href="{{ route('rooms.index') }}" class="btn btn-light">
                    <i class="fas fa-arrow-left me-2"></i>
                    Kembali ke Daftar
                </a>
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
                        Form Tambah Ruangan
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('rooms.store') }}" method="POST" novalidate>
                        @csrf
                        
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
                                   value="{{ old('name') }}"
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
                                   value="{{ old('floor') }}"
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
                                      placeholder="Tambahan informasi tentang ruangan (kapasitas, fungsi, dsb)">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @else
                                <div class="invalid-feedback" id="description-error"></div>
                            @enderror
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('rooms.index') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i>
                                Batal
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-1"></i>
                                Simpan Ruangan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Help Card -->
            <div class="card mt-4">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-lightbulb me-2"></i>
                        Tips Penamaan Ruangan
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6><i class="fas fa-check text-success me-2"></i>Contoh Penamaan yang Baik</h6>
                            <ul class="list-unstyled small">
                                <li>• Ruang Meeting A</li>
                                <li>• Ruang IT</li>
                                <li>• Lobby Utama</li>
                                <li>• Ruang Direktur</li>
                                <li>• Storage Lantai 2</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6><i class="fas fa-info-circle text-info me-2"></i>Saran</h6>
                            <ul class="list-unstyled small">
                                <li>• Gunakan nama yang mudah diingat</li>
                                <li>• Tambahkan informasi lantai jika diperlukan</li>
                                <li>• Konsisten dengan penamaan</li>
                                <li>• Hindari nama yang terlalu panjang</li>
                            </ul>
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
