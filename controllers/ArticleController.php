<?php
    session_start();
    require_once ('../dbconnection.php');
    require_once('../captcha/recaptchalib.php');
    $redirect_link = $_SERVER['HTTP_REFERER'];
    $errors = array();

    $title = htmlspecialchars(trim($_POST['title']));
    $description = htmlspecialchars(trim($_POST['description']));

    $form_values = array(
        "title" => $title,
        "description" => $description,
    );

// Form validation
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(empty($_POST["title"])){
            $errors ["title"] = "Please enter a title";
        }
        if(empty($_POST["description"])){
            $errors ["description"] = "Please enter a description";
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

    $token = $_SESSION["token"];
    $user_id_sql = "SELECT id FROM users WHERE _token = '$token'";
    $result = $conn->query($user_id_sql);
    $user_id =mysqli_fetch_assoc($result);
    $id = $user_id["id"];
    date_default_timezone_set('Asia/Dhaka');
    $time = date('Y-m-d H:i:s');

    $sql = "INSERT INTO articles VALUES ('','$time','$title',' $description','$id')";
    if ($conn->query($sql) == TRUE) {
        $article_sql = "SELECT * FROM articles ORDER BY id DESC LIMIT 1";
        $result = $conn->query($article_sql);
        $article = mysqli_fetch_assoc($result);
        header("Location:/isocial/views/article.php?id=".$article["id"]);
    }
    $conn->close();