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
<title>Home | JCUeServices</title>
<link href="index.css" rel="stylesheet" type="text/css" />

</head>

<body class="scrollbar">



<!--header-->
<div id="miniBar" >
	
		<table border= "0" width = "83%" align="center">
			<tr>
				<td align = "left" width="50%">
					<a class="home" href="index.php">
					<img src="1405603016_Streamline-18.png" width="17px" height="17px" alt="Home" style="margin-top:4px;" />  Home</a>
				</td>
				<td valign= "bottom" align="right" class = "home" width="50%">
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
								echo ("<a href ='student_profile.php?StudentNumber=$row[StudentNumber]' class ='home'>". $row['FirstName'] . "</a>&nbsp;&nbsp;&nbsp; 
								<a href = 'logout.php' class = 'home'>Log Out</a>");
							}
				
						}
					?>
				</td>
			</tr>
		</table>
	         
</div>

<div >
	<table border="0" id="header" width="85%" align="center" style="margin-top:8px;" >
    	<tr>
        	<td ><img src="JCUlogo.jpg" width="190px" height="100px" alt="JCU" /></td>
		</tr>
     </table>	
</div>


<!--body-->

<div id="description" style="height:868px;">

	<div align="center" id="title">E-Services</div>
    
	<div class="div1">
    	<div id="heading1">
			<a class="formLink" href="request_enrolment_form.php">"Request for Enrolment of Subjects"</a>
        </div>
        <div id="bodyPart1">
        To enrol or withdraw subjects for each semester
        </div>
    </div>
    
	<div class="div2">
    	<div id="heading2">
        	<a class="formLink" href="student_finances_form.php">"Request Form for Student Finances"</a>
        </div>
        <div id="bodyPart2">
        To request for extension of payment
        </div>
    </div>
    
	<div class="div3">
    	<div id="heading3">
        	<a class="formLink" href="cancel_studentpass_form.php">"Request to Cancel Students Pass"</a>
        </div>
        <div id="bodyPart3">
        To cancel student pass after the study period or when student wants to make a new student pass or extend the current student pass
        </div>
    </div>
    
	<div class="div4">
    	<div id="heading4">
        	<a class="formLink" href="defer_exam_form.php">"Deferring of a Formal Examination"</a>
        </div>
        <div id="bodyPart4">
        To defer formal examination if student fails to attend the exam
        </div>
    </div>
    
	<div class="div5">
    	<div id="heading5">
        	<a class="formLink" href="student_Particulars_form.php">"Student Particulars Form"</a>
        </div>
        <div id="bodyPart5">
        To change students' particular data such as address,email and phone number
        </div>
    </div>
    
	<div class="div6">
    	<div id="heading6">
        	<a class="formLink" href="course_transfer_application.php">"Course Transfer Application"</a>
        </div>
        <div id="bodyPart6">
        To change students' courses
        </div>
    </div>
    
    <div class="div7">
    	<div id="heading7">
        	<a class="formLink" href="change_of_major_form.php">"Change Of Major Form"</a>
        </div>
        <div id="bodyPart7">
        To change students' majors
        </div>
    </div>
     
    <div class="div8">
    	<div id="heading8">
        	<a class="formLink" href="enquiry_form.php">"Enquiry"</a>
        </div>
        <div id="bodyPart8">
        To enrol or withdraw subjects for each semester
        </div>
    </div>
    
     <div class="div9">
    	<div id="heading9">
        	FAQ
        </div>
        <div id="bodyPart9" class="scrollbar" style="height:200px; max-height:132px; overflow-y:scroll; ">
        <b>1.How to access my profile page?</b><br />
		Ans: To access your profile page just click on your name on the top right of the page.<br />
		<br />
		<b>2.Can I download the forms that I have fill in?</b><br />
		Ans: Yes, you can. Just access your profile page and click on the form that you have fill in from the left side of the page, and then 					click on download to download the form.<br />
		<br />
		<b>3.Can I delete the forms that I have submitted?</b><br />
		Ans: No, you can’t. All forms you submitted will be stored and if necessary, the students service will delete it if required. <br />
        </div>
    </div>
    
</div>

<div id="backgroundimg" style="width:100%; height:868px;"></div>

<!--footer-->

<div align="center" style="background-color:#FFF;">
	<table id="footerdescription">
    	<tr><td><img src="footer.png" height="80" alt="footer logo" /></td></tr>
        <tr><td>James Cook Australia Institute of Higher Learning is fully owned by James Cook University Australia. James Cook University Australia offers pathway, undergraduate and postgraduate programs at the JCU Singapore campus.<br />
        Last Updated: 04 July 2014, Copyright � 2014, D&amp;S.
		</td></tr>
    </table>
</div>


</body>
<?php
   if(isset($_GET['status']))
{
       echo "<script type='text/javascript'>	
				alert('Form submitted successfully');
			</script>";
	
}
?>
</html>
