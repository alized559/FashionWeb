<!DOCTYPE html>
<html lang="en">
<head>
    <title>Fashion | Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="imgs/favicon.ico" type="image/x-icon">
    <?php include "header.php"; ?>
    <link href="css/main.css" rel="stylesheet" media="screen">
</head>
<body>
    <div class="landingContainer">
        <div class="landingImageContainer">
            <img class="landingImage" src="imgs/landing/background_image_1.jpg" alt="Background Image">
            
        </div>
        <h3 class="landingPopularTitle">Popular Right Now</h3>
        <div class="showMoreDiv">
            <a href="#">Show More</a>
        </div>
        <div class="row">
            <div class="col-12 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                <a href="#" class="text-reset">
                    <div class="landingPopularContainer">
                        <div class="landingPopularItemImage">
                            <img src="imgs/landing/popular_image_1.jpg" alt="Popular Image">
                        </div>
                        <div class="landingPopularItemTitle">
                            <p class="title">Diamon Jewerley</p>
                            <p class="price">500$</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                <a href="#" class="text-reset">
                    <div class="landingPopularContainer">
                        <div class="landingPopularItemImage">
                            <img src="imgs/landing/popular_image_2.jpg" alt="Popular Image">
                        </div>
                        <div class="landingPopularItemTitle">
                            <p class="title">Black Hat</p>
                            <p class="price">20$</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                <a href="#" class="text-reset">
                    <div class="landingPopularContainer">
                        <div class="landingPopularItemImage">
                            <img src="imgs/landing/popular_image_2.jpg" alt="Popular Image">
                        </div>
                        <div class="landingPopularItemTitle">
                            <p class="title">Black Hat</p>
                            <p class="price">20$</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-12 col-sm-4 col-md-3 col-lg-3 col-xl-2">
                <a href="#" class="text-reset">
                    <div class="landingPopularContainer">
                        <div class="landingPopularItemImage">
                            <img src="imgs/landing/popular_image_2.jpg" alt="Popular Image">
                        </div>
                        <div class="landingPopularItemTitle">
                            <p class="title">Black Hat</p>
                            <p class="price">20$</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
        <h3 class="landingPopularSubTitle">New Drops</h3>
        <div id="newDropsCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <a href="#" class="text-reset">
                        <img class="d-block w-100" src="imgs/landing/drops_image_1.jpg" alt="First slide">
                        <div class="newDropItemTitle">
                            <hr>
                            <h1>Nike Aireforce 1<h1>
                        </div>
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="#" class="text-reset" style="text-decoration: none;">
                        <img class="d-block w-100" src="imgs/landing/drops_image_2.jpg" alt="First slide">
                        <div class="newDropItemTitle">
                            <hr>
                            <h1>Lavola Hoodies<h1>
                        </div>
                    </a>
                </div>
            </div>
            <a class="carousel-control-prev" href="#newDropsCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#newDropsCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>

<?php include "footer.php"; ?>
</body>
</html>