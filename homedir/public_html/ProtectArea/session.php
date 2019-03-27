<?php @session_start();
 if(!isset($_SESSION['user_session']) or !isset($_COOKIE['user_session'])){
  echo'<meta http-equiv="refresh" content="0; url=login.php" />';
 exit;}
?>