

<?php $__env->startSection('title', 'Tambah Ruangan - Sistem Manajemen Barang Kantor'); ?>

<?php $__env->startSection('content'); ?>
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
                <a href="<?php echo e(route('rooms.index')); ?>" class="btn btn-light">
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
                    <form action="<?php echo e(route('rooms.store')); ?>" method="POST">
                        <?php echo csrf_field(); ?>
                        
                        <!-- Name -->
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                <i class="fas fa-door-open me-1"></i>
                                Nama Ruangan <span class="text-danger">*</span>
                            </label>
                            <input type="text" 
                                   class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   id="name" 
                                   name="name" 
                                   value="<?php echo e(old('name')); ?>"
                                   placeholder="Contoh: Ruang Meeting A, Ruang IT, Lobby, dsb"
                                   required>
                            <?php $__errorArgs = ['name'];
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

                        <!-- Floor -->
                        <div class="mb-3">
                            <label for="floor" class="form-label">
                                <i class="fas fa-building me-1"></i>
                                Lantai <span class="text-muted">(Opsional)</span>
                            </label>
                            <input type="text" 
                                   class="form-control <?php $__errorArgs = ['floor'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   id="floor" 
                                   name="floor" 
                                   value="<?php echo e(old('floor')); ?>"
                                   placeholder="Contoh: Lantai 1, Lantai 2, Basement, dsb">
                            <?php $__errorArgs = ['floor'];
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
                                Informasi lantai untuk memudahkan lokasi ruangan
                            </div>
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
                                      placeholder="Tambahan informasi tentang ruangan (kapasitas, fungsi, dsb)"><?php echo e(old('description')); ?></textarea>
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
                            <a href="<?php echo e(route('rooms.index')); ?>" class="btn btn-outline-secondary">
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
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto-capitalize first letter of room name
    const nameInput = document.getElementById('name');
    nameInput.addEventListener('input', function() {
        const words = this.value.split(' ');
        const capitalizedWords = words.map(word => {
            if (word.length > 0) {
                return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
            }
            return word;
        });
        this.value = capitalizedWords.join(' ');
    });
    
    // Auto-suggest floor based on common patterns
    const floorInput = document.getElementById('floor');
    const suggestions = ['Lantai 1', 'Lantai 2', 'Lantai 3', 'Ground Floor', 'Basement'];
    
    // Add datalist for floor suggestions
    const datalist = document.createElement('datalist');
    datalist.id = 'floor-suggestions';
    suggestions.forEach(suggestion => {
        const option = document.createElement('option');
        option.value = suggestion;
        datalist.appendChild(option);
    });
    document.body.appendChild(datalist);
    floorInput.setAttribute('list', 'floor-suggestions');
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\firman\web1\my-laravel-app\resources\views/rooms/create.blade.php ENDPATH**/ ?>