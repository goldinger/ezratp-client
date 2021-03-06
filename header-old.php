<?php
require('model.php');

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


if($connected){
?>
    <h3>Hello <?php echo $_SESSION['username'] ?></h3>
    <form method="post" action="disconnect.php">
        <input type="submit" name="disconnect" value="Disconnect">
    </form>
    <h3>Dashboard</h3>
    <?php
    $req_watchlist = $db->prepare("SELECT * FROM watchlist WHERE user_id = ?");
    $req_watchlist->execute(array($_SESSION['id']));
    while ($row = $req_watchlist->fetch()){
        ?>
        <h4><?php echo $row['station']; ?> | <?php echo $row['line']; ?> | <?php echo $row['sens']; ?></h4>
        <?php
        $missions = getNextMissions($row['line'], $row['station'], $row['sens']);
        foreach ($missions as $mission)
        {
            ?>
            <p><?php echo $mission ?></p>
            <?php
        }
    }
    ?>
<?php
}
else {
    include 'signinForm.php';
}
?>

