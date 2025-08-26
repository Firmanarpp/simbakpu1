


<?php $__env->startSection('title', 'Tambah Barang - Sistem Manajemen Barang Kantor'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="mb-0">
                    <i class="fas fa-plus-circle me-2 d-none d-md-inline"></i>
                    <span class="d-md-none">➕</span>
                    Tambah Barang
                </h1>
                <p class="lead mb-0 d-none d-md-block">Tambahkan barang baru ke dalam sistem inventori</p>
                <p class="mb-0 d-md-none"><small>Tambah barang baru</small></p>
            </div>
            <div class="col-auto">
                <a href="<?php echo e(route('items.index')); ?>" class="btn btn-light btn-sm">
                    <i class="fas fa-arrow-left me-1 d-none d-sm-inline"></i>
                    <span class="d-sm-none">←</span>
                    <span class="d-none d-sm-inline">Kembali</span>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-8">
            <div class="card">
                <div class="card-header bg-gradient-maroon text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-form me-2"></i>
                        Form Tambah Barang
                    </h5>
                </div>
                <div class="card-body p-3">
                    <?php if(session('info')): ?>
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <i class="fas fa-info-circle me-2"></i>
                            <span class="d-none d-sm-inline"><?php echo e(session('info')); ?></span>
                            <span class="d-sm-none"><?php echo e(Str::limit(session('info'), 40)); ?></span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <?php if(isset($qrCode) && $qrCode): ?>
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-qrcode me-2"></i>
                            <strong class="d-none d-sm-inline">QR Code dari Scan:</strong>
                            <strong class="d-sm-none">QR Scan:</strong> 
                            <code><?php echo e($qrCode); ?></code>
                            <br class="d-none d-sm-block">
                            <small class="d-none d-sm-inline">Kode QR sudah terisi otomatis dari hasil scan. Silakan lengkapi data barang lainnya.</small>
                            <small class="d-sm-none">Lengkapi data lainnya</small>
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    <?php endif; ?>
                    
                    <form action="<?php echo e(route('items.store')); ?>" method="POST" novalidate>
                        <?php echo csrf_field(); ?>
                        
                        <!-- QR Code -->
                        <div class="mb-3">
                            <label for="qr_code" class="form-label">
                                <i class="fas fa-qrcode me-1"></i>
                                Kode QR <span class="text-danger">*</span>
                            </label>
                            <div class="input-group">
                                <input type="text" 
                                       class="form-control <?php $__errorArgs = ['qr_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       id="qr_code" 
                                       name="qr_code" 
                                       value="<?php echo e(old('qr_code', $qrCode ?? '')); ?>"
                                       placeholder="Masukkan kode QR barang"
                                       required
                                       maxlength="255">
                                <button class="btn btn-outline-maroon" 
                                        type="button" 
                                        id="qr-scan-btn"
                                        onclick="openQRScanner()"
                                        title="Scan QR Code">
                                    <i class="fas fa-camera"></i>
                                    <span class="d-none d-sm-inline ms-1">Scan</span>
                                </button>
                            </div>
                            <?php $__errorArgs = ['qr_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php else: ?>
                                <div class="invalid-feedback" id="qr_code-error"></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <div class="form-text">
                                <i class="fas fa-info-circle me-1"></i>
                                Kode QR harus unik untuk setiap barang. 
                                <strong>Klik tombol "Scan" untuk menggunakan kamera</strong>
                            </div>
                        </div>

                        <!-- Brand -->
                        <div class="mb-3">
                            <label for="brand" class="form-label">
                                <i class="fas fa-tag me-1"></i>
                                Merk Barang <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control <?php $__errorArgs = ['brand'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   id="brand" 
                                   name="brand" 
                                   value="<?php echo e(old('brand')); ?>"
                                   placeholder="Contoh: Dell, HP, Canon, dsb"
                                   required
                                   maxlength="255">
                            <?php $__errorArgs = ['brand'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php else: ?>
                                <div class="invalid-feedback" id="brand-error"></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Type -->
                        <div class="mb-3">
                            <label for="type" class="form-label">
                                <i class="fas fa-cube me-1"></i>
                                Tipe Barang <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   id="type" 
                                   name="type" 
                                   value="<?php echo e(old('type')); ?>"
                                   placeholder="Contoh: Laptop, Printer, Monitor, dsb"
                                   required
                                   maxlength="255">
                            <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php else: ?>
                                <div class="invalid-feedback" id="type-error"></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Room -->
                        <div class="mb-3">
                            <label for="room_id" class="form-label">
                                <i class="fas fa-door-open me-1"></i>
                                Ruangan <span class="text-danger">*</span>
                            </label>
                            <select class="form-select <?php $__errorArgs = ['room_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                    id="room_id" 
                                    name="room_id" 
                                    required>
                                <option value="">Pilih ruangan...</option>
                                <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($room->id); ?>" 
                                            <?php echo e((old('room_id', $roomId ?? '') == $room->id) ? 'selected' : ''); ?>>
                                        <?php echo e($room->name); ?>

                                        <?php if($room->floor): ?> - <?php echo e($room->floor); ?> <?php endif; ?>
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                            <?php $__errorArgs = ['room_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php else: ?>
                                <div class="invalid-feedback" id="room_id-error"></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <?php if($rooms->count() == 0): ?>
                                <div class="form-text text-warning">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    Belum ada ruangan tersedia. 
                                    <a href="<?php echo e(route('rooms.create')); ?>" class="text-decoration-none">
                                        Tambah ruangan terlebih dahulu
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Description -->
                        <div class="mb-4">
                            <label for="description" class="form-label">
                                <i class="fas fa-align-left me-1"></i>
                                Deskripsi <span class="text-muted">(Opsional)</span>
                            </label>
                            <textarea class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                      id="description" 
                                      name="description" 
                                      rows="3"
                                      placeholder="Tambahan informasi tentang barang (kondisi, spesifikasi, dsb)"><?php echo e(old('description')); ?></textarea>
                            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php else: ?>
                                <div class="invalid-feedback" id="description-error"></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="<?php echo e(route('items.index')); ?>" class="btn btn-outline-secondary">
                                <i class="fas fa-times me-1"></i>
                                Batal
                            </a>
                            <button type="submit" class="btn btn-maroon">
                                <i class="fas fa-save me-1"></i>
                                Simpan Barang
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
                        Tips Pengisian Form
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6><i class="fas fa-qrcode text-primary me-2"></i>Kode QR</h6>
                            <ul class="list-unstyled small">
                                <li>• Harus unik untuk setiap barang</li>
                                <li>• Bisa berupa angka atau kombinasi huruf-angka</li>
                                <li>• Contoh: BR001, QR123456, dsb</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6><i class="fas fa-tag text-warning me-2"></i>Merk & Tipe</h6>
                            <ul class="list-unstyled small">
                                <li>• Merk: nama brand/produsen</li>
                                <li>• Tipe: jenis/kategori barang</li>
                                <li>• Isi dengan jelas untuk memudahkan pencarian</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    /* QR Scanner Modal Styles */
    .qr-scanner-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 300px;
    }
    
    #inline-qr-reader {
        border: 2px dashed var(--secondary-orange);
        border-radius: 10px;
        padding: 20px;
        background: rgba(253, 126, 20, 0.1);
        min-height: 250px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    #inline-qr-reader video {
        max-width: 100% !important;
        height: auto !important;
        border-radius: 8px;
    }
    
    /* Camera controls in modal */
    #inline-camera-controls {
        animation: fadeIn 0.5s ease-in-out;
    }
    
    #inline-camera-controls .btn {
        margin: 0 2px;
        transition: all 0.3s ease;
    }
    
    #inline-camera-controls .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    /* Modal responsive adjustments */
    @media (max-width: 768px) {
        .modal-lg {
            max-width: 95%;
        }
        
        #inline-qr-reader {
            padding: 15px;
            min-height: 200px;
        }
        
        #inline-camera-controls .btn {
            font-size: 0.8rem;
            padding: 0.4rem 0.6rem;
        }
    }
    
    /* Loading animation for modal */
    .spinner-border {
        width: 2rem;
        height: 2rem;
    }
    
    /* Success state animation */
    @keyframes bounceIn {
        0% { transform: scale(0); opacity: 0; }
        50% { transform: scale(1.1); opacity: 1; }
        100% { transform: scale(1); opacity: 1; }
    }
    
    .fa-check-circle {
        animation: bounceIn 0.5s ease-in-out;
    }
    
    /* Input group button styling */
    .input-group .btn {
        border-left: 0;
    }
    
    .input-group .form-control:focus + .btn {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
    }
    
    /* QR scan button hover effect */
    #qr-scan-btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    /* Generate button styling */
    .btn-outline-secondary.btn-sm {
        font-size: 0.8rem;
        padding: 0.4rem 0.8rem;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const qrCodeInput = document.getElementById('qr_code');
    const brandInput = document.getElementById('brand');
    const typeInput = document.getElementById('type');
    const roomSelect = document.getElementById('room_id');
    const descriptionInput = document.getElementById('description');
    const form = document.querySelector('form');

    // Helper function to show validation error
    function showValidationError(inputElement, message) {
        inputElement.classList.add('is-invalid');
        const errorElement = document.getElementById(inputElement.id + '-error');
        if (errorElement) {
            errorElement.textContent = message;
        }
    }

    // Helper function to clear validation error
    function clearValidationError(inputElement) {
        inputElement.classList.remove('is-invalid');
        const errorElement = document.getElementById(inputElement.id + '-error');
        if (errorElement) {
            errorElement.textContent = '';
        }
    }

    // Add real-time validation listeners
    qrCodeInput.addEventListener('input', function() {
        if (qrCodeInput.value.trim() === '') {
            showValidationError(qrCodeInput, 'Kode QR wajib diisi.');
        } else if (qrCodeInput.value.length > 255) {
            showValidationError(qrCodeInput, 'Kode QR tidak boleh lebih dari 255 karakter.');
        } else {
            clearValidationError(qrCodeInput);
        }
    });

    brandInput.addEventListener('input', function() {
        if (brandInput.value.trim() === '') {
            showValidationError(brandInput, 'Merk barang wajib diisi.');
        } else if (brandInput.value.length > 255) {
            showValidationError(brandInput, 'Merk barang tidak boleh lebih dari 255 karakter.');
        } else {
            clearValidationError(brandInput);
        }
    });

    typeInput.addEventListener('input', function() {
        if (typeInput.value.trim() === '') {
            showValidationError(typeInput, 'Tipe barang wajib diisi.');
        } else if (typeInput.value.length > 255) {
            showValidationError(typeInput, 'Tipe barang tidak boleh lebih dari 255 karakter.');
        } else {
            clearValidationError(typeInput);
        }
    });

    roomSelect.addEventListener('change', function() {
        if (roomSelect.value === '') {
            showValidationError(roomSelect, 'Ruangan wajib dipilih.');
        } else {
            clearValidationError(roomSelect);
        }
    });

    descriptionInput.addEventListener('input', function() {
        // Description is nullable, so only validate if it's filled and exceeds max length
        if (descriptionInput.value.length > 0 && descriptionInput.value.length > 1000) { // Assuming a max length for description, e.g., 1000 chars
            showValidationError(descriptionInput, 'Deskripsi tidak boleh lebih dari 1000 karakter.');
        } else {
            clearValidationError(descriptionInput);
        }
    });

    // Auto-generate QR code suggestion only if empty (not from scan)
    if (!qrCodeInput.value || qrCodeInput.value.trim() === '') {
        const generateBtn = document.createElement('button');
        generateBtn.type = 'button';
        generateBtn.className = 'btn btn-outline-secondary btn-sm mt-1 me-2';
        generateBtn.innerHTML = '<i class="fas fa-magic me-1"></i>Generate Kode Otomatis';
        generateBtn.onclick = function() {
            const randomCode = 'BRG' + Date.now().toString().substr(-6);
            qrCodeInput.value = randomCode;
            generateBtn.style.display = 'none'; // Hide button after generate
            
            // Show success message
            const successMsg = document.createElement('small');
            successMsg.className = 'text-success d-block mt-1';
            successMsg.innerHTML = '<i class="fas fa-check me-1"></i>Kode QR berhasil digenerate!';
            generateBtn.parentNode.appendChild(successMsg);
            
            // Focus on next field
            const brandInput = document.getElementById('brand');
            if (brandInput) {
                brandInput.focus();
            }
        };
        qrCodeInput.parentNode.appendChild(generateBtn);
        
        // Add helper text
        const helpText = document.createElement('small');
        helpText.className = 'text-muted d-block mt-1';
        helpText.innerHTML = '<i class="fas fa-lightbulb me-1"></i>Tip: Generate kode otomatis atau scan menggunakan kamera';
        qrCodeInput.parentNode.appendChild(helpText);
    } else {
        // If QR code exists (from scan), add info text
        const infoText = document.createElement('small');
        infoText.className = 'text-success d-block mt-1';
        infoText.innerHTML = '<i class="fas fa-check-circle me-1"></i>Kode QR dari hasil scan. Anda dapat mengubahnya jika diperlukan.';
        qrCodeInput.parentNode.appendChild(infoText);
        
        // Focus on next field (brand)
        const brandInput = document.getElementById('brand');
        if (brandInput) {
            brandInput.focus();
        }
    }
    
    // Form submission validation
    form.addEventListener('submit', function(e) {
        let isValid = true;

        // Manually trigger validation for all fields on submit
        if (qrCodeInput.value.trim() === '') {
            showValidationError(qrCodeInput, 'Kode QR wajib diisi.');
            isValid = false;
        } else if (qrCodeInput.value.length > 255) {
            showValidationError(qrCodeInput, 'Kode QR tidak boleh lebih dari 255 karakter.');
            isValid = false;
        } else {
            clearValidationError(qrCodeInput);
        }

        if (brandInput.value.trim() === '') {
            showValidationError(brandInput, 'Merk barang wajib diisi.');
            isValid = false;
        } else if (brandInput.value.length > 255) {
            showValidationError(brandInput, 'Merk barang tidak boleh lebih dari 255 karakter.');
            isValid = false;
        } else {
            clearValidationError(brandInput);
        }

        if (typeInput.value.trim() === '') {
            showValidationError(typeInput, 'Tipe barang wajib diisi.');
            isValid = false;
        } else if (typeInput.value.length > 255) {
            showValidationError(typeInput, 'Tipe barang tidak boleh lebih dari 255 karakter.');
            isValid = false;
        } else {
            clearValidationError(typeInput);
        }

        if (roomSelect.value === '') {
            showValidationError(roomSelect, 'Ruangan wajib dipilih.');
            isValid = false;
        } else {
            clearValidationError(roomSelect);
        }

        if (descriptionInput.value.length > 0 && descriptionInput.value.length > 1000) {
            showValidationError(descriptionInput, 'Deskripsi tidak boleh lebih dari 1000 karakter.');
            isValid = false;
        } else {
            clearValidationError(descriptionInput);
        }

        if (!isValid) {
            e.preventDefault();
            // Scroll to the first invalid field
            const firstInvalid = document.querySelector('.is-invalid');
            if (firstInvalid) {
                firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }
    });
});

