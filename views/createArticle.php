<?php
session_start();
if(!(isset($_SESSION['token']) && $_SESSION['logged_in_to'] == "isocial.com")){
    header('Location:/isocial/views/login.php');
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
        <link rel="stylesheet" href="../css/style.css">
        <link rel="stylesheet" href="../css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="../js/jquery.min.js"></script>
        <script src="../js/bootstrap.min.js"></script>
        <title>Create Article</title>
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
            <div class="col-md-12">
                <h1 class="header"><?php
                    if(isset($_SESSION["ln"])){
                        echo "নতুন আর্টিকেল লিখুন";
                    }
                    else echo "Write New Article";
                    ?></h1>
                <form method="post" action="../controllers/ArticleController.php">
                    <div class="form-group">
                        <label><?php
                            if(isset($_SESSION["ln"])){
                                echo "শিরোনাম";
                            }
                            else echo "Title";
                            ?></label>
                        <input class="form-control" type="text" name="title" required value="<?php if(isset($form_values["title"])) echo $form_values["title"];?>">
                        <?php
                        if(isset($errors["title"])){
                            ?>
                            <span class="help-block"><?php echo $errors["title"];?></span>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <label><?php
                            if(isset($_SESSION["ln"])){
                                echo "বিবরণ";
                            }
                            else echo "Description";
                            ?></label>
                        <textarea class="form-control" name="description" required>
                            <?php if(isset($form_values["description"])) echo $form_values["description"];?>
                        </textarea>
                        <?php
                        if(isset($errors["description"])){
                            ?>
                            <span class="help-block"><?php echo $errors["description"];?></span>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Create" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    </body>
    </html>
<?php
unset($_SESSION["errors"]);
?>