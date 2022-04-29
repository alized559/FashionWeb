<?php 
  
    include "includes/validateAuth.php";
    if($_SESSION["isAdmin"] == 0){//Not Admin
        header("location:panel.php");
        die();
    }

    include "includes/config.php";

    if(isset($_POST["delete"])){
        $recipeID = $_POST["id"] ?? 0;
        $sql = "DELETE FROM recipes WHERE id='$recipeID'";
        $result = mysqli_query($db, $sql);
        if($result){
            $file = "imgs/recipes/recipe_$recipeID.jpg";
            if(file_exists($file)){//Deletes the image if it exists
                unlink($file);
            }
        }else {
            
        }
        header("location:panel.php");
        die();
    }

    if(isset($_POST["create"]) || isset($_POST["edit"])){//Creating Recipe
        $edit = 0;
        $recipeID = $_POST["id"] ?? 0;
        if(isset($_POST["edit"])){
            $edit = 1;
        }
        $title = str_replace('\'', '', $_POST["title"]);
        $type = str_replace('\'', '', $_POST["type"]);
        $time = $_POST["time"];
        $ingredients = str_replace('\'', '', $_POST["ingredients"]);
        $preparation = str_replace('\'', '', $_POST["preparation"]);

        $file_ext = ".null";
        $file_tmp = "null";
        if(isset($_FILES['image']) && $_FILES['image']['name']){
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];

            $str = explode('.',$_FILES['image']['name']);                        
            $file_ext = strtolower(end($str));
            
            $extensions = array("jpg");
            
            if(in_array($file_ext,$extensions)=== false){
                header("location:addRecipe.php?error=1&edit=$edit&title=$title&type=$type&time=$time&ingredients=$ingredients&preparation=$preparation");
                die();
            }
            
            if($file_size > 2097152) {
                header("location:addRecipe.php?error=2&edit=$edit&title=$title&type=$type&time=$time&ingredients=$ingredients&preparation=$preparation");
                die();
            }
        }
        $sql = "";
        if(isset($_POST["edit"])){
            $sql = "UPDATE recipes SET title='$title', type='$type', time='$time', ingredients='$ingredients', preparation='$preparation' WHERE id='$recipeID'";
        }else {
            $sql = "INSERT INTO recipes(title,type,time,ingredients,preparation) VALUE ('$title','$type','$time','$ingredients','$preparation')";
        }
        $result = mysqli_query($db, $sql);
        if($result){
            if(isset($_FILES['image']) && $_FILES['image']['name']){
                if(!isset($_POST["edit"])) $recipeID = mysqli_insert_id($db);
                $file = "imgs/recipes/recipe_$recipeID." . $file_ext;
                if(file_exists($file)){//Deletes the image if it exists
                    unlink($file);
                }
                move_uploaded_file($file_tmp, $file);
            }
            header("location:panel.php");
            die();
        }else {
            header("location:addRecipe.php?error=0&edit=$edit&title=$title&type=$type&time=$time&ingredients=$ingredients&preparation=$preparation");
            die();
        }
    }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Tummy Food | Add Recipe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/main.css" rel="stylesheet" media="screen">
    <link href="css/panel.css" rel="stylesheet" media="screen">

    <link rel="icon" href="imgs/favicon.ico" type="image/x-icon">
    
  </head>
  <body bgcolor="darksalmon"><!--Add BG Color to make footer cover the area-->
    <div class="container">
        <div class="navbar">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="panel.php">Back To Panel</a></li>
            </ul>
        </div>
        <?php

        if(isset($_GET["error"])){//Creating Recipe
            //run sql code here
            $id = $_GET["id"] ?? 0;
            $errorCode = $_GET["error"];

            $title = "";
            $type = "";
            $time = "";
            $ingredients = "";
            $preparation = "";

            if($id != 0){//Coming from panel
                $sql = "SELECT * FROM recipes WHERE id='$id'";
                $result = mysqli_query($db, $sql);
                if($result){
                    if(mysqli_num_rows($result) > 0){
                        while($row = mysqli_fetch_assoc($result)){
                            $title = $row["title"];
                            $type = $row["type"];
                            $time = $row["time"];
                            $ingredients = $row["ingredients"];
                            $preparation = $row["preparation"];
                            break;
                        }
                    }
                }
            }else {
                $title = $_GET["title"];
                $type = $_GET["type"];
                $time = $_GET["time"];
                $ingredients = $_GET["ingredients"];
                $preparation = $_GET["preparation"];
            }

        ?>
        <form method="POST" action="addRecipe.php" enctype="multipart/form-data">
            <div class="panel-container">
                <h3 class="subtitle center bounce">Create A New Recipe</h3>

                <?php
                    if($errorCode == 0){
                        echo "<h5 class='center error'>Database Error Happened, Please Try Again Later</h5>";
                    }else if($errorCode == 1){
                        echo "<h5 class='center error'>Invalid File Type! (jpg)</h5>";
                    }else if($errorCode == 2){
                        echo "<h5 class='center error'>File Size Exceeded 2MB</h5>";
                    }
                  ?>

                <div>
                    <h3>Title</h3>
                    <input type="text" name="title" size="30" required="true" value="<?= $title ?>">
                </div>
                <div>
                    <h3>Type</h3>
                    <input type="text" name="type" size="30" required="true" value="<?= $type ?>">
                </div>
                <div>
                    <h3>Prep Time</h3>
                    <input type="number" name="time" required="true" value="<?= $time ?>">
                </div>
                <br>
                <div>
                    <h3>Ingredients</h3>
                    <textarea cols="80" rows="8" name="ingredients" required="true"><?= $ingredients ?></textarea>
                </div>
                <br>
                <div>
                    <h3>Preparation</h3>
                    <textarea cols="80" rows="8" name="preparation" required="true"><?= $preparation ?></textarea>
                </div>
                <br>
                <div>
                    <h3 class="center">Choose Picture</h3>
                    <input type="file" name="image"/>
                </div>
                <?php
                    if($errorCode == 3 || $_GET["edit"] == 1){//Is Editing
                        echo "<input type='hidden' name='id' value='$id'>"; 
                        echo "<input class='submit' type='submit' name='edit' value='Save'>";
                        echo "<input class='delete' type='submit' name='delete' value='Delete'>";
                    }else {
                        echo "<input class='submit' type='submit' name='create' value='Create'>";
                    }
                ?>
            </div>
        </form>
        <?php
        }else{
        ?>
        <form method="POST" action="addRecipe.php" enctype="multipart/form-data">
            <div class="panel-container">
                <h3 class="subtitle center bounce">Create A New Recipe</h3>
                <div>
                    <h3>Title</h3>
                    <input type="text" name="title" size="30" required="true">
                </div>
                <div>
                    <h3>Type</h3>
                    <input type="text" name="type" size="30" required="true">
                </div>
                <div>
                    <h3>Prep Time</h3>
                    <input type="number" name="time" required="true">
                </div>
                <br>
                <div>
                    <h3>Ingredients</h3>
                    <textarea cols="80" rows="8" name="ingredients" required="true"></textarea>
                </div>
                <br>
                <div>
                    <h3>Preparation</h3>
                    <textarea cols="80" rows="8" name="preparation" required="true"></textarea>
                </div>
                <br>
                <div>
                    <h3>Choose Picture</h3>
                    <input type="file" name="image" required="true"/>
                </div>
                <input class="submit" type="submit" name="create" value="Create">
            </div>
        </form>
        <?php } ?>
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
