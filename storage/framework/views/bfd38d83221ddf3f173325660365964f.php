


<?php $__env->startSection('title', 'Daftar Ruangan - Sistem Manajemen Barang Kantor'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="mb-0">
                    <i class="fas fa-door-open me-2 d-none d-md-inline"></i>
                    <span class="d-md-none">🚪</span>
                    Daftar Ruangan
                </h1>
                <p class="lead mb-0 d-none d-md-block">Kelola ruangan di gedung kantor</p>
                <p class="mb-0 d-md-none"><small>Kelola ruangan kantor</small></p>
            </div>
            <div class="col-auto">
                <a href="<?php echo e(route('rooms.create')); ?>" class="btn btn-light btn-sm">
                    <i class="fas fa-plus me-1 d-none d-sm-inline"></i>
                    <span class="d-sm-none">+</span>
                    <span class="d-none d-sm-inline">Tambah Ruangan</span>
                    <span class="d-sm-none">Tambah</span>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3">
    <?php if($rooms->count() > 0): ?>
        <div class="row g-3">
            <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100">
                        <div class="card-header bg-gradient-orange text-white">
                            <h6 class="mb-0">
                                <i class="fas fa-door-open me-2"></i>
                                <?php echo e($room->name); ?>

                            </h6>
                        </div>
                        <div class="card-body text-center p-4">
                            <div class="display-4 text-warning mb-3">
                                <i class="fas fa-door-open"></i>
                            </div>
                            
                            <?php if($room->floor): ?>
                                <div class="mb-2">
                                    <span class="badge bg-secondary">
                                        <i class="fas fa-building me-1"></i><?php echo e($room->floor); ?>

                                    </span>
                                </div>
                            <?php endif; ?>
                            
                            <h5 class="card-title"><?php echo e($room->name); ?></h5>
                            
                            <?php if($room->description): ?>
                                <p class="card-text text-muted small">
                                    <?php echo e(Str::limit($room->description, 80)); ?>

                                </p>
                            <?php endif; ?>
                            
                            <div class="row text-center mt-3">
                                <div class="col">
                                    <div class="display-6 text-primary fw-bold">
                                        <?php echo e($room->items_count); ?>

                                    </div>
                                    <small class="text-muted">Barang</small>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <div class="row g-2">
                                <div class="col-6">
                                    <a href="<?php echo e(route('rooms.show', $room->id)); ?>" 
                                       class="btn btn-outline-primary btn-sm w-100">
                                        <i class="fas fa-eye me-1"></i>Detail
                                    </a>
                                </div>
                                <div class="col-6">
                                    <a href="<?php echo e(route('rooms.edit', $room->id)); ?>" 
                                       class="btn btn-outline-warning btn-sm w-100">
                                        <i class="fas fa-edit me-1"></i>Edit
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
        <!-- Pagination -->
        <?php if($rooms->hasPages()): ?>
        <div class="d-flex justify-content-center mt-4">
            <?php echo e($rooms->links('pagination.custom')); ?>

        </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="card">
            <div class="card-body text-center py-5">
                <i class="fas fa-door-open fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">Belum ada ruangan yang ditambahkan</h5>
                <p class="text-muted">Mulai dengan menambahkan ruangan pertama untuk sistem manajemen barang Anda.</p>
                <a href="<?php echo e(route('rooms.create')); ?>" class="btn btn-primary">
                    <i class="fas fa-plus me-1"></i>Tambah Ruangan Pertama
                </a>
            </div>
        </div>
    <?php endif; ?>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Ruangan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Peringatan!</strong> Tindakan ini tidak dapat dibatalkan.
                </div>
                <p>Apakah Anda yakin ingin menghapus ruangan ini?</p>
                <div id="roomInfo" class="bg-light p-3 rounded"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Batal
                </button>
                <form id="deleteForm" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>Ya, Hapus Ruangan
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
function deleteRoom(roomId, roomName) {
    // Set form action
    document.getElementById('deleteForm').action = `/rooms/${roomId}`;
    
    // Set room info
    document.getElementById('roomInfo').innerHTML = `<strong>${roomName}</strong>`;
    
    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\firman\web1\my-laravel-app\resources\views/rooms/index.blade.php ENDPATH**/ ?>