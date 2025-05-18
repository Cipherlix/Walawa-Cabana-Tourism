<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Walawa Cabana Lake Resort - Guest Sign In</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.4.0/p5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="icon" href="./assets/images/walawa-official-logo.png">
    <style>
        body {
            background-color: var(--bg-color);
            color: var(--text-color);
            overflow: hidden;
            /* Keep background animation contained */
        }

        @media (max-height: 800px) {
            body {
                overflow-y: auto;
            }

            .min-h-screen {
                min-height: auto;
                padding-top: 2rem;
                padding-bottom: 2rem;
            }
        }

        .animate-in {
            animation: fadeIn 0.8s ease-out forwards;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .custom-input {
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
            background-color: var(--subtle-bg-color);
            color: var(--text-color);
            appearance: none;
            font-size: 16px;
        }

        .custom-input::placeholder {
            color: var(--text-muted-color);
            opacity: 0.7;
        }

        .custom-input:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 3px rgba(122, 226, 207, 0.2);
            outline: none;
        }

        .btn-primary {
            background-color: var(--button-color);
            color: var(--heading-color);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: var(--accent-color);
            color: var(--bg-color);
            transform: translateY(-2px);
        }

        #canvas-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .form-container {
            backdrop-filter: blur(5px);
            -webkit-backdrop-filter: blur(5px);
            animation-delay: 0.3s;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .bg-error {
            background-color: rgba(248, 113, 113, 0.2);
            color: #f87171;
        }

        .bg-success {
            background-color: rgba(74, 222, 128, 0.2);
            color: #4ade80;
        }

        #form-feedback {
            padding: 0.75rem;
            border-radius: 0.5rem;
            margin-bottom: 1.25rem;
            text-align: center;
            animation: fadeIn 0.5s ease-out forwards;
            opacity: 0;
        }

        /* Styling for checkbox */
        .form-checkbox {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            width: 1.25em;
            /* 20px */
            height: 1.25em;
            /* 20px */
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 0.25rem;
            /* rounded-md */
            background-color: var(--subtle-bg-color);
            display: inline-block;
            vertical-align: middle;
            position: relative;
            cursor: pointer;
            margin-right: 0.5em;
            /* space between checkbox and label */
        }

        .form-checkbox:checked {
            background-color: var(--accent-color);
            border-color: var(--accent-color);
        }

        .form-checkbox:checked::after {
            /* Checkmark */
            content: '';
            position: absolute;
            left: 0.375em;
            /* Adjust for centering */
            top: 0.125em;
            /* Adjust for centering */
            width: 0.375em;
            /* Size of checkmark */
            height: 0.75em;
            /* Size of checkmark */
            border: solid var(--bg-color);
            /* Color of the checkmark */
            border-width: 0 2px 2px 0;
            transform: rotate(45deg);
        }

        .link-style {
            color: var(--text-muted-color);
            text-decoration: none;
        }

        .link-style:hover {
            color: var(--accent-color);
            text-decoration: underline;
        }
    </style>
</head>

