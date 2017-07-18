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
<title>Enquiry Form| JCUeServices</title>
<link href="index.css" rel="stylesheet" type="text/css" />
<script type = "text/javascript" src = "jcuScript.js"> </script>
</head>

<body class="scrollbar">
	

	<!---------- header ---------->
	<div id="miniBar" >
		
			<table border= "0" width = "68%" align="center">
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
		<table id="header" width="70%" align="center" style="margin-top:7px;" >
			<tr>
				<td ><img src="JCUlogo.jpg" width="190px" height="100px" alt="JCU" /></td>
			</tr>
		 </table>	
	</div>


	<!---------- body ---------->

	<div id="description">

		<?php
		require ("classes/dbClasses.php");
		if (isset($_SESSION['username']))
		{
			$UserName = $_SESSION['username'];
		
			$getObj = new Check();
			if ($result = $getObj->getNameEmail($UserName))
			{
				while ($obj = $result->fetch_object())
				{
					$JCUEmail = $obj->JCUEmail;
					$StudentNumber = $obj->StudentNumber;
					echo "
						<div id = 'title'>
							&nbsp;&nbsp;Enquiry
						</div>
						<div style = 'width:100%; height:900px; background-color:#FFF;'>
							<form action = 'database_functions.php' method = 'post'>
								<div id = 'enquiry1'>
									&nbsp;&nbsp;<b>Subject</b>&ensp;:<input class='enquiry_input' type='text' name='enquiry_subject' size='30' />
								</div>
								<div id = 'enquiry2'>
									&nbsp;&nbsp;<b>Issues</b>&ensp;&ensp;:
												<select style='border:0px;' name = 'enquiry_issues'>
													<option value='Exam'>Exam</option>
													<option value='Enrollment'>Enrollment</option>
													<option value='Course/Major'>Course/Major</option>
													<option value='Finance'>Finance</option>
													<option value='Others'>Others</option>
												</select>
								</div>
								<div align='center'>
									<textarea id='message' placeholder='Type your message here...' name='enquiry_message'></textarea>
								</div>
								<div id='send_button'>
									<input type = 'hidden' name = 'StudentNumber' value='$StudentNumber'/>
									<input type = 'hidden' name = 'JCUEmail' value = '$JCUEmail'/>
									<input type='submit' value='Send' style ='width:70px; height:30px; margin-left:30px; margin-top:5px;' name='enquiry'/>
								</div>
							</form>
						</div>
						
					";
				}
			}
		}
		?>
	</div>

	<div id="backgroundimg" style="width:100%; height:948px;"></div>

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

