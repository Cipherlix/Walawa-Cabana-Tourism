<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Ensure this path is correct for your project structure
include '../connction.php'; // Assuming connction.php is one level up from 'processes' directory

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Ensure these paths are correct relative to booking-process.php
require __DIR__ . "/../mail/PHPMailer.php";
require __DIR__ . "/../mail/SMTP.php";
require __DIR__ . "/../mail/Exception.php";

$responseMessages = [];

// --- Input Retrieval and Basic Validation ---
$fname = $_POST['fname'] ?? '';
$lname = $_POST['lname'] ?? '';
$email = $_POST['email'] ?? '';
$packageId = $_POST['package'] ?? '';
$guests = $_POST['guests'] ?? '';
$checkin_date = $_POST['checkin_date'] ?? '';
$checkin_time = $_POST['checkin_time'] ?? '';
$checkout_date = $_POST['checkout_date'] ?? '';
$checkout_time = $_POST['checkout_time'] ?? '';
$notes = $_POST['notes'] ?? "";

// Required field checks
if (empty($fname)) $responseMessages['errors'][] = "First name is required.";
if (empty($lname)) $responseMessages['errors'][] = "Last name is required.";
if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $responseMessages['errors'][] = "A valid email is required.";
if (empty($packageId)) $responseMessages['errors'][] = "Package is required.";
if (empty($guests) || !ctype_digit($guests) || (int)$guests < 1) $responseMessages['errors'][] = "Number of guests must be a positive number.";
if (empty($checkin_date)) $responseMessages['errors'][] = "Check-in date is required.";
if (empty($checkin_time)) $responseMessages['errors'][] = "Check-in time is required.";
if (empty($checkout_date)) $responseMessages['errors'][] = "Check-out date is required.";
if (empty($checkout_time)) $responseMessages['errors'][] = "Check-out time is required.";

// Date and Time Logic Validation
if (!empty($checkin_date) && !empty($checkin_time) && !empty($checkout_date) && !empty($checkout_time)) {
    try {
        $checkinDateTime = new DateTime($checkin_date . ' ' . $checkin_time);
        $checkoutDateTime = new DateTime($checkout_date . ' ' . $checkout_time);
        $currentDateTime = new DateTime(); // For checking against past dates/times

        if ($checkinDateTime < $currentDateTime) {
            // Allowing booking for current day but future time is typical.
            // If you want to prevent booking for times that have already passed today:
            // $todayDate = (new DateTime())->format('Y-m-d');
            // if ($checkin_date == $todayDate && $checkinDateTime < $currentDateTime) {
            //     $responseMessages['errors'][] = "Check-in date and time cannot be in the past.";
            // } else if ($checkin_date < $todayDate) {
            //     $responseMessages['errors'][] = "Check-in date cannot be in the past.";
            // }
            // Simplified: if check-in is before "now", it's an error.
            // A small grace period might be needed in practice, e.g., checkinDateTime < (new DateTime('-5 minutes'))
        }


        if ($checkoutDateTime <= $checkinDateTime) {
            $responseMessages['errors'][] = "Check-out date and time must be after check-in date and time.";
        }
    } catch (Exception $e) {
        $responseMessages['errors'][] = "Invalid date or time format provided.";
    }
}


if (!empty($responseMessages['errors'])) {
    if (!headers_sent()) header('Content-Type: application/json');
    echo json_encode($responseMessages);
    exit;
}

// --- Database Operations ---
$dbConnection = Database::getDatabaseConnection(); // Get connection instance

// User check
$escapedEmail = $dbConnection->real_escape_string($email);
$userResult = Database::search("SELECT `id` FROM `users` WHERE `email` = '{$escapedEmail}'");
$userId = null;
if ($userResult && $userResult->num_rows == 1) {
    $userRow = $userResult->fetch_assoc();
    $userId = $userRow['id'];
} else {
    $responseMessages['errors'][] = "User with the provided email not found. Please register or use a registered email.";
    if (!headers_sent()) header('Content-Type: application/json');
    echo json_encode($responseMessages);
    exit;
}

// Package check
$escapedPackageId = $dbConnection->real_escape_string($packageId);
$packageResult = Database::search("SELECT `name` FROM `packages` WHERE `id` = '{$escapedPackageId}'");
$packageName = "N/A";
if ($packageResult && $packageResult->num_rows == 1) {
    $packageRow = $packageResult->fetch_assoc();
    $packageName = $packageRow['name'];
} else {
    $responseMessages['errors'][] = "Selected package not found.";
    if (!headers_sent()) header('Content-Type: application/json');
    echo json_encode($responseMessages);
    exit;
}

// --- Availability Check ---
// Format the user's requested start and end datetimes for SQL comparison
$requestedStartDateTimeSQL = $dbConnection->real_escape_string($checkin_date . ' ' . $checkin_time);
$requestedEndDateTimeSQL = $dbConnection->real_escape_string($checkout_date . ' ' . $checkout_time);

