<?php
// app/controllers/DashboardController.php

class DashboardController extends Controller {
    
    public function index() {
        $this->requireAuth();

        $employeeModel = $this->model('Employee');
        $departmentModel = $this->model('Department');
        $leaveModel = $this->model('LeaveRequest');

        $data = [
            'totalEmployees' => $employeeModel->count(),
            'activeEmployees' => $employeeModel->countByStatus('active'),
            'totalDepartments' => $departmentModel->count(),
            'pendingLeaves' => $leaveModel->countByStatus('pending'),
            'recentEmployees' => array_slice($employeeModel->getAllWithDetails(), 0, 5),
            'recentLeaves' => array_slice($leaveModel->getAllWithEmployee(), 0, 5)
        ];

        $this->view('dashboard/index', $data);
    }
}