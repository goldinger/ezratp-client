<?php
require('dbConnection.php');
require('model.php');
session_start();
$db = getDatabase();
$connected = false;

if(isset($_SESSION['email']) AND isset($_SESSION['password'])){
    $req_user = $db->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $req_user->execute(array($_SESSION['email'], $_SESSION['password']));
    $correct_ids = $req_user->rowCount();
    if ($correct_ids == 1) {
        $user_info = $req_user->fetch();
        $connected = true;
        $_SESSION['id'] = $user_info['id'];
        $_SESSION['username'] = $user_info['username'];
        $_SESSION['email'] = $user_info['email'];
        $_SESSION['password'] = $user_info['password'];
    }
}