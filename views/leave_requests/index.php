<!-- FILE: views/leave_requests/index.php -->
<?php $title = "Leave Requests Management"; require_once '../views/layouts/header.php'; ?>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2><i class="bi bi-calendar-check"></i> Leave Requests Management</h2>
            <p class="text-muted mb-0">Manage and track employee leave requests</p>
        </div>
        <a href="<?php echo BASE_URL; ?>leaverequest/create" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> New Leave Request
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        <?php
        $pending = 0;
        $approved = 0;
        $rejected = 0;
        foreach ($leaves as $leave) {
            if ($leave['status'] == 'pending') $pending++;
            if ($leave['status'] == 'approved') $approved++;
            if ($leave['status'] == 'rejected') $rejected++;
        }
        ?>
        <div class="col-md-3">
            <div class="card border-warning shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted">Pending</h6>
                            <h3 class="mb-0 text-warning"><?php echo $pending; ?></h3>
                        </div>
                        <i class="bi bi-clock-history text-warning" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-success shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted">Approved</h6>
                            <h3 class="mb-0 text-success"><?php echo $approved; ?></h3>
                        </div>
                        <i class="bi bi-check-circle text-success" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-danger shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted">Rejected</h6>
                            <h3 class="mb-0 text-danger"><?php echo $rejected; ?></h3>
                        </div>
                        <i class="bi bi-x-circle text-danger" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-primary shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted">Total Requests</h6>
                            <h3 class="mb-0 text-primary"><?php echo count($leaves); ?></h3>
                        </div>
                        <i class="bi bi-calendar3 text-primary" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-3">
                    <label class="form-label">Filter by Status</label>
                    <select class="form-select" id="filterStatus">
                        <option value="">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="rejected">Rejected</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Filter by Leave Type</label>
                    <select class="form-select" id="filterLeaveType">
                        <option value="">All Types</option>
                        <option value="Annual Leave">Annual Leave</option>
                        <option value="Sick Leave">Sick Leave</option>
                        <option value="Casual Leave">Casual Leave</option>
                        <option value="Maternity Leave">Maternity Leave</option>
                        <option value="Paternity Leave">Paternity Leave</option>
                        <option value="Unpaid Leave">Unpaid Leave</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label">Search Employee</label>
                    <input type="text" class="form-control" id="searchEmployee" placeholder="Search by name or code...">
                </div>
                <div class="col-md-3">
                    <label class="form-label">&nbsp;</label>
                    <button class="btn btn-secondary w-100" onclick="resetFilters()">
                        <i class="bi bi-arrow-clockwise"></i> Reset Filters
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Leave Requests Table -->
    <div class="card shadow-sm">
        <div class="card-header bg-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-list-ul"></i> All Leave Requests</h5>
            <div class="btn-group" role="group">
                <button class="btn btn-sm btn-outline-primary" onclick="showView('table')">
                    <i class="bi bi-table"></i> Table
                </button>
                <button class="btn btn-sm btn-outline-primary" onclick="showView('cards')">
                    <i class="bi bi-grid"></i> Cards
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <!-- Table View -->
            <div id="tableView" class="table-responsive">
                <table class="table table-hover mb-0" id="leaveTable">
                    <thead class="table-light">
                        <tr>
                            <th width="8%">#</th>
                            <th width="15%">Employee</th>
                            <th width="10%">Code</th>
                            <th width="12%">Leave Type</th>
                            <th width="10%">Start Date</th>
                            <th width="10%">End Date</th>
                            <th width="8%">Days</th>
                            <th width="10%">Status</th>
                            <th width="17%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($leaves)): ?>
                        <tr>
                            <td colspan="9" class="text-center py-4">
                                <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                                <p class="text-muted mt-2">No leave requests found</p>
                                <a href="<?php echo BASE_URL; ?>leaverequest/create" class="btn btn-sm btn-primary">
                                    <i class="bi bi-plus"></i> Create First Request
                                </a>
                            </td>
                        </tr>
                        <?php else: ?>
                            <?php foreach ($leaves as $index => $leave): 
                                $start = new DateTime($leave['start_date']);
                                $end = new DateTime($leave['end_date']);
                                $days = $start->diff($end)->days + 1;
                            ?>
                            <tr data-status="<?php echo $leave['status']; ?>" 
                                data-type="<?php echo htmlspecialchars($leave['leave_type']); ?>"
                                data-employee="<?php echo htmlspecialchars($leave['full_name'] . ' ' . $leave['employee_code']); ?>">
                                <td><?php echo $index + 1; ?></td>
                                <td><?php echo htmlspecialchars($leave['full_name']); ?></td>
                                <td>
                                    <span class="badge bg-secondary"><?php echo htmlspecialchars($leave['employee_code']); ?></span>
                                </td>
                                <td><?php echo htmlspecialchars($leave['leave_type']); ?></td>
                                <td><?php echo date('M d, Y', strtotime($leave['start_date'])); ?></td>
                                <td><?php echo date('M d, Y', strtotime($leave['end_date'])); ?></td>
                                <td><strong><?php echo $days; ?></strong></td>
                                <td>
                                    <span class="badge bg-<?php 
                                        echo $leave['status'] == 'approved' ? 'success' : 
                                            ($leave['status'] == 'pending' ? 'warning text-dark' : 'danger'); 
                                    ?>">
                                        <i class="bi bi-<?php 
                                            echo $leave['status'] == 'approved' ? 'check-circle' : 
                                                ($leave['status'] == 'pending' ? 'clock' : 'x-circle'); 
                                        ?>"></i>
                                        <?php echo ucfirst($leave['status']); ?>
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="<?php echo BASE_URL; ?>leaverequest/view/<?php echo $leave['id']; ?>" 
                                           class="btn btn-sm btn-info" title="View Details">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <?php if ($leave['status'] == 'pending'): ?>
                                        <a href="<?php echo BASE_URL; ?>leaverequest/approve/<?php echo $leave['id']; ?>" 
                                           class="btn btn-sm btn-success" 
                                           onclick="return confirm('Approve this leave request for <?php echo htmlspecialchars($leave['full_name']); ?>?')"
                                           title="Approve">
                                            <i class="bi bi-check-circle"></i>
                                        </a>
                                        <a href="<?php echo BASE_URL; ?>leaverequest/reject/<?php echo $leave['id']; ?>" 
                                           class="btn btn-sm btn-danger" 
                                           onclick="return confirm('Reject this leave request?')"
                                           title="Reject">
                                            <i class="bi bi-x-circle"></i>
                                        </a>
                                        <?php endif; ?>
                                        <a href="<?php echo BASE_URL; ?>leaverequest/delete/<?php echo $leave['id']; ?>" 
                                           class="btn btn-sm btn-danger" 
                                           onclick="return confirm('Are you sure you want to delete this leave request?')"
                                           title="Delete">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <!-- Cards View (hidden by default) -->
            <div id="cardsView" style="display: none;" class="p-3">
                <div class="row g-3">
                    <?php foreach ($leaves as $leave): 
                        $start = new DateTime($leave['start_date']);
                        $end = new DateTime($leave['end_date']);
                        $days = $start->diff($end)->days + 1;
                    ?>
                    <div class="col-md-6 col-lg-4">
                        <div class="card h-100 border-<?php 
                            echo $leave['status'] == 'approved' ? 'success' : 
                                ($leave['status'] == 'pending' ? 'warning' : 'danger'); 
                        ?>">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h6 class="mb-0"><?php echo htmlspecialchars($leave['full_name']); ?></h6>
                                    <span class="badge bg-<?php 
                                        echo $leave['status'] == 'approved' ? 'success' : 
                                            ($leave['status'] == 'pending' ? 'warning text-dark' : 'danger'); 
                                    ?>">
                                        <?php echo ucfirst($leave['status']); ?>
                                    </span>
                                </div>
                                <p class="text-muted small mb-2">
                                    <i class="bi bi-person-badge"></i> <?php echo $leave['employee_code']; ?>
                                </p>
                                <p class="mb-2">
                                    <i class="bi bi-calendar2-event"></i> <strong><?php echo $leave['leave_type']; ?></strong>
                                </p>
                                <p class="mb-2 small">
                                    <i class="bi bi-calendar-range"></i>
                                    <?php echo date('M d', strtotime($leave['start_date'])); ?> - 
                                    <?php echo date('M d, Y', strtotime($leave['end_date'])); ?>
                                    <span class="badge bg-info"><?php echo $days; ?> days</span>
                                </p>
                                <p class="mb-3 small text-muted">
                                    <?php echo substr(htmlspecialchars($leave['reason']), 0, 80); ?>...
                                </p>
                                <div class="d-flex gap-1">
                                    <a href="<?php echo BASE_URL; ?>leaverequest/view/<?php echo $leave['id']; ?>" 
                                       class="btn btn-sm btn-info">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <?php if ($leave['status'] == 'pending'): ?>
                                    <a href="<?php echo BASE_URL; ?>leaverequest/approve/<?php echo $leave['id']; ?>" 
                                       class="btn btn-sm btn-success">
                                        <i class="bi bi-check"></i>
                                    </a>
                                    <a href="<?php echo BASE_URL; ?>leaverequest/reject/<?php echo $leave['id']; ?>" 
                                       class="btn btn-sm btn-danger">
                                        <i class="bi bi-x"></i>
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// View switcher
function showView(view) {
    if (view === 'table') {
        document.getElementById('tableView').style.display = 'block';
        document.getElementById('cardsView').style.display = 'none';
    } else {
        document.getElementById('tableView').style.display = 'none';
        document.getElementById('cardsView').style.display = 'block';
    }
}

