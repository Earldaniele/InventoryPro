

<?php $__env->startSection('title', $product->name . ' - Product Details'); ?>

<?php $__env->startSection('breadcrumb', 'Product Details'); ?>

<?php $__env->startSection('content'); ?>
<div class="page-header">
    <h1><i class="bi bi-box me-2 text-primary"></i><?php echo e($product->name); ?></h1>
    <div class="d-flex gap-2">
        <a href="<?php echo e(route('products.edit', $product)); ?>" class="btn btn-warning">
            <i class="bi bi-pencil me-1"></i>Edit
        </a>
        <a href="<?php echo e(route('products.index')); ?>" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left me-1"></i>Back to Products
        </a>
    </div>
</div>

<div class="row g-4">
    <!-- Product Information -->
    <div class="col-lg-4">
        <div class="card h-100 animate-fade-in">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-info-circle me-2"></i>Product Information</h5>
            </div>
            <div class="card-body">
                <dl class="row mb-0">
                    <dt class="col-sm-5">SKU</dt>
                    <dd class="col-sm-7"><code class="fs-6"><?php echo e($product->sku); ?></code></dd>

                    <dt class="col-sm-5">Category</dt>
                    <dd class="col-sm-7">
                        <span class="badge bg-info"><?php echo e($product->category->name); ?></span>
                    </dd>

                    <dt class="col-sm-5">Supplier</dt>
                    <dd class="col-sm-7"><?php echo e($product->supplier->name); ?></dd>

                    <dt class="col-sm-5">Price</dt>
                    <dd class="col-sm-7 text-success fw-bold">$<?php echo e(number_format($product->price, 2)); ?></dd>

                    <dt class="col-sm-5">Unit Cost</dt>
                    <dd class="col-sm-7">$<?php echo e(number_format($product->unit_cost ?? $product->price * 0.6, 2)); ?></dd>

                    <dt class="col-sm-5">Profit Margin</dt>
                    <dd class="col-sm-7">
                        <?php
                            $cost = $product->unit_cost ?? $product->price * 0.6;
                            $margin = $product->price > 0 ? (($product->price - $cost) / $product->price) * 100 : 0;
                        ?>
                        <span class="badge <?php echo e($margin >= 30 ? 'bg-success' : ($margin >= 15 ? 'bg-warning' : 'bg-danger')); ?>">
                            <?php echo e(number_format($margin, 1)); ?>%
                        </span>
                    </dd>

                    <dt class="col-sm-5">Priority</dt>
                    <dd class="col-sm-7">
                        <span class="badge <?php echo e($product->getPriorityBadgeClass()); ?>">
                            <?php echo e(ucfirst($product->priority ?? 'medium')); ?>

                        </span>
                    </dd>
                </dl>

                <?php if($product->description): ?>
                <hr>
                <h6>Description</h6>
                <p class="text-muted mb-0"><?php echo e($product->description); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Stock Status -->
    <div class="col-lg-4">
        <div class="card h-100 animate-fade-in animate-delay-1">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-boxes me-2"></i>Stock Status</h5>
            </div>
            <div class="card-body text-center">
                <div class="mb-4">
                    <div class="display-2 fw-bold <?php echo e($product->quantity_in_stock <= $product->minimum_stock_level ? 'text-danger' : 'text-success'); ?>">
                        <?php echo e($product->quantity_in_stock); ?>

                    </div>
                    <div class="text-muted">Units in Stock</div>
                </div>

                <div class="progress mb-3" style="height: 20px; border-radius: 10px;">
                    <?php
                        $stockPercent = $product->minimum_stock_level > 0 
                            ? min(100, ($product->quantity_in_stock / $product->minimum_stock_level) * 50) 
                            : 100;
                    ?>
                    <div class="progress-bar <?php echo e($stockPercent < 50 ? 'bg-danger' : ($stockPercent < 75 ? 'bg-warning' : 'bg-success')); ?>" 
                         style="width: <?php echo e($stockPercent); ?>%">
                        <?php echo e(number_format($stockPercent, 0)); ?>%
                    </div>
                </div>

                <div class="row text-center">
                    <div class="col-6">
                        <div class="border rounded p-3">
                            <div class="fw-bold fs-4"><?php echo e($product->minimum_stock_level); ?></div>
                            <small class="text-muted">Minimum Level</small>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="border rounded p-3">
                            <div class="fw-bold fs-4"><?php echo e($product->safety_stock ?? 0); ?></div>
                            <small class="text-muted">Safety Stock</small>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <?php if($product->quantity_in_stock == 0): ?>
                        <span class="badge bg-danger fs-6 px-4 py-2">OUT OF STOCK</span>
                    <?php elseif($product->quantity_in_stock <= $product->minimum_stock_level): ?>
                        <span class="badge bg-warning fs-6 px-4 py-2">LOW STOCK</span>
                    <?php else: ?>
                        <span class="badge bg-success fs-6 px-4 py-2">IN STOCK</span>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- DSS Metrics -->
    <div class="col-lg-4">
        <div class="card h-100 animate-fade-in animate-delay-2">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0"><i class="bi bi-graph-up-arrow me-2"></i>DSS Intelligence</h5>
            </div>
            <div class="card-body">
                <?php if(isset($dssMetrics)): ?>
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span>Priority Score</span>
                    <span class="badge <?php echo e($dssMetrics['urgency'] === 'critical' ? 'bg-danger' : ($dssMetrics['urgency'] === 'high' ? 'bg-warning' : ($dssMetrics['urgency'] === 'medium' ? 'bg-info' : 'bg-secondary'))); ?> fs-5">
                        <?php echo e($dssMetrics['priority_score']); ?>/100
                    </span>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span>Urgency Level</span>
                    <span class="badge <?php echo e($dssMetrics['urgency'] === 'critical' ? 'bg-danger' : ($dssMetrics['urgency'] === 'high' ? 'bg-warning' : ($dssMetrics['urgency'] === 'medium' ? 'bg-info' : 'bg-secondary'))); ?> text-uppercase">
                        <?php echo e($dssMetrics['urgency']); ?>

                    </span>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span>Avg Daily Consumption</span>
                    <span class="fw-bold"><?php echo e($dssMetrics['avg_daily_consumption']); ?> units</span>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span>Days Until Stockout</span>
                    <?php if($dssMetrics['days_until_stockout'] !== null): ?>
                        <span class="fw-bold <?php echo e($dssMetrics['days_until_stockout'] <= 7 ? 'text-danger' : 'text-warning'); ?>">
                            <?php echo e($dssMetrics['days_until_stockout']); ?> days
                        </span>
                    <?php else: ?>
                        <span class="text-muted">N/A</span>
                    <?php endif; ?>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span>Consumption Trend</span>
                    <?php if($dssMetrics['consumption_trend'] === 'increasing'): ?>
                        <span class="badge bg-danger"><i class="bi bi-arrow-up-right"></i> Increasing</span>
                    <?php elseif($dssMetrics['consumption_trend'] === 'decreasing'): ?>
                        <span class="badge bg-success"><i class="bi bi-arrow-down-right"></i> Decreasing</span>
                    <?php else: ?>
                        <span class="badge bg-secondary"><i class="bi bi-arrow-right"></i> Stable</span>
                    <?php endif; ?>
                </div>

                <hr>

                <div class="alert <?php echo e($dssMetrics['urgency'] === 'critical' ? 'alert-danger' : ($dssMetrics['urgency'] === 'high' ? 'alert-warning' : 'alert-info')); ?> mb-0">
                    <h6 class="alert-heading"><i class="bi bi-lightbulb me-1"></i> Recommendation</h6>
                    <p class="mb-0 small">
                        <?php if($dssMetrics['urgency'] === 'critical'): ?>
                            <strong>Immediate action required!</strong> Order <strong><?php echo e($dssMetrics['recommended_qty']); ?></strong> units now to prevent stockout.
                        <?php elseif($dssMetrics['urgency'] === 'high'): ?>
                            <strong>Order soon.</strong> Consider ordering <strong><?php echo e($dssMetrics['recommended_qty']); ?></strong> units within the next week.
                        <?php elseif($dssMetrics['urgency'] === 'medium'): ?>
                            Monitor stock levels. EOQ suggests ordering <strong><?php echo e($dssMetrics['eoq']); ?></strong> units when needed.
                        <?php else: ?>
                            Stock levels are adequate. Continue monitoring consumption patterns.
                        <?php endif; ?>
                    </p>
                </div>
                <?php else: ?>
                <div class="text-center py-4 text-muted">
                    <i class="bi bi-hourglass-split fs-1"></i>
                    <p class="mt-2">DSS data not available</p>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- DSS Analysis Row -->
