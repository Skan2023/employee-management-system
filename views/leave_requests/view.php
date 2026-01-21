<?php $title = "Leave Request Details"; require_once '../views/layouts/header.php'; ?>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="bi bi-calendar-check"></i> Leave Request Details</h2>
        <a href="<?php echo BASE_URL; ?>leaverequest" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="bi bi-info-circle"></i> Request Information</h5>
                </div>
                <div class="card-body">
                    <table class="table table-borderless">
                        <tr>
                            <th width="30%">Request ID:</th>
                            <td>#<?php echo str_pad($leave['id'], 4, '0', STR_PAD_LEFT); ?></td>
                        </tr>
                        <tr>
                            <th>Employee:</th>
                            <td>
                                <?php echo htmlspecialchars($leave['full_name']); ?>
                                <small class="text-muted">(<?php echo htmlspecialchars($leave['employee_code']); ?>)</small>
                            </td>
                        </tr>
                        <tr>
                            <th>Leave Type:</th>
                            <td><span class="badge bg-info"><?php echo htmlspecialchars($leave['leave_type']); ?></span></td>
                        </tr>
                        <tr>
                            <th>Start Date:</th>
                            <td><?php echo date('l, F d, Y', strtotime($leave['start_date'])); ?></td>
                        </tr>
                        <tr>
                            <th>End Date:</th>
                            <td><?php echo date('l, F d, Y', strtotime($leave['end_date'])); ?></td>
                        </tr>
                        <tr>
                            <th>Duration:</th>
                            <td>
                                <?php 
                                    $start = new DateTime($leave['start_date']);
                                    $end = new DateTime($leave['end_date']);
                                    $days = $start->diff($end)->days + 1;
                                    echo $days . ' day' . ($days > 1 ? 's' : '');
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <th>Reason:</th>
                            <td><?php echo nl2br(htmlspecialchars($leave['reason'])); ?></td>
                        </tr>
                        <tr>
                            <th>Status:</th>
                            <td>
                                <span class="badge bg-<?php 
                                    echo $leave['status'] == 'approved' ? 'success' : 
                                        ($leave['status'] == 'pending' ? 'warning' : 'danger'); 
                                ?>">
                                    <?php echo ucfirst($leave['status']); ?>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th>Requested On:</th>
                            <td><?php echo date('F d, Y g:i A', strtotime($leave['created_at'])); ?></td>
                        </tr>
                    </table>

                    <?php if ($leave['status'] == 'pending'): ?>
                    <hr>
                    <div class="d-flex gap-2 justify-content-center">
                        <a href="<?php echo BASE_URL; ?>leaverequest/approve/<?php echo $leave['id']; ?>" 
                           class="btn btn-success"
                           onclick="return confirm('Are you sure you want to approve this leave request?')">
                            <i class="bi bi-check-circle"></i> Approve
                        </a>
                        <a href="<?php echo BASE_URL; ?>leaverequest/reject/<?php echo $leave['id']; ?>" 
                           class="btn btn-danger"
                           onclick="return confirm('Are you sure you want to reject this leave request?')">
                            <i class="bi bi-x-circle"></i> Reject
                        </a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Timeline View -->
            <div class="card shadow-sm mt-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="bi bi-calendar3"></i> Leave Timeline</h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <?php
                        $current = clone $start;
                        while ($current <= $end) {
                            $dayName = $current->format('l');
                            $isWeekend = in_array($dayName, ['Saturday', 'Sunday']);
                            echo '<div class="mb-2">';
                            echo '<span class="badge ' . ($isWeekend ? 'bg-secondary' : 'bg-primary') . '">';
                            echo $current->format('M d, Y') . ' - ' . $dayName;
                            echo '</span>';
                            echo '</div>';
                            $current->modify('+1 day');
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../views/layouts/footer.php'; ?>