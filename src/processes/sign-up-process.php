<?php

// Make sure this path is correct and the file "connction.php" (or "connection.php") exists and works.
// Note: The original filename was "connction.php". If this is a typo, please correct it.
include "../connction.php";

$validationErrors = [];

// --- Input Validation (largely as provided, ensure all variables are defined before use) ---
if (!isset($_POST['first-name']) || empty($_POST['first-name'])) {
    $validationErrors[] = "First name is required";
} else {
    $firstName = $_POST['first-name'];
    if (strlen($firstName) > 20) {
        $validationErrors[] = "First name should be less than 20 characters";
    }
}

if (!isset($_POST['last-name']) || empty($_POST['last-name'])) {
    $validationErrors[] = "Last name is required";
} else {
    $lastName = $_POST['last-name'];
    if (strlen($lastName) > 20) {
        $validationErrors[] = "Last name should be less than 20 characters";
    }
}

if (!isset($_POST['email']) || empty($_POST['email'])) {
    $validationErrors[] = "Email is required";
} else {
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $validationErrors[] = "Invalid email format";
    } else {
        // Ensure Database::search method is available and works as expected.
        $resultSet = Database::search("SELECT * FROM `users` WHERE `email` = '" . $email . "'");
        if ($resultSet && $resultSet->num_rows > 0) {
            $validationErrors[] = "Email already exists";
        }
    }
}

$passwordFromPost = ''; // Initialize to prevent errors if not set
if (!isset($_POST['password']) || empty($_POST['password'])) {
    $validationErrors[] = "Password is required";
} else {
    $passwordFromPost = $_POST['password'];
    if (strlen($passwordFromPost) < 8) {
        $validationErrors[] = "Password should be at least 8 characters";
    }
}

if (!isset($_POST['confirm-password']) || empty($_POST['confirm-password'])) {
    $validationErrors[] = "Confirm password is required";
} else {
    $confirmPassword = $_POST['confirm-password'];
    if ($confirmPassword !== $passwordFromPost) {
        $validationErrors[] = "Passwords do not match";
    }
}

if (!isset($_POST['phone']) || empty($_POST['phone'])) {
    $validationErrors[] = "Mobile number is required";
} else {
    $mobileNumber = $_POST['phone'];
    if (strlen($mobileNumber) < 10) { // Assuming a minimum length for a phone number
        $validationErrors[] = "Mobile number should be at least 10 characters";
    }
}
// --- End of Input Validation ---

if (!empty($validationErrors)) {
    header('Content-Type: application/json');
    echo json_encode($validationErrors);
    exit;
}

// If validation passes, proceed to insert into database
// Ensure variables are definitely set from POST after validation
$firstName = $_POST['first-name'];
$lastName = $_POST['last-name'];
$email = $_POST['email'];
$passwordToStore = $_POST['password']; // Use the actual password for storage
$mobileNumber = $_POST['phone'];

$date = new DateTime();
$timeZone = new DateTimeZone("Asia/Colombo"); // Your specified timezone
$date->setTimezone($timeZone);
$createdDate = $date->format("Y-m-d H:i:s");

// CRITICAL FIX: Corrected order of values, particularly password and phone.
// Also ensure your Database::iud method properly handles SQL injection prevention (e.g., using prepared statements).
// The current string concatenation is vulnerable.
Database::iud("INSERT INTO `users` 
(`f_name`, `l_name`, `email`, `password`, `phone`, `datetime`, `status`) 
VALUES ('" . $firstName . "', '" . $lastName . "', '" . $email . "', '" . $passwordToStore . "', '" . $mobileNumber . "', '" . $createdDate . "', 1)");

echo "success";
exit; // Ensure no further output

?>