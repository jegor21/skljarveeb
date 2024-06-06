<?php
session_start();
session_destroy();
header('Location: login2.php');
/*if (!isset($_SESSION['kasutaja'])) {
    header('Location: login.php');
    exit();
}
if(isset($_POST['logout'])){
    session_destroy();
    header('Location: login.php');
    exit();
}*/
?>
 