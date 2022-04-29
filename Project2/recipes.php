<!DOCTYPE html>
<html>
  <head>
    <title>Tummy Food | Recipes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/main.css" rel="stylesheet" media="screen">
    <link rel="icon" href="imgs/favicon.ico" type="image/x-icon">  
  </head>
  <body>
    <img class="background" src="imgs/main/background3.jpg" alt="Background">
    <div class="container">
      <div class="navbar">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="recipes.php">Recipes</a></li>
          <li><a href="equipment.html">Equipment</a></li>
          <li><a href="books.html">Books</a></li>
          <li><a href="login.php">User</a></li>
        </ul>
      </div>
      <div class="title-container">
        <h3 class="col-6">Collection Of Our Favorite Recipes</h3>
      </div>
    </div>

    <?php
      include "includes/config.php";
      //Trending Recipes
      $sql = "SELECT * FROM recipes ORDER BY totallikes DESC LIMIT 4";//Get The Top 4 Recipes
      $result = mysqli_query($db, $sql);
      if($result){
        if(mysqli_num_rows($result) > 0){
          echo "<h3 class='subtitle center pulse'>Trending Recipes</h3>";
          echo "<div class='flex col-12'>";
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
            echo "<a href='viewRecipe.php?id=$id'>View Recipe</a>";
            echo "</div>";
          }
          echo "</div>";
        }else {
          //No Trending Recipes
        }
      }
      //All Recipes
      $sql = "SELECT * FROM recipes";
      $result = mysqli_query($db, $sql);
      if($result){
          $meals = array();
          $meals["Appetizers"] = array();
          $meals["Main Dishes"] = array();
          $meals["Desserts"] = array();
          $meals["Others"] = array();
          if(mysqli_num_rows($result) > 0){
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
              if($type == "Appetizer"){
                array_push($meals["Appetizers"], array($id, $title, $time, $totallikes, $totalcomments, $file));
              }else if($type == "Main Dish"){
                array_push($meals["Main Dishes"], array($id, $title, $time, $totallikes, $totalcomments, $file));
              }else if($type == "Dessert"){
                array_push($meals["Desserts"], array($id, $title, $time, $totallikes, $totalcomments, $file));
              }else{
                array_push($meals["Others"], array($id, $title, $time, $totallikes, $totalcomments, $file));
              }
            }
            foreach ($meals as $key => $value) {
              if(count($value) > 0){
                if($key == "Desserts") {
                  echo "<h3 class='subtitle center bounce'>$key</h3>";
                }else {
                  echo "<h3 class='subtitle center'>$key</h3>";
                }
                echo "<div class='flex col-12'>";
                foreach ($value as &$recipe) {
                  echo "<div class='recipe-frame'>";
                  echo "<img src='" . $recipe[5] . "' alt='Recipe Image'>";
                  echo "<h3>" . $recipe[1] . "</h3>";
                  echo "<p>" . $recipe[2] . " Mins</p>";
                  $rid = $recipe[0];
                  echo "<a href='viewRecipe.php?id=$rid'>View Recipe</a>";
                  echo "</div>";
                }
                echo "</div>";
              }
            }
          }else {
            echo "<h3 class='subtitle center'>No Recipes Found!</h3>";
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
  </body>
</html>
