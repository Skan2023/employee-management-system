dialect

-- Create Database
CREATE DATABASE IF NOT EXISTS db_employee_management;
USE db_employee_management;

-- Table: departments
CREATE TABLE departments (
    id INT PRIMARY KEY AUTO_INCREMENT,
    department_name VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Table: positions
CREATE TABLE positions (
    id INT PRIMARY KEY AUTO_INCREMENT,
    position_name VARCHAR(100) NOT NULL,
    department_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (department_id) REFERENCES departments(id) ON DELETE SET NULL
);

-- Table: employees
CREATE TABLE employees (
    id INT PRIMARY KEY AUTO_INCREMENT,
    employee_code VARCHAR(20) UNIQUE NOT NULL,
    full_name VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    phone VARCHAR(20),
    department_id INT,
    position_id INT,
    hire_date DATE,
    status VARCHAR(20) DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (department_id) REFERENCES departments(id) ON DELETE SET NULL,
    FOREIGN KEY (position_id) REFERENCES positions(id) ON DELETE SET NULL
);

-- Table: users
CREATE TABLE users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    username VARCHAR(50) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    role VARCHAR(20) NOT NULL,
    employee_id INT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (employee_id) REFERENCES employees(id) ON DELETE SET NULL
);

-- Table: salaries
CREATE TABLE salaries (
    id INT PRIMARY KEY AUTO_INCREMENT,
    employee_id INT NOT NULL,
    basic_salary DECIMAL(10,2),
    allowance DECIMAL(10,2),
    deduction DECIMAL(10,2),
    net_salary DECIMAL(10,2),
    effective_date DATE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (employee_id) REFERENCES employees(id) ON DELETE CASCADE
);

-- Table: leave_requests
CREATE TABLE leave_requests (
    id INT PRIMARY KEY AUTO_INCREMENT,
    employee_id INT NOT NULL,
    leave_type VARCHAR(50),
    start_date DATE,
    end_date DATE,
    reason TEXT,
    status VARCHAR(20) DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (employee_id) REFERENCES employees(id) ON DELETE CASCADE
);

-- Insert sample data
INSERT INTO departments (department_name) VALUES
('Human Resources'),
('Information Technology'),
('Sales & Marketing'),
('Finance'),
('Operations');

INSERT INTO positions (position_name, department_id) VALUES
('HR Manager', 1),
('HR Officer', 1),
('Software Developer', 2),
('System Administrator', 2),
('Sales Manager', 3),
('Marketing Executive', 3),
('Accountant', 4),
('Finance Manager', 4);

INSERT INTO employees (employee_code, full_name, email, phone, department_id, position_id, hire_date, status) VALUES
('EMP001', 'John Doe', 'john.doe@company.com', '123-456-7890', 1, 1, '2023-01-15', 'active'),
('EMP002', 'Jane Smith', 'jane.smith@company.com', '123-456-7891', 2, 3, '2023-02-20', 'active'),
('EMP003', 'Mike Johnson', 'mike.johnson@company.com', '123-456-7892', 3, 5, '2023-03-10', 'active'),
('EMP004', 'Sarah Williams', 'sarah.williams@company.com', '123-456-7893', 4, 7, '2023-04-05', 'active');

INSERT INTO users (username, password, role, employee_id) VALUES
('admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NULL),
('john.doe', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'employee', 1);
-- Default password for all: password

INSERT INTO salaries (employee_id, basic_salary, allowance, deduction, net_salary, effective_date) VALUES
(1, 50000.00, 5000.00, 2000.00, 53000.00, '2023-01-15'),
(2, 65000.00, 8000.00, 3000.00, 70000.00, '2023-02-20'),
(3, 55000.00, 6000.00, 2500.00, 58500.00, '2023-03-10'),
(4, 60000.00, 7000.00, 2800.00, 64200.00, '2023-04-05');

INSERT INTO leave_requests (employee_id, leave_type, start_date, end_date, reason, status) VALUES
(1, 'Annual Leave', '2026-02-15', '2026-02-20', 'Family vacation', 'pending'),
(2, 'Sick Leave', '2026-01-22', '2026-01-23', 'Medical appointment', 'approved');