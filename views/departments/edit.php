
<?php $title = "Dashboard"; require_once '../views/layouts/header.php'; ?>

<div class="container-fluid  py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-primary text-white">
                     <h2> Edit Department</h2>
                </div>

                <div class="card-body">
                    <form method="POST" action="<?php echo BASE_URL; ?>department/edit/<?php echo $department['id']; ?>">
                
                    <!--  ID -->
                    <input type="hidden" name="id" value="<?php echo $department['id']; ?>">
                    
                    <input type="text" class="form-control" name="department_name" value="<?php echo htmlspecialchars($department['department_name']); ?>" required> <br>

                    <textarea class="form-control" name="description" rows="4"><?php echo htmlspecialchars($department['description']); ?></textarea><br>

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
