<section id="gallery" class="py-20 relative overflow-hidden">
    <div class="container mx-auto px-4 gallery-content-container relative z-10">
        <h2 class="text-3xl md:text-4xl font-bold mb-12 text-center text-heading-color">Visual Escapes</h2>

        <div x-data="{
            activeSlide: 0,
            slides: [],
            init() {
                this.slides = Array.from(document.querySelectorAll('.gallery-slide'));
            },
            next() {
                this.activeSlide = (this.activeSlide + 1) % this.slides.length;
            },
            prev() {
                this.activeSlide = (this.activeSlide - 1 + this.slides.length) % this.slides.length;
            }
        }" class="relative overflow-hidden">

            <!-- Slides -->
            <div class="flex transition-transform duration-500 ease-in-out"
                 :style="'transform: translateX(-' + activeSlide * 100 + '%)'">
                <?php
                include 'connection.php';
                $query = "SELECT img_url, img_alt, label FROM gallery_images";
                $result = Database::iud($query);

                if ($result && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '<div class="gallery-slide min-w-full relative">';
                        echo '<img src="' . htmlspecialchars($row['img_url']) . '" alt="' . htmlspecialchars($row['img_alt']) . '" class="w-full h-64 object-cover rounded-lg shadow-md">';
                        echo '<span class="absolute bottom-3 left-3 bg-black bg-opacity-60 text-white text-xs px-2 py-1 rounded">' . htmlspecialchars($row['label']) . '</span>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="gallery-slide min-w-full text-center">No images available.</div>';
                }
                ?>
            </div>

            <!-- Navigation buttons -->
            <button @click="prev" class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-800 bg-opacity-50 text-white px-3 py-2 rounded-r">
                &#10094;
            </button>
            <button @click="next" class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-800 bg-opacity-50 text-white px-3 py-2 rounded-l">
                &#10095;
            </button>
        </div>
    </div>
</section>
