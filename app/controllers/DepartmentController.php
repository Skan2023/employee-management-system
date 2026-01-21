<?php
// app/controllers/DepartmentController.php

class DepartmentController extends Controller {
    
    private $departmentModel;

    public function __construct() {
        $this->departmentModel = $this->model('Department');
    }

    public function index() {
        $this->requireAuth();
        $data['departments'] = $this->departmentModel->getWithEmployeeCount();
        $this->view('departments/index', $data);
    }

    public function create() {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'department_name' => trim($_POST['department_name'])
            ];

            if ($this->departmentModel->create($data)) {
                $_SESSION['success'] = 'Department created successfully';
                $this->redirect('department');
            } else {
                $_SESSION['error'] = 'Something went wrong';
                $this->redirect('department/create');
            }
        } else {
            $this->view('departments/create');
        }
    }

    public function edit($id) {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'department_name' => trim($_POST['department_name'])
            ];

            if ($this->departmentModel->update($id, $data)) {
                $_SESSION['success'] = 'Department updated successfully';
                $this->redirect('department');
            } else {
                $_SESSION['error'] = 'Something went wrong';
                $this->redirect('department/edit/' . $id);
            }
        } else {
            $data['department'] = $this->departmentModel->getById($id);
            $this->view('departments/edit', $data);
        }
    }

    public function delete($id) {
        $this->requireAuth();

        if ($this->departmentModel->delete($id)) {
            $_SESSION['success'] = 'Department deleted successfully';
        } else {
            $_SESSION['error'] = 'Cannot delete department with existing employees';
        }
        $this->redirect('department');
    }
}