<?php

$user = "tayphihuyenlong_user"; // please replace with your user
$pass = "taylonghuyenphi_pwd"; // please replace with your passwd
// two ; was missing

$useroptions = ['cost' => 8,];
$userhash    = password_hash($user, PASSWORD_BCRYPT, $useroptions);
$pwoptions   = ['cost' => 8,];
$passhash    = password_hash($pass, PASSWORD_BCRYPT, $pwoptions);

echo $userhash;
echo "<br />";
echo $passhash;

?>