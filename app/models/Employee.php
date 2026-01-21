<?php
// app/models/Employee.php

class Employee extends Model {
    protected $table = 'employees';

    public function getAllWithDetails() {
        $stmt = $this->db->prepare("
            SELECT e.*, 
                   d.department_name, 
                   p.position_name
            FROM employees e
            LEFT JOIN departments d ON e.department_id = d.id
            LEFT JOIN positions p ON e.position_id = p.id
            ORDER BY e.created_at DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByIdWithDetails($id) {
        $stmt = $this->db->prepare("
            SELECT e.*, 
                   d.department_name, 
                   p.position_name
            FROM employees e
            LEFT JOIN departments d ON e.department_id = d.id
            LEFT JOIN positions p ON e.position_id = p.id
            WHERE e.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO employees 
            (employee_code, full_name, email, phone, department_id, position_id, hire_date, status) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['employee_code'],
            $data['full_name'],
            $data['email'],
            $data['phone'],
            $data['department_id'],
            $data['position_id'],
            $data['hire_date'],
            $data['status']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE employees 
            SET employee_code = ?, full_name = ?, email = ?, phone = ?, 
                department_id = ?, position_id = ?, hire_date = ?, status = ?
            WHERE id = ?
        ");
        return $stmt->execute([
            $data['employee_code'],
            $data['full_name'],
            $data['email'],
            $data['phone'],
            $data['department_id'],
            $data['position_id'],
            $data['hire_date'],
            $data['status'],
            $id
        ]);
    }

    public function employeeCodeExists($code, $excludeId = null) {
        if ($excludeId) {
            $stmt = $this->db->prepare("SELECT id FROM employees WHERE employee_code = ? AND id != ?");
            $stmt->execute([$code, $excludeId]);
        } else {
            $stmt = $this->db->prepare("SELECT id FROM employees WHERE employee_code = ?");
            $stmt->execute([$code]);
        }
        return $stmt->fetch() ? true : false;
    }

    public function countByStatus($status = 'active') {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM employees WHERE status = ?");
        $stmt->execute([$status]);
        $result = $stmt->fetch();
        return $result['total'];
    }
}

?>