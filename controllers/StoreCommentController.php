<?php
    session_start();
    require_once ('../dbconnection.php');
    $redirect_link = $_SERVER['HTTP_REFERER'];
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $comment = $_POST["comment"];
        $token = $_POST["user"];
        $article = $_POST["article"];

        $user_sql = "SELECT id FROM users WHERE _token = '$token'";
        $result = mysqli_fetch_assoc($conn->query($user_sql));
        $user_id = $result["id"];
        date_default_timezone_set('Asia/Dhaka');
        $time = date('Y-m-d H:i:s');

        $comment_sql = "INSERT INTO comments VALUE ('','$time','$user_id','$article','$comment')";
        if($conn->query($comment_sql) == TRUE) echo "success";
        else echo "fail";
    }
    else{
        header($redirect_link);
    }
    $conn->close();