<?php
include "connection.php";
if(!isset($_POST['sensCode'])){
    header('Location: index.php');
}

$stationId = $_POST["stationId"];
$stationName = $_POST['stationName'];
$lineId = $_POST['lineId'];
$lineName = $_POST['lineName'];
$sensCode = $_POST['sensCode'];
$sensName = $_POST['sensName'];

$missions = getNextMissions($lineId, $stationName, $sensCode);
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
            <div class="col-md-12 col-md-offset-5">

                <div class="col-sm-2 feat-list">
                    <?php
                    $i = 0;
                    foreach ($missions as $mission){
                        ?>
                        <div class="panel-group">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h4 class="panel-title" style="text-align: center">
                                        <?php echo $mission; ?> min
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                    if(isset($_SESSION['id'])) {
                        ?>
                        <form method="POST" action="addwatchlist.php">
                            <input type="hidden" name="userid" value="<?php echo $_SESSION['id']; ?>">
                            <input type="hidden" name="line" value="<?php echo $lineId; ?>">
                            <input type="hidden" name="station" value="<?php echo $stationName; ?>">
                            <input type="hidden" name="sens" value="<?php echo $sensCode; ?>">
                            <button class="navbar-btn nav-button wow bounceInRight login" type="submit" name="addwatchlist">Add to watchlist</button>
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