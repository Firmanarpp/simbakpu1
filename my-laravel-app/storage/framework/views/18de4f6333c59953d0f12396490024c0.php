

<?php $__env->startSection('title', 'Detail Barang - ' . $item->brand . ' ' . $item->type); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="mb-0">
                    <i class="fas fa-box me-2 d-none d-md-inline"></i>
                    <span class="d-md-none">📦</span>
                    Detail Barang
                </h1>
                <!-- Desktop subtitle only -->
                <p class="lead mb-0 d-none d-md-block"><?php echo e($item->brand); ?> - <?php echo e($item->type); ?></p>
            </div>
            <div class="col-auto">
                <div class="btn-group" role="group">
                    <a href="<?php echo e(route('items.index')); ?>" class="btn btn-light btn-sm">
                        <i class="fas fa-arrow-left me-1 d-none d-md-inline"></i>
                        <span class="d-md-none">←</span>
                        <span class="d-none d-md-inline">Kembali</span>
                    </a>
                    <a href="<?php echo e(route('items.edit', $item->id)); ?>" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit me-1 d-none d-md-inline"></i>
                        <span class="d-md-none">✏️</span>
                        <span class="d-none d-md-inline">Edit</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-3">
    <div class="row g-3">
        <!-- Main Content Card - Mobile First -->
        <div class="col-12 col-lg-8 order-1">
            <div class="card">
                <div class="card-header bg-gradient-orange text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Informasi Barang
                    </h5>
                </div>
                <div class="card-body">
                    <!-- Mobile-optimized info display -->
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <div class="info-item border-bottom pb-2 mb-2">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <label class="form-label fw-bold text-muted small mb-1">
                                            <i class="fas fa-qrcode me-1"></i>Kode QR
                                        </label>
                                        <div class="d-flex align-items-center gap-2">
                                            <code class="bg-light p-2 rounded flex-grow-1 small text-break"><?php echo e($item->qr_code); ?></code>
                                            <button class="btn btn-outline-secondary btn-sm" onclick="copyToClipboard('<?php echo e($item->qr_code); ?>')" title="Salin kode">
                                                <i class="fas fa-copy"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-6">
                            <div class="info-item border-bottom pb-2 mb-2">
                                <label class="form-label fw-bold text-muted small mb-1">
                                    <i class="fas fa-tag me-1"></i>Merk
                                </label>
                                <p class="mb-0 fw-bold text-primary fs-5"><?php echo e($item->brand); ?></p>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-6">
                            <div class="info-item border-bottom pb-2 mb-2">
                                <label class="form-label fw-bold text-muted small mb-1">
                                    <i class="fas fa-cube me-1"></i>Tipe
                                </label>
                                <p class="mb-0 fw-bold text-primary fs-5"><?php echo e($item->type); ?></p>
                            </div>
                        </div>
                        
                        <div class="col-12 col-md-6">
                            <div class="info-item border-bottom pb-2 mb-2">
                                <label class="form-label fw-bold text-muted small mb-1">
                                    <i class="fas fa-door-open me-1"></i>Ruangan
                                </label>
                                <div>
                                    <?php if($item->room): ?>
                                        <a href="<?php echo e(route('rooms.show', $item->room->id)); ?>" class="text-decoration-none">
                                            <span class="badge bg-info fs-6 p-2">
                                                <?php echo e($item->room->name); ?>

                                            </span>
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted">-</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Description Section -->
                    <?php if($item->description): ?>
                    <div class="row mt-3">
                        <div class="col-12">
                            <div class="info-item">
                                <label class="form-label fw-bold text-muted small mb-2">
                                    <i class="fas fa-align-left me-1"></i>Deskripsi
                                </label>
                                <div class="bg-light p-3 rounded">
                                    <p class="mb-0"><?php echo e($item->description); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>

                    <!-- Timestamps Section -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <hr>
                            <div class="row g-2">
                                <div class="col-12 col-sm-6">
                                    <small class="text-muted d-block">
                                        <i class="fas fa-calendar-plus me-1"></i>
                                        <strong>Dibuat:</strong> <?php echo e($item->created_at->format('d M Y, H:i')); ?>

                                    </small>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <small class="text-muted d-block">
                                        <i class="fas fa-calendar-edit me-1"></i>
                                        <strong>Diubah:</strong> <?php echo e($item->updated_at->format('d M Y, H:i')); ?>

                                    </small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Sidebar - Mobile Responsive -->
        <div class="col-12 col-lg-4 order-2">
            <!-- QR Code Card -->
            <div class="card mb-3">
                <div class="card-header bg-gradient-red text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-qrcode me-2"></i>
                        QR Code
                    </h6>
                </div>
                <div class="card-body text-center p-3">
                    <div class="qr-container mb-3">
                        <div id="qrcode" class="d-inline-block mx-auto"></div>
                    </div>
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary btn-sm" onclick="downloadQR()">
                            <i class="fas fa-download me-1"></i>
                            <span class="d-none d-sm-inline">Download QR</span>
                            <span class="d-sm-none">Download</span>
                        </button>
                        <button class="btn btn-outline-primary btn-sm" onclick="printQR()">
                            <i class="fas fa-print me-1"></i>
                            <span class="d-none d-sm-inline">Print QR</span>
                            <span class="d-sm-none">Print</span>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Actions Card -->
            <div class="card">
                <div class="card-header bg-gradient-orange text-white">
                    <h6 class="mb-0">
                        <i class="fas fa-cogs me-2"></i>
                        Aksi
                    </h6>
                </div>
                <div class="card-body p-3">
                    <div class="d-grid gap-2">
                        <a href="<?php echo e(route('items.edit', $item->id)); ?>" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>
                            <span class="d-none d-sm-inline">Edit Barang</span>
                            <span class="d-sm-none">Edit</span>
                        </a>
                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                            <i class="fas fa-trash me-2"></i>
                            <span class="d-none d-sm-inline">Hapus Barang</span>
                            <span class="d-sm-none">Hapus</span>
                        </button>
                        <a href="<?php echo e(route('items.index')); ?>" class="btn btn-secondary">
                            <i class="fas fa-list me-2"></i>
                            <span class="d-none d-sm-inline">Daftar Barang</span>
                            <span class="d-sm-none">Daftar</span>
                        </a>
                        <?php if($item->room): ?>
                        <a href="<?php echo e(route('rooms.show', $item->room->id)); ?>" class="btn btn-info">
                            <i class="fas fa-door-open me-2"></i>
                            <span class="d-none d-sm-inline">Lihat Ruangan</span>
                            <span class="d-sm-none">Ruangan</span>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Barang</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-warning">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Peringatan!</strong> Tindakan ini tidak dapat dibatalkan.
                </div>
                <p>Apakah Anda yakin ingin menghapus barang berikut?</p>
                <div class="bg-light p-3 rounded">
                    <strong><?php echo e($item->brand); ?></strong> - <?php echo e($item->type); ?>

                    <br>
                    <small class="text-muted">QR Code: <?php echo e($item->qr_code); ?></small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Batal
                </button>
                <form action="<?php echo e(route('items.destroy', $item->id)); ?>" method="POST" class="d-inline">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger">
                        <i class="fas fa-trash me-1"></i>Ya, Hapus Barang
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.3/build/qrcode.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Generate QR Code
    const qrCodeContainer = document.getElementById('qrcode');
    
    if (qrCodeContainer) {
        QRCode.toCanvas(qrCodeContainer, '<?php echo e($item->qr_code); ?>', {
            width: 150,
            height: 150,
            margin: 1,
            color: {
                dark: '#dc3545',
                light: '#ffffff'
            }
        }, function (error) {
            if (error) {
                console.error(error);
                qrCodeContainer.innerHTML = '<div class="text-muted"><i class="fas fa-exclamation-triangle"></i><br>Gagal generate QR</div>';
            }
        });
    }
});

