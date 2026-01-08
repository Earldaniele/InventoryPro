

<?php $__env->startSection('title', 'Add Product - Inventory Management System'); ?>

<?php $__env->startSection('breadcrumb', 'Add Product'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h1><i class="bi bi-plus-circle me-2 text-primary"></i>Add New Product</h1>
    <a href="<?php echo e(route('products.index')); ?>" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left me-1"></i>Back to Products
    </a>
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card animate-fade-in">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-box-seam me-2"></i>Product Information</h5>
            </div>
            <div class="card-body">
                <form action="<?php echo e(route('products.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    
                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Product Name <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-box"></i></span>
                                <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       id="name" name="name" value="<?php echo e(old('name')); ?>" placeholder="Enter product name" required>
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
                        <div class="col-md-6">
                            <label for="sku" class="form-label">SKU <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-upc"></i></span>
                                <input type="text" class="form-control <?php $__errorArgs = ['sku'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       id="sku" name="sku" value="<?php echo e(old('sku')); ?>" placeholder="e.g., PROD-001" required>
                            </div>
                            <?php $__errorArgs = ['sku'];
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
                                  id="description" name="description" rows="3" placeholder="Enter product description (optional)"><?php echo e(old('description')); ?></textarea>
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
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-6">
                            <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-bookmark"></i></span>
                                <select class="form-select <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                        id="category_id" name="category_id" required>
                                    <option value="">Select Category</option>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>" <?php echo e(old('category_id') == $category->id ? 'selected' : ''); ?>>
                                            <?php echo e($category->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <?php $__errorArgs = ['category_id'];
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
                        <div class="col-md-6">
                            <label for="supplier_id" class="form-label">Supplier <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-truck"></i></span>
                                <select class="form-select <?php $__errorArgs = ['supplier_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                        id="supplier_id" name="supplier_id" required>
                                    <option value="">Select Supplier</option>
                                    <?php $__currentLoopData = $suppliers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $supplier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($supplier->id); ?>" <?php echo e(old('supplier_id') == $supplier->id ? 'selected' : ''); ?>>
                                            <?php echo e($supplier->name); ?>

                                        </option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                            </div>
                            <?php $__errorArgs = ['supplier_id'];
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
                    </div>

                    <div class="row g-3 mb-4">
                        <div class="col-md-4">
                            <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-currency-dollar"></i></span>
                                <input type="number" class="form-control <?php $__errorArgs = ['price'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       id="price" name="price" value="<?php echo e(old('price')); ?>" 
                                       step="0.01" min="0" placeholder="0.00" required>
                            </div>
                            <?php $__errorArgs = ['price'];
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
                        <div class="col-md-4">
                            <label for="quantity_in_stock" class="form-label">Current Stock <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-stack"></i></span>
                                <input type="number" class="form-control <?php $__errorArgs = ['quantity_in_stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       id="quantity_in_stock" name="quantity_in_stock" value="<?php echo e(old('quantity_in_stock')); ?>" 
                                       min="0" placeholder="0" required>
                            </div>
                            <?php $__errorArgs = ['quantity_in_stock'];
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
                        <div class="col-md-4">
                            <label for="minimum_stock_level" class="form-label">Minimum Stock <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-exclamation-triangle"></i></span>
                                <input type="number" class="form-control <?php $__errorArgs = ['minimum_stock_level'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       id="minimum_stock_level" name="minimum_stock_level" value="<?php echo e(old('minimum_stock_level')); ?>" 
                                       min="0" placeholder="0" required>
                            </div>
                            <?php $__errorArgs = ['minimum_stock_level'];
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
                    </div>

                    <hr class="my-4">

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-1"></i>Save Product
                        </button>
                        <a href="<?php echo e(route('products.index')); ?>" class="btn btn-outline-secondary">
                            <i class="bi bi-x me-1"></i>Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card animate-fade-in animate-delay-1">
            <div class="card-header">
                <h6 class="mb-0"><i class="bi bi-lightning-charge me-2 text-warning"></i>Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="<?php echo e(route('categories.create')); ?>" class="btn btn-outline-primary">
                        <i class="bi bi-bookmark-plus me-2"></i>Add New Category
                    </a>
                    <a href="<?php echo e(route('suppliers.create')); ?>" class="btn btn-outline-success">
                        <i class="bi bi-person-plus me-2"></i>Add New Supplier
                    </a>
                </div>
            </div>
        </div>

        <div class="card mt-4 animate-fade-in animate-delay-2">
            <div class="card-header">
                <h6 class="mb-0"><i class="bi bi-info-circle me-2 text-info"></i>Tips</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled mb-0 small text-muted">
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success me-2"></i>
                        Use unique SKU codes for easy tracking
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success me-2"></i>
                        Set minimum stock to get low stock alerts
                    </li>
                    <li class="mb-2">
                        <i class="bi bi-check-circle text-success me-2"></i>
                        Add detailed descriptions for clarity
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\inventory\resources\views/products/create.blade.php ENDPATH**/ ?>