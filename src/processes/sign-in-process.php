<?php
session_start(); // Start the session at the very beginning

// Adjust path if your connction.php file is located elsewhere or named differently.
// Ensuring the filename "connction.php" matches your actual file.
include "../connction.php";

header('Content-Type: application/json'); // We will always output JSON

$response = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'] ?? '';
    $password_input = $_POST['password'] ?? ''; // Renamed to avoid confusion with stored hash

    // --- Basic Validation ---
    if (empty($email)) {
        $response = ['status' => 'error', 'message' => 'Email address is required.'];
        echo json_encode($response);
        exit;
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response = ['status' => 'error', 'message' => 'Invalid email format.'];
        echo json_encode($response);
        exit;
    }
    if (empty($password_input)) {
        $response = ['status' => 'error', 'message' => 'Password is required.'];
        echo json_encode($response);
        exit;
    }

    // --- Database Check ---
    // Get the database connection
    $db_connection = Database::getDatabaseConnection();
    if (!$db_connection) {
        $response = ['status' => 'error', 'message' => 'Database connection error.'];
        echo json_encode($response);
        exit;
    }

    // For better security, consider using prepared statements here.
    // This example continues with real_escape_string for simplicity with your current Database class.
    $escaped_email = $db_connection->real_escape_string($email);
    $query = "SELECT * FROM `users` WHERE `email` = '" . $escaped_email . "'";
    $resultSet = Database::search($query);

    if ($resultSet && $resultSet->num_rows == 1) {
        $user = $resultSet->fetch_assoc();

        // --- Secure Password Verification ---
        // Assumes $user['password'] stores the hashed password from your database
        // (e.g., created using password_hash() during registration)
        if (password_verify($password_input, $user['password'])) {
            // Password is correct
            $_SESSION['user_id'] = $user['id']; // Assuming 'id' is the primary key
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_fname'] = $user['f_name']; // Make sure 'f_name' column exists
            $_SESSION['user_lname'] = $user['l_name']; // Make sure 'l_name' column exists
            // You can add more user data to the session if needed

            $response = ['status' => 'success', 'message' => 'Sign in successful. Redirecting...'];
        } else {
            // Invalid password
            $response = ['status' => 'error', 'message' => 'Invalid email or password.'];
        }
    } else if ($resultSet === false) {
        // Error during query execution
        $response = ['status' => 'error', 'message' => 'Error checking credentials. Please try again.'];
    }
    else {
        // User not found or multiple users found (should not happen with unique email)
        $response = ['status' => 'error', 'message' => 'Invalid email or password.'];
    }
} else {
    $response = ['status' => 'error', 'message' => 'Invalid request method.'];
}

echo json_encode($response);
exit;
?>