<?php
// Start the session at the very beginning
session_start();

// Include the database connection file
require_once '../connction.php'; // Make sure this path is correct

// Set the content type to application/json for AJAX responses
header('Content-Type: application/json');

// Initialize the response array
$response = ['status' => 'error', 'message' => 'An unexpected error occurred.'];

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get username and password from the POST request
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : ''; // Password should not be trimmed before hashing/comparison
    $rememberMe = isset($_POST['remember-me']) && $_POST['remember-me'] === 'on';

    // Validate inputs
    if (empty($username) || empty($password)) {
        $response['message'] = 'Please enter both username and password.';
        echo json_encode($response);
        exit;
    }

    // Get the database connection
    $connection = Database::getDatabaseConnection();
    if (!$connection) {
        $response['message'] = 'Database connection failed. Please try again later.';
        // Log this error server-side as well
        error_log("admin-sign-in-process: Database connection failed.");
        echo json_encode($response);
        exit;
    }

    // Sanitize username to prevent SQL injection (using the connection object)
    $escapedUsername = $connection->real_escape_string($username);

    // Construct the SQL query to find the admin
    // IMPORTANT: This assumes passwords are NOT securely hashed in the DB.
    // For production, you MUST use password_hash() when storing and password_verify() here.
    $query = "SELECT `id`, `username`, `password` FROM `admin` WHERE `username` = '$escapedUsername'";

    // Execute the search query using the Database class
    $result = Database::search($query);

    if ($result && $result->num_rows === 1) {
        // Admin found, fetch the data
        $adminData = $result->fetch_assoc();

        // Verify the password
        // WARNING: Direct password comparison is INSECURE if passwords are not hashed or are weakly hashed.
        // Replace this with password_verify($password, $adminData['password']) if using password_hash().
        if ($password === $adminData['password']) { // Direct comparison (INSECURE for production)
        // if (password_verify($password, $adminData['password'])) { // Secure way if passwords are hashed

            // Password is correct, set session variables
            $_SESSION['admin_id'] = $adminData['id'];
            $_SESSION['admin_username'] = $adminData['username'];
            $_SESSION['admin_logged_in'] = true;


            // Handle "Remember Me" functionality
            if ($rememberMe) {
                // Set a cookie for the username. Expires in 30 days.
                // Ensure HttpOnly and Secure flags are used in production (Secure requires HTTPS)
                $cookieName = "remember_admin_username";
                $cookieValue = $adminData['username'];
                $expiryTime = time() + (86400 * 30); // 86400 seconds = 1 day
                setcookie($cookieName, $cookieValue, $expiryTime, "/", "", false, true); // Last two true for Secure and HttpOnly
            } else {
                // If "Remember Me" is not checked, ensure any existing cookie is cleared
                if (isset($_COOKIE["remember_admin_username"])) {
                    setcookie("remember_admin_username", "", time() - 3600, "/"); // Expire the cookie
                }
            }

            // Prepare success response
            $response['status'] = 'success';
            $response['message'] = 'Sign in successful. Redirecting to dashboard...';
            $response['redirect'] = 'admin-dashboard.php'; // URL for redirection

        } else {
            // Invalid password
            $response['message'] = 'Invalid username or password.';
        }
    } else {
        // Admin not found or multiple admins with the same username (should not happen if username is unique)
        $response['message'] = 'Invalid username or password.';
        if ($result === false) {
            // Log database query error if any
            error_log("Admin sign-in: Database query failed for username: " . $escapedUsername);
        }
    }

    // Close the database connection if your Database class has such a method
    // Database::closeConnection(); // Uncomment if you have this method

} else {
    // Request method is not POST
    $response['message'] = 'Invalid request method.';
}

// Send the JSON response
echo json_encode($response);
exit;
