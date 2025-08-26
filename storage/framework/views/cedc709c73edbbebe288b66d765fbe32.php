


<?php $__env->startSection('title', 'Daftar Barang - Sistem Manajemen Barang Kantor'); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="mb-0">
                    <i class="fas fa-box me-2 d-none d-md-inline"></i>
                    <span class="d-md-none">📦</span>
                    Daftar Barang
                </h1>
                <p class="lead mb-0 d-none d-md-block">Kelola semua barang yang ada di gedung kantor</p>
                <p class="mb-0 d-md-none"><small>Kelola barang kantor</small></p>
            </div>
            <div class="col-auto">
                <a href="<?php echo e(route('items.create')); ?>" class="btn btn-light btn-sm">
                    <i class="fas fa-plus me-1 d-none d-sm-inline"></i>
                    <span class="d-sm-none">+</span>
                    <span class="d-none d-sm-inline">Tambah Barang</span>
                    <span class="d-sm-none">Tambah</span>
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3">
    <div class="card">
        <div class="card-header bg-gradient-orange text-white">
            <div class="row align-items-center">
                <div class="col">
                    <h5 class="mb-0">
                        <i class="fas fa-list me-2"></i>
                        <span class="d-none d-md-inline">Total <?php echo e($items->total()); ?> Barang</span>
                        <span class="d-md-none"><?php echo e($items->total()); ?> Items</span>
                    </h5>
                </div>
                <div class="col-auto">
                    <div class="btn-group" role="group">
                        <a href="<?php echo e(route('items.create')); ?>" class="btn btn-white btn-sm shadow-sm border">
                            <i class="fas fa-plus me-1 d-none d-sm-inline text-primary"></i>
                            <span class="d-sm-none">+</span>
                            <span class="d-none d-sm-inline text-dark fw-bold">Tambah</span>
                        </a>
                        <a href="<?php echo e(route('qr-scan.index')); ?>" class="btn btn-white btn-sm shadow-sm border">
                            <i class="fas fa-qrcode me-1 d-none d-sm-inline text-primary"></i>
                            <span class="d-sm-none">📷</span>
                            <span class="d-none d-sm-inline text-dark fw-bold">Scan QR</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        
        <div class="card-body bg-light border-bottom p-3">
            <form action="<?php echo e(route('items.index')); ?>" method="GET" class="row g-3 align-items-center">
                <div class="col-12 col-md-6 col-lg-4">
                    <label for="search" class="visually-hidden">Cari Barang</label>
                    <div class="input-group input-group-sm">
                        <span class="input-group-text bg-white border-end-0"><i class="fas fa-search"></i></span>
                        <input type="text" name="search" id="search" class="form-control border-start-0" placeholder="Cari merk, tipe, atau QR Code..." value="<?php echo e(request('search')); ?>">
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4">
                    <label for="room_id" class="visually-hidden">Filter Ruangan</label>
                    <select name="room_id" id="room_id" class="form-select form-select-sm">
                        <option value="">Semua Ruangan</option>
                        <?php $__currentLoopData = $rooms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $room): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($room->id); ?>" <?php echo e(request('room_id') == $room->id ? 'selected' : ''); ?>>
                                <?php echo e($room->name); ?> (<?php echo e($room->floor); ?>)
                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="col-12 col-lg-4 text-end">
                    <button type="submit" class="btn btn-primary btn-sm me-2">
                        <i class="fas fa-filter me-1"></i> Filter
                    </button>
                    <a href="<?php echo e(route('items.index')); ?>" class="btn btn-secondary btn-sm">
                        <i class="fas fa-sync-alt me-1"></i> Reset
                    </a>
                </div>
            </form>
        </div>

        <div class="card-body p-0">
            <?php if($items->count() > 0): ?>
                <!-- Mobile Card View -->
                <div class="d-block d-lg-none">
                    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="border-bottom p-3">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <h6 class="mb-0 fw-bold text-primary"><?php echo e($item->brand); ?></h6>
                            <div class="dropdown">
                                <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-toggle="dropdown">
                                    <i class="fas fa-ellipsis-v"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="<?php echo e(route('items.show', $item->id)); ?>">
                                        <i class="fas fa-eye me-2"></i>Lihat
                                    </a></li>
                                    <li><a class="dropdown-item" href="<?php echo e(route('items.edit', $item->id)); ?>">
                                        <i class="fas fa-edit me-2"></i>Edit
                                    </a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item text-danger" href="#" onclick="deleteItem(<?php echo e($item->id); ?>)">
                                        <i class="fas fa-trash me-2"></i>Hapus
                                    </a></li>
                                </ul>
                            </div>
                        </div>
                        <div>
                            <p class="mb-1 text-muted small"><?php echo e($item->type); ?></p>
                            <div class="d-flex gap-2 mb-2">
                                <span class="badge bg-info small"><?php echo e($item->room->name ?? 'No Room'); ?></span>
                                <span class="badge bg-secondary small"><?php echo e($item->condition); ?></span>
                                <span class="badge bg-primary small"><?php echo e(ucfirst($item->status)); ?></span>
                            </div>
                            <code class="small"><?php echo e($item->qr_code); ?></code>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Desktop Table View -->
                <div class="d-none d-lg-block">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                        <thead class="table-dark">
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">QR Code</th>
                                <th width="15%">Merk</th>
                                <th width="15%">Tipe</th>
                                <th width="15%">Ruangan</th>
                                <th width="20%">Deskripsi</th>
                                <th width="15%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($items->firstItem() + $index); ?></td>
                                    <td>
                                        <code class="bg-light p-1 rounded small"><?php echo e($item->qr_code); ?></code>
                                    </td>
                                    <td>
                                        <strong class="text-primary"><?php echo e($item->brand); ?></strong>
                                    </td>
                                    <td><?php echo e($item->type); ?></td>
                                    <td>
                                        <span class="badge bg-info">
                                            <i class="fas fa-door-open me-1"></i>
                                            <?php echo e($item->room->name ?? 'No Room'); ?>

                                        </span>
                                        <?php if($item->room && $item->room->floor): ?>
                                            <br>
                                            <small class="text-muted"><?php echo e($item->room->floor); ?></small>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php if($item->description): ?>
                                            <span class="text-muted small"><?php echo e(Str::limit($item->description, 50)); ?></span>
                                        <?php else: ?>
                                            <span class="text-muted font-italic">-</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="btn-group" role="group" aria-label="Actions">
                                            <a href="<?php echo e(route('items.show', $item->id)); ?>" 
                                               class="btn btn-outline-primary btn-sm"
                                               title="Lihat Detail"
                                               data-bs-toggle="tooltip">
                                                <i class="fas fa-eye"></i>
                                                <span class="d-none d-xl-inline ms-1">Lihat</span>
                                            </a>
                                            <a href="<?php echo e(route('items.edit', $item->id)); ?>" 
                                               class="btn btn-outline-warning btn-sm"
                                               title="Edit Barang"
                                               data-bs-toggle="tooltip">
                                                <i class="fas fa-edit"></i>
                                                <span class="d-none d-xl-inline ms-1">Edit</span>
                                            </a>
                                            <button type="button" 
                                                    class="btn btn-outline-danger btn-sm"
                                                    onclick="deleteItem(<?php echo e($item->id); ?>)"
                                                    title="Hapus Barang"
                                                    data-bs-toggle="tooltip">
                                                <i class="fas fa-trash"></i>
                                                <span class="d-none d-xl-inline ms-1">Hapus</span>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        </table>
                    </div>
                </div>
            <?php else: ?>
                <div class="text-center py-5">
                    <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Belum ada barang yang ditambahkan</h5>
                    <p class="text-muted">Mulai dengan menambahkan barang pertama atau scan QR code barang yang sudah ada.</p>
                    <div class="mt-3">
                        <a href="<?php echo e(route('items.create')); ?>" class="btn btn-primary me-2">
                            <i class="fas fa-plus me-1"></i>Tambah Barang
                        </a>
                        <a href="<?php echo e(route('qr-scan.index')); ?>" class="btn btn-outline-primary">
                            <i class="fas fa-qrcode me-1"></i>Scan QR Code
                        </a>
                    </div>
                </div>
            <?php endif; ?>
            
            <?php if($items->count() > 0): ?>
                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-3 px-3 pb-3">
                    <?php echo e($items->links('pagination.custom')); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Konfirmasi Hapus</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Apakah Anda yakin ingin menghapus barang ini?</p>
                <div id="deleteItemInfo" class="alert alert-warning"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                <form id="deleteForm" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
// Initialize tooltips
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Check if FontAwesome is loaded
    const checkFontAwesome = () => {
        const icons = document.querySelectorAll('.fas, .far, .fab');
        icons.forEach(icon => {
            if (getComputedStyle(icon).fontFamily.indexOf('Font Awesome') === -1) {
                console.warn('FontAwesome may not be loaded properly');
                // Fallback for specific icons
                if (icon.classList.contains('fa-chevron-left')) {
                    icon.innerHTML = '‹';
                } else if (icon.classList.contains('fa-chevron-right')) {
                    icon.innerHTML = '›';
                }
            }
        });
    };
    
    // Check FontAwesome after DOM is loaded
    setTimeout(checkFontAwesome, 100);
});

function deleteItem(itemId) {
    // Set form action
    document.getElementById('deleteForm').action = `/items/${itemId}`;
    
    // Show modal
    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
    modal.show();
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\firman\web1\simbakpu\resources\views/items/index.blade.php ENDPATH**/ ?>