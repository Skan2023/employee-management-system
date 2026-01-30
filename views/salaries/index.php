<?php $title = "Salaries"; require_once '../views/layouts/header.php'; ?>

<div class="container-fluid px-4 py-4">

    <!-- Page Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div>
            <h3 class="fw-bold mb-0">
                <i class="bi bi-cash-coin text-success"></i> Salary Management
            </h3>
            <small class="text-muted">Manage employee salary records</small>
        </div>

        <a href="<?= BASE_URL ?>salary/create" class="btn btn-success shadow-sm">
            <i class="bi bi-plus-lg"></i> Add Salary
        </a>
    </div>

    <!-- Card -->
    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="salaryTable">

                    <thead class="table-light text-uppercase small">
                        <tr>
                            <th>Employee</th>
                            <th>Code</th>
                            <th>Basic</th>
                            <th>Allowance</th>
                            <th>Deduction</th>
                            <th>Net Salary</th>
                            <th>Effective</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php foreach ($salaries as $salary): ?>
                        <tr>
                            <td>
                                <div class="fw-semibold"><?= htmlspecialchars($salary['full_name']) ?></div>
                            </td>

                            <td>
                                <span class="badge bg-secondary-subtle text-dark">
                                    <?= htmlspecialchars($salary['employee_code']) ?>
                                </span>
                            </td>

                            <td>$<?= number_format($salary['basic_salary'], 2) ?></td>

                            <td class="text-success">
                                + $<?= number_format($salary['allowance'], 2) ?>
                            </td>

                            <td class="text-danger">
                                - $<?= number_format($salary['deduction'], 2) ?>
                            </td>

                            <td>
                                <span class="badge bg-success fs-6 px-3 py-2">
                                    $<?= number_format($salary['net_salary'], 2) ?>
                                </span>
                            </td>

                            <td>
                                <?= date('M Y', strtotime($salary['effective_date'])) ?>
                            </td>

                            <td class="text-end">
                                <a href="<?= BASE_URL ?>salary/edit/<?= $salary['id'] ?>"
                                   class="btn btn-sm btn-outline-warning me-1"
                                   title="Edit">
                                    <i class="bi bi-pencil"></i>
                                </a>

                                <a href="<?= BASE_URL ?>salary/delete/<?= $salary['id'] ?>"
                                   class="btn btn-sm btn-outline-danger"
                                   onclick="return confirm('Delete this salary record?')"
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
    </div>

</div>

<?php require_once '../views/layouts/footer.php'; ?>
