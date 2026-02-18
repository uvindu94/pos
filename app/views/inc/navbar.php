<nav class="navbar navbar-expand-lg sticky-top mb-4 glass">
  <div class="container-fluid px-4">
    <a class="navbar-brand d-flex align-items-center" href="<?php echo URLROOT; ?>/dashboard">
        <i class="ph-bold ph-sketch-logo me-2"></i>
        <span><?php echo SITENAME; ?></span>
    </a>
    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
      <i class="ph-bold ph-list h3 mb-0"></i>
    </button>

    <div class="collapse navbar-collapse" id="navbarsExampleDefault">
      <ul class="navbar-nav me-auto mb-2 mb-md-0">
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center" href="<?php echo URLROOT; ?>/dashboard">
            <i class="ph-bold ph-house-line me-1"></i> Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center" href="<?php echo URLROOT; ?>/categories">
            <i class="ph-bold ph-tag me-1"></i> Categories
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center" href="<?php echo URLROOT; ?>/products">
            <i class="ph-bold ph-package me-1"></i> Products
          </a>
        </li>
        <?php if(isAdmin()) : ?>
        <li class="nav-item">
          <a class="nav-link d-flex align-items-center" href="<?php echo URLROOT; ?>/reports">
            <i class="ph-bold ph-chart-line-up me-1"></i> Reports
          </a>
        </li>
        <?php endif; ?>
        <li class="nav-item ms-lg-3">
            <a class="btn btn-primary px-4" href="<?php echo URLROOT; ?>/pos">
                <i class="ph-bold ph-calculator me-1"></i> POS TERMINAL
            </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">
        <?php if(isset($_SESSION['user_id'])) : ?>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ph-bold ph-user-circle me-1 h4 mb-0"></i> 
                    <span><?php echo $_SESSION['user_name']; ?></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end glass-card border-0 shadow-lg" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item py-2" href="<?php echo URLROOT; ?>/users/profile"><i class="ph ph-user-focus me-2"></i> My Profile</a></li>
                    <li><hr class="dropdown-divider opacity-10"></li>
                    <li><a class="dropdown-item text-danger py-2" href="<?php echo URLROOT; ?>/users/logout"><i class="ph ph-sign-out me-2"></i> Logout</a></li>
                </ul>
            </li>
        <?php else : ?>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo URLROOT; ?>/users/register">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link btn btn-outline-primary px-4 ms-2" href="<?php echo URLROOT; ?>/users/login">Login</a>
            </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>
