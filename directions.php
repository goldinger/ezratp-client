<?php
include "connection.php";
if(!isset($_POST['stationName'])){
    header('Location: index.php');
}

$stationId = $_POST["stationId"];
$stationName = $_POST['stationName'];
$lineId = $_POST['lineId'];
$lineName = $_POST['lineName'];
$directions = getDirections($lineId)->directions;

?>
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
        <!-- property area -->
        <div class="content-area recent-property" style="background-color: #FCFCFC; padding-bottom: 55px;">
            <div class="container">

                <div class="row">
                    <div class="col-md-10 col-md-offset-1 col-sm-12 text-center page-title">
                        <!-- /.feature title -->
                        <h2>Station: <?php echo $stationName; ?></h2>
                        <h2>Line: <?php echo $lineName; ?></h2>
                        <br>
                    </div>
                </div>

                <div class="row row-feat">
                    <div class="col-md-12 col-md-offset-3">

                        <div class="col-sm-6 feat-list">
                            <?php
                            $i = 0;
                            foreach ($directions as $direction){
                                ?>
                                <form id="station<?php echo $i; ?>" method="post" action="missions.php">
                                    <input type="hidden" name="stationId" value="<?php echo $stationId; ?>"/>
                                    <input type="hidden" name="stationName" value="<?php echo $stationName; ?>"/>
                                    <input type="hidden" name="lineId" value="<?php echo $lineId; ?>"/>
                                    <input type="hidden" name="lineName" value="<?php echo $lineName; ?>"/>
                                    <input type="hidden" name="sensCode" value="<?php echo $direction->sens; ?>"/>
                                    <input type="hidden" name="sensName" value="<?php echo $direction->name; ?>"/>
                                    <div class="panel-group" style="cursor: pointer" onclick='document.getElementById("station<?php echo $i; ?>").submit()'>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title fqa-title">
                                                    <?php echo $direction->name; ?>
                                                </h4>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <?php
                            }
                            ?>

                        </div>

                    </div>
                </div>

            </div>
        </div>

        <?php include "footer.php"; ?>
        <?php include "scripts.php"; ?>
    </body>
</html>