<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title ?? APP_NAME; ?></title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/style.css">
    <link rel="stylesheet" href="<?php echo BASE_URL; ?>css/layout.css">
</head>

<body>
    <?php if (isset($_SESSION['user_id'])): ?>
        <?php include __DIR__ . '/sidebar.php'; ?>
        <!-- Main Content -->
        <div class="main-content" id="mainContent">
            <!-- Top Navbar -->
            <div class="top-navbar">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center gap-3">
                        <button class="action-btn d-md-none" onclick="toggleMobileSidebar()">
                            <i class="bi bi-list"></i>
                        </button>
                        <h1 class="page-title"><?php echo $title ?? 'Dashboard'; ?></h1>
                    </div>
                    <div>
                        <div class="user-profile" onclick="toggleUserMenu()">
                            <div class="user-avatar">
                                <?php echo strtoupper(substr($_SESSION['username'], 0, 1)); ?>
                            </div>
                            <div class="user-info">
                                <div class="user-name"><?php echo $_SESSION['username']; ?></div>
                                <div class="user-role"><?php echo $_SESSION['role']; ?></div>
                            </div>
                        </div>
                        <div class="dropdown-menu" id="userMenu" style="display: none; margin-top: 0.5rem;">
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-person-circle"></i> Profile
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="bi bi-gear"></i> Settings
                            </a>
                            <hr class="dropdown-divider">
                            <a class="dropdown-item text-danger" href="<?php echo BASE_URL; ?>auth/logout">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Alert Messages -->
            <div class="alert-container" style="position: fixed; top: 80px; right: 20px; z-index: 9999; width: 350px; max-width: 90vw;">
                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success alert-dismissible fade show modern-alert" role="alert"
                        style="border-left: 4px solid #4facfe; box-shadow: 0 10px 40px rgba(79, 172, 254, 0.3); animation: slideInRight 0.5s ease;">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill me-3" style="font-size: 1.5rem;"></i>
                            <div>
                                <strong style="font-weight: 700;">Success!</strong>
                                <p class="mb-0"><?php echo $_SESSION['success'];
                                                unset($_SESSION['success']); ?></p>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger alert-dismissible fade show modern-alert" role="alert"
                        style="border-left: 4px solid #fa709a; box-shadow: 0 10px 40px rgba(250, 112, 154, 0.3); animation: slideInRight 0.5s ease;">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-exclamation-triangle-fill me-3" style="font-size: 1.5rem;"></i>
                            <div>
                                <strong style="font-weight: 700;">Error!</strong>
                                <p class="mb-0"><?php echo $_SESSION['error'];
                                                unset($_SESSION['error']); ?></p>
                            </div>
                        </div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                <?php endif; ?>
            </div>

        <?php endif; ?>
        <script src="<?php echo BASE_URL; ?>js/layout.js"></script>
</body>
</html>