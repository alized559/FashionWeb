<?php 
    $return = "panel.php";
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
    }

    if(!isset($_GET["userid"]) || !isset($_GET["recipeid"])){
        header("location:$return");
        die();
    }
    $userid = $_GET["userid"];
    $recipeid = $_GET["recipeid"];
    $isSuperUser = false;
    session_start(); 
    if((isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1) || (isset($_SESSION["userID"]) && $_SESSION["userID"] == $userid)){
        $isSuperUser = true;
    }

    if($isSuperUser){
        include "includes/config.php";

        $sql = "DELETE FROM likes WHERE userid='$userid' AND recipeid='$recipeid'";
        $result = mysqli_query($db, $sql);
        if($result){
            $sql = "UPDATE recipes SET totallikes=totallikes - 1 WHERE id='$recipeID'";
            $result = mysqli_query($db, $sql);
        }

        header("location:$return");
    }else {
        header("location:panel.php");
    }
    die();
?>