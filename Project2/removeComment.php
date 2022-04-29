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

    if(!isset($_GET["userid"]) || !isset($_GET["commentid"]) || !isset($_GET["recipeid"])){
        header("location:$return");
        die();
    }
    $userid = $_GET["userid"];
    $recipeid = $_GET["recipeid"];
    $commentid = $_GET["commentid"];
    $isSuperUser = false;
    session_start(); 
    if((isset($_SESSION["isAdmin"]) && $_SESSION["isAdmin"] == 1) || (isset($_SESSION["userID"]) && $_SESSION["userID"] == $userid)){
        $isSuperUser = true;
    }

    if($isSuperUser){
        include "includes/config.php";

        $sql = "DELETE FROM comments WHERE userid='$userid' AND cid='$commentid'";
        $result = mysqli_query($db, $sql);
        if($result){
            $sql = "UPDATE recipes SET totalcomments=totalcomments - 1 WHERE id='$recipeid'";
            $result = mysqli_query($db, $sql);
        }

        header("location:$return");
    }else {
        header("location:panel.php");
    }
    die();
?>