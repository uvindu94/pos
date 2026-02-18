<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row mb-4">
    <div class="col-md-12">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h2 class="h3 mb-0 text-gray-800">Categories</h2>
                <p class="text-muted">Organize your products into categories and sub-categories</p>
            </div>
            <?php if(isAdmin()) : ?>
            <a href="<?php echo URLROOT; ?>/categories/add" class="btn btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50 me-2"></i>Add New Category
            </a>
            <?php endif; ?>
        </div>
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
                            <tr>
                                <td class="align-middle"><span class="badge bg-secondary"><?php echo $category->id; ?></span></td>
                                <td class="align-middle font-weight-bold">
                                    <?php if($category->parent_id) : ?>
                                        <i class="fas fa-level-up-alt fa-rotate-90 text-muted me-2"></i>
                                    <?php endif; ?>
                                    <?php echo $category->name; ?>
                                </td>
                                <td class="align-middle">
                                    <?php if($category->parent_name) : ?>
                                        <span class="badge bg-light text-dark border"><?php echo $category->parent_name; ?></span>
                                    <?php else : ?>
                                        <span class="text-muted">—</span>
                                    <?php endif; ?>
                                </td>
                                <?php if(isAdmin()) : ?>
                                <td class="align-middle text-center">
                                    <a href="<?php echo URLROOT; ?>/categories/edit/<?php echo $category->id; ?>" class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                    <!-- Delete Form -->
                                    <form class="d-inline" action="<?php echo URLROOT; ?>/categories/delete/<?php echo $category->id; ?>" method="post" onsubmit="return confirm('Are you sure you want to delete this category?');">
                                        <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                                <?php endif; ?>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
