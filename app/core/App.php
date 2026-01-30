<?php
// app/core/App.php

class App
{
    protected $controller = 'DashboardController';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseUrl();

        if (!isset($_SESSION['user_id'])) {
            $allowedAuthMethods = ['login', 'logout', 'register'];

            if (
                !isset($url[0]) || $url[0] !== 'auth' ||
                (isset($url[1]) && !in_array($url[1], $allowedAuthMethods))
            ) {
                header('Location: ' . BASE_URL . 'auth/login');
                exit();
            }
        }

        // Controller
        if (isset($url[0])) {
            $controller = ucfirst($url[0]) . 'Controller';
            if (file_exists('../app/controllers/' . $controller . '.php')) {
                $this->controller = $controller;
                unset($url[0]);
            }
        }

        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        // Method
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
                unset($url[1]);
            }
        }

        // Parameters
        $this->params = $url ? array_values($url) : [];

        // Call controller method with parameters
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl()
    {
        if (isset($_GET['url'])) {
            return explode('/', filter_var(rtrim($_GET['url'], '/'), FILTER_SANITIZE_URL));
        }
        return [];
    }
}