<?php if(isset($dssMetrics)): ?>
<div class="row g-4 mt-2">
    <!-- Economic Analysis -->
    <div class="col-lg-6">
        <div class="card animate-fade-in">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-calculator me-2 text-success"></i>Economic Analysis</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div class="border rounded p-3 text-center bg-light">
                            <div class="text-muted small">Economic Order Quantity</div>
                            <div class="fs-2 fw-bold text-primary"><?php echo e($dssMetrics['eoq']); ?></div>
                            <small class="text-muted">units</small>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="border rounded p-3 text-center bg-light">
                            <div class="text-muted small">Recommended Order</div>
                            <div class="fs-2 fw-bold text-success"><?php echo e($dssMetrics['recommended_qty']); ?></div>
                            <small class="text-muted">units</small>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="border rounded p-3 text-center bg-light">
                            <div class="text-muted small">Reorder Point</div>
                            <div class="fs-2 fw-bold text-warning"><?php echo e($dssMetrics['reorder_point']); ?></div>
                            <small class="text-muted">units</small>
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div class="border rounded p-3 text-center bg-light">
                            <div class="text-muted small">Revenue at Risk (Daily)</div>
                            <div class="fs-2 fw-bold text-danger">$<?php echo e(number_format($dssMetrics['daily_revenue_at_risk'] ?? 0, 2)); ?></div>
                            <small class="text-muted">per day</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Supplier Info -->
    <div class="col-lg-6">
        <div class="card animate-fade-in animate-delay-1">
            <div class="card-header">
                <h5 class="mb-0"><i class="bi bi-truck me-2 text-info"></i>Supplier Performance</h5>
            </div>
            <div class="card-body">
                <div class="d-flex align-items-center mb-4">
                    <div class="rounded-circle bg-info bg-opacity-10 p-3 me-3">
                        <i class="bi bi-building fs-3 text-info"></i>
                    </div>
                    <div>
                        <h5 class="mb-0"><?php echo e($product->supplier->name); ?></h5>
                        <small class="text-muted"><?php echo e($product->supplier->email ?? 'No email on file'); ?></small>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 text-center mb-3">
                        <div class="border rounded p-3">
                            <div class="text-muted small">Lead Time</div>
                            <div class="fs-4 fw-bold"><?php echo e($dssMetrics['lead_time_days']); ?></div>
                            <small class="text-muted">days</small>
                        </div>
                    </div>
                    <div class="col-md-4 text-center mb-3">
                        <div class="border rounded p-3">
                            <div class="text-muted small">Reliability</div>
                            <div class="fs-4 fw-bold"><?php echo e(round($dssMetrics['supplier_reliability'] * 100)); ?>%</div>
                            <span class="badge <?php echo e($product->supplier->getReliabilityBadgeClass()); ?>">
                                <?php echo e($dssMetrics['supplier_reliability'] >= 0.95 ? 'Excellent' : ($dssMetrics['supplier_reliability'] >= 0.85 ? 'Good' : 'Fair')); ?>

                            </span>
                        </div>
                    </div>
                    <div class="col-md-4 text-center mb-3">
                        <div class="border rounded p-3">
                            <div class="text-muted small">Stockout Cost</div>
                            <div class="fs-4 fw-bold text-danger">$<?php echo e(number_format($dssMetrics['potential_stockout_cost'] ?? 0, 0)); ?></div>
                            <small class="text-muted">potential</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>

