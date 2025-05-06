<?php
// Include your database connection class
// Adjust path if needed
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery Carousel</title>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="./src/css/style.css">
    <style>
        /* Custom Swiper Styles (from your example) */
        .progress-slide-carousel .swiper-wrapper {
            width: 100%;
            height: max-content !important;
            /* Adjust if needed */
            padding-bottom: 64px !important;
            /* Space for pagination */
            -webkit-transition-timing-function: linear !important;
            transition-timing-function: linear !important;
            position: relative;
        }


    </style>
</head>

<body class="bg-gray-100">

    <section id="gallery" class="py-20 relative overflow-hidden">
        <div class="container mx-auto px-4 gallery-content-container relative z-10">
            <h2 class="text-3xl md:text-4xl font-bold mb-12 text-center text-heading-color tagesschrift">Visual Escapes</h2>

            <div class="w-full relative">
                <div class="swiper progress-slide-carousel swiper-container relative">
                    <div class="swiper-wrapper">
                        <?php
                        // --- PHP Database Fetching Logic ---

                        // Define your query - REPLACE with your actual table and column names
                        // Added ORDER BY clause - assuming you have an 'id' or 'display_order' column
                        $query = "SELECT img_url, location FROM gallery ORDER BY id ASC"; // <-- ADJUST TABLE/COLUMN NAMES & ORDERING

                        // Execute the query using the new 'search' method
                        $resultSet = Database::search($query);

                        // Check if the query was successful and returned rows
                        if ($resultSet && $resultSet->num_rows > 0) {
                            // Loop through each row in the result set
                            while ($row = $resultSet->fetch_assoc()) {
                                // Get image path and location name - Use htmlspecialchars for security
                                $imagePath = isset($row['img_url']) ? htmlspecialchars($row['img_url']) : 'path/to/default/image.jpg'; // <-- Provide a default image path
                                $locationName = isset($row['location']) ? htmlspecialchars($row['location']) : 'Unknown Location'; // <-- Provide default text

                                // --- Generate the HTML for each slide ---
                                echo '<div class="swiper-slide">';
                                echo '    <div class="relative">';
                                echo '        <img src="' . $imagePath . '" alt="' . $locationName . '" class="w-full h-96 object-cover rounded-lg shadow-md">';
                                echo '        <span class="absolute bottom-2 right-2 bg-black bg-opacity-60 text-white text-xs px-2 py-1 rounded tinos">';
                                echo            $locationName; // Already escaped with htmlspecialchars
                                echo '        </span>';
                                echo '    </div>'; // Closing relative div
                                echo '</div>'; // Closing swiper-slide div
                                // --- End of slide HTML generation ---
                            }
                        } else {
                            // Optional: Display a message if no images are found
                            echo '<div class="text-center text-gray-500 py-8">No gallery images found.</div>';
                            // Log if result set failed
                            if ($resultSet === false) {
                                error_log("Failed to retrieve gallery images from database.");
                            }
                        }

                        // Optional: Close connection if you added the method
                        // Database::closeConnection();

                        // --- End of PHP Logic ---
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

    <script>
        var swiper = new Swiper(".progress-slide-carousel", {
            loop: <?php echo ($resultSet && $resultSet->num_rows > 1) ? 'true' : 'false'; ?>, // Enable loop only if there's more than one slide
            autoplay: {
                delay: 3000,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".progress-slide-carousel .swiper-pagination",
                type: "progressbar",
            },
            slidesPerView: 1, // Show one slide at a time on mobile
            spaceBetween: 10, // Space between slides
            // Responsive breakpoints
            breakpoints: {
                // when window width is >= 640px (sm)
                640: {
                    slidesPerView: 2,
                    spaceBetween: 20
                },
                // when window width is >= 1024px (lg)
                1024: {
                    slidesPerView: 3, // Adjust based on your preference
                    spaceBetween: 30
                }
            },
            // Conditionally disable autoplay/loop if only one slide
            on: {
                init: function() {
                    if (this.slides.length <= 1) {
                        this.params.loop = false;
                        this.params.autoplay.delay = 999999; // Effectively disable autoplay
                        // Optionally hide pagination if only one slide
                        // if (this.pagination.el) {
                        //     this.pagination.el.style.display = 'none';
                        // }
                    }
                    this.update(); // Update Swiper instance with new params
                },
            }
        });
    </script>

</body>

</html>