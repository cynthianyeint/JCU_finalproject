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
<title>Student Particulars Form | JCUeServices</title>
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

<div >
	<table id="header" width="85%" align="center" style="margin-top:8px;" >
    	<tr>
        	<td ><img src="JCUlogo.jpg" width="190px" height="100px" alt="JCU" /></td>
		</tr>
     </table>	
</div>


<!---------- body ---------->

<div id="description">

	<div align="center" id="title">E-Services</div>
    
	<form action="database_functions.php" name = "Student_Particulars_Form" class = "Student_Particulars_Form" method="post">
    <h2 align="center"> Student Particulars Form </h2>
		<fieldset>
			<legend>Current Personal Details:</legend>
			
			
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
				
					<div class="half_box">Student's Pass Issued Date: </div>
					<div class="half_box"><input type="date" name="pass_date"/></div>
				
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
				
					<div class="half_box">Personal E-mail Address:</div>
					<div class="half_box"><input type="text" size="30" name="email"></div>
				
					<div class="half_box">Course Title:</div>
					<div class="half_box">
						<input type="text" size="30" name="course"/>
					</div>
				
					<div class="half_box">Mode of study:</div>
					<div class="half_box">
						<input type ="radio" name = "studymode" value = "Day" checked/>Day
						<input type ="radio" name = "studymode" value = "Evening/PartTime" />Evening/Part Time		
					</div>
				
		</fieldset>

		<fieldset>
			<legend>Residential Address in Singapore:</legend>
			<div class="full_box" align = "center"><b>New residential address in Singapore</b></div>
		
					<div class="half_box">Address: </div>
					<div class="half_box"><input type="text" size="50" name="address"></div>
				
					<div class="half_box">Postal code: </div>
					<div class="half_box"><input type="text" size="50" name="postalcode"></div>
				
					<div class="half_box">Mobile Phone:</div>
					<div class="half_box"><input type="tel" size="50" name="mobileph"></div>
				
                <div class="full_box" align = "center"><b>Emergency contact</b></div>
               
					<div class="half_box">Name of emergency contact: </div>
					<div class="half_box"><input type="text" size="50" name="emergency_contact"></div>
				
					<div class="half_box">Relationship to you: </div>
					<div class="half_box"><input type="text" size="50" name="relationship"></div>
				
					<div class="half_box">Address: </div>
					<div class="half_box"><input type="text" size="50" name="contact_address"></div>
				
					<div class="half_box">Postal code: </div>
					<div class="half_box"><input type="text" size="50" name="contact_postalcode"></div>
				
					<div class="half_box">Phone Number:</div>
					<div class="half_box"><input type="tel" size="50" name="contact_phone"></div>
				
		</fieldset>
        
        <fieldset>
			<legend>Change of Name:</legend>
			
					<div class="full_box">
						Students who wish to change their name on University records should attach appropriate supporting documentation, 
						such as a certified Passport copy.
					</div>
				
					<div class="quarter_box1">Title:</div>
					<div class="quarter_box2">
						<input type ="radio" name = "newtitle" value = "Dr" checked/>Dr
						<input type ="radio" name = "newtitle" value = "Mr" />Mr
						<input type ="radio" name = "newtitle" value = "Mrs" />Mrs
						<input type ="radio" name = "newtitle" value = "Ms" />Ms
						<input type ="radio" name = "newtitle" value = "Miss" />Miss
					</div>
				
					<div class="quarter_box1">New Family Name:</div>
					<div class="quarter_box2"><input type="text" size="80" name="newfname"></div>
				
					<div class="quarter_box1">New Given Name:</div>
					<div class="quarter_box2"><input type="text" size="80" name="newgname"></div>
				
					<div class="button" align ='center'><input type="submit" value="Submit" style ="width:150px; height:40px;" name="submit_particulars"/></div>
				 
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

<div id="backgroundimg" style="width:100%; height:950px;"></div>



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

</body>
</html>

