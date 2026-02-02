<?php require_once '../views/layouts/header.php'; ?>

<div class="container">
    <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="col-md-5">
            <div class="card shadow">
                <div class="card-body p-5">
                    <div class="text-center mb-4">
                        <img
                            src="<?php echo BASE_URL; ?>assets/images/logo.png"
                            alt="Logo"
                            class="mb-3"
                            style="width: 90px; height: auto;">

                        <h3 class="mt-3"><?php echo APP_NAME; ?></h3>
                        <p class="text-muted">Please login to continue</p>
                    </div>

                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-triangle"></i> <?php echo $error; ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="<?php echo BASE_URL; ?>auth/login">
                        <div class="mb-3">
                            <label class="form-label">Username</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-person"></i></span>
                                <input type="text" class="form-control" name="username" required autofocus>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <input type="password" class="form-control" name="password" required>
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="bi bi-box-arrow-in-right"></i> Login
                            </button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <span class="text-muted">Don't have an account?</span>
                        <a href="<?php echo BASE_URL; ?>auth/register" class="text-decoration-none fw-semibold">
                            Register here
                        </a>
                    </div>


                    <!-- <div class="text-center mt-4">
                        <small class="text-muted">
                            Default: admin / password
                        </small>
                    </div> -->
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../views/layouts/footer.php'; ?>