<?php
    session_start();
    require_once ('../dbconnection.php');
    require_once('../captcha/recaptchalib.php');
    $redirect_link = $_SERVER['HTTP_REFERER'];
    $errors = array();
    $email_flag = 1;

    $password = htmlspecialchars(trim($_POST['password']));
    $email = trim($_POST['email']);
    $name = htmlspecialchars(trim($_POST['username']));
    $re_password = $_POST['re_password'];

    $form_values = array(
        "email" => $email,
        "password" => $password,
        "username" => $name,
        "re_password" => $re_password

    );

$privatekey = "6LfusWUUAAAAALtUqN9eFGOkwvrFXQn2UrMfWCy2";
$resp = recaptcha_check_answer ($privatekey,
    $_SERVER["REMOTE_ADDR"],
    $_POST["recaptcha_challenge_field"],
    $_POST["recaptcha_response_field"]);

if (!$resp->is_valid) {
    header("Location:$redirect_link");
}

// Form validation

if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(empty($_POST["username"])){
            $errors ["username"] = "Please enter a valid username";
        }
        if((empty($_POST["email"])) || (!filter_var(($_POST["email"]), FILTER_VALIDATE_EMAIL))){
            $errors ["email"] = "Please enter a valid email";
            $email_flag = 0;
        }
        if((empty($_POST["password"])) || strlen($_POST["password"]) < 6 ){
            $errors ["password"] = "Please enter password atleast 6 characters long";
        }
        if($email_flag == 1){
            $query = "SELECT * FROM users WHERE email = '$email'";
            $result = $conn->query($query);
            $row = mysqli_fetch_assoc($result);
            if($row){
                $errors ["email"] = "Please enter a different email. This email already exist";
            }
        }
        if($password != $re_password){
            $errors ["re_password"] = "Password did not match";
        }
    }
    else{
        header("Location:$redirect_link");
}
    if($errors){
        $_SESSION["errors"] = $errors;
        $_SESSION["form_values"] = $form_values;
        header("Location:$redirect_link");
    }

    $random_numbrer = rand(1456,29980);
    $token = md5($email.$random_numbrer);
    $sql = "INSERT INTO users VALUES ('','$email',' $password',' $name','$token')";
        if ($conn->query($sql) == TRUE) {
            $_SESSION["token"] = $token;
            $_SESSION["username"] = $name;
            $_SESSION["logged_in_to"] = "isocial.com";
            try{
                header("location:../views/index.php");
            }catch (Exception $e){
                header("location:../views/500.php");
            }

        } else {
            echo "Error: " . $conn->error;
        }
    $conn->close();