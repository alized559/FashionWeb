<?php
  session_start();
  if(isset($_GET["id"])){
    include "includes/config.php";

    $id = $_GET["id"];
    $sql = "SELECT * FROM recipes WHERE id='$id'";
    $result = mysqli_query($db, $sql);

    $title = "";
    $ingredients = "";
    $preparation = "";
    $file = "imgs/recipes/default.jpg";

    if($result){
      if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
          $title = $row["title"];
          $ingredients = $row["ingredients"];
          $preparation = $row["preparation"];

          $file = "imgs/recipes/recipe_" . $id . ".jpg";

          if(!file_exists($file)){
            $file = "imgs/recipes/default.jpg";
          } 

          break;
        }
      }else {
        header("location:index.php");
        die();
      }

    }else {//Recipe Doesnt Exsist
      header("location:index.php");
      die();
    }

  }else {//Recipe Has No ID
    header("location:index.php");
    die();
  }

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Tummy Food | Recipe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/main.css" rel="stylesheet" media="screen">
    <link rel="icon" href="imgs/favicon.ico" type="image/x-icon">
    
  </head>
  <body>
    <div class="container">
      <div class="navbar black">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="recipes.php">All Recipes</a></li>
          <?php
            if(isset($_GET["back"])){
              $back = $_GET["back"];
              $args = explode(",", $_GET["args"] ?? "");
              $return = $back;
              if(count($args) > 1){
                $return = $back . "?";
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
              echo "<li><a href='$return'>Back</a></li>";
            }
          ?>
        </ul>
      </div>
      <div class="recipe-container-image">
        <img src="<?= $file ?>" alt="Meal Image">
      </div>
      <div class="recipe-container">
        <h3 class="subtitle center pulse"><?= $title ?></h3>
        <h3 class="subtitle2">Required Ingredients</h3>
        <ul>
          <?php
            $data = explode("\n", $ingredients);
            foreach($data as $value){
              if($value != "" && $value != " ") echo "<li>$value</li>";
            }
          ?>
        </ul>
        <h3 class="subtitle2">Preparation</h3>
        <ol>
        <?php
            $data = explode("\n", $preparation);
            foreach($data as $value){
              if($value != "" && $value != " ") echo "<li>$value</li>";
            }
          ?>
        </ol>
      </div>
      <?php
        if(isset($_SESSION["username"])){
      ?>
      <form method="POST" action="addReaction.php">
        <div class="comment-container">
          <div>
            <textarea cols="70" rows="6" minlength="100" name="comment" placeholder="Want to drop us a comment?"></textarea>
          </div>
          <div>
            <input type="hidden" name="id" value="<?= $id ?>">
            <input class="comment" type='submit' name="post" value="Post Comment">
            <?php
              $userid = $_SESSION["userID"];
              $sql = "SELECT * FROM likes WHERE userid='$userid' AND recipeid='$id'";
              $result = mysqli_query($db, $sql);
              if($result){
                if(mysqli_num_rows($result) > 0){
                  echo "<input class='like' type='submit' name='unlike' value='Unlike Recipe'>";
                }else {
                  echo "<input class='like' type='submit' name='like' value='Like Recipe'>";
                }

              }else {//Recipe Doesnt Exsist
                echo "<input class='like' type='submit' name='like' value='Like Recipe'>";
              }
            ?>
          </div>
        </div>
      </form>
      <?php
        }
          $sql = "SELECT cid,userid,comment,username FROM comments,users WHERE recipeid='$id' AND id=userid";
          $result = mysqli_query($db, $sql);
          if($result){
            if(mysqli_num_rows($result) > 0){
                echo "<h3 class='subtitle center bounce'>Comments</h3>";
                echo "<div class='flex col-12'>";
                while($row = mysqli_fetch_assoc($result)){
                    $commentid = $row["cid"];
                    $sender = $row["userid"];

                    $title = $row["username"];
                    $comment = $row["comment"];

                    $file = "imgs/users/user_" . $sender . ".jpg";

                    if(!file_exists($file)){//Deletes the image if it exists
                        $file = "imgs/users/default.png";
                    }

                    echo "<div class='comment-frame'>";
                    echo "<div class='userTitle'>";
                    echo "<img src='" . $file . "' alt='Profile Picture'>";
                    echo "<h3>" . $title . "</h3>";
                    echo "</div>";
                    echo "<p>" . $comment . "</p>";
                    echo "<div class='center'>";
                    if(isset($_SESSION["userID"])){
                      if($_SESSION["userID"] != $sender){
                        echo "<a href='viewUser.php?id=$sender&back=viewRecipe.php&args=id,$id'>View User</a>";
                      }
                    }
                    else {
                      echo "<a href='viewUser.php?id=$sender&back=viewRecipe.php&args=id,$id'>View User</a>";
                    }
                    if((isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1) || (isset($_SESSION["userID"]) && $_SESSION["userID"] == $sender)){
                        echo "<a class='delete' href='removeComment.php?userid=$sender&recipeid=$id&commentid=$commentid&back=viewRecipe.php&args=id,$id'>Remove Comment</a>";
                    }
                    echo "</div>";
                    echo "</div>";
                }
                echo "</div>";
            }else {
                echo "<h3 class='subtitle center bounce'>No Posted Comments</h3>";
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
