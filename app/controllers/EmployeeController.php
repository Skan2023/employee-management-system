<?php
// app/controllers/EmployeeController.php

class EmployeeController extends Controller {
    
    private $employeeModel;
    private $departmentModel;
    private $positionModel;

    public function __construct() {
        $this->employeeModel = $this->model('Employee');
        $this->departmentModel = $this->model('Department');
        $this->positionModel = $this->model('Position');
    }

    public function index() {
        $this->requireAuth();
        $data['employees'] = $this->employeeModel->getAllWithDetails();
        $this->view('employees/index', $data);
    }

    public function show($id) {
        $this->requireAuth();
        $data['employee'] = $this->employeeModel->getByIdWithDetails($id);
        
        if (!$data['employee']) {
            $this->redirect('employee');
        }

        $salaryModel = $this->model('Salary');
        $leaveModel = $this->model('LeaveRequest');
        
        $data['salaries'] = $salaryModel->getByEmployee($id);
        $data['leaves'] = $leaveModel->getByEmployee($id);

        $this->view('employees/view', $data);
    }

    public function create() {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'employee_code' => trim($_POST['employee_code']),
                'full_name' => trim($_POST['full_name']),
                'email' => trim($_POST['email']),
                'phone' => trim($_POST['phone']),
                'department_id' => $_POST['department_id'],
                'position_id' => $_POST['position_id'],
                'hire_date' => $_POST['hire_date'],
                'status' => $_POST['status']
            ];

            if ($this->employeeModel->employeeCodeExists($data['employee_code'])) {
                $_SESSION['error'] = 'Employee code already exists';
                $this->redirect('employee/create');
                return;
            }

            if ($this->employeeModel->create($data)) {
                $_SESSION['success'] = 'Employee created successfully';
                $this->redirect('employee');
            } else {
                $_SESSION['error'] = 'Something went wrong';
                $this->redirect('employee/create');
            }
        } else {
            $data['departments'] = $this->departmentModel->getAll();
            $data['positions'] = $this->positionModel->getAll();
            $this->view('employees/create', $data);
        }
    }

    public function edit($id) {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'employee_code' => trim($_POST['employee_code']),
                'full_name' => trim($_POST['full_name']),
                'email' => trim($_POST['email']),
                'phone' => trim($_POST['phone']),
                'department_id' => $_POST['department_id'],
                'position_id' => $_POST['position_id'],
                'hire_date' => $_POST['hire_date'],
                'status' => $_POST['status']
            ];

            if ($this->employeeModel->employeeCodeExists($data['employee_code'], $id)) {
                $_SESSION['error'] = 'Employee code already exists';
                $this->redirect('employee/edit/' . $id);
                return;
            }

            if ($this->employeeModel->update($id, $data)) {
                $_SESSION['success'] = 'Employee updated successfully';
                $this->redirect('employee');
            } else {
                $_SESSION['error'] = 'Something went wrong';
                $this->redirect('employee/edit/' . $id);
            }
        } else {
            $data['employee'] = $this->employeeModel->getById($id);
            $data['departments'] = $this->departmentModel->getAll();
            $data['positions'] = $this->positionModel->getAll();
            $this->view('employees/edit', $data);
        }
    }

    public function delete($id) {
        $this->requireAuth();

        if ($this->employeeModel->delete($id)) {
            $_SESSION['success'] = 'Employee deleted successfully';
        } else {
            $_SESSION['error'] = 'Something went wrong';
        }
        $this->redirect('employee');
    }

    public function getPositions($departmentId) {
        $positions = $this->positionModel->getByDepartment($departmentId);
        header('Content-Type: application/json');
        echo json_encode($positions);
    }
}