<!-- Consumption Chart -->
<?php if(isset($chartData) && isset($chartData['labels']) && count($chartData['labels']) > 0): ?>
<div class="card mt-4 animate-fade-in">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-bar-chart-line me-2"></i>Consumption History (Last 30 Days)</h5>
        <span class="badge bg-primary"><?php echo e(array_sum($chartData['out'])); ?> total units consumed</span>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-sm">
                <thead>
                    <tr>
                        <?php $__currentLoopData = array_slice($chartData['labels'], -14); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <th class="text-center" style="font-size: 0.7rem;"><?php echo e($label); ?></th>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php $__currentLoopData = array_slice($chartData['out'], -14); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quantity): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <td class="text-center">
                            <div class="bg-primary bg-opacity-<?php echo e(min(100, $quantity * 20)); ?>" 
                                 style="height: <?php echo e(max(20, min(80, $quantity * 10))); ?>px; border-radius: 4px; display: flex; align-items: flex-end; justify-content: center;">
                                <span class="small fw-bold text-white p-1"><?php echo e($quantity); ?></span>
                            </div>
                        </td>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tr>
                </tbody>
            </table>
        </div>
        <p class="text-muted text-center small mb-0">
            <i class="bi bi-info-circle me-1"></i>
            Showing daily consumption based on inventory transaction records
        </p>
    </div>
</div>
<?php endif; ?>

<!-- Recent Transactions -->
<div class="card mt-4 animate-fade-in">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0"><i class="bi bi-clock-history me-2"></i>Recent Transactions</h5>
        <span class="badge bg-secondary"><?php echo e($product->inventoryTransactions->count()); ?> total</span>
    </div>
    <div class="card-body">
        <?php if($product->inventoryTransactions->count() > 0): ?>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead class="bg-light">
                    <tr>
                        <th>Date</th>
                        <th>Type</th>
                        <th class="text-center">Quantity</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $product->inventoryTransactions->take(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $transaction): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($transaction->created_at->format('M d, Y H:i')); ?></td>
                        <td>
                            <?php if($transaction->transaction_type === 'in'): ?>
                                <span class="badge bg-success"><i class="bi bi-arrow-down-circle me-1"></i>Stock In</span>
                            <?php else: ?>
                                <span class="badge bg-danger"><i class="bi bi-arrow-up-circle me-1"></i>Stock Out</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center fw-bold <?php echo e($transaction->transaction_type === 'in' ? 'text-success' : 'text-danger'); ?>">
                            <?php echo e($transaction->transaction_type === 'in' ? '+' : '-'); ?><?php echo e($transaction->quantity); ?>

                        </td>
                        <td><?php echo e($transaction->notes ?? '-'); ?></td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <div class="text-center py-4 text-muted">
            <i class="bi bi-inbox fs-1"></i>
            <p class="mt-2">No transactions recorded yet</p>
        </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\xampp\htdocs\inventory\resources\views/products/show.blade.php ENDPATH**/ ?>