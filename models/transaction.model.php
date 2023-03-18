<?php

class Transaction
{
    private $conn;

    function __construct($db)
    {
        $this->conn = $db;
    }

    function saveTransaction($user_id, $transaction_type, $type, $amount, $transaction_date)
    {
        $sql = "INSERT INTO transactions (user_id, transaction_type, type, amount, transaction_date) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id, $transaction_type, $type, $amount, $transaction_date]);
        return $stmt->rowCount();
    }

    function getIncomeRecordsByUserId($user_id)
    {
        $sql = "SELECT * FROM transactions WHERE user_id = ? AND transaction_type = 'entrada' ORDER BY transaction_date DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }

    function getExpensesRecordsByUserId($user_id)
    {
        $sql = "SELECT * FROM transactions WHERE user_id = ? AND transaction_type = 'salida' ORDER BY transaction_date DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }
}
