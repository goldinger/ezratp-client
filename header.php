<?php
session_start();
$db = new PDO('mysql:host=localhost;dbname=ezratp', 'root', 'VnCdE28u');

$connected = false;
if(isset($_SESSION['email']) AND isset($_SESSION['password'])){
    $req_user = $db->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $req_user->execute(array($_SESSION['email'], $_SESSION['password']));
    $user_exists = $req_user->rowCount();
    if($user_exists == 1){
        $connected = true;
        $req_user = $req_user->fetch();
        $_SESSION['id'] = $req_user['id'];
        $_SESSION['username'] = $req_user['username'];
        $_SESSION['email'] = $req_user['email'];
        $_SESSION['password'] = $req_user['password'];
    }
}

if($connected){
?>
<h3>Hello <?php echo $_SESSION['username'] ?></h3>
<?php
}
else {
    include 'signinForm.php';
}
?>

