<?php
   session_start();
   unset($_SESSION["loggedin"]);

   header('Refresh: 2; URL = login.php');
?>
