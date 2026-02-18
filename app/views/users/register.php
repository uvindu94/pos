<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="col-md-6">
            <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header text-center bg-success text-white" style="border-radius: 0.5rem 0.5rem 0 0;">
                    <h3 class="font-weight-light my-2"><i class="fa fa-user-plus me-2"></i>Create Account</h3>
                </div>
                <div class="card-body p-4">
                    <p class="text-center text-muted mb-4">Join us to manage the POS system</p>
                    <form action="<?php echo URLROOT; ?>/users/register" method="post">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-floating mb-3">
                                    <input type="text" name="name" class="form-control <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" id="name" placeholder="Full Name" value="<?php echo $data['name']; ?>">
                                    <label for="name">Full Name</label>
                                    <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <input type="email" name="email" class="form-control <?php echo (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" id="email" placeholder="name@example.com" value="<?php echo $data['email']; ?>">
                            <label for="email">Email Address</label>
                             <span class="invalid-feedback"><?php echo $data['email_err']; ?></span>
                        </div>
                        
                        <div class="form-floating mb-3">
                            <input type="text" name="username" class="form-control <?php echo (!empty($data['username_err'])) ? 'is-invalid' : ''; ?>" id="username" placeholder="Username" value="<?php echo $data['username']; ?>">
                            <label for="username">Username</label>
                             <span class="invalid-feedback"><?php echo $data['username_err']; ?></span>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="password" name="password" class="form-control <?php echo (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" id="password" placeholder="Password" value="<?php echo $data['password']; ?>">
                                    <label for="password">Password</label>
                                     <span class="invalid-feedback"><?php echo $data['password_err']; ?></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating mb-3">
                                    <input type="password" name="confirm_password" class="form-control <?php echo (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" id="confirm_password" placeholder="Confirm Password" value="<?php echo $data['confirm_password']; ?>">
                                    <label for="confirm_password">Confirm</label>
                                     <span class="invalid-feedback"><?php echo $data['confirm_password_err']; ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button class="btn btn-success btn-lg" type="submit">Register Account</button>
                        </div>
                    </form>
                </div>
                <div class="card-footer text-center py-3">
                    <div class="small"><a href="<?php echo URLROOT; ?>/users/login">Have an account? Go to login</a></div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
