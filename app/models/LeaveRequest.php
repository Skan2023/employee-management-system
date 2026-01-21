<?php
// app/models/LeaveRequest.php

class LeaveRequest extends Model {
    protected $table = 'leave_requests';

    public function getAllWithEmployee() {
        $stmt = $this->db->prepare("
            SELECT lr.*, e.full_name, e.employee_code
            FROM leave_requests lr
            INNER JOIN employees e ON lr.employee_id = e.id
            ORDER BY lr.created_at DESC
        ");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getByEmployee($employeeId) {
        $stmt = $this->db->prepare("
            SELECT * FROM leave_requests 
            WHERE employee_id = ? 
            ORDER BY created_at DESC
        ");
        $stmt->execute([$employeeId]);
        return $stmt->fetchAll();
    }

    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO leave_requests 
            (employee_id, leave_type, start_date, end_date, reason, status) 
            VALUES (?, ?, ?, ?, ?, ?)
        ");
        return $stmt->execute([
            $data['employee_id'],
            $data['leave_type'],
            $data['start_date'],
            $data['end_date'],
            $data['reason'],
            $data['status'] ?? 'pending'
        ]);
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("
            UPDATE leave_requests 
            SET employee_id = ?, leave_type = ?, start_date = ?, 
                end_date = ?, reason = ?, status = ?
            WHERE id = ?
        ");
        return $stmt->execute([
            $data['employee_id'],
            $data['leave_type'],
            $data['start_date'],
            $data['end_date'],
            $data['reason'],
            $data['status'],
            $id
        ]);
    }

    public function updateStatus($id, $status) {
        $stmt = $this->db->prepare("UPDATE leave_requests SET status = ? WHERE id = ?");
        return $stmt->execute([$status, $id]);
    }

    public function getByIdWithEmployee($id) {
        $stmt = $this->db->prepare("
            SELECT lr.*, e.full_name, e.employee_code
            FROM leave_requests lr
            INNER JOIN employees e ON lr.employee_id = e.id
            WHERE lr.id = ?
        ");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function countByStatus($status = 'pending') {
        $stmt = $this->db->prepare("SELECT COUNT(*) as total FROM leave_requests WHERE status = ?");
        $stmt->execute([$status]);
        $result = $stmt->fetch();
        return $result['total'];
    }
}