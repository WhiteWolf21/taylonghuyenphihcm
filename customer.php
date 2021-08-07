<?php
session_start();
$user = ""; //prevent the "no index" error from $_POST
$pass = "";
if (isset($_POST['user'])) { // check for them and set them so
    $user = $_POST['user'];
}
if (isset($_POST['pass'])) { // so that they don't return errors
    $pass = $_POST['pass'];
}    

$useroptions = ['cost' => 8,]; // all up to you
$pwoptions   = ['cost' => 8,]; // all up to you
$userhash    = password_hash($user, PASSWORD_BCRYPT, $useroptions); // hash entered user
$passhash    = password_hash($pass, PASSWORD_BCRYPT, $pwoptions);  // hash entered pw
$hasheduser  = file_get_contents("../user.txt"); // this is our stored user
$hashedpass  = file_get_contents("../pwd.txt"); // and our stored password


if ($_SESSION["auth"] === true || ((password_verify($user, $hasheduser)) && (password_verify($pass,$hashedpass)))) {

    $_SESSION["auth"] = true;

    include("../db.php");
    

} else { 
    // if it was invalid it'll just display the form, if there was never a $_POST
    // then it'll also display the form. that's why I set $user to "" instead of a $_POST
    // this is the right place for comments, not inside html
    ?>  
    <form method="POST">
    Tài Khoản <br/> <input type="text" name="user"></input><br/><br/>
    Mật Khẩu <br/> <input type="password" name="pass"></input><br/><br/>
    <input type="submit" name="submit" value="Go"></input>
    </form>
    <?php 
} 