

<?php $__env->startSection('title', 'Edit Product - Inventory Management System'); ?>

<?php $__env->startSection('breadcrumb', 'Edit Product'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h1><i class="bi bi-pencil-square me-2 text-primary"></i>Edit Product</h1>
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
                <form action="<?php echo e(route('products.update', $product)); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    
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
                                       id="name" name="name" value="<?php echo e(old('name', $product->name)); ?>" required>
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
                                       id="sku" name="sku" value="<?php echo e(old('sku', $product->sku)); ?>" required>
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
                                  id="description" name="description" rows="3"><?php echo e(old('description', $product->description)); ?></textarea>
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
                                        <option value="<?php echo e($category->id); ?>" 
                                                <?php echo e(old('category_id', $product->category_id) == $category->id ? 'selected' : ''); ?>>
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
                                        <option value="<?php echo e($supplier->id); ?>" 
                                                <?php echo e(old('supplier_id', $product->supplier_id) == $supplier->id ? 'selected' : ''); ?>>
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
                                       id="price" name="price" value="<?php echo e(old('price', $product->price)); ?>" 
                                       step="0.01" min="0" required>
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
                            <label for="unit_cost" class="form-label">Unit Cost</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-tag"></i></span>
                                <input type="number" class="form-control <?php $__errorArgs = ['unit_cost'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       id="unit_cost" name="unit_cost" 
                                       value="<?php echo e(old('unit_cost', $product->unit_cost)); ?>" 
                                       step="0.01" min="0" placeholder="Auto-calculated if empty">
                            </div>
                            <?php $__errorArgs = ['unit_cost'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <small class="text-muted">Used for EOQ & profit calculations</small>
                        </div>
                        <div class="col-md-4">
                            <label for="priority" class="form-label">Priority Level</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-star"></i></span>
                                <select class="form-select <?php $__errorArgs = ['priority'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                        id="priority" name="priority">
                                    <option value="low" <?php echo e(old('priority', $product->priority) == 'low' ? 'selected' : ''); ?>>Low</option>
                                    <option value="medium" <?php echo e(old('priority', $product->priority ?? 'medium') == 'medium' ? 'selected' : ''); ?>>Medium</option>
                                    <option value="high" <?php echo e(old('priority', $product->priority) == 'high' ? 'selected' : ''); ?>>High</option>
                                    <option value="critical" <?php echo e(old('priority', $product->priority) == 'critical' ? 'selected' : ''); ?>>Critical</option>
                                </select>
                            </div>
                            <?php $__errorArgs = ['priority'];
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
                                       id="quantity_in_stock" name="quantity_in_stock" 
                                       value="<?php echo e(old('quantity_in_stock', $product->quantity_in_stock)); ?>" 
                                       min="0" required>
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
                                       id="minimum_stock_level" name="minimum_stock_level" 
                                       value="<?php echo e(old('minimum_stock_level', $product->minimum_stock_level)); ?>" 
                                       min="0" required>
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
                        <div class="col-md-4">
                            <label for="safety_stock" class="form-label">Safety Stock</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-shield-check"></i></span>
                                <input type="number" class="form-control <?php $__errorArgs = ['safety_stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" 
                                       id="safety_stock" name="safety_stock" 
                                       value="<?php echo e(old('safety_stock', $product->safety_stock ?? 0)); ?>" 
                                       min="0">
                            </div>
                            <?php $__errorArgs = ['safety_stock'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <div class="invalid-feedback d-block"><?php echo e($message); ?></div>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <small class="text-muted">Buffer stock for demand variability</small>
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-check-circle me-1"></i>Update Product
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
                <h6 class="mb-0"><i class="bi bi-info-circle me-2 text-info"></i>Product Status</h6>
            </div>
            <div class="card-body">
                <div class="mb-3 pb-3 border-bottom">
                    <div class="text-muted small mb-1">Current Status</div>
                    <?php if($product->quantity_in_stock == 0): ?>
                        <span class="badge bg-danger fs-6">
                            <i class="bi bi-x-circle me-1"></i>Out of Stock
                        </span>
                    <?php elseif($product->isLowStock()): ?>
                        <span class="badge bg-warning fs-6">
                            <i class="bi bi-exclamation-circle me-1"></i>Low Stock
                        </span>
                    <?php else: ?>
                        <span class="badge bg-success fs-6">
                            <i class="bi bi-check-circle me-1"></i>In Stock
                        </span>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <div class="text-muted small mb-1"><i class="bi bi-calendar-plus me-1"></i>Created</div>
                    <div class="fw-medium"><?php echo e($product->created_at->format('M d, Y \a\t h:i A')); ?></div>
                </div>
                <div>
                    <div class="text-muted small mb-1"><i class="bi bi-calendar-check me-1"></i>Last Updated</div>
                    <div class="fw-medium"><?php echo e($product->updated_at->format('M d, Y \a\t h:i A')); ?></div>
                </div>
            </div>
        </div>

        <div class="card mt-4 animate-fade-in animate-delay-2">
            <div class="card-header">
                <h6 class="mb-0"><i class="bi bi-lightning-charge me-2 text-warning"></i>Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="<?php echo e(route('products.show', $product)); ?>" class="btn btn-outline-info">
                        <i class="bi bi-eye me-2"></i>View Product Details
                    </a>
                    <a href="<?php echo e(route('products.create')); ?>" class="btn btn-outline-primary">
                        <i class="bi bi-plus-circle me-2"></i>Add New Product
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\inventory\resources\views/products/edit.blade.php ENDPATH**/ ?>