// Filter functionality
document.getElementById('filterStatus').addEventListener('change', filterTable);
document.getElementById('filterLeaveType').addEventListener('change', filterTable);
document.getElementById('searchEmployee').addEventListener('input', filterTable);

function filterTable() {
    const statusFilter = document.getElementById('filterStatus').value.toLowerCase();
    const typeFilter = document.getElementById('filterLeaveType').value.toLowerCase();
    const searchTerm = document.getElementById('searchEmployee').value.toLowerCase();
    const rows = document.querySelectorAll('#leaveTable tbody tr');
    
    rows.forEach(row => {
        if (row.cells.length === 1) return; // Skip "no data" row
        
        const status = row.getAttribute('data-status')?.toLowerCase() || '';
        const type = row.getAttribute('data-type')?.toLowerCase() || '';
        const employee = row.getAttribute('data-employee')?.toLowerCase() || '';
        
        const matchesStatus = !statusFilter || status === statusFilter;
        const matchesType = !typeFilter || type === typeFilter;
        const matchesSearch = !searchTerm || employee.includes(searchTerm);
        
        if (matchesStatus && matchesType && matchesSearch) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

function resetFilters() {
    document.getElementById('filterStatus').value = '';
    document.getElementById('filterLeaveType').value = '';
    document.getElementById('searchEmployee').value = '';
    filterTable();
}
</script>

<?php require_once '../views/layouts/footer.php'; ?>

<script>
// Show employee info when selected
document.getElementById('employeeSelect').addEventListener('change', function() {
    const option = this.options[this.selectedIndex];
    if (option.value) {
        document.getElementById('empName').textContent = option.getAttribute('data-name');
        document.getElementById('empDept').textContent = option.getAttribute('data-dept');
        document.getElementById('empPosition').textContent = option.getAttribute('data-position');
        document.getElementById('employeeInfo').style.display = 'block';
    } else {
        document.getElementById('employeeInfo').style.display = 'none';
    }
});

// Calculate and display duration
function calculateDuration() {
    const startDate = new Date(document.getElementById('startDate').value);
    const endDate = new Date(document.getElementById('endDate').value);
    
    if (startDate && endDate && endDate >= startDate) {
        const days = Math.floor((endDate - startDate) / (1000 * 60 * 60 * 24)) + 1;
        document.getElementById('leaveDuration').textContent = days;
        document.getElementById('durationDisplay').style.display = 'block';
    } else {
        document.getElementById('durationDisplay').style.display = 'none';
    }
}

document.getElementById('startDate').addEventListener('change', calculateDuration);
document.getElementById('endDate').addEventListener('change', calculateDuration);

// Form validation
document.getElementById('leaveRequestForm').addEventListener('submit', function(e) {
    const startDate = new Date(document.getElementById('startDate').value);
    const endDate = new Date(document.getElementById('endDate').value);
    
    if (endDate < startDate) {
        e.preventDefault();
        alert('End date must be after or equal to start date!');
        return false;
    }
});

// Update end date min value when start date changes
document.getElementById('startDate').addEventListener('change', function() {
    document.getElementById('endDate').min = this.value;
});
</script>

<?php require_once '../views/layouts/footer.php'; ?>