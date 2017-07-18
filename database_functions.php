<?php
session_start();
require ("classes/dbClasses.php");
/*.......checking username & password for login.........*/
/*
if (isset($_POST['student_login']))
{
	$loginObj = new Login();	
	$UserName = $_POST['username'];
	$Password = $_POST['password'];
	$Password_hash = md5($Password);
	
	if (!$loginObj->loginUser($UserName, $Password_hash))
	{		
		echo ("<script type='text/javascript'>alert('Login Failed. User name or password  is incorrect.'); </script>");
		include("login.php");
	}
	else
	{
		$_SESSION['username'] = $_POST['username'];
		header("location:index.php");
	}
}
*/

if(isset($_POST['student_login']))
{
	$loginObj = new Login();	
	$UserName = $_POST['username'];
	$Password = $_POST['password'];
	$Password_hash = md5($Password);
	
	if (!$loginObj->loginUser($UserName, $Password_hash))
	{		
		echo ("<script type='text/javascript'>alert('Login Failed. User name or password  is incorrect.'); </script>");
		include("login.php");
	}
	else
	{
		$_SESSION['username'] = $_POST['username'];
		
		//Getting log in student's JCU Email
		$result = $loginObj->getStudentEmail($UserName, $Password_hash);
		$fetch_email= $result->fetch_object();
		$email = $fetch_email->JCUEmail;
		
		//Generating OTP code
		$OTPobj= new OTP();
		$OTP = $OTPobj->OTP_generator();
		$_SESSION["OTP"] = $OTP;
		
		$OTPobj->mail_OTP($_SESSION['username'],$Password_hash,$email,$_SESSION["OTP"]); //Email OTP code to JCU Email
		
		include ("OTP_check.php");
	}
}
elseif(isset($_POST['confirm']))
{
	$OTP_code = $_POST['OTP_code'];
	if ($OTP_code != $_SESSION["OTP"])
	{
		echo ("<script type='text/javascript'>alert('Invalid OTP code. Please log in again.'); </script>");
		include("OTP_check.php");
	}
	elseif ($OTP_code == $_SESSION["OTP"])
	{
		echo $_SESSION['username'];
		header("location:index.php");
	}
}

elseif (isset($_POST['admin_login']))
{
	$adminLoginObj = new Login();
	$UserName = $_POST['username'];
	$Password = $_POST['password'];
	$Password_hash = md5($Password);
	if (!$adminLoginObj->loginAdmin($UserName,$Password_hash))
	{
		echo ("<script type='text/javascript'>alert('Login Failed. User name or password  is incorrect.'); </script>");
		include("login.php");
	}		
	else
	{
		$_SESSION['username'] = $_POST['username'];		
		header("location:adminIndex.php");
		mysql_close($con);
		
	}
}

