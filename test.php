<?php

// include database and object files

include_once 'config/database.php';

include_once 'models/user.model.php';

// get database connection

$database = new Database();

$db = $database->getConnection();


// prepare user object

$user = new User($db);

// query users

$stmt = $user->getAllUsers();

$num = $stmt->rowCount();

// check if more than 0 record found

if ($num > 0) {
    echo "Users found";

    // users array
    foreach ($stmt as $row) {
        echo $row['name'];
    }

}
