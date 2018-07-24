<?php
    session_start();
    $redirect_link = $_SERVER['HTTP_REFERER'];
    if($_GET["ln"]=="bn") $_SESSION["ln"] = "bn";
    else unset($_SESSION["ln"]);
    header("Location:$redirect_link");