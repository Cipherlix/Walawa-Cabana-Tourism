<?php
// session_start(); // Start the session at the beginning

// Check if user is logged in and set variables for pre-filling
$loggedInUserName = '';
$loggedInUserEmail = '';

if (isset($_SESSION['user_fname']) && isset($_SESSION['user_lname'])) {
    $loggedInUserName = htmlspecialchars($_SESSION['user_fname'] . ' ' . $_SESSION['user_lname']);
}

if (isset($_SESSION['user_email'])) {
    $loggedInUserEmail = htmlspecialchars($_SESSION['user_email']);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title> </head>

<body>
    <section id="contact" class="py-20 section-subtle-bg">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold mb-12 text-center text-heading-color tagesschrift">Connect With Us</h2>
            <div class="flex flex-col md:flex-row gap-8 md:gap-12">
                <div class="md:w-1/2">
                    <h3 class="text-2xl font-semibold mb-6 text-heading-color tagesschrift">Send Us a Message</h3>
                    <form id="contactForm" class="space-y-6" onsubmit="contact(event)" novalidate>
                        <div>
                            <label for="contactName" class="block text-text-color mb-2 font-medium tinos">Your Name</label>
                            <input type="text" id="contactName" name="contactName" class="form-input tinos" required placeholder="Full Name" value="<?php echo $loggedInUserName; ?>">
                            <p class="error-message hidden" id="contactNameError">Please enter your name.</p>
                        </div>
                        <div>
                            <label for="contactEmail" class="block text-text-color mb-2 font-medium tinos">Email Address</label>
                            <input type="email" id="contactEmail" name="contactEmail" class="form-input tinos" required placeholder="your.email@example.com" value="<?php echo $loggedInUserEmail; ?>">
                            <p class="error-message hidden" id="contactEmailError">Please enter a valid email.</p>
                        </div>
                        <div>
                            <label for="contactSubject" class="block text-text-color mb-2 font-medium tinos">Subject</label>
                            <input type="text" id="contactSubject" name="contactSubject" class="form-input tinos" required placeholder="Inquiry Subject">
                            <p class="error-message hidden" id="contactSubjectError">Please enter a subject.</p>
                        </div>
                        <div>
                            <label for="contactMessage" class="block text-text-color mb-2 font-medium tinos">Message</label>
                            <textarea id="contactMessage" name="contactMessage" rows="5" class="form-input tinos" required placeholder="Your message here..."></textarea>
                            <p class="error-message hidden" id="contactMessageError">Please enter your message.</p>
                        </div>
                        <div class="text-left">
                            <button type="submit" class="cta-button px-8 py-3 text-lg font-medium tinos">Send Message</button>
                        </div>
                        <div id="contactFormSuccessMessage" class="text-green-400 font-medium hidden mt-4 tinos"> Message sent! We'll reply soon. </div>
                        <div id="contactFormErrorMessage" class="text-red-400 font-medium hidden mt-4"> Error sending message. Please try again. </div>
                    </form>
                </div>
                <div class="md:w-1/2">
                    <h3 class="text-2xl font-semibold mb-6 text-heading-color tagesschrift">Resort Information</h3>
                    <div class="space-y-4 text-lg mb-8">
                        <p class="tinos"><strong>Address:</strong>  Walawa Cabana Lake Resort, Sewanagala, Sri Lanka</p>
                        <p class="tinos"><strong>Phone:</strong> <a href="tel:+94711135285" class="text-accent-color hover:underline">+94 71 113 5285</a> (English & Sinhala)</p>
                        <p class="tinos"><strong>Email:</strong> <a href="mailto:walawacabanalakeresort.info@gmail.com" class="text-accent-color hover:underline">walawacabanalakeresort.info@gmail.com</a></p>
                    </div>
                    <h4 class="text-xl font-semibold mb-2 text-heading-color tagesschrift">Follow Us</h4>
                    <div class="flex space-x-4 mb-4">
                        <a href="#" aria-label="Facebook" class="text-text-muted-color hover:text-accent-color transition-colors"><img src="assets/icons/facebook.svg" alt="Facebook" class="w-8 h-8"></a>
                        <a href="#" aria-label="Instagram" class="text-text-muted-color hover:text-accent-color transition-colors"><img src="assets/icons/instagram.svg" alt="Instagram" class="w-8 h-8"></a> </div>
                    <div class="aspect-w-16 aspect-h-9 rounded-lg overflow-hidden shadow-md">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6668.166307038409!2d80.92027370417402!3d6.404899050572681!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae403002215f037%3A0x3913509dd245a92a!2sHabaraluwewa%20nanathotupola!5e0!3m2!1sen!2slk!4v1746432608058!5m2!1sen!2slk" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"
                            title="Resort Location Map">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function contact(e){
            e.preventDefault();
            const data = new FormData(e.target);
            const request = new XMLHttpRequest();

            // Clear previous messages
            document.getElementById('contactFormSuccessMessage').classList.add('hidden');
            document.getElementById('contactFormErrorMessage').classList.add('hidden');

            // Basic client-side validation (optional, as server-side is key)
            let isValid = true;
            if (!data.get('contactName').trim()) {
                document.getElementById('contactNameError').classList.remove('hidden');
                isValid = false;
            } else {
                document.getElementById('contactNameError').classList.add('hidden');
            }
            if (!data.get('contactEmail').trim() || !/^\S+@\S+\.\S+$/.test(data.get('contactEmail').trim())) { // Simple email regex
                document.getElementById('contactEmailError').classList.remove('hidden');
                isValid = false;
            } else {
                document.getElementById('contactEmailError').classList.add('hidden');
            }
            if (!data.get('contactSubject').trim()) {
                document.getElementById('contactSubjectError').classList.remove('hidden');
                isValid = false;
            } else {
                document.getElementById('contactSubjectError').classList.add('hidden');
            }
            if (!data.get('contactMessage').trim()) {
                document.getElementById('contactMessageError').classList.remove('hidden');
                isValid = false;
            } else {
                document.getElementById('contactMessageError').classList.add('hidden');
            }

            if (!isValid) {
                return; // Stop submission if client-side validation fails
            }


            request.onreadystatechange = () => {
                if (request.readyState === XMLHttpRequest.DONE) {
                    if (request.status === 200) {
                        const response = request.responseText; // Expect 'success' or 'error'
                        if (response.trim() === 'success') {
                            document.getElementById('contactFormSuccessMessage').classList.remove('hidden');
                            document.getElementById('contactFormErrorMessage').classList.add('hidden');
                            document.getElementById('contactForm').reset();
                            // If user was logged in, repopulate fields with session data after reset
                            <?php if ($loggedInUserName): ?>
                            document.getElementById('contactName').value = "<?php echo addslashes($loggedInUserName); ?>";
                            <?php endif; ?>
                            <?php if ($loggedInUserEmail): ?>
                            document.getElementById('contactEmail').value = "<?php echo addslashes($loggedInUserEmail); ?>";
                            <?php endif; ?>
                        } else {
                            document.getElementById('contactFormErrorMessage').classList.remove('hidden');
                            document.getElementById('contactFormSuccessMessage').classList.add('hidden');
                            // Optionally display the error message from server:
                            // document.getElementById('contactFormErrorMessage').textContent = 'Error: ' + response;
                        }
                    } else {
                        // Handle network errors or server errors (status code not 200)
                        document.getElementById('contactFormErrorMessage').textContent = 'Error sending message. Server responded with status ' + request.status + '.';
                        document.getElementById('contactFormErrorMessage').classList.remove('hidden');
                        document.getElementById('contactFormSuccessMessage').classList.add('hidden');
                    }
                }
            }

            request.open("POST", "processes/contact-process.php", true);
            request.send(data);
        }
    </script>
</body>

</html>