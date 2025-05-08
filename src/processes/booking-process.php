<?php

// Ensure connction.php is in the parent directory relative to this script
// If booking-process.php is in 'processes/' and connction.php is in the root, '../connction.php' is correct.
include '../connction.php';

// Initialize Database connection
Database::setUpConnection();
$dbConnection = Database::getDatabaseConnection(); // Get the connection for real_escape_string

$validationErrors = [];

// Validate First Name
if (!isset($_POST['fname']) || empty(trim($_POST['fname']))) {
    $validationErrors[] = "First name is required.";
} else {
    $fname = $dbConnection->real_escape_string(trim($_POST['fname']));
}

// Validate Last Name
if (!isset($_POST['lname']) || empty(trim($_POST['lname']))) {
    $validationErrors[] = "Last name is required.";
} else {
    $lname = $dbConnection->real_escape_string(trim($_POST['lname']));
}

// Validate Email
if (!isset($_POST['email']) || empty(trim($_POST['email']))) {
    $validationErrors[] = "Email is required.";
} elseif (!filter_var(trim($_POST['email']), FILTER_VALIDATE_EMAIL)) {
    $validationErrors[] = "Invalid email format.";
} else {
    $email = $dbConnection->real_escape_string(trim($_POST['email']));
}

// Validate Package
if (!isset($_POST['package']) || empty($_POST['package'])) {
    $validationErrors[] = "Package is required.";
} else {
    $package_id = $dbConnection->real_escape_string($_POST['package']);
}

// Validate Number of Guests
if (!isset($_POST['guests']) || empty($_POST['guests'])) {
    $validationErrors[] = "Number of guests is required.";
} elseif (!filter_var($_POST['guests'], FILTER_VALIDATE_INT, ["options" => ["min_range" => 1]])) {
    $validationErrors[] = "Number of guests must be at least 1.";
} else {
    $guests = $dbConnection->real_escape_string($_POST['guests']);
}

// Validate Check-in Date
if (!isset($_POST['checkin']) || empty($_POST['checkin'])) {
    $validationErrors[] = "Check-in date is required.";
} else {
    $checkin = $dbConnection->real_escape_string($_POST['checkin']);
}

// Validate Check-out Date
if (!isset($_POST['checkout']) || empty($_POST['checkout'])) {
    $validationErrors[] = "Check-out date is required.";
} else {
    $checkout = $dbConnection->real_escape_string($_POST['checkout']);
}

// Validate date logic (checkout after checkin)
if (empty($validationErrors) && strtotime($checkout) <= strtotime($checkin)) {
    $validationErrors[] = "Check-out date must be after check-in date.";
}

// Notes (Optional)
$notes = isset($_POST['notes']) ? $dbConnection->real_escape_string(trim($_POST['notes'])) : "";

// --- Fetch User ID ---
$userId = null;
if (isset($email)) { // Proceed only if email was valid
    $userResult = Database::search("SELECT `id` FROM `users` WHERE `email` = '$email'");
    if ($userResult && $userResult->num_rows > 0) {
        $userRow = $userResult->fetch_assoc();
        $userId = $userRow['id'];
    } else {
        // Option 1: User must exist
        $validationErrors[] = "User with email '$email' not found. Please register first or use a registered email.";
        // Option 2: Or, if users can book without being registered, you might handle this differently
        // For now, we assume the user must be in the 'users' table.
        // error_log("User not found for email: " . $_POST['email']); // Log for debugging
    }
}
// --- End Fetch User ID ---


if (!empty($validationErrors)) {
    // Output errors as a simple string, or JSON for better JS handling
    echo "Error: " . implode(" ", $validationErrors);
    Database::closeConnection();
    exit;
}

// Ensure userId is not null if it's a required foreign key and user must exist
if ($userId === null) {
    echo "Error: Could not associate booking with a user account. User ID is missing.";
    // error_log("Booking process failed: User ID is null for email " . $_POST['email']);
    Database::closeConnection();
    exit;
}

// Corrected column name for package_id to packages_id
$insertQuery = "INSERT INTO `booking`(`num_of_guest`, `check_in`, `check_out`, `msg`, `status`, `packages_id`, `users_id`)
                VALUES ('$guests', '$checkin', '$checkout', '$notes', '1', '$package_id', '$userId')";

if (Database::iud($insertQuery)) {
    echo "success";
} else {
    echo "Error: Booking failed. Please try again later.";
    // For debugging, you might log the error from the database
    // error_log("Database Insert Failed: " . $dbConnection->error . " | Query: " . $insertQuery);
}

Database::closeConnection(); // Good practice to close connection
exit;
