<?php

      ///$sql_server = "127.0.0.1";
$sql_server = "wwew";
      $db_username = "root";
      $db_password = "";
      $db_name = "login";


   $mysql = mysql_connect($sql_server, $db_username, $db_password);
   $db = mysql_select_db($db_name);
?>
