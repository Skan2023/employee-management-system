
<?php $title = "Dashboard"; require_once '../views/layouts/header.php'; ?>

<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h2><i class="bi bi-file-earmark-plus-fill"></i> Create Department</h2>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="<?php echo BASE_URL; ?>department/create" novalidate>
                            <div class="mb-3">
                                <label for="name" class="form-label">Department Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="department_name" name="department_name" required placeholder="Enter department name">
                            </div>

                            <div class="mb-3">
                                <label for="description" class="form-label">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter department description"></textarea>
                            </div>

                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary">
                                <i class="bi bi-save"></i> Save
                                </button>
                                <a href="<?php echo BASE_URL; ?>department" class="btn btn-danger">
                                <i class="bi bi-x-circle"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                    
                </div>
            
                </div>

            </div>
        </div>
    </div>
</div>

