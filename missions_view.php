<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>EZ RATP</title>
</head>
<body>
<h1>Easy Ratp</h1>
<h2>Station : <?php echo $stationName; ?></h2>
<h2>Line : <?php echo $lineName ?></h2>
        <?php
        foreach ($missions as $mission)
        {
            ?>
            <p><?php echo $mission ?></p>
            <?php
        }
        if(isset($_SESSION['id'])){
            ?>
        <form method="POST" action="addwatchlist.php"   >
            <input type="hidden" name="userid" value="<?php echo $_SESSION['id']; ?>">
            <input type="hidden" name="line" value="<?php echo $lineId; ?>">
            <input type="hidden" name="station" value="<?php echo $stationName; ?>">
            <input type="hidden" name="sens" value="<?php echo $sens; ?>">
            <input type="submit" name="addwatchlist" value="Add to my Watchlist">
        </form>
<?php
        }
        ?>
</body>
</html>