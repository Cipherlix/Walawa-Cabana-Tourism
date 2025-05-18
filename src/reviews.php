<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Guest Reviews</title> 
</head>

<body>
    <?php
    // Include your database connection class
    require_once 'connction.php'; // Make sure the path to connction.php is correct

    // Initialize an array to hold reviews
    $reviews = [];

    // Fetch reviews from the database
    $query = "SELECT review.msg, review.star, users.f_name, users.l_name 
              FROM review 
              INNER JOIN users ON review.users_id = users.id 
              ORDER BY review.id DESC"; // Fetch latest reviews first, or any order you prefer

    $result = Database::search($query);

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $reviews[] = $row;
        }
    } else {
        echo "<p class='text-center'>No reviews yet.</p>"; // Optional: message if no reviews
    }
    // It's good practice to close the connection if your Database class doesn't do it automatically after search
    // Database::closeConnection(); // Uncomment if your class requires manual closing after search
    ?>

    <section id="reviews" class="py-20 relative overflow-hidden">
        <div id="reviewsCanvasContainer" class="p5-container"> <canvas id="reviewsCanvas"></canvas> </div>
        <div class="container mx-auto px-4 relative z-10">
            <h2 class="text-3xl md:text-4xl font-bold mb-12 text-center text-heading-color tagesschrift">Hear From Our Happy Guests</h2>

            <?php if (!empty($reviews)) : ?>
                <div class="w-full relative">
                    <div class="swiper progress-slide-carousel swiper-container relative">
                        <div class="swiper-wrapper">
                            <?php foreach ($reviews as $review) : ?>
                                <?php
                                // Prepare user initials for the placeholder image
                                $initials = '';
                                if (!empty($review['f_name'])) {
                                    $initials .= strtoupper(substr($review['f_name'], 0, 1));
                                }
                                if (!empty($review['l_name'])) {
                                    $initials .= strtoupper(substr($review['l_name'], 0, 1));
                                }
                                if (empty($initials)) {
                                    $initials = 'GU'; // Guest User as fallback
                                }
                                ?>
                                <div class="swiper-slide">
                                    <div class="review-card-content">
                                        <div class="flex items-center mb-4">
                                            <div>
                                                <h4 class="font-semibold text-heading-color tinos"><?php echo htmlspecialchars($review['f_name'] . ' ' . $review['l_name']); ?></h4>
                                                <?php
                                                $rating = isset($review['star']) ? (int)$review['star'] : 0;
                                                for ($i = 0; $i < 5; $i++) : // Loop 5 times for 5 stars
                                                ?>
                                                    <div class="inline-block <?php echo ($i < $rating) ? 'text-yellow-400' : 'text-gray-300'; ?>">
                                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                        </svg>
                                                    </div>
                                                <?php endfor; ?>
                                            </div>
                                        </div>
                                        <p class="text-muted italic text-base tinos">"<?php echo nl2br(htmlspecialchars($review['msg'])); ?>"</p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        </div>
                </div>
            <?php else : ?>
                <p class="text-center text-muted">We don't have any guest reviews yet. Be the first to share your experience!</p>
            <?php endif; ?>
        </div>
    </section>

    </body>

</html>