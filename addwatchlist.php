<?php
session_start();
$db = new PDO('mysql:host=localhost;dbname=ezratp', 'root', 'VnCdE28u');

if(!empty($_POST['userid']) AND !empty($_POST['line']) AND !empty($_POST['station']) AND !empty($_POST['sens'])){
    $req_add_watchlist = $db->prepare("INSERT INTO watchlist (user_id, line, station, sens) values (?, ?, ?, ?)");
    $req_add_watchlist->execute(array($_POST['userid'], $_POST['line'], $_POST['station'], $_POST['sens']));
    header('Location: index.php');
}