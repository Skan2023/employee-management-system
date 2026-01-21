<?php $title = "Edit Employee"; require_once '../views/layouts/header.php'; ?>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="bi bi-pencil"></i> Edit Employee</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?php echo BASE_URL; ?>employee/edit/<?php echo $employee['id']; ?>">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Employee Code *</label>
                                <input type="text" class="form-control" name="employee_code" 
                                       value="<?php echo htmlspecialchars($employee['employee_code']); ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Full Name *</label>
                                <input type="text" class="form-control" name="full_name" 
                                       value="<?php echo htmlspecialchars($employee['full_name']); ?>" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" name="email" 
                                       value="<?php echo htmlspecialchars($employee['email']); ?>">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Phone</label>
                                <input type="text" class="form-control" name="phone" 
                                       value="<?php echo htmlspecialchars($employee['phone']); ?>">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Department *</label>
                                <select class="form-select" name="department_id" id="department" required>
                                    <option value="">Select Department</option>
                                    <?php foreach ($departments as $dept): ?>
                                        <option value="<?php echo $dept['id']; ?>" 
                                                <?php echo ($dept['id'] == $employee['department_id']) ? 'selected' : ''; ?>>
                                            <?php echo $dept['department_name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Position *</label>
                                <select class="form-select" name="position_id" id="position" required>
                                    <option value="">Select Position</option>
                                    <?php foreach ($positions as $pos): ?>
                                        <option value="<?php echo $pos['id']; ?>" 
                                                data-dept="<?php echo $pos['department_id']; ?>"
                                                <?php echo ($pos['id'] == $employee['position_id']) ? 'selected' : ''; ?>>
                                            <?php echo $pos['position_name']; ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Hire Date *</label>
                                <input type="date" class="form-control" name="hire_date" 
                                       value="<?php echo $employee['hire_date']; ?>" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Status *</label>
                                <select class="form-select" name="status" required>
                                    <option value="active" <?php echo ($employee['status'] == 'active') ? 'selected' : ''; ?>>Active</option>
                                    <option value="inactive" <?php echo ($employee['status'] == 'inactive') ? 'selected' : ''; ?>>Inactive</option>
                                </select>
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-save"></i> Update Employee
                            </button>
                            <a href="<?php echo BASE_URL; ?>employee" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Filter positions by selected department
document.getElementById('department').addEventListener('change', function() {
    const deptId = this.value;
    const positionSelect = document.getElementById('position');
    const options = positionSelect.querySelectorAll('option');
    
    options.forEach(option => {
        if (option.value === '') {
            option.style.display = 'block';
            return;
        }
        
        const optDept = option.getAttribute('data-dept');
        if (deptId === '' || optDept === deptId) {
            option.style.display = 'block';
        } else {
            option.style.display = 'none';
        }
    });
});
</script>

<?php require_once '../views/layouts/footer.php'; ?>