<?php
require_once ("db.php");
require_once ("initialise.php");
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>COMP333-14A Assignment 1</title>
	<!-- link the external CSS file -->
	<link rel="stylesheet" href="style.css">
</head>

<body>
	<div class="container">
		<section class="header">
			<div class="logo">
				<h1>
					COMP333-14A 11
					<br/>
					ASSIGNMENT1
				</h1>
			</div>
			<div id="log">
				<!-- 
					if user logs in, he will see the log out button at top right,
					if he logs out, he will see both log in and register buttons,
					no matter if they refresh the page, the result will be kept because
					of the session used in my code. 
				-->
				<?php
				if($logged_in) {
					echo "Welcome, <strong>".$username."</strong>";
					echo '<div id="logout">
					<a onclick="logout()">Log out</a>
					</div>';

				} else {
					echo '<div id="login">
					<a onclick="login()">Log in</a>
					</div>
					<div id="register">
					<a onclick="register()">Register</a>
					</div>';
				}
				?>
				
			</div>
		</section>
		<section id="onoffline">
			<div id="online">
				<h2>Online</h2>
				<div id="online2">
				<!-- 
					if user logs in, he will see his name displays in "online" list at right,
					no matter if they refresh the page, the result will be kept because
					of the session used in my code. 
				-->
				<?php
				if($logged_in) {
					echo $username;
				} 
				?>
			</div>
			</div>
			<div id="offline">
				<h2>Offline</h2>
				<div id="offline2">
				<!--
					if user log out, he will see all the users stored in mysql in "offline" list,
					no matter if they refresh the page, the result will be kept because
					of the session used in my code. 
				-->

				<?php
				
				if($logged_in) {
					// Loop through the results to show all users stored in mysql
					$sql="SELECT username FROM users WHERE username != '$username'";
				$result = mysql_query($sql) or die(mysql_error());
					while($row = mysql_fetch_array( $result )) {
						$names = $row['username'];
						
						echo "<p>".$names."</p>";
					} 				
				} 
				else{
					$sql="SELECT username FROM users";
				$result = mysql_query($sql) or die(mysql_error());
					// Loop through the results
					while($row = mysql_fetch_array( $result )) {
						$names = $row['username'];
						echo "<p>".$names."</p>";
					} 
				}
				?>
			</div>
			</div>
		</section>
	</div>
	<!-- this div is to show the message for user when he successfully register -->
	<h3 id="registersuccessful"></h3>
	<section id="ajax">
		<!-- 
			if user logs in, he will see a chat window,
			if they log out, he will see nothing,
			no matter if they refresh the page, the result will be kept because
			of the session used in my code. 
		-->

		<?php
		if($logged_in) {
			echo '<section id="chat">
			<div id="chatwindow">';
			 $posts_query = "SELECT * FROM users WHERE body != ''";
         $posts_result = mysql_query($posts_query);
         while($posts_row = mysql_fetch_assoc($posts_result)) {
            echo "<em>" . $posts_row['author'] . ":&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</em><span>" . $posts_row['body'] . "</span><br/>";
         }
         
		echo'</div>
			<input type="text" placeholder="Say something..." name="postmsg" id="postmsg">
			<input type="button" value="Send" onclick="send()" id="send"/>
			</section>';
		}
		?>
	</section>
	<!-- link the javascript file -->
	<script src="ajax.js"></script>
</body>
</html>