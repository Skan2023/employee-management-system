<?php
// app/controllers/SalaryController.php

class SalaryController extends Controller {
    
    private $salaryModel;
    private $employeeModel;

    public function __construct() {
        $this->salaryModel = $this->model('Salary');
        $this->employeeModel = $this->model('Employee');
    }

    public function index() {
        $this->requireAuth();
        $data['salaries'] = $this->salaryModel->getAllWithEmployee();
        $this->view('salaries/index', $data);
    }

    public function create() {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'employee_id' => $_POST['employee_id'],
                'basic_salary' => $_POST['basic_salary'],
                'allowance' => $_POST['allowance'],
                'deduction' => $_POST['deduction'],
                'effective_date' => $_POST['effective_date']
            ];

            if ($this->salaryModel->create($data)) {
                $_SESSION['success'] = 'Salary record created successfully';
                $this->redirect('salary');
            } else {
                $_SESSION['error'] = 'Something went wrong';
                $this->redirect('salary/create');
            }
        } else {
            $data['employees'] = $this->employeeModel->getAllWithDetails();
            $this->view('salaries/create', $data);
        }
    }

    public function edit($id) {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'employee_id' => $_POST['employee_id'],
                'basic_salary' => $_POST['basic_salary'],
                'allowance' => $_POST['allowance'],
                'deduction' => $_POST['deduction'],
                'effective_date' => $_POST['effective_date']
            ];

            if ($this->salaryModel->update($id, $data)) {
                $_SESSION['success'] = 'Salary record updated successfully';
                $this->redirect('salary');
            } else {
                $_SESSION['error'] = 'Something went wrong';
                $this->redirect('salary/edit/' . $id);
            }
        } else {
            $data['salary'] = $this->salaryModel->getByIdWithEmployee($id);
            $data['employees'] = $this->employeeModel->getAllWithDetails();
            $this->view('salaries/edit', $data);
        }
    }

    public function delete($id) {
        $this->requireAuth();

        if ($this->salaryModel->delete($id)) {
            $_SESSION['success'] = 'Salary record deleted successfully';
        } else {
            $_SESSION['error'] = 'Something went wrong';
        }
        $this->redirect('salary');
    }
}