// Query to check for overlapping bookings for the SAME package
// This assumes 'status' = '1' means a confirmed/active booking that blocks the slot.
// Adjust 'status' based on your application's booking lifecycle.
$availabilityQuery = "
    SELECT `id` FROM `booking`
    WHERE `packages_id` = '{$escapedPackageId}'
      AND `status` = '1'  -- Consider only active bookings
      AND (
            STR_TO_DATE('{$requestedStartDateTimeSQL}', '%Y-%m-%d %H:%i:%s') < STR_TO_DATE(CONCAT(`check_out`, ' ', `check_out_time`), '%Y-%m-%d %H:%i:%s')
            AND
            STR_TO_DATE('{$requestedEndDateTimeSQL}', '%Y-%m-%d %H:%i:%s') > STR_TO_DATE(CONCAT(`check_in`, ' ', `check_in_time`), '%Y-%m-%d %H:%i:%s')
      )
    LIMIT 1;
";

$conflictingBooking = Database::search($availabilityQuery);

if ($conflictingBooking && $conflictingBooking->num_rows > 0) {
    $responseMessages['errors'][] = "The selected dates and times for this package are not available. Please choose different times or dates.";
    if (!headers_sent()) header('Content-Type: application/json');
    echo json_encode($responseMessages);
    exit;
}

// --- Insert Booking ---
$escapedGuests = $dbConnection->real_escape_string($guests);
$escapedCheckinDate = $dbConnection->real_escape_string($checkin_date);
$escapedCheckinTime = $dbConnection->real_escape_string($checkin_time);
$escapedCheckoutDate = $dbConnection->real_escape_string($checkout_date);
$escapedCheckoutTime = $dbConnection->real_escape_string($checkout_time);
$escapedNotes = $dbConnection->real_escape_string($notes);
$escapedUserId = $dbConnection->real_escape_string($userId);

// IMPORTANT: Use prepared statements here in your Database::iud method!
$insertQuery = "INSERT INTO `booking` (
                    `num_of_guest`, `check_in`, `check_in_time`, `check_out`, `check_out_time`,
                    `msg`, `status`, `packages_id`, `users_id`
                ) VALUES (
                    '{$escapedGuests}', '{$escapedCheckinDate}', '{$escapedCheckinTime}',
                    '{$escapedCheckoutDate}', '{$escapedCheckoutTime}', '{$escapedNotes}',
                    '1', -- Assuming '1' means pending or confirmed
                    '{$escapedPackageId}', '{$escapedUserId}'
                )";

$insertSuccess = Database::iud($insertQuery);

if (!$insertSuccess) {
    $responseMessages['errors'][] = "Failed to save your booking. Please try again. DB Error: " . $dbConnection->error; // Show DB error for debugging
    if (!headers_sent()) header('Content-Type: application/json');
    echo json_encode($responseMessages);
    exit;
}

$bookingDate = date("Y-m-d H:i:s"); // For email
$bookingCode = uniqid('BK'); // Simpler booking code for now

