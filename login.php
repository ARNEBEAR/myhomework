<?php
	echo '<section id="logininput"><form name="login_form" id="login_form" method="post" action="login_check.php">
			<?php echo isset($_GET["msg"])?$_GET["msg"]:"";?>
			<div class="loginusername">
				<input type="text" placeholder="Your Username" name="username" id="username">
			</div>
			<div class="loginpwd">
				<input type="password" placeholder="Your Password" name="password" id="password">
			</div>
			<div class="loginsubmit">
			<input type="button" name="btnsubmit" id="btnsubmit" value="login" onclick="loginlogin()"/>
			<input type="button" value="Cancel" onclick="cancel()"/>
			</div>
		</form>
		<div id="errormessage"></div> </div>'
?>