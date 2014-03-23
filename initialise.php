<?php
   session_start();
   
   $logged_in = FALSE;
   $username = "";

   if(isset($_SESSION['username'])) {
      $logged_in = TRUE;
      $username = $_SESSION['username'];
   }
?>
