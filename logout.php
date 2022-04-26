<?php

    session_start();
    unset($_SESSION["username"]);
    unset($_SESSION["type"]);
    unset($_SESSION['userID']);
    session_destroy();

    header("location:login.php");

?>