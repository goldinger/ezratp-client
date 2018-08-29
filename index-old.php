<?php
require('dbConnection.php');
session_start();
$db = getDatabase();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>ezratp</title>
</head>
<body>
<?php include 'header-old.php'; ?>
<h1>Check up a station :</h1>
<form action="/stations.php">
    Station Name:<br>
    <input type="text" name="data">
    <input type="submit">
</form>
</body>
</html>