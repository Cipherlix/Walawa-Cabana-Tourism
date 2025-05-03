<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Walawa Cabana Lake Resort | Luxury Lakeside Experience</title>
    <link rel="stylesheet" href="./src/output.css">
    <link rel="stylesheet" href="./src/css/style.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.4.0/p5.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" integrity="sha512-1cK78a1o+ht2JcaW6g8OXYwqpev9+6GqOkz9xmBN9iUUhIndKtxwILGWYOSibOKjLsEdjyjZvYDq/cZwNeak0w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js" integrity="sha512-A7AYk1fGKX6S2SsHywmPkrnzTZHrgiVT7GcQkLGDe2ev0aWb8zejytzS8wjo7PGEXKqJOrjQ4oORtnimIRZBtw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Maname&display=swap" rel="stylesheet">
</head>

<body class="">
    <nav class="navbar fixed w-full z-50 flex items-center justify-between">
        <div class="flex items-center">
            <img src="./src/assets/images/walawa-official-logo.png" class="w-12 h-12 mr-2 rounded-full" alt="Walawa Cabana Logo">
            <a href="#" class="text-2xl font-bold flex items-center text-decoration-none">
                <span class="sinhala-text mr-2 text-3xl" style="color: var(--primary);">වලව</span>
                <span style="color: var(--secondary);" class="tagesschrift-en mt-4">Cabana</span>
            </a>
        </div>

        <div class="hidden md:flex items-center tagesschrift-en">
            <a href="#hero" class="nav-link">Home</a>
            <a href="#features" class="nav-link">Features</a>
            <a href="#gallery" class="nav-link">Gallery</a>
            <a href="#testimonials" class="nav-link">Testimonials</a>
            <a href="#contact" class="nav-link">Contact</a>
            <button aria-label="Toggle Dark Mode" aria-pressed="false" class="dark-mode-toggle ml-6">
                <i class="fas fa-moon"></i> </button>
        </div>

        <div class="md:hidden flex items-center">
            <button aria-label="Toggle Dark Mode" aria-pressed="false" class="dark-mode-toggle mr-2">
                <i class="fas fa-moon"></i> </button>
            <button aria-label="Open Menu" class="mobile-menu-button text-2xl p-2 focus:outline-none focus:ring-2 focus:ring-primary rounded">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </nav>

    <div class="mobile-menu hidden fixed top-0 left-0 w-full h-screen bg-white z-50 flex flex-col items-center justify-center space-y-6">
        <button aria-label="Close Menu" class="absolute top-6 right-6 mobile-close-button text-3xl p-2 focus:outline-none focus:ring-2 focus:ring-primary rounded">
            <i class="fas fa-times"></i>
        </button>
        <a href="#hero" class="mobile-link py-3 text-2xl tagesschrift-en">Home</a>
        <a href="#features" class="mobile-link py-3 text-2xl tagesschrift-en">Features</a>
        <a href="#gallery" class="mobile-link py-3 text-2xl tagesschrift-en">Gallery</a>
        <a href="#testimonials" class="mobile-link py-3 text-2xl tagesschrift-en">Testimonials</a>
        <a href="#contact" class="mobile-link py-3 text-2xl tagesschrift-en">Contact</a>
    </div>

    <section id="hero" class="relative flex items-center justify-center" style="background-image: url('./src/assets/images/cabana/bg-hero.jpg');">
        <div id="canvasContainer" class="absolute top-0 left-0 w-full h-full z-0 opacity-60"></div>
        <div class="container mx-auto px-6 text-center relative z-10">
            <div class="hero-text text-white" data-aos="fade-up" data-aos-duration="1000">
                <h1 class="text-5xl md:text-6xl font-bold mb-4 leading-tight tagesschrift-en">
                    <span class="sinhala-text">වලව</span> Cabana Lake Resort
                </h1>
                <p class="text-xl md:text-2xl mb-8 max-w-2xl mx-auto tinos-en">Experience unparalleled luxury lakeside living nestled in the heart of Sri Lanka's natural paradise.</p>
                <a href="#contact" class="btn-primary tagesschrift-en">Book Your Stay</a>
            </div>
        </div>
        <a href="#features" aria-label="Scroll down" class="scroll-down">
            <i class="fas fa-chevron-down text-3xl"></i>
        </a>
    </section>

    <section id="features" class="py-24 bg-green-900 dark:bg-black">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center text-dark dark:text-light" data-aos="fade-up">
                <span class="sinhala-text" style="color: var(--primary);">වලව Cabana</span>
                <span style="color: var(--secondary);"> Experience</span>
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10 mt-12">

                <div class="feature-card text-dark dark:text-light" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-icon text-3xl mb-4"><i class="fas fa-water"></i></div>
                    <h3 class="text-xl font-bold mb-4">Lakeside Serenity</h3>
                    <p>Immerse yourself in the tranquil beauty of our private lakefront cabanas, where gentle waves provide the perfect soundtrack.</p>
                </div>

                <div class="feature-card text-dark dark:text-light" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-icon text-3xl mb-4"><i class="fas fa-utensils"></i></div>
                    <h3 class="text-xl font-bold mb-4">Authentic Cuisine</h3>
                    <p>Savor the richness of traditional Sri Lankan flavors with expertly crafted dishes using fresh, locally sourced ingredients.</p>
                </div>

                <div class="feature-card text-dark dark:text-light" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-icon text-3xl mb-4"><i class="fas fa-spa"></i></div>
                    <h3 class="text-xl font-bold mb-4">Wellness & Spa</h3>
                    <p>Rejuvenate body and mind with our range of Ayurvedic treatments and massages designed to restore balance and harmony.</p>
                </div>

                <div class="feature-card text-dark dark:text-light" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-icon text-3xl mb-4"><i class="fas fa-swimmer"></i></div>
                    <h3 class="text-xl font-bold mb-4">Infinity Pool</h3>
                    <p>Swim in our stunning infinity pool that merges with the lake, offering breathtaking views of the surrounding landscape.</p>
                </div>

                <div class="feature-card text-dark dark:text-light" data-aos="fade-up" data-aos-delay="500">
                    <div class="feature-icon text-3xl mb-4"><i class="fas fa-hiking"></i></div>
                    <h3 class="text-xl font-bold mb-4">Nature Trails</h3>
                    <p>Explore lush forests and diverse wildlife with guided nature walks, perfect for adventure seekers and casual explorers alike.</p>
                </div>

                <div class="feature-card text-dark dark:text-light" data-aos="fade-up" data-aos-delay="600">
                    <div class="feature-icon text-3xl mb-4"><i class="fas fa-cocktail"></i></div>
                    <h3 class="text-xl font-bold mb-4">Sunset Lounge</h3>
                    <p>Unwind with handcrafted cocktails at our exclusive lounge while witnessing spectacular sunsets over shimmering waters.</p>
                </div>

            </div>
        </div>
    </section>


    <section id="gallery" class="py-24 bg-gray-100 dark:bg-gray-800">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center text-dark dark:text-light" data-aos="fade-up">
                <span style="color: var(--secondary);">Our </span>
                <span class="sinhala-text" style="color: var(--primary);">වලව</span>
                <span style="color: var(--secondary);"> Gallery</span>
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                <div class="gallery-item" data-aos="fade-up" data-aos-delay="100" tabindex="0" role="button" aria-label="View image in lightbox">
                    <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80" alt="Luxury Cabana Exterior">
                    <div class="gallery-overlay">
                        <h3 class="text-lg font-semibold">Luxury Cabana Exterior</h3>
                    </div>
                </div>
                <div class="gallery-item" data-aos="fade-up" data-aos-delay="200" tabindex="0" role="button" aria-label="View image in lightbox">
                    <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80" alt="Resort Infinity Pool">
                    <div class="gallery-overlay">
                        <h3 class="text-lg font-semibold">Infinity Pool View</h3>
                    </div>
                </div>
                <div class="gallery-item" data-aos="fade-up" data-aos-delay="300" tabindex="0" role="button" aria-label="View image in lightbox">
                    <img src="https://images.unsplash.com/photo-1534398079543-7ae6d016b796?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80" alt="Scenic Lake View from Cabana">
                    <div class="gallery-overlay">
                        <h3 class="text-lg font-semibold">Lake View Deck</h3>
                    </div>
                </div>
                <div class="gallery-item" data-aos="fade-up" data-aos-delay="400" tabindex="0" role="button" aria-label="View image in lightbox">
                    <img src="https://images.unsplash.com/photo-1590073844006-33379778ae09?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1051&q=80" alt="Relaxing Spa Treatment Room">
                    <div class="gallery-overlay">
                        <h3 class="text-lg font-semibold">Spa Treatment Room</h3>
                    </div>
                </div>
                <div class="gallery-item" data-aos="fade-up" data-aos-delay="500" tabindex="0" role="button" aria-label="View image in lightbox">
                    <img src="https://images.unsplash.com/photo-1554679665-f5537f187268?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1051&q=80" alt="Delicious Traditional Sri Lankan Cuisine">
                    <div class="gallery-overlay">
                        <h3 class="text-lg font-semibold">Traditional Cuisine</h3>
                    </div>
                </div>
                <div class="gallery-item" data-aos="fade-up" data-aos-delay="600" tabindex="0" role="button" aria-label="View image in lightbox">
                    <img src="https://images.unsplash.com/photo-1558547834-2d0f95cd1266?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1029&q=80" alt="Sunset View from the Lounge">
                    <div class="gallery-overlay">
                        <h3 class="text-lg font-semibold">Sunset Lounge</h3>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="lightbox">
        <button aria-label="Close Lightbox" class="lightbox-close">×</button>
        <img src="" alt="Enlarged Gallery Image" class="lightbox-img">
    </div>

    <section id="experience" class="py-24 relative overflow-hidden gradient-bg">
        <div class="container mx-auto px-6 relative z-10">
            <h2 class="text-4xl font-bold mb-16 text-center text-white" data-aos="fade-up">
                Discover the <span class="sinhala-text">වලව</span> Difference
            </h2>
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                <div class="text-white" data-aos="fade-right">
                    <h3 class="text-3xl font-semibold mb-6">Immerse Yourself in Nature's Embrace</h3>
                    <p class="mb-6 text-lg leading-relaxed">Our resort is a sanctuary nestled within nature's embrace, offering an escape from urban bustle. Here, time slows, allowing you to reconnect with natural rhythms and find inner peace.</p>
                    <p class="mb-8 text-lg leading-relaxed">Whether watching the sunrise over the lake, exploring nearby wildlife, or simply relaxing on your private deck, every moment at Walawa Cabana Lake Resort creates lasting memories.</p>
                    <a href="#contact" class="btn-primary mt-6 bg-white text-primary hover:bg-gray-100">Plan Your Escape</a>
                </div>
                <div id="animation-container" class="rounded-lg overflow-hidden h-96 relative" data-aos="fade-left">
                    <p class="text-white p-4 text-center italic">Loading interactive animation...</p>
                </div>
            </div>
        </div>
    </section>

    <section id="testimonials" class="py-24 bg-light dark:bg-dark">
        <div class="container mx-auto px-6">
            <h2 class="text-4xl font-bold text-center text-dark dark:text-light" data-aos="fade-up">
                <span style="color: var(--secondary);">Guest </span>
                <span class="sinhala-text" style="color: var(--primary);">වලව</span>
                <span style="color: var(--secondary);"> Stories</span>
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                <div class="testimonial-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="stars text-yellow-400 mb-4">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="quote mb-6">"An absolute oasis! The cabanas are luxurious, lake views breathtaking. Staff went above and beyond to make our stay unforgettable. Highly recommended!"</p>
                    <div class="flex items-center mt-auto testimonial-author">
                        <div class="w-14 h-14 rounded-full overflow-hidden mr-4 border-2 border-accent p-0.5">
                            <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Sarah Johnson" class="w-full h-full object-cover rounded-full">
                        </div>
                        <div>
                            <h4 class="font-bold text-lg">Sarah Johnson</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">London, UK</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="stars text-yellow-400 mb-4">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="quote mb-6">"Perfect blend of luxury and nature. The food, especially traditional Sri Lankan dishes, was exceptional. We felt completely rejuvenated. Will return!"</p>
                    <div class="flex items-center mt-auto testimonial-author">
                        <div class="w-14 h-14 rounded-full overflow-hidden mr-4 border-2 border-accent p-0.5">
                            <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Michael Chen" class="w-full h-full object-cover rounded-full">
                        </div>
                        <div>
                            <h4 class="font-bold text-lg">Michael Chen</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Singapore</p>
                        </div>
                    </div>
                </div>
                <div class="testimonial-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="stars text-yellow-400 mb-4">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="quote mb-6">"Our honeymoon here was magical. The private cabana, attentive service, and romantic sunset cruise made it perfect. A truly special place."</p>
                    <div class="flex items-center mt-auto testimonial-author">
                        <div class="w-14 h-14 rounded-full overflow-hidden mr-4 border-2 border-accent p-0.5">
                            <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Priya Sharma" class="w-full h-full object-cover rounded-full">
                        </div>
                        <div>
                            <h4 class="font-bold text-lg">Priya Sharma</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Mumbai, India</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="contact" class="py-24 relative" style="background-image: url('https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80'); background-size: cover; background-position: center; background-attachment: fixed;">
        <div class="absolute inset-0" style="background: linear-gradient(135deg, rgba(46, 80, 119, 0.92), rgba(77, 161, 169, 0.9)); z-index: 1;"></div>
        <div class="container mx-auto px-6 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 md:gap-16">
                <div class="text-white contact-info" data-aos="fade-right">
                    <h2 class="text-4xl font-bold mb-8">
                        Get In Touch <span class="sinhala-text">වලව</span>
                    </h2>
                    <p class="mb-8 text-lg">Ready to experience Walawa Cabana Lake Resort? Reach out to make a reservation or inquire about our special packages and availability.</p>

                    <div class="mb-6">
                        <h3 class="text-xl font-semibold mb-3 flex items-center"><i class="fas fa-map-marker-alt mr-3 w-5 text-center text-accent"></i>Location</h3>
                        <p class="ml-8">Walawa Lake Road, Embilipitiya,<br>Southern Province, Sri Lanka</p>
                    </div>

                    <div class="mb-6">
                        <h3 class="text-xl font-semibold mb-3 flex items-center"><i class="fas fa-phone-alt mr-3 w-5 text-center text-accent"></i>Reservations</h3>
                        <p class="ml-8"><a href="tel:+94472234567" class="hover:text-accent">+94 47 223 4567</a></p>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-xl font-semibold mb-3 flex items-center"><i class="fas fa-envelope mr-3 w-5 text-center text-accent"></i>Email Us</h3>
                        <p class="ml-8"><a href="mailto:reservations@walawacabana.com" class="hover:text-accent">reservations@walawacabana.com</a></p>
                    </div>

                    <div class="mt-8">
                        <h3 class="text-xl font-semibold mb-4">Follow Us</h3>
                        <div class="flex space-x-3">
                            <a href="#" aria-label="Facebook" class="social-icon"><i class="fab fa-facebook-f"></i></a>
                            <a href="#" aria-label="Instagram" class="social-icon"><i class="fab fa-instagram"></i></a>
                            <a href="#" aria-label="Twitter" class="social-icon"><i class="fab fa-twitter"></i></a>
                            <a href="#" aria-label="Tripadvisor" class="social-icon"><i class="fab fa-tripadvisor"></i></a>
                        </div>
                    </div>
                </div>
                <div data-aos="fade-left">
                    <form id="contactForm" class="bg-light dark:bg-gray-800 p-8 rounded-lg shadow-xl" novalidate>
                        <h3 class="text-2xl font-bold mb-6 text-center text-primary dark:text-accent">Request Your Booking</h3>
                        <div id="form-message" class="mb-4 text-center text-sm font-medium" style="display: none;"></div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4">
                            <div>
                                <label for="firstName" class="sr-only">First Name</label>
                                <input type="text" id="firstName" name="firstName" placeholder="First Name*" required class="w-full form-input">
                                <div class="form-error" id="firstNameError"></div>
                            </div>
                            <div>
                                <label for="lastName" class="sr-only">Last Name</label>
                                <input type="text" id="lastName" name="lastName" placeholder="Last Name*" required class="w-full form-input">
                                <div class="form-error" id="lastNameError"></div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <label for="email" class="sr-only">Email Address</label>
                            <input type="email" id="email" name="email" placeholder="Email Address*" required class="w-full form-input">
                            <div class="form-error" id="emailError"></div>
                        </div>
                        <div class="mt-4">
                            <label for="phone" class="sr-only">Phone Number</label>
                            <input type="tel" id="phone" name="phone" placeholder="Phone Number* (e.g., 07XXXXXXXX)" required pattern="[0-9]{10}" class="w-full form-input">
                            <div class="form-error" id="phoneError"></div>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 mt-4">
                            <div>
                                <label for="checkin" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Check-in Date*</label>
                                <input type="date" id="checkin" name="checkin" required class="w-full form-input date-input" min="<?php echo date('Y-m-d'); ?>">
                                <div class="form-error" id="checkinError"></div>
                            </div>
                            <div>
                                <label for="checkout" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Check-out Date*</label>
                                <input type="date" id="checkout" name="checkout" required class="w-full form-input date-input" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
                                <div class="form-error" id="checkoutError"></div>
                            </div>
                        </div>
                        <div class="mt-4">
                            <label for="guests" class="sr-only">Number of Guests</label>
                            <select id="guests" name="guests" required class="w-full form-input select-input">
                                <option value="" disabled selected>Number of Guests*</option>
                                <option value="1">1 Guest</option>
                                <option value="2">2 Guests</option>
                                <option value="3">3 Guests</option>
                                <option value="4">4 Guests</option>
                                <option value="5+">5+ Guests</option>
                            </select>
                            <div class="form-error" id="guestsError"></div>
                        </div>
                        <div class="mt-4">
                            <label for="requests" class="sr-only">Special Requests</label>
                            <textarea id="requests" name="requests" rows="4" placeholder="Special Requests (Optional)" class="w-full form-input textarea-input"></textarea>
                        </div>
                        <div class="mt-6">
                            <button type="submit" class="btn-primary w-full">Send Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer class="footer-bg py-16">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-12">
                <div>
                    <a href="#" class="text-2xl font-bold flex items-center mb-4 text-decoration-none">
                        <span class="sinhala-text mr-2 text-3xl text-white">වලව</span>
                        <span class="text-accent">Cabana</span>
                    </a>
                    <p class="footer-text mb-6 text-sm leading-relaxed">Experience unparalleled luxury lakeside living nestled in the heart of Sri Lanka's natural paradise.</p>
                    <div class="flex space-x-3">
                        <a href="#" aria-label="Facebook" class="social-icon footer-social-icon"><i class="fab fa-facebook-f"></i></a> <a href="#" aria-label="Instagram" class="social-icon footer-social-icon"><i class="fab fa-instagram"></i></a> <a href="#" aria-label="Twitter" class="social-icon footer-social-icon"><i class="fab fa-twitter"></i></a> <a href="#" aria-label="Tripadvisor" class="social-icon footer-social-icon"><i class="fab fa-tripadvisor"></i></a>
                    </div>
                </div>
                <div>
                    <h3 class="footer-heading text-xl font-semibold mb-6 text-white">Quick Links</h3>
                    <ul class="footer-links">
                        <li class="mb-3"><a href="#hero">Home</a></li>
                        <li class="mb-3"><a href="#features">Features</a></li>
                        <li class="mb-3"><a href="#gallery">Gallery</a></li>
                        <li class="mb-3"><a href="#testimonials">Testimonials</a></li>
                        <li><a href="#contact">Contact Us</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="footer-heading text-xl font-semibold mb-6 text-white">Contact Info</h3>
                    <p class="flex items-start mb-4 footer-text text-sm">
                        <i class="fas fa-map-marker-alt mr-3 mt-1 w-4 text-center text-accent"></i>
                        <span>Walawa Lake Road,<br>Embilipitiya, Sri Lanka</span>
                    </p>
                    <p class="flex items-center mb-4 footer-text text-sm">
                        <i class="fas fa-phone-alt mr-3 w-4 text-center text-accent"></i>
                        <a href="tel:+94472234567" class="footer-link"> +94 47 223 4567</a>
                    </p>
                    <p class="flex items-center footer-text text-sm">
                        <i class="fas fa-envelope mr-3 w-4 text-center text-accent"></i>
                        <a href="mailto:reservations@walawacabana.com" class="footer-link"> reservations@walawacabana.com</a>
                    </p>
                </div>
                <div>
                    <h3 class="footer-heading text-xl font-semibold mb-6 text-white">Newsletter</h3>
                    <p class="footer-text mb-4 text-sm">Subscribe for special offers, travel tips, and updates.</p>
                    <form class="flex newsletter-form">
                        <label for="newsletter-email" class="sr-only">Email for Newsletter</label>
                        <input type="email" id="newsletter-email" placeholder="Your Email" class="newsletter-input px-4 py-2 w-full rounded-l-md focus:outline-none text-sm" required> <button type="submit" aria-label="Subscribe to Newsletter" class="newsletter-button text-primary px-4 py-2 rounded-r-md hover:bg-opacity-90 transition"> <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div id="map" class="w-full h-96 rounded-lg overflow-hidden shadow-md mb-12 mt-8 border border-gray-300 dark:border-gray-700"> <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d7929.843779714981!2d80.9213439!3d6.4040646!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3ae403002215f037%3A0x3913509dd245a92a!2sHabaraluwewa%20nanathotupola!5e0!3m2!1sen!2slk!4v1746269463341!5m2!1sen!2slk" class="w-full h-full" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Resort Location Map"></iframe>
            </div>
            <div class="footer-bottom pt-8 flex flex-col md:flex-row justify-between items-center text-sm">
                <p class="footer-bottom-text mb-4 md:mb-0">© <?php echo date("Y"); ?> Walawa Cabana Lake Resort. All Rights Reserved.</p>
                <div class="flex space-x-6 footer-bottom-links"> <a href="#">Privacy Policy</a>
                    <a href="#">Terms of Service</a>
                    <a href="#">Sitemap</a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        'use strict';

        // Global references for animations to allow updates
        let threeAnimationAPI = null;
        let p5AnimationAPI = null;

        // Function to safely initialize libraries and scripts
        function initializeSite() {
            // Initialize AOS
            if (typeof AOS !== 'undefined') {
                try {
                    AOS.init({
                        duration: 800,
                        easing: 'ease-in-out',
                        once: true,
                    });
                } catch (error) {
                    console.error("Error initializing AOS:", error);
                }
            } else {
                console.warn("AOS library not loaded.");
            }

            // Initialize Three.js animation
            if (typeof THREE !== 'undefined') {
                threeAnimationAPI = initThreeAnimation(); // Store the API
            } else {
                console.warn("Three.js library not loaded.");
                const canvasContainer = document.getElementById('canvasContainer');
                if (canvasContainer) canvasContainer.innerHTML = "<p class='text-white text-center p-4 italic'>Hero animation disabled.</p>";
            }

            // Initialize p5.js animation
            if (typeof p5 !== 'undefined') {
                p5AnimationAPI = initP5Animation(); // Store the API
            } else {
                console.warn("p5.js library not loaded.");
                const animationContainer = document.getElementById('animation-container');
                if (animationContainer) animationContainer.innerHTML = "<p class='text-white text-center p-4 italic'>Interactive animation disabled.</p>";
            }

            // Initialize other components
            initMobileMenu();
            initLightbox();
            initFormValidation();
            initDarkMode(); // Initialize dark mode AFTER animation initializations
            initNavbarScroll();
            initSmoothScroll();
        }

        document.addEventListener('DOMContentLoaded', initializeSite);

        // --- Three.js Animation (Hero Section) ---
        function initThreeAnimation() {
            const canvasContainer = document.getElementById('canvasContainer');
            if (!canvasContainer) return null;

            let renderer, scene, camera, particlesMesh, particlesMaterial;
            let animationFrameId = null;

            try {
                scene = new THREE.Scene();
                camera = new THREE.PerspectiveCamera(75, canvasContainer.clientWidth / canvasContainer.clientHeight, 0.1, 1000);
                renderer = new THREE.WebGLRenderer({
                    alpha: true,
                    antialias: true
                });

                renderer.setSize(canvasContainer.clientWidth, canvasContainer.clientHeight);
                renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
                canvasContainer.appendChild(renderer.domElement);

                const particlesGeometry = new THREE.BufferGeometry();
                const particlesCnt = 5000;
                const posArray = new Float32Array(particlesCnt * 3);
                for (let i = 0; i < particlesCnt * 3; i++) {
                    posArray[i] = (Math.random() - 0.5) * 10;
                    if ((i % 3) === 2) posArray[i] = (Math.random() - 0.5) * 2;
                }
                particlesGeometry.setAttribute('position', new THREE.BufferAttribute(posArray, 3));

                // Store material reference globally within this scope
                particlesMaterial = new THREE.PointsMaterial({
                    size: 0.008,
                    transparent: true,
                    depthWrite: false,
                    blending: THREE.AdditiveBlending
                    // Initial color set by updateTheme
                });

                particlesMesh = new THREE.Points(particlesGeometry, particlesMaterial);
                scene.add(particlesMesh);
                camera.position.z = 3;

                let mouseX = 0,
                    mouseY = 0;
                const onMouseMove = (event) => {
                    mouseX = (event.clientX / window.innerWidth) * 2 - 1;
                    mouseY = -(event.clientY / window.innerHeight) * 2 + 1;
                };
                document.addEventListener('mousemove', onMouseMove);

                const clock = new THREE.Clock();
                const animate = () => {
                    animationFrameId = requestAnimationFrame(animate);
                    const elapsedTime = clock.getElapsedTime();
                    if (particlesMesh) particlesMesh.rotation.y = elapsedTime * 0.1;
                    camera.position.x += (mouseX * 0.1 - camera.position.x) * 0.05;
                    camera.position.y += (mouseY * 0.1 - camera.position.y) * 0.05;
                    camera.lookAt(scene.position);
                    renderer.render(scene, camera);
                };

                const onWindowResize = () => {
                    if (canvasContainer.clientWidth > 0 && canvasContainer.clientHeight > 0) {
                        camera.aspect = canvasContainer.clientWidth / canvasContainer.clientHeight;
                        camera.updateProjectionMatrix();
                        renderer.setSize(canvasContainer.clientWidth, canvasContainer.clientHeight);
                        renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
                    }
                };
                window.addEventListener('resize', onWindowResize);

                // --- Theme Update Function ---
                const updateTheme = () => {
                    const isDarkMode = document.body.classList.contains('dark-mode');
                    // Adjust particle color and opacity based on theme
                    const particleColor = isDarkMode ? 0xCCCCCC : 0xFFFFFF; // Lighter gray for dark, white for light
                    const particleOpacity = isDarkMode ? 0.6 : 0.7;

                    if (particlesMaterial) {
                        particlesMaterial.color.setHex(particleColor);
                        particlesMaterial.opacity = particleOpacity;
                        particlesMaterial.needsUpdate = true; // Important!
                    }
                    // Optional: Adjust canvas container opacity if needed
                    // canvasContainer.style.opacity = isDarkMode ? '0.5' : '0.6';
                };

                // Initial theme setup
                updateTheme();
                animate(); // Start animation

                // Return API for external updates
                return {
                    updateTheme: updateTheme,
                    cleanup: () => { // Function to stop animation and remove listeners
                        if (animationFrameId) cancelAnimationFrame(animationFrameId);
                        document.removeEventListener('mousemove', onMouseMove);
                        window.removeEventListener('resize', onWindowResize);
                        if (renderer && renderer.domElement && canvasContainer.contains(renderer.domElement)) {
                            canvasContainer.removeChild(renderer.domElement);
                        }
                        // Dispose Three.js resources if needed
                        if (particlesGeometry) particlesGeometry.dispose();
                        if (particlesMaterial) particlesMaterial.dispose();
                        if (renderer) renderer.dispose();
                    }
                };

            } catch (error) {
                console.error("Error initializing Three.js animation:", error);
                if (canvasContainer) canvasContainer.innerHTML = `<p class='text-white text-center p-4 italic'>Hero animation failed: ${error.message}</p>`;
                // Perform cleanup if error occurred
                if (animationFrameId) cancelAnimationFrame(animationFrameId);
                window.removeEventListener('resize', onWindowResize); // Ensure listener is removed
                document.removeEventListener('mousemove', onMouseMove); // Ensure listener is removed
                return null;
            }
        }


        // --- p5.js Animation (Experience Section) ---
        function initP5Animation() {
            const animationContainer = document.getElementById('animation-container');
            if (!animationContainer) return null;

            let p5Instance = null;

            try {
                p5Instance = new p5(function(p) {
                    let particles = [];
                    let currentColors = []; // Store current theme colors
                    const numParticles = 80;
                    const connectDistance = 120;

                    // Function to get colors based on theme
                    const getThemeColors = () => {
                        const isDarkMode = document.body.classList.contains('dark-mode');
                        const rootStyles = getComputedStyle(document.documentElement);
                        // Define light and dark mode colors explicitly or read from CSS vars if reliable
                        if (isDarkMode) {
                            return [ // Dark mode palette (lighter/accent colors)
                                rootStyles.getPropertyValue('--accent').trim() || '#79D7BE',
                                rootStyles.getPropertyValue('--secondary').trim() || '#4DA1A9',
                                '#DDDDDD', // A light gray
                                '#AAAAAA' // A medium gray
                            ];
                        } else {
                            return [ // Light mode palette (original colors)
                                rootStyles.getPropertyValue('--light-primary').trim() || '#626f47',
                                rootStyles.getPropertyValue('--light-secondary').trim() || '#a8b400',
                                rootStyles.getPropertyValue('--light-accent').trim() || '#F0BB78',
                                '#f6f4f0' // A darker gray for contrast
                            ];
                        }
                    };

                    p.setup = function() {
                        const container = document.getElementById('animation-container');
                        if (container.offsetWidth > 0 && container.offsetHeight > 0) {
                            const canvas = p.createCanvas(container.offsetWidth, container.offsetHeight);
                            canvas.parent('animation-container');
                            // Initial setup call is needed here to ensure container is ready
                            p.windowResized(); // Call resize to set initial size correctly
                        } else {
                            console.warn("p5 container has zero dimensions on setup.");
                            p.noCanvas();
                            return;
                        }


                        currentColors = getThemeColors(); // Get initial colors
                        particles = []; // Clear particles before creating new ones
                        for (let i = 0; i < numParticles; i++) {
                            particles.push(createParticle());
                        }
                        p.frameRate(30);
                        // Clear the placeholder text
                        const placeholder = container.querySelector('p');
                        if (placeholder) placeholder.style.display = 'none';
                    };

                    p.draw = function() {
                        if (!p.canvas) return;
                        p.clear();
                        particles.forEach((particle, i) => {
                            particle.update();
                            particle.display();
                            connectParticles(particle, i);
                        });
                    };

                    function createParticle() {
                        let particle = {
                            pos: p.createVector(p.random(p.width), p.random(p.height)),
                            vel: p5.Vector.random2D().mult(p.random(0.2, 0.8)),
                            size: p.random(3, 6),
                            color: p.random(currentColors) // Use current theme colors
                        };
                        particle.update = function() {
                            /* ... (no changes needed) ... */
                            this.pos.add(this.vel);
                            if (this.pos.x < 0 || this.pos.x > p.width) this.vel.x *= -1;
                            if (this.pos.y < 0 || this.pos.y > p.height) this.vel.y *= -1;
                            this.pos.x = p.constrain(this.pos.x, 0, p.width);
                            this.pos.y = p.constrain(this.pos.y, 0, p.height);
                        };
                        particle.display = function() {
                            /* ... (no changes needed) ... */
                            p.noStroke();
                            p.fill(this.color + 'B3'); // 70% alpha
                            p.circle(this.pos.x, this.pos.y, this.size);
                        };
                        return particle;
                    }

                    function connectParticles(particle, index) {
                        /* ... (no changes needed) ... */
                        for (let i = index + 1; i < particles.length; i++) {
                            const other = particles[i];
                            const d = p.dist(particle.pos.x, particle.pos.y, other.pos.x, other.pos.y);

                            if (d < connectDistance) {
                                const alpha = p.map(d, 0, connectDistance, 180, 0);
                                const hexAlpha = p.hex(alpha, 2); // Ensure two digits for hex alpha
                                // Ensure particle.color is a valid hex string before appending alpha
                                let baseColor = particle.color;
                                if (typeof baseColor === 'string' && baseColor.startsWith('#')) {
                                    p.stroke(baseColor + hexAlpha);
                                    p.strokeWeight(0.6);
                                    p.line(particle.pos.x, particle.pos.y, other.pos.x, other.pos.y);
                                }
                            }
                        }
                    }

                    // --- Theme Update Function (called externally) ---
                    p.updateTheme = function() {
                        currentColors = getThemeColors();
                        // Update existing particle colors
                        particles.forEach(particle => {
                            particle.color = p.random(currentColors);
                        });
                    };

                    p.windowResized = function() {
                        const container = document.getElementById('animation-container');
                        if (container && container.offsetWidth > 0 && container.offsetHeight > 0) {
                            p.resizeCanvas(container.offsetWidth, container.offsetHeight);
                            // Optional: Reinitialize particles if size changes drastically
                            // particles = [];
                            // for (let i = 0; i < numParticles; i++) particles.push(createParticle());
                        } else {
                            console.warn("p5 container resized to zero dimensions or not found.");
                        }
                    };

                }); // End p5 instance definition

                // Return API for external updates
                return {
                    updateTheme: () => {
                        if (p5Instance && typeof p5Instance.updateTheme === 'function') {
                            p5Instance.updateTheme();
                        }
                    },
                    cleanup: () => { // Function to stop animation and remove instance
                        if (p5Instance) {
                            p5Instance.remove(); // p5 specific cleanup
                            p5Instance = null;
                        }
                        // Also clear the container in case p5 didn't fully remove canvas
                        const container = document.getElementById('animation-container');
                        if (container) container.innerHTML = '<p class="text-white text-center p-4 italic">Interactive animation stopped.</p>';
                    }
                };

            } catch (error) {
                console.error("Error initializing p5.js animation:", error);
                if (animationContainer) animationContainer.innerHTML = `<p class='text-white text-center p-4 italic'>Interactive animation failed: ${error.message}</p>`;
                if (p5Instance) p5Instance.remove(); // Cleanup on error
                return null;
            }
        }


        // --- Dark Mode Toggle ---
        function initDarkMode() {
            const darkModeToggles = document.querySelectorAll('.dark-mode-toggle');
            const body = document.body;
            const storageKey = 'darkModePreference';

            const setDarkMode = (enabled) => {
                const iconClassAdd = enabled ? 'fa-sun' : 'fa-moon';
                const iconClassRemove = enabled ? 'fa-moon' : 'fa-sun';
                const ariaLabel = enabled ? 'Disable Dark Mode' : 'Enable Dark Mode';

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
                    toggle.setAttribute('aria-label', ariaLabel); // Update label for screen readers
                });

                // --- !!! UPDATE ANIMATIONS !!! ---
                if (threeAnimationAPI && typeof threeAnimationAPI.updateTheme === 'function') {
                    threeAnimationAPI.updateTheme();
                }
                if (p5AnimationAPI && typeof p5AnimationAPI.updateTheme === 'function') {
                    p5AnimationAPI.updateTheme();
                }
                // --- !!! END UPDATE ANIMATIONS !!! ---


                try {
                    localStorage.setItem(storageKey, enabled ? 'enabled' : 'disabled');
                } catch (e) {
                    console.warn("Could not save dark mode preference:", e);
                }
            };


            let currentPreference = localStorage.getItem(storageKey);
            let prefersDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
            let darkModeEnabled = (currentPreference === 'enabled') || (currentPreference === null && prefersDarkMode);

            // Set initial state WITHOUT triggering animation updates yet (they handle initial state)
            // This is done slightly differently now as animations read the class on init
            if (darkModeEnabled) {
                body.classList.add('dark-mode');
                darkModeToggles.forEach(toggle => {
                    const icon = toggle.querySelector('i');
                    if (icon) {
                        icon.classList.remove('fa-moon');
                        icon.classList.add('fa-sun');
                    }
                    toggle.setAttribute('aria-pressed', 'true');
                    toggle.setAttribute('aria-label', 'Disable Dark Mode');
                });
            } else {
                body.classList.remove('dark-mode'); // Ensure it's removed if not enabled
                darkModeToggles.forEach(toggle => {
                    const icon = toggle.querySelector('i');
                    if (icon) {
                        icon.classList.remove('fa-sun');
                        icon.classList.add('fa-moon');
                    }
                    toggle.setAttribute('aria-pressed', 'false');
                    toggle.setAttribute('aria-label', 'Enable Dark Mode');
                });
            }


            darkModeToggles.forEach(toggle => {
                toggle.addEventListener('click', () => {
                    // Now, the click explicitly triggers setDarkMode which includes animation updates
                    setDarkMode(!body.classList.contains('dark-mode'));
                });
            });


            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
                // Only change if no explicit preference is stored
                if (localStorage.getItem(storageKey) === null) {
                    setDarkMode(e.matches); // This will also trigger animation updates
                }
            });
        }


        // --- Other Initialization Functions (No changes needed) ---
        function initMobileMenu() {
            /* ... Existing code ... */
            const mobileMenuButton = document.querySelector('.mobile-menu-button');
            const mobileCloseButton = document.querySelector('.mobile-close-button');
            const mobileMenu = document.querySelector('.mobile-menu');
            const mobileLinks = document.querySelectorAll('.mobile-link');

            if (!mobileMenuButton || !mobileCloseButton || !mobileMenu) return;

            const toggleMenu = (open) => {
                if (open) {
                    mobileMenu.classList.remove('hidden');
                    mobileMenu.classList.add('flex');
                    document.body.style.overflow = 'hidden';
                    mobileMenuButton.setAttribute('aria-expanded', 'true');
                } else {
                    mobileMenu.classList.add('hidden');
                    mobileMenu.classList.remove('flex');
                    document.body.style.overflow = 'auto';
                    mobileMenuButton.setAttribute('aria-expanded', 'false');
                }
            };

            mobileMenuButton.addEventListener('click', () => toggleMenu(true));
            mobileCloseButton.addEventListener('click', () => toggleMenu(false));
            mobileLinks.forEach(link => link.addEventListener('click', () => toggleMenu(false)));
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && mobileMenu.classList.contains('flex')) toggleMenu(false);
            });
        }

        function initLightbox() {
            /* ... Existing code ... */
            const galleryItems = document.querySelectorAll('.gallery-item');
            const lightbox = document.querySelector('.lightbox');
            const lightboxImg = document.querySelector('.lightbox-img');
            const lightboxClose = document.querySelector('.lightbox-close');

            if (!lightbox || !lightboxImg || !lightboxClose || galleryItems.length === 0) return;

            const openLightbox = (imgSrc, imgAlt) => {
                lightboxImg.src = imgSrc;
                lightboxImg.alt = imgAlt || "Enlarged gallery image";
                lightbox.classList.add('active');
                document.body.style.overflow = 'hidden';
                lightboxClose.focus();
            };

            const closeLightbox = () => {
                lightbox.classList.remove('active');
                document.body.style.overflow = 'auto';
                // Return focus to the item that opened the lightbox (more complex, skipping for now)
            };

            galleryItems.forEach(item => {
                item.addEventListener('click', () => {
                    const img = item.querySelector('img');
                    if (img) openLightbox(img.src, img.alt);
                });
                item.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        const img = item.querySelector('img');
                        if (img) openLightbox(img.src, img.alt);
                    }
                });
            });

            lightboxClose.addEventListener('click', closeLightbox);
            lightbox.addEventListener('click', (e) => {
                if (e.target === lightbox) closeLightbox();
            });
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape' && lightbox.classList.contains('active')) closeLightbox();
            });
        }

        function initFormValidation() {
            /* ... Existing code ... */
            const contactForm = document.getElementById('contactForm');
            if (!contactForm) return;

            const formMessage = document.getElementById('form-message');
            const submitButton = contactForm.querySelector('button[type="submit"]');

            const showError = (inputId, message) => {
                const errorElement = document.getElementById(inputId + 'Error');
                const inputElement = document.getElementById(inputId);
                if (errorElement) {
                    errorElement.textContent = message;
                    errorElement.style.display = 'block';
                }
                if (inputElement) {
                    inputElement.setAttribute('aria-invalid', 'true');
                    inputElement.setAttribute('aria-describedby', inputId + 'Error');
                }
            };

            const clearErrors = () => {
                contactForm.querySelectorAll('.form-error').forEach(el => {
                    el.style.display = 'none';
                    el.textContent = '';
                });
                contactForm.querySelectorAll('[aria-invalid]').forEach(el => {
                    el.removeAttribute('aria-invalid');
                    el.removeAttribute('aria-describedby');
                });
                if (formMessage) {
                    formMessage.style.display = 'none';
                    formMessage.textContent = '';
                    formMessage.className = 'mb-4 text-center text-sm font-medium';
                }
            };

            const validateDates = (checkinInput, checkoutInput) => {
                if (checkinInput.value && checkoutInput.value && checkoutInput.value <= checkinInput.value) {
                    showError('checkout', 'Check-out date must be after check-in date.');
                    return false;
                }
                return true;
            };

            contactForm.addEventListener('submit', async (e) => {
                e.preventDefault();
                clearErrors();
                let isValid = true;
                // --- Validation Checks ---
                const fieldsToValidate = ['firstName', 'lastName', 'email', 'phone', 'checkin', 'checkout', 'guests'];
                fieldsToValidate.forEach(id => {
                    const input = document.getElementById(id);
                    if (!input) return; // Skip if element doesn't exist

                    let fieldValid = true;
                    if (!input.value.trim() && input.required) {
                        fieldValid = false;
                        showError(id, `Please ${input.tagName === 'SELECT' ? 'select' : 'enter'} your ${input.placeholder || input.labels?.[0]?.textContent || id}.`);
                    } else if (input.type === 'email' && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(input.value)) {
                        fieldValid = false;
                        showError(id, 'Please enter a valid email address.');
                    } else if (input.type === 'tel' && !/^[0-9]{10}$/.test(input.value)) {
                        fieldValid = false;
                        showError(id, 'Please enter a 10-digit phone number.');
                    }
                    if (!fieldValid) isValid = false;
                });

                // Specific date validation
                const checkin = document.getElementById('checkin');
                const checkout = document.getElementById('checkout');
                if (checkin && checkout && !validateDates(checkin, checkout)) {
                    isValid = false;
                }
                // --- End Validation ---


                if (isValid) {
                    if (submitButton) {
                        submitButton.disabled = true;
                        submitButton.textContent = 'Sending...';
                    }
                    if (formMessage) {
                        formMessage.textContent = 'Submitting...';
                        formMessage.className = 'mb-4 text-center text-sm font-medium text-gray-600 dark:text-gray-400';
                        formMessage.style.display = 'block';
                    }

                    const formData = new FormData(contactForm);

                    // --- MOCK SUBMISSION (Replace with actual fetch) ---
                    console.log("Simulating form submission with data:", Object.fromEntries(formData));
                    await new Promise(resolve => setTimeout(resolve, 1500));
                    const mockSuccess = true; // Assume success for demo
                    // --- END MOCK ---

                    if (mockSuccess) {
                        if (formMessage) {
                            formMessage.textContent = 'Thank you! Your request has been sent.';
                            formMessage.className = 'mb-4 text-center text-sm font-medium success';
                        }
                        contactForm.reset();
                        // Clear select placeholder style if needed (might be handled by reset)
                        const selects = contactForm.querySelectorAll('select.select-input');
                        selects.forEach(select => select.classList.remove('text-gray-500')); // Example class, adjust if needed
                    } else {
                        if (formMessage) {
                            formMessage.textContent = 'Submission failed. Please try again.';
                            formMessage.className = 'mb-4 text-center text-sm font-medium error';
                        }
                    }

                    if (submitButton) {
                        submitButton.disabled = false;
                        submitButton.textContent = 'Send Request';
                    }
                    if (formMessage) formMessage.style.display = 'block';

                } else {
                    if (formMessage) {
                        formMessage.textContent = 'Please correct the errors above.';
                        formMessage.className = 'mb-4 text-center text-sm font-medium error';
                        formMessage.style.display = 'block';
                    }
                    const firstInvalidField = contactForm.querySelector('[aria-invalid="true"]');
                    if (firstInvalidField) firstInvalidField.focus();
                }
            });

            // Add listeners to clear errors on input
            contactForm.querySelectorAll('input, select, textarea').forEach(input => {
                input.addEventListener('input', () => {
                    const errorId = input.id + 'Error';
                    const errorElement = document.getElementById(errorId);
                    if (errorElement && errorElement.style.display === 'block') {
                        errorElement.style.display = 'none';
                        input.removeAttribute('aria-invalid');
                        input.removeAttribute('aria-describedby');
                    }
                    // Special handling for select placeholder color
                    if (input.tagName === 'SELECT' && input.value) {
                        input.classList.remove('text-gray-500'); // Remove placeholder style class
                    }
                });
            });
            // Initial placeholder style for select
            contactForm.querySelectorAll('select:required').forEach(select => {
                if (!select.value) {
                    select.classList.add('text-gray-500'); // Add placeholder style class
                }
            });
        }

        function initNavbarScroll() {
            /* ... Existing code ... */
            const navbar = document.querySelector('.navbar');
            if (!navbar) return;
            const scrollThreshold = 50;
            const handleScroll = () => {
                navbar.classList.toggle('scrolled', window.scrollY > scrollThreshold);
            };
            handleScroll(); // Initial check
            window.addEventListener('scroll', handleScroll, {
                passive: true
            });
        }

        function initSmoothScroll() {
            /* ... Existing code ... */
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    if (href && href.length > 1 && href.startsWith('#') && !href.includes('/')) {
                        try {
                            const targetElement = document.querySelector(href);
                            if (targetElement) {
                                e.preventDefault();
                                const navbar = document.querySelector('.navbar');
                                const navbarHeight = navbar ? navbar.offsetHeight : 70;
                                const offsetPadding = 20;
                                const elementPosition = targetElement.getBoundingClientRect().top + window.scrollY;
                                const offsetPosition = elementPosition - navbarHeight - offsetPadding;
                                window.scrollTo({
                                    top: offsetPosition,
                                    behavior: 'smooth'
                                });
                                // Close mobile menu if open
                                const mobileMenu = document.querySelector('.mobile-menu');
                                if (mobileMenu && mobileMenu.classList.contains('flex')) {
                                    mobileMenu.classList.add('hidden');
                                    mobileMenu.classList.remove('flex');
                                    document.body.style.overflow = 'auto';
                                    document.querySelector('.mobile-menu-button')?.setAttribute('aria-expanded', 'false');
                                }
                            }
                        } catch (error) {
                            console.error(`Smooth scroll error: ${error}`);
                        }
                    }
                });
            });
            const scrollDownButton = document.querySelector('.scroll-down');
            if (scrollDownButton) {
                scrollDownButton.addEventListener('click', (e) => {
                    const featuresSection = document.getElementById('features');
                    if (featuresSection) {
                        e.preventDefault();
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
    </script>
</body>

</html>