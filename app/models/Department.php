<?php
// app/models/Department.php

class Department extends Model {
    protected $table = 'departments';

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO departments (department_name) VALUES (?)");
        return $stmt->execute([$data['department_name']]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE departments SET department_name = ? WHERE id = ?");
        return $stmt->execute([$data['department_name'], $id]);
    }

    public function getWithEmployeeCount() {
        $stmt = $this->db->prepare("
            SELECT d.*, COUNT(e.id) as employee_count
            FROM departments d
            LEFT JOIN employees e ON d.id = e.department_id
            GROUP BY d.id
            ORDER BY d.department_name
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }
}

?>