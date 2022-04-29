<?php 
include "includes/validateAuth.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="css/viewProduct.css" rel="stylesheet" media="screen">

    <?php include('header.php') ?>
</head>
<body>
    <div class="image-container">
        <?php 
        // echo "<img class='backImg' src='' alt='Background Image'>";
        // echo "<img class='productImg' src='' alt='Product Image'>";
        ?>
        <img class='backImg' src='imgs/profile-back.png' alt='Background Image'>
        <img class='productImg' src='imgs/user-default-img.png' alt='Product Image'>
    </div>

    <div class="container-fluid">
        <h3 class="user-title">John Mckay</h3>
        <div class="table-container">
            <table class="table borderless">
                <thead>
                    <tr>
                        <th scope="col" class="title">Username</th>
                        <th scope="col">@alized559</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="col" class="title">Email Address</th>  
                        <th scope="col">alized559@gmail.com</th>                              
                    </tr>
                </tbody>
            </table>
        </div>

        <button class="btn" style="margin-top: 10px; background-color: #EBEBEB; border-radius: 10px; width: 200px;">Manage Profile</button>
    
        <h3 class="favorites-title">Favorites</h3>
        <div class="favorite-products">
            <img src='imgs/9.png' alt='Product Image'>
            <img src='imgs/9.png' alt='Product Image'>
            <img src='imgs/9.png' alt='Product Image'>
        </div>

        <h3 class="favorites-title">Previous Orders</h3>
        <div class="favorite-products">
            <img src='imgs/9.png' alt='Product Image'>
            <img src='imgs/9.png' alt='Product Image'>
            <img src='imgs/9.png' alt='Product Image'>
        </div>

        <h3 class="favorites-title">Posted Reviews</h3>
        <div class="reviews">
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
    </div>

    <!-- <div>
        <a href="logout.php">Logout</a>
    </div> -->

    <?php include('footer.php') ?>
</body>
</html>