// QR Scanner Integration
let inlineQrScanner = null;
let isInlineScanning = false;

function openQRScanner() {
    // Create modal for QR scanner
    const modalHtml = `
        <div class="modal fade" id="qrScanModal" tabindex="-1" aria-labelledby="qrScanModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title" id="qrScanModalLabel">
                            <i class="fas fa-camera me-2"></i>Scan QR Code
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center mb-3">
                            <div class="alert alert-info">
                                <i class="fas fa-info-circle me-2"></i>
                                Arahkan kamera ke QR code untuk scan otomatis
                            </div>
                        </div>
                        
                        <!-- Scanner Container -->
                        <div class="qr-scanner-container">
                            <div id="inline-qr-reader" style="width: 100%; max-width: 500px; margin: 0 auto;"></div>
                        </div>
                        
                        <!-- Camera Controls -->
                        <div class="text-center mt-3" id="inline-camera-controls" style="display: none;">
                            <div class="btn-group" role="group">
                                <button type="button" 
                                        class="btn btn-outline-primary btn-sm" 
                                        id="inline-switch-camera-btn" 
                                        onclick="switchInlineCamera()"
                                        title="Ganti Kamera">
                                    <i class="fas fa-sync-alt me-1"></i>Switch
                                </button>
                                <button type="button" 
                                        class="btn btn-outline-warning btn-sm" 
                                        id="inline-toggle-flash-btn" 
                                        onclick="toggleInlineFlash()"
                                        title="Flash">
                                    <i class="fas fa-lightbulb me-1" id="inline-flash-icon"></i>Flash
                                </button>
                            </div>
                        </div>
                        
                        <!-- Manual Input -->
                        <div class="mt-4 pt-3 border-top">
                            <h6><i class="fas fa-keyboard me-2"></i>Atau Input Manual</h6>
                            <div class="input-group">
                                <input type="text" 
                                       class="form-control" 
                                       id="manual-qr-input"
                                       placeholder="Masukkan kode QR manual...">
                                <button class="btn btn-maroon" 
                                        type="button" 
                                        onclick="useManualQR()">
                                    <i class="fas fa-check me-1"></i>Gunakan
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="fas fa-times me-1"></i>Tutup
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    // Remove existing modal if any
    const existingModal = document.getElementById('qrScanModal');
    if (existingModal) {
        existingModal.remove();
    }
    
    // Add modal to page
    document.body.insertAdjacentHTML('beforeend', modalHtml);
    
    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('qrScanModal'));
    modal.show();
    
    // Start scanner when modal is shown
    document.getElementById('qrScanModal').addEventListener('shown.bs.modal', function() {
        startInlineScanner();
    });
    
    // Stop scanner when modal is hidden
    document.getElementById('qrScanModal').addEventListener('hidden.bs.modal', function() {
        stopInlineScanner();
        // Remove modal from DOM
        document.getElementById('qrScanModal').remove();
    });
}

function startInlineScanner() {
    if (isInlineScanning) return;
    
    const qrReaderElement = document.getElementById('inline-qr-reader');
    if (!qrReaderElement) return;
    
    // Show loading
    qrReaderElement.innerHTML = `
        <div class="text-center py-4">
            <div class="spinner-border text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2 text-muted">Mengakses kamera...</p>
        </div>
    `;
    
    inlineQrScanner = new Html5Qrcode("inline-qr-reader");
    
    const config = {
        fps: 10,
        qrbox: { width: 300, height: 300 },
        aspectRatio: 1.0
    };
    
    // Try to start scanner
    Html5Qrcode.getCameras().then(devices => {
        if (devices && devices.length) {
            let cameraId = devices[0].id;
            
            // Look for back camera
            const backCamera = devices.find(device => 
                device.label.toLowerCase().includes('back') || 
                device.label.toLowerCase().includes('environment') ||
                device.label.toLowerCase().includes('rear')
            );
            
            if (backCamera) {
                cameraId = backCamera.id;
            }
            
            inlineQrScanner.start(
                cameraId,
                config,
                (decodedText, decodedResult) => {
                    console.log('Inline QR scan success:', decodedText);
                    onInlineScanSuccess(decodedText);
                },
                (errorMessage) => {
                    // Silent error handling
                }
            ).then(() => {
                isInlineScanning = true;
                console.log('Inline QR Scanner started');
                
                // Show controls
                setTimeout(() => {
                    const controls = document.getElementById('inline-camera-controls');
                    if (controls) {
                        controls.style.display = 'block';
                    }
                }, 1500);
                
            }).catch(err => {
                console.error('Error starting inline scanner:', err);
                showInlineError('Gagal mengakses kamera: ' + err.message);
            });
            
        } else {
            showInlineError('Tidak ada kamera yang tersedia');
        }
    }).catch(err => {
        console.error('Error getting cameras for inline scanner:', err);
        showInlineError('Error mengakses daftar kamera');
    });
}

function stopInlineScanner() {
    if (inlineQrScanner && isInlineScanning) {
        inlineQrScanner.stop().then(() => {
            console.log('Inline scanner stopped');
        }).catch(err => {
            console.error('Error stopping inline scanner:', err);
        });
        
        isInlineScanning = false;
        inlineQrScanner = null;
    }
}

function onInlineScanSuccess(decodedText) {
    // Stop scanning
    stopInlineScanner();
    
    // Update the main QR input
    const qrInput = document.getElementById('qr_code');
    if (qrInput) {
        qrInput.value = decodedText;
        
        // Trigger input event for any validation
        qrInput.dispatchEvent(new Event('input', { bubbles: true }));
    }
    
    // Show success in modal
    const qrReaderElement = document.getElementById('inline-qr-reader');
    if (qrReaderElement) {
        qrReaderElement.innerHTML = `
            <div class="text-center py-4">
                <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                <h5>QR Code Berhasil Dipindai!</h5>
                <p class="text-muted">Kode: <strong>${decodedText}</strong></p>
                <p class="text-muted">Modal akan tertutup otomatis...</p>
            </div>
        `;
    }
    
    // Hide controls
    const controls = document.getElementById('inline-camera-controls');
    if (controls) {
        controls.style.display = 'none';
    }
    
    // Auto close modal after short delay
    setTimeout(() => {
        const modal = bootstrap.Modal.getInstance(document.getElementById('qrScanModal'));
        if (modal) {
            modal.hide();
        }
    }, 2000);
}

function showInlineError(message) {
    const qrReaderElement = document.getElementById('inline-qr-reader');
    if (qrReaderElement) {
        qrReaderElement.innerHTML = `
            <div class="text-center py-4">
                <i class="fas fa-exclamation-triangle fa-2x text-warning mb-3"></i>
                <h6>Error Kamera</h6>
                <p class="text-muted">${message}</p>
                <button class="btn btn-outline-primary btn-sm" onclick="startInlineScanner()">
                    <i class="fas fa-redo me-1"></i>Coba Lagi
                </button>
            </div>
        `;
    }
    
    // Hide controls
    const controls = document.getElementById('inline-camera-controls');
    if (controls) {
        controls.style.display = 'none';
    }
}

// Camera control functions for inline scanner
function switchInlineCamera() {
    // This would require more complex implementation
    // For now, just restart the scanner
    if (inlineQrScanner && isInlineScanning) {
        stopInlineScanner();
        setTimeout(() => {
            startInlineScanner();
        }, 1000);
    }
}

function toggleInlineFlash() {
    // Implementation similar to main scanner
    console.log('Flash toggle for inline scanner - to be implemented');
}

function useManualQR() {
    const manualInput = document.getElementById('manual-qr-input');
    const qrInput = document.getElementById('qr_code');
    
    if (manualInput && qrInput && manualInput.value.trim()) {
        qrInput.value = manualInput.value.trim();
        qrInput.dispatchEvent(new Event('input', { bubbles: true }));
        
        // Close modal
        const modal = bootstrap.Modal.getInstance(document.getElementById('qrScanModal'));
        if (modal) {
            modal.hide();
        }
    } else {
        alert('Silakan masukkan kode QR terlebih dahulu!');
        if (manualInput) {
            manualInput.focus();
        }
    }
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\firman\web1\my-laravel-app\resources\views/items/create.blade.php ENDPATH**/ ?>