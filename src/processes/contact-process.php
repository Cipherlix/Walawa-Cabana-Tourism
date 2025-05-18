<?php
session_start();

// Ensure this path is correct and connction.php defines the Database class.
include "../connction.php"; // As per your file structure

// Get the database connection using the Database class
$db_connection = Database::getDatabaseConnection(); // Uses method from your connction.php

// Check if the database connection was successful
if (!$db_connection) {
    // Your connction.php's setUpConnection method already dies on failure,
    // but an additional check here is good practice if that behavior changes.
    // error_log("contact-process.php: Failed to get DB connection or connection is not an object.");
    echo "error_db_connection"; // Send a generic error to client
    exit;
}

if (isset($_POST['contactName'], $_POST['contactEmail'], $_POST['contactSubject'], $_POST['contactMessage'])) {
    // Sanitize inputs using the obtained database connection object
    // The real_escape_string method is available on the mysqli object returned by getDatabaseConnection()
    $contactName = $db_connection->real_escape_string(trim($_POST['contactName']));
    $contactEmail = $db_connection->real_escape_string(trim($_POST['contactEmail']));
    $contactSubject = $db_connection->real_escape_string(trim($_POST['contactSubject']));
    $contactMessage = $db_connection->real_escape_string(trim($_POST['contactMessage']));

    // Validate inputs (basic server-side validation)
    if (empty($contactName) || empty($contactEmail) || empty($contactSubject) || empty($contactMessage)) {
        echo "error_validation_empty";
        exit;
    }
    if (!filter_var($contactEmail, FILTER_VALIDATE_EMAIL)) {
        echo "error_validation_email";
        exit;
    }

    $users_id = NULL;

    // Try to find the user_id based on the provided contactEmail
    if (!empty($contactEmail)) {
        $query_user = "SELECT id FROM users WHERE email = '" . $contactEmail . "' LIMIT 1";
        
        // Use Database::search() method from your connction.php
        $resultSet_user = Database::search($query_user); 

        if ($resultSet_user && $resultSet_user->num_rows > 0) {
            $user_row = $resultSet_user->fetch_assoc();
            $users_id = (int)$user_row['id']; // Cast to integer
        }
    }

    // Insert into the contact table using prepared statements for security
    // This uses the $db_connection object which is a mysqli instance
    $query_insert_contact = "INSERT INTO contact (users_id, subject, message) VALUES (?, ?, ?)";
    
    $stmt = $db_connection->prepare($query_insert_contact);
    if ($stmt) {
        // Bind parameters:
        // i - integer (users_id can be NULL, mysqli handles this with 'i' if variable is PHP NULL)
        // s - string (subject)
        // s - string (message)
        $stmt->bind_param("iss", $users_id, $contactSubject, $contactMessage);

        if ($stmt->execute()) {
            echo "success";
        } else {
            // Log detailed error on server for administrators
            error_log("Contact form insert execute error: " . $stmt->error . " | users_id: " . $users_id . ", subject: " . $contactSubject);
            echo "error_db_insert";
        }
        $stmt->close();
    } else {
        // Log detailed error on server for administrators
        error_log("Contact form prepare statement error: " . $db_connection->error . " | Query: " . $query_insert_contact);
        echo "error_db_prepare";
    }

    // You might not need to explicitly close the connection here if your Database class
    // uses a persistent connection or handles it via a destructor,
    // or if the script execution ends, PHP often cleans up.
    // However, if you want to use your class's close method:
    // Database::closeConnection(); // Uncomment if you want to explicitly close via your class method

} else {
    echo "error_missing_data";
}
?>