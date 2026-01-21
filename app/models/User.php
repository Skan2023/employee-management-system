<?php
// app/models/User.php

class User extends Model {
    protected $table = 'users';

    public function login($username, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function create($data) {
        $stmt = $this->db->prepare("
            INSERT INTO users (username, password, role, employee_id) 
            VALUES (?, ?, ?, ?)
        ");
        $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
        return $stmt->execute([
            $data['username'],
            $hashedPassword,
            $data['role'],
            $data['employee_id'] ?? null
        ]);
    }

    public function update($id, $data) {
        if (isset($data['password']) && !empty($data['password'])) {
            $stmt = $this->db->prepare("
                UPDATE users 
                SET username = ?, password = ?, role = ?, employee_id = ?
                WHERE id = ?
            ");
            $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);
            return $stmt->execute([
                $data['username'],
                $hashedPassword,
                $data['role'],
                $data['employee_id'] ?? null,
                $id
            ]);
        } else {
            $stmt = $this->db->prepare("
                UPDATE users 
                SET username = ?, role = ?, employee_id = ?
                WHERE id = ?
            ");
            return $stmt->execute([
                $data['username'],
                $data['role'],
                $data['employee_id'] ?? null,
                $id
            ]);
        }
    }

    public function usernameExists($username, $excludeId = null) {
        if ($excludeId) {
            $stmt = $this->db->prepare("SELECT id FROM users WHERE username = ? AND id != ?");
            $stmt->execute([$username, $excludeId]);
        } else {
            $stmt = $this->db->prepare("SELECT id FROM users WHERE username = ?");
            $stmt->execute([$username]);
        }
        return $stmt->fetch() ? true : false;
    }
}