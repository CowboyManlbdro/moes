<?php include 'bdconnect.php';
include 'request.php';

UserUpdate($db,$_GET['login'],$_GET['f'],$_GET['i'],$_GET['o'],$_GET['email']);
?>