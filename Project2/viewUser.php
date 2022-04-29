<?php 
    $return = "panel.php";
    if(isset($_GET["back"])){
        $back = $_GET["back"];
        $argString = $_GET["args"] ?? "";
        $args = explode(",", $argString ?? "");
        $newArgs = str_replace(",", "-", $argString);
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
    }

    if(!isset($_GET["id"])){
        header("location:$return");
        die();
    }
    $userid = $_GET["id"];
    $username = "unknown";
    $joindate = "unknow";
    $email = "unknown";
    
    $file = "imgs/users/user_" . $userid . ".jpg";

    if(!file_exists($file)){
        $file = "imgs/users/default.png";
    } 

    include "includes/config.php";
    $sql = "SELECT * FROM users WHERE id='$userid'";
    $result = mysqli_query($db, $sql);
    if($result){
        if(mysqli_num_rows($result) > 0){
            while($row = mysqli_fetch_assoc($result)){
                $username = $row["username"];
                $email = $row["email"];
                $joindate = $row["joindate"];
                break;
            }
        }
    }
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Tummy Food | User</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="css/main.css" rel="stylesheet" media="screen">

    <link rel="icon" href="imgs/favicon.ico" type="image/x-icon">
    
  </head>
  <body bgcolor="darksalmon"><!--Add BG Color to make footer cover the area-->
    <div class="container">
        <div class="navbar">
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="viewUserLikes.php?id=<?= $userid ?>&back=<?= $back ?>&args=<?= $newArgs ?>">Likes</a></li>
                <li><a href="viewUserComments.php?id=<?= $userid ?>&back=<?= $back ?>&args=<?= $newArgs ?>">Comments</a></li>
                <li><a href="<?= $return ?>">Back</a></li>
            </ul>
        </div>
        <div class="recipe-container-image">
        <img src="<?= $file ?>" alt="User Profile Image">
        </div>
        <div class="recipe-container roundedges">
            <h3 class="subtitle center bounce"><?= $username ?></h3>
            <div class="center">
                <a class="mail" href="mailto:<?= $email ?>"><?= $email ?></a>
            </div>
            
            <h3 class="subtitle2 center">Joined On <?= $joindate ?></h3>
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
