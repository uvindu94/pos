<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-white d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fa fa-boxes me-2"></i>Restock Product
                </h6>
                <a href="<?php echo URLROOT; ?>/products" class="btn btn-sm btn-light"><i class="fa fa-arrow-left me-1"></i> Back to List</a>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <h5 class="mb-2"><?php echo $data['product']->name; ?></h5>
                    <div class="row">
                        <div class="col-6">
                            <strong>Barcode:</strong> <?php echo $data['product']->barcode; ?>
                        </div>
                        <div class="col-6">
                            <strong>Current Stock:</strong> 
                            <span class="badge bg-<?php echo $data['product']->stock < 10 ? 'danger' : 'success'; ?> fs-6">
                                <?php echo $data['product']->stock; ?> units
                            </span>
                        </div>
                    </div>
                </div>

                <form action="<?php echo URLROOT; ?>/products/restock/<?php echo $data['product']->id; ?>" method="post">
                    <div class="form-floating mb-3">
                        <input type="number" name="quantity" class="form-control" id="quantity" placeholder="Quantity to Add" min="1" required autofocus>
                        <label for="quantity">Quantity to Add *</label>
                        <div class="form-text">Enter the number of units to add to the current stock</div>
                    </div>

                    <div class="alert alert-warning">
                        <i class="fa fa-info-circle"></i> <strong>Note:</strong> This will ADD the quantity to the existing stock. 
                        For example, adding 50 units to current <?php echo $data['product']->stock; ?> units = <?php echo $data['product']->stock; ?> + 50 = new total.
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                        <a href="<?php echo URLROOT; ?>/products" class="btn btn-light me-md-2">Cancel</a>
                        <button type="submit" class="btn btn-success px-4"><i class="fa fa-plus-circle me-1"></i> Add Stock</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