function downloadQR() {
    QRCode.toCanvas('<?php echo e($item->qr_code); ?>', {
        width: 300,
        height: 300,
        margin: 2,
        color: {
            dark: '#dc3545',
            light: '#ffffff'
        }
    }, function (error, canvas) {
        if (error) {
            console.error(error);
            alert('Gagal membuat QR code');
            return;
        }
        
        // Create download link
        const link = document.createElement('a');
        link.download = 'qr-<?php echo e($item->qr_code); ?>.png';
        link.href = canvas.toDataURL();
        link.click();
    });
}

function printQR() {
    const printWindow = window.open('', '_blank');
    const qrCanvas = document.getElementById('qrcode').querySelector('canvas');
    
    if (qrCanvas) {
        const qrDataUrl = qrCanvas.toDataURL();
        printWindow.document.write(`
            <html>
                <head>
                    <title>QR Code - <?php echo e($item->brand); ?> <?php echo e($item->type); ?></title>
                    <style>
                        body { 
                            font-family: Arial, sans-serif; 
                            text-align: center; 
                            padding: 20px; 
                        }
                        .qr-info { 
                            margin: 20px 0; 
                            border: 1px solid #ddd; 
                            padding: 15px; 
                            display: inline-block; 
                        }
                        img { 
                            margin: 20px 0; 
                        }
                    </style>
                </head>
                <body>
                    <h2><?php echo e($item->brand); ?> - <?php echo e($item->type); ?></h2>
                    <div class="qr-info">
                        <strong>QR Code:</strong> <?php echo e($item->qr_code); ?><br>
                        <strong>Ruangan:</strong> <?php echo e($item->room->name ?? '-'); ?>

                    </div>
                    <br>
                    <img src="${qrDataUrl}" alt="QR Code">
                </body>
            </html>
        `);
        printWindow.document.close();
        printWindow.print();
    }
}

function copyToClipboard(text) {
    if (navigator.clipboard) {
        navigator.clipboard.writeText(text).then(function() {
            // Show success notification
            const toast = document.createElement('div');
            toast.className = 'toast align-items-center text-white bg-success border-0 position-fixed top-0 end-0 m-3';
            toast.style.zIndex = '9999';
            toast.innerHTML = `
                <div class="d-flex">
                    <div class="toast-body">
                        <i class="fas fa-check me-2"></i>QR Code berhasil disalin!
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                </div>
            `;
            document.body.appendChild(toast);
            
            const bsToast = new bootstrap.Toast(toast);
            bsToast.show();
            
            // Remove toast after it's hidden
            toast.addEventListener('hidden.bs.toast', function() {
                document.body.removeChild(toast);
            });
        }).catch(function() {
            // Fallback for older browsers
            const textArea = document.createElement('textarea');
            textArea.value = text;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
            alert('QR Code disalin ke clipboard!');
        });
    }
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\firman\web1\my-laravel-app\resources\views/items/show.blade.php ENDPATH**/ ?>