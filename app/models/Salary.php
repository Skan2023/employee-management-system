<?php
// app/models/Salary.php

class Salary extends Model {
    protected $table = 'salaries';

    public function getAllWithEmployee() {
        $stmt = $this->db->prepare("
            SELECT s.*, e.full_name, e.employee_code
            FROM salaries s
            INNER JOIN employees e ON s.employee_id = e.id
            ORDER BY s.created_at DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByEmployee($employeeId) {
        $stmt = $this->db->prepare("
            SELECT s.*, e.full_name, e.employee_code
            FROM salaries s
            INNER JOIN employees e ON s.employee_id = e.id
            WHERE s.employee_id = ?
            ORDER BY s.effective_date DESC
        ");
        $stmt->execute([$employeeId]);
        return $stmt->fetchAll();
    }

    public function create($data) {
        $netSalary = $data['basic_salary'] + $data['allowance'] - $data['deduction'];
        
        $stmt = $this->db->prepare("
            INSERT INTO salaries 
            (employee_id, basic_salary, allowance, deduction, net_salary, effective_date) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['employee_id'],
            $data['basic_salary'],
            $data['allowance'],
            $data['deduction'],
            $netSalary,
            $data['effective_date']
        ]);
    }

    public function update($id, $data) {
        $netSalary = $data['basic_salary'] + $data['allowance'] - $data['deduction'];
        
        $stmt = $this->db->prepare("
            UPDATE salaries 
            SET employee_id = ?, basic_salary = ?, allowance = ?, 
                deduction = ?, net_salary = ?, effective_date = ?
            WHERE id = ?
        ");
        return $stmt->execute([
            $data['employee_id'],
            $data['basic_salary'],
            $data['allowance'],
            $data['deduction'],
            $netSalary,
            $data['effective_date'],
            $id
        ]);
    }

    public function getByIdWithEmployee($id) {
        $stmt = $this->db->prepare("
            SELECT s.*, e.full_name, e.employee_code
            FROM salaries s
            INNER JOIN employees e ON s.employee_id = e.id
            WHERE s.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }
}

?>