

<?php $__env->startSection('title', 'Scan QR Code - Sistem Manajemen Barang Kantor'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <div class="container">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="mb-0">
                    <i class="fas fa-qrcode me-2 d-none d-md-inline"></i>
                    <span class="d-md-none">📷</span>
                    Scan QR Code
                </h1>
                <p class="lead mb-0 d-none d-md-block">Scan QR code barang untuk melihat detail atau menambah barang baru</p>
                <p class="mb-0 d-md-none"><small>Scan atau input kode QR</small></p>
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
                        <i class="fas fa-camera me-2"></i>
                        Scanner QR Code
                    </h5>
                </div>
                <div class="card-body p-3">
                    <!-- Scanner Area -->
                    <div class="qr-scanner mb-4">
                        <div class="text-center mb-3">
                            <div class="alert alert-info d-block d-sm-none" role="alert">
                                <i class="fas fa-mobile-alt me-2"></i>
                                <small>Posisikan QR code di tengah frame kamera</small>
                            </div>
                            <div class="alert alert-info d-none d-sm-block" role="alert">
                                <i class="fas fa-camera me-2"></i>
                                Pastikan QR code terlihat jelas dalam frame kamera untuk scanning otomatis
                            </div>
                        </div>
                        
                        <div class="scanner-container mx-auto" style="max-width: 400px;">
                            <div id="qr-reader" class="border rounded p-2" style="width: 100%;"></div>
                        </div>
                        
                        <div id="qr-reader-results" class="mt-3"></div>
                        
                        <!-- Camera Controls -->
                        <div class="text-center mt-3" id="camera-controls" style="display: none;">
                            <button type="button" 
                                    class="btn btn-outline-maroon btn-sm" 
                                    id="switch-camera-btn" 
                                    onclick="switchCamera()"
                                    title="Ganti Kamera">
                                <i class="fas fa-sync-alt me-1"></i>
                                <span class="d-none d-sm-inline">Switch Kamera</span>
                                <span class="d-sm-none">Switch</span>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Manual Input Form -->
                    <div class="border-top pt-4">
                        <h6 class="mb-3">
                            <i class="fas fa-keyboard me-2"></i>
                            <span class="d-none d-sm-inline">Atau Masukkan Kode Secara Manual</span>
                            <span class="d-sm-none">Input Manual</span>
                        </h6>
                        <form action="<?php echo e(route('qr-scan.scan')); ?>" method="POST" id="manual-form">
                            <?php echo csrf_field(); ?>
                            <div class="row g-2">
                                <div class="col-12 col-sm-8">
                                    <input type="text" 
                                           class="form-control" 
                                           name="qr_code" 
                                           id="qr_code"
                                           placeholder="Masukkan kode QR..."
                                           required>
                                </div>
                                <div class="col-12 col-sm-4">
                                    <button type="submit" class="btn btn-primary w-100">
                                        <i class="fas fa-search me-1 d-none d-sm-inline"></i>
                                        <span class="d-sm-none">🔍</span>
                                        <span class="d-none d-sm-inline">Cari</span>
                                        <span class="d-sm-none">Cari</span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Instructions -->
            <div class="card mt-4">
                <div class="card-header">
                    <h5 class="mb-0">
                        <i class="fas fa-info-circle me-2"></i>
                        Cara Menggunakan Scanner
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h6><i class="fas fa-camera text-primary me-2"></i>Menggunakan Kamera</h6>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-success me-2"></i>Arahkan kamera ke QR code</li>
                                <li><i class="fas fa-check text-success me-2"></i>Pastikan QR code terlihat jelas</li>
                                <li><i class="fas fa-check text-success me-2"></i>Tunggu hingga terbaca otomatis</li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <h6><i class="fas fa-keyboard text-warning me-2"></i>Input Manual</h6>
                            <ul class="list-unstyled">
                                <li><i class="fas fa-check text-success me-2"></i>Ketik kode QR secara manual</li>
                                <li><i class="fas fa-check text-success me-2"></i>Klik tombol "Cari Barang"</li>
                                <li><i class="fas fa-check text-success me-2"></i>Sistem akan mencari barang</li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="alert alert-info mt-3">
                        <h6><i class="fas fa-lightbulb me-2"></i>Yang Terjadi Setelah Scan:</h6>
                        <ul class="mb-0">
                            <li><strong>Jika barang ditemukan:</strong> Akan langsung menuju halaman detail barang</li>
                            <li><strong>Jika barang tidak ditemukan:</strong> Akan menuju halaman tambah barang baru dengan kode QR yang sudah terisi</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    #qr-reader {
        border: 2px dashed var(--primary-maroon);
        border-radius: 10px;
        padding: 20px;
        background: rgba(128, 0, 32, 0.1);
        min-height: 250px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    #qr-reader video {
        max-width: 100% !important;
        height: auto !important;
        border-radius: 8px;
    }
    
    #qr-reader__dashboard_section_swaplink {
        text-decoration: none;
        color: var(--primary-maroon);
    }
    
    #qr-reader__dashboard_section_swaplink:hover {
        color: var(--secondary-maroon);
    }
    
    .camera-permission-alert {
        background: linear-gradient(135deg, rgba(128, 0, 32, 0.1), rgba(160, 0, 42, 0.1));
        border: 1px solid var(--primary-maroon);
        border-radius: 10px;
        padding: 1rem;
        margin: 1rem 0;
    }
    
    /* Camera controls styling */
    #camera-controls {
        animation: fadeIn 0.5s ease-in-out;
    }
    
    #camera-controls .btn {
        margin: 0 2px;
        transition: all 0.3s ease;
    }
    
    #camera-controls .btn:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    
    #camera-controls .btn.disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    /* Mobile optimizations */
    @media (max-width: 768px) {
        #qr-reader {
            padding: 15px;
            min-height: 200px;
        }
        
        .qr-scanner {
            padding: 1rem;
        }
        
        #camera-controls .btn {
            font-size: 0.8rem;
            padding: 0.5rem;
            margin: 0 1px;
        }
        
        #camera-controls .btn span {
            display: none;
        }
        
        #camera-controls .btn i {
            margin-right: 0 !important;
        }
    }
    
    /* Tablet optimizations */
    @media (min-width: 768px) and (max-width: 1024px) {
        #qr-reader {
            min-height: 300px;
        }
    }
    
    /* Loading spinner animation */
    .loading-spinner {
        width: 40px;
        height: 40px;
        border: 4px solid rgba(128, 0, 32, 0.3);
        border-top: 4px solid var(--primary-maroon);
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin: 0 auto;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    /* Toast animations */
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
    
    /* Enhanced button states */
    .btn:disabled {
        opacity: 0.6 !important;
        cursor: not-allowed !important;
        transform: none !important;
    }
    
    /* Enhanced video styling */
    #qr-reader video {
        border-radius: 12px !important;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1) !important;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let html5QrCode = null;
    let isScanning = false;
    let scannerStarted = false;
    let availableCameras = [];
    let currentCameraIndex = 0;
    let currentFacingMode = "environment"; // Start with back camera
    
    // Simple configuration
    const config = {
        fps: 10,
        qrbox: { width: 250, height: 250 },
        aspectRatio: 1.0
    };
    
    // Initialize scanner
    function initScanner() {
        if (scannerStarted) return;
        
        console.log('Initializing QR Scanner...');
        html5QrCode = new Html5Qrcode("qr-reader");
        
        // Show loading message
        document.getElementById('qr-reader').innerHTML = `
            <div class="text-center p-4">
                <div class="spinner-border text-primary mb-3" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <h6 class="text-primary">Mengakses Kamera...</h6>
                <p class="text-muted small">Mohon izinkan akses kamera</p>
            </div>
        `;
        
        startCamera();
    }
    
    // Start camera
    function startCamera() {
        // Try to get cameras first to enable camera switching
        Html5Qrcode.getCameras().then(devices => {
            console.log('Found cameras:', devices);
            availableCameras = devices;
            
            if (devices && devices.length > 1) {
                // Show switch button if multiple cameras available
                document.getElementById('switch-camera-btn').style.display = 'inline-block';
            } else {
                document.getElementById('switch-camera-btn').style.display = 'none';
            }
            
            if (devices && devices.length > 0) {
                // Find back camera first
                let backCamera = devices.find(device => 
                    device.label.toLowerCase().includes('back') ||
                    device.label.toLowerCase().includes('environment') ||
                    device.label.toLowerCase().includes('rear')
                );
                
                if (backCamera) {
                    currentCameraIndex = devices.indexOf(backCamera);
                    startScanningWithCamera(backCamera.id);
                } else {
                    // Use first camera
                    currentCameraIndex = 0;
                    startScanningWithCamera(devices[0].id);
                }
            } else {
                console.log('No cameras found, trying with constraints');
                startScanningWithConstraints();
            }
        }).catch(err => {
            console.error('Error getting cameras:', err);
            startScanningWithConstraints();
        });
    }
    
    // Start scanning with camera ID
    function startScanningWithCamera(cameraId) {
        html5QrCode.start(
            cameraId,
            config,
            onScanSuccess,
            onScanFailure
        ).then(() => {
            console.log('Scanner started successfully');
            isScanning = true;
            scannerStarted = true;
            showCameraControls();
        }).catch(err => {
            console.error('Error starting scanner with camera ID:', err);
            showCameraError(err);
        });
    }
    
    // Start scanning with constraints (fallback)
    function startScanningWithConstraints() {
        console.log('Trying with camera constraints...');
        
        html5QrCode.start(
            { facingMode: currentFacingMode },
            config,
            onScanSuccess,
            onScanFailure
        ).then(() => {
            console.log(`Scanner started with ${currentFacingMode} camera`);
            isScanning = true;
            scannerStarted = true;
            showCameraControls();
        }).catch(err => {
            console.error(`${currentFacingMode} camera failed:`, err);
            
            // Try the other camera
            const fallbackMode = currentFacingMode === "environment" ? "user" : "environment";
            html5QrCode.start(
                { facingMode: fallbackMode },
                config,
                onScanSuccess,
                onScanFailure
            ).then(() => {
                console.log(`Scanner started with ${fallbackMode} camera`);
                currentFacingMode = fallbackMode;
                isScanning = true;
                scannerStarted = true;
                showCameraControls();
            }).catch(err2 => {
                console.error('Both cameras failed:', err2);
                showCameraError(err2);
            });
        });
    }
    
    // Success callback
    function onScanSuccess(decodedText, decodedResult) {
        console.log('QR Code scanned:', decodedText);
        
        if (!isScanning) return;
        isScanning = false;
        
        // Stop scanning immediately
        html5QrCode.stop().then(() => {
            console.log('Scanner stopped');
        }).catch(err => {
            console.error('Error stopping scanner:', err);
        });
        
        // Show success message
        document.getElementById('qr-reader').innerHTML = `
            <div class="text-center p-4">
                <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                <h5 class="text-success">QR Code Berhasil Dipindai!</h5>
                <p class="text-muted">Kode: <strong>${decodedText}</strong></p>
                <p class="text-muted">Memproses data...</p>
            </div>
        `;
        
        // Hide camera controls
        document.getElementById('camera-controls').style.display = 'none';
        
        // Submit QR code
        setTimeout(() => {
            submitQRCode(decodedText);
        }, 1500);
    }
    
    // Failure callback (silent)
    function onScanFailure(error) {
        // Do nothing for scan failures (they happen frequently)
    }
    
    // Show camera controls
    function showCameraControls() {
        const controls = document.getElementById('camera-controls');
        if (controls) {
            controls.style.display = 'block';
        }
    }
    
    // Show camera error
    function showCameraError(error) {
        let errorMessage = 'Tidak dapat mengakses kamera';
        let suggestion = 'Pastikan Anda memberikan izin akses kamera';
        
        if (error.name === 'NotAllowedError' || error.message.includes('Permission denied')) {
            errorMessage = 'Akses kamera ditolak';
            suggestion = 'Klik pada ikon kamera di address bar dan izinkan akses kamera';
        } else if (error.name === 'NotFoundError') {
            errorMessage = 'Kamera tidak ditemukan';
            suggestion = 'Pastikan perangkat memiliki kamera yang berfungsi';
        } else if (error.name === 'NotReadableError') {
            errorMessage = 'Kamera sedang digunakan';
            suggestion = 'Tutup aplikasi lain yang menggunakan kamera';
        } else if (error.name === 'NotSupportedError') {
            errorMessage = 'Browser tidak mendukung';
            suggestion = 'Gunakan browser Chrome, Firefox, atau Safari terbaru';
        }
        
        document.getElementById('qr-reader').innerHTML = `
            <div class="text-center p-4">
                <i class="fas fa-exclamation-triangle fa-3x text-warning mb-3"></i>
                <h6 class="text-danger">${errorMessage}</h6>
                <p class="text-muted small mb-3">${suggestion}</p>
                <button class="btn btn-primary btn-sm" onclick="retryCamera()">
                    <i class="fas fa-redo me-1"></i>Coba Lagi
                </button>
                <hr class="my-3">
                <p class="text-muted small">Atau gunakan input manual di bawah ini</p>
            </div>
        `;
    }
    
    // Submit QR code with proper routing
    function submitQRCode(qrCode) {
        console.log('Submitting QR code:', qrCode);
        
        // Send AJAX request to check if item exists
        fetch('<?php echo e(route("qr-scan.search")); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ qr_code: qrCode })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Item found - redirect to item detail
                document.getElementById('qr-reader').innerHTML = `
                    <div class="text-center p-4">
                        <i class="fas fa-check-circle fa-3x text-success mb-3"></i>
                        <h5 class="text-success">Barang Ditemukan!</h5>
                        <p class="text-muted">Mengarahkan ke halaman detail...</p>
                    </div>
                `;
                setTimeout(() => {
                    window.location.href = data.redirect;
                }, 1000);
            } else {
                // Item not found - redirect to create page
                document.getElementById('qr-reader').innerHTML = `
                    <div class="text-center p-4">
                        <i class="fas fa-plus-circle fa-3x text-info mb-3"></i>
                        <h5 class="text-info">Barang Tidak Ditemukan</h5>
                        <p class="text-muted">Mengarahkan ke halaman tambah barang...</p>
                    </div>
                `;
                setTimeout(() => {
                    window.location.href = `<?php echo e(route('items.create')); ?>?qr_code=${encodeURIComponent(qrCode)}`;
                }, 1500);
            }
        })
        .catch(error => {
            console.error('Error processing QR code:', error);
            // Fallback to form submission
            const form = document.getElementById('manual-form');
            const input = document.getElementById('qr_code');
            
            if (form && input) {
                input.value = qrCode;
                form.submit();
            } else {
                window.location.href = `<?php echo e(route('qr-scan.scan')); ?>?qr_code=${encodeURIComponent(qrCode)}`;
            }
        });
    }
    
    // Switch camera function
    window.switchCamera = function() {
        if (!isScanning || !html5QrCode) {
            console.warn('Scanner not active');
            return;
        }
        
        console.log('Switching camera...');
        
        // Show switching feedback
        const switchBtn = document.getElementById('switch-camera-btn');
        const originalContent = switchBtn.innerHTML;
        switchBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-1"></i><span class="d-none d-sm-inline">Switching...</span>';
        switchBtn.disabled = true;
        
        // Stop current scanner
        html5QrCode.stop().then(() => {
            isScanning = false;
            
            if (availableCameras.length > 1) {
                // Switch to next camera in the list
                currentCameraIndex = (currentCameraIndex + 1) % availableCameras.length;
                const nextCamera = availableCameras[currentCameraIndex];
                
                console.log(`Switching to camera: ${nextCamera.label}`);
                
                // Show loading with camera info
                document.getElementById('qr-reader').innerHTML = `
                    <div class="text-center p-4">
                        <div class="spinner-border text-primary mb-3" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <h6 class="text-primary">Mengganti Kamera...</h6>
                        <p class="text-muted small">${nextCamera.label || 'Kamera ' + (currentCameraIndex + 1)}</p>
                    </div>
                `;
                
                // Start with new camera
                setTimeout(() => {
                    startScanningWithCamera(nextCamera.id);
                    switchBtn.innerHTML = originalContent;
                    switchBtn.disabled = false;
                }, 800);
                
            } else {
                // Switch between environment and user if no camera list
                currentFacingMode = currentFacingMode === "environment" ? "user" : "environment";
                
                console.log(`Switching to ${currentFacingMode} camera`);
                
                document.getElementById('qr-reader').innerHTML = `
                    <div class="text-center p-4">
                        <div class="spinner-border text-primary mb-3" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <h6 class="text-primary">Mengganti Kamera...</h6>
                        <p class="text-muted small">Kamera ${currentFacingMode === "environment" ? "Belakang" : "Depan"}</p>
                    </div>
                `;
                
                setTimeout(() => {
                    startScanningWithConstraints();
                    switchBtn.innerHTML = originalContent;
                    switchBtn.disabled = false;
                }, 800);
            }
            
        }).catch(err => {
            console.error('Error switching camera:', err);
            switchBtn.innerHTML = originalContent;
            switchBtn.disabled = false;
        });
    };
    
    // Retry function
    window.retryCamera = function() {
        console.log('Retrying camera access...');
        scannerStarted = false;
        isScanning = false;
        
        if (html5QrCode) {
            html5QrCode.stop().then(() => {
                html5QrCode.clear();
                initScanner();
            }).catch(() => {
                initScanner();
            });
        } else {
            initScanner();
        }
    };
    
    // Check browser support
    if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
        document.getElementById('qr-reader').innerHTML = `
            <div class="text-center p-4">
                <i class="fas fa-times-circle fa-3x text-danger mb-3"></i>
                <h6 class="text-danger">Browser Tidak Didukung</h6>
                <p class="text-muted small">Gunakan Chrome, Firefox, atau Safari terbaru</p>
            </div>
        `;
        return;
    }
    
    // Start scanner
    initScanner();
    
    // Handle page visibility
    document.addEventListener('visibilitychange', function() {
        if (document.hidden && html5QrCode && isScanning) {
            html5QrCode.pause(true);
        } else if (!document.hidden && html5QrCode && isScanning) {
            html5QrCode.resume();
        }
    });
    
    // Cleanup on unload
    window.addEventListener('beforeunload', function() {
        if (html5QrCode && isScanning) {
            html5QrCode.stop();
        }
    });
});
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\firman\web1\my-laravel-app\resources\views/qr-scan/index.blade.php ENDPATH**/ ?>