<?php 
    session_start();
    session_destroy();

    setcookie("token", "",time()-1, "/");
    setcookie("user", "",time()-1, "/");
    setcookie("email", "",time()-1, "/");
    setcookie("gender", "",time()-1, "/");

    header("Location: index.html");

 ?>