<?php
include "includes/config.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Fashion | Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "header.php"; ?>
    <link href="css/main.css" rel="stylesheet" media="screen">
</head>
<body>
    <div class="landingContainer">
        <div class="landingImageContainer">
            <img class="landingImage" src="imgs/landing/background_image_1.jpg" alt="Background Image">
            <div class="centered">
                <h1 class="animated animated-text">
                    <span class="mr-2">Browse Through New</span>
                    <div class="animated-info">
                        <span class="animated-item">Outfits</span>
                        <span class="animated-item">Accessories</span>
                        <span class="animated-item">And More!</span>
                    </div>
                    <br>
                    <div class="centeredAlone">
                        <span class="mr-2">All In One Place</span>
                        <div class="custom-btn-group mt-4">
                            <a href="products.php?gender=f" class="btn mr-lg-2 custom-btn"><i class='uil uil-file-alt'></i>Shop Now</a>
                        </div>
                    </div>
                </h1>
            </div>
        </div>
        <h3 class="landingPopularTitle">Popular Right Now</h3>
        <hr class="titlehr">
        <div class="showMoreDiv">
            <a href="products.php?gender=f">Show More</a>
        </div>
        <div class="products-flex">
            <?php
                $sql = "SELECT prod_id,name,price,discount FROM products ORDER BY likes DESC LIMIT 4";//Get The Top 4 Recipes
                $result = mysqli_query($db, $sql);
                if($result){
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            $id = $row["prod_id"];
                            $name = $row["name"];
                            $price = $row["price"];
                            $discount = $row["discount"];
                
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

                            echo "<div class='product-item'>";
                            echo "<a href='viewProduct.php?id=$id' class='text-reset' style='text-decoration: none;'>";
                            echo "<div class='product-img'>";
                            echo "<img src='$file' alt='Popular Image'>";
                            echo "</div>";
                            echo "<div class='product-title'>";
                            echo "<h1 class='title'>$name</h1>";
                            if($discount > 0){
                                $newprice = $price - $discount;
                                echo "<p class='price sale'><del>$$price</del> <span class='price2'>$$newprice</span></p>";
                            }else {
                                echo "<p class='price'>$$price</p>";
                            }
                            echo "</div>";
                            echo "</a>";
                            echo "</div>";
                        }
                    }
                }else {

                }
            ?>
        </div>
        
        <div class="container">
            <h3 class="landingPopularSubTitle">New Drops</h3>
            <hr class="titlehr">
            <div id="newDropsCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <?php
                        $sql = "SELECT prod_id,name FROM products ORDER BY prod_id DESC LIMIT 4";//Get The Top 4 Recipes
                        $result = mysqli_query($db, $sql);
                        if($result){
                            if(mysqli_num_rows($result) > 0){
                                $currentIndex = 0;
                                while($row = mysqli_fetch_assoc($result)){
                                    $id = $row["prod_id"];
                                    $name = $row["name"];
                        
                                    $file = "images/products/" . $id . "/banner.jpg";
                        
                                    if(!file_exists($file)){//Deletes the image if it exists
                                        $file = "images/products/" . $id . "/banner.png";
                                        if(!file_exists($file)){//Deletes the image if it exists
                                            $file = "images/products/" . $id . "/banner.gif";
                                            if(!file_exists($file)){//Deletes the image if it exists
                                                $file = "images/products/defaultbanner.jpg";
                                            }
                                        }
                                    }

                                    if($currentIndex == 0){
                                        echo "<div class='carousel-item active'>";
                                    }else {
                                        echo "<div class='carousel-item'>";
                                    }
                                    echo "<a href='viewProduct.php?id=$id' class='text-reset' style='text-decoration: none;'>";
                                    echo "<img class='d-block w-100' src='$file' alt='New Drops Slide'>";
                                    echo "<div class='newDropItemTitle'><hr><h1>$name<h1>";
                                    echo "</div></a></div>";

                                    $currentIndex++;
                                }
                            }
                        }else {

                        }
                    ?>
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
    </div>
    <br>
    <br>
    <br>
<?php include "footer.php"; ?>
</body>
</html>