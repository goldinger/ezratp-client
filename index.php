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
            <div class="slider">
                <div id="bg-slider" class="owl-carousel owl-theme">

                    <div class="item"><img src="assets/img/slide1/slider-image-1.jpg" alt="GTA V"></div>
                    <div class="item"><img src="assets/img/slide1/slider-image-2.jpg" alt="The Last of us"></div>
                    <div class="item"><img src="assets/img/slide1/slider-image-1.jpg" alt="GTA V"></div>

                </div>
            </div>
            <div class="slider-content">
                <div class="row">
                    <div class="col-lg-4 col-lg-offset-4 col-md-10 col-md-offset-1 col-sm-12">
                        <h2>Find a station</h2>
                        <div class="search-form wow pulse" data-wow-delay="0.8s">
                            <form action="stations.php" class=" form-inline">
                                <div class="form-group">
                                    <input type="text" name="data" class="form-control" placeholder="Station">
                                </div>
                                <button class="btn search-btn" type="submit"><i class="fa fa-search"></i></button>
                                <div style="display: none;" class="search-toggle">

                                    <div class="search-row">

                                        <div class="form-group mar-r-20">
                                            <label for="price-range">Price range ($):</label>
                                            <input type="text" class="span2" value="" data-slider-min="0"
                                                   data-slider-max="600" data-slider-step="5"
                                                   data-slider-value="[0,450]" id="price-range" ><br />
                                            <b class="pull-left color">2000$</b>
                                            <b class="pull-right color">100000$</b>
                                        </div>
                                        <!-- End of  -->

                                        <div class="form-group mar-l-20">
                                            <label for="property-geo">Property geo (m2) :</label>
                                            <input type="text" class="span2" value="" data-slider-min="0"
                                                   data-slider-max="600" data-slider-step="5"
                                                   data-slider-value="[50,450]" id="property-geo" ><br />
                                            <b class="pull-left color">40m</b>
                                            <b class="pull-right color">12000m</b>
                                        </div>
                                        <!-- End of  -->
                                    </div>

                                    <div class="search-row">

                                        <div class="form-group mar-r-20">
                                            <label for="price-range">Min baths :</label>
                                            <input type="text" class="span2" value="" data-slider-min="0"
                                                   data-slider-max="600" data-slider-step="5"
                                                   data-slider-value="[250,450]" id="min-baths" ><br />
                                            <b class="pull-left color">1</b>
                                            <b class="pull-right color">120</b>
                                        </div>
                                        <!-- End of  -->

                                        <div class="form-group mar-l-20">
                                            <label for="property-geo">Min bed :</label>
                                            <input type="text" class="span2" value="" data-slider-min="0"
                                                   data-slider-max="600" data-slider-step="5"
                                                   data-slider-value="[250,450]" id="min-bed" ><br />
                                            <b class="pull-left color">1</b>
                                            <b class="pull-right color">120</b>
                                        </div>
                                        <!-- End of  -->

                                    </div>
                                    <br>
                                    <div class="search-row">

                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"> Fire Place(3100)
                                                </label>
                                            </div>
                                        </div>
                                        <!-- End of  -->

                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"> Dual Sinks(500)
                                                </label>
                                            </div>
                                        </div>
                                        <!-- End of  -->

                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"> Hurricane Shutters(99)
                                                </label>
                                            </div>
                                        </div>
                                        <!-- End of  -->
                                    </div>

                                    <div class="search-row">

                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"> Swimming Pool(1190)
                                                </label>
                                            </div>
                                        </div>
                                        <!-- End of  -->

                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"> 2 Stories(4600)
                                                </label>
                                            </div>
                                        </div>
                                        <!-- End of  -->

                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"> Emergency Exit(200)
                                                </label>
                                            </div>
                                        </div>
                                        <!-- End of  -->
                                    </div>

                                    <div class="search-row">

                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"> Laundry Room(10073)
                                                </label>
                                            </div>
                                        </div>
                                        <!-- End of  -->

                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"> Jog Path(1503)
                                                </label>
                                            </div>
                                        </div>
                                        <!-- End of  -->

                                        <div class="form-group">
                                            <div class="checkbox">
                                                <label>
                                                    <input type="checkbox"> 26' Ceilings(1200)
                                                </label>
                                            </div>
                                        </div>
                                        <!-- End of  -->
                                        <br>
                                        <hr>
                                    </div>
                                    <button class="btn search-btn prop-btm-sheaerch" type="submit"><i class="fa fa-search"></i></button>
                                </div>

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