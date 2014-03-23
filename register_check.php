<?php
require_once ("db.php");
require_once ("initialise.php");
$username=isset($_POST["username"])?$_POST["username"]:"";

$password=isset($_POST["password"])?$_POST["password"]:"";

$confirm=isset($_POST["confirm"])?$_POST["confirm"]:"";

if(!empty($username)&&!empty($password)){

	if($password!=$confirm){
		//1 means the password and repeated one are different
		echo "1";
	}
	else{

		$link=mysql_connect($sql_server,$db_username,$db_password) or die(mysql_error());

		mysql_select_db($db_name,$link);

		$query="SELECT * FROM users WHERE username='".mysql_escape_string($username)."'";

		$result=mysql_query($query);

		$count=mysql_num_rows($result);

		if($count==1)
			//2 means the username already exists
			echo "2";

		else

		{
			//insert the new username and password in mysql
			$qry="INSERT INTO users(username,password)VALUES('".mysql_escape_string($username)."'
				,'".mysql_escape_string($password)."')";

mysql_query($qry);
//echo all username in mysql to display them in offline list
$sql="SELECT username FROM users";
$result = mysql_query($sql) or die(mysql_error());
while($row = mysql_fetch_array( $result )) {
	echo  "<p>".$row['username'] . "</p>";

}    

}

mysql_close($link);

}
}
else
{
	//3 means the username and password is blank
	echo "3";

}
?>