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
        <title>Index</title>
    </head>
    <body>
    <?php if(isset($_SESSION["ln"])){
        include('menu_bn.php');
    }
    else include('menu.php');
    ?>
    <div class="container">
        <div class="main">
            <div class="col-md-12">
                <h1 class="header">
                    <?php
                    if(isset($_SESSION["ln"])){
                        echo "আর্টিকেল সমূহ";
                    }
                    else echo "Articles";
                    ?>

                </h1>

                <?php
                if (isset($_GET['pageno'])) {
                    $pageno = $_GET['pageno'];
                } else {
                    $pageno = 1;
                }
                $no_of_records_per_page = 5;
                $offset = ($pageno-1) * $no_of_records_per_page;

                $total_pages_sql = "SELECT COUNT(*) FROM articles";
                $result = $conn->query($total_pages_sql);
                $total_rows = mysqli_fetch_array($result)[0];
                $total_pages = ceil($total_rows / $no_of_records_per_page);

                $query = "SELECT articles.*,users.name FROM articles,users WHERE articles.user_id = users.id ORDER BY articles.id DESC LIMIT $offset, $no_of_records_per_page";

                $result = $conn->query($query);
                    while($article = mysqli_fetch_assoc($result)) {?>
                        <div class="col-md-12 article">
                            <h1 class="title">
                               <?php echo $article["title"];?>
                            </h1>
                            <div class="article-info">
                                <span><i class="fa fa-clock-o"></i> <?php echo $article["created_at"];?></span>
                                <span><i class="fa fa-user"></i><?php echo ucwords($article["name"]);?></span>
                            </div>
                            <div>
                                <?php
                                $words = explode(" ",$article["description"]);
                                if(sizeof($words)>50) $limit = 50;
                                else $limit = sizeof($words);
                                for($i = 0; $i<$limit; $i++){
                                    echo $words[$i]." ";
                                }?>

                                <a href="article.php?id=<?php echo $article["id"];?>">
                                    <?php
                                    if(isset($_SESSION["ln"])){
                                        echo "আরও পড়ুন";
                                    }
                                    else echo "Read more";
                                    ?>
                                </a>

                            </div>
                        </div>

                        <?php
                    }
                    ?>
                <div class="col-md-12">
                    <center>
                        <ul class="pagination">
                            <li><a href="?pageno=1">
                                    <?php
                                    if(isset($_SESSION["ln"])){
                                        echo "প্রথম";
                                    }
                                    else echo "First";
                                    ?>
                                </a></li>
                            <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?>">
                                <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">
                                    <?php
                                    if(isset($_SESSION["ln"])){
                                        echo "পূর্ববর্তী";
                                    }
                                    else echo "Prev";
                                    ?>
                                </a>
                            </li>
                            <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                                <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">
                                    <?php
                                    if(isset($_SESSION["ln"])){
                                        echo "পরবর্তী";
                                    }
                                    else echo "Next";
                                    ?>
                                </a>
                            </li>
                            <li><a href="?pageno=<?php echo $total_pages; ?>">
                                    <?php
                                    if(isset($_SESSION["ln"])){
                                        echo "শেষ";
                                    }
                                    else echo "Last";
                                    ?>
                                </a></li>
                        </ul>
                    </center>
                </div>
            </div>
        </div>
    </div>
    </body>
    </html>
<?php
unset($_SESSION["errors"]);
?>