

<?php $__env->startSection('title', 'Add Category - Inventory Management System'); ?>

<?php $__env->startSection('breadcrumb', 'Add Category'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h1><i class="bi bi-bookmark-plus me-2 text-success"></i>Add New Category</h1>
    <a href="<?php echo e(route('categories.index')); ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Back to Categories
    </a>
</div>

<div class="row g-4">
    <div class="col-lg-7">
        <div class="card animate-fade-in">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-bookmark-star me-2"></i>Category Information</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('categories.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    
                    <div class="mb-4">
                        <label for="name" class="form-label">Category Name <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="bi bi-bookmark"></i></span>
                            <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                   id="name" name="name" value="<?php echo e(old('name')); ?>" placeholder="Enter category name" required>
                        </div>
                        <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="mb-4">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                  id="description" name="description" rows="4" placeholder="Enter category description (optional)"><?php echo e(old('description')); ?></textarea>
                        <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <div class="invalid-feedback"><?php echo e($message); ?></div>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        <div class="form-text"><i class="bi bi-info-circle me-1"></i>Optional: Provide a brief description of this category.</div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-1"></i>Save Category
                        </button>
                        <a href="<?php echo e(route('categories.index')); ?>" class="btn btn-outline-secondary">
                            <i class="bi bi-x me-1"></i>Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-5">
        <div class="card animate-fade-in animate-delay-1">
            <div class="card-header">
                <h6 class="mb-0"><i class="bi bi-lightbulb me-2 text-warning"></i>Category Guidelines</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0">
                    <li class="mb-3 d-flex align-items-start">
                        <i class="bi bi-check-circle text-success me-3 mt-1"></i>
                        <span>Choose clear, descriptive names for your categories</span>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <i class="bi bi-check-circle text-success me-3 mt-1"></i>
                        <span>Categories help organize and filter your products</span>
                    </li>
                    <li class="mb-3 d-flex align-items-start">
                        <i class="bi bi-check-circle text-success me-3 mt-1"></i>
                        <span>You can always edit category details later</span>
                    </li>
                    <li class="d-flex align-items-start">
                        <i class="bi bi-exclamation-circle text-warning me-3 mt-1"></i>
                        <span>Categories with products cannot be deleted</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\inventory\resources\views/categories/create.blade.php ENDPATH**/ ?>