<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="glass-card shadow-xl p-0 overflow-hidden border-0">
                <div class="bg-primary bg-gradient p-4 text-center text-white position-relative">
                    <i class="ph-bold ph-key display-4 opacity-25"></i>
                    <h2 class="fw-bold mt-2">Security Settings</h2>
                    <p class="opacity-75 small mb-0">Update your access credentials</p>
                </div>
                <div class="p-4">
                    <div class="alert alert-info border-0 rounded-4 bg-primary bg-opacity-10 text-primary small d-flex align-items-center mb-4">
                        <i class="ph-bold ph-info fa-lg me-3"></i> 
                        <span>For security, please verify your identity by entering your current password.</span>
                    </div>
                    
                    <form action="<?php echo URLROOT; ?>/users/changePassword" method="post">
                        <div class="form-floating mb-3">
                            <input type="password" name="current_password" class="form-control <?php echo (!empty($data['current_password_err'])) ? 'is-invalid' : ''; ?>" id="current_password" placeholder="Current Password">
                            <label for="current_password"><i class="ph ph-lock-key me-2"></i>Current Password</label>
                            <span class="invalid-feedback"><?php echo $data['current_password_err']; ?></span>
                        </div>

                        <div class="form-floating mb-3">
                            <input type="password" name="new_password" class="form-control <?php echo (!empty($data['new_password_err'])) ? 'is-invalid' : ''; ?>" id="new_password" placeholder="New Password">
                            <label for="new_password"><i class="ph ph-shield-check me-2"></i>New Password</label>
                            <span class="invalid-feedback"><?php echo $data['new_password_err']; ?></span>
                        </div>

                        <div class="form-floating mb-4">
                            <input type="password" name="confirm_password" class="form-control <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" id="confirm_password" placeholder="Confirm New Password">
                            <label for="confirm_password"><i class="ph ph-check-square-offset me-2"></i>Confirm New Password</label>
                            <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
                        </div>

                        <div class="d-flex gap-3 mt-4">
                            <a href="<?php echo URLROOT; ?>/users/profile" class="btn btn-light px-4 flex-grow-1">Cancel</a>
                            <button type="submit" class="btn btn-primary px-4 flex-grow-1 shadow-lg">
                                UPDATE PASSWORD <i class="ph-bold ph-floppy-disk ms-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
