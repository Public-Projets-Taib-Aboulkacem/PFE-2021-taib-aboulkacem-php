<?php
 session_start();
 session_destroy();
 
 $_SESSION = [];
 
 setcookie('pseudo','',time()-3600);
 header('location: Connexion.php');
?>