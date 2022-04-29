<?php 
  
    include "includes/validateAuth.php";
    if($_SESSION["isAdmin"] == 0){//Not Admin
        header("location:panel.php");
        die();
    }

    include "includes/config.php";

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Tummy Food | All Users</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/main.css" rel="stylesheet" media="screen">

    <link rel="icon" href="imgs/favicon.ico" type="image/x-icon">
    
  </head>
  <body bgcolor="darksalmon"><!--Add BG Color to make footer cover the area-->
    <div class="container">
        <div class="navbar">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="panel.php">Panel</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
        <?php
            $sql = "SELECT * FROM users";
            $result = mysqli_query($db, $sql);
            if($result){
                if(mysqli_num_rows($result) > 0){
                    echo "<h3 class='subtitle center pulse'>All Users</h3>";
                    echo "<div class='flex col-12'>";
                    while($row = mysqli_fetch_assoc($result)){
                        $id = $row["id"];
                        $title = $row["username"];

                        $file = "imgs/users/user_" . $id . ".jpg";

                        if(!file_exists($file)){//Deletes the image if it exists
                            $file = "imgs/users/default.png";
                        }

                        echo "<div class='user-frame'>";
                        echo "<img src='" . $file . "' alt='Recipe Image'>";
                        echo "<h3>" . $title . "</h3>";
                        echo "<a href='viewUser.php?id=$id&back=viewAllUsers.php'>View Profile</a>";
                        echo "</div>";
                    }
                    echo "</div>";
                }else {
                    echo "<h3 class='subtitle center pulse'>No Users Found</h3>";
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
