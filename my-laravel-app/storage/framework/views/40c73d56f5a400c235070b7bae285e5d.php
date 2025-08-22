

<?php $__env->startSection('title', 'Edit Barang - ' . $item->brand . ' ' . $item->type); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="mb-0">
                    <i class="fas fa-edit me-3"></i>
                    Edit Barang
                </h1>
                <p class="lead mb-0"><?php echo e($item->brand); ?> - <?php echo e($item->type); ?></p>
            </div>
            <div class="col-auto">
                <div class="btn-group" role="group">
                    <a href="<?php echo e(route('items.show', $item->id)); ?>" class="btn btn-light">
                        <i class="fas fa-arrow-left me-2"></i>
                        Kembali
                    </a>
                    <a href="<?php echo e(route('items.index')); ?>" class="btn btn-outline-secondary">
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
                    <form action="<?php echo e(route('items.update', $item->id)); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PUT'); ?>
                        
                        <!-- QR Code -->
                        <div class="mb-3">
                            <label for="qr_code" class="form-label">
                                <i class="fas fa-qrcode me-1"></i>
                                Kode QR <span class="text-danger">*</span>
                            </label>
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
                                   value="<?php echo e(old('qr_code', $item->qr_code)); ?>"
                                   placeholder="Masukkan kode QR barang"
                                   required>
                            <?php $__errorArgs = ['qr_code'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                                   value="<?php echo e(old('brand', $item->brand)); ?>"
                                   placeholder="Contoh: Dell, HP, Canon, dsb"
                                   required>
                            <?php $__errorArgs = ['brand'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
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
                                   value="<?php echo e(old('type', $item->type)); ?>"
                                   placeholder="Contoh: Laptop, Printer, Monitor, dsb"
                                   required>
                            <?php $__errorArgs = ['type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
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
                                            <?php echo e(old('room_id', $item->room_id) == $room->id ? 'selected' : ''); ?>>
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
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                                      placeholder="Tambahan informasi tentang barang (kondisi, spesifikasi, dsb)"><?php echo e(old('description', $item->description)); ?></textarea>
                            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Action Buttons -->
                        <div class="d-flex justify-content-between">
                            <a href="<?php echo e(route('items.show', $item->id)); ?>" class="btn btn-outline-secondary">
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
                            <p class="mb-0"><?php echo e($item->created_at->format('d M Y, H:i')); ?></p>
                            <small class="text-muted"><?php echo e($item->created_at->diffForHumans()); ?></small>
                        </div>
                        <div class="col-md-6">
                            <h6 class="text-muted">
                                <i class="fas fa-edit me-2"></i>
                                Terakhir Diupdate
                            </h6>
                            <p class="mb-0"><?php echo e($item->updated_at->format('d M Y, H:i')); ?></p>
                            <small class="text-muted"><?php echo e($item->updated_at->diffForHumans()); ?></small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
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
    const originalQrCode = '<?php echo e($item->qr_code); ?>';
    
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
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\firman\web1\my-laravel-app\resources\views/items/edit.blade.php ENDPATH**/ ?>