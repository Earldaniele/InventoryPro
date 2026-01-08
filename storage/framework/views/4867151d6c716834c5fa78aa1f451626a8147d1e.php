

<?php $__env->startSection('title', 'Low Stock Alert - Inventory Management System'); ?>

<?php $__env->startSection('breadcrumb', 'Low Stock Alert'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h1><i class="bi bi-exclamation-octagon me-2 text-warning"></i>Low Stock Alert</h1>
    <a href="<?php echo e(route('products.index')); ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Back to Products
    </a>
</div>

<?php if($products->count() > 0): ?>
<div class="alert alert-warning animate-fade-in">
    <div class="d-flex align-items-center">
        <i class="bi bi-exclamation-triangle-fill fs-4 me-3"></i>
        <div>
            <strong>Attention Required!</strong>
            <p class="mb-0"><?php echo e($products->count()); ?> product(s) are running low on stock or out of stock. Consider restocking soon.</p>
        </div>
    </div>
</div>

<div class="card animate-fade-in">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-list-ul me-2"></i>Low Stock Products</span>
        <span class="badge bg-warning"><?php echo e($products->count()); ?> items need attention</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>SKU</th>
                        <th>Product Name</th>
                        <th>Category</th>
                        <th>Supplier</th>
                        <th>Current Stock</th>
                        <th>Min. Level</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="<?php echo e($product->quantity_in_stock == 0 ? 'out-of-stock' : 'low-stock'); ?>">
                        <td><code class="text-muted"><?php echo e($product->sku); ?></code></td>
                        <td class="fw-medium"><?php echo e($product->name); ?></td>
                        <td>
                            <span class="badge bg-light text-dark border">
                                <i class="bi bi-bookmark me-1"></i><?php echo e($product->category->name); ?>

                            </span>
                        </td>
                        <td>
                            <span class="text-muted">
                                <i class="bi bi-building me-1"></i><?php echo e($product->supplier->name); ?>

                            </span>
                        </td>
                        <td>
                            <span class="fw-bold fs-5 <?php echo e($product->quantity_in_stock == 0 ? 'text-danger' : 'text-warning'); ?>">
                                <?php echo e($product->quantity_in_stock); ?>

                            </span>
                        </td>
                        <td class="text-muted"><?php echo e($product->minimum_stock_level); ?></td>
                        <td>
                            <?php if($product->quantity_in_stock == 0): ?>
                                <span class="badge bg-danger">
                                    <i class="bi bi-x-circle me-1"></i>Out of Stock
                                </span>
                            <?php else: ?>
                                <span class="badge bg-warning">
                                    <i class="bi bi-exclamation-circle me-1"></i>Low Stock
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="<?php echo e(route('products.edit', $product)); ?>" class="btn btn-sm btn-primary" title="Restock">
                                    <i class="bi bi-plus-circle me-1"></i>Restock
                                </a>
                                <a href="<?php echo e(route('products.show', $product)); ?>" class="btn btn-sm btn-outline-info" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php else: ?>
<div class="card animate-fade-in">
    <div class="card-body">
        <div class="empty-state">
            <i class="bi bi-check-circle text-success"></i>
            <h3 class="text-success">All Products Are Well Stocked!</h3>
            <p>Congratulations! No products are currently running low on stock.</p>
            <a href="<?php echo e(route('products.index')); ?>" class="btn btn-primary">
                <i class="bi bi-box me-1"></i>View All Products
            </a>
        </div>
    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\inventory\resources\views/products/low-stock.blade.php ENDPATH**/ ?>