<?php require APPROOT . '/views/inc/header.php'; ?>
<style>
    body {
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .login-container {
        width: 100%;
        max-width: 450px;
        padding: 20px;
    }
</style>

<div class="login-container">
    <div class="glass-card shadow-xl p-0 overflow-hidden border-0">
        <div class="bg-primary bg-gradient p-5 text-center text-white position-relative">
            <i class="ph-bold ph-sketch-logo display-1 opacity-25"></i>
            <h2 class="fw-bold mt-3"><?php echo SITENAME; ?></h2>
            <p class="opacity-75">Sign in to your terminal</p>
        </div>
        <div class="p-5">
            <?php flash('register_success'); ?>
            <form action="<?php echo URLROOT; ?>/users/login" method="post">
                <div class="form-floating mb-3">
                    <input type="text" name="username" class="form-control <?php echo (!empty($data['username_err'])) ? 'is-invalid' : ''; ?>" id="username" placeholder="Username" value="<?php echo $data['username']; ?>">
                    <label for="username"><i class="ph ph-user me-2"></i>Username</label>
                    <span class="invalid-feedback"><?php echo $data['username_err']; ?></span>
                </div>
                <div class="form-floating mb-4">
                    <input type="password" name="password" class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" id="password" placeholder="Password" value="<?php echo $data['password']; ?>">
                    <label for="password"><i class="ph ph-lock me-2"></i>Password</label>
                    <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                </div>
                <button class="btn btn-primary btn-lg w-100 py-3 shadow-lg" type="submit">
                    SIGN IN <i class="ph-bold ph-arrow-right ms-2"></i>
                </button>
            </form>
            <div class="text-center mt-5">
                <p class="text-secondary small mb-0">Don't have an account?</p>
                <a href="<?php echo URLROOT; ?>/users/register" class="fw-bold text-primary text-decoration-none small">Create New Account</a>
            </div>
        </div>
    </div>
    <p class="text-center mt-4 text-secondary small">&copy; <?php echo date('Y'); ?> <?php echo SITENAME; ?> • Premium Terminal Experience</p>
</div>
<!-- Footer omitted for cleaner login page -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
