<?php

$bdd = new PDO('mysql:host=213.32.19.136;dbname=users', 'root', 'VnCdE28u');
if(isset($_POST['formsignup'])){
    if(!empty($_POST['username']) AND !empty($_POST['email']) AND !empty($_POST['email2']) AND !empty($_POST['password']) AND !empty($_POST['password2'])){
        echo "allrigh";
    }
    else{
        echo "ok";
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
            <form method="POST" action="">
                <table>
                    <tr align="right">
                        <td><label for="username">Pseudo :</label></td>
                        <td><input type="text" id="username" placeholder="Chose a username" name="username" /></td>
                    </tr>
                    <tr align="right">
                        <td><label for="email">Email :</label></td>
                        <td><input type="text" id="email" placeholder="Enter your email address" name="email" /></td>
                    </tr>
                    <tr align="right">
                        <td><label for="email2">Email confirmation :</label></td>
                        <td><input type="text" id="email2" placeholder="Confirm your email address" name="email2" /></td>
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