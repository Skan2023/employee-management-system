<?php $title = "Create Department"; require_once '../views/layouts/header.php'; ?>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-diagram-3"></i> Create New Department</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?php echo BASE_URL; ?>department/create">
                        <div class="mb-3">
                            <label class="form-label">Department Name *</label>
                            <input type="text" class="form-control" name="department_name" 
                                   placeholder="e.g., Human Resources" required autofocus>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Save Department
                            </button>
                            <a href="<?php echo BASE_URL; ?>department" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../views/layouts/footer.php'; ?>