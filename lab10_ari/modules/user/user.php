<?php
require_once __DIR__ . "/../../config/database.php";

class User extends Database {

    public function getAll() {
        return $this->query("SELECT * FROM users");
    }

    public function getById($id) {
        return $this->query("SELECT * FROM users WHERE id=$id")->fetch_assoc();
    }

    public function insert($data) {
        $username = $this->escape($data['username']);
        $password = md5($data['password']);

        return $this->query(
            "INSERT INTO users VALUES (NULL,'$username','$password')"
        );
    }

    public function update($id, $data) {
        $username = $this->escape($data['username']);

        return $this->query(
            "UPDATE users SET username='$username' WHERE id=$id"
        );
    }

    public function delete($id) {
        return $this->query("DELETE FROM users WHERE id=$id");
    }
}
