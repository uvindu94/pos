<?php require APPROOT . '/views/inc/header.php'; ?>
<style>
    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }
    .container {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .register-container {
        width: 100%;
        max-width: 600px;
        padding: 20px;
    }
</style>

<div class="register-container">
    <div class="glass-card shadow-xl p-0 overflow-hidden border-0">
        <div class="bg-primary bg-gradient p-4 text-center text-white position-relative">
            <i class="ph-bold ph-user-plus display-4 opacity-25"></i>
            <h2 class="fw-bold mt-2">Create Account</h2>
            <p class="opacity-75 small mb-0">Join the premium POS network</p>
        </div>
        <div class="p-4">
            <form action="<?php echo URLROOT; ?>/users/register" method="post">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input type="text" name="name" class="form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" id="name" placeholder="Full Name" value="<?php echo $data['name']; ?>">
                            <label for="name"><i class="ph ph-identification-card me-2"></i>Full Name</label>
                            <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                        </div>
                    </div>
                </div>

                <div class="form-floating mb-3">
                    <input type="email" name="email" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" id="email" placeholder="name@example.com" value="<?php echo $data['email']; ?>">
                    <label for="email"><i class="ph ph-envelope me-2"></i>Email Address</label>
                    <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                </div>

                <div class="form-floating mb-3">
                    <input type="text" name="username" class="form-control <?php echo (!empty($data['username_err'])) ? 'is-invalid' : ''; ?>" id="username" placeholder="Username" value="<?php echo $data['username']; ?>">
                    <label for="username"><i class="ph ph-user me-2"></i>Username</label>
                    <span class="invalid-feedback"><?php echo $data['username_err']; ?></span>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="password" name="password" class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" id="password" placeholder="Password" value="<?php echo $data['password']; ?>">
                            <label for="password"><i class="ph ph-lock me-2"></i>Password</label>
                            <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="password" name="confirm_password" class="form-control <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" id="confirm_password" placeholder="Confirm Password" value="<?php echo $data['confirm_password']; ?>">
                            <label for="confirm_password"><i class="ph ph-check-circle me-2"></i>Confirm</label>
                            <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button class="btn btn-primary btn-lg py-3 shadow-lg" type="submit">
                        REGISTER ACCOUNT <i class="ph-bold ph-arrow-right ms-2"></i>
                    </button>
                </div>
            </form>
            <div class="text-center mt-4">
                <p class="text-secondary small mb-0">Already have an account?</p>
                <a href="<?php echo URLROOT; ?>/users/login" class="fw-bold text-primary text-decoration-none small">Go to Login</a>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
