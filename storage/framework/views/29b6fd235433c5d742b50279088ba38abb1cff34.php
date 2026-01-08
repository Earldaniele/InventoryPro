

<?php $__env->startSection('title', 'Dashboard - Inventory Management System'); ?>

<?php $__env->startSection('breadcrumb', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h1><i class="bi bi-grid-1x2-fill me-2 text-primary"></i>Dashboard</h1>
    <div class="d-flex gap-2">
        <a href="<?php echo e(route('products.create')); ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i>Add Product
        </a>
    </div>
</div>

<!-- Statistics Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-6 col-lg-3">
        <div class="stat-card primary animate-fade-in animate-delay-1">
            <i class="bi bi-box-seam stat-icon"></i>
            <div class="stat-value"><?php echo e($totalProducts); ?></div>
            <div class="stat-label">Total Products</div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card success animate-fade-in animate-delay-2">
            <i class="bi bi-bookmark-star stat-icon"></i>
            <div class="stat-value"><?php echo e($totalCategories); ?></div>
            <div class="stat-label">Categories</div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card info animate-fade-in animate-delay-3">
            <i class="bi bi-truck stat-icon"></i>
            <div class="stat-value"><?php echo e($totalSuppliers); ?></div>
            <div class="stat-label">Suppliers</div>
        </div>
    </div>
    <div class="col-md-6 col-lg-3">
        <div class="stat-card warning animate-fade-in animate-delay-4">
            <i class="bi bi-exclamation-octagon stat-icon"></i>
            <div class="stat-value"><?php echo e($lowStockProducts); ?></div>
            <div class="stat-label">Low Stock Items</div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Recent Transactions -->
    <div class="col-lg-6">
        <div class="card h-100 animate-fade-in">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-arrow-left-right me-2 text-primary"></i>Recent Transactions
                </h5>
                <span class="badge bg-primary">Latest</span>
            </div>
            <div class="card-body">
                <?php if($recentTransactions->count() > 0): ?>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Type</th>
                                    <th>Qty</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $recentTransactions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td class="fw-medium"><?php echo e($transaction->product->name); ?></td>
                                    <td>
                                        <span class="badge bg-<?php echo e($transaction->type == 'in' ? 'success' : 'danger'); ?>">
                                            <i class="bi bi-arrow-<?php echo e($transaction->type == 'in' ? 'down' : 'up'); ?> me-1"></i>
                                            <?php echo e(ucfirst($transaction->type)); ?>

                                        </span>
                                    </td>
                                    <td class="fw-bold"><?php echo e($transaction->quantity); ?></td>
                                    <td class="text-muted"><?php echo e($transaction->transaction_date->format('M d, Y')); ?></td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="empty-state py-4">
                        <i class="bi bi-inbox"></i>
                        <h5 class="text-muted">No transactions yet</h5>
                        <p class="text-muted small">Transactions will appear here when products are added or removed.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Low Stock Items -->
    <div class="col-lg-6">
        <div class="card h-100 animate-fade-in">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-exclamation-triangle me-2 text-warning"></i>Low Stock Alert
                </h5>
                <?php if($lowStockItems->count() > 0): ?>
                    <span class="badge bg-warning"><?php echo e($lowStockItems->count()); ?> items</span>
                <?php endif; ?>
            </div>
            <div class="card-body">
                <?php if($lowStockItems->count() > 0): ?>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Stock</th>
                                    <th>Min.</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $lowStockItems; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr class="<?php echo e($product->quantity_in_stock == 0 ? 'out-of-stock' : 'low-stock'); ?>">
                                    <td class="fw-medium"><?php echo e($product->name); ?></td>
                                    <td class="fw-bold"><?php echo e($product->quantity_in_stock); ?></td>
                                    <td class="text-muted"><?php echo e($product->minimum_stock_level); ?></td>
                                    <td>
                                        <?php if($product->quantity_in_stock == 0): ?>
                                            <span class="badge bg-danger">
                                                <i class="bi bi-x-circle me-1"></i>Out of Stock
                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-warning">
                                                <i class="bi bi-exclamation-circle me-1"></i>Low
                                            </span>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-3 text-center">
                        <a href="<?php echo e(route('products.low-stock')); ?>" class="btn btn-outline-warning">
                            <i class="bi bi-arrow-right me-1"></i>View All Low Stock Items
                        </a>
                    </div>
                <?php else: ?>
                    <div class="empty-state py-4">
                        <i class="bi bi-check-circle text-success"></i>
                        <h5 class="text-success">All Products Well Stocked!</h5>
                        <p class="text-muted small">No products are currently running low on stock.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="row mt-4">
    <div class="col-12">
        <div class="card animate-fade-in">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-lightning-charge me-2 text-warning"></i>Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <div class="col-md-3 col-sm-6">
                        <a href="<?php echo e(route('products.create')); ?>" class="btn btn-outline-primary w-100 py-3">
                            <i class="bi bi-plus-circle fs-4 d-block mb-2"></i>
                            Add Product
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <a href="<?php echo e(route('categories.create')); ?>" class="btn btn-outline-success w-100 py-3">
                            <i class="bi bi-bookmark-plus fs-4 d-block mb-2"></i>
                            Add Category
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <a href="<?php echo e(route('suppliers.create')); ?>" class="btn btn-outline-info w-100 py-3">
                            <i class="bi bi-person-plus fs-4 d-block mb-2"></i>
                            Add Supplier
                        </a>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <a href="<?php echo e(route('products.low-stock')); ?>" class="btn btn-outline-warning w-100 py-3">
                            <i class="bi bi-exclamation-octagon fs-4 d-block mb-2"></i>
                            Check Stock
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\inventory\resources\views/dashboard.blade.php ENDPATH**/ ?>