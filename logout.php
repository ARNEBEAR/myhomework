<?php
require_once("db.php");
require_once("initialise.php");
session_start();
if(isset($_SESSION["username"])){

	unset($_SESSION["username"]);
	//data1: display login button and register button at top right instead of log out button
$backarray = array();
	$backresult= '<div id="login">
	<a onclick="login()">Log in</a>
	</div>
	<div id="register">
	<a onclick="register()">Register</a>
	</div>';
}
//now I have 1 data and store it in an array    
$backarray=array($backresult);
$sql="SELECT username FROM users";
$result = mysql_query($sql) or die(mysql_error());
					// Loop through the results
while($row = mysql_fetch_array( $result )) {
	$names[] =  "<p>".$row['username'] . "</p>";
} 
//use implode to clear the commas between each item in my small array  
$comma_separated = implode(" ", $names);
//now I push 1 more items in my array, so now I have 2 data in my array
$backarray['names'] = $comma_separated;
//use json to encode the array
echo json_encode($backarray);
?>