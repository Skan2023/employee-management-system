<!-- FILE: views/leave_requests/create.php -->
<?php $title = "Create Leave Request"; require_once '../views/layouts/header.php'; ?>

<div class="container-fluid py-4">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>dashboard">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="<?php echo BASE_URL; ?>leaverequest">Leave Requests</a></li>
            <li class="breadcrumb-item active">Create Request</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-calendar-plus"></i> New Leave Request</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?php echo BASE_URL; ?>leaverequest/create" id="leaveRequestForm">
                        <div class="row">
                            <!-- Employee Selection -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Employee *</label>
                                <select class="form-select" name="employee_id" id="employeeSelect" required>
                                    <option value="">Select Employee</option>
                                    <?php foreach ($employees as $emp): ?>
                                        <option value="<?php echo $emp['id']; ?>" 
                                                data-name="<?php echo htmlspecialchars($emp['full_name']); ?>"
                                                data-dept="<?php echo htmlspecialchars($emp['department_name']); ?>"
                                                data-position="<?php echo htmlspecialchars($emp['position_name']); ?>">
                                            <?php echo htmlspecialchars($emp['employee_code'] . ' - ' . $emp['full_name']); ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <small class="text-muted">Select the employee requesting leave</small>
                            </div>

                            <!-- Leave Type -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Leave Type *</label>
                                <select class="form-select" name="leave_type" id="leaveType" required>
                                    <option value="">Select Leave Type</option>
                                    <option value="Annual Leave">🏖️ Annual Leave</option>
                                    <option value="Sick Leave">🏥 Sick Leave</option>
                                    <option value="Casual Leave">📅 Casual Leave</option>
                                    <option value="Maternity Leave">👶 Maternity Leave</option>
                                    <option value="Paternity Leave">👨‍👩‍👧 Paternity Leave</option>
                                    <option value="Unpaid Leave">💼 Unpaid Leave</option>
                                    <option value="Other">➕ Other</option>
                                </select>
                                <small class="text-muted">Choose the type of leave</small>
                            </div>
                        </div>

                        <!-- Employee Info Display -->
                        <div id="employeeInfo" class="alert alert-info" style="display: none;">
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>Name:</strong> <span id="empName"></span>
                                </div>
                                <div class="col-md-4">
                                    <strong>Department:</strong> <span id="empDept"></span>
                                </div>
                                <div class="col-md-4">
                                    <strong>Position:</strong> <span id="empPosition"></span>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- Start Date -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Start Date *</label>
                                <input type="date" class="form-control" name="start_date" id="startDate" 
                                       min="<?php echo date('Y-m-d'); ?>" required>
                                <small class="text-muted">First day of leave</small>
                            </div>

                            <!-- End Date -->
                            <div class="col-md-6 mb-3">
                                <label class="form-label">End Date *</label>
                                <input type="date" class="form-control" name="end_date" id="endDate" 
                                       min="<?php echo date('Y-m-d'); ?>" required>
                                <small class="text-muted">Last day of leave</small>
                            </div>
                        </div>

                        <!-- Duration Display -->
                        <div class="mb-3">
                            <div class="alert alert-secondary" id="durationDisplay" style="display: none;">
                                <i class="bi bi-calendar-range"></i>
                                <strong>Duration:</strong> <span id="leaveDuration">0</span> day(s)
                            </div>
                        </div>

                        <!-- Reason -->
                        <div class="mb-3">
                            <label class="form-label">Reason for Leave *</label>
                            <textarea class="form-control" name="reason" rows="4" 
                                      placeholder="Please provide a detailed reason for your leave request..." 
                                      required maxlength="500"></textarea>
                            <small class="text-muted">Maximum 500 characters</small>
                        </div>

                        <!-- Important Notes -->
                        <div class="alert alert-warning">
                            <i class="bi bi-exclamation-triangle"></i>
                            <strong>Important Notes:</strong>
                            <ul class="mb-0 mt-2">
                                <li>Leave requests will be submitted with <strong>Pending</strong> status</li>
                                <li>Approval is required from your department manager</li>
                                <li>Please submit requests at least 3 days in advance</li>
                                <li>Emergency leaves may require supporting documents</li>
                            </ul>
                        </div>

                        <hr>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="bi bi-send"></i> Submit Leave Request
                            </button>
                            <button type="reset" class="btn btn-outline-secondary">
                                <i class="bi bi-arrow-clockwise"></i> Reset Form
                            </button>
                            <a href="<?php echo BASE_URL; ?>leaverequest" class="btn btn-secondary">
                                <i class="bi bi-x-circle"></i> Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>