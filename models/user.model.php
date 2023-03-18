<?php
class User
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllUsers()
    {
        $query = "SELECT * FROM users";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt;
    }

    public function getUserById($id)
    {
        $query = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $id);
        $stmt->execute();

        return $stmt;
    }

    public function createUser($name, $email)
    {
        $query = "INSERT INTO users SET name = :name, email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }
    }

    public function loginUser($username, $pin)
    {
        $query = "SELECT * FROM users WHERE username = ? AND pin = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $username);
        $stmt->bindParam(2, $pin);
        $stmt->execute();

        return $stmt;
    }
}
