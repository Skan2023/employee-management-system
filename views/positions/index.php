<!-- FILE: views/positions/index.php -->
<?php $title = "Positions Management"; require_once '../views/layouts/header.php'; ?>

<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2><i class="bi bi-briefcase"></i> Positions Management</h2>
            <p class="text-muted mb-0">Manage job positions across all departments</p>
        </div>
        <a href="<?php echo BASE_URL; ?>position/create" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Position
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-primary shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted">Total Positions</h6>
                            <h3 class="mb-0"><?php echo count($positions); ?></h3>
                        </div>
                        <i class="bi bi-briefcase text-primary" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-info shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div>
                            <h6 class="text-muted">Departments</h6>
                            <h3 class="mb-0"><?php 
                                $depts = array_unique(array_column($positions, 'department_id'));
                                echo count($depts); 
                            ?></h3>
                        </div>
                        <i class="bi bi-diagram-3 text-info" style="font-size: 2rem;"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="card shadow-sm mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-4">
                    <label class="form-label">Filter by Department</label>
                    <select class="form-select" id="filterDepartment">
                        <option value="">All Departments</option>
                        <?php
                        $departments = [];
                        foreach ($positions as $pos) {
                            if (!in_array($pos['department_name'], $departments)) {
                                $departments[] = $pos['department_name'];
                                echo '<option value="' . htmlspecialchars($pos['department_name']) . '">';
                                echo htmlspecialchars($pos['department_name']);
                                echo '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <div class="col-md-4">
                    <label class="form-label">Search Position</label>
                    <input type="text" class="form-control" id="searchPosition" placeholder="Search by position name...">
                </div>
                <div class="col-md-4">
                    <label class="form-label">&nbsp;</label>
                    <button class="btn btn-secondary w-100" onclick="resetFilters()">
                        <i class="bi bi-arrow-clockwise"></i> Reset Filters
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Positions Table -->
    <div class="card shadow-sm">
        <div class="card-header bg-white">
            <h5 class="mb-0"><i class="bi bi-list-ul"></i> All Positions</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0" id="positionsTable">
                    <thead class="table-light">
                        <tr>
                            <th width="8%">#</th>
                            <th width="35%">Position Name</th>
                            <th width="30%">Department</th>
                            <th width="15%">Created Date</th>
                            <th width="12%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($positions)): ?>
                        <tr>
                            <td colspan="5" class="text-center py-4">
                                <i class="bi bi-inbox text-muted" style="font-size: 3rem;"></i>
                                <p class="text-muted mt-2">No positions found</p>
                                <a href="<?php echo BASE_URL; ?>position/create" class="btn btn-sm btn-primary">
                                    <i class="bi bi-plus"></i> Add First Position
                                </a>
                            </td>
                        </tr>
                        <?php else: ?>
                            <?php foreach ($positions as $index => $pos): ?>
                            <tr data-department="<?php echo htmlspecialchars($pos['department_name']); ?>">
                                <td><?php echo $index + 1; ?></td>
                                <td>
                                    <strong><?php echo htmlspecialchars($pos['position_name']); ?></strong>
                                </td>
                                <td>
                                    <span class="badge bg-info">
                                        <i class="bi bi-diagram-3"></i>
                                        <?php echo htmlspecialchars($pos['department_name']); ?>
                                    </span>
                                </td>
                                <td><?php echo date('M d, Y', strtotime($pos['created_at'])); ?></td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="<?php echo BASE_URL; ?>position/edit/<?php echo $pos['id']; ?>" 
                                           class="btn btn-sm btn-warning" title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                        <a href="<?php echo BASE_URL; ?>position/delete/<?php echo $pos['id']; ?>" 
                                           class="btn btn-sm btn-danger" 
                                           onclick="return confirm('Are you sure you want to delete this position?\n\nThis may affect employees assigned to this position.')"
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
        </div>
    </div>
</div>

<script>
// Filter by department
document.getElementById('filterDepartment').addEventListener('change', function() {
    filterTable();
});

// Search positions
document.getElementById('searchPosition').addEventListener('input', function() {
    filterTable();
});

function filterTable() {
    const deptFilter = document.getElementById('filterDepartment').value.toLowerCase();
    const searchTerm = document.getElementById('searchPosition').value.toLowerCase();
    const rows = document.querySelectorAll('#positionsTable tbody tr');
    
    rows.forEach(row => {
        const department = row.getAttribute('data-department')?.toLowerCase() || '';
        const positionName = row.cells[1]?.textContent.toLowerCase() || '';
        
        const matchesDept = !deptFilter || department.includes(deptFilter);
        const matchesSearch = !searchTerm || positionName.includes(searchTerm);
        
        if (matchesDept && matchesSearch) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

function resetFilters() {
    document.getElementById('filterDepartment').value = '';
    document.getElementById('searchPosition').value = '';
    filterTable();
}
</script>

<?php require_once '../views/layouts/footer.php'; ?>