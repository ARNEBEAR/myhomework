<?php 
session_start();
require_once("db.php");
require_once("initialise.php");
$postmsg=isset($_POST["postmsg"])?$_POST["postmsg"]:"";
$link=mysql_connect($sql_server,$db_username,$db_password) or die(mysql_error());
//if user input something in input window, insert data in mysql when he clicks send button
if ($postmsg != ""){
    mysql_select_db($db_name,$link);
$qry="INSERT INTO users(author,body)VALUES('".mysql_escape_string($username)."'
        ,'".mysql_escape_string($postmsg)."')";

mysql_query($qry);

       $posts_query = "SELECT * FROM users WHERE body != ''";
         $posts_result = mysql_query($posts_query);
         while($posts_row = mysql_fetch_assoc($posts_result)) {
            echo "<em>" . $posts_row['author'] . ":&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</em><span>" . $posts_row['body'] . "</span><br/>";
  }

 }
//if user input nothing in input window, preventing insertting blank row in mysql
else{
	 $posts_query = "SELECT * FROM users WHERE body != ''";
         $posts_result = mysql_query($posts_query);
         while($posts_row = mysql_fetch_assoc($posts_result)) {
            echo "<em>" . $posts_row['author'] . ":&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</em><span>" . $posts_row['body'] . "</span><br/>";
  }
}
  mysql_close($link);

?>