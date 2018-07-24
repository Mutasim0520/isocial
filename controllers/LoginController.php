<?php
    session_start();
    require('../dbconnection.php');

    $redirect_link = $_SERVER['HTTP_REFERER'];
    $errors = array();
    $email_flag = 1;

    $password = $_POST['password'];
    $email = $_POST['email'];
    $form_values = array(
        "email" => $email,
        "password" => $password,

    );

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if((empty($_POST["email"])) || (!filter_var(($_POST["email"]), FILTER_VALIDATE_EMAIL))){
            $errors ["email"] = "Please enter a valid email";
            $email_flag = 0;
        }
        if((empty($_POST["password"])) || strlen($_POST["password"]) < 6 ){
            $errors ["password"] = "Please enter password atleast 6 characters long";
        }
    }
    if($errors){
        $_SESSION["errors"] = $errors;
        $_SESSION["form_values"] = $form_values;
        header("location:$redirect_link");
    }

    $query = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($query);
    $row = mysqli_fetch_assoc($result);

    if($row['email']==$email && $row['password'] == $password){
        $_SESSION["token"] = $row['_token'];
        $_SESSION["username"] = $row['name'];
        $_SESSION["logged_in_to"] = "isocial.com";
        if(isset($_SESSION['requested_route'])){
            $redirect_link =$_SESSION['requested_route'];
            unset($_SESSION['requested_route']);
            header("Location:$redirect_link");
        }
        else header("location:/isocial/views/index.php");
    }
    else{
        if($row['email']!= $email) $errors ["email"] = "Incorrect email";
        if($row['password'] != $password) $errors ["password"] = "Incorrect password";
        $_SESSION["errors"] = $errors;
        $_SESSION["form_values"] = $form_values;
        header("Location:$redirect_link");
    }
    $conn->close();