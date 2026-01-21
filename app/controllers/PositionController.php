<?php
// app/controllers/PositionController.php

class PositionController extends Controller {
    
    private $positionModel;
    private $departmentModel;

    public function __construct() {
        $this->positionModel = $this->model('Position');
        $this->departmentModel = $this->model('Department');
    }

    public function index() {
        $this->requireAuth();
        $data['positions'] = $this->positionModel->getAllWithDepartment();
        $this->view('positions/index', $data);
    }

    public function create() {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'position_name' => trim($_POST['position_name']),
                'department_id' => $_POST['department_id']
            ];

            if ($this->positionModel->create($data)) {
                $_SESSION['success'] = 'Position created successfully';
                $this->redirect('position');
            } else {
                $_SESSION['error'] = 'Something went wrong';
                $this->redirect('position/create');
            }
        } else {
            $data['departments'] = $this->departmentModel->getAll();
            $this->view('positions/create', $data);
        }
    }

    public function edit($id) {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'position_name' => trim($_POST['position_name']),
                'department_id' => $_POST['department_id']
            ];

            if ($this->positionModel->update($id, $data)) {
                $_SESSION['success'] = 'Position updated successfully';
                $this->redirect('position');
            } else {
                $_SESSION['error'] = 'Something went wrong';
                $this->redirect('position/edit/' . $id);
            }
        } else {
            $data['position'] = $this->positionModel->getById($id);
            $data['departments'] = $this->departmentModel->getAll();
            $this->view('positions/edit', $data);
        }
    }

    public function delete($id) {
        $this->requireAuth();

        if ($this->positionModel->delete($id)) {
            $_SESSION['success'] = 'Position deleted successfully';
        } else {
            $_SESSION['error'] = 'Cannot delete position with existing employees';
        }
        $this->redirect('position');
    }
}