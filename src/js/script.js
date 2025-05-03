 // Strict mode helps catch common coding errors
 'use strict';

 // Function to safely initialize libraries and scripts
 function initializeSite() {
     // Check if AOS is loaded before initializing
     if (typeof AOS !== 'undefined') {
         try {
             AOS.init({
                 duration: 800,
                 easing: 'ease-in-out',
                 once: true, // Animation happens only once
                 // disable: 'mobile' // Optional: disable on mobile
             });
         } catch (error) {
             console.error("Error initializing AOS:", error);
         }
     } else {
         console.warn("AOS library not loaded or failed to load.");
     }

     // Check if THREE is loaded
     if (typeof THREE !== 'undefined') {
         initThreeAnimation(); // Initialize Three.js animation
     } else {
         console.warn("Three.js library not loaded or failed to load.");
         const canvasContainer = document.getElementById('canvasContainer');
         if (canvasContainer) canvasContainer.innerHTML = "<p style='color: white; text-align: center;'>Hero animation disabled.</p>";
     }

     // Check if p5 is loaded
     if (typeof p5 !== 'undefined') {
         initP5Animation(); // Initialize p5.js animation
     } else {
         console.warn("p5.js library not loaded or failed to load.");
         const animationContainer = document.getElementById('animation-container');
         if (animationContainer) animationContainer.innerHTML = "<p style='color: white; text-align: center;'>Interactive animation disabled.</p>";
     }

     // Initialize other components
     initMobileMenu();
     initLightbox();
     initFormValidation();
     initDarkMode();
     initNavbarScroll();
     initSmoothScroll();
 }

 // Run initialization when the DOM is fully loaded
 document.addEventListener('DOMContentLoaded', initializeSite);


 // Three.js Animation for Hero Section
 function initThreeAnimation() {
     const canvasContainer = document.getElementById('canvasContainer');
     if (!canvasContainer) {
         console.error("Element with ID 'canvasContainer' not found for Three.js.");
         return;
     }

     let renderer, scene, camera, particlesMesh;
     let animationFrameId = null; // To control animation loop

     try {
         // Set up scene, camera, renderer
         scene = new THREE.Scene();
         camera = new THREE.PerspectiveCamera(75, canvasContainer.clientWidth / canvasContainer.clientHeight, 0.1, 1000);
         renderer = new THREE.WebGLRenderer({
             alpha: true,
             antialias: true
         });

         if (!renderer.domElement) {
             throw new Error("WebGL Renderer could not be created. WebGL might not be supported.");
         }

         renderer.setSize(canvasContainer.clientWidth, canvasContainer.clientHeight);
         renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2)); // Optimize for high-res displays
         canvasContainer.appendChild(renderer.domElement);

         // Create particles
         const particlesGeometry = new THREE.BufferGeometry();
         const particlesCnt = 5000;
         const posArray = new Float32Array(particlesCnt * 3);
         for (let i = 0; i < particlesCnt * 3; i++) {
             // Spread particles wider but keep depth shallow
             posArray[i] = (Math.random() - 0.5) * 10; // X, Y
             if ((i % 3) === 2) posArray[i] = (Math.random() - 0.5) * 2; // Z
         }
         particlesGeometry.setAttribute('position', new THREE.BufferAttribute(posArray, 3));

         // Create particle material
         const particlesMaterial = new THREE.PointsMaterial({
             size: 0.008, // Slightly larger particles
             color: 0xffffff,
             transparent: true,
             opacity: 0.7,
             depthWrite: false, // Prevents depth sorting issues
             blending: THREE.AdditiveBlending // Brighter effect where particles overlap
         });

         particlesMesh = new THREE.Points(particlesGeometry, particlesMaterial);
         scene.add(particlesMesh);

         camera.position.z = 3; // Move camera back slightly

         // Mouse movement effect
         let mouseX = 0,
             mouseY = 0;
         document.addEventListener('mousemove', (event) => {
             mouseX = (event.clientX / window.innerWidth) * 2 - 1;
             mouseY = -(event.clientY / window.innerHeight) * 2 + 1;
         });


         // Animation loop
         const clock = new THREE.Clock();
         const animate = function() {
             animationFrameId = requestAnimationFrame(animate);

             const elapsedTime = clock.getElapsedTime();

             // Gentle rotation
             if (particlesMesh) {
                 particlesMesh.rotation.y = elapsedTime * 0.1;
                 // Parallax effect based on mouse
                 camera.position.x += (mouseX * 0.1 - camera.position.x) * 0.05;
                 camera.position.y += (mouseY * 0.1 - camera.position.y) * 0.05;
                 camera.lookAt(scene.position);
             }

             renderer.render(scene, camera);
         };

         // Handle window resize
         const onWindowResize = () => {
             if (canvasContainer.clientWidth > 0 && canvasContainer.clientHeight > 0) {
                 camera.aspect = canvasContainer.clientWidth / canvasContainer.clientHeight;
                 camera.updateProjectionMatrix();
                 renderer.setSize(canvasContainer.clientWidth, canvasContainer.clientHeight);
                 renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
             }
         };
         window.addEventListener('resize', onWindowResize);

         // Start animation
         animate();

     } catch (error) {
         console.error("Error initializing Three.js animation:", error);
         if (canvasContainer) canvasContainer.innerHTML = `<p style='color: white; text-align: center;'>Hero animation failed to load. ${error.message}</p>`;
         // Clean up if error occurred mid-initialization
         if (animationFrameId) cancelAnimationFrame(animationFrameId);
         if (renderer && renderer.domElement && canvasContainer.contains(renderer.domElement)) {
             canvasContainer.removeChild(renderer.domElement);
         }
         window.removeEventListener('resize', onWindowResize); // Ensure listener is removed
     }
 }


 // p5.js Animation for Experience Section
 function initP5Animation() {
     const animationContainer = document.getElementById('animation-container');
     if (!animationContainer) {
         console.error("Element with ID 'animation-container' not found for p5.js.");
         return;
     }

     let p5Instance = null; // To hold the p5 instance

     try {
         // Create a new p5 instance in instance mode
         p5Instance = new p5(function(p) {
             let particles = [];
             // Use colors from CSS variables if possible, otherwise fallback
             const rootStyles = getComputedStyle(document.documentElement);
             const colors = [
                 rootStyles.getPropertyValue('--primary').trim() || '#2E5077',
                 rootStyles.getPropertyValue('--secondary').trim() || '#4DA1A9',
                 rootStyles.getPropertyValue('--accent').trim() || '#79D7BE',
                 rootStyles.getPropertyValue('--light').trim() || '#F6F4F0'
             ];
             const numParticles = 80; // Adjusted particle count
             const connectDistance = 120; // Increased connection distance


             p.setup = function() {
                 const container = document.getElementById('animation-container');
                 if (container.offsetWidth > 0 && container.offsetHeight > 0) {
                     const canvas = p.createCanvas(container.offsetWidth, container.offsetHeight);
                     canvas.parent('animation-container');
                 } else {
                     console.warn("p5 container has zero dimensions on setup.");
                     p.noCanvas(); // Prevent errors if container is not ready
                     return;
                 }

                 // Create initial particles
                 for (let i = 0; i < numParticles; i++) {
                     particles.push(createParticle());
                 }
                 p.frameRate(30); // Optimize frame rate
             };

             p.draw = function() {
                 if (!p.canvas) return; // Don't draw if canvas wasn't created

                 p.clear(); // Clear canvas each frame

                 // Update and display particles
                 particles.forEach((particle, i) => {
                     particle.update();
                     particle.display();
                     // Connect nearby particles
                     connectParticles(particle, i);
                 });
             };

             // Particle class (using simple object for this example)
             function createParticle() {
                 let particle = {
                     pos: p.createVector(p.random(p.width), p.random(p.height)),
                     vel: p5.Vector.random2D().mult(p.random(0.2, 0.8)), // Random velocity
                     size: p.random(3, 6),
                     color: p.random(colors) // Pick a random color from the array
                 };

                 particle.update = function() {
                     this.pos.add(this.vel);
                     // Bounce off edges
                     if (this.pos.x < 0 || this.pos.x > p.width) this.vel.x *= -1;
                     if (this.pos.y < 0 || this.pos.y > p.height) this.vel.y *= -1;
                     // Keep within bounds strictly
                     this.pos.x = p.constrain(this.pos.x, 0, p.width);
                     this.pos.y = p.constrain(this.pos.y, 0, p.height);
                 };

                 particle.display = function() {
                     p.noStroke();
                     // Add slight transparency based on velocity maybe?
                     p.fill(this.color + 'B3'); // Use hex alpha (70%)
                     p.circle(this.pos.x, this.pos.y, this.size);
                 };

                 return particle;
             }

             // Connect particles that are close to each other
             function connectParticles(particle, index) {
                 for (let i = index + 1; i < particles.length; i++) {
                     const other = particles[i];
                     const d = p.dist(particle.pos.x, particle.pos.y, other.pos.x, other.pos.y);

                     if (d < connectDistance) {
                         // Calculate opacity based on distance
                         const alpha = p.map(d, 0, connectDistance, 180, 0); // Fades out (hex A0 approx)
                         // Use the color of the first particle for the line
                         p.stroke(particle.color + p.hex(alpha, 2)); // Use hex representation of alpha
                         p.strokeWeight(0.6); // Slightly thicker lines
                         p.line(particle.pos.x, particle.pos.y, other.pos.x, other.pos.y);
                     }
                 }
             }


             // Handle window resize
             p.windowResized = function() {
                 const container = document.getElementById('animation-container');
                 if (container && container.offsetWidth > 0 && container.offsetHeight > 0) {
                     p.resizeCanvas(container.offsetWidth, container.offsetHeight);
                 } else {
                     console.warn("p5 container has zero dimensions on resize.");
                 }
             };
         }); // End of p5 instance definition

     } catch (error) {
         console.error("Error initializing p5.js animation:", error);
         if (animationContainer) animationContainer.innerHTML = `<p style='color: white; text-align: center;'>Interactive animation failed to load. ${error.message}</p>`;
         // Clean up p5 instance if it exists and error occurred
         if (p5Instance) {
             p5Instance.remove();
         }
     }
 }


 // Mobile Menu Toggle Functionality
 function initMobileMenu() {
     const mobileMenuButton = document.querySelector('.mobile-menu-button');
     const mobileCloseButton = document.querySelector('.mobile-close-button');
     const mobileMenu = document.querySelector('.mobile-menu');
     const mobileLinks = document.querySelectorAll('.mobile-link');

     if (!mobileMenuButton || !mobileCloseButton || !mobileMenu) {
         console.warn("Mobile menu elements not found.");
         return;
     }

     const toggleMenu = (open) => {
         if (open) {
             mobileMenu.classList.remove('hidden');
             mobileMenu.classList.add('flex');
             document.body.style.overflow = 'hidden'; // Prevent background scroll
             mobileMenuButton.setAttribute('aria-expanded', 'true');
         } else {
             mobileMenu.classList.add('hidden');
             mobileMenu.classList.remove('flex');
             document.body.style.overflow = 'auto'; // Restore scroll
             mobileMenuButton.setAttribute('aria-expanded', 'false');
         }
     };

     mobileMenuButton.addEventListener('click', () => toggleMenu(true));
     mobileCloseButton.addEventListener('click', () => toggleMenu(false));

     // Close menu when a link is clicked
     mobileLinks.forEach(link => {
         link.addEventListener('click', () => toggleMenu(false));
     });

     // Close menu if Escape key is pressed
     document.addEventListener('keydown', (e) => {
         if (e.key === 'Escape' && mobileMenu.classList.contains('flex')) {
             toggleMenu(false);
         }
     });
 }


 // Lightbox Functionality
 function initLightbox() {
     const galleryItems = document.querySelectorAll('.gallery-item');
     const lightbox = document.querySelector('.lightbox');
     const lightboxImg = document.querySelector('.lightbox-img');
     const lightboxClose = document.querySelector('.lightbox-close');

     if (!lightbox || !lightboxImg || !lightboxClose || galleryItems.length === 0) {
         console.warn("Lightbox elements not found or no gallery items.");
         return;
     }

     const openLightbox = (imgSrc, imgAlt) => {
         lightboxImg.setAttribute('src', imgSrc);
         lightboxImg.setAttribute('alt', imgAlt || "Enlarged gallery image");
         lightbox.classList.add('active');
         document.body.style.overflow = 'hidden'; // Prevent background scroll
         lightboxClose.focus(); // Set focus to close button for accessibility
     };

     const closeLightbox = () => {
         lightbox.classList.remove('active');
         document.body.style.overflow = 'auto'; // Restore scroll
     };


     galleryItems.forEach(item => {
         item.addEventListener('click', () => {
             const img = item.querySelector('img');
             if (img) {
                 openLightbox(img.getAttribute('src'), img.getAttribute('alt'));
             }
         });
         // Add keyboard accessibility
         item.addEventListener('keydown', (e) => {
             if (e.key === 'Enter' || e.key === ' ') {
                 e.preventDefault();
                 const img = item.querySelector('img');
                 if (img) openLightbox(img.getAttribute('src'), img.getAttribute('alt'));
             }
         });
         // Add tabindex to make them focusable
         item.setAttribute('tabindex', '0');
         item.setAttribute('role', 'button');
         item.setAttribute('aria-label', 'View image in lightbox');
     });

     lightboxClose.addEventListener('click', closeLightbox);

     // Close lightbox if clicking outside the image (on the backdrop)
     lightbox.addEventListener('click', (e) => {
         if (e.target === lightbox) {
             closeLightbox();
         }
     });

     // Close lightbox with Escape key
     document.addEventListener('keydown', (e) => {
         if (e.key === 'Escape' && lightbox.classList.contains('active')) {
             closeLightbox();
         }
     });
 }


 // Contact Form Validation and Submission Handling (Client-Side)
 function initFormValidation() {
     const contactForm = document.getElementById('contactForm');
     if (!contactForm) {
         console.warn("Contact form not found.");
         return;
     }

     const formMessage = document.getElementById('form-message');
     const submitButton = contactForm.querySelector('button[type="submit"]');

     // Function to display errors
     const showError = (inputId, message) => {
         const errorElement = document.getElementById(inputId + 'Error');
         if (errorElement) {
             errorElement.textContent = message;
             errorElement.style.display = 'block';
         }
         const inputElement = document.getElementById(inputId);
         if (inputElement) {
             inputElement.setAttribute('aria-invalid', 'true');
             inputElement.setAttribute('aria-describedby', inputId + 'Error');
         }
     };

     // Function to clear errors
     const clearErrors = () => {
         contactForm.querySelectorAll('.form-error').forEach(error => {
             error.style.display = 'none';
             error.textContent = ''; // Clear previous message
         });
         contactForm.querySelectorAll('input, select, textarea').forEach(input => {
             input.removeAttribute('aria-invalid');
             input.removeAttribute('aria-describedby');
         });
         if (formMessage) {
             formMessage.style.display = 'none';
             formMessage.textContent = '';
             formMessage.className = 'mb-4 text-center text-sm font-medium'; // Reset class
         }
     };

     // Function to validate date range
     const validateDates = (checkinInput, checkoutInput) => {
         const checkinDate = new Date(checkinInput.value);
         const checkoutDate = new Date(checkoutInput.value);
         // Basic check: Ensure checkout is after checkin
         if (checkinInput.value && checkoutInput.value && checkoutDate <= checkinDate) {
             showError('checkout', 'Check-out date must be after check-in date.');
             return false;
         }
         // Add more checks? e.g., minimum stay duration
         return true;
     };


     contactForm.addEventListener('submit', async (e) => {
         e.preventDefault(); // Prevent default form submission
         clearErrors(); // Clear previous errors first

         // Get form elements
         const firstName = document.getElementById('firstName');
         const lastName = document.getElementById('lastName');
         const email = document.getElementById('email');
         const phone = document.getElementById('phone');
         const checkin = document.getElementById('checkin');
         const checkout = document.getElementById('checkout');
         const guests = document.getElementById('guests');
         const requests = document.getElementById('requests'); // Optional field

         let isValid = true;

         // --- Validation Checks ---
         if (!firstName.value.trim()) {
             showError('firstName', 'Please enter your first name.');
             isValid = false;
         }
         if (!lastName.value.trim()) {
             showError('lastName', 'Please enter your last name.');
             isValid = false;
         }

         const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
         if (!email.value.trim() || !emailPattern.test(email.value)) {
             showError('email', 'Please enter a valid email address.');
             isValid = false;
         }

         const phonePattern = /^[0-9]{10}$/; // Simple 10 digit pattern
         if (!phone.value.trim() || !phonePattern.test(phone.value)) {
             showError('phone', 'Please enter a 10-digit phone number.');
             isValid = false;
         }

         const today = new Date().toISOString().split('T')[0];
         if (!checkin.value) {
             showError('checkin', 'Please select a check-in date.');
             isValid = false;
         }
         // else if (checkin.value < today) { showError('checkin', 'Check-in date cannot be in the past.'); isValid = false; } // Optional: Check against today

         if (!checkout.value) {
             showError('checkout', 'Please select a check-out date.');
             isValid = false;
         }
         // Validate date order only if both dates are present
         else if (checkin.value && !validateDates(checkin, checkout)) {
             isValid = false;
         }

         if (!guests.value) {
             showError('guests', 'Please select the number of guests.');
             isValid = false;
         }
         // --- End Validation Checks ---


         if (isValid) {
             if (submitButton) {
                 submitButton.disabled = true;
                 submitButton.textContent = 'Sending...';
             }
             if (formMessage) {
                 formMessage.textContent = 'Submitting your request...';
                 formMessage.className = 'mb-4 text-center text-sm font-medium text-gray-600'; // Indicate processing
                 formMessage.style.display = 'block';
             }

             // Prepare form data for submission
             const formData = new FormData(contactForm);

             // **IMPORTANT**: Actual form submission using Fetch API
             // Replace '/path/to/your/server-script.php' with your actual backend endpoint
             try {
                 // const response = await fetch('/path/to/your/server-script.php', {
                 //     method: 'POST',
                 //     body: formData // Send FormData directly
                 // });

                 // --- MOCK SUBMISSION (REMOVE THIS BLOCK) ---
                 console.log("Simulating form submission...");
                 await new Promise(resolve => setTimeout(resolve, 2000)); // Simulate network delay
                 const mockSuccess = Math.random() > 0.2; // Simulate success/failure
                 const response = {
                     ok: mockSuccess,
                     status: mockSuccess ? 200 : 500,
                     json: async () => (mockSuccess ? {
                         message: "Request received successfully!"
                     } : {
                         message: "Server error, please try again."
                     })
                 };
                 // --- END MOCK SUBMISSION ---


                 const result = await response.json();

                 if (response.ok) {
                     if (formMessage) {
                         formMessage.textContent = result.message || 'Thank you! Your request has been sent successfully.';
                         formMessage.className = 'mb-4 text-center text-sm font-medium success'; // Success style
                     }
                     contactForm.reset(); // Clear the form on success
                 } else {
                     throw new Error(result.message || `Server responded with status: ${response.status}`);
                 }

             } catch (error) {
                 console.error('Form submission error:', error);
                 if (formMessage) {
                     formMessage.textContent = `Submission failed: ${error.message || 'Please try again later.'}`;
                     formMessage.className = 'mb-4 text-center text-sm font-medium error'; // Error style
                 }
             } finally {
                 if (submitButton) {
                     submitButton.disabled = false;
                     submitButton.textContent = 'Send Request';
                 }
                 if (formMessage) formMessage.style.display = 'block'; // Ensure message stays visible
             }

         } else {
             if (formMessage) {
                 formMessage.textContent = 'Please correct the errors highlighted above.';
                 formMessage.className = 'mb-4 text-center text-sm font-medium error'; // Error style
                 formMessage.style.display = 'block';
             }
             // Focus the first invalid field for accessibility
             const firstInvalidField = contactForm.querySelector('[aria-invalid="true"]');
             if (firstInvalidField) firstInvalidField.focus();
         }
     });
 }


 // Dark Mode Toggle Functionality
 function initDarkMode() {
     const darkModeToggles = document.querySelectorAll('.dark-mode-toggle');
     const body = document.body;
     const storageKey = 'darkModePreference';

     const setDarkMode = (enabled) => {
         const iconClassAdd = enabled ? 'fa-sun' : 'fa-moon';
         const iconClassRemove = enabled ? 'fa-moon' : 'fa-sun';

         if (enabled) {
             body.classList.add('dark-mode');
         } else {
             body.classList.remove('dark-mode');
         }

         darkModeToggles.forEach(toggle => {
             const icon = toggle.querySelector('i');
             if (icon) {
                 icon.classList.remove(iconClassRemove);
                 icon.classList.add(iconClassAdd);
             }
             toggle.setAttribute('aria-pressed', String(enabled));
         });

         // Store preference
         try {
             localStorage.setItem(storageKey, enabled ? 'enabled' : 'disabled');
         } catch (e) {
             console.warn("Could not save dark mode preference to localStorage:", e);
         }
     };

     // Check for stored preference or system preference
     let currentPreference = localStorage.getItem(storageKey);
     let prefersDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
     let darkModeEnabled = (currentPreference === 'enabled') || (currentPreference === null && prefersDarkMode);

     // Set initial state based on preference
     setDarkMode(darkModeEnabled);

     // Add click listener to toggles
     darkModeToggles.forEach(toggle => {
         toggle.addEventListener('click', () => {
             // Toggle the state based on the current body class
             setDarkMode(!body.classList.contains('dark-mode'));
         });
         // Set initial aria-label based on state
         toggle.setAttribute('aria-label', darkModeEnabled ? 'Disable Dark Mode' : 'Enable Dark Mode');
     });

     // Listen for changes in system preference
     window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
         // Only change if no explicit preference is stored
         if (localStorage.getItem(storageKey) === null) {
             setDarkMode(e.matches);
         }
     });
 }


 // Navbar Scroll Effect
 function initNavbarScroll() {
     const navbar = document.querySelector('.navbar');
     if (!navbar) {
         console.warn("Navbar element not found.");
         return;
     }
     const scrollThreshold = 50; // Pixels to scroll before effect triggers

     const handleScroll = () => {
         if (window.scrollY > scrollThreshold) {
             navbar.classList.add('scrolled');
         } else {
             navbar.classList.remove('scrolled');
         }
     };

     // Apply effect immediately if already scrolled past threshold on load
     handleScroll();

     // Add scroll listener
     window.addEventListener('scroll', handleScroll, {
         passive: true
     }); // Use passive listener for performance
 }


 // Smooth Scrolling for Anchor Links
 function initSmoothScroll() {
     document.querySelectorAll('a[href^="#"]').forEach(anchor => {
         anchor.addEventListener('click', function(e) {
             const href = this.getAttribute('href');

             // Ensure it's a valid ID selector (#elementId) and not just "#" or "#/"
             if (href && href.length > 1 && href.startsWith('#') && !href.includes('/')) {
                 try {
                     const targetElement = document.querySelector(href);

                     if (targetElement) {
                         e.preventDefault(); // Prevent default jump only if target exists

                         const navbar = document.querySelector('.navbar');
                         // Estimate navbar height, fallback to 70 if not found or hidden
                         const navbarHeight = navbar ? navbar.offsetHeight : 70;
                         const offsetPadding = 20; // Extra space above the target

                         const elementPosition = targetElement.getBoundingClientRect().top + window.scrollY;
                         const offsetPosition = elementPosition - navbarHeight - offsetPadding;

                         window.scrollTo({
                             top: offsetPosition,
                             behavior: 'smooth'
                         });

                         // Optional: Update URL hash after scrolling without jumping
                         // history.pushState(null, null, href);

                         // Close mobile menu if open (check exists first)
                         const mobileMenu = document.querySelector('.mobile-menu');
                         if (mobileMenu && mobileMenu.classList.contains('flex')) {
                             mobileMenu.classList.add('hidden');
                             mobileMenu.classList.remove('flex');
                             document.body.style.overflow = 'auto';
                         }
                     } else {
                         console.warn(`Smooth scroll target not found for selector: ${href}`);
                     }
                 } catch (error) {
                     console.error(`Error finding smooth scroll target for selector: ${href}`, error);
                 }
             } else if (href === '#') {
                 // Prevent default jump for plain "#" links if needed
                 // e.preventDefault();
             }
         });
     });

     // Smooth scroll for the scroll-down arrow
     const scrollDownButton = document.querySelector('.scroll-down');
     if (scrollDownButton) {
         scrollDownButton.addEventListener('click', (e) => {
             const featuresSection = document.getElementById('features');
             if (featuresSection) {
                 e.preventDefault(); // Prevent default if it's an anchor link
                 const navbarHeight = document.querySelector('.navbar')?.offsetHeight || 70;
                 const offsetPadding = 20;
                 const elementPosition = featuresSection.getBoundingClientRect().top + window.scrollY;
                 const offsetPosition = elementPosition - navbarHeight - offsetPadding;

                 window.scrollTo({
                     top: offsetPosition,
                     behavior: 'smooth'
                 });
             }
         });
     }
 }