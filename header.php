<?php
session_start();
$db = new PDO('mysql:host=localhost;dbname=ezratp', 'root', 'VnCdE28u');

$connected = false;

if(isset($_POST['formsignin'])){
    $emailconnect = htmlspecialchars($_POST['emailconnect']);
    $passwordconnect = sha1($_POST['passwordconnect']);
    if(!empty($emailconnect) AND !empty($passwordconnect)){
        $req_user = $db->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
        $req_user->execute(array($emailconnect, $passwordconnect));
        $correct_ids = $req_user->rowCount();
        if($correct_ids == 1){
            $user_info = $req_user->fetch();
            $connected = true;
            $_SESSION['id'] = $user_info['id'];
            echo $user_info['username'];
            $_SESSION['username'] = $user_info['username'];
            echo $_SESSION['username'];
            $_SESSION['email'] = $user_info['email'];
            $_SESSION['password'] = $user_info['password'];
        }
        else {
            $error_signin = "Wrong Ids";
        }
    }
    else {
        $error_signin = "Missing information for signup";
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

