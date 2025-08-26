<?php $__env->startSection('title', 'Detail Ruangan - ' . $room->name); ?>

<?php $__env->startSection('content'); ?>

<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="mb-0">
                    <i class="fas fa-door-open me-3"></i>
                    <?php echo e($room->name); ?>

                </h1>
                <p class="lead mb-0">
                    <?php if($room->floor): ?>
                        <i class="fas fa-building me-1"></i><?php echo e($room->floor); ?>

                    <?php endif; ?>
                    <?php if($room->floor && $room->description): ?> • <?php endif; ?>
                    <?php if($room->description): ?>
                        <?php echo e(Str::limit($room->description, 100)); ?>

                    <?php endif; ?>
                </p>
            </div>
            <div class="col-auto">
                <a href="<?php echo e(route('rooms.index')); ?>" class="btn btn-light">
                    <i class="fas fa-arrow-left me-2"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        <!-- Room Info -->
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Informasi Ruangan
                    </h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <div class="display-4 text-warning">
                            <i class="fas fa-door-open"></i>
                        </div>
                    </div>
                    
                    <table class="table table-borderless table-sm">
                        <tr>
                            <td class="fw-bold text-muted">Nama:</td>
                            <td><?php echo e($room->name); ?></td>
                        </tr>
                        <?php if($room->floor): ?>
                            <tr>
                                <td class="fw-bold text-muted">Lantai:</td>
                                <td>
                                    <span class="badge bg-secondary">
                                        <i class="fas fa-building me-1"></i><?php echo e($room->floor); ?>

                                    </span>
                                </td>
                            </tr>
                        <?php endif; ?>
                        <tr>
                            <td class="fw-bold text-muted">Total Barang:</td>
                            <td>
                                <span class="badge bg-primary fs-6">
                                    <?php echo e($room->items->count()); ?> barang
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td class="fw-bold text-muted">Dibuat:</td>
                            <td>
                                <?php echo e($room->created_at->format('d M Y')); ?>

                                <br>
                                <small class="text-muted"><?php echo e($room->created_at->diffForHumans()); ?></small>
                            </td>
                        </tr>
                    </table>
                    
                    <?php if($room->description): ?>
                        <div class="border-top pt-3 mt-3">
                            <h6 class="fw-bold text-muted mb-2">Deskripsi:</h6>
                            <p class="text-muted"><?php echo e($room->description); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
            
            <!-- Actions -->
            <div class="card mt-3">
                <div class="card-header">
                    <h6 class="mb-0">
                        <i class="fas fa-cogs me-2"></i>
                        Aksi
                    </h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="<?php echo e(route('rooms.edit', $room->id)); ?>" class="btn btn-warning">
                            <i class="fas fa-edit me-2"></i>
                            Edit Ruangan
                        </a>
                        
                        <a href="<?php echo e(route('items.create', ['room_id' => $room->id])); ?>" class="btn btn-primary">
                            <i class="fas fa-plus me-2"></i>
                            Tambah Barang di Ruangan Ini
                        </a>
                        
                        <button type="button" class="btn btn-info" onclick="printRoomItems()">
                            <i class="fas fa-print me-2"></i>
                            Cetak Daftar Barang
                        </button>
                        
                        <a href="<?php echo e(route('qr-scan.index')); ?>" class="btn btn-outline-primary">
                            <i class="fas fa-qrcode me-2"></i>
                            Scan QR Code
                        </a>
                        
                        <hr>
                        
                        <?php if($room->items->count() == 0): ?>
                            <button type="button" 
                                    class="btn btn-outline-danger"
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteModal">
                                <i class="fas fa-trash me-2"></i>
                                Hapus Ruangan
                            </button>
                        <?php else: ?>
                            <button type="button" class="btn btn-outline-secondary" disabled>
                                <i class="fas fa-trash me-2"></i>
                                Tidak dapat dihapus (ada barang)
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Items List -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="mb-0">
                                <i class="fas fa-box me-2"></i>
                                Barang di Ruangan Ini (<?php echo e($room->items->count()); ?>)
                            </h6>
                        </div>
                        <div class="col-auto">
                            <a href="<?php echo e(route('items.create', ['room_id' => $room->id])); ?>" 
                               class="btn btn-primary btn-sm">
                                <i class="fas fa-plus me-1"></i>Tambah Barang
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <?php if($room->items->count() > 0): ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>QR Code</th>
                                        <th>Merk</th>
                                        <th>Tipe</th>
                                        <th>Deskripsi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $room->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($index + 1); ?></td>
                                            <td>
                                                <code class="bg-light p-1 rounded"><?php echo e($item->qr_code); ?></code>
                                            </td>
                                            <td><strong><?php echo e($item->brand); ?></strong></td>
                                            <td><?php echo e($item->type); ?></td>
                                            <td>
                                                <?php if($item->description): ?>
                                                    <span class="text-muted"><?php echo e(Str::limit($item->description, 40)); ?></span>
                                                <?php else: ?>
                                                    <span class="text-muted font-italic">-</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <a href="<?php echo e(route('items.show', $item->id)); ?>" 
                                                       class="btn btn-outline-primary btn-sm"
                                                       title="Lihat Detail">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="<?php echo e(route('items.edit', $item->id)); ?>" 
                                                       class="btn btn-outline-warning btn-sm"
                                                       title="Edit">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                            <h6 class="text-muted">Belum ada barang di ruangan ini</h6>
                            <p class="text-muted">Mulai dengan menambahkan barang pertama untuk ruangan <?php echo e($room->name); ?>.</p>
                            <div class="mt-3">
                                <a href="<?php echo e(route('items.create', ['room_id' => $room->id])); ?>" 
                                   class="btn btn-primary me-2">
                                    <i class="fas fa-plus me-1"></i>Tambah Barang
                                </a>
                                <a href="<?php echo e(route('qr-scan.index')); ?>" class="btn btn-outline-primary">
                                    <i class="fas fa-qrcode me-1"></i>Scan QR Code
                                </a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<?php if($room->items->count() == 0): ?>
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-exclamation-triangle text-danger me-2"></i>
                    Konfirmasi Hapus Ruangan
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h6><i class="fas fa-warning me-2"></i>Peringatan!</h6>
                    <p class="mb-0">Tindakan ini tidak dapat dibatalkan. Ruangan akan dihapus secara permanen dari sistem.</p>
                </div>
                
                <p>Apakah Anda yakin ingin menghapus ruangan <strong><?php echo e($room->name); ?></strong>?</p>
                
                <div class="card">
                    <div class="card-body">
                        <table class="table table-sm table-borderless mb-0">
                            <tr>
                                <td class="fw-bold" style="width: 30%;">Nama:</td>
                                <td><?php echo e($room->name); ?></td>
                            </tr>
                            <?php if($room->floor): ?>
                                <tr>
                                    <td class="fw-bold">Lantai:</td>
                                    <td><?php echo e($room->floor); ?></td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <td class="fw-bold">Total Barang:</td>
                                <td><?php echo e($room->items->count()); ?> barang</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="fas fa-times me-1"></i>Batal
                </button>
                <form action="<?php echo e(route('rooms.destroy', $room->id)); ?>" method="POST" class="d-inline">
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
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
function printRoomItems() {
    const roomName = '<?php echo e($room->name); ?>';
    const roomFloor = '<?php echo e($room->floor); ?>';
    const roomDescription = '<?php echo e($room->description ? Str::limit($room->description, 100) : ''); ?>';
    const items = <?php echo json_encode($room->items, 15, 512) ?>;

    let itemsTableHtml = '';
    if (items.length > 0) {
        itemsTableHtml = `
            <h3>Daftar Barang</h3>
            <table class="print-table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>QR Code</th>
                        <th>Merk</th>
                        <th>Tipe</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
        `;
        items.forEach((item, index) => {
            itemsTableHtml += `
                <tr>
                    <td>${index + 1}</td>
                    <td>${item.qr_code}</td>
                    <td>${item.brand}</td>
                    <td>${item.type}</td>
                    <td>${item.description ? item.description.substring(0, 50) + (item.description.length > 50 ? '...' : '') : '-'}</td>
                </tr>
            `;
        });
        itemsTableHtml += `
                </tbody>
            </table>
        `;
    } else {
        itemsTableHtml = '<p>Tidak ada barang di ruangan ini.</p>';
    }

    const printWindow = window.open('', '_blank');
    if (printWindow) {
        printWindow.document.write(`
            <html>
                <head>
                    <title>Daftar Barang Ruangan: ${roomName}</title>
                    <style>
                        body { 
                            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; 
                            padding: 20px; 
                            color: #333;
                            line-height: 1.6;
                        }
                        .header { 
                            text-align: center; 
                            margin-bottom: 30px; 
                            border-bottom: 2px solid #8f0000; 
                            padding-bottom: 10px;
                        }
                        .header h1 { 
                            color: #8f0000; 
                            margin: 0; 
                            font-size: 28px;
                        }
                        .room-info { 
                            margin-bottom: 20px; 
                            border: 1px solid #eee; 
                            padding: 15px; 
                            border-radius: 8px;
                            background-color: #f9f9f9;
                        }
                        .room-info p { margin: 0 0 5px 0; }
                        .print-table { 
                            width: 100%; 
                            border-collapse: collapse; 
                            margin-top: 20px; 
                        }
                        .print-table th, .print-table td { 
                            border: 1px solid #ddd; 
                            padding: 8px; 
                            text-align: left; 
                            font-size: 14px;
                        }
                        .print-table th { 
                            background-color: #8f0000; 
                            color: white; 
                            font-weight: bold;
                        }
                        .print-table tbody tr:nth-child(even) { 
                            background-color: #f2f2f2; 
                        }
                        .footer { 
                            text-align: center; 
                            margin-top: 40px; 
                            font-size: 12px; 
                            color: #777;
                        }
                        @media print {
                            body { margin: 0; }
                            .header, .room-info, .print-table, .footer { 
                                page-break-inside: avoid; 
                                page-break-after: auto; 
                            }
                            @page { margin: 1cm; }
                        }
                    </style>
                </head>
                <body>
                    <div class="header">
                        <h1>Daftar Barang Ruangan</h1>
                        <p>Sistem Manajemen Barang KPU JATENG</p>
                    </div>
                    <div class="room-info">
                        <p><strong>Nama Ruangan:</strong> ${roomName}</p>
                        ${roomFloor ? '<p><strong>Lantai:</strong> ' + roomFloor + '</p>' : ''}
                        ${roomDescription ? '<p><strong>Deskripsi:</strong> ' + roomDescription + '</p>' : ''}
                    </div>
                    ${itemsTableHtml}
                    <div class="footer">
                        Dicetak pada: ${new Date().toLocaleDateString()} ${new Date().toLocaleTimeString()}
                    </div>
                </body>
            </html>
        `);
        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
        printWindow.close();
    } else {
        showToast('Gagal membuka jendela cetak.', 'error');
    }
}
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\firman\web1\simbakpu\resources\views/rooms/show.blade.php ENDPATH**/ ?>