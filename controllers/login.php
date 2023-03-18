<?php

session_start();

// Include the necessary files
require_once '../config/database.php';
require_once '../models/user.model.php';

// Initialize the database connection
$database = new Database();
$conn = $database->getConnection();

// Create a new User object with the database connection
$user = new User($conn);

// Check if the HTTP request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $username = $_POST['username'];
    $pin = $_POST['pin'];

    // Check if the username and pin are not empty, if they are, return a http 400 error
    if (empty($username) || empty($pin)) {
        // if ($username == 'test' || empty($pin)) {
        http_response_code(400);
        $error = array('error' => 'Usuario o pin vacios');
        header('Content-Type: application/json');
        echo json_encode($error);
        exit;
    }

    // Call the login user method on the User object
    $stmt = $user->loginUser($username, $pin);

    // Check if the user exists
    if ($stmt->rowCount() > 0) {
        // Get the user data
        $user_obj = array();
        while ($obj = $stmt->fetch(PDO::FETCH_OBJ)) {
            // Set the user data in the session
            $_SESSION['user_id'] =  $obj->id;
            $_SESSION['user_name'] = $obj->username;

            $user_obj[] = array(
                'id' => $obj->id,
                'username' => $obj->username,
                'firstName' => $obj->first_name,
                'lastName' => $obj->last_name,
            );
        }

        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($user_obj[0]);
        exit;
    } else {
        http_response_code(400);
        $error = array('error' => 'Usuario o pin incorrectos');
        header('Content-Type: application/json');
        echo json_encode($error);
        exit;
    }
}

?>