<?php
    $id = $_GET["id"] ?? 0;
    include "includes/config.php";
    if($id == 0){
        die("Invalid Product, No Content Was Found");
    }

    $sql = "SELECT * FROM products WHERE prod_id='$id'";
    $result = mysqli_query($db, $sql);

    $name = "";
    $description = "";
    $details = "";
    $price = 0;
    $delivery_time = 0;
    $discount = 0;
    $likes = 0;
    $department = "m";
    $category = "shoes";
    $brand = "Local Brand";
    $imagefile = "";
    $bannerfile = "";

    if($result){
        if(mysqli_num_rows($result) == 1){
            while($row = mysqli_fetch_assoc($result)){
                $name = $row["name"];
                $description = $row["description"];
                $details = $row["details"];
                $price = $row["price"];
                $delivery_time = $row["delivery_time"];
                $likes = $row["likes"];
                $discount = $row["discount"];
                $department = $row["department"];
                $category = $row["category"];
                $brand = $row["brand"];

                $file = "images/products/" . $id . "/logo.jpg";

                if(!file_exists($file)){//Deletes the image if it exists
                    $file = "images/products/" . $id . "/logo.png";
                    if(!file_exists($file)){//Deletes the image if it exists
                        $file = "images/products/" . $id . "/logo.gif";
                        if(!file_exists($file)){//Deletes the image if it exists
                            $file = "images/products/default.png";
                        }
                    }
                }
                $imagefile = $file;

                $file = "images/products/" . $id . "/banner.jpg";

                if(!file_exists($file)){//Deletes the image if it exists
                    $file = "images/products/" . $id . "/banner.png";
                    if(!file_exists($file)){//Deletes the image if it exists
                        $file = "images/products/" . $id . "/banner.gif";
                        if(!file_exists($file)){//Deletes the image if it exists
                            $file = "images/products/default.png";
                        }
                    }
                }
                $bannerfile = $file;
            }
        }else {
            die("Invalid Product, Multiple Instances Were Found");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion | <?= $name?></title>

    <?php include('header.php') ?>
    <link href="css/product.css" rel="stylesheet" media="screen">
</head>
<body>
    <div class="image-container">
        <?php 
        echo "<img class='backImg' src='$bannerfile' alt='Background Image'>";
        echo "<img class='productImg' src='$imagefile' alt='Product Image'>";
        ?>
    </div>

    <div class="favorite">
        <i class="fa fa-heart"></i>
    </div>

    <div class="container-fluid">
        <h3 class="product-title"><?= $name?></h3>

        <div class="product-flex">

        
        <div class="product-default">
            <?php echo "<img id='default-img' src='$imagefile' alt='Product Image'>"; ?>
        </div>

        <div class="product-colors">
            <?php
                $sql = "SELECT * FROM product_items WHERE product_id='$id'";
                $result = mysqli_query($db, $sql);
                $currentIndex = 0;
                $currentDivIndex = 0;

                $firstItemName = "";
                $firstItemQuantity = 0;

                if($result){
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            $itemID = $row["item_id"];
                            $itemName = $row["name"];
                            $itemQuantity = $row["quantity"];
                            if($currentIndex < 4){
                                $file = "images/products/" . $id . "/items/$itemID.jpg";

                                if(!file_exists($file)){//Deletes the image if it exists
                                    $file = "images/products/" . $id . "/items/$itemID.png";
                                    if(!file_exists($file)){//Deletes the image if it exists
                                        $file = "images/products/" . $id . "/items/$itemID.gif";
                                        if(!file_exists($file)){//Deletes the image if it exists
                                            $file = "images/products/default.png";
                                        }
                                    }
                                }
                                if($currentDivIndex == 0 && $currentIndex == 0){
                                    $firstItemName = $itemName;
                                    $firstItemQuantity = $itemQuantity;
                                    echo "<img class='color hasBorder' data-name='$itemName' data-quantity='$itemQuantity' src='$file' alt='Product Image'>";
                                }else {
                                    echo "<img class='color' data-name='$itemName' data-quantity='$itemQuantity' src='$file' alt='Product Image'>";
                                }
                                $currentIndex = $currentIndex + 1;
                                if($currentIndex == 4){
                                    $currentIndex = 0;
                                    $currentDivIndex = $currentDivIndex + 1;
                                }
                            }
                        }
                    }
                }

            ?>
            </div>
            </div>

        <form>

            <div class="details-flex">
                <div class="name-price-size">
                    <div class="name-price-flex">
                        <h3 id="itemNameText"><?= $firstItemName?></h3>
                        <?php
                            if($discount > 0){
                                $newprice = $price - $discount;
                                echo "<div class='price'><del>$price$</del> $newprice$</div>";
                            }else {
                                echo "<div class='price'>$price$</div>";
                            }
                        ?>
                        
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
                    
                    <!-- <table class="table borderless">
                        <thead>
                            <tr>
                                <th scope="col">Package Dimensions</th>
                                <th scope="col">13.78 x 9.13 x 4.65 inches; 2.5 Pounds</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="col">Model</th>  
                                <th scope="col">DA0694-001</th>                              
                            </tr>
                            <tr>
                                <th scope="col">Department</th>
                                <th scope="col">Men</th>
                            </tr>
                            <tr>
                                <th scope="col">Quantity</th>
                                <th scope="col">2</th>                                
                            </tr>
                            <tr>
                                <th scope="col">Delivery Time</th>   
                                <th scope="col">3 Days</th>                             
                            </tr>
                            <tr>
                                <th scope="col">Likes</th>
                                <th scope="col">0</th>                                
                            </tr>
                            <tr>
                                <th scope="col">Rating</th>
                                <th scope="col">
                                    <span class='rating-flex' id='rating'>
                                        <i class='fa fa-star'></i>
                                        <i class='fa fa-star'></i>
                                        <i class='fa fa-star'></i>
                                        <i class='fa fa-star'></i>
                                        <i class='fa fa-star'></i>
                                    </span>
                                </th>                           
                            </tr>
                        </tbody>
                    </table> -->
                        <?php
                            $lines = explode("\n", $details);
                            $keys = array();
                            $values = array();
                            for($i = 0; $i < count($lines); $i++){
                                $data = explode("<>", $lines[$i]);
                                array_push($keys, $data[0]);
                                array_push($values, $data[1]);
                            }
                            array_push($keys, "Department");
                            if($department == "m"){
                                array_push($values, "Men");
                            }else if($department == "f"){
                                array_push($values, "Female");
                            }else if($department == "u"){
                                array_push($values, "Uni Sex");
                            }else {
                                array_push($values, "Unknown");
                            }
                            array_push($keys, "Quantity");
                            array_push($values, $firstItemQuantity);
                            array_push($keys, "Delivery Time");
                            array_push($values, $delivery_time . " Days");
                            array_push($keys, "Likes");
                            array_push($values, $likes);
                            array_push($keys, "Ratings");
                            echo "<div class='detail-col-1'>";
                            for($i = 0; $i < count($keys); $i++){
                                $item = $keys[$i];
                                echo"<h5>$item</h5>";
                            }
                            echo "</div>";
                            echo "<div class='detail-col-2'>";
                            for($i = 0; $i < count($values); $i++){
                                $item = $values[$i];
                                if($i == count($values) - 3){
                                    echo"<h4 id='itemQuantityText'>$item</h4>";
                                }else {
                                    echo"<h4>$item</h4>";
                                }
                                
                            }
                            echo "<span class='rating-flex' id='rating'>";
                            echo "<i class='fa fa-star'></i>";
                            echo "<i class='fa fa-star'></i>";
                            echo "<i class='fa fa-star'></i>";
                            echo "<i class='fa fa-star'></i>";
                            echo "<i class='fa fa-star'></i>";
                            echo "</span>";
                            echo "</div>";
                        ?>
                </div>
            </div>

            <div class="prod-desc">
                <h3>Product Description</h3>
                <p><?=$description?></p>
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
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.touchswipe/1.6.4/jquery.touchSwipe.min.js"></script>
<script>
    $('.color').click(function() {
        var $this = $(this);
        if ($this.hasClass('hasBorder')) {
            $this.removeClass('hasBorder');
        } else {
            $('.hasBorder').removeClass('hasBorder');
            $this.addClass('hasBorder');
            document.getElementById('default-img').src = $this.attr('src');
            let itemName = document.getElementById('itemNameText');
            let itemQuantity = document.getElementById('itemQuantityText');
            itemName.innerHTML = $(this).data("name");
            itemQuantity.innerHTML = $(this).data("quantity");
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
    $(".carousel").swipe({

        swipe: function(event, direction, distance, duration, fingerCount, fingerData) {

        if (direction == 'left') $(this).carousel('next');
        if (direction == 'right') $(this).carousel('prev');

        },
        allowPageScroll:"vertical"

        });
</script>

</html>