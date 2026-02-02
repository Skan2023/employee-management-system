<?php $title = "Employees"; require_once '../views/layouts/header.php'; ?>
<link rel="stylesheet" href="<?php echo BASE_URL; ?>css/employee.css">

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-people"></i> Employees</h2>
        <a href="<?php echo BASE_URL; ?>employee/create" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add Employee
        </a>
    </div>

    <!-- <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover" id="employeeTable">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Department</th>
                            <th>Position</th>
                            <th>Hire Date</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($employees as $employee): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($employee['employee_code']); ?></td>
                            <td><?php echo htmlspecialchars($employee['full_name']); ?></td>
                            <td><?php echo htmlspecialchars($employee['email']); ?></td>
                            <td><?php echo htmlspecialchars($employee['phone']); ?></td>
                            <td><?php echo htmlspecialchars($employee['department_name']); ?></td>
                            <td><?php echo htmlspecialchars($employee['position_name']); ?></td>
                            <td><?php echo date('M d, Y', strtotime($employee['hire_date'])); ?></td>
                            <td>
                                <span class="badge bg-<?php echo $employee['status'] == 'active' ? 'success' : 'danger'; ?>">
                                    <?php echo ucfirst($employee['status']); ?>
                                </span>
                            </td>
                            <td>
                                <a href="<?php echo BASE_URL; ?>employee/view/<?php echo $employee['id']; ?>" 
                                   class="btn btn-sm btn-info" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="<?php echo BASE_URL; ?>employee/edit/<?php echo $employee['id']; ?>" 
                                   class="btn btn-sm btn-warning" title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <a href="<?php echo BASE_URL; ?>employee/delete/<?php echo $employee['id']; ?>" 
                                   class="btn btn-sm btn-danger" 
                                   onclick="return confirm('Are you sure you want to delete this employee?')"
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
    </div> -->

    <div class="row g-4">
    <?php foreach ($employees as $employee): ?>
        <div class="col-xl-3 col-lg-4 col-md-6">
            <div class="card h-100 shadow-sm border-0 employee-card">
                <div class="card-body text-center">

                    <!-- Avatar -->
                    <div class="mb-3">
                        <img 
                            src="<?php echo BASE_URL; ?>assets/images/default-user.png"
                            alt="Employee"
                            class="rounded-circle border"
                            width="80"
                            height="80"
                        >
                    </div>

                    <!-- Name -->
                    <h6 class="fw-bold mb-0">
                        <?php echo htmlspecialchars($employee['full_name']); ?>
                    </h6>
                    <small class="text-muted">
                        <?php echo htmlspecialchars($employee['employee_code']); ?>
                    </small>

                    <!-- Status -->
                    <div class="mt-2 mb-3">
                        <span class="badge bg-<?php echo $employee['status'] == 'active' ? 'success' : 'danger'; ?>">
                            <?php echo ucfirst($employee['status']); ?>
                        </span>
                    </div>

                    <!-- Info -->
                    <ul class="list-unstyled small text-start mb-3">
                        <li class="mb-1">
                            <i class="bi bi-envelope text-primary"></i>
                            <?php echo htmlspecialchars($employee['email']); ?>
                        </li>
                        <li class="mb-1">
                            <i class="bi bi-telephone text-primary"></i>
                            <?php echo htmlspecialchars($employee['phone']); ?>
                        </li>
                        <li class="mb-1">
                            <i class="bi bi-building text-primary"></i>
                            <?php echo htmlspecialchars($employee['department_name']); ?>
                        </li>
                        <li>
                            <i class="bi bi-briefcase text-primary"></i>
                            <?php echo htmlspecialchars($employee['position_name']); ?>
                        </li>
                    </ul>

                    <!-- Actions -->
                    <div class="d-flex justify-content-center gap-2">
                        <!-- <a href="<?php echo BASE_URL; ?>employee/view/<?php echo $employee['id']; ?>"
                           class="btn btn-sm btn-outline-info">
                            <i class="bi bi-eye"></i>
                        </a> -->

                        <a href="<?php echo BASE_URL; ?>employee/edit/<?php echo $employee['id']; ?>"
                           class="btn btn-sm btn-outline-warning">
                            <i class="bi bi-pencil"></i>
                        </a>

                        <a href="<?php echo BASE_URL; ?>employee/delete/<?php echo $employee['id']; ?>"
                           class="btn btn-sm btn-outline-danger"
                           onclick="return confirm('Are you sure you want to delete this employee?')">
                            <i class="bi bi-trash"></i>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>

</div>

<?php require_once '../views/layouts/footer.php'; ?>