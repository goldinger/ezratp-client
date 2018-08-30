<?php include "connection.php"; ?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <?php
    $title = "Home page";
    include "head.php";
    ?>
    <body>
        <?php include "header.php"; ?>
        <?php
        if($connected) {
            $req_watchlist = $db->prepare("SELECT * FROM watchlist WHERE user_id = ?");
            $req_watchlist->execute(array($_SESSION['id']));
            ?>
            <!-- Dashboard -->
            <div class="content-area home-area-1 recent-property"
                 style="background-color: #FCFCFC; padding-bottom: 55px;">
                <div class="container">
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1 col-sm-12 text-center page-title">
                            <!-- /.feature title -->
                            <h2>Dashboard</h2>
                        </div>
                    </div>

                    <div class="row">
                        <div class="proerty-th">
                            <?php
                            while ($row = $req_watchlist->fetch()){
                                $missions = getNextMissions($row['line'], $row['station'], $row['sens']);
                                if(sizeof($missions) > 0){
                                    ?>
                                    <div class="col-sm-6 col-md-3 p0">
                                        <div class="box-two proerty-item">
                                            <div class="item-entry overflow">
                                                <h5>
                                                    <?php echo $row['station']; ?><br>
                                                    <?php echo $row['line']; ?><br>
                                                    <?php echo $row['sens']; ?>
                                                </h5>
                                                <div class="dot-hr"></div>
                                                <span class="pull-left"><b><?php echo $missions[0]; ?> min</b></span>
                                                <?php
                                                if(sizeof($missions) > 1){
                                                    ?>
                                                    <span class="pull-right"><?php echo $missions[1] ?> min</span>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php

                                }
                            }
                            ?>
<!--                            <div class="col-sm-6 col-md-3 p0">-->
<!--                                <div class="box-tree more-proerty text-center">-->
<!--                                    <div class="item-tree-icon">-->
<!--                                        <i class="fa fa-th"></i>-->
<!--                                    </div>-->
<!--                                    <div class="more-entry overflow">-->
<!--                                        <h5><a href="property-1.html">CAN'T DECIDE ? </a></h5>-->
<!--                                        <h5 class="tree-sub-ttl">Show all properties</h5>-->
<!--                                        <button class="btn border-btn more-black" value="All properties">All-->
<!--                                            properties-->
<!--                                        </button>-->
<!--                                    </div>-->
<!--                                </div>-->
<!--                            </div>-->

                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
        <div class="slider-area">
            <?php include "slider.php"; ?>
            <div class="slider-content">
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-4 col-md-10 col-md-offset-1 col-sm-12">
                        <h2>Find a station</h2>
                        <div class="search-form wow pulse" data-wow-delay="0.8s">
                            <form method="post" action="stations.php" class="form-inline">
                                <div class="form-group">
                                    <input type="text" name="station" class="form-control" placeholder="Station">
                                </div>
                                <button class="btn search-btn" type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include "footer.php"; ?>
        <?php include "scripts.php"; ?>
    </body>
</html>