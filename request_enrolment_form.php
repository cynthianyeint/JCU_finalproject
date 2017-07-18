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
<title>Request for Enrolments of Subjects | JCUeServices</title>
<link href="index.css" rel="stylesheet" type="text/css" />
<script type = "text/javascript" src = "jcuScript.js"> </script>
</head>

<body class="scrollbar">


<!---------- header ---------->
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
	<table border="0" id="header" width="85%" align="center" style="margin-top:8px;" >
    	<tr>
        	<td ><img src="JCUlogo.jpg" width="190px" height="100px" alt="JCU" /></td>
		</tr>
     </table>	
</div>


<!---------- body ---------->

<div id="description">

	<div align="center" id="title">E-Services</div>
    
	<form action="database_functions.php" name="Enrolment Form" class="Enrolment_Form" method="post" >
		<h2 align="center"> Request for Enrollment of Subjects </h2>
			<fieldset>
			<legend>Personal Details:</legend>
			<div align="left" class="box_container">
				
					<div class="half_box">Student Number (8 digit number):</div>					
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
                        
				
					<div class="half_box">Title:</div>
                    
					<div class="half_box">
						<input type ="radio" name = "title" value = "Dr" checked/>Dr
						<input type ="radio" name = "title" value = "Mr" />Mr
						<input type ="radio" name = "title" value = "Mrs" />Mrs
						<input type ="radio" name = "title" value = "Ms" />Ms
						<input type ="radio" name = "title" value = "Miss" />Miss
					</div>
					
					
					<div class="half_box">
					Nationality:
                    </div>
                    
                    <div class="half_box">
					<input type="text" size="30" name="nationality">
                    </div>
					
                    
					<div class="half_box">				
					Family Name:
                    </div>
                    
                    <div class="half_box">
					<input type="text" size="30" name="fname">
					</div>
                    					
                    <div class="half_box">
					Given Name:
                    </div>
                    
                    <div class="half_box">
					<input type="text" size="30" name="gname">
					</div>
                    
                    <div class="half_box">JCU E-mail Address:</div>
                    
                    <div class="half_box">
					<input type="text" size="30" name="jcuemail">
					@my.jcu.edu.au
                    </div>				                    
                    
                    <div class="half_box">Mobile Number:</div>
                    
                    <div class="half_box">
					<input type="tel" size="30" name="mobileph">
					</div>
					
			
					<div class="half_box">Home Phone Number:</div>
                    <div class="half_box">
					<input type="tel" size="30" name="homeph">
                    </div>
								
					<div class="half_box">Course Title:</div>
                    <div class="half_box">
					<input type="text" size="30" name="course">
					</div>
				
					<div class="half_box">Major:</div>
                    <div class="half_box">
					<input type="text" size="30" name="major">
					</div>
				
					<div class="half_box">
					Have you been granted any Advanced Standing?:
					</div>
                    <div class="half_box">
						<select name="adv_standing">
							<option value ="Yes">Yes</option>
							<option value = "No">No</option>
						</select>
					</div>
				
					<div class="half_box">
				 	Did you apply for a trimester leave of absence?:
					</div>
                    <div class="half_box">
						<select name = "leave">
							<option value = "Yes">Yes</option>
							<option value = "No">No</option>
						</select>
					</div>
				
					<div class="half_box">				
					Mode of Study:
					</div>
                    <div class="half_box">
						<select name="study_mode">
							<option value = "Day">Day</option>
							<option value = "Evenign/Fast-track">Evening/Fast-track</option>
						</select>
					</div>
			</div>	
			</fieldset>		
			
			<fieldset>
			<legend>Enrolment Details</legend>
            
			<div class="box_container">
			<div class="full_box">
				<ul>
					<li>For first enrolment indicate subject(s) to be added.</li>
					<li>For change of enrolment(additional subjects added/withdrawn), please arrange a meeting with Registrar Office for approval.</li>
				</ul>
			</div>	
			
			<div class="half_box">
				Study period (SP):
			</div>
            
            <div class="half_box">	
					<select name ="study_period">
					  <option value="51">51(February)</option>
					  <option value="52" >52(June)</option>
					  <option value="53">53(October)</option>
					</select>
			</div>
			
			<div class="half_box">
				Year:
			</div>
            <div class="half_box">	
					<select name = "year">
					  <option value="2014" >2014</option>
					  <option value="2015" >2015</option>
					</select>
				
			</div>
			
			
			<div class="full_box">Indicate subject(s) to be added or withdrawn from your enrolment:</div>
			</div>
            
            <div class="box_container" align="center">
            
			<div class="quarter_box">Subject to be enrolled</div>
			<div class="quarter_box">Subject to be withdrawn</div>
			<div class="quarter_box">Attendance mode</div>
            
            <div class="quarter_box"><input type="text" size="30" name="enrol_1" ></div>
			<div class="quarter_box"><input type="text" size="30" name="withdraw_1"></div>
			<div class="quarter_box">	
					<select name="attendancemode_1">
						<option value="Day" >Day</option>
						<option value="Evening/Fast-track">Evening/Fast-track</option>
					</select>
                    
            </div>
			
			<div class="quarter_box"><input type="text" size="30" name="enrol_1" ></div>
			<div class="quarter_box"><input type="text" size="30" name="withdraw_1"></div>
            <div class="quarter_box">			
					<select name="attendancemode_1">
						<option value="Day" >Day</option>
						<option value="Evening/Fast-track">Evening/Fast-track</option>
					</select>
                    
             </div>
             
			<div class="quarter_box"><input type="text" size="30" name="enrol_2"></div>
			<div class="quarter_box"><input type="text" size="30" name="withdraw_2"></div>
			<div class="quarter_box">	
					<select name="attendancemode_2">
						<option value="Day" >Day</option>
						<option value="Evening/Fast-track">Evening/Fast-track</option>
					</select>
                    
              </div>
						
			<div class="quarter_box"><input type="text" size="30" name="enrol_3"></div>
			<div class="quarter_box"><input type="text" size="30" name="withdraw_3"></div>
			<div class="quarter_box">	
					<select name="attendancemode_3">
						<option value="Day" >Day</option>
						<option value="Evening/Fast-track">Evening/Fast-track</option>
					</select>
                    
               </div>
				
			<div class="quarter_box"><input type="text" size="30" name="enrol_4"></div>
			<div class="quarter_box"><input type="text" size="30" name="withdraw_4"></div>
			<div class="quarter_box">	
					<select name="attendancemode_4">
						<option value="Day" >Day</option>
						<option value="Evening/Fast-track">Evening/Fast-track</option>
					</select>
            </div>
			
            <div class="quarter_box"><input type="text" size="30" name="enrol_5"></div>
			<div class="quarter_box"><input type="text" size="30" name="withdraw_5"></div>
			<div class="quarter_box">	
					<select name="attendancemode_5">
						<option value="Day" >Day</option>
						<option value="Evening/Fast-track">Evening/Fast-track</option>
					</select>
                    
            </div>
						
            <div class="button">  
			<input type="submit" value="Submit" style ="width:150px; height:40px;" name="enroll"/>
			</div>	
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
</SCRIPT>
    
</div>

<div id="backgroundimg" style="width:100%; height:940px;"></div>



<!--------- footer ---------->

<div align="center" style="background-color:#FFF;">
	<table id="footerdescription">
    	<tr><td><img src="footer.png" height="80" /></td></tr>
        <tr><td>James Cook Australia Institute of Higher Learning is fully owned by James Cook Universtiy Australia. James Cook University Australia offers pathway, undergraduate and postgraduate programs at the JCU Singapore campus.<br />
        Last Updated: 04 July 2014, Copyright � 2014, D&S.
		</td></tr>
    </table>
</div>


</body>

</html>

