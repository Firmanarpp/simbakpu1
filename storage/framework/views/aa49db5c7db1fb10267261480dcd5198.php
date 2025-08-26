
<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <meta name="description" content="Sistem Manajemen Barang KPU - Kelola inventaris dengan mudah">
        <meta name="theme-color" content="#dc2626">

        
        <title><?php echo $__env->yieldContent('title', 'Sistem Manajemen Barang KPU JATENG'); ?></title>

        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer">
        
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Check if FontAwesome loaded
                const testElement = document.createElement('i');
                testElement.className = 'fas fa-home';
                testElement.style.display = 'none';
                document.body.appendChild(testElement);
                
                const style = window.getComputedStyle(testElement);
                if (style.fontFamily.indexOf('Font Awesome') === -1) {
                    console.warn('FontAwesome failed to load, loading fallback...');
                    const fallbackLink = document.createElement('link');
                    fallbackLink.rel = 'stylesheet';
                    fallbackLink.href = 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css';
                    document.head.appendChild(fallbackLink);
                }
                
                document.body.removeChild(testElement);
            });
        </script>
        
        
        <link rel="preconnect" href="https://cdn.jsdelivr.net">
        <link rel="preconnect" href="https://cdnjs.cloudflare.com">
        
        
        <link rel="manifest" href="/manifest.json">
        
        
        <link rel="apple-touch-icon" href="/favicon.ico">
        
        
        <style>
            /* ====================================================================
               CSS VARIABLES - KPU MAROON THEME
               ==================================================================== */
            :root {
                /* Primary Maroon Colors */
                --primary-maroon: #8f0000ff;
                --secondary-maroon: #8f0000ff;
                --dark-maroon: #8f0000ff;
                --light-maroon: #8f0000ff;
                --accent-maroon: #8f0000ff;
                
                /* Neutral Colors */
                --pure-white: #ffffff;
                --light-gray: #f8f9fa;
                --off-white: #fefefe;
                --dark-gray: #2c2c2c;
                --border-color: #e5e7eb;
                
                /* Shadow Colors */
                --shadow-maroon: rgba(128, 0, 32, 0.1);
                --shadow-medium: rgba(128, 0, 32, 0.15);
                --shadow-heavy: rgba(128, 0, 32, 0.25);
            }

            body {
                background: linear-gradient(135deg, var(--pure-white) 0%, var(--off-white) 50%, #f5f5f5 100%);
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                line-height: 1.6;
            }

            /* Navbar Styling */
            .navbar {
                background: linear-gradient(135deg, var(--primary-maroon) 0%, var(--secondary-maroon) 100%) !important;
                box-shadow: 0 4px 20px var(--shadow-medium);
                border: none;
                padding: 1rem 0;
            }

            .navbar-brand {
                font-weight: 700;
                font-size: 1.5rem;
                color: var(--pure-white) !important;
                text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            }

            .navbar-nav .nav-link {
                color: var(--pure-white) !important;
                font-weight: 500;
                margin: 0 0.5rem;
                padding: 0.75rem 1rem !important;
                border-radius: 8px;
                transition: all 0.3s ease;
                position: relative;
            }

            .navbar-nav .nav-link:hover {
                background: rgba(255, 255, 255, 0.2);
                transform: translateY(-2px);
                box-shadow: 0 4px 12px rgba(0,0,0,0.2);
            }

            .navbar-nav .nav-link.active {
                background: rgba(255, 255, 255, 0.25);
                box-shadow: 0 4px 12px rgba(0,0,0,0.3);
                font-weight: 600;
            }

            .navbar-nav .nav-link.active::before {
                content: '';
                position: absolute;
                bottom: -2px;
                left: 50%;
                transform: translateX(-50%);
                width: 80%;
                height: 3px;
                background: var(--pure-white);
                border-radius: 2px;
            }

            .navbar-toggler {
                border: 2px solid var(--pure-white);
                padding: 0.5rem;
            }

            .navbar-toggler-icon {
                filter: brightness(0) invert(1);
            }

            /* Page Header */
            .page-header {
                background: linear-gradient(135deg, var(--primary-maroon) 0%, var(--secondary-maroon) 50%, var(--light-maroon) 100%);
                color: var(--pure-white);
                padding: 4rem 0;
                margin-bottom: 2rem;
                position: relative;
                overflow: hidden;
            }

            .page-header::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="50" cy="50" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
                opacity: 0.3;
            }

            .page-header h1 {
                font-size: 2.5rem;
                font-weight: 700;
                text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
                position: relative;
                z-index: 1;
            }

            .page-header .lead {
                font-size: 1.2rem;
                opacity: 0.9;
                position: relative;
                z-index: 1;
            }

            /* Cards */
            .card {
                border: none;
                border-radius: 16px;
                box-shadow: 0 8px 32px var(--shadow-light);
                transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
                background: var(--pure-white);
                overflow: hidden;
                position: relative;
            }

            .card::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 4px;
                background: linear-gradient(90deg, var(--primary-maroon) 0%, var(--secondary-maroon) 50%, var(--light-maroon) 100%);
            }

            .card:hover {
                transform: translateY(-8px) scale(1.02);
                box-shadow: 0 20px 60px var(--shadow-medium);
            }

            .stats-card {
                border-radius: 20px;
                background: var(--pure-white);
                border: 2px solid transparent;
                background-clip: padding-box;
                position: relative;
            }

            .stats-card::before {
                content: '';
                position: absolute;
                top: -2px;
                left: -2px;
                right: -2px;
                bottom: -2px;
                background: linear-gradient(135deg, var(--primary-maroon), var(--secondary-maroon), var(--light-maroon));
                border-radius: 20px;
                z-index: -1;
            }

            .stats-card:hover {
                transform: translateY(-5px) rotate(1deg);
                box-shadow: 0 15px 40px var(--shadow-heavy);
            }

            /* Buttons */
            .btn {
                border-radius: 12px;
                padding: 0.75rem 2rem;
                font-weight: 600;
                border: none;
                transition: all 0.3s ease;
                position: relative;
                overflow: hidden;
            }

            .btn::before {
                content: '';
                position: absolute;
                top: 50%;
                left: 50%;
                width: 0;
                height: 0;
                background: rgba(255, 255, 255, 0.2);
                border-radius: 50%;
                transform: translate(-50%, -50%);
                transition: width 0.6s, height 0.6s;
            }

            .btn:hover::before {
                width: 300px;
                height: 300px;
            }

            .btn-primary {
                background: linear-gradient(135deg, var(--primary-maroon) 0%, var(--secondary-maroon) 100%);
                color: var(--pure-white);
                box-shadow: 0 4px 15px var(--shadow-maroon);
                border: none;
            }

            .btn-primary:hover {
                transform: translateY(-3px);
                box-shadow: 0 8px 25px var(--shadow-medium);
                background: linear-gradient(135deg, var(--secondary-maroon) 0%, var(--light-maroon) 100%);
                color: var(--pure-white);
            }

            .btn-outline-primary {
                border: 2px solid var(--primary-maroon);
                color: var(--primary-maroon);
                background: transparent;
            }

            .btn-outline-primary:hover {
                background: var(--primary-maroon);
                color: var(--pure-white);
                transform: translateY(-3px);
                box-shadow: 0 8px 25px var(--shadow-medium);
                border-color: var(--primary-maroon);
            }

            .btn-light {
                background: var(--pure-white);
                color: var(--primary-maroon);
                border: 2px solid var(--pure-white);
                box-shadow: 0 4px 15px rgba(255, 255, 255, 0.3);
            }

            .btn-light:hover {
                background: #f8f9fa;
                color: var(--primary-maroon);
                transform: translateY(-3px);
            }

            .btn-white {
                background: var(--pure-white) !important;
                color: var(--dark-gray) !important;
                border: 2px solid var(--pure-white) !important;
                box-shadow: 0 4px 15px rgba(255, 255, 255, 0.4) !important;
                font-weight: 600;
            }

            .btn-white:hover {
                background: #f8f9fa !important;
                color: var(--primary-maroon) !important;
                transform: translateY(-2px);
                box-shadow: 0 6px 20px rgba(255, 255, 255, 0.6) !important;
            }

            .btn-white:focus,
            .btn-white:active {
                background: #e9ecef !important;
                color: var(--primary-maroon) !important;
                box-shadow: 0 2px 10px rgba(255, 255, 255, 0.4) !important;
            }

            /* Improved outline buttons for better visibility */
            .btn-outline-light {
                color: var(--pure-white) !important;
                border-color: var(--pure-white) !important;
                background: rgba(255, 255, 255, 0.1) !important;
                backdrop-filter: blur(5px);
            }

            .btn-outline-light:hover {
                color: var(--primary-red) !important;
                background: var(--pure-white) !important;
                border-color: var(--pure-white) !important;
                transform: translateY(-2px);
                box-shadow: 0 4px 15px rgba(255, 255, 255, 0.3) !important;
            }

            .btn-outline-light:focus,
            .btn-outline-light:active {
                color: var(--primary-red) !important;
                background: var(--pure-white) !important;
                border-color: var(--pure-white) !important;
                box-shadow: 0 0 0 0.25rem rgba(255, 255, 255, 0.5) !important;
            }

            .btn-danger {
                background: linear-gradient(135deg, var(--dark-maroon) 0%, var(--primary-maroon) 100%);
                color: var(--pure-white);
                border: none;
            }

            .btn-danger:hover {
                background: linear-gradient(135deg, var(--primary-maroon) 0%, var(--secondary-maroon) 100%);
                color: var(--pure-white);
            }

            .btn-secondary {
                background: var(--dark-gray);
                color: var(--pure-white);
            }

            /* Alerts */
            .alert {
                border: none;
                border-radius: 12px;
                padding: 1rem 1.5rem;
                margin: 1rem 0;
                box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            }

            .alert-success {
                background: linear-gradient(135deg, #10b981 0%, #059669 100%);
                color: var(--pure-white);
            }

            .alert-danger {
                background: linear-gradient(135deg, var(--primary-maroon) 0%, var(--dark-maroon) 100%);
                color: var(--pure-white);
            }

            /* Footer */
            footer {
                background: linear-gradient(135deg, var(--dark-gray) 0%, #374151 100%);
                color: var(--pure-white);
                padding: 3rem 0;
                margin-top: auto;
                position: relative;
            }

            footer::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                height: 4px;
                background: linear-gradient(90deg, var(--primary-maroon) 0%, var(--secondary-maroon) 50%, var(--light-maroon) 100%);
            }

            /* Layout */
            .min-vh-100 {
                min-height: 100vh;
                display: flex;
                flex-direction: column;
            }

            main {
                flex: 1;
                padding-bottom: 2rem;
            }

            .container {
                position: relative;
                z-index: 1;
            }

            /* Form Elements */
            .form-control {
                border-radius: 10px;
                border: 2px solid var(--border-color);
                padding: 0.75rem 1rem;
                transition: all 0.3s ease;
            }

            .form-control:focus {
                border-color: var(--primary-maroon);
                box-shadow: 0 0 0 0.25rem var(--shadow-maroon);
            }

            .form-label {
                font-weight: 600;
                color: var(--dark-gray);
                margin-bottom: 0.5rem;
            }

            /* Tables */
            .table {
                background: var(--pure-white);
                border-radius: 12px;
                overflow: hidden;
                box-shadow: 0 4px 20px var(--shadow-light);
            }

            .table thead th {
                background: linear-gradient(135deg, var(--primary-maroon) 0%, var(--secondary-maroon) 100%);
                color: var(--pure-white);
                border: none;
                font-weight: 600;
                padding: 1rem;
            }

            .table tbody td {
                padding: 1rem;
                border-bottom: 1px solid var(--border-color);
                vertical-align: middle;
            }

            .table tbody tr:hover {
                background: rgba(128, 0, 32, 0.05);
                transform: scale(1.01);
                transition: all 0.3s ease;
            }

            /* Extra responsive design */
            @media (max-width: 480px) {
                .page-header {
                    padding: 1.5rem 0;
                }

                .page-header h1 {
                    font-size: 1.5rem;
                }

                .page-header .lead {
                    font-size: 1rem;
                }

                .container {
                    padding: 0 0.75rem;
                }

                .card {
                    border-radius: 12px;
                }

                .btn {
                    font-size: 0.85rem;
                    padding: 0.6rem 1.2rem;
                }

                .navbar-brand {
                    font-size: 1.1rem;
                }

                .table thead th {
                    padding: 0.75rem 0.5rem;
                    font-size: 0.8rem;
                }

                .table tbody td {
                    padding: 0.75rem 0.5rem;
                    font-size: 0.85rem;
                }

                .modal-dialog {
                    margin: 1rem 0.5rem;
                }

                .stats-card .display-6 {
                    font-size: 1.5rem;
                }

                .stats-card .card-title {
                    font-size: 0.9rem;
                }
            }

            @media (max-width: 375px) {
                .page-header h1 {
                    font-size: 1.25rem;
                }

                .navbar-brand span {
                    font-size: 0.9rem;
                }

                .btn-group .btn {
                    padding: 0.4rem 0.8rem;
                    font-size: 0.75rem;
                }

                .card-header h5 {
                    font-size: 1rem;
                }

                .container {
                    padding: 0 0.5rem;
                }
            }

            /* Touch improvements */
            @media (hover: none) and (pointer: coarse) {
                .btn {
                    min-height: 44px;
                    min-width: 44px;
                }

                .nav-link {
                    min-height: 44px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }

                .table tbody tr {
                    cursor: pointer;
                }

                .card:hover {
                    transform: none;
                }

                .stats-card:hover {
                    transform: none;
                }
            }

            /* Utility classes */
            .text-red {
                color: var(--primary-maroon) !important;
            }

            .text-orange {
                color: var(--secondary-maroon) !important;
            }

            .bg-red {
                background-color: var(--primary-maroon) !important;
            }

            .bg-orange {
                background-color: var(--secondary-maroon) !important;
            }

            .bg-gradient-orange {
                background: linear-gradient(135deg, var(--primary-maroon) 0%, var(--secondary-maroon) 50%, var(--light-maroon) 100%) !important;
            }

            .bg-gradient-red {
                background: linear-gradient(135deg, var(--primary-maroon) 0%, var(--dark-maroon) 100%) !important;
            }

            .border-red {
                border-color: var(--primary-maroon) !important;
            }

            .border-orange {
                border-color: var(--secondary-maroon) !important;
            }

            /* Improved text contrast */
            .text-dark {
                color: var(--dark-gray) !important;
                font-weight: 600;
            }

            .text-primary {
                color: var(--primary-maroon) !important;
                font-weight: 600;
            }

            /* Button text improvements */
            .btn .text-dark {
                color: var(--dark-gray) !important;
            }

            .btn .text-primary {
                color: var(--primary-maroon) !important;
            }

            .btn .fw-bold {
                font-weight: 700 !important;
            }

            /* Card header button improvements */
            .card-header .btn {
                text-shadow: none;
                min-height: 32px;
                display: inline-flex;
                align-items: center;
                justify-content: center;
            }

            /* Ensure icons are visible */
            .fas, .far, .fab {
                font-weight: 900;
            }

            /* Badge text improvements */
            .badge {
                text-shadow: none;
                font-weight: 600;
            }

            /* Table text improvements */
            .table th {
                font-weight: 700;
                text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
            }

            .table td {
                font-weight: 500;
            }

            /* Form label improvements */
            .form-label {
                font-weight: 600;
                color: var(--dark-gray);
                text-shadow: none;
            }

            /* Alert text improvements */
            .alert {
                text-shadow: none;
                font-weight: 500;
            }

            .alert .fas {
                margin-right: 0.5rem;
            }

            /* List group improvements */
            .list-group-item {
                border-left: none;
                border-right: none;
                transition: all 0.2s ease;
            }

            .list-group-item:first-child {
                border-top: none;
            }

            .list-group-item:last-child {
                border-bottom: none;
            }

            .list-group-item-action:hover {
                background-color: rgba(128, 0, 32, 0.05);
                transform: translateX(3px);
            }

            /* Dashboard specific improvements */
            .dashboard-item-list .list-group-item {
                padding: 1rem;
            }

            .dashboard-room-list .list-group-item {
                padding: 1rem;
            }

            /* Quick action buttons */
            .quick-action-btn {
                transition: all 0.3s ease;
                border: 2px solid transparent;
                min-height: 100px;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                text-decoration: none;
            }

            .quick-action-btn:hover {
                transform: translateY(-5px);
                box-shadow: 0 8px 25px rgba(0,0,0,0.15);
                border-color: currentColor;
            }

            /* Card footer improvements */
            .card-footer {
                background-color: #f8f9fa !important;
                border-top: 1px solid #dee2e6;
            }

            /* Badge in list improvements */
            .list-group-item .badge {
                font-size: 0.7rem;
                padding: 0.25rem 0.5rem;
            }

            /* Mobile improvements for dashboard */
            @media (max-width: 768px) {
                .dashboard-item-list .list-group-item,
                .dashboard-room-list .list-group-item {
                    padding: 0.75rem;
                }

                .quick-action-btn {
                    min-height: 80px;
                    font-size: 0.875rem;
                }

                .quick-action-btn .fs-3 {
                    font-size: 1.5rem !important;
                }
                
                /* Ensure consistent stats card layout */
                .stats-card .card-body {
                    padding: 1rem !important;
                }
                
                .stats-card .display-6 {
                    font-size: 2rem !important;
                }
                
                .stats-card h6 {
                    font-size: 0.9rem;
                }
                
                .stats-card h3 {
                    font-size: 1.5rem;
                }
                
                /* Consistent page header */
                .page-header h1 {
                    font-size: 1.8rem !important;
                }
                
                .page-header .lead {
                    font-size: 1rem !important;
                    display: block !important;
                }
            }

            /* Fixed elements for mobile */
            .navbar {
                position: sticky;
                top: 0;
                z-index: 1030;
            }

            /* Improved form controls for mobile */
            @media (max-width: 768px) {
                .form-control {
                    font-size: 16px; /* Prevents zoom on iOS */
                    padding: 0.75rem;
                }

                .form-select {
                    font-size: 16px;
                    padding: 0.75rem;
                }

                .input-group .form-control {
                    font-size: 16px;
                }
            }

            /* Custom animations */
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(30px);
                }
                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            .card {
                animation: fadeInUp 0.6s ease-out;
            }

            .stats-card:nth-child(1) { animation-delay: 0.1s; }
            .stats-card:nth-child(2) { animation-delay: 0.2s; }
            .stats-card:nth-child(3) { animation-delay: 0.3s; }
            .stats-card:nth-child(4) { animation-delay: 0.4s; }

            /* Badge styling */
            .badge {
                border-radius: 8px;
                padding: 0.5rem 1rem;
                font-weight: 600;
            }

            .badge.bg-primary {
                background: linear-gradient(135deg, var(--primary-maroon) 0%, var(--secondary-maroon) 100%) !important;
            }

            .badge.bg-warning {
                background: linear-gradient(135deg, var(--secondary-maroon) 0%, var(--light-maroon) 100%) !important;
                color: var(--pure-white) !important;
            }

            /* Modal styling */
            .modal-content {
                border-radius: 16px;
                border: none;
                box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            }

            .modal-header {
                background: linear-gradient(135deg, var(--primary-maroon) 0%, var(--secondary-maroon) 100%);
                color: var(--pure-white);
                border-radius: 16px 16px 0 0;
            }

            .modal-title {
                font-weight: 600;
            }

            /* Loading states */
            .btn:disabled {
                opacity: 0.6;
                cursor: not-allowed;
            }

            /* Pagination */
            .pagination .page-link {
                color: var(--primary-maroon);
                border: 1px solid var(--border-color);
                border-radius: 8px;
                margin: 0 2px;
                padding: 0.5rem 0.75rem;
                display: flex;
                align-items: center;
                text-decoration: none;
                transition: all 0.2s ease;
            }

            .pagination .page-link:hover {
                background: var(--primary-maroon);
                color: var(--pure-white);
                border-color: var(--primary-maroon);
                transform: translateY(-1px);
            }

            .pagination .page-item.active .page-link {
                background: linear-gradient(135deg, var(--primary-maroon) 0%, var(--secondary-maroon) 100%);
                border-color: var(--primary-maroon);
                color: var(--pure-white);
            }

            .pagination .page-item.disabled .page-link {
                color: #6c757d;
                background-color: var(--pure-white);
                border-color: #dee2e6;
                cursor: not-allowed;
            }

            .pagination .page-link i {
                font-size: 0.875rem;
            }

            /* Text utility classes for maroon theme */
            .text-maroon {
                color: var(--primary-maroon) !important;
            }
            
            .text-light-maroon {
                color: var(--light-maroon) !important;
            }
            
            .bg-maroon {
                background-color: var(--primary-maroon) !important;
            }
            
            .bg-light-maroon {
                background-color: var(--light-maroon) !important;
            }
            
            .border-maroon {
                border-color: var(--primary-maroon) !important;
            }
            
            /* Button maroon styles */
            .btn-maroon {
                background-color: var(--primary-maroon);
                border-color: var(--primary-maroon);
                color: white;
            }
            
            .btn-maroon:hover {
                background-color: var(--secondary-maroon);
                border-color: var(--secondary-maroon);
                color: white;
            }
            
            .btn-maroon:focus,
            .btn-maroon:active {
                background-color: var(--secondary-maroon);
                border-color: var(--secondary-maroon);
                color: white;
                box-shadow: 0 0 0 0.25rem rgba(128, 0, 32, 0.25);
            }
            
            .btn-outline-maroon {
                border-color: var(--primary-maroon);
                color: var(--primary-maroon);
                background: transparent;
                border: 2px solid var(--primary-maroon);
            }
            
            .btn-outline-maroon:hover {
                background-color: var(--primary-maroon);
                border-color: var(--primary-maroon);
                color: white;
            }
            
            .btn-outline-maroon:focus,
            .btn-outline-maroon:active {
                background-color: var(--primary-maroon);
                border-color: var(--primary-maroon);
                color: white;
                box-shadow: 0 0 0 0.25rem rgba(128, 0, 32, 0.25);
            }
            
            /* Gradient backgrounds */
            .bg-gradient-maroon {
                background: linear-gradient(135deg, var(--primary-maroon), var(--secondary-maroon)) !important;
            }
        </style>
    </head>
    <body>
        <div class="min-vh-100">
            <!-- Navigation -->
            <nav class="navbar navbar-expand-lg navbar-dark shadow">
                <div class="container">
                    <a class="navbar-brand d-flex align-items-center" href="<?php echo e(route('dashboard')); ?>">
                        <img src="https://jateng.kpu.go.id/assets/img/logo-kpu.png" alt="Logo KPU" class="me-2" style="height: 40px; width: auto;">
                        <span class="d-none d-sm-inline">SIMBA KPU JATENG</span>
                        <span class="d-sm-none">SIMBA KPU JATENG</span>
                    </a>
                    
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <div class="navbar-nav ms-auto">
                            <a class="nav-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('dashboard')); ?>">
                                <i class="fas fa-tachometer-alt me-1"></i>
                                <span class="d-lg-inline d-none">Dashboard</span>
                                <span class="d-lg-none">Home</span>
                            </a>
                            <a class="nav-link <?php echo e(request()->routeIs('items.*') ? 'active' : ''); ?>" href="<?php echo e(route('items.index')); ?>">
                                <i class="fas fa-box me-1"></i>Barang
                            </a>
                            <a class="nav-link <?php echo e(request()->routeIs('rooms.*') ? 'active' : ''); ?>" href="<?php echo e(route('rooms.index')); ?>">
                                <i class="fas fa-door-open me-1"></i>Ruangan
                            </a>
                            <a class="nav-link <?php echo e(request()->routeIs('qr-scan.*') ? 'active' : ''); ?>" href="<?php echo e(route('qr-scan.index')); ?>">
                                <i class="fas fa-qrcode me-1"></i>
                                <span class="d-lg-inline d-none">Scan QR</span>
                                <span class="d-lg-none">QR</span>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Page Content -->
            <main>
                <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show mx-3 mt-3" role="alert">
                        <i class="fas fa-check-circle me-2"></i><?php echo e(session('success')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                
                <?php if(session('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show mx-3 mt-3" role="alert">
                        <i class="fas fa-exclamation-triangle me-2"></i><?php echo e(session('error')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
                
                <?php echo $__env->yieldContent('content'); ?>
            </main>

            <!-- Toast Container -->
            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <!-- Toasts will be appended here -->
            </div>

            <!-- Footer -->
            <footer class="mt-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-8">
                            <h5>
                                <img src="https://jateng.kpu.go.id/assets/img/logo-kpu.png" alt="Logo KPU" class="me-2" style="height: 24px; width: auto;">
                                SIMBA KPU JATENG
                            </h5>
                            <p class="mb-0">WebApps untuk mengelola inventaris barang KPU dengan mudah dan efisien.</p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <p class="mb-0">&copy; 2025 - Sistem Manajemen Barang KPU JATENG</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
        
        <!-- Toast Notification Function - Global -->
        <script>
            function showToast(message, type = 'success') {
                const toastContainer = document.querySelector('.toast-container');
                if (!toastContainer) return;

                let bgColorClass = 'text-bg-success';
                let iconClass = 'fas fa-check-circle';
                if (type === 'error') {
                    bgColorClass = 'text-bg-danger';
                    iconClass = 'fas fa-times-circle';
                } else if (type === 'info') {
                    bgColorClass = 'text-bg-info';
                    iconClass = 'fas fa-info-circle';
                } else if (type === 'warning') {
                    bgColorClass = 'text-bg-warning';
                    iconClass = 'fas fa-exclamation-triangle';
                }

                const toastId = `toast-${Date.now()}`;
                const toastHtml = `
                    <div id="${toastId}" class="toast align-items-center ${bgColorClass} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="d-flex">
                            <div class="toast-body">
                                <i class="${iconClass} me-2"></i>
                                ${message}
                            </div>
                            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                        </div>
                    </div>
                `;

                toastContainer.insertAdjacentHTML('beforeend', toastHtml);
                const toastElement = document.getElementById(toastId);
                const toast = new bootstrap.Toast(toastElement, { delay: 5000 });
                toast.show();
            }

            // Check for flash messages and display them as toasts
            <?php if(session('success')): ?>
                showToast('<?php echo e(session('success')); ?>', 'success');
            <?php endif; ?>

            <?php if(session('error')): ?>
                showToast('<?php echo e(session('error')); ?>', 'error');
            <?php endif; ?>

            <?php if(session('info')): ?>
                showToast('<?php echo e(session('info')); ?>', 'info');
            <?php endif; ?>

            <?php if(session('warning')): ?>
                showToast('<?php echo e(session('warning')); ?>', 'warning');
            <?php endif; ?>
        </script>
        
        <!-- Custom Scripts -->
        <script>
            // Improved mobile navigation
            document.addEventListener('DOMContentLoaded', function() {
                // Close mobile menu when clicking on a link
                const navLinks = document.querySelectorAll('.navbar-nav .nav-link');
                const navbarCollapse = document.querySelector('.navbar-collapse');
                
                navLinks.forEach(link => {
                    link.addEventListener('click', () => {
                        if (window.innerWidth < 992) {
                            const bsCollapse = new bootstrap.Collapse(navbarCollapse, {
                                toggle: false
                            });
                            bsCollapse.hide();
                        }
                    });
                });

                // Add loading state to forms
                const forms = document.querySelectorAll('form');
                forms.forEach(form => {
                    form.addEventListener('submit', function() {
                        const submitBtn = form.querySelector('button[type="submit"]');
                        if (submitBtn) {
                            submitBtn.disabled = true;
                            // Preserve original text before adding spinner
                            const originalText = submitBtn.innerHTML;
                            submitBtn.setAttribute('data-original-text', originalText);
                            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>' + (submitBtn.textContent.includes('Simpan') ? 'Menyimpan...' : 'Memproses...');
                        }
                    });
                });

                // Re-enable submit button if form submission fails (e.g., due to client-side validation)
                forms.forEach(form => {
                    form.addEventListener('formdata', function() {
                        const submitBtn = form.querySelector('button[type="submit"]');
                        if (submitBtn && submitBtn.disabled) {
                            submitBtn.disabled = false;
                            const originalText = submitBtn.getAttribute('data-original-text');
                            if (originalText) {
                                submitBtn.innerHTML = originalText;
                            } else {
                                // Fallback if data-original-text somehow not set
                                submitBtn.innerHTML = submitBtn.textContent.replace('Menyimpan...', 'Simpan').replace('Memproses...', 'Proses');
                            }
                        }
                    }, { once: true }); // Listen once to avoid multiple re-enables on single form
                });

                // Smooth scroll for anchor links
                document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                    anchor.addEventListener('click', function (e) {
                        e.preventDefault();
                        const target = document.querySelector(this.getAttribute('href'));
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    });
                });

                // Touch feedback for buttons
                const buttons = document.querySelectorAll('.btn');
                buttons.forEach(btn => {
                    btn.addEventListener('touchstart', function() {
                        this.style.transform = 'scale(0.95)';
                    });
                    
                    btn.addEventListener('touchend', function() {
                        this.style.transform = '';
                    });
                });
            });

            // Service Worker registration for PWA
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', function() {
                    navigator.serviceWorker.register('/sw.js', {
                        scope: '/'
                    })
                    .then(function(registration) {
                        console.log('SW registered successfully:', registration.scope);
                        
                        // Handle updates
                        registration.addEventListener('updatefound', function() {
                            console.log('SW update found');
                            const newWorker = registration.installing;
                            newWorker.addEventListener('statechange', function() {
                                if (newWorker.state === 'installed' && navigator.serviceWorker.controller) {
                                    console.log('SW updated - new content available');
                                }
                            });
                        });
                    })
                    .catch(function(registrationError) {
                        console.log('SW registration failed:', registrationError);
                    });
                    
                    // Handle service worker messages
                    navigator.serviceWorker.addEventListener('message', function(event) {
                        console.log('SW message:', event.data);
                    });
                    
                    // Handle controller changes
                    navigator.serviceWorker.addEventListener('controllerchange', function() {
                        console.log('SW controller changed - reloading page');
                        window.location.reload();
                    });
                });
            }
        </script>
        
        <?php echo $__env->yieldPushContent('scripts'); ?>
    </body>
</html>
<?php /**PATH C:\firman\web1\my-laravel-app\resources\views/layouts/app.blade.php ENDPATH**/ ?>