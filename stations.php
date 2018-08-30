<?php
include "connection.php";
if(!isset($_POST["station"])){
    header("Location: index.php");
}
$search = $_POST["station"];
$stations = getStationsByName($search);
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
                        <h2>Station search : <?php echo $search; ?></h2>
                        <br>
                    </div>
                </div>

                <div class="row row-feat">
                    <div class="col-md-12 col-md-offset-3">

                        <div class="col-sm-6 feat-list">
                            <?php
                            $i = 0;
                            foreach ($stations as $station){
                                $i = $i + 1;
                                ?>
                                <form id="station<?php echo $i; ?>" method="post" action="directions.php">
                                    <input type="hidden" name="stationId" value="<?php echo $station->id; ?>"/>
                                    <input type="hidden" name="stationName" value="<?php echo $station->name; ?>"/>
                                    <input type="hidden" name="lineId" value="<?php echo $station->line->id; ?>"/>
                                    <input type="hidden" name="lineName" value="<?php echo $station->line->reseau->name . " " . $station->line->code; ?>"/>
                                    <div class="panel-group" style="cursor: pointer" onclick='document.getElementById("station<?php echo $i; ?>").submit()'>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title fqa-title">
                                                    <?php echo $station->name; ?><br><?php echo $station->line->reseau->name . " " . $station->line->code; ?>
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