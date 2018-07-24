<nav class="navbar navbar menu">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">iSocial</a>
        </div>
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right" id="nav_navbar-nav_navbar-right" style="text-align:right;">
            <li><a href="index.php">হোম</a></li>
            <?php
            if(isset($_SESSION['token']) && $_SESSION['logged_in_to'] == "isocial.com"){
                ?>
                <li><a href="createArticle.php">আর্টিকেল লিখুন</a></li>
                <li><a href="../controllers/signout.php">সাইন আউট</a></li>
                <?php
            }else{?>

                <li><a href="login.php">সাইন ইন</a></li>
                <li><a href="registration.php">নতুন অ্যাকাউন্ট খুলুন</a></li>
                <?php
            }
            ?>
            <li><a href="../controllers/changeLanguage.php?ln='en'">English</a></li>
            <li><a href="../controllers/changeLanguage.php?ln='bn'">বাংলা</a></li>
        </ul>
        </div>
    </div>
</nav>
