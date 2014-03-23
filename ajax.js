// create a function to build xmlhttprequest
function myajax(){
	var myrequest;
	if(window.ActiveXObject){
		myrequest=new ActiveXObject("Microsoft.XMLHTTP");
	}else{
		myrequest=new XMLHttpRequest();
	}
	return myrequest;
}
// initialist 6 different requests
var loginrequest="";
var checkloginrequest=""; 
var checkregisterrequest=""; 
var logoutrequest=""; 
var registerrequest=""; 
var sendrequest=""; 
//this is for user click log in button at top right
function login(){
	loginrequest=myajax();
	if(loginrequest){
		var url="login.php";
		loginrequest.open("post",url,true);
		loginrequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
		loginrequest.onreadystatechange=processforlogin;
		loginrequest.send("");
	}
}
//this is for user click register button at top right
function register(){
	registerrequest=myajax();
	if(registerrequest){
		var url="register.php";
		registerrequest.open("post",url,true);
		registerrequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
		registerrequest.onreadystatechange=processregister;
		registerrequest.send("");
	}
}
// this is for system to process the data user send after finishing the login form and then clicking the login button
function loginlogin(){
	checkloginrequest=myajax();
	if(checkloginrequest){
		var url="login_check.php";
		var data="&username="+$('username').value+"&password="+$('password').value;
		checkloginrequest.open("post",url,true);
		checkloginrequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
		checkloginrequest.onreadystatechange=processforchecklogin;
		checkloginrequest.send(data);
	}
}
//this is for system to process the data user sends after fininshing the form and clicking register button
function registerregister(){
	checkregisterrequest=myajax();
	if(checkregisterrequest){
		var url="register_check.php";
		var data="&username="+$('username').value+"&password="+$('password').value+"&confirm="+$('confirm').value;
		checkregisterrequest.open("post",url,true);
		checkregisterrequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
		checkregisterrequest.onreadystatechange=processforcheckregister;
		checkregisterrequest.send(data);
	}
}
//this is for user to click send button to "send some message or nothing"
function send(){
	sendrequest=myajax();
	if(sendrequest){
		var url="sendmessage.php";
		var data="&postmsg="+$('postmsg').value;
		sendrequest.open("post",url,true);
		sendrequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
		sendrequest.onreadystatechange=processforsendmsg;
		sendrequest.send(data);
	}
}
//this is for system to log user out when he clicks the log out button at top right
function logout(){
	logoutrequest=myajax();
	if(logoutrequest){
		var url="logout.php";
		logoutrequest.open("post",url,true);
		logoutrequest.setRequestHeader("Content-Type", "application/x-www-form-urlencoded")
		logoutrequest.onreadystatechange=processforlogout;
		logoutrequest.send("");
	}
}
//this function is to process the data which comes from login.php
function processforlogin(){
	if(loginrequest.readyState==4){
		// display login form
		$('ajax').innerHTML=loginrequest.responseText;
		//clear the message to inform users register successfully
		$('registersuccessful').innerHTML="";
	}
}
//this function is to process the data which comes from register.php
function processregister(){
	if(registerrequest.readyState==4){
		//display register form
		$('ajax').innerHTML=registerrequest.responseText;
	}
}
//clear all form
function cancel(){
	$('ajax').innerHTML="";
}
//this function is to process the data which comes from login_check.php
function processforchecklogin(){
	if(checkloginrequest.readyState==4){
		var loginornot = checkloginrequest.responseText;
		if (loginornot == 2){
			//2 means the username or password is wrong
			$('errormessage').innerHTML="Username or passowrd is wrong!"
		}
		else if (loginornot == 3){
			//3 means the username and Password cannot be blank
			$('errormessage').innerHTML="Username and Password cannot be blank!"
		}
		else {
			//use JSON to process all data to put them in an array.
			var checkloginrequestresult=JSON.parse(checkloginrequest.responseText);
			//show the chat window
			$('ajax').innerHTML=checkloginrequestresult[0];
			//show the chat infomation which are stored in mysql in chat window
			$('chatwindow').innerHTML=checkloginrequestresult.posts;
			//display log out button instead of log in and register buttons
			$('log').innerHTML=checkloginrequestresult[1];
			//display online users
			$('online2').innerHTML=checkloginrequestresult[2];
			//display offline users
			$('offline2').innerHTML=checkloginrequestresult.names;
		}
	}
}
//this function is to process the data which comes from register_check.php
function processforcheckregister(){
	if(checkregisterrequest.readyState==4){
		var checkregisterrequestresult=checkregisterrequest.responseText;
		if (checkregisterrequestresult==1){
			//1 means the password does not be match
			$('errormessage').innerHTML="Password does not be match.";
			
		}
		else if (checkregisterrequestresult==2){
			//2 means the username already exists
			$('errormessage').innerHTML="Username already exists";
			
		}
		else if (checkregisterrequestresult==3){
			//3 means the username or Password is blank
			$('errormessage').innerHTML="Username and Password cannnot be blank!";
			
		}

		else {
			//remove register form
			$('ajax').innerHTML="";
			//display offline users which are stored in mysql, now the new username appears in the list
			$('offline2').innerHTML=checkregisterrequestresult;
			//display message to tell user that he registers successfully, and he could log in to view and send messages
			$('registersuccessful').innerHTML="You are successfully registered. Please log in to view and post messages.";
		}

	}
}
//this function is to process the data which comes from sendmessage.php
function processforsendmsg(){
	if(sendrequest.readyState==4){
		var sendrequestresult=sendrequest.responseText;
			$('chatwindow').innerHTML=sendrequestresult;
			$('postmsg').value="";
	}
}
//this function is to process the data which comes from logout.php
function processforlogout(){
	if(logoutrequest.readyState==4){
		//use JSON to process all data to put them in an array.
		var logoutt = JSON.parse(logoutrequest.responseText);
			//display log in and register buttons instead of log out button
			$('log').innerHTML=logoutt[0];
			//remove the chat window and input window for users to input messages
			$('ajax').innerHTML="";
			//clear online list
			$('online2').innerHTML="";
			//display all users from mysql in offline list
			$('offline2').innerHTML=logoutt.names;
	}
}	
//this function is to make me easy to select an id from my html file instead of using document.getElementById every time.
	function $(id){
		return document.getElementById(id);
	}
