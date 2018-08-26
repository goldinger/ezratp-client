<?php

    $db = new PDO('mysql:host=localhost;dbname=ezratp', 'root', 'VnCdE28u');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

if(isset($_POST['formsignup'])){
    $username = htmlspecialchars($_POST['username']);
    $email = htmlspecialchars($_POST['email']);
    $email2 = htmlspecialchars($_POST['email2']);
    $password = sha1($_POST['password']);
    $password2 = sha1($_POST['password2']);
    if(!empty($_POST['username']) AND !empty($_POST['email']) AND !empty($_POST['email2']) AND !empty($_POST['password']) AND !empty($_POST['password2'])){
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
?>

<html>
    <head>
        <title>Sign up</title>
        <meta charset="utf-8">
    </head>
    <body>
        <div align="center">
            <h2>Sign up form</h2>
            <br><br><br>

            <?php
            if(isset($error)){
                echo '<p style="color: red">' . $error . '</p>';
            }
            ?>

            <form method="POST" action="">
                <table>
                    <tr align="right">
                        <td><label for="username">Pseudo :</label></td>
                        <td>
                            <input
                                    type="text"
                                    id="username"
                                    placeholder="Chose a username"
                                    name="username"
                                    value="<?php if(isset($username)){ echo $username; }?>"
                            />
                        </td>
                    </tr>
                    <tr align="right">
                        <td><label for="email">Email :</label></td>
                        <td><input
                                    type="email"
                                    id="email"
                                    placeholder="Enter your email address"
                                    name="email"
                                    value="<?php if(isset($email)){ echo $email; } ?>"
                            /></td>
                    </tr>
                    <tr align="right">
                        <td><label for="email2">Email confirmation :</label></td>
                        <td><input type="email" id="email2" placeholder="Confirm your email address" name="email2" /></td>
                    </tr>
                    <tr align="right">
                        <td><label for="password">Password :</label></td>
                        <td><input type="password" id="password" placeholder="Password" name="password" /></td>
                    </tr>
                    <tr align="right">
                        <td><label for="password2">Password confirmation :</label></td>
                        <td><input type="password" id="password2" placeholder="Confirm your password" name="password2" /></td>
                    </tr>
                    <tr align="right">
                        <td></td>
                        <td><br><input name="formsignup" type="submit" value="Sign Up !"></td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>