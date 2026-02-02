<?php require_once '../views/layouts/header.php'; ?>

<div class="auth-page auth-register">
    <div class="auth-overlay"></div>

    <div class="auth-card-wrapper">
        <div class="auth-card">
            <div class="auth-card-header text-center">
                <h5 class="mb-1">Register</h5>
                <p class="text-black mb-0">Create a new admin account</p>
            </div>

            <?php if (isset($error)): ?>
            <div class="alert alert-danger mt-3 mb-2">
                <i class="bi bi-exclamation-triangle"></i> <?php echo $error; ?>
            </div>
            <?php endif; ?>

            <?php if (isset($success)): ?>
            <div class="alert alert-success mt-3 mb-2">
                <i class="bi bi-check-circle"></i> <?php echo $success; ?>
            </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo BASE_URL; ?>auth/register" class="mt-4">
                <div class="mb-3">
                    <label class="form-label text-black small">Username</label>
                    <input type="text" class="form-control auth-input" name="username"
                        value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>"
                        placeholder="Enter username" required>
                </div>

                <div class="mb-3">
                    <label class="form-label text-black small">Password</label>
                    <div class="input-group auth-input-group">
                        <input type="password" class="form-control auth-input" name="password" id="password"
                            placeholder="Create a password" required>
                        <button class="btn  btn-sm auth-toggle-btn" type="button" id="togglePassword">
                            <i class="bi bi-eye" id="toggleIcon"></i>
                        </button>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label text-black small">Confirm Password</label>
                    <input type="password" class="form-control auth-input" name="confirm_password" id="confirm_password"
                        placeholder="Re-enter your password" required>
                </div>

                <button type="submit" class="btn btn-primary w-100 auth-submit-btn">
                    Create Admin
                </button>

                <div class="mt-2 text-center">
                    Already have an account?
                    <a href="<?php echo BASE_URL; ?>auth/login" class="auth-link">Login
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Toggle password visibility
document.getElementById('togglePassword').addEventListener('click', function() {
    const password = document.getElementById('password');
    const icon = document.getElementById('toggleIcon');

    if (password.type === 'password') {
        password.type = 'text';
        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        password.type = 'password';
        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
});

// Password match validation
document.getElementById('confirm_password').addEventListener('input', function() {
    const password = document.getElementById('password').value;
    const confirmPassword = this.value;

    if (confirmPassword && password !== confirmPassword) {
        this.setCustomValidity('Passwords do not match');
        this.classList.add('is-invalid');
    } else {
        this.setCustomValidity('');
        this.classList.remove('is-invalid');
    }
});
</script>

<?php require_once '../views/layouts/footer.php'; ?>