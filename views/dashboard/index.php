<?php $title = "Dashboard"; require_once '../views/layouts/header.php'; ?>

<div class="container-fluid py-4">
    <h2 class="mb-4">
        <i class="bi bi-speedometer2"></i> Dashboard
    </h2>

    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-primary shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Total Employees</h6>
                            <h2 class="mb-0"><?php echo $totalEmployees; ?></h2>
                        </div>
                        <div class="text-primary">
                            <i class="bi bi-people display-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-success shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Active Employees</h6>
                            <h2 class="mb-0"><?php echo $activeEmployees; ?></h2>
                        </div>
                        <div class="text-success">
                            <i class="bi bi-person-check display-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-info shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Departments</h6>
                            <h2 class="mb-0"><?php echo $totalDepartments; ?></h2>
                        </div>
                        <div class="text-info">
                            <i class="bi bi-diagram-3 display-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-warning shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted mb-2">Pending Leaves</h6>
                            <h2 class="mb-0"><?php echo $pendingLeaves; ?></h2>
                        </div>
                        <div class="text-warning">
                            <i class="bi bi-calendar-x display-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Data -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-person-plus"></i> Recent Employees</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recentEmployees as $emp): ?>
                                <tr>
                                    <td><?php echo $emp['employee_code']; ?></td>
                                    <td><?php echo $emp['full_name']; ?></td>
                                    <td><?php echo $emp['department_name']; ?></td>
                                    <td>
                                        <span class="badge bg-<?php echo $emp['status'] == 'active' ? 'success' : 'danger'; ?>">
                                            <?php echo ucfirst($emp['status']); ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-calendar-check"></i> Recent Leave Requests</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead>
                                <tr>
                                    <th>Employee</th>
                                    <th>Type</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($recentLeaves as $leave): ?>
                                <tr>
                                    <td><?php echo $leave['full_name']; ?></td>
                                    <td><?php echo $leave['leave_type']; ?></td>
                                    <td><?php echo date('M d', strtotime($leave['start_date'])); ?></td>
                                    <td>
                                        <span class="badge bg-<?php 
                                            echo $leave['status'] == 'approved' ? 'success' : 
                                                ($leave['status'] == 'pending' ? 'warning' : 'danger'); 
                                        ?>">
                                            <?php echo ucfirst($leave['status']); ?>
                                        </span>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../views/layouts/footer.php'; ?>