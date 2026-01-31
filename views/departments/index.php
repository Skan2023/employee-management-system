<?php $title = "Dashboard"; require_once '../views/layouts/header.php'; ?>

<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2><i class="bi bi-diagram-3"></i> Departments</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="<?php echo BASE_URL; ?>department/create" class="btn btn-primary">
                <i class="bi bi-house-add-fill"></i> Add Department
            </a>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="row mb-3">
        <div class="col-md-6 ">
            <form method="GET" action="<?php echo BASE_URL; ?>department" class="d-flex gap-2">
                <input type="text" name="search" class="form-control" placeholder="Search department..." value="<?php echo $_GET['search'] ?? ''; ?>">
                <button type="submit" class="btn btn-outline-primary w-25">
                    <i class="bi bi-search"></i> Search
                </button>
            </form>
        </div>
    </div>

    <!-- Departments Table -->
    <div class="card">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Department Name</th>
                        <th>Description</th>
                        <th>Created Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($departments)): ?>
                    <?php $no = 1; ?>   
                    <?php foreach ($departments as $dept): ?>
                    <tr>
                        <td><?php echo $no++; ?></td>  
                            <td><?php echo htmlspecialchars($dept['department_name']); ?></td>
                            <td><?php echo htmlspecialchars($dept['description'] ?? '-'); ?></td>
                            <td><?php echo date('M d, Y', strtotime($dept['created_at'])); ?></td>
                            <td>
                                <a href="<?php echo BASE_URL; ?>department/edit/<?php echo $dept['id']; ?>" class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <a href="<?php echo BASE_URL; ?>department/delete/<?php echo $dept['id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">
                                    <i class="bi bi-trash"></i> Delete
                                </a>
                            </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">No departments found</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
