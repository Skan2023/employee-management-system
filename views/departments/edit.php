<?php $title = "Edit Department"; require_once '../views/layouts/header.php'; ?>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="bi bi-pencil"></i> Edit Department</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?php echo BASE_URL; ?>department/edit/<?php echo $department['id']; ?>">
                        <div class="mb-3">
                            <label class="form-label">Department Name *</label>
                            <input type="text" class="form-control" name="department_name" 
                                   value="<?php echo htmlspecialchars($department['department_name']); ?>" 
                                   required autofocus>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-save"></i> Update Department
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