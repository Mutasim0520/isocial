<?php
    session_start();
    unset($_SESSION['token']);
    unset($_SESSION['logged_in_to']);
    header('Location:/isocial/views/index.php');