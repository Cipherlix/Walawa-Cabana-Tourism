<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <nav class="fixed top-0 left-0 w-full z-50" id="navbar">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="#home" class="flex items-center flex-shrink-0" aria-label="Walawa Cabana Home">
                <span class="text-xl md:text-2xl font-bold nav-text-color tagesschrift">Walawa Cabana</span>
            </a>

            <div class="hidden lg:flex items-center space-x-6">
                <a href="#home" class="nav-link nav-text-color tagesschrift">Home</a>
                <a href="#about" class="nav-link nav-text-color tagesschrift">About</a>
                <a href="#packages" class="nav-link nav-text-color tagesschrift">Packages</a>
                <a href="#gallery" class="nav-link nav-text-color tagesschrift">Gallery</a>
                <a href="#whyus" class="nav-link nav-text-color tagesschrift">Why Us</a>
                <a href="#booking" class="nav-link nav-text-color tagesschrift">Booking</a>
                <a href="#reviews" class="nav-link nav-text-color tagesschrift">Reviews</a>
                <a href="#contact" class="nav-link nav-text-color tagesschrift">Contact</a>
                <button class="cta-button px-5 py-2 text-white font-medium text-sm tagesschrift"><a href="#" class="text-decoration-none">Sign In</a></button>
            </div>

            <div class="lg:hidden">
                <button id="menuButton" class="nav-text-color focus:outline-none p-2" aria-label="Open Menu">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </nav>

    <div class="mobile-menu lg:hidden" id="mobileMenu">
        <div class="flex justify-end mb-4">
            <button id="closeMenu" class="text-text-color focus:outline-none p-2" aria-label="Close Menu">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        <div class="flex flex-col space-y-2 mt-4">
            <a href="#home" class="nav-link text-lg tinos">Home</a>
            <a href="#about" class="nav-link text-lg tinos">About</a>
            <a href="#packages" class="nav-link text-lg tinos">Packages</a>
            <a href="#gallery" class="nav-link text-lg tinos">Gallery</a>
            <a href="#whyus" class="nav-link text-lg tinos">Why Us</a>
            <a href="#booking" class="nav-link text-lg tinos">Booking</a>
            <a href="#reviews" class="nav-link text-lg tinos">Reviews</a>
            <a href="#contact" class="nav-link text-lg tinos">Contact</a>
            <button class="cta-button px-5 py-3 text-white font-medium w-full mt-6 text-base tinos"><a href="#" class="text-decoration-none">Sign In</a></button>
        </div>
    </div>
</body>

</html>