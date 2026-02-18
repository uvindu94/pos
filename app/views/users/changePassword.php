<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-white d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fa fa-key me-2"></i>Change Password
                </h6>
                <a href="<?php echo URLROOT; ?>/users/profile" class="btn btn-sm btn-light">
                    <i class="fa fa-arrow-left me-1"></i> Back to Profile
                </a>
            </div>
            <div class="card-body">
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i> 
                    For security, please enter your current password before setting a new one.
                </div>
                
                <form action="<?php echo URLROOT; ?>/users/changePassword" method="post">
                    <div class="form-floating mb-3">
                        <input type="password" name="current_password" class="form-control <?php echo (!empty($data['current_password_err'])) ? 'is-invalid' : ''; ?>" id="current_password" placeholder="Current Password">
                        <label for="current_password">Current Password *</label>
                        <span class="invalid-feedback"><?php echo $data['current_password_err']; ?></span>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" name="new_password" class="form-control <?php echo (!empty($data['new_password_err'])) ? 'is-invalid' : ''; ?>" id="new_password" placeholder="New Password">
                        <label for="new_password">New Password *</label>
                        <span class="invalid-feedback"><?php echo $data['new_password_err']; ?></span>
                        <div class="form-text">Password must be at least 6 characters</div>
                    </div>

                    <div class="form-floating mb-3">
                        <input type="password" name="confirm_password" class="form-control <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" id="confirm_password" placeholder="Confirm New Password">
                        <label for="confirm_password">Confirm New Password *</label>
                        <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
                    </div>

                    <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3">
                        <a href="<?php echo URLROOT; ?>/users/profile" class="btn btn-light me-md-2">Cancel</a>
                        <button type="submit" class="btn btn-warning px-4">
                            <i class="fa fa-save me-1"></i> Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
