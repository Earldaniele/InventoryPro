

<?php $__env->startSection('title', 'Categories - Inventory Management System'); ?>

<?php $__env->startSection('breadcrumb', 'Categories'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h1><i class="bi bi-bookmark-star me-2 text-success"></i>Categories</h1>
    <div class="d-flex gap-2">
        <a href="<?php echo e(route('categories.create')); ?>" class="btn btn-primary">
            <i class="bi bi-plus-circle me-1"></i>Add Category
        </a>
    </div>
</div>

<?php if($categories->count() > 0): ?>
<div class="card animate-fade-in">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-list-ul me-2"></i>All Categories</span>
        <span class="badge bg-success"><?php echo e($categories->total()); ?> categories</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table mb-0">
                <thead>
                    <tr>
                        <th>Category Name</th>
                        <th>Description</th>
                        <th>Products</th>
                        <th>Created</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="bg-success bg-opacity-10 rounded-circle p-2 me-3">
                                    <i class="bi bi-bookmark-fill text-success"></i>
                                </div>
                                <span class="fw-medium"><?php echo e($category->name); ?></span>
                            </div>
                        </td>
                        <td class="text-muted"><?php echo e($category->description ?? 'No description'); ?></td>
                        <td>
                            <span class="badge bg-primary rounded-pill">
                                <i class="bi bi-box me-1"></i><?php echo e($category->products_count); ?> products
                            </span>
                        </td>
                        <td class="text-muted">
                            <i class="bi bi-calendar me-1"></i><?php echo e($category->created_at->format('M d, Y')); ?>

                        </td>
                        <td class="text-center">
                            <div class="btn-group" role="group">
                                <a href="<?php echo e(route('categories.show', $category)); ?>" class="btn btn-sm btn-outline-info" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="<?php echo e(route('categories.edit', $category)); ?>" class="btn btn-sm btn-outline-primary" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <?php if($category->products_count == 0): ?>
                                <form action="<?php echo e(route('categories.destroy', $category)); ?>" method="POST" style="display: inline;" 
                                      onsubmit="return confirm('Are you sure you want to delete this category?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                                <?php else: ?>
                                <button class="btn btn-sm btn-outline-secondary" disabled title="Cannot delete - has products">
                                    <i class="bi bi-trash"></i>
                                </button>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php if($categories->hasPages()): ?>
    <div class="card-footer bg-white">
        <div class="d-flex justify-content-center">
            <?php echo e($categories->links()); ?>

        </div>
    </div>
    <?php endif; ?>
</div>
<?php else: ?>
<div class="card animate-fade-in">
    <div class="card-body">
        <div class="empty-state">
            <i class="bi bi-bookmark"></i>
            <h3>No Categories Found</h3>
            <p>Start by creating your first product category.</p>
            <a href="<?php echo e(route('categories.create')); ?>" class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i>Create First Category
            </a>
        </div>
    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\inventory\resources\views/categories/index.blade.php ENDPATH**/ ?>