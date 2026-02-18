<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="glass-card shadow-xl p-0 overflow-hidden border-0">
                <div class="bg-primary bg-gradient p-5 text-center text-white position-relative">
                    <div class="position-absolute top-0 end-0 p-4">
                        <span class="badge bg-white text-primary rounded-pill px-3 py-2 shadow-sm fw-bold">
                            <i class="ph-bold ph-shield-check me-1"></i><?php echo strtoupper($data['user']->role); ?>
                        </span>
                    </div>
                    <div class="avatar-circle bg-white text-primary mx-auto mb-3 shadow-lg d-flex align-items-center justify-content-center" style="width: 120px; height: 120px; border-radius: 50%;">
                        <i class="ph-fill ph-user-circle" style="font-size: 80px;"></i>
                    </div>
                    <h2 class="fw-bold mb-1"><?php echo $data['user']->name; ?></h2>
                    <p class="opacity-75 mb-0">System Account Member</p>
                </div>
                
                <div class="p-5">
                    <div class="row">
                        <div class="col-md-7">
                            <h5 class="fw-bold text-dark mb-4 d-flex align-items-center">
                                <i class="ph-bold ph-identification-card me-2 text-primary"></i> Profile Information
                            </h5>
                            <div class="d-flex flex-column gap-4">
                                <div class="profile-info-item">
                                    <label class="text-secondary small fw-bold text-uppercase mb-1 d-block">Full Name</label>
                                    <div class="h6 mb-0 text-dark"><?php echo $data['user']->name; ?></div>
                                </div>
                                <div class="profile-info-item">
                                    <label class="text-secondary small fw-bold text-uppercase mb-1 d-block">Username</label>
                                    <div class="h6 mb-0 text-dark"><?php echo $data['user']->username; ?></div>
                                </div>
                                <div class="profile-info-item">
                                    <label class="text-secondary small fw-bold text-uppercase mb-1 d-block">Email Address</label>
                                    <div class="h6 mb-0 text-dark"><?php echo $data['user']->email; ?></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <h5 class="fw-bold text-dark mb-4 d-flex align-items-center">
                                <i class="ph-bold ph-shield-star me-2 text-primary"></i> Account Status
                            </h5>
                            <div class="glass p-4 rounded-4 bg-light bg-opacity-50 border">
                                <div class="mb-3">
                                    <label class="text-secondary small fw-bold text-uppercase mb-1 d-block">Access Level</label>
                                    <div class="h6 mb-0 text-dark"><?php echo ucfirst($data['user']->role); ?> Dashboard</div>
                                </div>
                                <div class="mb-0">
                                    <label class="text-secondary small fw-bold text-uppercase mb-1 d-block">Join Date</label>
                                    <div class="h6 mb-0 text-dark"><?php echo date('M d, Y', strtotime($data['user']->created_at)); ?></div>
                                </div>
                            </div>
                            
                            <div class="mt-5">
                                <a href="<?php echo URLROOT; ?>/users/changePassword" class="btn btn-outline-primary w-100 py-3 rounded-pill fw-bold">
                                    <i class="ph-bold ph-key me-2"></i> SECURITY SETTINGS
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>
