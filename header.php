<div id="preloader">
    <div id="status">&nbsp;</div>
</div>
<!-- Body content -->

<nav class="navbar navbar-default ">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navigation">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php"><img style="height: 250%;" src="assets/ezratp/logo.png" alt="logo"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse yamm" id="navigation">
            <div class="button navbar-right">
                <?php
                if($connected) { ?>
                    <form method="POST" action="disconnect.php">
                        <button class="navbar-btn nav-button wow fadeInRight" type="submit">Disconnect</button>
                    </form>
                    <?php
                }
                else {
                    ?>
                    <button class="navbar-btn nav-button wow bounceInRight login" onclick=" window.open('register.php')"
                            data-wow-delay="0.45s">Login</button>
                    <button class="navbar-btn nav-button wow fadeInRight" onclick=" window.open('register.php')"
                            data-wow-delay="0.48s">Register</button>
                    <?php
                }
                ?>
            </div>
            <ul class="main-nav nav navbar-nav navbar-right">
                <li class="dropdown ymm-sw " data-wow-delay="0.1s">
                    <a href="index.php" class="dropdown-toggle active" data-delay="200">Home</a>
                </li>
                <li class="wow fadeInDown" data-wow-delay="0.5s"><a href="">Contact</a></li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>
<!-- End of nav bar -->
        