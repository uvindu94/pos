<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row mb-4 align-items-center py-5">
    <div class="col-md-6">
        <h1 class="h2 mb-1 fw-bold text-dark">Category Management</h1>
        <p class="text-secondary mb-0">Organize your products into a hierarchical catalog</p>
    </div>
    <div class="col-md-6 text-md-end mt-3 mt-md-0">
        <?php if(isAdmin()) : ?>
        <a href="<?php echo URLROOT; ?>/categories/add" class="btn btn-primary px-4 shadow-sm">
            <i class="ph-bold ph-plus me-2"></i>New Category
        </a>
        <?php endif; ?>
    </div>
</div>

<?php flash('category_message'); ?>

<div class="card shadow mb-4">
    <div class="card-header py-3 bg-white">
        <h6 class="m-0 font-weight-bold text-primary">All Categories</h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" width="100%" cellspacing="0">
                <thead class="table-light">
                    <tr>
                        <th class="border-0 rounded-start">ID</th>
                        <th class="border-0">Category Name</th>
                        <th class="border-0">Parent Category</th>
                        <?php if(isAdmin()) : ?>
                        <th class="border-0 text-center rounded-end">Actions</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php if(empty($data['categories'])) : ?>
                        <tr><td colspan="4" class="text-center py-4 text-muted">No categories found. Add one to get started!</td></tr>
                    <?php else : ?>
                        <?php foreach($data['categories'] as $category) : ?>
                            <tr class="<?php echo $category->parent_id ? 'table-light' : 'fw-bold bg-light bg-opacity-10'; ?>">
                                <td class="align-middle">
                                    <span class="badge <?php echo $category->parent_id ? 'bg-secondary bg-opacity-50' : 'bg-primary'; ?>">
                                        <?php echo $category->id; ?>
                                    </span>
                                </td>
                                <td class="align-middle">
                                    <?php if($category->parent_id) : ?>
                                        <span class="ms-4 text-muted small">
                                            <i class="ph-bold ph-arrow-elbow-down-right me-2"></i>
                                            <span class="text-dark"><?php echo $category->name; ?></span>
                                        </span>
                                    <?php else : ?>
                                        <i class="ph-fill ph-folder-open me-2 text-primary"></i>
                                        <?php echo $category->name; ?>
                                    <?php endif; ?>
                                </td>
                                <td class="align-middle">
                                    <?php if($category->parent_name) : ?>
                                        <span class="badge bg-white text-primary border shadow-sm px-3 py-2">
                                            <i class="ph ph-folder me-1"></i><?php echo $category->parent_name; ?>
                                        </span>
                                    <?php else : ?>
                                        <span class="badge bg-success bg-opacity-10 text-success border border-success border-opacity-25 px-3 py-2">
                                            <i class="ph-bold ph-crown me-1"></i>Parent Category
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <?php if(isAdmin()) : ?>
                                <td class="align-middle text-center">
                                    <div class="d-flex gap-2 justify-content-center">
                                        <a href="<?php echo URLROOT; ?>/categories/edit/<?php echo $category->id; ?>" class="btn btn-sm btn-light rounded-pill p-2" title="Edit">
                                            <i class="ph-bold ph-pencil-simple text-primary"></i>
                                        </a>
                                        <!-- Delete Form -->
                                        <form class="d-inline confirm-delete" action="<?php echo URLROOT; ?>/categories/delete/<?php echo $category->id; ?>" method="post" data-title="Delete Category?" data-text="This will permanently delete '<?php echo $category->name; ?>'. Products in this category may become uncategorized.">
                                            <button type="submit" class="btn btn-sm btn-light rounded-pill p-2" title="Delete">
                                                <i class="ph-bold ph-trash text-danger"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white py-3 px-4 border-top">
        <div class="d-flex justify-content-between align-items-center">
            <div class="text-secondary small">
                Showing <span class="fw-bold text-dark"><?php echo count($data['categories']); ?></span> of <span class="fw-bold text-dark"><?php echo $data['totalResults']; ?></span> categories
            </div>
            <?php if($data['totalPages'] > 1) : ?>
            <nav aria-label="Category pagination">
                <ul class="pagination mb-0 gap-1">
                    <li class="page-item <?php echo ($data['currentPage'] <= 1) ? 'disabled' : ''; ?>">
                        <a class="page-link border-0 rounded-circle shadow-none" href="?page=<?php echo $data['currentPage'] - 1; ?>">
                            <i class="ph-bold ph-caret-left"></i>
                        </a>
                    </li>
                    
                    <?php 
                        $startP = max(1, $data['currentPage'] - 2);
                        $endP = min($data['totalPages'], $data['currentPage'] + 2);
                        for($i = $startP; $i <= $endP; $i++) : 
                    ?>
                        <li class="page-item <?php echo ($data['currentPage'] == $i) ? 'active' : ''; ?>">
                            <a class="page-link border-0 rounded-circle shadow-none px-3 fw-bold" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php endfor; ?>

                    <li class="page-item <?php echo ($data['currentPage'] >= $data['totalPages']) ? 'disabled' : ''; ?>">
                        <a class="page-link border-0 rounded-circle shadow-none" href="?page=<?php echo $data['currentPage'] + 1; ?>">
                            <i class="ph-bold ph-caret-right"></i>
                        </a>
                    </li>
                </ul>
            </nav>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
