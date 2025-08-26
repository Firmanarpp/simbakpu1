


<?php $__env->startSection('title', 'Dashboard - Sistem Manajemen Barang Kantor'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="mb-0">
                    <i class="fas fa-box"></i>
                    Dashboard
                </h1>
                <p class="lead mb-0">Sistem Manajemen Barang KPU JATENG</p>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3">
    <!-- Stats Cards -->
    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <div class="card stats-card h-100">
                <div class="card-body text-center p-3">
                    <div class="display-6 text-maroon mb-2">
                        <i class="fas fa-box"></i>
                    </div>
                    <h6 class="card-title">Total Barang</h6>
                    <h3 class="text-maroon mb-0"><?php echo e(\App\Models\Item::count()); ?></h3>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card stats-card h-100">
                <div class="card-body text-center p-3">
                    <div class="display-6 text-maroon mb-2">
                        <i class="fas fa-door-open"></i>
                    </div>
                    <h6 class="card-title">Total Ruangan</h6>
                    <h3 class="text-maroon mb-0"><?php echo e(\App\Models\Room::count()); ?></h3>
                </div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="card stats-card h-100">
                <div class="card-body text-center p-3">
                    <div class="display-6 text-maroon mb-2">
                        <i class="fas fa-qrcode"></i>
                    </div>
                    <h6 class="card-title">Scan QR</h6>
                    <a href="<?php echo e(route('qr-scan.index')); ?>" class="btn btn-maroon btn-sm">
                        <i class="fas fa-camera me-1"></i>Mulai Scan
                    </a>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3 mb-3">
            <div class="card stats-card h-100">
                <div class="card-body text-center p-3">
                    <div class="display-6 text-maroon mb-2">
                        <i class="fas fa-plus-circle"></i>
                    </div>
                    <h6 class="card-title">Tambah Barang</h6>
                    <a href="<?php echo e(route('items.create')); ?>" class="btn btn-maroon btn-sm">
                        <i class="fas fa-plus me-1"></i>Tambah
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Recent Items and Rooms -->
    <div class="row mb-4">
        <!-- Recent Items -->
        <div class="col-md-6 mb-3">
            <div class="card h-100">
                <div class="card-header bg-gradient-maroon text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-box me-2"></i>
                            Barang Terbaru
                        </h5>
                        <a href="<?php echo e(route('items.index')); ?>" class="btn btn-white btn-sm">
                            <i class="fas fa-list me-1 text-maroon"></i>
                            <span class="text-dark fw-bold">Lihat Semua</span>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <?php
                        $recentItems = \App\Models\Item::with('room')->latest()->take(5)->get();
                    ?>
                    
                    <?php if($recentItems->count() > 0): ?>
                        <div class="list-group list-group-flush dashboard-item-list">
                            <?php $__currentLoopData = $recentItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="list-group-item list-group-item-action">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 text-primary fw-bold"><?php echo e($item->brand); ?></h6>
                                            <p class="mb-1 text-muted small"><?php echo e($item->type); ?></p>
                                            <div class="d-flex gap-1 mb-1">
                                                <?php if($item->room): ?>
                                                    <span class="badge bg-info small">
                                                        <i class="fas fa-door-open me-1"></i><?php echo e($item->room->name); ?>

                                                    </span>
                                                <?php endif; ?>
                                                <span class="badge bg-secondary small"><?php echo e(ucfirst($item->status)); ?></span>
                                            </div>
                                            <code class="small text-muted"><?php echo e($item->qr_code); ?></code>
                                        </div>
                                        <div class="text-end">
                                            <a href="<?php echo e(route('items.show', $item->id)); ?>" 
                                               class="btn btn-outline-primary btn-sm"
                                               title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="card-footer bg-light text-center">
                            <a href="<?php echo e(route('items.create')); ?>" class="btn btn-maroon btn-sm me-2">
                                <i class="fas fa-plus me-1"></i>Tambah Barang
                            </a>
                            <a href="<?php echo e(route('qr-scan.index')); ?>" class="btn btn-outline-maroon btn-sm">
                                <i class="fas fa-qrcode me-1"></i>Scan QR
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="fas fa-box-open fa-2x text-muted mb-2"></i>
                            <p class="text-muted mb-3">Belum ada barang</p>
                            <a href="<?php echo e(route('items.create')); ?>" class="btn btn-maroon btn-sm">
                                <i class="fas fa-plus me-1"></i>Tambah Barang Pertama
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Recent Rooms -->
        <div class="col-md-6 mb-3">
            <div class="card h-100">
                <div class="card-header bg-gradient-maroon text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">
                            <i class="fas fa-door-open me-2"></i>
                            Ruangan Terbaru
                        </h5>
                        <a href="<?php echo e(route('rooms.index')); ?>" class="btn btn-white btn-sm">
                            <i class="fas fa-list me-1 text-maroon"></i>
                            <span class="text-dark fw-bold">Lihat Semua</span>
                        </a>
                    </div>
                </div>
                <div class="card-body p-0">
                    <?php
                        $recentRooms = \App\Models\Room::withCount('items')->latest()->take(5)->get();
                    ?>
                    
                    <?php if($recentRooms->count() > 0): ?>
                        <div class="list-group list-group-flush dashboard-room-list">
                            <?php $__currentLoopData = $recentRooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="list-group-item list-group-item-action">
                                    <div class="d-flex justify-content-between align-items-start">
                                        <div class="flex-grow-1">
                                            <h6 class="mb-1 text-primary fw-bold">
                                                <i class="fas fa-door-open me-2 text-warning"></i>
                                                <?php echo e($room->name); ?>

                                            </h6>
                                            <?php if($room->floor): ?>
                                                <p class="mb-1 text-muted small">
                                                    <i class="fas fa-building me-1"></i><?php echo e($room->floor); ?>

                                                </p>
                                            <?php endif; ?>
                                            <?php if($room->description): ?>
                                                <p class="mb-1 text-muted small"><?php echo e(Str::limit($room->description, 50)); ?></p>
                                            <?php endif; ?>
                                            <div class="mt-2">
                                                <span class="badge bg-maroon">
                                                    <i class="fas fa-box me-1"></i><?php echo e($room->items_count); ?> Barang
                                                </span>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <a href="<?php echo e(route('rooms.show', $room->id)); ?>" 
                                               class="btn btn-outline-maroon btn-sm"
                                               title="Lihat Detail">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                        <div class="card-footer bg-light text-center">
                            <a href="<?php echo e(route('rooms.create')); ?>" class="btn btn-maroon btn-sm">
                                <i class="fas fa-plus me-1"></i>Tambah Ruangan
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-4">
                            <i class="fas fa-door-open fa-2x text-muted mb-2"></i>
                            <p class="text-muted mb-3">Belum ada ruangan</p>
                            <a href="<?php echo e(route('rooms.create')); ?>" class="btn btn-maroon btn-sm">
                                <i class="fas fa-plus me-1"></i>Tambah Ruangan Pertama
                            </a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\firman\web1\my-laravel-app\resources\views/dashboard.blade.php ENDPATH**/ ?>