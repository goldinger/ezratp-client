<?php
    session_start();
    echo $_SESSION['id'];
    $db = new PDO('mysql:host=localhost;dbname=ezratp', 'root', 'VnCdE28u');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>ezratp</title>
</head>
<body>
<?php include 'header.php'; ?>
<h1>Check up a station :</h1>
<form action="/stations.php">
    Station Name:<br>
    <input type="text" name="data">
    <input type="submit">
</form>
</body>
</html>