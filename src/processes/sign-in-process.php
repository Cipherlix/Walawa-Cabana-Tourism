<?php
session_start();

// Ensure this path is correct
// If connction.php is in the same directory, it would be: include "connction.php";
// If it's one directory up, it's: include "../connction.php";
include "../connction.php"; // CHECK THIS PATH. TYPO "connction.php" is kept as per your files.

header('Content-Type: application/json');
// Initialize response with a default redirect for success cases
$response = ['status' => 'error', 'message' => 'An unexpected error occurred.'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email_input = trim($_POST['email'] ?? '');
    // IMPORTANT: Your original code trims the password input.
    // If passwords can legitimately contain leading/trailing spaces and these are stored in the DB,
    // then $password_input = $_POST['password'] ?? ''; (without trim) would be needed.
    // However, to match your existing code, I'll keep trim().
    $password_input = trim($_POST['password'] ?? '');
    $remember_me = isset($_POST['remember-me']) && $_POST['remember-me'] === 'on';

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
        $response = ['status' => 'error', 'message' => 'Database connection error. Please check server logs.'];
        error_log("sign-in-process: Failed to get DB connection.");
        echo json_encode($response);
        exit;
    }

    // --- EXISTING DATABASE LOGIC (UNCHANGED AS PER REQUEST) ---
    $escaped_email = $db_connection->real_escape_string($email_input);
    // The query selects specific fields, which is good.
    $query = "SELECT id, email, password, f_name, l_name FROM `users` WHERE `email` = '" . $escaped_email . "'";
    $resultSet = Database::search($query);
    // --- END OF UNCHANGED DATABASE LOGIC ---

    if ($resultSet === false) {
        $response = ['status' => 'error', 'message' => 'Database query error. Please try again later.'];
        error_log("sign-in-process: Database search query failed for email: " . $escaped_email);
    } else if ($resultSet && $resultSet->num_rows == 1) {
        $user = $resultSet->fetch_assoc();
        $password_from_db = $user['password']; // Password from DB

        // --- EXISTING INSECURE PASSWORD COMPARISON (UNCHANGED AS PER REQUEST) ---
        if ($password_input === $password_from_db) {
            // Password is correct
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_fname'] = $user['f_name'];
            $_SESSION['user_lname'] = $user['l_name'];
            session_regenerate_id(true); // Regenerate session ID for security

            // --- "Remember Me" Cookie Handling ---
            if ($remember_me) {
                $cookie_name = "remember_user_email"; // Matches JS
                $cookie_value = $user['email'];
                // Expires in 30 days (86400 seconds per day * 30 days)
                $expiry = time() + (86400 * 30);
                // Set HttpOnly for security, Secure if on HTTPS
                setcookie($cookie_name, $cookie_value, $expiry, "/", "", isset($_SERVER["HTTPS"]), true);
            } else {
                // If "Remember Me" is not checked, or if user logs out explicitly later,
                // ensure any existing "remember_user_email" cookie is cleared.
                if (isset($_COOKIE["remember_user_email"])) {
                    // Set expiry in the past to delete the cookie
                    setcookie("remember_user_email", "", time() - 3600, "/", "", isset($_SERVER["HTTPS"]), true);
                }
            }
            // --- End of "Remember Me" Cookie Handling ---

            // Include a redirect URL in the success response
            $response = ['status' => 'success', 'message' => 'Sign in successful. Redirecting...', 'redirect' => 'index.php']; // Or any other page like 'dashboard.php'

        } else {
            $response = ['status' => 'error', 'message' => 'Invalid email or password.']; // Kept generic for security
            error_log("Password mismatch for email: " . $escaped_email);
        }
    } else if ($resultSet && $resultSet->num_rows == 0) {
        $response = ['status' => 'error', 'message' => 'Invalid email or password.']; // Kept generic
        error_log("Email not found: " . $escaped_email);
    } else if ($resultSet && $resultSet->num_rows > 1) {
        $response = ['status' => 'error', 'message' => 'System error: Multiple accounts found. Please contact support.'];
        error_log("CRITICAL: Multiple users found for email: " . $escaped_email);
    }

} else {
    $response = ['status' => 'error', 'message' => 'Invalid request method.'];
}

echo json_encode($response);
exit;