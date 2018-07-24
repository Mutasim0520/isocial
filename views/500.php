<?php
session_start();
if(isset($_SESSION['errors'])){
    $errors = $_SESSION['errors'];
}
?>
<!DOCTYPE html>
<html>
<head>

    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <script src="../js/bootstrap.min.js"></script>
</head>
<body>
<?php include('menu.php');?>
<div class="container">
    <div class="main">
        <div class="col-md-12 auth_container">
            Sorry something went wrong. Please try again.
        </div>
    </div>
</div>
</body>
</html>