<?php include "connection.php"; ?>
<?php

if(isset($_SESSION['email']) AND isset($_SESSION['password'])){
    header("Location: index.php");
}

if(isset($_POST['formsignup'])){
    if(!empty($_POST['username']) AND !empty($_POST['email']) AND !empty($_POST['email2']) AND !empty($_POST['password']) AND !empty($_POST['password2'])){
        $username = htmlspecialchars($_POST['username']);
        $email = htmlspecialchars($_POST['email']);
        $email2 = htmlspecialchars($_POST['email2']);
        $password = sha1($_POST['password']);
        $password2 = sha1($_POST['password2']);
        if(strlen($username) <= 255 OR strlen($email) <= 255 OR strlen($password) <= 255){
            if($email == $email2){
                if(filter_var($email, FILTER_VALIDATE_EMAIL)){
                    if ($password == $password2) {
                        $req_username = $db->prepare("SELECT * FROM users WHERE username = ?");
                        $req_username->execute(array($username));
                        $username_exists = $req_username->rowCount();
                        if($username_exists == 0){
                            $req_email = $db->prepare("SELECT * FROM users WHERE email = ?");
                            $req_email->execute(array($email));
                            $email_exists = $req_email->rowCount();

                            if($email_exists == 0){
                                $insertmbr = $db->prepare("INSERT INTO users(username, email, password) VALUES (?, ?, ?)");
                                $insertmbr->execute(array($username, $email, $password));
                                $error = "OK !!";
                                header("Location: index.php");
                            }
                            else {
                                $error = "Email already exists";
                            }
                        }
                        else {
                            $error = "Username already exists";
                        }


                    } else {
                        $error = "Passwords does not match";
                    }
                }
                else {
                    $error = "Not a valid email";
                }
            }
            else {
                $error = "Email addresses does not match";
            }
        }
        else {
            $error = "parameters too long. Must not exceed 255 characters";
        }
    }
    else {
        $error = "Missing informations";
    }
}

if(isset($_POST['formsignin'])){
    $emailconnect = htmlspecialchars($_POST['emailconnect']);
    $passwordconnect = sha1($_POST['passwordconnect']);
    if(!empty($emailconnect) AND !empty($passwordconnect)){
        $req_user = $db->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
        $req_user->execute(array($emailconnect, $passwordconnect));
        $correct_ids = $req_user->rowCount();
        if($correct_ids == 1){
            $user_info = $req_user->fetch();
            $_SESSION['id'] = $user_info['id'];
            $_SESSION['username'] = $user_info['username'];
            $_SESSION['email'] = $user_info['email'];
            $_SESSION['password'] = $user_info['password'];
            header("Refresh:0");
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

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <?php include "head.php"; ?>
    <body>
        <?php include "header.php"; ?>
        <!-- register-area -->
        <div class="register-area" style="background-color: rgb(249, 249, 249);">
            <div class="container">
                <div class="col-md-6">
                    <div class="box-for overflow">
                        <div class="col-md-12 col-xs-12 login-blocks">
                            <h2>Login : </h2>
                            <p style="color: red">
                                <?php
                                if(isset($error_signin)){
                                    echo $error_signin;
                                }
                                ?>
                            </p>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" name="emailconnect" id="email">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="passwordconnect" id="password">
                                </div>
                                <div class="text-center">
                                    <input name="formsignin" type="submit" class="btn btn-default" value="Log in">
                                </div>
                            </form>
                        </div>

                    </div>
                </div>

                <div class="col-md-6">
                    <div class="box-for overflow">
                        <div class="col-md-12 col-xs-12 register-blocks">
                            <h2>New account : </h2>
                            <?php
                            if(isset($error)){
                                echo '<p style="color: red">' . $error . '</p>';
                            }
                            ?>
                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="username">Username</label>
                                    <input value="<?php if(isset($username)){ echo $username; }?>"
                                           type="text"
                                           class="form-control"
                                           name="username"
                                           id="username">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email"
                                           class="form-control"
                                           name="email"
                                           id="email"
                                           value="<?php if(isset($email)){ echo $email; } ?>">
                                </div>
                                <div class="form-group">
                                    <label for="email2">Confirm your Email</label>
                                    <input type="email"
                                           class="form-control"
                                           name="email2"
                                           id="email2">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password">
                                </div>
                                <div class="form-group">
                                    <label for="password2">Confirm your password</label>
                                    <input type="password" name="password2" class="form-control" id="password2">
                                </div>
                                <div class="text-center">
                                    <input type="submit" name="formsignup" class="btn btn-default" value="Register">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>      

        <?php include "footer.php"; ?>
        <?php include "scripts.php"; ?>
    </body>
</html>