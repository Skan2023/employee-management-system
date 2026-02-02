<?php $title = "Departments"; require_once '../views/layouts/header.php'; ?>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-diagram-3"></i> Departments</h2>
        <a href="<?php echo BASE_URL; ?>department/create" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Department
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="departmentTable">
                    <thead>
                        <tr>
                            <th width="10%">#</th>
                            <th width="50%">Department Name</th>
                            <th width="15%">Employees</th>
                            <th width="15%">Created</th>
                            <th width="10%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($departments as $index => $dept): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><strong><?php echo htmlspecialchars($dept['department_name']); ?></strong></td>
                            <td>
                                <span class="badge bg-info"><?php echo $dept['employee_count']; ?> employee(s)</span>
                            </td>
                            <td><?php echo date('M d, Y', strtotime($dept['created_at'])); ?></td>
                            <td>
                                <a href="<?php echo BASE_URL; ?>department/edit/<?php echo $dept['id']; ?>" 
                                   class="btn btn-sm btn-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="<?php echo BASE_URL; ?>department/delete/<?php echo $dept['id']; ?>" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="return confirm('Are you sure? This will affect <?php echo $dept['employee_count']; ?> employee(s).')"
                                   title="Delete">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once '../views/layouts/footer.php'; ?>