// --- Email Sending ---
function generateEmailBody($fname, $lname, $email, $packageName, $guests, $checkin_date, $checkin_time, $checkout_date, $checkout_time, $bookingCode, $bookingDate, $paymentStatus)
{
    $recipientName = htmlspecialchars($fname . " " . $lname, ENT_QUOTES, 'UTF-8');
    $packageNameVal = htmlspecialchars($packageName, ENT_QUOTES, 'UTF-8');
    $guestsVal = htmlspecialchars($guests, ENT_QUOTES, 'UTF-8');
    $checkinDateVal = htmlspecialchars($checkin_date, ENT_QUOTES, 'UTF-8');
    $checkinTimeVal = htmlspecialchars(date("g:i A", strtotime($checkin_time)), ENT_QUOTES, 'UTF-8'); // Format time nicely
    $checkoutDateVal = htmlspecialchars($checkout_date, ENT_QUOTES, 'UTF-8');
    $checkoutTimeVal = htmlspecialchars(date("g:i A", strtotime($checkout_time)), ENT_QUOTES, 'UTF-8'); // Format time nicely
    $bookingCodeVal = htmlspecialchars($bookingCode, ENT_QUOTES, 'UTF-8');
    $bookingDateVal = htmlspecialchars(date("Y-m-d g:i A", strtotime($bookingDate)), ENT_QUOTES, 'UTF-8');
    $paymentStatusVal = htmlspecialchars($paymentStatus, ENT_QUOTES, 'UTF-8');
    $emailVal = htmlspecialchars($email, ENT_QUOTES, 'UTF-8');
    $year = date("Y");
    $bookingManagementLink = "#"; // Placeholder

    return <<<HTML
    <div style="font-family: Arial, sans-serif; background-color: #06202b; padding: 20px; margin: 0;">
        <div style="width: 100%; max-width: 600px; margin: 0 auto; background-color: #0a2a3a; border-radius: 10px; overflow: hidden; box-shadow: 0 0 15px rgba(0, 0, 0, 0.5);">
            <div style="background-color: #0f3b50; padding: 20px 30px; text-align: center;">
                <h1 style="font-size: 26px; color: #ffffff; margin: 0;">Booking Confirmation</h1>
            </div>
            <div style="padding: 20px 30px; background-color: #0a2a3a; color: #f5eedd;">
                <p style="font-size: 18px; color: #ffffff; margin-top: 0; margin-bottom: 20px;">Hi {$recipientName},</p>
                <p style="font-size: 16px; line-height: 1.6; margin-bottom: 20px;">Thank you for your booking! Details:</p>
                <div style="margin-bottom: 25px; padding: 15px; background-color: #0f3b50; border-radius: 8px;">
                    <h2 style="font-size: 20px; color: #7ae2cf; margin-top: 0; margin-bottom: 15px; border-bottom: 1px solid #06202b; padding-bottom: 10px;">Your Booking Details:</h2>
                    <p style="font-size: 16px; margin: 8px 0;"><strong>Booking Code:</strong> {$bookingCodeVal}</p>
                    <p style="font-size: 16px; margin: 8px 0;"><strong>Package Name:</strong> {$packageNameVal}</p>
                    <p style="font-size: 16px; margin: 8px 0;"><strong>Booking Date:</strong> {$bookingDateVal}</p>
                    <p style="font-size: 16px; margin: 8px 0;"><strong>Check-in:</strong> {$checkinDateVal} at {$checkinTimeVal}</p>
                    <p style="font-size: 16px; margin: 8px 0;"><strong>Check-out:</strong> {$checkoutDateVal} at {$checkoutTimeVal}</p>
                    <p style="font-size: 16px; margin: 8px 0;"><strong>Number of Guests:</strong> {$guestsVal}</p>
                    <p style="font-size: 16px; margin: 8px 0;"><strong>Email:</strong> {$emailVal}</p>
                    <p style="font-size: 16px; margin: 8px 0;"><strong>Payment Status:</strong> <strong style="color: #7ae2cf;">{$paymentStatusVal}</strong></p>
                </div>
                <p style="font-size: 16px; line-height: 1.6; margin-bottom: 25px;">If you have any questions, contact us. </p>
                <p style="text-align: center; margin: 30px 0;">
                    <a href="{$bookingManagementLink}" style="background-color: #077a7d; color: #ffffff; padding: 14px 28px; text-decoration: none; border-radius: 5px; display: inline-block; font-size: 16px; font-weight: bold;">View Booking</a>
                </p>
                <p style="font-size: 16px; line-height: 1.6;">We look forward to welcoming you!<br><br>Sincerely,<br><strong style="color: #ffffff;">The Walawa Cabana Team</strong></p>
            </div>
            <div style="background-color: #0f3b50; padding: 15px 30px; text-align: center;">
                <p style="font-size: 12px; color: #a0aec0; margin: 0;">&copy; {$year} Walawa Cabana Lake Resort. All rights reserved.</p>
                <p style="font-size: 12px; color: #a0aec0; margin: 5px 0 0 0;">Cipherlix (Pvt) Ltd</p>
            </div>
        </div>
    </div>
HTML;
}

$paymentStatus = "Pending"; // Or get from actual payment process
$mail = new PHPMailer(true);
try {
    $mail->SMTPDebug = SMTP::DEBUG_OFF; // Keep OFF for production
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'walawacabanalakeresort.info@gmail.com'; // Your Gmail or App Password
    $mail->Password = 'xuca uhfq wira ftnm';                   // Your Gmail App Password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    $mail->setFrom('walawacabanalakeresort.info@gmail.com', 'Walawa Cabana Team');
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject = 'Your Booking Confirmation - Walawa Cabana Lake Resort - ID: ' . $bookingCode;
    $mail->Body = generateEmailBody($fname, $lname, $email, $packageName, $guests, $checkin_date, $checkin_time, $checkout_date, $checkout_time, $bookingCode, $bookingDate, $paymentStatus);
    $mail->AltBody = "Your booking is confirmed. Details: Booking Code: {$bookingCode}, Package: {$packageName}, Check-in: {$checkin_date} at {$checkin_time}, Check-out: {$checkout_date} at {$checkout_time}.";

    $mail->send();
    $responseMessages['success'] = "Booking successful! A confirmation email has been sent.";
} catch (Exception $e) {
    // Even if email fails, booking is made. You might want different handling.
    $responseMessages['success'] = "Booking successful, but confirmation email failed: {$mail->ErrorInfo}. Please check your booking details with us if you don't receive it.";
    error_log("PHPMailer Error for booking {$bookingCode}: " . $mail->ErrorInfo);
}

if (!headers_sent()) header('Content-Type: application/json');
echo json_encode($responseMessages);
exit;
