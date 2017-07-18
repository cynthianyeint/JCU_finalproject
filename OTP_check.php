<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login | JCU E-Services</title>

<link href="index.css" rel="stylesheet" type="text/css" />
<script type = "text/javascript" src = "jcuScript.js"> </script>
</head>

<body style="background-color:#F0F0F0;">

<!---------- header ---------->
<div style="background-color:#33389d;">
<table id="loginheader">
	<tr><td><img src="JCUlogo(blue).jpg" width="190px" height="100px" alt="JCU"/></td></tr>
</table>
</div>


<!--- body--->

<div id="login_box" >
<div id="login" >Login</div>
<div id="login_table">
    <table border ="0" align="center" width = "80%" cellspacing = "15">
		<form method ='post' action = 'database_functions.php' name = 'loginForm' onsubmit = 'return validateForm()'>
			<tr>
				<td colspan = "2">
					<b>Your OTP code has been sent to your email. </b>
				<td>
			</tr>
			<tr>
				<td align="right"><b>OTP:</b></td><td align ='center'>
					<input type = 'password' name = 'OTP_code' style ="height: 30px; border-radius:1px;" size = "30"/>
				</td>
			</tr>
			<tr>
				<td align ='center' height ="50" colspan = "2">
					<input type = 'submit' value = 'CONFIRM' name = 'confirm' 
							style ="width:150px; height:40px;  background-color:#E9E9E9; font-size:14px; border-radius:7px;"/>
				</td>
				
			</tr>
           
		</form>
	</table>
</div>

</div>

</body>

</html>
