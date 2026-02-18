<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-8">
        <?php flash('profile_message'); ?>
        
        <div class="card shadow mb-4">
            <div class="card-header py-3 bg-white">
                <h6 class="m-0 font-weight-bold text-primary">
                    <i class="fa fa-user-circle me-2"></i>My Profile
                </h6>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-3 text-center">
                        <div class="avatar-circle bg-primary text-white mx-auto mb-3" style="width: 120px; height: 120px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fa fa-user fa-4x"></i>
                        </div>
                        <h5><?php echo $data['user']->name; ?></h5>
                        <span class="badge bg-<?php echo $data['user']->role == 'admin' ? 'danger' : 'info'; ?> fs-6">
                            <?php echo ucfirst($data['user']->role); ?>
                        </span>
                    </div>
                    <div class="col-md-9">
                        <h5 class="text-primary mb-3">User Information</h5>
                        <table class="table table-borderless">
                            <tbody>
                                <tr>
                                    <td class="fw-bold" width="30%"><i class="fa fa-user me-2 text-muted"></i>Full Name:</td>
                                    <td><?php echo $data['user']->name; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold"><i class="fa fa-id-badge me-2 text-muted"></i>Username:</td>
                                    <td><?php echo $data['user']->username; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold"><i class="fa fa-envelope me-2 text-muted"></i>Email:</td>
                                    <td><?php echo $data['user']->email; ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold"><i class="fa fa-shield-alt me-2 text-muted"></i>Role:</td>
                                    <td><?php echo ucfirst($data['user']->role); ?></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold"><i class="fa fa-calendar-alt me-2 text-muted"></i>Member Since:</td>
                                    <td><?php echo date('F d, Y', strtotime($data['user']->created_at)); ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                
                <hr>
                
                <div class="row">
                    <div class="col-12">
                        <h5 class="text-primary mb-3">Account Security</h5>
                        <div class="d-grid gap-2 d-md-block">
                            <a href="<?php echo URLROOT; ?>/users/changePassword" class="btn btn-warning">
                                <i class="fa fa-key me-2"></i>Change Password
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
