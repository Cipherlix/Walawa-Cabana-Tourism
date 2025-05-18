<?php include "connction.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Walawa Cabana Lake Resort</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.4.0/p5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.9.1/ScrollTrigger.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="icon" href="./assets/images/walawa-official-logo.png">
</head>

<body class="bg-bg-color text-text-color">
    <div class="preloader" id="preloader">
        <div class="infinityChrome">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <div class="infinity">
            <div><span></span></div>
            <div><span></span></div>
            <div><span></span></div>
        </div>
        <svg xmlns="http://www.w3.org/2000/svg" version="1.1" class="hidden-svg">
            <defs>
                <filter id="goo">
                    <feGaussianBlur in="SourceGraphic" stdDeviation="6" result="blur" />
                    <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 18 -7" result="goo" />
                    <feBlend in="SourceGraphic" in2="goo" />
                </filter>
            </defs>
        </svg>
    </div>

    <?php include('navbar.php') ?>

    <section id="home" class="relative h-screen flex items-center justify-center overflow-hidden text-center bg-cover bg-center" style="background-image: url('./assets/images/cabana/bg-hero.jpg');">

        <!-- Bottom Gradient Overlay -->
        <div class="absolute bottom-0 left-0 w-full h-32 bg-gradient-to-t from-[#06202B] to-transparent pointer-events-none z-0"></div>

        <div id="heroCanvasContainer">
            <canvas id="heroCanvas"></canvas>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 text-heading-color drop-shadow-lg animate-fade-in-up tagesschrift">
                Experience Serenity at <br>Walawa Cabana Lake Resort
            </h1>
            <p class="text-xl md:text-2xl mb-10 text-text-color drop-shadow-md max-w-2xl mx-auto animate-fade-in-up animation-delay-300 tinos">
                Escape to a peaceful lakeside retreat where nature and luxury blend seamlessly.
            </p>
            <a href="#booking" class="cta-button inline-block px-8 py-4 text-xl font-medium animate-fade-in-up animation-delay-600 tagesschrift">
                Book Your Escape
            </a>
        </div>

        <div class="scroll-indicator z-10">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </section>


    <section id="about" class="py-20 relative overflow-hidden">
        <div id="aboutCanvasContainer" class="p5-container">
            <canvas id="aboutCanvas"></canvas>
        </div>

        <div class="container mx-auto px-4 relative z-10">
            <h2 class="text-3xl md:text-4xl font-bold mb-12 text-center text-heading-color tagesschrift">
                About Walawa Cabana Lake Resort
            </h2>

            <div class="flex flex-col md:flex-row items-center gap-8 md:gap-12">
                <div class="md:w-1/2">
                    <img src="./assets/images/cabana/c16.jpg" alt="Peaceful cabana by the lake"
                        class="rounded-lg shadow-lg w-full h-auto object-cover">
                </div>

                <div class="md:w-1/2 text-lg">
                    <h3 class="text-2xl font-semibold mb-4 text-accent-color tagesschrift">Our Story</h3>
                    <p class="mb-6 text-text-color tinos">
                        Nestled on the shores of serene Lake Walawa, our eco-luxury resort offers an unparalleled retreat from the hustle of everyday life. Founded with a vision to harmonize luxury and nature, every element is designed for comfort while honoring our surroundings.
                    </p>
                    <p class="mb-8 text-text-color tinos">
                        Our lakefront cabanas provide privacy and stunning views, built with sustainable practices. We're committed to responsible tourism, benefiting both guests and the environment through eco-friendly initiatives and local partnerships.
                    </p>

                    <div class="flex space-x-6 justify-center md:justify-start">
                        <div class="text-center">
                            <span class="block text-3xl font-bold text-accent-color count-up" data-target="24">0</span>
                            <span class="text-sm text-text-muted-color">Luxury Cabanas</span>
                        </div>
                        <div class="text-center">
                            <span class="block text-3xl font-bold text-accent-color count-up" data-target="150">0</span>
                            <span class="text-sm text-text-muted-color">Acres of Nature</span>
                        </div>
                        <div class="text-center">
                            <span class="block text-3xl font-bold text-accent-color count-up" data-target="8" data-suffix="+">0</span>
                            <span class="text-sm text-text-muted-color">Unique Packages</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include "packages.php" ?>

    <?php include "gallery.php" ?>

    <section id="whyus" class="py-20 section-subtle-bg">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold mb-12 text-center text-heading-color tagesschrift">Why Us?</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8 text-center">
                <div class="why-us-item">
                    <div class="bg-accent-color bg-opacity-10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 icon-container">
                        <svg class="w-8 h-8 text-accent-color" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-heading-color tagesschrift">Lakefront Views</h3>
                    <p class="text-muted tinos">Unobstructed, breathtaking views of Lake Walawa from every cabana.</p>
                </div>
                <div class="why-us-item">
                    <div class="bg-accent-color bg-opacity-10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 icon-container">
                        <svg class="w-8 h-8 text-accent-color" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c1.356 0 2.676-.68 3.48-1.824M12 21c-1.356 0-2.676-.68-3.48-1.824M12 3c1.356 0 2.676.68 3.48 1.824M12 3c-1.356 0-2.676.68-3.48 1.824M12 3L11.1 5.093a9.002 9.002 0 00-2.18 1.99M12 3l.9 2.093A9.002 9.002 0 0114.18 7.083M12 21l.9-2.093a9.002 9.002 0 002.18-1.99M12 21l-.9-2.093a9.002 9.002 0 01-2.18-1.99M5.642 7.083a9.002 9.002 0 01-1.482 4.175M18.358 7.083a9.002 9.002 0 00-1.482 4.175M3.253 14.253a9.003 9.003 0 010-4.5M20.747 14.253a9.003 9.003 0 000-4.5M5.642 16.917a9.002 9.002 0 011.482-4.175M18.358 16.917a9.002 9.002 0 001.482-4.175" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-heading-color tagesschrift">Eco-Friendly</h3>
                    <p class="text-muted tinos">Sustainable construction and practices preserving natural beauty.</p>
                </div>
                <div class="why-us-item">
                    <div class="bg-accent-color bg-opacity-10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 icon-container">
                        <svg class="w-8 h-8 text-accent-color" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.008v.008H12v-.008z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-heading-color tagesschrift">Private & Peaceful</h3>
                    <p class="text-muted tinos">Secluded cabanas thoughtfully designed for ultimate tranquility.</p>
                </div>
                <div class="why-us-item">
                    <div class="bg-accent-color bg-opacity-10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 icon-container">
                        <svg class="w-8 h-8 text-accent-color" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 12.75a.75.75 0 000-1.5H5.625a.75.75 0 000 1.5h6.375zm3.75-3a.75.75 0 000-1.5H8.625a.75.75 0 000 1.5h7.125zm3.75 3a.75.75 0 000-1.5h-2.625a.75.75 0 000 1.5h2.625z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-heading-color tagesschrift">Local Experiences</h3>
                    <p class="text-muted tinos">Authentic cultural immersion through curated local activities.</p>
                </div>
                <div class="why-us-item">
                    <div class="bg-accent-color bg-opacity-10 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4 icon-container">
                        <svg class="w-8 h-8 text-accent-color" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.646.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 1.555c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.333.184-.582.496-.646.87l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.063-.374-.313-.686-.646-.87-.074-.04-.147-.083-.22-.127-.324-.196-.72-.257-1.075-.124l-1.217.456a1.125 1.125 0 01-1.37-.49l-1.296-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.759 6.759 0 010-1.555c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.184.582-.496.646-.87l.213-1.28z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold mb-3 text-heading-color tagesschrift">Custom Packages</h3>
                    <p class="text-muted tinos">Tailor your stay with bespoke activities and services for a perfect fit.</p>
                </div>
            </div>
        </div>
    </section>

    <?php include "booking.php"?>

    <?php include "reviews.php"?>

    <?php include "contact.php"?>

    <?php include('footer.php') ?>
    <script src="./js/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</body>

</html>