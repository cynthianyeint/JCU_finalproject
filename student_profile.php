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
<title>Profile | JCU E-Services</title>
<link href="student_profile.css" rel="stylesheet" type="text/css" />

</head>
<body class="scrollbar">

<div class="header" >
<table id="header">
	<tr>
		<td>
			<a href ='index.php' class ='home'><img src="JCUlogo(blue).jpg" width="190px" height="100px" alt="JCU"/>
		</td>
		<td valign = "bottom" align="right" class = "home">
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
								echo ( $row['FirstName'] . "</a>&nbsp;&nbsp;&nbsp; 
								<a href = 'logout.php' class = 'home'>Log Out</a>");
							}
				
						}
			?>
		</td>
	</tr>
</table>
</div>


<!---------- body ---------->
<div class="box_container1">
<div id="category" align="left">
    	<div style="font-size:20px; color:#0000A0; padding:10px;">Requests</div>
		<div class="cell" onclick="enrolmentFormData()" onmouseover="hovereffect(this)" onmouseout="normaleffect(this)">
        	Request for Enrolment of Subjects
        	</div>
        <div class="cell" onclick="studentFinancesFormData()" onmouseover="hovereffect(this)" onmouseout="normaleffect(this)">
        	Request Form of Student Finances
        	</div>
        <div class="cell" onclick="cancelStudentPassFromData()" onmouseover="hovereffect(this)" onmouseout="normaleffect(this)">
        	Request to Cancel Students Pass
            </div>
        <div class="cell" onclick="deferExamFromData()" onmouseover="hovereffect(this)" onmouseout="normaleffect(this)">
        	Deferring of a Formal Examination
            </div>
        <div class="cell" onclick="studentParticularsFormData()" onmouseover="hovereffect(this)" onmouseout="normaleffect(this)">
        	Student Particulars Form
            </div>
        <div class="cell" onclick="courseTransferFormData()" onmouseover="hovereffect(this)" onmouseout="normaleffect(this)">
        	Course Transfer Application
            </div>
        <div class="cell" onclick="changeMajorFormData()" onmouseover="hovereffect(this)" onmouseout="normaleffect(this)">
        	Change of Major Form
            </div>
        <div class="cell" onclick="enquiryFormData()" onmouseover="hovereffect(this)" onmouseout="normaleffect(this)">
        	Enquiry
            </div>
</div>
</div>
	
	
<div class="box_container2"><div id="requests" class="scrollbar" onclick = "showText"></div></div>
    
<div class="box_container3"><div id="body_description" class="scrollbar"></div></div><!--------- footer ---------->

<div>
	<table id="footerdescription">
        <tr><td align="center">
        Last Updated: 04 July 2014, Copyright � 2014, D&amp;S.
		</td></tr>
    </table>
</div>

</body>
</html>
<?php
include ("student_functions.php");
?>