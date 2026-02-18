<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-white d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Add New Product</h6>
                <a href="<?php echo URLROOT; ?>/products" class="btn btn-sm btn-light"><i class="fa fa-arrow-left me-1"></i> Back to List</a>
            </div>
            <div class="card-body">
                <p class="text-muted mb-4">Fill in the details below to create a new product.</p>
                <form action="<?php echo URLROOT; ?>/products/add" method="post">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" name="name" class="form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" id="name" placeholder="Product Name" value="<?php echo $data['name']; ?>">
                                <label for="name">Product Name *</label>
                                <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                                <input type="text" name="barcode" class="form-control <?php echo (!empty($data['barcode_err'])) ? 'is-invalid' : ''; ?>" id="barcode" placeholder="Barcode" value="<?php echo $data['barcode']; ?>">
                                <label for="barcode">Barcode *</label>
                                <span class="invalid-feedback"><?php echo $data['barcode_err']; ?></span>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-floating mb-3">
                        <select name="category_id" class="form-select" id="category">
                            <option value="">Select Category</option>
                            <?php foreach($data['categories'] as $category) : ?>
                                <?php if($category->parent_id) : ?>
                                    <option value="<?php echo $category->id; ?>" <?php echo ($data['category_id'] == $category->id) ? 'selected' : ''; ?>>
                                        &nbsp;&nbsp;&nbsp;&nbsp;↳ <?php echo $category->name; ?> (<?php echo $category->parent_name; ?>)
                                    </option>
                                <?php else : ?>
                                    <option value="<?php echo $category->id; ?>" <?php echo ($data['category_id'] == $category->id) ? 'selected' : ''; ?>>
                                        <?php echo $category->name; ?>
                                    </option>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </select>
                        <label for="category">Category</label>
                    </div>        </div>
                        
                        <div class="col-md-3">
                             <div class="form-floating mb-3">
                                <input type="number" step="0.01" name="price" class="form-control <?php echo (!empty($data['price_err'])) ? 'is-invalid' : ''; ?>" id="price" placeholder="Price" value="<?php echo $data['price']; ?>">
                                <label for="price">Price *</label>
                                <span class="invalid-feedback"><?php echo $data['price_err']; ?></span>
                            </div>
                        </div>
                        
                         <div class="col-md-3">
                             <div class="form-floating mb-3">
                                <input type="number" name="stock" class="form-control" id="stock" placeholder="Stock" value="<?php echo $data['stock']; ?>">
                                <label for="stock">Initial Stock</label>
                            </div>
                        </div>

                        <div class="col-12">
                             <div class="form-floating mb-3">
                                <textarea name="description" class="form-control" placeholder="Description" id="description" style="height: 100px"><?php echo $data['description']; ?></textarea>
                                <label for="description">Description</label>
                            </div>
                        </div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                        <button type="reset" class="btn btn-light me-md-2">Reset</button>
                        <button type="submit" class="btn btn-primary px-4"><i class="fa fa-save me-1"></i> Save Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
