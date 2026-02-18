<?php require APPROOT . '/views/inc/header.php'; ?>

<!-- Product Management - Premium Card Grid -->
<div class="container-fluid py-4">
    <!-- Header Section -->
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h1 class="h2 mb-1 fw-bold text-dark">Inventory Management</h1>
            <p class="text-secondary mb-0">Track stock levels and manage your product catalog</p>
        </div>
        <div class="col-md-6 text-md-end mt-3 mt-md-0">
            <div class="d-flex gap-3 justify-content-md-end">
                <div class="input-group w-50 glass shadow-sm rounded-pill px-3">
                    <span class="input-group-text bg-transparent border-0"><i class="ph ph-magnifying-glass text-secondary"></i></span>
                    <input type="text" id="productFilter" class="form-control bg-transparent border-0 shadow-none ps-0" placeholder="Filter products...">
                </div>
                <a href="<?php echo URLROOT; ?>/products/add" class="btn btn-primary px-4 shadow-sm">
                    <i class="ph-bold ph-plus me-2"></i>New Product
                </a>
            </div>
        </div>
    </div>

    <?php flash('product_message'); ?>

    <!-- Products Grid -->
    <div class="row g-4" id="productsGrid">
        <?php if(empty($data['products'])) : ?>
            <div class="col-12">
                <div class="glass-card text-center py-5">
                    <i class="ph ph-package fa-5x text-secondary opacity-25 mb-4"></i>
                    <h2 class="text-secondary">No products found</h2>
                    <p class="text-muted">Start by adding your first product to the inventory.</p>
                    <a href="<?php echo URLROOT; ?>/products/add" class="btn btn-primary mt-3">Add Product</a>
                </div>
            </div>
        <?php else : ?>
            <?php foreach($data['products'] as $product) : ?>
                <?php 
                    $stockStatus = 'bg-success';
                    $statusLabel = 'In Stock';
                    if($product->stock < 10) { $stockStatus = 'bg-danger'; $statusLabel = 'Low Stock'; }
                    elseif($product->stock < 30) { $stockStatus = 'bg-warning text-dark'; $statusLabel = 'Limited'; }
                ?>
                <div class="col-xl-3 col-lg-4 col-md-6 product-item" data-name="<?php echo strtolower($product->name); ?>">
                    <div class="glass-card h-100 p-0 overflow-hidden border-0 shadow-sm transition-base">
                        <!-- Product Highlight Strip -->
                        <div class="bg-primary bg-opacity-10 py-4 text-center position-relative">
                            <i class="ph ph-cube fa-4x text-primary opacity-25"></i>
                            <div class="position-absolute top-0 end-0 p-2 d-flex flex-column gap-1 align-items-end">
                                <span class="badge <?php echo $stockStatus; ?> shadow-sm"><?php echo $statusLabel; ?></span>
                                <?php if(!empty($product->sale_price)) : ?>
                                    <span class="badge bg-danger shadow-sm anim-pulse">SALE</span>
                                <?php endif; ?>
                            </div>
                        </div>

                        <div class="p-4">
                            <div class="d-flex justify-content-between align-items-start mb-2 gap-2">
                                <h5 class="fw-bold text-dark mb-0 text-truncate" title="<?php echo $product->name; ?>"><?php echo $product->name; ?></h5>
                                <div class="text-end">
                                    <?php if(!empty($product->sale_price)) : ?>
                                        <div class="text-muted small text-decoration-line-through"><?php echo CURRENCY; ?><?php echo number_format($product->price, 2); ?></div>
                                        <span class="h5 fw-bold text-danger mb-0"><?php echo CURRENCY; ?><?php echo number_format($product->sale_price, 2); ?></span>
                                    <?php else : ?>
                                        <span class="h5 fw-bold text-primary mb-0"><?php echo CURRENCY; ?><?php echo number_format($product->price, 2); ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <span class="badge bg-light text-secondary border small py-1 px-2">
                                    <i class="ph ph-tag me-1"></i><?php echo $product->category_name; ?>
                                </span>
                                <span class="text-muted small ms-2 font-monospace"><?php echo $product->barcode; ?></span>
                            </div>

                            <div class="pt-3 border-top d-flex justify-content-between align-items-center">
                                <div class="text-secondary small">
                                    Stock: <span class="fw-bold <?php echo $product->stock < 10 ? 'text-danger' : 'text-dark'; ?>"><?php echo $product->stock; ?></span>
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="<?php echo URLROOT; ?>/products/edit/<?php echo $product->id; ?>" class="btn btn-light btn-sm rounded-pill p-2" title="Edit">
                                        <i class="ph-bold ph-pencil-simple text-primary"></i>
                                    </a>
                                    <a href="<?php echo URLROOT; ?>/products/restock/<?php echo $product->id; ?>" class="btn btn-light btn-sm rounded-pill p-2" title="Restock">
                                        <i class="ph-bold ph-package text-success"></i>
                                    </a>
                                    <form action="<?php echo URLROOT; ?>/products/delete/<?php echo $product->id; ?>" method="post" class="d-inline confirm-delete" data-title="Delete Product?" data-text="Permanently remove '<?php echo $product->name; ?>' from inventory?">
                                        <button type="submit" class="btn btn-light btn-sm rounded-pill p-2" title="Delete">
                                            <i class="ph-bold ph-trash text-danger"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script>
    // Simple Search Filter
    document.getElementById('productFilter').addEventListener('keyup', function() {
        let val = this.value.toLowerCase();
        document.querySelectorAll('.product-item').forEach(item => {
            let name = item.getAttribute('data-name');
            item.style.display = name.includes(val) ? 'block' : 'none';
        });
    });
</script>

<?php require APPROOT . '/views/inc/footer.php'; ?>
