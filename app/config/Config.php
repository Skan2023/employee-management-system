<?php
// app/config/Config.php

define('BASE_URL', 'http://localhost/projects/employee-management-system/public/');
define('APP_NAME', 'Employee Management System');
define('DB_HOST', 'localhost');
define('DB_NAME', 'db_employee_management');
define('DB_USER', 'root');
define('DB_PASS', '');

// Session configuration
ini_set('session.cookie_httponly', 1);
ini_set('session.use_only_cookies', 1);

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
