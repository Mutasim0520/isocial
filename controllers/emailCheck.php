<?php
require_once ('../dbconnection.php');
    $email = $_GET['email'];
    $sql = "SELECT email FROM users WHERE email = '$email'";
    if(mysqli_fetch_assoc($conn->query($sql))) echo "false";
    else echo "true";