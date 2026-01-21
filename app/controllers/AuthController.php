<?php
// app/controllers/AuthController.php

class AuthController extends Controller {
    
    private $userModel;

    public function __construct() {
        $this->userModel = $this->model('User');
    }

    public function login() {
        if ($this->isLoggedIn()) {
            $this->redirect('dashboard');
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            if (empty($username) || empty($password)) {
                $data['error'] = 'Please fill in all fields';
                $this->view('auth/login', $data);
                return;
            }

            $user = $this->userModel->login($username, $password);

            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['employee_id'] = $user['employee_id'];
                
                $this->redirect('dashboard');
            } else {
                $data['error'] = 'Invalid username or password';
                $this->view('auth/login', $data);
            }
        } else {
            $this->view('auth/login');
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        $this->redirect('auth/login');
    }
}