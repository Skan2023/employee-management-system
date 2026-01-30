<!-- views/salaries/edit.php -->
<?php $title = "Edit Salary"; require_once '../views/layouts/header.php'; ?>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-warning text-dark">
                    <h5 class="mb-0"><i class="bi bi-pencil"></i> Edit Salary Record</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?php echo BASE_URL; ?>salary/edit/<?php echo $salary['id']; ?>">
                        <div class="mb-3">
                            <label class="form-label">Employee *</label>
                            <select class="form-select" name="employee_id" required>
                                <option value="">Select Employee</option>
                                <?php foreach ($employees as $emp): ?>
                                    <option value="<?php echo $emp['id']; ?>"
                                            <?php echo ($emp['id'] == $salary['employee_id']) ? 'selected' : ''; ?>>
                                        <?php echo htmlspecialchars($emp['employee_code'] . ' - ' . $emp['full_name']); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Basic Salary *</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" name="basic_salary" 
                                           step="0.01" min="0" value="<?php echo $salary['basic_salary']; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Allowance</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" name="allowance" 
                                           step="0.01" min="0" value="<?php echo $salary['allowance']; ?>">
                                </div>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="form-label">Deduction</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" name="deduction" 
                                           step="0.01" min="0" value="<?php echo $salary['deduction']; ?>">
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Effective Date *</label>
                            <input type="date" class="form-control" name="effective_date" 
                                   value="<?php echo $salary['effective_date']; ?>" required>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-warning">
                                <i class="bi bi-save"></i> Update Salary
                            </button>
                            <a href="<?php echo BASE_URL; ?>salary" class="btn btn-secondary">
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