<body class="min-h-screen flex items-center justify-center px-4 py-8">
    <div id="canvas-container"></div>

    <div class="form-container animate-in bg-opacity-20 rounded-2xl shadow-xl p-8 w-full max-w-lg">
        <div class="text-center mb-8">
            <h1 class="text-4xl font-semibold text-center mb-2 tagesschrift">Walawa Cabana</h1>
            <p class="text-lg tinos" style="color: var(--text-muted-color);">Sign In to Your Account</p>
            <div class="h-1 w-16 mx-auto mt-1" style="background-color: var(--accent-color);"></div>
            <p class="mt-3 text-sm tinos">Don't have an account? <a href="sign-up.php" class="text-accent-color hover:underline">Create an Account</a></p>
            <p class="mt-3 text-sm italic tagesschrift" style="color: var(--text-muted-color);">Welcome back to your lakeside escape 🛶</p>
        </div>

        <div id="form-feedback" class="hidden"></div>

        <form id="signin-form" class="space-y-5">

            <div class="animate-in" style="animation-delay: 0.4s">
                <label for="email" class="block text-sm font-medium mb-1 tinos">Email Address</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    required
                    class="custom-input w-full px-4 py-3 rounded-lg focus:outline-none tinos"
                    placeholder="your.email@example.com">
            </div>

            <div class="animate-in" style="animation-delay: 0.5s">
                <label for="password" class="block text-sm font-medium mb-1 tinos">Password</label>
                <div class="relative">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        required
                        class="custom-input w-full px-4 py-3 rounded-lg focus:outline-none pr-10 tinos"
                        placeholder="••••••••">
                    <button
                        type="button"
                        id="toggle-password"
                        class="absolute inset-y-0 right-0 flex items-center pr-3 text-gray-400 hover:text-gray-200 focus:outline-none "
                        style="color: var(--text-muted-color);"
                        aria-label="Toggle password visibility">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 icon-eye" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 icon-eye-slash hidden" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3.707 2.293a1 1 0 00-1.414 1.414l14 14a1 1 0 001.414-1.414l-1.473-1.473A10.014 10.014 0 0019.542 10C18.268 5.943 14.478 3 10 3a9.958 9.958 0 00-4.512 1.074l-1.78-1.781zm4.261 4.26l1.514 1.515a2.003 2.003 0 012.45 2.45l1.514 1.514a4 4 0 00-5.478-5.478z" clip-rule="evenodd" />
                            <path d="M12.454 16.697L9.75 13.992a4 4 0 01-3.742-3.741L2.335 6.578A9.98 9.98 0 00.458 10c1.274 4.057 5.065 7 9.542 7 .847 0 1.669-.105 2.454-.303z" />
                        </svg>
                    </button>
                </div>
            </div>

            <div class="flex items-center justify-between animate-in" style="animation-delay: 0.55s">
                <div class="flex items-center">
                    <input id="remember-me" name="remember-me" type="checkbox" class="form-checkbox">
                    <label for="remember-me" class="ml-2 block text-sm tinos" style="color: var(--text-muted-color);">Remember me</label>
                </div>
                <div class="text-sm">
                    <a href="forgot-password.php" class="font-medium tinos link-style">Forgot your password?</a>
                </div>
            </div>

            <div class="pt-2 animate-in" style="animation-delay: 0.6s">
                <button
                    type="submit"
                    class="btn-primary w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium focus:outline-none tinos">
                    <span id="button-text">Sign In</span>
                    <span id="button-spinner" class="hidden">
                        <svg class="animate-spin ml-2 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                    </span>
                </button>
            </div>
        </form>

        <div class="mt-6 text-center text-sm animate-in" style="animation-delay: 0.8s">
            <a href="index.php" class="flex items-center justify-center transition-colors hover:text-white tagesschrift" style="color: var(--text-muted-color);">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Resort Home
            </a>
        </div>

        <div class="mt-6 text-center text-xs animate-in tagesschrift" style="animation-delay: 0.9s; color: var(--text-muted-color);">
            <p>We're glad to see you again!</p>
            <div class="text-sm mt-4">
                <a href="admin-sign-in.php" class="font-medium tinos link-style text-center ">Are You Admin User?</a>
            </div>
        </div>

    </div>

    <script>
        // P5.js Water Animation (Global Scope)
        let particles = [];
        const PARTICLE_COUNT = 80;
        let ripples = [];

        function setup() {
            const canvas = createCanvas(windowWidth, windowHeight);
            canvas.parent('canvas-container');
            for (let i = 0; i < PARTICLE_COUNT; i++) {
                particles.push(new Particle());
            }
            noStroke();
        }

        function draw() {
            // Use CSS variables for P5 background if available, otherwise fallback
            const rootStyles = getComputedStyle(document.documentElement);
            const bgColorP5 = color(rootStyles.getPropertyValue('--bg-color').trim() || '#06202B');
            const subtleBgColorP5 = color(rootStyles.getPropertyValue('--subtle-bg-color').trim() || '#0f3b50');

            for (let y = 0; y < height; y++) {
                const inter = map(y, 0, height, 0, 1);
                const c = lerpColor(bgColorP5, subtleBgColorP5, inter);
                stroke(c);
                line(0, y, width, y);
            }
            noStroke();
            for (let i = 0; i < particles.length; i++) {
                particles[i].update();
                particles[i].display();
                for (let j = i + 1; j < particles.length; j++) {
                    const d = dist(particles[i].position.x, particles[i].position.y, particles[j].position.x, particles[j].position.y);
                    if (d < 120) {
                        const alpha = map(d, 0, 120, 100, 0);
                        stroke(122, 226, 207, alpha);
                        strokeWeight(0.5);
                        line(particles[i].position.x, particles[i].position.y, particles[j].position.x, particles[j].position.y);
                        noStroke();
                    }
                }
            }
            for (let i = ripples.length - 1; i >= 0; i--) {
                ripples[i].display();
                if (ripples[i].update()) {
                    ripples.splice(i, 1);
                }
            }
            if ((frameCount % 180 === 0 || random() < 0.005) && document.visibilityState === 'visible') {
                triggerRippleEffect();
            }
        }

        function triggerRippleEffect(x = random(width), y = random(height)) {
            for (let i = 0; i < 3; i++) {
                setTimeout(() => {
                    const ripple = new Ripple(x, y);
                    ripples.push(ripple);
                }, i * 200);
            }
        }
        class Particle {
            constructor() {
                this.position = createVector(random(width), random(height));
                this.velocity = createVector(random(-0.2, 0.2), random(-0.2, 0.2));
                this.acceleration = createVector(0, 0);
                this.size = random(2, 4);
                this.color = color(122, 226, 207);
                this.alpha = random(50, 150);
                this.maxSpeed = 0.8;
            }
            update() {
                let noise1 = noise(this.position.x * 0.01, this.position.y * 0.01, frameCount * 0.002);
                let noise2 = noise(this.position.x * 0.01, this.position.y * 0.01, frameCount * 0.002 + 1000);
                this.acceleration.x = map(noise1, 0, 1, -0.05, 0.05);
                this.acceleration.y = map(noise2, 0, 1, -0.05, 0.05);
                this.velocity.add(this.acceleration);
                this.velocity.limit(this.maxSpeed);
                this.position.add(this.velocity);
                if (this.position.x < 0) this.position.x = width;
                if (this.position.x > width) this.position.x = 0;
                if (this.position.y < 0) this.position.y = height;
                if (this.position.y > height) this.position.y = 0;
                this.alpha = map(noise(frameCount * 0.01 + this.position.x), 0, 1, 50, 150);
            }
            display() {
                this.color.setAlpha(this.alpha);
                fill(this.color);
                ellipse(this.position.x, this.position.y, this.size, this.size);
                this.color.setAlpha(this.alpha * 0.3);
                fill(this.color);
                ellipse(this.position.x, this.position.y, this.size * 2, this.size * 2);
            }
        }
        class Ripple {
            constructor(x, y) {
                this.position = createVector(x, y);
                this.radius = 5;
                this.maxRadius = random(80, 150);
                this.opacity = 150;
                this.speed = random(0.8, 1.5);
                this.color = color(122, 226, 207);
            }
            update() {
                this.radius += this.speed;
                this.opacity = map(this.radius, 5, this.maxRadius, 150, 0);
                return this.opacity <= 0;
            }
            display() {
                noFill();
                this.color.setAlpha(this.opacity);
                stroke(this.color);
                strokeWeight(1);
                ellipse(this.position.x, this.position.y, this.radius * 2);
            }
        }

        function windowResized() {
            resizeCanvas(windowWidth, windowHeight);
        }
        // End of P5.js Code

        // Form Interaction Logic
        document.addEventListener('DOMContentLoaded', function() {
            const signinForm = document.getElementById('signin-form');
            const formFeedback = document.getElementById('form-feedback');
            const buttonText = document.getElementById('button-text');
            const buttonSpinner = document.getElementById('button-spinner');
            const formContainer = document.querySelector('.form-container');
            const rememberMeCheckbox = document.getElementById('remember-me'); // Get checkbox

            function setupPasswordToggle(toggleButtonId, passwordFieldId) {
                const toggleButton = document.getElementById(toggleButtonId);
                const passwordField = document.getElementById(passwordFieldId);
                const eyeIcon = toggleButton.querySelector('.icon-eye');
                const eyeSlashIcon = toggleButton.querySelector('.icon-eye-slash');
                if (!toggleButton || !passwordField || !eyeIcon || !eyeSlashIcon) return;
                toggleButton.addEventListener('click', function() {
                    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordField.setAttribute('type', type);
                    eyeIcon.classList.toggle('hidden', type === 'text');
                    eyeSlashIcon.classList.toggle('hidden', type === 'password');
                });
            }
            setupPasswordToggle('toggle-password', 'password');

            function showFeedback(message, type, permanent = false) {
                formFeedback.textContent = message;
                formFeedback.className = 'text-center py-2 rounded text-sm';
                formFeedback.classList.add('animate-in');
                if (type === 'error') {
                    formFeedback.classList.add('bg-error');
                } else {
                    formFeedback.classList.add('bg-success');
                }
                formFeedback.classList.remove('hidden');
                if (type === 'error') {
                    buttonText.classList.remove('hidden');
                    buttonSpinner.classList.add('hidden');
                }
                if (!permanent) {
                    setTimeout(() => {
                        formFeedback.classList.add('hidden');
                    }, 5000);
                }
            }

            function validateEmail(email) {
                const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(String(email).toLowerCase());
            }

            if (formContainer && typeof triggerRippleEffect === 'function') {
                formContainer.addEventListener('click', function(e) {
                    if (e.target === formContainer) {
                        triggerRippleEffect(e.clientX, e.clientY);
                    }
                });
            }

            if (signinForm) {
                signinForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    const emailInput = document.getElementById('email');
                    const passwordInput = document.getElementById('password');
                    const email = emailInput.value.trim();
                    const password = passwordInput.value; // No trim on password for submission

                    if (!email || !validateEmail(email)) {
                        showFeedback('Please enter a valid email address.', 'error');
                        emailInput.focus();
                        return;
                    }
                    if (!password) {
                        showFeedback('Please enter your password.', 'error');
                        passwordInput.focus();
                        return;
                    }

                    buttonText.classList.add('hidden');
                    buttonSpinner.classList.remove('hidden');
                    formFeedback.classList.add('hidden');

                    const formData = new FormData();
                    formData.append('email', email);
                    formData.append('password', password);
                    if (rememberMeCheckbox.checked) { // Add remember me status
                        formData.append('remember-me', 'on');
                    }

                    const request = new XMLHttpRequest();
                    request.open('POST', 'processes/sign-in-process.php', true);

                    request.onreadystatechange = function() {
                        if (request.readyState === XMLHttpRequest.DONE) {
                            buttonText.classList.remove('hidden');
                            buttonSpinner.classList.add('hidden');
                            if (request.status === 200) {
                                try {
                                    const response = JSON.parse(request.responseText);
                                    if (response.status === 'success') {
                                        showFeedback(response.message, 'success', true);
                                        // Use redirect URL from response if provided, otherwise default to index.php
                                        const redirectUrl = response.redirect || 'index.php';
                                        setTimeout(() => {
                                            window.location.href = redirectUrl;
                                        }, 1500);
                                    } else {
                                        showFeedback(response.message || 'An unknown error occurred.', 'error');
                                    }
                                } catch (err) {
                                    showFeedback('Error processing server response. Please try again.', 'error');
                                    console.error("JSON Parse Error:", err, "\nResponse Text:", request.responseText);
                                }
                            } else {
                                showFeedback('Server error: ' + request.status + '. Please try again later.', 'error');
                            }
                        }
                    };
                    request.send(formData);
                });
            }

            // Helper function to get cookie
            function getCookie(name) {
                const nameEQ = name + "=";
                const ca = document.cookie.split(';');
                for (let i = 0; i < ca.length; i++) {
                    let c = ca[i];
                    while (c.charAt(0) === ' ') c = c.substring(1, c.length);
                    if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
                }
                return null;
            }

            // Check for "Remember Me" cookie on page load
            const rememberedEmail = getCookie("remember_user_email"); // Changed cookie name for clarity
            if (rememberedEmail) {
                document.getElementById("email").value = rememberedEmail;
                rememberMeCheckbox.checked = true;
            }
        });
    </script>
</body>

</html>