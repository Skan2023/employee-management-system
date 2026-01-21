<?php
// app/core/Controller.php

class Controller {
    
    public function model($model) {
        require_once '../app/models/' . $model . '.php';
        return new $model();
    }

    public function view($view, $data = []) {
        extract($data);
        require_once '../views/' . $view . '.php';
    }

    public function redirect($url) {
        header('Location: ' . BASE_URL . $url);
        exit();
    }

    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    public function requireAuth() {
        if (!$this->isLoggedIn()) {
            $this->redirect('auth/login');
        }
    }

    public function requireRole($role) {
        if (!isset($_SESSION['role']) || $_SESSION['role'] !== $role) {
            $this->redirect('dashboard');
        }
    }
}