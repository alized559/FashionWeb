<?php 

    if(!isset($_GET["id"])){
        header("location:index.php");
        die();
    }
    $userid = $_GET["id"] ?? 0;
    
    $return = "panel.php";
    if(isset($_GET["back"])){
        $back = $_GET["back"];
        $argString = $_GET["args"] ?? "";
        $args = explode(",", $argString ?? "");
        $return = $back;
        if(count($args) > 1){
            $return = $back . "?";
        }else {
          $arg2 = explode("-", $argString ?? "");
          if(count($arg2) > 0){
            $args = $arg2;
            $return = $back . "?";
          }
        }
        $isHeader = true;
        foreach($args as $value){
            if($isHeader){
                $return = $return . $value . "=";
                $isHeader = false;
            }else {
                $return = $return . $value . "&";
                $isHeader = true;
            }
        }
        $return = substr($return, 0, -1);
    }

    $isSuperUser = false;
    session_start(); 
    if((isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1) || (isset($_SESSION["userID"]) && $_SESSION["userID"] == $userid)){
        $isSuperUser = true;
    }

    $file = "imgs/users/user_" . $userid . ".jpg";

    if(!file_exists($file)){
        $file = "imgs/users/default.png";
    } 

    include "includes/config.php";
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Tummy Food | Comments</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/main.css" rel="stylesheet" media="screen">

    <link rel="icon" href="imgs/favicon.ico" type="image/x-icon">
    
  </head>
  <body bgcolor="darksalmon"><!--Add BG Color to make footer cover the area-->
    <div class="container">
      <div class="navbar">
        <ul>
            <?php
            if($isSuperUser){
                echo "<li><a href='index.php'>Home</a></li>";
                echo "<li><a href='panel.php'>Panel</a></li>";
                echo "<li><a href='$return'>Back</a></li>";
                echo "<li><a href='logout.php'>Logout</a></li>";
            }else {//User ui 
                echo "<li><a href='index.php'>Home</a></li>";
                if(isset($_SESSION["username"])){
                    echo "<li><a href='panel.php'>Panel</a></li>";
                    echo "<li><a href='$return'>Back</a></li>";
                    echo "<li><a href='logout.php'>Logout</a></li>";
                }else {
                    echo "<li><a href='$return'>Back</a></li>";
                }
            }
            ?>
        </ul>
      </div>
      <div class="recipe-container-image">
        <img src="<?= $file ?>" alt="User Profile Image">
      </div>
      <div class="recipe-container">
            <?php
            $sql = "SELECT * FROM recipes,comments WHERE userid='$userid' AND id=recipeid";
            $result = mysqli_query($db, $sql);
            if($result){
                if(mysqli_num_rows($result) > 0){
                    echo "<h3 class='subtitle center pulse'>Posted Comments</h3>";
                    echo "<div class='flex col-12'>";
                    while($row = mysqli_fetch_assoc($result)){
                        $id = $row["id"];
                        $commentid = $row["cid"];
                        $title = $row["title"];
                        $type =  $row["type"];
                        $time = $row["time"];
                        $comment = $row["comment"];

                        $file = "imgs/recipes/recipe_" . $id . ".jpg";

                        if(!file_exists($file)){//Deletes the image if it exists
                            $file = "imgs/recipes/default.jpg";
                        }

                        echo "<div class='comment-frame'>";
                        echo "<span class='type'>$type</span>";
                        echo "<div class='title'>";
                        echo "<img src='" . $file . "' alt='Recipe Image'>";
                        echo "<h3>" . $title . "</h3>";
                        echo "</div>";
                        echo "<p>" . $comment . "</p>";
                        echo "<div class='center'>";
                        $newArgs = str_replace(",", "-", $argString);
                        echo "<a href='viewRecipe.php?id=$id&back=viewUserComments.php&args=id,$userid,back,$back,args,$newArgs'>View Recipe</a>";
                        if($isSuperUser){
                            echo "<a class='delete' href='removeComment.php?userid=$userid&recipeid=$id&commentid=$commentid&back=viewUserComments.php&args=id,$userid,back,$back,args,$newArgs'>Remove Comment</a>";
                        }
                        echo "</div>";
                        echo "</div>";
                    }
                    echo "</div>";
                }else {
                    echo "<h3 class='subtitle center pulse'>No Posted Comments</h3>";
                }
            }
            ?>
        </div>
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
