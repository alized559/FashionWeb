<?php 
  
    include "includes/validateAuth.php";
    include "includes/config.php";
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Tummy Food | Panel</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/main.css" rel="stylesheet" media="screen">
    
    <link rel="icon" href="imgs/favicon.ico" type="image/x-icon">
    
  </head>
  <body bgcolor="darksalmon"><!--Add BG Color to make footer cover the area-->
    <div class="container">
      <div class="navbar">
        <ul>
            <?php
            if($_SESSION["isAdmin"] == 1){//Admin ui
            ?>
                <li><a href="index.php">Home</a></li>
                <li><a href="viewUserLikes.php?id=<?= $_SESSION["userID"] ?>&back=panel.php">My Likes</a></li>
                <li><a href="viewUserComments.php?id=<?= $_SESSION["userID"] ?>&back=panel.php">My Comments</a></li>
                <li><a href="viewAllUsers.php">All Users</a></li>
                <li><a href="addRecipe.php">Add Recipe</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php
            }else {//User ui 
            ?>
                <li><a href="index.php">Home</a></li>
                <li><a href="viewUserLikes.php?id=<?= $_SESSION["userID"] ?>&back=panel.php">My Likes</a></li>
                <li><a href="viewUserComments.php?id=<?= $_SESSION["userID"] ?>&back=panel.php">My Comments</a></li>
                <li><a href="logout.php">Logout</a></li>
            <?php
            }
            ?>
        </ul>
      </div>
        <?php
            $username = $_SESSION["username"];
            $userid = $_SESSION["userID"] ?? 0;
            $file = "imgs/users/user_" . $userid . ".jpg";
            if(!file_exists($file)){
                $file = "imgs/users/default.png";
            }
            ?>
              <div class="recipe-container-image">
                <img src="<?= $file ?>" alt="User Profile Image">
              </div>
              <div class="recipe-container">
                <h3 class="subtitle center bounce"><?= $username ?></h3>
                <?php 
                  
                    if(isset($_GET["error"])){
                      $errorCode = $_GET["error"];
                      if($errorCode == 0){
                        echo "<h5 class='center error'>Database Error Happened, Please Try Again Later</h5>";
                      }else if($errorCode == 1){
                        echo "<h5 class='center error'>This username is already taken!</h5>";
                      }else if($errorCode == 2){
                        echo "<h5 class='center error'>Invalid File Type! (jpg)</h5>";
                      }else if($errorCode == 3){
                        echo "<h5 class='center error'>File Size Exceeded 2MB</h5>";
                      }
                    }else if(isset($_GET["success"])){
                      $errorCode = $_GET["success"];
                      if($errorCode == 0){
                        echo "<h5 class='center success'>Username changed successfully!</h5>";
                      }else if($errorCode == 1){
                        echo "<h5 class='center success'>Password changed successfully!</h5>";
                      }else if($errorCode == 2){
                        echo "<h5 class='center success'>Profile Picture changed successfully</h5>";
                      }
                    }
                  
                ?>
                <form method="POST" action="updateAccount.php">
                  <h3 class="subtitle2">Username</h3>
                  <input type="text" name="usernameText" minlength="5" size="30" required="true">
                  <input class="submit" type="submit" name="changeUsername" value="Change Username">
                </form>
                <form method="POST" action="updateAccount.php">
                  <h3 class="subtitle2">Password</h3>
                  <input type="password" name="passwordText" minlength="6" size="30" required="true">
                  <input class="sumbitPassword" type="submit" name="changePassword" value="Change Password">
                </form>
                <form method="POST" action="updateAccount.php" enctype="multipart/form-data">
                  <h3 class="subtitle2">Profile</h3>
                  <input type="file" name="image"/>
                  <input class="submitProfile" type="submit" name="changeProfile" value="Change Profile Picture">
                </form>
              </div>
            <?php

            if($_SESSION["isAdmin"] == 1){//Admin ui
                $sql = "SELECT * FROM recipes";
                $result = mysqli_query($db, $sql);
                if($result){
                    if(mysqli_num_rows($result) > 0){
                        echo "<h3 class='subtitle center pulse'>All Recipes</h3>";
                    ?>
                    <div class="flex col-12">
                    <?php
                        while($row = mysqli_fetch_assoc($result)){
                            $id = $row["id"];
                            $title = $row["title"];
                            $type = $row["type"];
                            $time = $row["time"];
                            $totallikes = $row["totallikes"];
                            $totalcomments = $row["totalcomments"];

                            $file = "imgs/recipes/recipe_" . $id . ".jpg";

                            if(!file_exists($file)){//Deletes the image if it exists
                                $file = "imgs/recipes/default.jpg";
                            }

                            echo "<div class='recipe-frame'>";
                            echo "<img src='" . $file . "' alt='Recipe Image'>";
                            echo "<h3>" . $title . "</h3>";
                            echo "<p>" . $type . "</p>";
                            echo "<p>" . $time . " Mins</p>";
                            echo "<a href='addRecipe.php?id=$id&error=3'>Edit Recipe</a>";
                            echo "</div>";
                        }
                    ?>
                    </div>
                    <?php
                    }else {
                        echo "<h3 class='subtitle center pulse'>No Recipes Found</h3>";
                    }
                }
              }
        ?>
        <footer>
            <div class="footer-div flex">
              <div>
                <h3>About Us</h3>
                <p>Mohammad Serhan</p>
                <a href="mailto:11930749@students.liu.edu.lb">11930749@students.liu.edu.lb</a>
              </div>
              <div>
                <h3>Social Media</h3>
                <a href="https://www.linkedin.com/in/mohammad-serhan-2b0150199/" target="_blank" rel="noopener noreferrer">LinkedIn</a>
                <br>
                <br>
                <a href="https://www.instagram.com/msserhan/" target="_blank" rel="noopener noreferrer">Instagram</a>
              </div>
            </div>
            <div class="image">
              <a href="https://www.tasty.co" target="_blank" rel="noopener noreferrer">
                <img src="imgs/main/footer.jpg">
              </a>
            </div>
          </footer>
    </div>
  </body>
</html>
