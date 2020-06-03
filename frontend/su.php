<?php
session_start();
if (!isset($_SESSION["token"]))
    header("Location: 401.html");

if (!isset($_COOKIE["token"]))
    header("Location: 401.html");

if ($_SESSION["token"] != $_COOKIE["token"])
    header("Location: 401.html")
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Súper usuario - Mira cuántas empresas y compradores hay en tu plataforma</title>
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
    <link rel="stylesheet" href="bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/estilos.css">
</head>

<body>
    <div style="margin: 20px;" id="contenedor" class="row">
        <div style="padding: 20px;" id="empresas" class="col-6"><h3 id="tt"></h3><ul id="lista-empresas"></ul></div>
        <div style="padding: 20px;" id="compradores" class="col-6"><h3 id="ttt"></h3><ul id="lista-compradores"></ul></div>
    </div>


    <button style="position:-ms-page" onclick="cs()">Salir</button>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.2/axios.min.js"></script>
    <script src="jss/contenedorSU.js"></script>
</body>

</html>