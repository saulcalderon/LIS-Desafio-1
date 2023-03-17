<?php

session_start();

// Check if the HTTP request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Destroy the session.
    session_destroy();

    http_response_code(200);
    $success = array('success' => 'Usuario deslogueado');
    header('Content-Type: application/json');
    echo json_encode($success);
    exit;
}
