<?php
session_start();

// Ensure this path is correct
// If connction.php is in the same directory, it would be: include "connction.php";
// If it's one directory up, it's: include "../connction.php";
include "../connction.php"; // CHECK THIS PATH

header('Content-Type: application/json');
$response = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Trim inputs to remove accidental leading/trailing whitespace
    $email_input = trim($_POST['email'] ?? '');
    $password_input = trim($_POST['password'] ?? ''); // Do NOT trim passwords if they can legitimately contain spaces as part of the password itself.
                                                  // However, for typical user input, trimming POST data is common.
                                                  // If passwords can have leading/trailing spaces, remove trim() for $password_input.

    if (empty($email_input)) {
        $response = ['status' => 'error', 'message' => 'Email address is required.'];
        echo json_encode($response);
        exit;
    }
    if (!filter_var($email_input, FILTER_VALIDATE_EMAIL)) {
        $response = ['status' => 'error', 'message' => 'Invalid email format.'];
        echo json_encode($response);
        exit;
    }
    if (empty($password_input)) {
        $response = ['status' => 'error', 'message' => 'Password is required.'];
        echo json_encode($response);
        exit;
    }

    $db_connection = Database::getDatabaseConnection();
    if (!$db_connection) {
        // This case should ideally be handled by die() in Database class for critical failure
        $response = ['status' => 'error', 'message' => 'Database connection error. Please check server logs.'];
        error_log("sign-in-process: Failed to get DB connection."); // Log this
        echo json_encode($response);
        exit;
    }

    $escaped_email = $db_connection->real_escape_string($email_input);
    $query = "SELECT id, email, password, f_name, l_name FROM `users` WHERE `email` = '" . $escaped_email . "'";

    // For debugging the query:
    // error_log("Executing query: " . $query);

    $resultSet = Database::search($query);

    if ($resultSet === false) {
        // Query itself failed
        $response = ['status' => 'error', 'message' => 'Database query error. Please try again later.'];
        error_log("sign-in-process: Database search query failed for email: " . $escaped_email);
    } else if ($resultSet && $resultSet->num_rows == 1) {
        $user = $resultSet->fetch_assoc();

        // --- INSECURE PLAINTEXT PASSWORD COMPARISON ---
        // Ensure the password from DB is also treated consistently (e.g. if it could have spaces)
        $password_from_db = $user['password'];

        // For debugging:
        // error_log("Input Password: '" . $password_input . "'");
        // error_log("DB Password: '" . $password_from_db . "' for email: " . $user['email']);
        // error_log("Password column type in DB: VARCHAR(20)"); // Remind yourself

        if ($password_input === $password_from_db) {
            // Password is correct
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_fname'] = $user['f_name'];
            $_SESSION['user_lname'] = $user['l_name'];
            $response = ['status' => 'success', 'message' => 'Sign in successful. Redirecting...'];
        } else {
            // Passwords do not match
            $response = ['status' => 'error', 'message' => 'Invalid email or password. (Reason: Password mismatch)'];
            error_log("Password mismatch for email: " . $escaped_email); // Log this
        }
    } else if ($resultSet && $resultSet->num_rows == 0) {
        // User not found with that email
        $response = ['status' => 'error', 'message' => 'Invalid email or password. (Reason: Email not found)'];
        error_log("Email not found: " . $escaped_email); // Log this
    } else if ($resultSet && $resultSet->num_rows > 1) {
        // Multiple users with the same email - data integrity issue! Email should be unique.
        $response = ['status' => 'error', 'message' => 'System error: Multiple accounts found for this email.'];
        error_log("CRITICAL: Multiple users found for email: " . $escaped_email); // Log this
    }

} else {
    $response = ['status' => 'error', 'message' => 'Invalid request method.'];
}

echo json_encode($response);
exit;
?>