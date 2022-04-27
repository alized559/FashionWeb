<?php
    session_start();
    if(!isset($_SESSION['username'])) {
        header("location:login.php");
        die();
    }
    if(!isset($_SESSION['type']) || $_SESSION['type'] != "admin"){
        header("location:panel.php");
        die();
    }
?>