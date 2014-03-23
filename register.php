<?php
	echo '<section id="registerinput"><form name="reg_form" id="reg_form" method="post" action="confirm.php">
			<div class="loginusername">
				<input type="text" placeholder="Username" name="username" id="username">
			</div>
			<div class="loginpwd">
				<input type="password" placeholder="Password" name="password" id="password">
			</div>
			<div class="loginpwd">
				<input type="password" placeholder="Repeat Password" name="confirm" id="confirm">
			</div>
			<div class="loginsubmit">
			<input type="button" name="btnsubmit" id="btnsubmit" value="Register" onclick="registerregister()"/>
			<input type="button" value="Cancel" onclick="cancel()"/>
			</div>
		</form> 
		<div id="errormessage"></div> </div>'
?>