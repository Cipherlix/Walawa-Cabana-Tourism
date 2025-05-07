<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        
    </style>
</head>

<body>
    <section id="reviews" class="py-20 relative overflow-hidden">
        <div id="reviewsCanvasContainer" class="p5-container"> <canvas id="reviewsCanvas"></canvas> </div>
        <div class="container mx-auto px-4 relative z-10">
            <h2 class="text-3xl md:text-4xl font-bold mb-12 text-center text-heading-color">Hear From Our Happy Guests</h2>

            <div class="w-full relative">
                <div class="swiper progress-slide-carousel swiper-container relative">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="review-card-content">
                                <div class="flex items-center mb-4">
                                    <img src="https://via.placeholder.com/48x48.png/7AE2CF/06202B?text=SM" alt="Sarah M." class="w-12 h-12 rounded-full mr-4">
                                    <div>
                                        <h4 class="font-semibold text-heading-color">Sarah M.</h4>
                                        <?php
                                        $rating = 5; // Change this to whatever rating you want (e.g., 3, 4, etc.)

                                        for ($i = 0; $i < $rating; $i++): ?>
                                            <div class="inline-block text-yellow-400">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                                </svg>
                                            </div>
                                        <?php endfor; ?>

                                    </div>
                                </div>
                                <p class="text-muted italic text-base">"Our honeymoon at Walawa Cabana was magical. The private cabana, the views, the candlelit dinner... pure bliss. The staff made it unforgettable."</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="review-card-content">
                                <div class="flex items-center mb-4">
                                    <img src="https://via.placeholder.com/48x48.png/7AE2CF/06202B?text=SM" alt="Sarah M." class="w-12 h-12 rounded-full mr-4">
                                    <div>
                                        <h4 class="font-semibold text-heading-color">Sarah M.</h4>
                                        <div class="flex text-yellow-400">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-muted italic text-base">"Our honeymoon at Walawa Cabana was magical. The private cabana, the views, the candlelit dinner... pure bliss. The staff made it unforgettable."</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="review-card-content">
                                <div class="flex items-center mb-4">
                                    <img src="https://via.placeholder.com/48x48.png/7AE2CF/06202B?text=SM" alt="Sarah M." class="w-12 h-12 rounded-full mr-4">
                                    <div>
                                        <h4 class="font-semibold text-heading-color">Sarah M.</h4>
                                        <div class="flex text-yellow-400">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-muted italic text-base">"Our honeymoon at Walawa Cabana was magical. The private cabana, the views, the candlelit dinner... pure bliss. The staff made it unforgettable."</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="review-card-content">
                                <div class="flex items-center mb-4">
                                    <img src="https://via.placeholder.com/48x48.png/7AE2CF/06202B?text=SM" alt="Sarah M." class="w-12 h-12 rounded-full mr-4">
                                    <div>
                                        <h4 class="font-semibold text-heading-color">Sarah M.</h4>
                                        <div class="flex text-yellow-400">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-muted italic text-base">"Our honeymoon at Walawa Cabana was magical. The private cabana, the views, the candlelit dinner... pure bliss. The staff made it unforgettable."</p>
                            </div>
                        </div>
                        <div class="swiper-slide">
                            <div class="review-card-content">
                                <div class="flex items-center mb-4">
                                    <img src="https://via.placeholder.com/48x48.png/7AE2CF/06202B?text=SM" alt="Sarah M." class="w-12 h-12 rounded-full mr-4">
                                    <div>
                                        <h4 class="font-semibold text-heading-color">Sarah M.</h4>
                                        <div class="flex text-yellow-400">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </div>
                                <p class="text-muted italic text-base">"Our honeymoon at Walawa Cabana was magical. The private cabana, the views, the candlelit dinner... pure bliss. The staff made it unforgettable."</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
</body>

</html>