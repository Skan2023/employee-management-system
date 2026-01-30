<?php
// app/controllers/AuthController.php

class AuthController extends Controller
{

    private $userModel;

    public function __construct()
    {
        $this->userModel = $this->model('User');
    }

    public function login()
    {
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

    public function logout()
    {
        session_unset();
        session_destroy();
        $this->redirect('auth/login');
    }

    public function register()
{
    if ($this->isLoggedIn()) {
        // If already logged in, redirect to dashboard
        $this->redirect('dashboard');
        return;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = trim($_POST['username']);
        $password = trim($_POST['password']);
        $confirmPassword = trim($_POST['confirm_password']);

        // Always set role to 'admin' when registering
        $role = 'admin';

        // Validation
        if (empty($username) || empty($password) || empty($confirmPassword)) {
            $data['error'] = 'Please fill in all fields';
            $this->view('auth/register', $data);
            return;
        }

        // Check password length
        if (strlen($password) < 6) {
            $data['error'] = 'Password must be at least 6 characters long';
            $this->view('auth/register', $data);
            return;
        }

        // Check password match
        if ($password !== $confirmPassword) {
            $data['error'] = 'Passwords do not match';
            $this->view('auth/register', $data);
            return;
        }

        // Check if username already exists
        if ($this->userModel->usernameExists($username)) {
            $data['error'] = 'Username already exists. Please choose a different username';
            $this->view('auth/register', $data);
            return;
        }

        // Create user with admin role
        $userData = [
            'username' => $username,
            'password' => $password,
            'role' => 'admin',
            'employee_id' => null
        ];

        if ($this->userModel->create($userData)) {
            $data['success'] = 'Admin account created successfully! You can now login.';
            $this->view('auth/register', $data);
        } else {
            $data['error'] = 'Failed to create admin account. Please try again.';
            $this->view('auth/register', $data);
        }
    } else {
        $this->view('auth/register');
    }
}
}