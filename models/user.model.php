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
