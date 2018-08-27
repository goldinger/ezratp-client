<?php
session_start();
$db = new PDO('mysql:host=localhost;dbname=ezratp', 'root', 'VnCdE28u');

if(isset($_POST['formsignin'])){
    $emailconnect = htmlspecialchars($_POST['emailconnect']);
    $passwordconnect = sha1($_POST['passwordconnect']);
    if(!empty($emailconnect) AND !empty($passwordconnect)){
        $req_user = $db->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
        $req_user->execute(array($emailconnect, $passwordconnect));
        $correct_ids = $req_user->rowCount();
        if($correct_ids == 1){
            $req_user = $req_user->fetch();
            $_SESSION['id'] = $req_user['id'];
            $_SESSION['username'] = $req_user['username'];
            $_SESSION['email'] = $req_user['email'];
            $_SESSION['password'] = $req_user['password'];
            header('Location: index.php');
        }
        else {
            $error_signin = "Wrong Ids";
        }
    }
    else {
        $error_signin = "Missing information for signup";
    }
}
?>

<form method="POST" action="">
    <input type="email" name="emailconnect" placeholder="email" />
    <input type="password" name="passwordconnect" placeholder="password" />
    <p style="color: red"><?php
    if(isset($error_signin)){
        echo $error_signin;
    }
    ?></p>
    <input name="formsignin" type="submit" value="Sign in">
</form>

