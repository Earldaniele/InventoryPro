

<?php $__env->startSection('title', 'Products - Inventory Management System'); ?>

<?php $__env->startSection('breadcrumb', 'Products'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h1><i class="bi bi-box-seam me-2 text-primary"></i>Products</h1>
    <div class="d-flex gap-2">
        <a href="<?php echo e(route('products.create')); ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i>Add Product
        </a>
    </div>
</div>

<?php if($products->count() > 0): ?>
<div class="card animate-fade-in">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-list-ul me-2"></i>All Products</span>
        <span class="badge bg-primary"><?php echo e($products->total()); ?> items</span>
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
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Status</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr class="<?php echo e($product->quantity_in_stock == 0 ? 'out-of-stock' : ($product->isLowStock() ? 'low-stock' : '')); ?>">
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
                        <td class="fw-bold text-success">$<?php echo e(number_format($product->price, 2)); ?></td>
                        <td>
                            <span class="fw-bold <?php echo e($product->quantity_in_stock == 0 ? 'text-danger' : ($product->isLowStock() ? 'text-warning' : 'text-dark')); ?>">
                                <?php echo e($product->quantity_in_stock); ?>

                            </span>
                        </td>
                        <td>
                            <?php if($product->quantity_in_stock == 0): ?>
                                <span class="badge bg-danger">
                                    <i class="bi bi-x-circle me-1"></i>Out of Stock
                                </span>
                            <?php elseif($product->isLowStock()): ?>
                                <span class="badge bg-warning">
                                    <i class="bi bi-exclamation-circle me-1"></i>Low Stock
                                </span>
                            <?php else: ?>
                                <span class="badge bg-success">
                                    <i class="bi bi-check-circle me-1"></i>In Stock
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="<?php echo e(route('products.show', $product)); ?>" class="btn btn-sm btn-outline-info" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="<?php echo e(route('products.edit', $product)); ?>" class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="<?php echo e(route('products.destroy', $product)); ?>" method="POST" style="display: inline;" 
                                      onsubmit="return confirm('Are you sure you want to delete this product?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if($products->hasPages()): ?>
    <div class="card-footer bg-white">
        <div class="d-flex justify-content-center">
            <?php echo e($products->links()); ?>

        </div>
    </div>
    <?php endif; ?>
</div>
<?php else: ?>
<div class="card animate-fade-in">
    <div class="card-body">
        <div class="empty-state">
            <i class="bi bi-box"></i>
            <h3>No Products Found</h3>
            <p>Start by adding your first product to the inventory.</p>
            <a href="<?php echo e(route('products.create')); ?>" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i>Add First Product
            </a>
        </div>
    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\inventory\resources\views/products/index.blade.php ENDPATH**/ ?>