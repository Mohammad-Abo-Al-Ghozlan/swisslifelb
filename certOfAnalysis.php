<?php require_once('header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:title" content="SwissLife Lebanon">
    <meta property="og:description" content="Get the best medicines in Lebanon.">
    <meta property="og:image" content="assets/uploads/<?php echo $favicon; ?>">
    <meta property="og:url" content="https://www.swisslifelb.com">
    <title>Animated Image Slider</title>
    <style>
        .image-slider {
            width: 100%;
            overflow: hidden;
            position: relative;
            height: 380px;
            max-height: 100%;
        }
        .image-container {
            display: flex;
            align-items: center; /* Center images vertically */
            transition: transform 0.5s linear;
            height: 100%; /* Ensures the container is as tall as the slider */
        }
        .image-container img {
            width: 200px;
            height: auto;
            margin-right: 10px;
            flex-shrink: 0;
        }
        @media (max-width: 768px) {
            .image-container img {
                width: 150px;
            }
        }
        @media (max-width: 480px) {
            .image-container img {
                width: 100px;
            }
        }
    </style>
</head>
<body>
    <?php require_once('header.php'); ?>

    <div class="image-slider">
        <div class="image-container">
            <img src="assets/img/im1.jpeg" alt="Image 1">
            <img src="assets/img/im2.jpeg" alt="Image 2">
            <img src="assets/img/img3.jpeg" alt="Image 3">
            <img src="assets/img/img4.jpeg" alt="Image 4">
            <img src="assets/img/img5.jpeg" alt="Image 5">
            <img src="assets/img/img6.jpeg" alt="Image 6">
            <img src="assets/img/img7.jpeg" alt="Image 7">
            <img src="assets/img/img8.jpeg" alt="Image 8">
            <!-- Cloning the images for seamless infinite scrolling -->
            <img src="assets/img/im1.jpeg" alt="Image 1 Clone">
            <img src="assets/img/im2.jpeg" alt="Image 2 Clone">
            <img src="assets/img/img3.jpeg" alt="Image 3 Clone">
            <img src="assets/img/img4.jpeg" alt="Image 4 Clone">
            <img src="assets/img/img5.jpeg" alt="Image 5 Clone">
            <img src="assets/img/img6.jpeg" alt="Image 6 Clone">
            <img src="assets/img/img7.jpeg" alt="Image 7 Clone">
            <img src="assets/img/img8.jpeg" alt="Image 8 Clone">
            <!-- Cloning the images for seamless infinite scrolling -->
            <img src="assets/img/im1.jpeg" alt="Image 1 Clone">
            <img src="assets/img/im2.jpeg" alt="Image 2 Clone">
            <img src="assets/img/img3.jpeg" alt="Image 3 Clone">
            <img src="assets/img/img4.jpeg" alt="Image 4 Clone">
            <img src="assets/img/img5.jpeg" alt="Image 5 Clone">
            <img src="assets/img/img6.jpeg" alt="Image 6 Clone">
            <img src="assets/img/img7.jpeg" alt="Image 7 Clone">
            <img src="assets/img/img8.jpeg" alt="Image 8 Clone">
        </div>
    </div>

    <script>
        const container = document.querySelector('.image-container');
        let position = 0;
        const speed = 1; // Speed of the animation in pixels per frame

        function moveImages() {
            position += speed;
            container.style.transform = `translateX(-${position}px)`;

            // Reset position once the first half of the images (original set) is out of view
            if (position >= container.scrollWidth / 2) {
                position = 0; // Reset position to the start
            }

            requestAnimationFrame(moveImages);
        }

        // Start the animation
        moveImages();
    </script>
</body>
</html>

<?php require_once('footer.php'); ?>
