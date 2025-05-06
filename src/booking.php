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
                <form id="bookingForm" class="space-y-6" novalidate>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="fname" class="block text-text-color mb-2 font-medium tinos">First Name</label>
                            <input type="text" id="name" name="fname" class="form-input tinos" required placeholder="John Doe">
                            <p class="error-message hidden tinos" id="nameError">Please enter your first name.</p>
                        </div>
                        <div>
                            <label for="lname" class="block text-text-color mb-2 font-medium tinos">Last Name</label>
                            <input type="text" id="name" name="lname" class="form-input tinos" required placeholder="John Doe">
                            <p class="error-message hidden tinos" id="nameError">Please enter your last name.</p>
                        </div>
                    </div>
                    <div>
                        <label for="email" class="block text-text-color mb-2 font-medium tinos">Email Address</label>
                        <input type="email" id="email" name="email" class="form-input tinos" required placeholder="john@example.com">
                        <p class="error-message hidden" id="emailError tinos">Please enter a valid email address.</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="package" class="block text-text-color mb-2 font-medium tinos">Select Package</label>
                            <select id="package" name="package" class="form-input tinos" required>
                                <option value="" disabled selected>Choose package...</option>
                                <?php
                                // --- PHP to Populate Package Dropdown ---

                                // Define query to get package ID and Name
                                // Order alphabetically for user convenience
                                $packageQuery = "SELECT id, name FROM packages ORDER BY name ASC"; // <-- ADJUST table/column names if needed

                                // Execute query (using iud based on your packages.php example)
                                // Consider using Database::search() if you added it for clarity
                                $packageResult = Database::iud($packageQuery);

                                // Check if query was successful and returned results
                                if ($packageResult && $packageResult->num_rows > 0) {
                                    while ($packageRow = $packageResult->fetch_assoc()) {
                                        // Output an <option> for each package
                                        // Use htmlspecialchars for security
                                        echo '<option value="' . htmlspecialchars($packageRow['id']) . '">'
                                            . htmlspecialchars($packageRow['package_name'])
                                            . '</option>';
                                    }
                                } else {
                                    // Optional: Add a disabled option if no packages found
                                    echo '<option value="" disabled>No packages available</option>';
                                    // Log potential errors
                                    if ($packageResult === false) {
                                        error_log("Failed to retrieve packages for booking form.");
                                    } elseif ($packageResult->num_rows === 0) {
                                        error_log("No packages found in the database for booking form.");
                                    }
                                }
                                // --- End of PHP Dropdown Population ---
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
                            <p class="error-message hidden" id="checkinError tinos">Please select a check-in date.</p>
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
</body>

</html>