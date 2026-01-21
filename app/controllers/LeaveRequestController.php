<?php
// app/controllers/LeaveRequestController.php

class LeaveRequestController extends Controller {
    
    private $leaveModel;
    private $employeeModel;

    public function __construct() {
        $this->leaveModel = $this->model('LeaveRequest');
        $this->employeeModel = $this->model('Employee');
    }

    public function index() {
        $this->requireAuth();
        $data['leaves'] = $this->leaveModel->getAllWithEmployee();
        $this->view('leave_requests/index', $data);
    }

    public function show($id) {
        $this->requireAuth();
        $data['leave'] = $this->leaveModel->getByIdWithEmployee($id);
        
        if (!$data['leave']) {
            $this->redirect('leaverequest');
        }

        $this->view('leave_requests/view', $data);
    }

    public function create() {
        $this->requireAuth();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'employee_id' => $_POST['employee_id'],
                'leave_type' => $_POST['leave_type'],
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date'],
                'reason' => trim($_POST['reason']),
                'status' => 'pending'
            ];

            if ($this->leaveModel->create($data)) {
                $_SESSION['success'] = 'Leave request submitted successfully';
                $this->redirect('leaverequest');
            } else {
                $_SESSION['error'] = 'Something went wrong';
                $this->redirect('leaverequest/create');
            }
        } else {
            $data['employees'] = $this->employeeModel->getAllWithDetails();
            $this->view('leave_requests/create', $data);
        }
    }

    public function approve($id) {
        $this->requireAuth();

        if ($this->leaveModel->updateStatus($id, 'approved')) {
            $_SESSION['success'] = 'Leave request approved';
        } else {
            $_SESSION['error'] = 'Something went wrong';
        }
        $this->redirect('leaverequest');
    }

    public function reject($id) {
        $this->requireAuth();

        if ($this->leaveModel->updateStatus($id, 'rejected')) {
            $_SESSION['success'] = 'Leave request rejected';
        } else {
            $_SESSION['error'] = 'Something went wrong';
        }
        $this->redirect('leaverequest');
    }

    public function delete($id) {
        $this->requireAuth();

        if ($this->leaveModel->delete($id)) {
            $_SESSION['success'] = 'Leave request deleted successfully';
        } else {
            $_SESSION['error'] = 'Something went wrong';
        }
        $this->redirect('leaverequest');
    }
}