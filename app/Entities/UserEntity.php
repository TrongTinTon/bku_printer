<?php

namespace App\Entities;

use App\Entities\Entity;

class UserEntity extends Entity {
    private $id;
    private $email;
    private $username;
    private $role_id;

    public function __construct($id = null, $email = null, $username = null, $role_id = null) {
        $this->id = $id;
        $this->email = $email;
        $this->username = $username;
        $this->role_id = $role_id;
    }

    // Getter và Setter
    public function getId() { return $this->id; }
    public function setId($id) { $this->id = $id; }

    public function getEmail() { return $this->email; }
    public function setEmail($email) { $this->email = $email; }

    public function getUserName() { return $this->username; }
    public function setUserName($username) { $this->username = $username; }

    public function getRoleId() { return $this->role_id; }
    public function setRoleId(array $role_id) { $this->role_id = $role_id; }

    public function toArray() {
        return [
            'id' => $this->id ?? null,
            'email' => $this->email ?? null,
            'username' => $this->username ?? null,
            'role_id' => $this->role_id ?? null
        ];
    }
}
