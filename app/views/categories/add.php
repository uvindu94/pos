<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="glass-card shadow-xl p-0 overflow-hidden border-0">
                <div class="bg-primary bg-gradient p-4 text-center text-white position-relative">
                    <i class="ph-bold ph-folder-plus display-4 opacity-25"></i>
                    <h2 class="fw-bold mt-2">New Category</h2>
                    <p class="opacity-75 small mb-0">Expand your product catalog hierarchy</p>
                </div>
                <div class="p-4">
                    <form action="<?php echo URLROOT; ?>/categories/add" method="post">
                        <div class="form-floating mb-3">
                            <input type="text" name="name" class="form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" id="name" placeholder="Category Name" value="<?php echo $data['name']; ?>">
                            <label for="name"><i class="ph ph-tag me-2"></i>Category Name</label>
                            <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <select name="parent_id" class="form-select" id="parent">
                                <option value="">None (Top Level Category)</option>
                                <?php foreach($data['parentCategories'] as $parent) : ?>
                                    <option value="<?php echo $parent->id; ?>" <?php echo ($data['parent_id'] == $parent->id) ? 'selected' : ''; ?>><?php echo $parent->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <label for="parent"><i class="ph ph-folder me-2"></i>Parent Category</label>
                            <div class="form-text small text-muted mt-2">
                                <i class="ph ph-info me-1"></i> Leave as 'None' to create a root category.
                            </div>
                        </div>

                        <div class="d-flex gap-3 mt-4">
                            <a href="<?php echo URLROOT; ?>/categories" class="btn btn-light px-4 flex-grow-1">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4 flex-grow-1 shadow-lg">
                                SAVE CATEGORY <i class="ph-bold ph-floppy-disk ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
