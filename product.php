<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion | Products</title>
    <link href="css/product.css" rel="stylesheet" media="screen">

    <?php include('header.php') ?>
</head>
<body>
    <div class="image-container">
        <img class="backImg" src="imgs/landing/drops_image_1.jpg" alt="Background Image">
        <img class="productImg" src="imgs/shoe.png" alt="Product Image">
    </div>

    <div class="favorite">
        <i class="fa fa-heart"></i>
    </div>

    <div class="container-fluid">
        <h3 class="product-title">Nike Air Force 1</h3>

        <p class="choose-text">Choose An Item Below</p>

        <div class="product-flex">
            <div class="product-default">
                <img id="default-img" src="imgs/shoe.png" alt="Product Image">
            </div>

            <div class="product-colors">
                <div id="gallery" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <div class="colors-flex">
                                <img class="color-img hasBorder" src="imgs/shoe.png" alt="Product Image">
                                <img class="color-img" src="imgs/shoe_black.png" alt="Product Image">
                                <img class="color-img" src="imgs/shoe_black_red.png" alt="Product Image">
                                <img class="color-img" src="imgs/shoe_black_white.png" alt="Product Image">
                            </div>
                        </div>
                        <div class="carousel-item">
                            <div class="colors-flex">
                                <img class="color-img" src="imgs/shoe_beige.png" alt="Product Image">
                                <img class="color-img" src="imgs/shoe_pink.png" alt="Product Image">
                                <img class="color-img" src="imgs/shoe_white.png" alt="Product Image">
                            </div>
                        </div>
                        
                    </div>

                    <a class="carousel-control-prev" href="#gallery" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>

                    <a class="carousel-control-next" href="#gallery" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>

        <form>

            <div class="details-flex">
                <div class="name-price-size">
                    <div class="name-price-flex">
                        <h3>Cactus Jack</h3>
                        <div class="price">299.99$</div>
                    </div>

                    <div class="size">
                        <h4>Size</h4>
                        <select name="select">
                            <option>33.5</option>
                            <option>34</option>
                            <option>35</option>
                            <option>36</option>
                            <option>40</option>
                        </select>
                    </div>
                </div>

                <div class="product-details">
                    <h3>Product Details</h3>

                    <div class="details-flex">
                        <div class="detail-col-1">
                            <h5>Package Dimensions</h5>
                            <h5>Department</h5>
                            <h5>Available</h5>
                            <h5>Rating</h5>
                        </div>

                        <div class="detail-col-2">
                            <p>
                                13.78 x 9.13 x 4.65 inches; 2.5 Pounds
                                <br>
                                Men
                                <br>
                                20 Pairs
                                <br>
                                <span class="rating-flex" id="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="prod-desc">
                <h3>Product Description</h3>
                <p>Nike shoes are the foundation of the sneaker collecting hobby as we know it today. The legacy of the most famous 
                    brand in sneakers began in the 1970s when the legendary Oregon track coach Bill Bowerman began cobbling 
                    together his own custom-made track spikes and racing flats, eventually pairing with former runner Phil Knight to 
                    found the Nike brand in 1972. Nike gained popularity outside of performance athletics during the early 1980s with 
                    models such as the Nike Air Force 1, Nike Dunk, and Air Jordan 1, which all became hit lifestyle sneakers on the 
                    streets. Nike’s popularity continued to snowball in the 1990s with even more now-iconic models including the Nike 
                    Air Max 90, Nike Air Max 95, and Air Jordan 11. Today, Nike is regarded by many as the most stylish and innovative 
                    athletic footwear brand in the industry, constantly pushing boundaries in fashion and performance.
                </p>
            </div>

            <button id="add" class="btn" style="height: 40px; margin-top: 30px; background-color: #ffd814; border-radius: 10px; font-weight: bold; width: 200px;">Add To Cart</button>

            <div class="reviews">
                <h3>Customer Reviews</h3>
                <div id="reviews">
                    <div class="review-box">
                        <img src="imgs/user_photo.png" alt="User Image">
                        <div class="vertical-line"></div>
                        <div class="column">
                            <h5>John</h5>
                            <p>Great Product, Feels So Comfy The Colors Are Amazing!!
                            <span class="rating-flex" id="rating1">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </span>
                            </p>
                        </div>
                    </div>
                        
                    <div class="review-box">
                        <img src="imgs/user_photo.png" alt="User Image">
                        <div class="vertical-line"></div>
                        <div class="column">
                            <h5>John</h5>
                            <p>Great Product, Feels So Comfy The Colors Are Amazing!!
                            <span class="rating-flex" id="rating2">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </span>
                            </p>
                        </div>
                    </div>
                </div>

                <div id="reviews">
                    <div class="review-box">
                        <img src="imgs/user_photo.png" alt="User Image">
                        <div class="vertical-line"></div>
                        <div class="column">
                            <h5>John</h5>
                            <p>Great Product, Feels So Comfy The Colors Are Amazing!!
                            <span class="rating-flex" id="rating3">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </span>
                            </p>
                        </div>
                    </div>

                    <div class="review-box">
                        <img src="imgs/user_photo.png" alt="User Image">
                        <div class="vertical-line"></div>
                        <div class="column">
                            <h5>John</h5>
                            <p>Great Product, Feels So Comfy The Colors Are Amazing!!
                            <span class="rating-flex" id="rating4">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                            </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>

    <?php include('footer.php') ?>
</body>

<script>
    $('.color-img').click(function() {
        var $this = $(this);
        if ($this.hasClass('hasBorder')) {
            $this.removeClass('hasBorder');
        } else {
            $('.hasBorder').removeClass('hasBorder');
            $this.addClass('hasBorder');
            document.getElementById('default-img').src = $this.attr('src');
        }
    });

    var ratingLength = 4; // get from php, this is for product review

    // get from php, this is for four reviews
    var rating1Length = 4; 
    var rating2Length = 5;
    var rating3Length = 3; 
    var rating4Length = 2;

    const rating = document.getElementById('rating');
    const rating1 = document.getElementById('rating1');
    const rating2 = document.getElementById('rating2');
    const rating3 = document.getElementById('rating3');
    const rating4 = document.getElementById('rating4');
    for (let i = 0; i < rating.children.length; i++) {
        if (i >= ratingLength) {
            rating.children[i].style.color = "rgb(183, 183, 183)";
        } else {
            rating.children[i].style.color = "#ffd814";
        }

        if (i >= rating1Length) {
            rating1.children[i].style.color = "rgb(183, 183, 183)";
        } else {
            rating1.children[i].style.color = "#ffd814";
        }

        if (i >= rating2Length) {
            rating2.children[i].style.color = "rgb(183, 183, 183)";
        } else {
            rating2.children[i].style.color = "#ffd814";
        }

        if (i >= rating3Length) {
            rating3.children[i].style.color = "rgb(183, 183, 183)";
        } else {
            rating3.children[i].style.color = "#ffd814";
        }

        if (i >= rating4Length) {
            rating4.children[i].style.color = "rgb(183, 183, 183)";
        } else {
            rating4.children[i].style.color = "#ffd814";
        }
    }

    $("#add").hover(
        function() {
            document.getElementById('add').style.backgroundColor = "#fbea94";
        }, function() {
            document.getElementById('add').style.backgroundColor = "#ffd814";
        }
    );

    $('.carousel').carousel({
        interval: false,
    });
</script>

</html>