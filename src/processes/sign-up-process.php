<?php

include "../connction.php";

$validationErrors = [];

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
        $resultSet = Database::search("SELECT * FROM `users` WHERE `email` = '" . $email . "'");
        if ($resultSet->num_rows > 0) {
            $validationErrors[] = "Email already exists";
        }
    }
}

if (!isset($_POST['password']) || empty($_POST['password'])) {
    $validationErrors[] = "Password is required";
} else {
    $password = $_POST['password'];
    if (strlen($password) < 8) {
        $validationErrors[] = "Password should be at least 8 characters";
    }
}

if (!isset($_POST['conf-password']) || empty($_POST['conf-password'])) {
    $validationErrors[] = "Confirm password is required";
} else {
    $confirmPassword = $_POST['conf-password'];
    if ($confirmPassword !== $password) {
        $validationErrors[] = "Passwords do not match";
    }
}

if (!isset($_POST['phone']) || empty($_POST['phone'])) {
    $validationErrors[] = "Mobile number is required";
} else {
    $mobileNumber = $_POST['phone'];
    if (strlen($mobileNumber) < 10) {
        $validationErrors[] = "Mobile number should be at least 10 characters";
    }
}

if (!empty($validationErrors)) {
    echo json_encode($validationErrors);
    exit;
}

$date = new DateTime();
$timeZone = new DateTimeZone("Asia/Colombo");
$date->setTimezone($timeZone);
$createdDate = $date->format("Y-m-d H:i:s");

Database::iud("INSERT INTO `users` 
(`fname`, `lname`, `email`, `mobile`, `password`, `date_time`, ``) 
VALUES ('" . $firstName . "', '" . $lastName . "', '" . $email . "', '" . $mobileNumber . "', '" . $password . "', '" . $createdDate . "', '" . $gender . "')");

echo "success";