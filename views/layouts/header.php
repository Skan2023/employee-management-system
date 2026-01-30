<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? APP_NAME; ?></title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css">
</head>
<body>


<?php if (isset($_SESSION['user_id'])): ?>
<div class="d-flex">

    <!-- Sidebar -->
    <aside class="sidebar bg-primary text-white p-3">

        <div class="text-center mb-4">
            <h5 class="mb-0">
                <i class="bi bi-building"></i> <?php echo APP_NAME; ?>
            </h5>
        </div>

        <ul class="nav nav-pills flex-column gap-1">

            <li class="nav-item">
                <a class="nav-link text-white" href="<?php echo BASE_URL; ?>dashboard">
                    <i class="bi bi-speedometer2 me-2"></i> Dashboard
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white" href="<?php echo BASE_URL; ?>employee">
                    <i class="bi bi-people me-2"></i> Employees
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white" href="<?php echo BASE_URL; ?>department">
                    <i class="bi bi-diagram-3 me-2"></i> Departments
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white" href="<?php echo BASE_URL; ?>position">
                    <i class="bi bi-briefcase me-2"></i> Positions
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white" href="<?php echo BASE_URL; ?>salary">
                    <i class="bi bi-cash-coin me-2"></i> Salaries
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link text-white" href="<?php echo BASE_URL; ?>leaverequest">
                    <i class="bi bi-calendar-check me-2"></i> Leave Requests
                </a>
            </li>

        </ul>

        <!-- User dropdown at bottom -->
        <div class="mt-auto pt-3 border-top">
            <div class="dropdown">
                <a class="text-white dropdown-toggle text-decoration-none" href="#" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle me-2"></i>
                    <?php echo $_SESSION['username']; ?>
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#"><i class="bi bi-person"></i> Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <a class="dropdown-item" href="<?php echo BASE_URL; ?>auth/logout">
                            <i class="bi bi-box-arrow-right"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>

    </aside>

    <!-- Main content -->
    <main class="content flex-fill p-4">
<?php endif; ?>

<!-- Alert Messages -->
<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success alert-dismissible fade show m-3" role="alert">
        <i class="bi bi-check-circle"></i> <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div class="alert alert-danger alert-dismissible fade show m-3" role="alert">
        <i class="bi bi-exclamation-triangle"></i> <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
<?php endif; ?>