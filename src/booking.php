<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Corrected $isLoggedIn logic
$isLoggedIn = isset($_SESSION['user_id'], $_SESSION['user_fname'], $_SESSION['user_lname'], $_SESSION['user_email']) &&
    !empty($_SESSION['user_id']) &&
    !empty($_SESSION['user_fname']) &&
    !empty($_SESSION['user_lname']) &&
    !empty($_SESSION['user_email']);

// Include connection for package dropdown (assuming connction.php is in the same directory as booking.php)
// If booking.php is in root and connction.php is in root.
// If your structure differs, adjust the path.
require_once './connction.php'; // Use require_once for critical files like DB connection
Database::getDatabaseConnection();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <section id="booking" class="py-20 section-card-bg">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold mb-12 text-center text-heading-color tagesschrift">Book Your Lakeside Escape</h2>
            <div class="max-w-3xl mx-auto bg-bg-color rounded-lg shadow-xl p-8 md:p-12 border border-gray-700">
                <form id="bookingForm" class="space-y-6" method="post" onsubmit="handleBooking(event)">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="fname" class="block text-text-color mb-2 font-medium tinos">First Name</label>
                            <input type="text" id="fname" name="fname" class="form-input tinos" required placeholder="John" value="<?php echo isset($_SESSION['user_fname']) ? htmlspecialchars($_SESSION['user_fname']) : ''; ?>">
                            <p class="error-message hidden tinos" id="fnameError">Please enter your first name.</p>
                        </div>
                        <div>
                            <label for="lname" class="block text-text-color mb-2 font-medium tinos">Last Name</label>
                            <input type="text" id="lname" name="lname" class="form-input tinos" required placeholder="Doe" value="<?php echo isset($_SESSION['user_lname']) ? htmlspecialchars($_SESSION['user_lname']) : ''; ?>">
                            <p class="error-message hidden tinos" id="lnameError">Please enter your last name.</p>
                        </div>
                    </div>
                    <div>
                        <label for="email" class="block text-text-color mb-2 font-medium tinos">Email Address</label>
                        <input type="email" id="email" name="email" class="form-input tinos" required placeholder="john@example.com" value="<?php echo isset($_SESSION['user_email']) ? htmlspecialchars($_SESSION['user_email']) : ''; ?>">
                        <p class="error-message hidden tinos" id="emailError">Please enter a valid email address.</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="package" class="block text-text-color mb-2 font-medium tinos">Select Package</label>
                            <select id="package" name="package" class="form-input tinos" required>
                                <option value="" disabled selected>Choose package...</option>
                                <?php
                                $packageQuery = "SELECT id, name FROM packages ORDER BY name ASC";
                                $packageResult = Database::search($packageQuery); // Use search as it fetches data

                                if ($packageResult && $packageResult->num_rows > 0) {
                                    while ($packageRow = $packageResult->fetch_assoc()) {
                                        echo '<option value="' . htmlspecialchars($packageRow['id']) . '">'
                                            . htmlspecialchars($packageRow['name'])
                                            . '</option>';
                                    }
                                } else {
                                    echo '<option value="" disabled>No packages available</option>';
                                    if ($packageResult === false) {
                                        error_log("Failed to retrieve packages for booking form: " . Database::getDatabaseConnection()->error);
                                    } elseif ($packageResult && $packageResult->num_rows === 0) {
                                        error_log("No packages found in the database for booking form.");
                                    }
                                }
                                ?>
                            </select>
                            <p class="error-message hidden tinos" id="packageError">Please select a package.</p>
                        </div>
                        <div>
                            <label for="guests" class="block text-text-color mb-2 font-medium tinos">Number of Guests</label>
                            <input type="number" id="guests" name="guests" min="1" max="10" class="form-input tinos" required placeholder="e.g., 2">
                            <p class="error-message hidden tinos" id="guestsError">Please enter the number of guests (1-10).</p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="checkin" class="block text-text-color mb-2 font-medium tinos">Check-in Date</label>
                            <input type="date" id="checkin" name="checkin" class="form-input tinos" required style="color-scheme: dark;">
                            <p class="error-message hidden tinos" id="checkinError">Please select a check-in date.</p>
                        </div>
                        <div>
                            <label for="checkout" class="block text-text-color mb-2 font-medium tinos">Check-out Date</label>
                            <input type="date" id="checkout" name="checkout" class="form-input tinos" required style="color-scheme: dark;">
                            <p class="error-message hidden tinos" id="checkoutError">Please select a check-out date.</p>
                            <p class="error-message hidden tinos" id="dateOrderError">Check-out date must be after check-in date.</p>
                        </div>
                    </div>
                    <div>
                        <label for="notes" class="block text-text-color mb-2 font-medium tinos">Special Requests (Optional)</label>
                        <textarea id="notes" name="notes" rows="4" class="form-input tinos" placeholder="e.g., dietary restrictions, late arrival"></textarea>
                    </div>
                    <div class="text-center pt-4">
                        <button type="submit" class="cta-button px-10 py-4 text-lg font-medium tagesschrift">Check Availability & Book</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>
        // Basic client-side validation (optional, good for UX)
        // Your existing server-side validation in booking-process.php is crucial

        function handleBooking(event) {
            event.preventDefault(); // Prevent default form submission

            const form = event.target;
            const formData = new FormData(form);
            const submitButton = form.querySelector('button[type="submit"]');

            // Basic client-side checks (can be expanded)
            let isValid = true;
            // Example: Check if required fields are filled (you can add more)
            if (!formData.get('fname').trim()) {
                document.getElementById('fnameError').classList.remove('hidden');
                isValid = false;
            } else {
                document.getElementById('fnameError').classList.add('hidden');
            }
            // Add similar checks for other required fields like lname, email, package, guests, checkin, checkout

            if (!isValid) {
                alert('Please fill in all required fields correctly.');
                return;
            }

            // Disable button to prevent multiple submissions
            submitButton.disabled = true;
            submitButton.textContent = 'Processing...';

            const request = new XMLHttpRequest();

            request.onreadystatechange = () => {
                if (request.readyState === XMLHttpRequest.DONE) {
                    submitButton.disabled = false; // Re-enable button
                    submitButton.textContent = 'Check Availability & Book';

                    if (request.status === 200) {
                        const responseText = request.responseText;
                        if (responseText.trim().toLowerCase() === "success") {
                            alert('Booking successful! A confirmation may be sent to your email if implemented.');
                            form.reset(); // Optionally reset the form
                        } else {
                            // Display error message returned from PHP
                            alert('Booking failed: ' + responseText);
                        }
                    } else {
                        // Handle network errors or server errors (e.g., 404, 500)
                        alert('Error communicating with the server. Status: ' + request.status);
                    }
                }
            };

            // Ensure the path to booking-process.php is correct
            // If booking.php is in the root and booking-process.php is in 'processes/' directory:
            request.open('POST', "processes/booking-process.php", true);
            request.send(formData);
        }
    </script>
    <?php
    Database::getDatabaseConnection(); // Close connection after populating dropdown
    ?>
</body>

</html>