<?php require APPROOT . '/views/inc/header.php'; ?>

<!-- Dashboard Content - Bento Grid Layout -->
<div class="container-fluid py-4">
    <div class="row g-4">
        <!-- Welcome Hero (Large) -->
        <div class="col-lg-8">
            <div class="glass-card p-5 h-100 bg-gradient-primary text-white position-relative overflow-hidden" style="min-height: 300px;">
                <div class="position-relative" style="z-index: 2;">
                    <h1 class="display-4 text-white mb-2">Welcome, <?php echo $_SESSION['user_name']; ?>!</h1>
                    <p class="h5 opacity-75 mb-4">Here's what's happening in your store today.</p>
                    <div class="d-flex gap-3 mt-4">
                        <a href="<?php echo URLROOT; ?>/pos" class="btn btn-light btn-lg px-4">
                            <i class="fa fa-calculator me-2"></i>Open POS
                        </a>
                        <a href="<?php echo URLROOT; ?>/products/add" class="btn btn-outline-primary btn-lg px-4 border-white text-white">
                            <i class="fa fa-plus me-2"></i>Add Product
                        </a>
                    </div>
                </div>
                <!-- Decorative background elements -->
                <div class="position-absolute end-0 bottom-0 opacity-10" style="font-size: 15rem; transform: translate(20%, 20%);">
                    <i class="fa fa-shopping-bag"></i>
                </div>
            </div>
        </div>

        <!-- Revenue Today (Compact) -->
        <div class="col-lg-4">
            <div class="card h-100 p-4 border-0 shadow-sm border-start border-4 border-primary">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-uppercase text-secondary fw-bold small ls-wide">Revenue (Today)</span>
                    <div class="p-2 bg-primary bg-opacity-10 rounded-circle">
                         <i class="fa fa-dollar-sign text-primary"></i>
                    </div>
                </div>
                <h2 class="display-5 mb-1"><?php echo CURRENCY; ?><?php echo number_format($data['totalRevenue'], 2); ?></h2>
                <p class="text-success small mb-0"><i class="fa fa-arrow-up me-1"></i> Performance on track</p>
                <div class="mt-4 pt-4 border-top">
                    <!-- Orders Today (Compact Inside Bento) -->
                    <div class="d-flex justify-content-between align-items-center">
                        <span class="text-secondary small">Total Orders</span>
                        <span class="h5 mb-0 fw-bold"><?php echo $data['totalOrders']; ?></span>
                    </div>
                    <div class="progress mt-2" style="height: 6px;">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 75%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Transactions (Wide 2x1) -->
        <div class="col-lg-8">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-header bg-white py-4 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="m-0 fw-bold"><i class="fa fa-receipt text-primary me-2"></i>Recent Transactions</h5>
                    <a href="<?php echo URLROOT; ?>/reports/sales" class="btn btn-light btn-sm text-primary fw-bold">View All</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table mb-0">
                            <thead>
                                <tr>
                                    <th>Invoice</th>
                                    <th>Customer/Time</th>
                                    <th class="text-end">Total</th>
                                    <th class="text-center">Method</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data['recentSales'] as $sale) : ?>
                                <tr>
                                    <td><span class="badge bg-secondary py-2 px-3"><?php echo $sale->invoice_id; ?></span></td>
                                    <td>
                                        <div class="fw-bold">Guest</div>
                                        <div class="small text-muted"><?php echo date('H:i A', strtotime($sale->created_at)); ?></div>
                                    </td>
                                    <td class="text-end">
                                        <span class="h6 mb-0 fw-bold text-dark"><?php echo CURRENCY; ?><?php echo number_format($sale->total, 2); ?></span>
                                    </td>
                                    <td class="text-center">
                                        <?php 
                                            $icon = 'money-bill'; $color = 'success';
                                            if($sale->payment_method == 'card') { $icon = 'credit-card'; $color = 'primary'; }
                                            if($sale->payment_method == 'cheque') { $icon = 'money-check'; $color = 'warning'; }
                                        ?>
                                        <span class="badge bg-<?php echo $color; ?> bg-opacity-10 text-<?php echo $color; ?> border border-<?php echo $color; ?> border-opacity-25 py-2 px-3">
                                            <i class="fas fa-<?php echo $icon; ?> me-1"></i> <?php echo ucfirst($sale->payment_method); ?>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <a href="<?php echo URLROOT; ?>/pos/receipt/<?php echo $sale->id; ?>" target="_blank" class="btn btn-sm btn-outline-primary rounded-circle p-2" style="width: 32px; height: 32px;">
                                            <i class="fas fa-print"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Low Stock Alerts & Quick Stats (Tall) -->
        <div class="col-lg-4">
            <div class="card h-100 shadow-sm border-0 bg-light">
                <div class="card-header bg-transparent border-0 py-4 px-4">
                    <h5 class="m-0 fw-bold text-danger"><i class="fa fa-bell me-2"></i>Inventory Health</h5>
                </div>
                <div class="card-body px-4 pt-0">
                    <?php if(empty($data['lowStock'])) : ?>
                        <div class="text-center py-5 text-muted">
                            <i class="fa fa-check-circle fa-4x mb-3 text-success opacity-25"></i>
                            <h6>All stock levels healthy!</h6>
                        </div>
                    <?php else : ?>
                        <div class="d-flex flex-column gap-3">
                            <?php foreach($data['lowStock'] as $product) : ?>
                            <div class="bg-white p-3 rounded-3 shadow-sm d-flex justify-content-between align-items-center">
                                <div>
                                    <div class="fw-bold text-dark"><?php echo $product->name; ?></div>
                                    <div class="small text-muted">Stock: <span class="fw-bold text-danger"><?php echo $product->stock; ?></span> left</div>
                                </div>
                                <a href="<?php echo URLROOT; ?>/products/restock/<?php echo $product->id; ?>" class="btn btn-sm btn-outline-success">Restock</a>
                            </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="mt-4 pt-4 border-top text-center">
                            <a href="<?php echo URLROOT; ?>/products" class="btn btn-link btn-sm text-primary text-decoration-none">View All Inventory <i class="fa fa-arrow-right ms-1"></i></a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/inc/footer.php'; ?>
