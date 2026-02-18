<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-white d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Add New Category</h6>
                <a href="<?php echo URLROOT; ?>/categories" class="btn btn-sm btn-light"><i class="fa fa-arrow-left me-1"></i> Back to List</a>
            </div>
            <div class="card-body">
                <p class="text-muted mb-4">Create a new category or sub-category.</p>
                <form action="<?php echo URLROOT; ?>/categories/add" method="post">
                    <div class="form-floating mb-3">
                        <input type="text" name="name" class="form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" id="name" placeholder="Category Name" value="<?php echo $data['name']; ?>">
                        <label for="name">Category Name *</label>
                        <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                    </div>
                    
                    <div class="form-floating mb-3">
                        <select name="parent_id" class="form-select" id="parent">
                            <option value="">None (Parent Category)</option>
                            <?php foreach($data['parentCategories'] as $parent) : ?>
                                <option value="<?php echo $parent->id; ?>" <?php echo ($data['parent_id'] == $parent->id) ? 'selected' : ''; ?>><?php echo $parent->name; ?></option>
                            <?php endforeach; ?>
                        </select>
                        <label for="parent">Parent Category</label>
                        <div class="form-text">Leave blank to create a parent category, or select a parent to create a sub-category.</div>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                        <button type="reset" class="btn btn-light me-md-2">Reset</button>
                        <button type="submit" class="btn btn-primary px-4"><i class="fa fa-save me-1"></i> Save Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
