﻿<?php
session_start();
if(isset($_SESSION['token']) && $_SESSION['logged_in_to'] == "isocial.com"){
    header('Location:/isocial/views/index.php');
}
if(isset($_SESSION['errors'])){
    $errors = $_SESSION['errors'];
}
if(isset($_SESSION['form_values'])){
    $form_values = $_SESSION['form_values'];
}
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="../css/style.css">
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <script src='https://www.google.com/recaptcha/api.js'></script>
        <title>Create Account</title>
</head>
<body>
    <?php
    if(isset($_SESSION["ln"])){
        include('menu_bn.php');
    }
    else include('menu.php');
    ?>
    <div class="container">
        <div class="main">
            <div class="col-md-12 auth_container">
                <h1><?php
                    if(isset($_SESSION["ln"])){
                        echo "অ্যাকাউন্ট তৈরি করুন";
                    }
                    else echo "Create Your Account";
                    ?></h1>
                <div class="col-md-offset-3 col-md-6 col-md-offset-3">
                    <form id="registration_form" method="post" action="../controllers/RegistrationController.php">
                        <div class="form-group">
                            <label>
                                <?php
                                if(isset($_SESSION["ln"])){
                                    echo "ইউসারনেম";
                                }
                                else echo "Username";
                                ?>
                            </label>
                            <input id="name" class="form-control" type="text" name="username" value="<?php if(isset($form_values["username"])) echo $form_values["username"];?>" required>
                            <?php
                            if(isset($errors["username"])){
                                ?>
                                <span class="help-block"><?php echo $errors["username"];?></span>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <label><?php
                                if(isset($_SESSION["ln"])){
                                    echo "ইমেইল";
                                }
                                else echo "Email";
                                ?></label>
                            <input id="email" class="form-control" type="email" name="email" required="" value="<?php if(isset($form_values["email"])) echo $form_values["email"];?>">
                            <?php
                            if(isset($errors["email"])){
                                ?>
                                <span class="help-block"><?php echo $errors["email"];?></span>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <label><?php
                                if(isset($_SESSION["ln"])){
                                    echo "পাসওয়ার্ড";
                                }
                                else echo "Password";
                                ?></label>
                            <input id="password" class="form-control" type="password" name="password" required="" value="<?php if(isset($form_values["password"])) echo $form_values["password"];?>">
                            <?php
                            if(isset($errors["password"])){
                                ?>
                                <span class="help-block"><?php echo $errors["password"];?></span>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="form-group">
                            <label> <?php
                                if(isset($_SESSION["ln"])){
                                    echo "পুনরায় পাসওয়ার্ড দিন";
                                }
                                else echo "Confirm Password";
                                ?></label>
                            <input id="re_password" class="form-control" type="password" name="re_password" required="" value="<?php if(isset($form_values["re_password"])) echo $form_values["password"];?>">
                            <?php
                            if(isset($errors["re_password"])){
                                ?>
                                <span class="help-block"><?php echo $errors["re_password"];?></span>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="g-recaptcha form-group" data-sitekey="6LfusWUUAAAAANwrqqAj_XZP6mJedF_UWMD-lWwQ"></div>
                        <div  class="form-group">
                            <input class="btn btn-default" type="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
    unset($_SESSION["errors"]);
    ?>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.15.0/jquery.validate.js"></script>
    <script src="../js/validator/registrationValidator.js"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
</body>
</html>
