<?php

session_start();

require_once '../config/database.php';
require_once '../models/transaction.model.php';

$database = new Database();
$conn = $database->getConnection();

// Create a new Transaction object with the database connection
$transaction = new Transaction($conn);

// Check if the HTTP request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $amount = $_POST['amount'];
    $type = $_POST['type'];
    $transaction_type = $_POST['transactionType'];
    $transaction_date = $_POST['date'];

    // check all values are not empty
    if (empty($amount) || empty($type) || empty($transaction_type) || empty($transaction_date)) {
        http_response_code(400);
        $error = array('error' => 'Todos los campos son obligatorios');
        header('Content-Type: application/json');
        echo json_encode($error);
        exit;
    }

    // check if the amount is a number
    if (!is_numeric($amount)) {
        http_response_code(400);
        $error = array('error' => 'El monto debe ser un número');
        header('Content-Type: application/json');
        echo json_encode($error);
        exit;
    }

    // check if the type is a valid type
    if ($transaction_type != 'entrada' && $transaction_type != 'salida') {
        http_response_code(400);
        $error = array('error' => 'El tipo de transacción no es válida');
        header('Content-Type: application/json');
        echo json_encode($error);
        exit;
    }

    // check if the date is a valid date
    if (!strtotime($transaction_date)) {
        http_response_code(400);
        $error = array('error' => 'La fecha no es válida');
        header('Content-Type: application/json');
        echo json_encode($error);
        exit;
    }

    // check if photo is included and return the path
    $photoPath = NULL;
    if (isset($_FILES['photo'])) {

        $target_dir = '../uploads/';
        $target_file = $target_dir . basename($_FILES['photo']['name']);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if image file is a actual image or fake image
        $check = getimagesize($_FILES['photo']['tmp_name']);
        // print_r($check);

        if ($check !== false) {
            $uploadOk = 1;
        } else {
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            http_response_code(400);
            $error = array('error' => 'No se pudo subir la imagen');
            header('Content-Type: application/json');
            echo json_encode($error);
            exit;
        } else {
            if (move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
                $photoPath = $target_file;
            } else {
                http_response_code(400);
                $error = array('error' => 'No se pudo subir la imagen' . $target_file);
                header('Content-Type: application/json');
                echo json_encode($error);
                exit;
            }
        }
    }

    // get the user id from the session
    $user_id = $_SESSION['user_id'];

    // call the create transaction method on the Transaction object
    $stmt = $transaction->saveTransaction($user_id, $transaction_type, $type, $amount, $transaction_date, $photoPath);

    if ($stmt) {
        http_response_code(200);

        $message = '';
        if ($transaction_type == 'entrada') {
            $message = 'Entrada por la cantidad de ';
        } else {
            $message = 'Salida por la cantidad de ';
        }

        $success = array('success' => $message . $amount . ' registrada');
        header('Content-Type: application/json');
        echo json_encode($success);
        exit;
    } else {
        http_response_code(400);
        $error = array('error' => 'No se pudo crear la transaccion');
        header('Content-Type: application/json');
        echo json_encode($error);
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['type'] == 'income') {

    // get the user id from the session
    $user_id = $_SESSION['user_id'];

    // call the get transactions method on the Transaction object
    $stmt = $transaction->getIncomeRecordsByUserId($user_id);

    // create a custom array to serialize the data
    $transactions = array();

    foreach ($stmt as $row) {
        $transactions[] = array(
            'id' => $row['id'],
            'transactionType' => $row['transaction_type'],
            'type' => $row['type'],
            'amount' => $row['amount'],
            'date' => $row['transaction_date'],
            'photoUrl' => $row['receipt_photo_path']
        );
    }

    if (!empty($transactions)) {
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($transactions);
        exit;
    } else {
        http_response_code(400);
        $error = array('error' => 'No se encontraron registros');
        header('Content-Type: application/json');
        echo json_encode($error);
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET' && $_GET['type'] == 'outcome') {

    // get the user id from the session
    $user_id = $_SESSION['user_id'];

    // call the get transactions method on the Transaction object
    $stmt = $transaction->getOutcomeRecordsByUserId($user_id);

    // create a custom array to serialize the data
    $transactions = array();

    foreach ($stmt as $row) {
        $transactions[] = array(
            'id' => $row['id'],
            'transactionType' => $row['transaction_type'],
            'type' => $row['type'],
            'amount' => $row['amount'],
            'date' => $row['transaction_date'],
            'photoUrl' => $row['receipt_photo_path']
        );
    }

    if (!empty($transactions)) {
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($transactions);
        exit;
    } else {
        http_response_code(400);
        $error = array('error' => 'No se encontraron registros');
        header('Content-Type: application/json');
        echo json_encode($error);
        exit;
    }
}
