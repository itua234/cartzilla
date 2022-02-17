<?php 
    session_start();
    //connect to database
    include 'Functions.php';
    $user = new User();
    //Unset session id and session agent
    unset($_SESSION["id"]);
    unset($_SESSION["agent"]);
    $url = "login.php";
    $user->redirect_url($url);
    exit;
?>