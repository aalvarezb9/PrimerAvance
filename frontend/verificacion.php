<?php 
    session_start();
    if(!isset($_SESSION["token"]))
        header("Location: 401.html");

    if(!isset($_COOKIE["token"]))
        header("Location: 401.html");

    if($_SESSION["token"] != $_COOKIE["token"])
        header("Location: 401.html")
        
?>
