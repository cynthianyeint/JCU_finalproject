<?php
	if (!isset($_SESSION))
		{	
			session_start();
		}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Request for Student Finances  | JCUeServices</title>
<link href="index.css" rel="stylesheet" type="text/css" />
<script type = "text/javascript" src = "jcuScript.js"> </script>
</head>

<body class="scrollbar">


<!---------- header ---------->
<div id="miniBar" >
	
		<table border= "0" width = "83%" align="center">
			<tr>
				<td align = "left">
					<a class="home" href="index.php">
					<img src="1405603016_Streamline-18.png" width="17px" height="17px" alt="Home" style="margin-top:4px;" />  Home</a>
				</td>
				<td valign= "bottom" align="right" class = "home">
					<?php
						if(isset($_SESSION['username']))
						{
							
							$con = mysql_connect("127.0.0.1","root",""); //connecting to server
							mysql_select_db('jcu_db',$con); //selecting database
							$result = mysql_query ("SELECT * FROM jcu_db.students WHERE UserName='$_SESSION[username]'",$con);
							if($result === FALSE) 
							{
								die(mysql_error()); // TODO: better error handling
							}
							while($row = mysql_fetch_array($result)) {
								echo ("<a href ='student_profile.php' class ='home'>". $row['FirstName'] . "</a>&nbsp;&nbsp;&nbsp; 
								<a href = 'logout.php' class = 'home'>Log Out</a>");
			
							}
				
						}
					?>
				</td>
			</tr>
		</table>
	</div>           
</div>

<div >
	<table id="header" width="85%" align="center" style="margin-top:8px;" >
    	<tr>
        	<td ><img src="JCUlogo.jpg" width="190px" height="100px" alt="JCU" /></td>
		</tr>
     </table>	
</div>


<!---------- body ---------->

<div id="description"> <!--998-->

	<div align="center" id="title">E-Services</div>
    
	<form action="database_functions.php" name = "Student_Finances_Form" class = "Student_Finances_Form" method="post">
	<h2 align = "center">Request Form for Student Finances</h2>
	<fieldset>
		<legend>Personal Details:</legend>
		<div align="left" class="box_container">
			
				<div class="half_box">Student Number (8 digit number): </div>
				<div class="half_box">
					<input type="text" name="sn1" min="0" max="9" maxlength="1" size="1">
					<input type="text" name="sn2" min="0" max="9" maxlength="1" size="1">
					<input type="text" name="sn3" min="0" max="9" maxlength="1" size="1">
					<input type="text" name="sn4" min="0" max="9" maxlength="1" size="1">
					<input type="text" name="sn5" min="0" max="9" maxlength="1" size="1">
					<input type="text" name="sn6" min="0" max="9" maxlength="1" size="1">
					<input type="text" name="sn7" min="0" max="9" maxlength="1" size="1">
					<input type="text" name="sn8" min="0" max="9" maxlength="1" size="1">
				</div>
			
				<div class="half_box">FIN Number(Student's Pass number): </div>
				<div class="half_box">
					<input type="text" name="fin1" min="0" max="9" maxlength="1" size="1">
					<input type="text" name="fin2" min="0" max="9" maxlength="1" size="1">
					<input type="text" name="fin3" min="0" max="9" maxlength="1" size="1">
					<input type="text" name="fin4" min="0" max="9" maxlength="1" size="1">
					<input type="text" name="fin5" min="0" max="9" maxlength="1" size="1">
					<input type="text" name="fin6" min="0" max="9" maxlength="1" size="1">
					<input type="text" name="fin7" min="0" max="9" maxlength="1" size="1">
					<input type="text" name="fin8" min="0" max="9" maxlength="1" size="1">
					<input type="text" name="fin9" min="0" max="9" maxlength="1" size="1">
				</div>
			
				<div class="half_box">Title:</div>
				<div class="half_box">
					<input type ="radio" name = "title" value = "Dr" checked/>Dr
					<input type ="radio" name = "title" value = "Mr" />Mr
					<input type ="radio" name = "title" value = "Mrs" />Mrs
					<input type ="radio" name = "title" value = "Ms" />Ms
					<input type ="radio" name = "title" value = "Miss" />Miss		
				</div>
			
				<div class="half_box">Family Name:</div>
				<div class="half_box"><input type="text" size="30" name="fname"></div>
						
				<div class="half_box">Given Name:</div>
				<div class="half_box"><input type="text" size="30" name="gname"></div>
			
				<div class="half_box">JCU E-mail Address:</div>
				<div class="half_box"><input type="text" size="30" name="jcuemail">
				@my.jcu.edu.au</div>

				<div class="half_box">Mobile Phone:</div>
				<div class="half_box"><input type="tel" size="30" name="mobileph"></div>
			
				<div class="half_box">Home Phone Number:</div>
				<div class="half_box"><input type="tel" size="30" name="homeph"></div>
			
				<div class="half_box">Passport No. : </div>
				<div class="half_box"><input type="text" size="30" name="passport"></div>
			
				<div class="half_box">Current Course Type:</div>
				<div class="half_box">
					<select name="course">
						<option value="MBA">MBA</option>
						<option value="BBUS">BBUS</option>
						<option value="BPSY">BPSY</option>
						<option value="BIT">BIT</option>
						<option value="MIT">MIT</option>
						<option value="MITHM">MITHM</option>
					</select>
				</div>
			
				<div class="half_box">Mode of Study: </div>
				<div class="half_box">
					<select name="studymode">
						<option value="Day">Day</option>
						<option value="Evening/Fast-track">Evening/Fast-track</option>
					</select>
				</div>
                </div>
                
	</fieldset>
	
	<fieldset>

		<legend>Type of Request:</legend>
        
        <div align="left" class="box_container">
		
			
			<div class="full_box">Please state valid reason(s) for each of the request.</div>
			
			<div class="full_box"><input type="radio" name="reason" value="Extension of Payment">Extension of Payment:</div>
			
			<div class="quarter_box1">
				Period of Extension: </div>
				<div class="quarter_box2"><input type="text" size="50" name="extensionperiod"></div>
			
			<div class="quarter_box1">Reason for extension:</div>
			<div class="quarter_box2"><input type="text" size="50" name="extensionreason"></div>
			
			
			<div class="full_box"><input type="radio" name="reason" value="Waiving late fee charge">Waiving late fee charge:</div>
			
			<div class="quarter_box1">Reason:</div>
			<div class="quarter_box2"><input type="text" size="80" name="waivinglatereason"></div>
			
			<div class="full_box"><input type="radio" name="reason" value="Refund due to excess payment">Refund due to excess payment:</div>
			
			<div class="quarter_box1">Reason:</div>
			<div class="quarter_box2"><input type="text" size="80" name="refundreason"></div>
			
			<div class="full_box"><input type="radio" name="reason" value="Others">Others:</div>
            
			<div class="quarter_box1">Reason:</div>
			<div class="quarter_box2"><input type="text" size="80" name="othersreason"></div>
			
			<div align="center" class="button"><input type="submit" value="Submit" style ="width:150px; height:40px;" name="submit_finance"/></div>
		</div>

	</fieldset>
</form>

<SCRIPT TYPE="text/javascript">
autojump('sn1', 'sn2', 1);
autojump('sn2', 'sn3', 1);
autojump('sn3', 'sn4', 1);
autojump('sn4', 'sn5', 1);
autojump('sn5', 'sn6', 1);
autojump('sn6', 'sn7', 1);
autojump('sn7', 'sn8', 1);
autojump('sn8', 'sp1', 1);
autojump('fin1', 'fin2', 1);
autojump('fin2', 'fin3', 1);
autojump('fin3', 'fin4', 1);
autojump('fin4', 'fin5', 1);
autojump('fin5', 'fin6', 1);
autojump('fin6', 'fin7', 1);
autojump('fin7', 'fin8', 1);
autojump('fin8', 'fin9', 1);
</SCRIPT>
</div>

<div id="backgroundimg" style="width:100%; height:842px;"></div>



<!--------- footer ---------->

<div align="center" style="background-color:#FFF;">
	<table id="footerdescription">
    	<tr><td><img src="footer.png" height="80" /></td></tr>
        <tr><td>James Cook Australia Institute of Higher Learning is fully owned by James Cook Universtiy Australia. James Cook University Australia offers pathway, undergraduate and postgraduate programs at the JCU Singapore campus.<br />
        Last Updated: 04 July 2014, Copyright � 2014, D&S.
		</td></tr>
    </table>
</div>

</div>
</body>

</html>


