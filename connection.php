<?php  
$conn = mysqli_connect('localhost', 'taylongh_user', 'taylongh_pwd');  
    if (! $conn) {  
die("Connection failed" . mysqli_connect_error());  
}  
    else {  
mysqli_select_db($conn, 'taylongh_db');  
mysqli_set_charset($conn, 'utf8mb4');
}  
?>  