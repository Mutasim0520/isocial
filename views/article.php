<?php
session_start();
require_once('../dbconnection.php');
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
        <title>Detail</title>
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
                    <?php
                    $id = $_GET["id"];
                    $article_query = "SELECT articles.*, users.name FROM articles,users WHERE articles.id = '$id' AND articles.user_id = users.id";
                    $result = $conn->query($article_query);
                    $article = mysqli_fetch_assoc($result);
                    ?>
                <div class="article">
                    <h1 class="title">
                        <?php echo $article["title"];?>
                    </h1>
                    <div class="article-info">
                        <span><i class="fa fa-clock-o"></i> <?php echo $article["created_at"];?></span>
                        <span><i class="fa fa-user"></i><?php echo ucwords($article["name"]);?></span>
                    </div>
                    <div>
                        <?php echo $article["description"];?>
                    </div>
                        <h3><?php
                            if(isset($_SESSION["ln"])){
                                echo "মন্তব্য সমূহ";
                            }
                            else echo "Comments";
                            ?></h3>
                        <?php
                        if(isset($_SESSION['token']) && $_SESSION['logged_in_to'] == "isocial.com"){
                            ?>
                            <form action="javascript:addComment();">
                                <div class="form-group">
                                    <input name="comment" type="text" required class="form-control" placeholder="Leave a comment">
                                </div>
                            </form>
                            <?php
                        }else{

                            $_SESSION['requested_route'] = "/isocial/views/article.php?id=".$article["id"];
                            ?>
                            Please <a href="login.php">Sign In</a> to comment
                            <?php
                        }

                        ?>
                    <div class="comment">
                        <?php
                        $comment_query = "SELECT * FROM comments,users WHERE comments.article_id = '$id' AND users.id = comments.user_id";
                        $result = $conn->query($comment_query);
                        if($result){
                            while ($comment = mysqli_fetch_assoc($result)){
                                ?>
                                <p>
                                    <span class="commenter"><i class="fa fa-user"><?php echo ucwords($comment["name"]);?></i></span><?php echo $comment["body"];?>
                                </p>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function addComment() {
            var comment = $('input[name=comment]').val();
            var user = '<?php echo $_SESSION['token'];?>';
            var article = '<?php echo $article["id"];?>';
            $.ajax({
                url:"/isocial/controllers/StoreCommentController.php",
                type:"post",
                data:{comment:comment,user:user,article:article},
                success: function(msg){
                    if(msg == 'success'){
                        $('.comment').append('<p>'+
                            '<span class="commenter"><i class="fa fa-user"><?php echo ucwords($_SESSION["username"]);?></i></span>'+comment
                            +'</p>');
                        $('input[name=comment]').val("");
                    }
                }
            });
            console.log(comment);
        }
    </script>
    </body>
    </html>