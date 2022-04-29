<?php

    include "includes/validateAuth.php";
    include "includes/config.php";


    $userid = $_SESSION["userID"];
    $recipeID = $_POST["id"] ?? 0;
    if(isset($_POST["unlike"])){
        $sql = "DELETE FROM likes WHERE userid='$userid' AND recipeid='$recipeID'";
        $result = mysqli_query($db, $sql);
        if($result){
            $sql = "UPDATE recipes SET totallikes=totallikes - 1 WHERE id='$recipeID'";
            $result = mysqli_query($db, $sql);
        }
    }else if(isset($_POST["like"])){
        $sql = "INSERT INTO likes(userid,recipeid) VALUE ('$userid','$recipeID')";
        $result = mysqli_query($db, $sql);
        if($result){
            $sql = "UPDATE recipes SET totallikes=totallikes + 1 WHERE id='$recipeID'";
            $result = mysqli_query($db, $sql);
        }
    }else if(isset($_POST["post"]) && isset($_POST["comment"])){
        $comment = str_replace('\'', '', $_POST["comment"]);
        
        $sql = "INSERT INTO comments(userid,recipeid,comment) VALUE ('$userid','$recipeID','$comment')";
        $result = mysqli_query($db, $sql);
        if($result){
            $sql = "UPDATE recipes SET totalcomments=totalcomments + 1 WHERE id='$recipeID'";
            $result = mysqli_query($db, $sql);
        }else {
            
        }
    }

    header("location:viewRecipe.php?id=$recipeID");
    die();

?>