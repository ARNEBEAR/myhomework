<?php 
session_start();
require_once("db.php");
require_once("initialise.php");
$username=isset($_POST["username"])?$_POST["username"]:"";

$password=isset($_POST["password"])?$_POST["password"]:"";

if(!empty($username)&&!empty($password)){

  ///open connection

  $link=mysql_connect($sql_server, $db_username, $db_password) or die(mysql_error());

  mysql_select_db($db_name,$link);

  $query="SELECT * FROM users WHERE username='".mysql_escape_string($username)."'
  AND password='".mysql_escape_string($password)."'";

  $result=mysql_query($query);

  $count=mysql_num_rows($result);

  if($count==1){

    $_SESSION["username"]=$username;
    $backarray = array();
    //data1:display chat window
    $backresult='<section id="chat">
    <div id="chatwindow"></div>
    <input type="text" placeholder="Say something..." name="postmsg" id="postmsg">
    <input type="button" value="Send" onclick="send()" id="send"/>
    </section>';
    $posts=array();
    $posts_query = "SELECT * FROM users WHERE body != ''";
    $posts_result = mysql_query($posts_query);
    while($posts_row = mysql_fetch_assoc($posts_result)) {
       $posts[] = "<em>" . $posts_row['author'] . ":&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</em><span>" . $posts_row['body'] . "</span><br/>";
    }
    //data2: display welcome infomation and log out button to user at top right of window
    $backresult2='Welcome, '.$username.'<div id="logout">
    <a onclick="logout()">Log out</a>
    </div>';
    //data3: display the username in online list
    $backresult3=$username;
    //now I have three data and store them in an array    
    $backarray=array($backresult,$backresult2,$backresult3);
    $names=array();
    $sql="SELECT username FROM users WHERE username != '$username'";
    $result = mysql_query($sql) or die(mysql_error());
    while($row = mysql_fetch_array( $result )) {
      $names[] =  "<p>".$row['username'] . "</p>";

    }
    //use implode to clear the commas between each item in my 2 small array    
    $comma_separated = implode(" ", $names);
    $comma_separated2 = implode(" ", $posts);
    //now I push two more items in my array, so now I have 5 data in my array
    $backarray['names'] = $comma_separated;
    $backarray['posts'] = $comma_separated2;
    //use json to encode the array
    echo json_encode($backarray);
  }

  else

  {
    //2 means user not found
    echo "2";

  }

  mysql_close($link);


}

else

{
  //3 means username or password cannot be blank
  echo "3";
}
?>