<!DOCTYPE html>
<html>
  <head>
    <title>Tummy Food | Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/main.css" rel="stylesheet" media="screen">
    <link rel="icon" href="imgs/favicon.ico" type="image/x-icon">
    
  </head>
  <body>
    <img class="background" src="imgs/main/background2.jpg" alt="Background">
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
        <h3 class="col-6">Tasty Recipes To Fill Your Tummy</h3>
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
        }else {//No Trending Recipes

        }
      }
    ?>
    <div class="clearfix">
      <div class="image">
        <img src="imgs/meals/cake1.jpg">
      </div>
      <h3 class="subtitle">What Do We Offer</h3>
      <br>
      <p>If you are looking for a place to learn cooking, get cooking equipment, or even get home-ready meals for yourself
          or your date you are in the right place. We offer fast and reliable home delivery for most of the equipment that 
          you may require to start your cooking career and hot glazing ready meals to fill your tummy, detailed recipes 
          for the best and tasteful meals, and we have our own recommended book selection for beginners and professionals!
      </p>
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
  </body>
</html>
