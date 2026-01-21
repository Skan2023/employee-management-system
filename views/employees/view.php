<?php $title = "Employee Details"; require_once '../views/layouts/header.php'; ?>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-person-circle"></i> Employee Details</h2>
        <div>
            <a href="<?php echo BASE_URL; ?>employee/edit/<?php echo $employee['id']; ?>" class="btn btn-warning">
                <i class="bi bi-pencil"></i> Edit
            </a>
            <a href="<?php echo BASE_URL; ?>employee" class="btn btn-secondary">
                <i class="bi bi-arrow-left"></i> Back
            </a>
        </div>
    </div>

    <div class="row">
        <!-- Employee Information -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-info-circle"></i> Basic Information</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="40%">Employee Code:</th>
                            <td><?php echo htmlspecialchars($employee['employee_code']); ?></td>
                        </tr>
                        <tr>
                            <th>Full Name:</th>
                            <td><?php echo htmlspecialchars($employee['full_name']); ?></td>
                        </tr>
                        <tr>
                            <th>Email:</th>
                            <td><?php echo htmlspecialchars($employee['email']); ?></td>
                        </tr>
                        <tr>
                            <th>Phone:</th>
                            <td><?php echo htmlspecialchars($employee['phone']); ?></td>
                        </tr>
                        <tr>
                            <th>Department:</th>
                            <td><?php echo htmlspecialchars($employee['department_name']); ?></td>
                        </tr>
                        <tr>
                            <th>Position:</th>
                            <td><?php echo htmlspecialchars($employee['position_name']); ?></td>
                        </tr>
                        <tr>
                            <th>Hire Date:</th>
                            <td><?php echo date('F d, Y', strtotime($employee['hire_date'])); ?></td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td>
                                <span class="badge bg-<?php echo $employee['status'] == 'active' ? 'success' : 'danger'; ?>">
                                    <?php echo ucfirst($employee['status']); ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Joined:</th>
                            <td><?php echo date('F d, Y', strtotime($employee['created_at'])); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <!-- Salary Information -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0"><i class="bi bi-cash-coin"></i> Salary History</h5>
                </div>
                <div class="card-body">
                    <?php if (empty($salaries)): ?>
                        <p class="text-muted text-center py-3">No salary records found</p>
                        <div class="text-center">
                            <a href="<?php echo BASE_URL; ?>salary/create" class="btn btn-sm btn-primary">
                                <i class="bi bi-plus"></i> Add Salary
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Effective Date</th>
                                        <th>Basic</th>
                                        <th>Allowance</th>
                                        <th>Deduction</th>
                                        <th>Net</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($salaries as $salary): ?>
                                    <tr>
                                        <td><?php echo date('M Y', strtotime($salary['effective_date'])); ?></td>
                                        <td>$<?php echo number_format($salary['basic_salary'], 2); ?></td>
                                        <td>$<?php echo number_format($salary['allowance'], 2); ?></td>
                                        <td>$<?php echo number_format($salary['deduction'], 2); ?></td>
                                        <td><strong>$<?php echo number_format($salary['net_salary'], 2); ?></strong></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Leave Requests -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0"><i class="bi bi-calendar-check"></i> Leave Requests</h5>
                </div>
                <div class="card-body">
                    <?php if (empty($leaves)): ?>
                        <p class="text-muted text-center py-3">No leave requests found</p>
                        <div class="text-center">
                            <a href="<?php echo BASE_URL; ?>leaverequest/create" class="btn btn-sm btn-primary">
                                <i class="bi bi-plus"></i> Request Leave
                            </a>
                        </div>
                    <?php else: ?>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Leave Type</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                        <th>Days</th>
                                        <th>Reason</th>
                                        <th>Status</th>
                                        <th>Requested On</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($leaves as $leave): 
                                        $start = new DateTime($leave['start_date']);
                                        $end = new DateTime($leave['end_date']);
                                        $days = $start->diff($end)->days + 1;
                                    ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($leave['leave_type']); ?></td>
                                        <td><?php echo date('M d, Y', strtotime($leave['start_date'])); ?></td>
                                        <td><?php echo date('M d, Y', strtotime($leave['end_date'])); ?></td>
                                        <td><?php echo $days; ?> day(s)</td>
                                        <td><?php echo htmlspecialchars($leave['reason']); ?></td>
                                        <td>
                                            <span class="badge bg-<?php 
                                                echo $leave['status'] == 'approved' ? 'success' : 
                                                    ($leave['status'] == 'pending' ? 'warning' : 'danger'); 
                                            ?>">
                                                <?php echo ucfirst($leave['status']); ?>
                                            </span>
                                        </td>
                                        <td><?php echo date('M d, Y', strtotime($leave['created_at'])); ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../views/layouts/footer.php'; ?>