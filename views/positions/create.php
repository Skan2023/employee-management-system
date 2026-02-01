<!-- FILE: views/positions/create.php -->
<?php $title = "Create Position"; require_once '../views/layouts/header.php'; ?>

<div class="container-fluid py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>position">Positions</a></li>
            <li class="breadcrumb-item active">Create Position</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-briefcase"></i> Create New Position</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?php echo BASE_URL; ?>position/create" id="positionForm">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Position Name *</label>
                                <input type="text" class="form-control" name="position_name" 
                                       placeholder="e.g., Software Developer" required autofocus>
                                <small class="text-muted">Enter a descriptive job title</small>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label">Department *</label>
                                <select class="form-select" name="department_id" required>
                                    <option value="">Select Department</option>
                                    <?php foreach ($departments as $dept): ?>
                                        <option value="<?php echo $dept['id']; ?>">
                                            <?php echo htmlspecialchars($dept['department_name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="text-muted">Choose the department this position belongs to</small>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <i class="bi bi-info-circle"></i>
                            <strong>Note:</strong> After creating a position, you can assign employees to it from the Employee Management section.
                        </div>

                        <hr>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Save Position
                            </button>
                            <a href="<?php echo BASE_URL; ?>position" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Quick Tips -->
            <div class="card shadow-sm mt-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0"><i class="bi bi-lightbulb"></i> Tips for Creating Positions</h6>
                </div>
                <div class="card-body">
                    <ul class="mb-0">
                        <li>Use clear, standard job titles (e.g., "Senior Software Engineer" not "Code Ninja")</li>
                        <li>Make sure the position aligns with the selected department</li>
                        <li>Consider creating multiple levels (e.g., Junior, Senior, Lead)</li>
                        <li>Positions can be edited or deleted later if needed</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../views/layouts/footer.php'; ?>