/*.......inserting enrolment subjects forms data........*/
elseif (isset($_POST['enroll']) )
{
	$StudentNumber = $_POST['sn1'].$_POST['sn2'].$_POST['sn3'].$_POST['sn4'].$_POST['sn5'].$_POST['sn6'].$_POST['sn7'].$_POST['sn8'];
	$JCUEmail = $_POST['jcuemail']."@my.jcu.edu.au";
	$checkOBj = new Check();	
	if (!$checkOBj->checkStudentNumber($StudentNumber))
	{
		echo ("<script type='text/javascript'>alert('Your entered the wrong student number.Please check again'); </script>");		
		include("request_enrolment_form.php");
	
	}
	else //if not, insert data into database
	{
		/*Encrypting Data*/
		$security = new Security();
		$enc_title = $security->encrypt($_POST['title']);
		$enc_nationality = $security->encrypt($_POST['nationality']);
		$enc_fname = $security->encrypt($_POST['fname']);
		$enc_gname = $security->encrypt($_POST['gname']);
		$enc_jcuEmail = $security->encrypt($JCUEmail);
		$enc_mobileph = $security->encrypt($_POST['mobileph']);
		$enc_homeph = $security->encrypt($_POST['homeph']);
		$enc_course = $security->encrypt($_POST['course']);
		$enc_major = $security->encrypt($_POST['major']);
		$enc_adv_standing = $security->encrypt($_POST['adv_standing']);
		$enc_leave = $security->encrypt($_POST['leave']);
		$enc_study_mode = $security->encrypt($_POST['study_mode']);
		$enc_study_period = $security->encrypt($_POST['study_period']);
		$enc_year = $security->encrypt($_POST['year']);
		$enc_enrol_1 = $security->encrypt($_POST['enrol_1']);
		$enc_withdraw_1= $security->encrypt($_POST['withdraw_1']);
		$enc_attendancemode_1 = $security->encrypt($_POST['attendancemode_1']);		
		$enc_enrol_2 = $security->encrypt($_POST['enrol_2']);
		$enc_withdraw_2 = $security->encrypt($_POST['withdraw_2']);
		$enc_attendancemode_2 = $security->encrypt($_POST['attendancemode_2']);
		$enc_enrol_3 = $security->encrypt($_POST['enrol_3']);
		$enc_withdraw_3= $security->encrypt($_POST['withdraw_3']);
		$enc_attendancemode_3 = $security->encrypt($_POST['attendancemode_3']);
		$enc_enrol_4 = $security->encrypt($_POST['enrol_4']);
		$enc_withdraw_4= $security->encrypt($_POST['withdraw_4']);
		$enc_attendancemode_4= $security->encrypt($_POST['attendancemode_4']);
		$enc_enrol_5 = $security->encrypt($_POST['enrol_5']);
		$enc_withdraw_5= $security->encrypt($_POST['withdraw_5']);
		$enc_attendancemode_5= $security->encrypt($_POST['attendancemode_5']);
		
		$insertObj = new Insert();
		$insertObj->insertEnrolmentData(CURRENT_TIMESTAMP,$StudentNumber,$enc_title,$enc_nationality,$enc_fname,$enc_gname,$enc_jcuEmail,$enc_mobileph,
										$enc_homeph,$enc_course,$enc_major,$enc_adv_standing,$enc_leave,$enc_study_mode,$enc_study_period,$enc_year,
										$enc_enrol_1,$enc_withdraw_1,$enc_attendancemode_1,$enc_enrol_2,$enc_withdraw_2,$enc_attendancemode_2,
										$enc_enrol_3,$enc_withdraw_3,$enc_attendancemode_3,$enc_enrol_4,$enc_withdraw_4,$enc_attendancemode_4,
										$enc_enrol_5,$enc_withdraw_5,$enc_attendancemode_5);
										
		
		
		header ("location:index.php?status=submitted");
	}
}
/*.......inserting student finances forms data........*/
elseif (isset($_POST['submit_finance']))
{
	$StudentNumber = $_POST['sn1'].$_POST['sn2'].$_POST['sn3'].$_POST['sn4'].$_POST['sn5'].$_POST['sn6'].$_POST['sn7'].$_POST['sn8'];
	$FinNumber = $_POST['fin1'].$_POST['fin2'].$_POST['fin3'].$_POST['fin4'].$_POST['fin5'].$_POST['fin6'].$_POST['fin7'].$_POST['fin8'].$_POST['fin9'];
	$JCUEmail = $_POST['jcuemail']."@my.jcu.edu.au";
	
	$checkOBj = new Check();
	if (!$checkOBj->checkStudentNumber($StudentNumber))
	{
		echo ("<script type='text/javascript'>alert('Your entered the wrong student number.Please check again'); </script>");		
		include("student_finances_form.php");
	
	}
	else //if not, insert data into database
	{
		/*Encrypting Data*/
		$security = new Security();
		$enc_FIN = $security->encrypt($FinNumber);
		$enc_title = $security->encrypt($_POST['title']);
		$enc_fname = $security->encrypt($_POST['fname']);
		$enc_gname = $security->encrypt($_POST['gname']);
		$enc_jcuEmail = $security->encrypt($JCUEmail);
		$enc_mobileph = $security->encrypt($_POST['mobileph']);
		$enc_homeph = $security->encrypt($_POST['homeph']);
		$enc_passport = $security->encrypt($_POST['passport']);
		$enc_course = $security->encrypt($_POST['course']);
		$enc_studymode = $security->encrypt($_POST['studymode']);
		$enc_reason = $security->encrypt($_POST['reason']);
		$enc_extensionperiod = $security->encrypt($_POST['extensionperiod']);
		$enc_extensionreason = $security->encrypt($_POST['extensionreason']);
		$enc_waivinglatereason = $security->encrypt($_POST['waivinglatereason']);
		$enc_refundreason = $security->encrypt($_POST['refundreason']);
		$enc_othersreason = $security->encrypt($_POST['othersreason']);
		
		$insertObj = new Insert();
		$insertObj->insertStudentFinancesFormData(CURRENT_TIMESTAMP,$StudentNumber,$enc_FIN,$enc_title,$enc_fname,$enc_gname,$enc_jcuEmail,$enc_mobileph,
												$enc_homeph,$enc_passport,$enc_course,$enc_studymode,$enc_reason,$enc_extensionperiod,$enc_extensionreason,
												$enc_waivinglatereason,$enc_refundreason,$enc_othersreason);		
		header ("location:index.php?status=submitted");
	}
}
/*.......inserting cancel student pass forms data........*/
elseif (isset($_POST['cancel_studentpass']) )
{
	$StudentNumber = $_POST['sn1'].$_POST['sn2'].$_POST['sn3'].$_POST['sn4'].$_POST['sn5'].$_POST['sn6'].$_POST['sn7'].$_POST['sn8'];
	$FinNumber = $_POST['fin1'].$_POST['fin2'].$_POST['fin3'].$_POST['fin4'].$_POST['fin5'].$_POST['fin6'].$_POST['fin7'].$_POST['fin8'].$_POST['fin9'];
	$JCUEmail = $_POST['jcuemail']."@my.jcu.edu.au";
	
	// Gather all files data
    $FileName = mysql_real_escape_string($_FILES['uploaded_file']['name']);
    $FileType = mysql_real_escape_string($_FILES['uploaded_file']['type']);
    $FileData = mysql_real_escape_string(file_get_contents($_FILES  ['uploaded_file']['tmp_name']));
    $FileSize = intval($_FILES['uploaded_file']['size']);
	
	
	$checkOBj = new Check();
	if (!$checkOBj->checkStudentNumber($StudentNumber))
	{
		echo ("<script type='text/javascript'>alert('Your entered the wrong student number.Please check again'); </script>");		
		include("cancel_studentpass_form.php");
	
	}
	else //if not, insert data into database
	{	
		/*Encrypting Data*/
		$security = new Security();
		$enc_FIN = $security->encrypt($FinNumber);
		$enc_title = $security->encrypt($_POST['title']);
		$enc_nationality = $security->encrypt($_POST['nationality']);
		$enc_fname = $security->encrypt($_POST['fname']);
		$enc_gname = $security->encrypt($_POST['gname']);
		$enc_jcuEmail = $security->encrypt($JCUEmail);
		$enc_mobileph = $security->encrypt($_POST['mobileph']);
		$enc_homeph = $security->encrypt($_POST['homeph']);
		$enc_course = $security->encrypt($_POST['course']);
		$enc_reason = $security->encrypt($_POST['reason']);
		
		$insertObj = new Insert();
		$insertObj->insertCancelStudentPassFromData(CURRENT_TIMESTAMP,$StudentNumber,$enc_FIN,$enc_title,$enc_nationality,
													$enc_fname,$enc_gname,$enc_jcuEmail,$enc_mobileph,$enc_homeph,
													$enc_course,$_POST['pass_expirydate'],$enc_reason,$_POST['leavedate'],
													$FileName,$FileType,$FileSize,$FileData);
		header ("location:index.php?status=submitted");
	}
}	
/*.......inserting defer exams forms data........*/
elseif (isset($_POST['defer']))
{
	$StudentNumber = $_POST['sn1'].$_POST['sn2'].$_POST['sn3'].$_POST['sn4'].$_POST['sn5'].$_POST['sn6'].$_POST['sn7'].$_POST['sn8'];
	$JCUEmail = $_POST['jcuemail']."@my.jcu.edu.au";
	
	// Gather all files data
    $FileName = mysql_real_escape_string($_FILES['uploaded_file']['name']);
    $FileType = mysql_real_escape_string($_FILES['uploaded_file']['type']);
    $FileData = mysql_real_escape_string(file_get_contents($_FILES  ['uploaded_file']['tmp_name']));
    $FileSize = intval($_FILES['uploaded_file']['size']);
	
	$checkOBj = new Check();
	if (!$checkOBj->checkStudentNumber($StudentNumber))
	{
		echo ("<script type='text/javascript'>alert('Your entered the wrong student number.Please check again'); </script>");		
		include("defer_exam_form.php");
	
	}
	else //if not, insert data into database
	{
		/*Encrypting Data*/
		$security = new Security();
		$enc_title = $security->encrypt($_POST['title']);
		$enc_fname = $security->encrypt($_POST['fname']);
		$enc_gname = $security->encrypt($_POST['gname']);
		$enc_jcuEmail = $security->encrypt($JCUEmail);
		//$enc_email = $security->encrypt($_POST['email']);
		$enc_mobileph = $security->encrypt($_POST['mobileph']);
		$enc_homeph = $security->encrypt($_POST['homeph']);
		$enc_course = $security->encrypt($_POST['course']);
		$enc_studymode = $security->encrypt($_POST['studymode']);
		$enc_defermenttype = $security->encrypt($_POST['defermenttype']);
		$enc_studyperiod = $security->encrypt($_POST['studyperiod']);
		$enc_year = $security->encrypt($_POST['year']);
		$enc_subject1 = $security->encrypt($_POST['subject1']);
		$enc_lec1 = $security->encrypt($_POST['lec1']);
		$enc_subject2 = $security->encrypt($_POST['subject2']);
		$enc_lec2 = $security->encrypt($_POST['lec2']);
		$enc_subject3 = $security->encrypt($_POST['subject3']);
		$enc_lec3 = $security->encrypt($_POST['lec3']);
		
		$insertObj = new Insert();
		$insertObj->insertDeferExamFormData(CURRENT_TIMESTAMP,$StudentNumber,$enc_title,$enc_fname,$enc_gname,$enc_jcuEmail,$_POST['email'],$enc_mobileph,
											$enc_homeph,$enc_course,$enc_studymode,$enc_defermenttype,$enc_studyperiod,$enc_year,$enc_subject1,
											$_POST['date1'],$enc_lec1,$enc_subject2,$_POST['date2'],$enc_lec2,$enc_subject3,$_POST['date3'],$enc_lec3,
											$FileName,$FileType,$FileSize,$FileData);
		header ("location:index.php?status=submitted");
	
	}
}
/*.......inserting student particulars forms data........*/
elseif (isset($_POST['submit_particulars']))
{
	$StudentNumber = $_POST['sn1'].$_POST['sn2'].$_POST['sn3'].$_POST['sn4'].$_POST['sn5'].$_POST['sn6'].$_POST['sn7'].$_POST['sn8'];
	$FinNumber = $_POST['fin1'].$_POST['fin2'].$_POST['fin3'].$_POST['fin4'].$_POST['fin5'].$_POST['fin6'].$_POST['fin7'].$_POST['fin8'].$_POST['fin9'];
		
	$checkOBj = new Check();
	if (!$checkOBj->checkStudentNumber($StudentNumber))
	{
		echo ("<script type='text/javascript'>alert('Your entered the wrong student number.Please check again'); </script>");		
		include("student_Particulars_form.php");
	
	}
	else //if not, insert data into database
	{
		/*Encrypting Data*/
		$security = new Security();
		$enc_FIN = $security->encrypt($FinNumber);
		$enc_title = $security->encrypt($_POST['title']);
		$enc_fname = $security->encrypt($_POST['fname']);
		$enc_gname = $security->encrypt($_POST['gname']);
		//$enc_email = $security->encrypt($_POST['email']);
		$enc_course = $security->encrypt($_POST['course']);
		$enc_studymode = $security->encrypt($_POST['studymode']);
		$enc_address = $security->encrypt($_POST['address']);
		$enc_postalcode = $security->encrypt($_POST['postalcode']);
		$enc_mobileph = $security->encrypt($_POST['mobileph']);
		$enc_emergency_contact = $security->encrypt($_POST['emergency_contact']);
		$enc_relationship = $security->encrypt($_POST['relationship']);
		$enc_contact_address = $security->encrypt($_POST['contact_address']);
		$enc_contact_postalcode = $security->encrypt($_POST['contact_postalcode']);
		$enc_contact_phone = $security->encrypt($_POST['contact_phone']);
		$enc_newtitle = $security->encrypt($_POST['newtitle']);
		$enc_newfname = $security->encrypt($_POST['newfname']);
		$enc_newgname = $security->encrypt($_POST['newgname']);
		
		$insertObj = new Insert ();
		$insertObj->insertStudentParticularsFormData(CURRENT_TIMESTAMP,$StudentNumber,$enc_FIN,$_POST['pass_date'],$enc_title,$enc_fname,$enc_gname,$_POST['email'],
													$enc_course,$enc_studymode,$enc_address,$enc_postalcode,$enc_mobileph,$enc_emergency_contact,$enc_relationship,
													$enc_contact_address,$enc_contact_postalcode,$enc_contact_phone,$enc_newtitle,$enc_newfname,$enc_newgname);
		header ("location:index.php?status=submitted");
	}
}
/*.......inserting major changes forms data........*/
elseif (isset($_POST['change_major']))
{
	$StudentNumber = $_POST['sn1'].$_POST['sn2'].$_POST['sn3'].$_POST['sn4'].$_POST['sn5'].$_POST['sn6'].$_POST['sn7'].$_POST['sn8'];
	$JCUEmail = $_POST['jcuemail']."@my.jcu.edu.au";
	
	$checkOBj = new Check();
	if (!$checkOBj->checkStudentNumber($StudentNumber))
	{
		echo ("<script type='text/javascript'>alert('Your entered the wrong student number.Please check again'); </script>");		
		include("change_of_major_form.php");
	
	}
	else //if not, insert data into database
	{
		/*Encrypting Data*/
		$security = new Security();
		$enc_title = $security->encrypt($_POST['title']);
		$enc_nationality = $security->encrypt($_POST['nationality']);
		$enc_fname = $security->encrypt($_POST['fname']);
		$enc_gname = $security->encrypt($_POST['gname']);
		$enc_jcuEmail = $security->encrypt($JCUEmail);
		$enc_mobileph = $security->encrypt($_POST['mobileph']);
		$enc_homeph = $security->encrypt($_POST['homeph']);
		$enc_course = $security->encrypt($_POST['course']);
		$enc_major = $security->encrypt($_POST['major']);
		$enc_adv_standing = $security->encrypt($_POST['adv_standing']);
		$enc_newcourse = $security->encrypt($_POST['newcourse']);
		$enc_newmajor = $security->encrypt($_POST['newmajor']);
		$enc_studyperiod = $security->encrypt($_POST['studyperiod']);
		$enc_year = $security->encrypt($_POST['year']);
		
		$insertObj = new Insert();
		$insertObj->insertChangeMajorFormData(CURRENT_TIMESTAMP,$StudentNumber,$enc_title,$enc_nationality,$enc_fname,$enc_gname,$enc_jcuEmail,$enc_mobileph,
											$enc_homeph,$enc_course,$enc_major,$enc_adv_standing,$enc_newcourse,$enc_newmajor,$enc_studyperiod,$enc_year);
		header ("location:index.php?status=submitted");
	}
}
/*.........inserting course transfer application form data......*/
elseif (isset($_POST['course_transfer']))
{
	$StudentNumber = $_POST['sn1'].$_POST['sn2'].$_POST['sn3'].$_POST['sn4'].$_POST['sn5'].$_POST['sn6'].$_POST['sn7'].$_POST['sn8'];
	$JCUEmail = $_POST['jcuemail']."@my.jcu.edu.au";
	
	$checkOBj = new Check();
	if (!$checkOBj->checkStudentNumber($StudentNumber))
	{
		echo ("<script type='text/javascript'>alert('Your entered the wrong student number.Please check again'); </script>");		
		include("course_transfer_application.php");
	
	}
	else //if not, insert data into database
	{
		/*Encrypting Data*/
		$security = new Security();
		$enc_title = $security->encrypt($_POST['title']);
		$enc_nationality = $security->encrypt($_POST['nationality']);
		$enc_fname = $security->encrypt($_POST['fname']);
		$enc_gname = $security->encrypt($_POST['gname']);
		$enc_jcuEmail = $security->encrypt($JCUEmail);
		$enc_mobileph = $security->encrypt($_POST['mobileph']);
		$enc_homeph = $security->encrypt($_POST['homeph']);
		$enc_currentcoursecode = $security->encrypt($_POST['currentcoursecode']);
		$enc_currentcoursetitle = $security->encrypt($_POST['currentcoursetitle']);
		$enc_currentmajor = $security->encrypt($_POST['currentmajor']);
		$enc_showcase = $security->encrypt($_POST['showcase']);
		$enc_reason = $security->encrypt($_POST['reason']);
		$enc_proposedcoursecode = $security->encrypt($_POST['proposedcoursecode']);
		$enc_proposedcoursetitle = $security->encrypt($_POST['proposedcoursetitle']);
		$enc_proposedmajor = $security->encrypt($_POST['proposedmajor']);
		$enc_studyperiod = $security->encrypt($_POST['studyperiod']);
		$enc_year = $security->encrypt($_POST['year']);
		$enc_studymode = $security->encrypt($_POST['studymode']);
		
		$insertObj= new Insert();
		$insertObj->insertCourseTransferFormData(CURRENT_TIMESTAMP,$StudentNumber,$enc_title,$enc_nationality,$enc_fname,$enc_gname,$enc_jcuEmail,$enc_mobileph,
												$enc_homeph,$enc_currentcoursecode,$enc_currentcoursetitle,$enc_currentmajor,$enc_showcase,$enc_reason,
												$enc_proposedcoursecode,$enc_proposedcoursetitle,$enc_proposedmajor,$enc_studyperiod,$enc_year,$enc_studymode);
		header ("location:index.php?status=submitted");
	}
}
/*.........inserting enquiry form data......*/
elseif(isset($_POST['enquiry']))
{
	/*Encrypting Data*/
	$security = new Security();
	$enc_enquiry_subject = $security->encrypt($_POST['enquiry_subject']);
	$enc_enquiry_issues = $security->encrypt($_POST['enquiry_issues']);
	$enc_enquiry_message = $security->encrypt($_POST['enquiry_message']);
	//$enc_StudentNumber = $security->encrypt($_POST['StudentNumber']);
	
	$insertObj = new Insert();
	$insertObj->insertEnquiryFormData(CURRENT_TIMESTAMP,$enc_enquiry_subject,$enc_enquiry_issues,$enc_enquiry_message,$_POST['StudentNumber'],
									$_POST['JCUEmail']);
	/*
	
	$insertObj = new Insert();
	$insertObj->insertEnquiryFormData(CURRENT_TIMESTAMP,$enc_enquiry_subject,$enc_enquiry_issues,$enc_enquiry_message,$enc_StudentNumber);
	
	
	$insertObj = new Insert();
	$insertObj->insertEnquiryFormData(CURRENT_TIMESTAMP,$_POST['enquiry_subject'],$_POST['enquiry_issues'],$_POST['enquiry_message'],$_POST['StudentNumber'],
									$_POST['JCUEmail']);
	header ("location:index.php?status=submitted");*/
	header ("location:index.php?status=submitted");
		
	
}
?>