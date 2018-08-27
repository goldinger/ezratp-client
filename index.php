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
        echo $correct_ids;
        if($correct_ids == 1){
            $user_info = $req_user->fetch();
            echo $user_info["email"];
            echo $_SESSION['email'];
            $_SESSION['id'] = $user_info['id'];
            $_SESSION['username'] = $user_info['username'];
            $_SESSION['email'] = $user_info['email'];
            $_SESSION['password'] = $user_info['password'];
//            header('Location: index.php');
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
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>ezratp</title>
</head>
<body>
<?php
if(isset($_SESSION['id'])) { ?>
    <form method="POST" action="">
        <input type="email" name="emailconnect" placeholder="email"/>
        <input type="password" name="passwordconnect" placeholder="password"/>
        <p style="color: red"><?php
            if (isset($error_signin)) {
                echo $error_signin;
            }
            ?></p>
        <input name="formsignin" type="submit" value="Sign in">
    </form>
    <?php
}
?>

<?php //include 'header.php'; ?>
<h1>Check up a station :</h1>
<form action="/stations.php">
    Station Name:<br>
    <input type="text" name="data">
    <input type="submit">
</form>
</body>
</html>