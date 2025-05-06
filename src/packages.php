<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<section id="packages" class="py-20 section-subtle-bg">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl md:text-4xl font-bold mb-4 text-center text-heading-color tagesschrift">🌿 Our Packages 🌿</h2>
            <p class="text-lg text-center mb-12 max-w-3xl mx-auto text-text-color tinos">
                Discover the perfect stay package tailored to your desires, from romantic escapes to thrilling adventures.
            </p>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 md:gap-8">
                <?php

                $query = "SELECT id, name, sub_title, discription, price, img_url FROM packages";
                $result = Database::iud($query);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="package-card overflow-hidden">';
                        echo '<img src="' . htmlspecialchars($row['img_url']) . '" alt="' . htmlspecialchars($row['img_alt']) . '" class="w-full h-48 object-cover tinos">';
                        echo '<div class="p-6">';
                        echo '<div>';
                        echo '<h3 class="text-xl font-semibold mb-2 text-heading-color tagesschrift">' . htmlspecialchars($row['package_name']) . '</h3>';
                        echo '<p class="text-md text-text-muted-color mb-2 tagesschrift">' . htmlspecialchars($row['sub_title']) . '</p>';
                        // OUTPUT DESCRIPTION WITH <br/> TAGS AS HTML
                        echo '<p class="text-muted mb-4 text-sm tinos">' . $row['discription'] . '</p>';
                        echo '</div>';
                        echo '<div class="flex items-center justify-between mt-4">';
                        echo '<span class="text-accent-color font-bold tinos">From LKR.' . htmlspecialchars($row['price']) . '/night</span>';
                        echo '<a href="#booking" class="bg-button-color text-white px-4 py-2 rounded-full text-sm hover:bg-opacity-90 transition-colors tagesschrift">Book Now</a>';
                        echo '</div>';
                        echo '</div>';
                        echo '</div>';
                    }
                } else {
                    echo '<p class="col-span-full text-center text-text-color tinos">No packages available at the moment. Please check back later.</p>';
                }
                ?>
            </div>
        </div>
    </section>
</body>
</html>