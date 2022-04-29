<?php 
include "includes/validateAuth.php";
include 'includes/config.php';

$id = $_SESSION['userID'];

$user = $db -> query("SELECT * FROM users WHERE `user_id`='$id'");

$fetch_check = $user->fetch_object();
$fullname = $fetch_check->fullname;
$username = $fetch_check->username;
$email = $fetch_check->email;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fashion | User Panel</title>

    <link href="css/profile.css" rel="stylesheet" media="screen">

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
        <h3 class="user-title"><?php echo $fullname ?></h3>
        <div class="table-container">
            <table class="table borderless">
                <thead>
                    <tr>
                        <th scope="col" class="title">Username</th>
                        <th scope="col"><?php echo $username ?></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="col" class="title">Email Address</th>  
                        <th scope="col"><?php echo $email ?></th>                              
                    </tr>
                </tbody>
            </table>
        </div>

        <button class="btn" style="margin-top: 10px; background-color: #EBEBEB; border-radius: 10px; width: 200px;">Manage Profile</button>
        <a class="logoutButton" href="logout.php">
            <button class="btn" style="margin-top: 10px; background-color: #dc143c; color: white; border-radius: 10px; width: 100px;">Logout</button>
        </a>
        <br>
        <br>
        <br>
        <div class="showMoreDiv">
            <h3 class="favorites-title">Favorites</h3>
            <a href="showAllFavorites.php">Show More</a>
        </div>
        <div class="favorite-products">
            <?php
                $sql = "SELECT product_id FROM favorites WHERE `user_id`='$id' LIMIT 7";
                $result = mysqli_query($db, $sql);
                if($result){
                    if(mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)){
                            
                            $id = $row["product_id"];
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
                            echo "<a href='viewProduct.php?id=$id'><img src='$file' alt='Product Image'></a>";
                        }
                    } else {
                        //no favorites
                    }
                }
            ?>
        </div>
        <br>
        <br>
        <div class="showMoreDiv">
            <h3 class="favorites-title">Previous Orders</h3>
            <a href="showAllOrders.php">Show More</a>
        </div>
        <div class="favorite-products">
            <img src='imgs/9.png' alt='Product Image'>
            <img src='imgs/9.png' alt='Product Image'>
            <img src='imgs/9.png' alt='Product Image'>
        </div>

        <br>
        <br>
        <br>
        <div class="showMoreDiv">
            <h3 class="favorites-title">Posted Reviews</h3>
            <a href="showAllReviews.php">Show More</a>
        </div>
        <div class="reviewsContainer">
            <div class="reviewsFlex">
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
        </div>
    </div>
    <br>
    <br>
    <?php include('footer.php') ?>
</body>
</html>