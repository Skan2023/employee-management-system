<?php
// app/models/Position.php

class Position extends Model {
    protected $table = 'positions';

    public function getAllWithDepartment() {
        $stmt = $this->db->prepare("
            SELECT p.*, d.department_name
            FROM positions p
            LEFT JOIN departments d ON p.department_id = d.id
            ORDER BY p.position_name
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByDepartment($departmentId) {
        $stmt = $this->db->prepare("SELECT * FROM positions WHERE department_id = ?");
        $stmt->execute([$departmentId]);
        return $stmt->fetchAll();
    }

    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO positions (position_name, department_id) 
            VALUES (?, ?)
        ");
        return $stmt->execute([
            $data['position_name'],
            $data['department_id']
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE positions 
            SET position_name = ?, department_id = ? 
            WHERE id = ?
        ");
        return $stmt->execute([
            $data['position_name'],
            $data['department_id'],
            $id
        ]);
    }
}

?>