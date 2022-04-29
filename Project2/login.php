<?php 
  session_start();
  if(isset($_SESSION["username"])){//If the user is alreayd logged in, transfer to panel
    header("location:panel.php");
  }

?>
<!DOCTYPE html>
<html>
  <head>
    <title>Tummy Food | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/main.css" rel="stylesheet" media="screen">

    <style>
        .login-container {
            margin-top: 3%;
            display: block;
            width: fit-content;
            border-radius: 15px;
            padding: 1%;
            background-color: rgb(242, 242, 242, 0.5);
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.1);
            font-size: 18px;
            margin-left: auto;
            margin-right: auto;
            padding-left: 5%;
            padding-right: 5%;
        }

        .login-container div {
            width: fit-content;
            margin: auto;
        }

        .login-container div h3{
            font-weight: 550;
            font-size: 17px;
            text-transform: uppercase;
        }

        .login-container p .register{
            font-size: 14px;
            float: right;
        }

        .login-container .error {
            font-size: 14px;
            color: white;
            background-color: #ff5757;
            padding: 10px;
            margin-right: 5%;
            margin-left: 5%;
        }

        input, textarea{
            width: 100%;
            padding: 12px 20px;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            resize: none;
            font-family: sans-serif;
            font-size: 15px;
        }

        input[type=submit] {
            width: 100%;
            background-color: #e9967a;
            color: white;
            font-weight: 550;
            padding: 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type=submit]:hover {
            background-color: #eea890;
        }

    </style>

    <link rel="icon" href="imgs/favicon.ico" type="image/x-icon">
    
  </head>
  <body bgcolor="darksalmon"><!--Add BG Color to make footer cover the area-->
    <div class="container">
      <div class="navbar">
        <ul>
          <li><a href="index.php">Home</a></li>
          <li><a href="recipes.php">Recipes</a></li>
          <li><a href="equipment.html">Equipment</a></li>
          <li><a href="books.html">Books</a></li>
          <li><a href="login.php">User</a></li>
          <!-- This Is For Later When We Implement PHP
          <li class="dropdown">
            <a href="javascript:void(0)" class="dropbtn">Delivery</a>
            <div class="dropdown-content">
              <a href="order_equipment.html">Equipment</a>
              <a href="order_meals.html">Ready Meals</a>
            </div>
          </li>
          -->
        </ul>
      </div>
        <?php
          if(isset($_GET["register"])){?> 
            <form method="POST" action="authenticate.php">
              <div class="login-container">
                  <h3 class="subtitle center bounce">Create An Account</h3>
                  <?php 
                  
                    if(isset($_GET["error"])){
                      $errorCode = $_GET["error"];
                      if($errorCode == 0){
                        echo "<h5 class='center error'>Database Error Happened, Please Try Again Later</h5>";
                      }else if($errorCode == 1){
                        echo "<h5 class='center error'>User Already Exsists</h5>";
                      }
                    }
                  
                  ?>
                  <div>
                      <h3>Username</h3>
                      <input type="text" name="usernameText" minlength="5" size="30" required="true">
                  </div>
                  <div>
                      <h3>Email</h3>
                      <input type="email" name="emailText" size="30" required="true">
                  </div>
                  <div>
                      <h3>Password</h3>
                      <input type="password" name="passwordText" minlength="6" size="30" required="true">
                  </div>
                  <br>
                  <input type="submit" name="register" value="Register">
                  <p class="register">Already a user? <a href="login.php">Back To Login!</a></p>
              </div>
          </form>
          <?php
          }else{?>

            <form method="POST" action="authenticate.php">
              <div class="login-container">
                <h3 class="subtitle center bounce">Login To Your Account</h3>
                <?php 
                  
                    if(isset($_GET["error"])){
                      $errorCode = $_GET["error"];
                      if($errorCode == 0){
                        echo "<h5 class='center error'>Database Error Happened, Please Try Again Later</h5>";
                      }else if($errorCode == 1){
                        echo "<h5 class='center error'>Invalid Username or Password!</h5>";
                      }
                    }
                  
                  ?>
                <div>
                    <h3>Username or Email</h3>
                    <input type="text" name="usernameText" size="30" required="true">
                </div>
                <div>
                    <h3>Password</h3>
                    <input type="password" name="passwordText" size="30" required="true">
                </div>
                <br>
                <input type="submit" name="login" value="Login">
                <p class="register">Not a user? <a href="login.php?register=true">Create An Account!</a></p>
            </div>
          </form>

          <?php
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
