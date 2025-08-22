

<?php $__env->startSection('content'); ?>
<div class="container">
    <style>
        .fade-in {
            animation: fadeInUp 0.7s cubic-bezier(0.23, 1, 0.32, 1);
        }
        @keyframes fadeInUp {
            0% {
                opacity: 0;
                transform: translateY(30px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .card {
            transition: box-shadow 0.3s, transform 0.3s;
        }
        .card:hover {
            box-shadow: 0 8px 24px rgba(220,53,69,0.15);
            transform: translateY(-4px) scale(1.02);
        }
        .btn-primary {
            transition: background 0.3s, transform 0.2s;
        }
        .btn-primary:active {
            transform: scale(0.97);
        }
    </style>
    <div class="d-flex justify-content-between align-items-center mb-4 fade-in" style="margin-top:2.5rem;">
        <h2>Edit Informasi Ruangan</h2>
        <a href="<?php echo e(url()->previous()); ?>" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-1"></i> Kembali
        </a>
    </div>
    <form action="<?php echo e(route('rooms.update', $room->id)); ?>" method="POST" class="fade-in">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        <div class="mb-3">
            <label for="floor" class="form-label">Lantai</label>
            <input type="text" class="form-control" id="floor" name="floor" value="<?php echo e($room->floor); ?>" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Nama Ruangan</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo e($room->name); ?>" required>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Deskripsi</label>
            <textarea class="form-control" id="description" name="description" required><?php echo e($room->description); ?></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
    </form>
    <!-- Footer sticky -->
</div>
<style>
    footer {
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100%;
        z-index: 100;
    }
</style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\firman\web1\my-laravel-app\resources\views/rooms/edit.blade.php ENDPATH**/ ?>