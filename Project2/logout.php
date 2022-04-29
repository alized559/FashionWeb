<?php

    session_start();
    unset($_SESSION["username"]);
    unset($_SESSION["isAdmin"]);
    unset($_SESSION['userID']);
    session_destroy();

    header("location:login.php");

?>