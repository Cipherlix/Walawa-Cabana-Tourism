<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$isLoggedIn = isset($_SESSION['user_id'], $_SESSION['user_fname'], $_SESSION['user_lname'], $_SESSION['user_email']) &&
    !empty($_SESSION['user_id']) &&
    !empty($_SESSION['user_fname']) &&
    !empty($_SESSION['user_lname']) &&
    !empty($_SESSION['user_email']);

require_once './connction.php';
Database::getDatabaseConnection(); // Initialize connection
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Your Stay</title>
    <style>
        .spinner {
            border: 4px solid rgba(0, 0, 0, 0.1);
            width: 24px;
            height: 24px;
            border-radius: 50%;
            border-left-color: #7ae2cf;
            animation: spin 1s ease infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

        /* Tailwind-like feedback message styles */
        .feedback-base {
            padding: 0.75rem;
            border-radius: 0.375rem;
            margin-bottom: 1rem;
        }

        .feedback-success {
            color: #2F855A;
            background-color: #C6F6D5;
            border: 1px solid #9AE6B4;
        }

        /* text-green-700 bg-green-100 border-green-400 */
        .feedback-error {
            color: #C53030;
            background-color:rgb(255, 113, 113);
            border: 1px solid #FEB2B2;
        }

        /* text-red-700 bg-red-100 border-red-400 */
        .feedback-info {
            color: #2B6CB0;
            background-color: #BEE3F8;
            border: 1px solid #90CDF4;
        }
        /* text-blue-700 bg-blue-100 border-blue-400 */
    </style>
</head>

<body class="bg-bg-color">
    <section id="booking" class="py-20 section-card-bg">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold mb-12 text-center text-heading-color tagesschrift">Book Your Lakeside Escape</h2>
            <div class="max-w-3xl mx-auto bg-bg-color rounded-lg shadow-xl p-8 md:p-12 border border-gray-700">
                <div id="feedback" class="feedback-base hidden"></div>

                <form id="bookingForm" class="space-y-6" method="post" onsubmit="handleBooking(event)">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="fname" class="block text-text-color mb-2 font-medium tinos">First Name</label>
                            <input type="text" id="fname" name="fname" class="form-input tinos" required placeholder="John" value="<?php echo isset($_SESSION['user_fname']) ? htmlspecialchars($_SESSION['user_fname']) : ''; ?>">
                            <p class="error-message hidden tinos mt-1" id="fnameError"></p>
                        </div>
                        <div>
                            <label for="lname" class="block text-text-color mb-2 font-medium tinos">Last Name</label>
                            <input type="text" id="lname" name="lname" class="form-input tinos" required placeholder="Doe" value="<?php echo isset($_SESSION['user_lname']) ? htmlspecialchars($_SESSION['user_lname']) : ''; ?>">
                            <p class="error-message hidden tinos mt-1" id="lnameError"></p>
                        </div>
                    </div>
                    <div>
                        <label for="email" class="block text-text-color mb-2 font-medium tinos">Email Address</label>
                        <input type="email" id="email" name="email" class="form-input tinos" required placeholder="john@example.com" value="<?php echo isset($_SESSION['user_email']) ? htmlspecialchars($_SESSION['user_email']) : ''; ?>">
                        <p class="error-message hidden tinos mt-1" id="emailError"></p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="package" class="block text-text-color mb-2 font-medium tinos">Select Package</label>
                            <select id="package" name="package" class="form-input tinos" required>
                                <option value="" disabled selected>Choose package...</option>
                                <?php
                                $packageQuery = "SELECT id, name FROM packages ORDER BY name ASC";
                                $packageResult = Database::search($packageQuery);
                                if ($packageResult && $packageResult->num_rows > 0) {
                                    while ($packageRow = $packageResult->fetch_assoc()) {
                                        echo '<option value="' . htmlspecialchars($packageRow['id']) . '">' . htmlspecialchars($packageRow['name']) . '</option>';
                                    }
                                } else {
                                    echo '<option value="" disabled>No packages available</option>';
                                }
                                ?>
                            </select>
                            <p class="error-message hidden tinos mt-1" id="packageError"></p>
                        </div>
                        <div>
                            <label for="guests" class="block text-text-color mb-2 font-medium tinos">Number of Guests</label>
                            <input type="number" id="guests" name="guests" min="1" max="10" class="form-input tinos" required placeholder="e.g., 2">
                            <p class="error-message hidden tinos mt-1" id="guestsError"></p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="checkin_date" class="block text-text-color mb-2 font-medium tinos">Check-in Date</label>
                            <input type="date" id="checkin_date" name="checkin_date" class="form-input tinos" required style="color-scheme: dark;">
                            <p class="error-message hidden tinos mt-1" id="checkinDateError"></p>
                        </div>
                        <div>
                            <label for="checkin_time" class="block text-text-color mb-2 font-medium tinos">Check-in Time</label>
                            <input type="time" id="checkin_time" name="checkin_time" class="form-input tinos" required style="color-scheme: dark;">
                            <p class="error-message hidden tinos mt-1" id="checkinTimeError"></p>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="checkout_date" class="block text-text-color mb-2 font-medium tinos">Check-out Date</label>
                            <input type="date" id="checkout_date" name="checkout_date" class="form-input tinos" required style="color-scheme: dark;">
                            <p class="error-message hidden tinos mt-1" id="checkoutDateError"></p>
                        </div>
                        <div>
                            <label for="checkout_time" class="block text-text-color mb-2 font-medium tinos">Check-out Time</label>
                            <input type="time" id="checkout_time" name="checkout_time" class="form-input tinos" required style="color-scheme: dark;">
                            <p class="error-message hidden tinos mt-1" id="checkoutTimeError"></p>
                        </div>
                    </div>
                    <p class="error-message hidden tinos mt-1" id="dateTimeOrderError"></p>
                    <div>
                        <label for="notes" class="block text-text-color mb-2 font-medium tinos">Special Requests (Optional)</label>
                        <textarea id="notes" name="notes" rows="4" class="form-input tinos" placeholder="e.g., dietary restrictions, late arrival"></textarea>
                    </div>
                    <div class="text-center pt-4">
                        <button type="submit" id="submitBookingBtn" class="cta-button px-10 py-4 text-lg font-medium tagesschrift flex items-center justify-center w-full md:w-auto mx-auto">
                            <span class="button-text">Check Availability & Book</span>
                            <span class="spinner hidden ml-2"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <script>
        function handleBooking(event) {
            event.preventDefault();

            const form = event.target;
            const formData = new FormData(form);
            const submitButton = document.getElementById('submitBookingBtn');
            const buttonText = submitButton.querySelector('.button-text');
            const spinner = submitButton.querySelector('.spinner');
            const feedbackDiv = document.getElementById('feedback');

            feedbackDiv.textContent = '';
            feedbackDiv.className = 'feedback-base hidden';

            form.querySelectorAll('.error-message').forEach(el => el.classList.add('hidden'));
            form.querySelectorAll('.form-input, select').forEach(el => el.classList.remove('border-red-500', 'border-2'));

            let isValid = true;

            function toggleError(fieldId, showError, messageId, message = "This field is required.") {
                const errorElement = document.getElementById(messageId);
                const fieldElement = document.getElementById(fieldId); // May not always be the same as messageId if messageId is for general errors
                if (errorElement) { // Check if errorElement exists
                    errorElement.textContent = message;
                    showError ? errorElement.classList.remove('hidden') : errorElement.classList.add('hidden');
                }
                if (fieldElement) {
                    showError ? fieldElement.classList.add('border-red-500', 'border-2') : fieldElement.classList.remove('border-red-500', 'border-2');
                }
                if (showError) isValid = false;
            }

            const fname = formData.get('fname').trim();
            if (!fname) toggleError('fname', true, 'fnameError', 'Please enter your first name.');
            else toggleError('fname', false, 'fnameError');

            const lname = formData.get('lname').trim();
            if (!lname) toggleError('lname', true, 'lnameError', 'Please enter your last name.');
            else toggleError('lname', false, 'lnameError');

            const emailVal = formData.get('email').trim(); // Renamed to avoid conflict with 'email' id
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailVal) toggleError('email', true, 'emailError', 'Please enter your email address.');
            else if (!emailPattern.test(emailVal)) toggleError('email', true, 'emailError', 'Please enter a valid email address.');
            else toggleError('email', false, 'emailError');

            const packageValue = formData.get('package');
            if (!packageValue) toggleError('package', true, 'packageError', 'Please select a package.');
            else toggleError('package', false, 'packageError');

            const guests = formData.get('guests');
            const guestsNum = parseInt(guests, 10);
            const guestsField = document.getElementById('guests');
            const minGuests = parseInt(guestsField.min) || 1;
            const maxGuests = parseInt(guestsField.max) || 10;
            if (!guests) toggleError('guests', true, 'guestsError', 'Please enter the number of guests.');
            else if (isNaN(guestsNum) || guestsNum < minGuests || guestsNum > maxGuests) toggleError('guests', true, 'guestsError', `Guests must be between ${minGuests} and ${maxGuests}.`);
            else toggleError('guests', false, 'guestsError');

            const checkinDateStr = formData.get('checkin_date');
            if (!checkinDateStr) toggleError('checkin_date', true, 'checkinDateError', 'Please select a check-in date.');
            else toggleError('checkin_date', false, 'checkinDateError');

            const checkinTimeStr = formData.get('checkin_time');
            if (!checkinTimeStr) toggleError('checkin_time', true, 'checkinTimeError', 'Please select a check-in time.');
            else toggleError('checkin_time', false, 'checkinTimeError');

            const checkoutDateStr = formData.get('checkout_date');
            if (!checkoutDateStr) toggleError('checkout_date', true, 'checkoutDateError', 'Please select a check-out date.');
            else toggleError('checkout_date', false, 'checkoutDateError');

            const checkoutTimeStr = formData.get('checkout_time');
            if (!checkoutTimeStr) toggleError('checkout_time', true, 'checkoutTimeError', 'Please select a check-out time.');
            else toggleError('checkout_time', false, 'checkoutTimeError');

            // Combined DateTime validation
            if (checkinDateStr && checkinTimeStr && checkoutDateStr && checkoutTimeStr) {
                const checkinDateTime = new Date(`${checkinDateStr}T${checkinTimeStr}`);
                const checkoutDateTime = new Date(`${checkoutDateStr}T${checkoutTimeStr}`);

                if (checkoutDateTime <= checkinDateTime) {
                    toggleError(null, true, 'dateTimeOrderError', 'Check-out date and time must be after check-in date and time.');
                    // Optionally highlight both date/time fields involved
                    document.getElementById('checkout_date').classList.add('border-red-500', 'border-2');
                    document.getElementById('checkout_time').classList.add('border-red-500', 'border-2');
                } else {
                    toggleError(null, false, 'dateTimeOrderError');
                }
            }


            if (!isValid) {
                const firstError = form.querySelector('.error-message:not(.hidden)');
                if (firstError) firstError.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                return;
            }

            buttonText.classList.add('hidden');
            spinner.classList.remove('hidden');
            submitButton.disabled = true;
            feedbackDiv.className = 'feedback-base feedback-info';
            feedbackDiv.textContent = 'Processing...';
            feedbackDiv.classList.remove('hidden');

            const request = new XMLHttpRequest();
            request.onreadystatechange = () => {
                if (request.readyState === XMLHttpRequest.DONE) {
                    buttonText.classList.remove('hidden');
                    spinner.classList.add('hidden');
                    submitButton.disabled = false;

                    if (request.status === 200) {
                        try {
                            const responseData = JSON.parse(request.responseText);
                            if (responseData.success) {
                                feedbackDiv.className = 'feedback-base feedback-success';
                                feedbackDiv.textContent = responseData.success;
                                form.reset();
                                form.querySelectorAll('.error-message').forEach(el => el.classList.add('hidden'));
                                form.querySelectorAll('.form-input, select').forEach(el => el.classList.remove('border-red-500', 'border-2'));
                            } else if (responseData.errors && responseData.errors.length > 0) {
                                feedbackDiv.className = 'feedback-base feedback-error';
                                feedbackDiv.innerHTML = 'Booking failed:<ul>' + responseData.errors.map(err => `<li>${err}</li>`).join('') + '</ul>';
                            } else {
                                feedbackDiv.className = 'feedback-base feedback-error';
                                feedbackDiv.textContent = 'Booking failed: An unknown error occurred. ' + request.responseText;
                            }
                        } catch (e) {
                            feedbackDiv.className = 'feedback-base feedback-error';
                            feedbackDiv.textContent = 'Booking failed: Invalid response from server. ' + request.responseText;
                            console.error("Failed to parse JSON:", e, "Response:", request.responseText);
                        }
                    } else {
                        feedbackDiv.className = 'feedback-base feedback-error';
                        feedbackDiv.textContent = 'Error: ' + request.status + ' - ' + request.statusText + '. Raw Response: ' + request.responseText;
                    }
                    feedbackDiv.classList.remove('hidden');
                }
            };

            request.open('POST', "processes/booking-process.php", true);
            request.send(formData);
        }

        // Set min date for date pickers to today
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('checkin_date').setAttribute('min', today);
            document.getElementById('checkout_date').setAttribute('min', today);
        });
    </script>
    <?php
    Database::closeConnection();
    ?>
</body>

</html>