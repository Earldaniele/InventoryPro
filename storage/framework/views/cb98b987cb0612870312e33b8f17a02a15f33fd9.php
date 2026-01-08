<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo $__env->yieldContent('title', 'Inventory Management System'); ?></title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --sidebar-bg: linear-gradient(180deg, #1e293b 0%, #0f172a 100%);
            --card-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --card-hover-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            --transition-smooth: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        body {
            background-color: #f1f5f9;
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            min-height: 100vh;
            background: var(--sidebar-bg);
            box-shadow: 4px 0 15px rgba(0, 0, 0, 0.1);
            position: fixed;
            width: 260px;
            z-index: 1000;
        }

        .sidebar-brand {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-brand h5 {
            background: var(--primary-gradient);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
            font-size: 1.25rem;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .sidebar-brand .brand-icon {
            width: 40px;
            height: 40px;
            background: var(--primary-gradient);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            -webkit-text-fill-color: white;
        }

        .sidebar .nav-link {
            color: #94a3b8;
            padding: 0.875rem 1.5rem;
            margin: 0.25rem 0.75rem;
            border-radius: 10px;
            font-weight: 500;
            font-size: 0.9rem;
            transition: var(--transition-smooth);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .sidebar .nav-link i {
            font-size: 1.2rem;
            width: 24px;
            text-align: center;
        }

        .sidebar .nav-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        .sidebar .nav-link.active {
            color: #fff;
            background: var(--primary-gradient);
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .sidebar .nav-link.active i {
            color: #fff;
        }

        /* Nav Section Titles */
        .nav-section-title {
            color: #64748b;
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            padding: 1.5rem 1.5rem 0.5rem;
        }

        /* Main Content */
        .main-content {
            margin-left: 260px;
            min-height: 100vh;
            padding: 0;
        }

        /* Top Header Bar */
        .top-header {
            background: #fff;
            padding: 1rem 2rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            position: sticky;
            top: 0;
            z-index: 100;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-header .breadcrumb {
            margin: 0;
            background: none;
            padding: 0;
        }

        .top-header .user-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .content-wrapper {
            padding: 2rem;
        }

        /* Page Header */
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e2e8f0;
        }

        .page-header h1 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        /* Enhanced Cards */
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            transition: var(--transition-smooth);
            overflow: hidden;
        }

        .card:hover {
            box-shadow: var(--card-hover-shadow);
            transform: translateY(-2px);
        }

        .card-header {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: 1.25rem 1.5rem;
            font-weight: 600;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Stat Cards */
        .stat-card {
            border-radius: 16px;
            padding: 1.5rem;
            color: #fff;
            position: relative;
            overflow: hidden;
            transition: var(--transition-smooth);
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 100%;
            height: 200%;
            background: rgba(255, 255, 255, 0.1);
            transform: rotate(45deg);
            transition: var(--transition-smooth);
        }

        .stat-card:hover::before {
            right: -30%;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .stat-card.primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .stat-card.success { background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); }
        .stat-card.info { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%); }
        .stat-card.warning { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); }

        .stat-card .stat-icon {
            position: absolute;
            right: 1.5rem;
            top: 50%;
            transform: translateY(-50%);
            font-size: 4rem;
            opacity: 0.3;
        }

        .stat-card .stat-value {
            font-size: 2.5rem;
            font-weight: 700;
            line-height: 1;
            margin-bottom: 0.5rem;
        }

        .stat-card .stat-label {
            font-size: 0.875rem;
            opacity: 0.9;
            font-weight: 500;
        }

        /* Modern Tables */
        .table {
            margin-bottom: 0;
        }

        .table thead th {
            background: #f8fafc;
            border: none;
            color: #64748b;
            font-weight: 600;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 1rem 1.25rem;
        }

        .table tbody td {
            padding: 1rem 1.25rem;
            vertical-align: middle;
            border-color: #f1f5f9;
            color: #334155;
        }

        .table tbody tr {
            transition: var(--transition-smooth);
        }

        .table tbody tr:hover {
            background-color: #f8fafc;
        }

        .table-striped tbody tr:nth-of-type(odd) {
            background-color: rgba(248, 250, 252, 0.5);
        }

        /* Enhanced Badges */
        .badge {
            font-weight: 500;
            padding: 0.5em 1em;
            border-radius: 50px;
            font-size: 0.75rem;
        }

        .badge.bg-success { background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%) !important; }
        .badge.bg-warning { background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%) !important; color: #fff !important; }
        .badge.bg-danger { background: linear-gradient(135deg, #eb3349 0%, #f45c43 100%) !important; }
        .badge.bg-primary { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important; }
        .badge.bg-info { background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%) !important; }

        /* Enhanced Buttons */
        .btn {
            font-weight: 500;
            border-radius: 10px;
            padding: 0.625rem 1.25rem;
            transition: var(--transition-smooth);
        }

        .btn-primary {
            background: var(--primary-gradient);
            border: none;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
            background: linear-gradient(135deg, #764ba2 0%, #667eea 100%);
        }

        .btn-outline-primary {
            border-color: #667eea;
            color: #667eea;
        }

        .btn-outline-primary:hover {
            background: var(--primary-gradient);
            border-color: transparent;
            transform: translateY(-2px);
        }

        .btn-group .btn {
            border-radius: 8px;
            margin: 0 2px;
        }

        /* Enhanced Form Controls */
        .form-control, .form-select {
            border-radius: 10px;
            border: 2px solid #e2e8f0;
            padding: 0.75rem 1rem;
            transition: var(--transition-smooth);
        }

        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.1);
        }

        .form-label {
            font-weight: 500;
            color: #475569;
            margin-bottom: 0.5rem;
        }

        /* Stock Status Rows */
        .low-stock {
            background: linear-gradient(90deg, rgba(245, 158, 11, 0.1) 0%, transparent 100%) !important;
            border-left: 4px solid #f59e0b;
        }

        .out-of-stock {
            background: linear-gradient(90deg, rgba(239, 68, 68, 0.1) 0%, transparent 100%) !important;
            border-left: 4px solid #ef4444;
        }

        /* Alert Enhancements */
        .alert {
            border: none;
            border-radius: 12px;
            padding: 1rem 1.5rem;
        }

        .alert-success {
            background: linear-gradient(135deg, rgba(17, 153, 142, 0.1) 0%, rgba(56, 239, 125, 0.1) 100%);
            color: #059669;
            border-left: 4px solid #10b981;
        }

        .alert-danger {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1) 0%, rgba(220, 38, 38, 0.1) 100%);
            color: #dc2626;
            border-left: 4px solid #ef4444;
        }

        .alert-warning {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.1) 0%, rgba(252, 211, 77, 0.1) 100%);
            color: #d97706;
            border-left: 4px solid #f59e0b;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state i {
            font-size: 5rem;
            color: #cbd5e1;
            margin-bottom: 1.5rem;
        }

        .empty-state h3 {
            color: #64748b;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: #94a3b8;
            margin-bottom: 1.5rem;
        }

        /* Pagination */
        .pagination {
            gap: 0.25rem;
        }

        .pagination .page-link {
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1rem;
            color: #64748b;
            font-weight: 500;
            transition: var(--transition-smooth);
        }

        .pagination .page-item.active .page-link {
            background: var(--primary-gradient);
            box-shadow: 0 4px 10px rgba(102, 126, 234, 0.3);
        }

        .pagination .page-link:hover {
            background: #f1f5f9;
            color: #667eea;
        }

        /* Mobile Responsiveness */
        @media (max-width: 991px) {
            .sidebar {
                width: 100%;
                position: relative;
                min-height: auto;
            }
            
            .main-content {
                margin-left: 0;
            }
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fadeInUp 0.5s ease-out forwards;
        }

        .animate-delay-1 { animation-delay: 0.1s; }
        .animate-delay-2 { animation-delay: 0.2s; }
        .animate-delay-3 { animation-delay: 0.3s; }
        .animate-delay-4 { animation-delay: 0.4s; }

        /* Quick Actions Card */
        .quick-actions .btn {
            justify-content: flex-start;
            text-align: left;
        }

        /* Mobile Toggle */
        .sidebar-toggle {
            display: none;
            background: var(--primary-gradient);
            border: none;
            color: #fff;
            padding: 0.75rem 1rem;
            border-radius: 10px;
        }

        @media (max-width: 991px) {
            .sidebar-toggle {
                display: inline-flex;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar d-none d-lg-block" id="sidebar">
            <div class="sidebar-brand">
                <h5>
                    <span class="brand-icon">
                        <i class="bi bi-box-seam"></i>
                    </span>
                    InventoryPro
                </h5>
            </div>
            
            <div class="nav-section-title">Main Menu</div>
            
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('dashboard')); ?>">
                        <i class="bi bi-grid-1x2-fill"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('products.*') && !request()->routeIs('products.low-stock') ? 'active' : ''); ?>" href="<?php echo e(route('products.index')); ?>">
                        <i class="bi bi-box-seam"></i>
                        Products
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('categories.*') ? 'active' : ''); ?>" href="<?php echo e(route('categories.index')); ?>">
                        <i class="bi bi-bookmark-star"></i>
                        Categories
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('suppliers.*') ? 'active' : ''); ?>" href="<?php echo e(route('suppliers.index')); ?>">
                        <i class="bi bi-truck"></i>
                        Suppliers
                    </a>
                </li>
            </ul>

            <div class="nav-section-title">Alerts</div>
            
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link <?php echo e(request()->routeIs('products.low-stock') ? 'active' : ''); ?>" href="<?php echo e(route('products.low-stock')); ?>">
                        <i class="bi bi-exclamation-octagon"></i>
                        Low Stock Alert
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Main content -->
        <main class="main-content flex-grow-1">
            <!-- Top Header -->
            <div class="top-header">
                <div class="d-flex align-items-center gap-3">
                    <button class="sidebar-toggle d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#mobileSidebar">
                        <i class="bi bi-list"></i>
                    </button>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>" class="text-decoration-none">Home</a></li>
                            <li class="breadcrumb-item active"><?php echo $__env->yieldContent('breadcrumb', 'Dashboard'); ?></li>
                        </ol>
                    </nav>
                </div>
                <div class="user-info">
                    <span class="text-muted small"><?php echo e(now()->format('l, F j, Y')); ?></span>
                </div>
            </div>

            <!-- Mobile Sidebar -->
            <div class="collapse d-lg-none bg-dark" id="mobileSidebar">
                <ul class="nav flex-column py-3">
                    <li class="nav-item">
                        <a class="nav-link text-white <?php echo e(request()->routeIs('dashboard') ? 'active' : ''); ?>" href="<?php echo e(route('dashboard')); ?>">
                            <i class="bi bi-grid-1x2-fill me-2"></i>Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white <?php echo e(request()->routeIs('products.*') ? 'active' : ''); ?>" href="<?php echo e(route('products.index')); ?>">
                            <i class="bi bi-box-seam me-2"></i>Products
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white <?php echo e(request()->routeIs('categories.*') ? 'active' : ''); ?>" href="<?php echo e(route('categories.index')); ?>">
                            <i class="bi bi-bookmark-star me-2"></i>Categories
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white <?php echo e(request()->routeIs('suppliers.*') ? 'active' : ''); ?>" href="<?php echo e(route('suppliers.index')); ?>">
                            <i class="bi bi-truck me-2"></i>Suppliers
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="<?php echo e(route('products.low-stock')); ?>">
                            <i class="bi bi-exclamation-octagon me-2"></i>Low Stock Alert
                        </a>
                    </li>
                </ul>
            </div>

            <div class="content-wrapper">
                <?php if(session('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show animate-fade-in" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <?php echo e(session('success')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show animate-fade-in" role="alert">
                        <i class="bi bi-x-circle-fill me-2"></i>
                        <?php echo e(session('error')); ?>

                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </main>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <?php echo $__env->yieldContent('scripts'); ?>
</body>
</html><?php /**PATH C:\xampp\htdocs\inventory\resources\views/layouts/app.blade.php ENDPATH**/ ?>