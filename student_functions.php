<?php require ("classes/dbClasses.php");?>
<script>
function enrolmentFormData()
{
	document.getElementById("requests").innerHTML = "<?php
														$StudentNumber = $_GET['StudentNumber'];
														$infoObj = new SelectByStuNum ();
														if ($result = $infoObj->getEnrollmentFormData($StudentNumber))
														{
															while ($obj = $result->fetch_object())
															{
																$security = new Security();
																$dec_jcuEmail = $security->decrypt($obj->JCUEmail);
																echo "<div id = 'demo' class='demo' onclick = 'showEnrolmentFormDetails()' onmouseover = 'hover(this)' onmouseout = 'normal(this)'>";
																echo "$dec_jcuEmail<br><br>$obj->DateTime</div>";
															}
														}
													?>";
	document.getElementById("Title").innerHTML = "Request Forms for Enrolment of Subjects";
}												
function studentFinancesFormData()
{
	document.getElementById("requests").innerHTML = "<?php 
														$StudentNumber = $_GET['StudentNumber'];
														$infoObj = new SelectByStuNum ();
														if ($result = $infoObj->getStudentFinancesFormData($StudentNumber))
														{
															while ($obj = $result->fetch_object())
															{
																$security = new Security();
																$dec_jcuEmail = $security->decrypt($obj->JCUEmail);
																echo "<div id = 'demo' class = 'demo' onclick='showStudentFinancesFormDetails()' onmouseover = 'hover(this)' onmouseout = 'normal(this)'>";
																echo "$dec_jcuEmail<br><br><br>$obj->DateTime</div>";
															}
														}
													?>";
	document.getElementById("Title").innerHTML = "Request Forms for Student Finances";
}

function cancelStudentPassFromData()
{
	document.getElementById("requests").innerHTML= "<?php 
														$StudentNumber = $_GET['StudentNumber'];
														$infoObj = new SelectByStuNum ();
														if ($result = $infoObj->getCancelStudentPassFormData($StudentNumber))
														{
															while ($obj = $result->fetch_object())
															{
																$security = new Security();
																$dec_jcuEmail = $security->decrypt($obj->JCUEmail);
																echo "<div id = 'demo' class = 'demo' onclick ='showCancelSPFormDetails()' onmouseover = 'hover(this)' onmouseout = 'normal(this)'>";
																echo "$dec_jcuEmail<br><br><br>$obj->DateTime</div>";
															}
														}
													?>";
	document.getElementById("Title").innerHTML = "Request Forms to Cancel Student Pass";
}

function deferExamFromData()
{
	document.getElementById("requests").innerHTML = "<?php 
														$StudentNumber = $_GET['StudentNumber'];
														$infoObj = new SelectByStuNum ();
														if ($result = $infoObj->getDeferExamFormData($StudentNumber))
														{
															while ($obj = $result->fetch_object())
															{
																$security = new Security();
																$dec_jcuEmail = $security->decrypt($obj->JCUEmail);
																echo "<div id = 'demo' class = 'demo' onclick ='showDeferExamFormDetails()' onmouseover = 'hover(this)' onmouseout = 'normal(this)'>";
																echo "$dec_jcuEmail<br><br><br>$obj->DateTime</div>";
															}
														}
													?>";
	document.getElementById("Title").innerHTML = "Request Forms for Defer Exam";
}

function courseTransferFormData()
{
	document.getElementById("requests").innerHTML = "<?php
														$StudentNumber = $_GET['StudentNumber'];
														$infoObj = new SelectByStuNum ();
														if ($result = $infoObj->getCourseTransferApplicationFromData($StudentNumber))
														{
															while ($obj = $result->fetch_object())
															{
																$security = new Security();
																$dec_jcuEmail = $security->decrypt($obj->JCUEmail);
																echo "<div id = 'demo' class = 'demo' onclick='showCourseTransferAppFormDetails()' onmouseover = 'hover(this)' onmouseout = 'normal(this)'>";
																echo "$dec_jcuEmail<br><br><br>$obj->DateTime</div>";
															}
														}
													?>";
	document.getElementById("Title").innerHTML = "Request Forms for Course Transfer";
}

function changeMajorFormData()
{
	document.getElementById("requests").innerHTML = "<?php 
														$StudentNumber = $_GET['StudentNumber'];
														$infoObj = new SelectByStuNum ();
														if ($result = $infoObj->getChangeMajorFormData($StudentNumber))
														{
															while ($obj = $result->fetch_object())
															{
																$security = new Security();
																$dec_jcuEmail = $security->decrypt($obj->JCUEmail);
																echo "<div id = 'demo' class = 'demo' onclick='showMajorChangeFormDetails()' onmouseover = 'hover(this)' onmouseout = 'normal(this)'>";
																echo "$dec_jcuEmail<br><br><br>$obj->DateTime</div>";
															}
														}
													?>";
	document.getElementById("Title").innerHTML = "Request Forms to Change Major";
}

function studentParticularsFormData()
{
	document.getElementById("requests").innerHTML = "<?php 
														$StudentNumber = $_GET['StudentNumber'];
														$infoObj = new SelectByStuNum();
														if ($result=$infoObj->getStudentParticularsFormData($StudentNumber))
														{
															while ($obj=$result->fetch_object())
															{
																//$security = new Security();
																//$dec_email = $security->decrypt($obj->Email);
																echo "<div id = 'demo' class = 'demo' onclick='showStudentParticularsFormDetails()' onmouseover = 'hover(this)' onmouseout = 'normal(this)'>";
																echo "$obj->Email<br><br><br>$obj->DateTime</div>";
																
															}
														}
													?>";
	document.getElementById("Title").innerHTML = "Student Particular Forms";
}

function enquiryFormData()
{
	document.getElementById("requests").innerHTML = "<?php 
														$StudentNumber = $_GET['StudentNumber'];
														$infoObj = new SelectByStuNum();
														if ($result=$infoObj->getEnquiryFormData($StudentNumber))
														{
															while ($obj=$result->fetch_object())
															{
																//$security = new Security();
																//$dec_jcuEmail = $security->decrypt($obj->JCUEmail);
																echo "<div id = 'demo' class = 'demo' onclick='showEnquiryFormDetails()' onmouseover = 'hover(this)' onmouseout = 'normal(this)'>";
																echo "$obj->JCUEmail<br><br><br>$obj->DateTime</div>";
																
															}
														}
													?>";
	document.getElementById("Title").innerHTML = "Enquiry Forms";
}

function showEnrolmentFormDetails()
{
	document.getElementById("body_description").innerHTML = "<?php 																
															$infoObj = new Select();
															if ($result = $infoObj->getEnrollmentFormData())
															{
																while ($obj = $result->fetch_object())
																{
																	//decrypting data from database
																	$security = new Security();
																	$dec_title= $security->decrypt($obj->Title);
																	$dec_nationality = $security->decrypt($obj->Nationality);
																	$dec_fname = $security->decrypt($obj->FamilyName);
																	$dec_gname = $security->decrypt($obj->GivenName);
																	$dec_jcuEmail = $security->decrypt($obj->JCUEmail);
																	$dec_mobileph = $security->decrypt($obj->MobilePhone);
																	$dec_homeph = $security->decrypt($obj->HomePhone);
																	$dec_course = $security->decrypt($obj->Course);
																	$dec_major = $security->decrypt($obj->Major);
																	$dec_adv_standing = $security->decrypt($obj->AdvStanding);
																	$dec_triLeave = $security->decrypt($obj->TrimesterLeave);
																	$dec_study_mode = $security->decrypt($obj->StudyMode);
																	$dec_study_period = $security->decrypt($obj->StudyPeriod);
																	$dec_year = $security->decrypt($obj->Year);
																	$dec_enrol1 = $security->decrypt($obj->SubEnrol1);
																	$dec_withdraw1 = $security->decrypt($obj->SubWithdraw1);
																	$dec_attendancemode1 = $security->decrypt($obj->Sub1AttendanceMode);																	
																	$dec_enrol2 = $security->decrypt($obj->SubEnrol2);
																	$dec_withdraw2 = $security->decrypt($obj->SubWithdraw2);
																	$dec_attendancemode2 = $security->decrypt($obj->Sub2AttendanceMode);
																	$dec_enrol3 = $security->decrypt($obj->SubEnrol3);
																	$dec_withdraw3 = $security->decrypt($obj->SubWithdraw3);
																	$dec_attendancemode3 = $security->decrypt($obj->Sub3AttendanceMode);
																	$dec_enrol4 = $security->decrypt($obj->SubEnrol4);
																	$dec_withdraw4 = $security->decrypt($obj->SubWithdraw4);
																	$dec_attendancemode4 = $security->decrypt($obj->Sub4AttendanceMode);
																	$dec_enrol5 = $security->decrypt($obj->SubEnrol5);
																	$dec_withdraw5 = $security->decrypt($obj->SubWithdraw5);
																	$dec_attendancemode5 = $security->decrypt($obj->Sub5AttendanceMode);
																	
																	//retrieving decrypted data
																	echo "<form class='form' action='pdfDownload_functions.php' method='post' ><h2 align='center'> Request for Enrollment of Subjects </h2>";
																	echo "<fieldset><legend>Personal Details:</legend>";
																	echo "<div class='half_box'>Student Number (8 digit number) :</div>";
																	echo "<div class='half_box'>$obj->StudentNumber</div>";
																	echo "<div class='half_box'>Title: </div><div class='half_box'>$dec_title</div>";
																	echo "<div class='half_box'>Nationality: </div><div class='half_box'>$dec_nationality</div>";
																	echo "<div class='half_box'>Family Name: </div><div class='half_box'>$dec_fname</div>";
																	echo "<div class='half_box'>Given Name: </div><div class='half_box'>$dec_gname</div>";
																	echo "<div class='half_box'>JCU E-mail Address: </div><div class='half_box'>$dec_jcuEmail</div>";
																	echo "<div class='half_box'>Mobile Phone: </div><div class='half_box'>$dec_mobileph</div>";
																	echo "<div class='half_box'>Home Phone Number: </div><div class='half_box'>$dec_homeph</div>";
																	echo "<div class='half_box'>Course Title: </div><div class='half_box'>$dec_course</div>";
																	echo "<div class='half_box'>Major: </div><div class='half_box'>$dec_major</div>";
																	echo "<div class='half_box'>Have you been granted any Advanced Standing?: </div><div class='half_box'>$dec_adv_standing</div>";
																	echo "<div class='half_box'>Did you apply for a trimester leave of absence?: </div><div class='half_box'>$dec_triLeave</div>";
																	echo "<div class='half_box'>Mode of Study: </div><div class='half_box'>$dec_study_mode</div>";
																	echo "</fieldset>";	
																	echo "<form><fieldset><legend>Enrolment Details:</legend>";	
																	echo "<div class='half_box'>Study period(SP):</div><div class='half_box'>$dec_study_period</div>";
																	echo "<div class='half_box'>Year: </div><div class='half_box'>$dec_year</div>";
																	echo "<div class='full_box'>Indicate subject(s) to be added or withdrawn form your enrolment:</div>";
																	echo "<div class='quarter_box'>Subject to be enrolled</div>";
																	echo "<div class='quarter_box'>Subject to be withdrawn</div>";
																	echo "<div class='quarter_box'>Attendance Mode</div>";
																	echo "<div class='quarter_box'>$dec_enrol1</div>";
																	echo "<div class='quarter_box'>$dec_withdraw1</div>";
																	echo "<div class='quarter_box'>$dec_attendancemode1</div>";
																	echo "<div class='quarter_box'>$dec_enrol2</div>";
																	echo "<div class='quarter_box'>$dec_withdraw2</div>";
																	echo "<div class='quarter_box'>$dec_attendancemode2</div>";
																	echo "<div class='quarter_box'>$dec_enrol3</div>";
																	echo "<div class='quarter_box'>$dec_withdraw3</div>";
																	echo "<div class='quarter_box'>$dec_attendancemode3</div>";
																	echo "<div class='quarter_box'>$dec_enrol4</div>";
																	echo "<div class='quarter_box'>$dec_withdraw4</div>";
																	echo "<div class='quarter_box'>$dec_attendancemode4</div>";
																	echo "<div class='quarter_box'>$dec_enrol5</div>";
																	echo "<div class='quarter_box'>$dec_withdraw5</div>";
																	echo "<div class='quarter_box'>$dec_attendancemode5</div>";
																	$Enroll_ID = $obj->Enroll_ID;
																	echo "<input type='hidden' name='Enroll_ID' value =$Enroll_ID>";
																	echo "<div class='full_box' align='center'><input type='submit' value='Download' style ='width:150px; height:40px;' name='download_enroll'/></div>";
																	echo "</fieldset></form>";
																}
															}
															?>";
}


function showStudentFinancesFormDetails()
{
	document.getElementById("body_description").innerHTML ="<?php 
															$infoObj = new Select();
															if ($result = $infoObj->getStudentFinancesFormData())
															{
																while ($obj = $result->fetch_object())
																{
																	//decrypting data from database
																	$security = new Security();
																	$dec_FIN = $security->decrypt($obj->FinNumber);
																	$dec_title= $security->decrypt($obj->Title);
																	$dec_fname = $security->decrypt($obj->FamilyName);
																	$dec_gname = $security->decrypt($obj->GivenName);
																	$dec_jcuEmail = $security->decrypt($obj->JCUEmail);
																	$dec_mobileph = $security->decrypt($obj->MobilePhone);
																	$dec_homeph = $security->decrypt($obj->HomePhone);
																	$dec_passport = $security->decrypt($obj->Passport);
																	$dec_course = $security->decrypt($obj->Course);
																	$dec_studymode = $security->decrypt($obj->StudyMode);
																	$dec_request = $security->decrypt($obj->RequestType);
																	$dec_periodextension = $security->decrypt($obj->PeriodExtension);
																	$dec_extensionreason = $security->decrypt($obj->ExtensionReason);
																	$dec_waivinglatereason = $security->decrypt($obj->WaivingLateReason);
																	$dec_refundreason = $security->decrypt($obj->RefundReason);
																	$dec_othersreason = $security->decrypt($obj->OthersReason);														
																	
																	//retrieving decrypted data
																	echo "<form action='pdfDownload_functions.php' method='post' class='form'>";
																	echo "<h2 align='center'>Request Form for Student Finances</h2>";
																	echo "<fieldset><legend>Personal Details:</legend>";
																	echo "<div class='half_box'>Student Number (8 digit number) </div><div class='half_box'>$obj->StudentNumber</div>";
																	echo "<div class='half_box'>Fin Number (Student's Pass Number): </div><div class='half_box'>$dec_FIN</div>";
																	echo "<div class='half_box'>Title: </div><div class='half_box'>$dec_title</div>";
																	echo "<div class='half_box'>Family Name: </div><div class='half_box'>$dec_fname </div>";
																	echo "<div class='half_box'>Given Name: </div><div class='half_box'>$dec_gname</div>";
																	echo "<div class='half_box'>JCU E-mail Address: </div><div class='half_box'>$dec_jcuEmail</div>";
																	echo "<div class='half_box'>Mobile Phone: </div><div class='half_box'>$dec_mobileph</div>";
																	echo "<div class='half_box'>Home Phone Number: </div><div class='half_box'>$dec_homeph</div>";
																	echo "<div class='half_box'>Passport No:</div><div class='half_box'>$dec_passport</div>";
																	echo "<div class='half_box'>Current Course Type: </div><div class='half_box'>$dec_course</div>";
																	echo "<div class='half_box'>Mode of Study: </div><div class='half_box'>$dec_studymode</div>";
																	echo "</fieldset>";	
																	echo "<fieldset><legend>Type of Request:</legend>";
																	echo "<div class='half_box'><b>Requests:</b></div><div class='half_box'>$dec_request</div>";
																	if ($dec_request == 'Extension of Payment')
																	{ 
																		echo "<div class='quarter_box1'><b>Period of Extension:</b></div><div class='quarter_box2'>$dec_periodextension</div>";
																		echo "<div class='quarter_box1'><b>Reason for Extension:</b></div><div class='quarter_box2'>$dec_extensionreason</div>";
																	}
																	elseif($dec_request == 'Waiving late fee charge')
																	{
																		echo "<div class='quarter_box1'><b>Reason:</b></div><div class='quarter_box2'>$dec_waivinglatereason</div>";
																	}
																	elseif($dec_request == 'Refund due to excess payment')
																	{
																		echo "<div class='quarter_box1'></b>Reason:</b></div><div class='quarter_box2'>$dec_refundreason</div>";
																	}
																	elseif ($dec_request == 'Others')
																	{
																		echo "<div class='quarter_box1'><b>Reason:</b></div><div class='quarter_box2'>$dec_othersreason</div>";
																	}
																	$Finance_ID = $obj->Finance_ID;
																	echo "<input type='hidden' name='Finance_ID' value =$Finance_ID>";
																	echo "<div class='full_box' align='center'><input type='submit' value='Download' onClick='submitform()' style ='width:150px; height:40px;' name='download_stufinances'/></div>";
																	echo "</fieldset></form>";
																}
															}
															?>";
}

function showCancelSPFormDetails()
{
	document.getElementById("body_description").innerHTML = "<?php 
														$infoObj = new Select ();
														if ($result = $infoObj->getCancelStudentPassFormData())
														{
															while ($obj = $result->fetch_object())
															{
																//decrypting data from database
																$security = new Security();
																$dec_FIN = $security->decrypt($obj->FinNumber);
																$dec_title = $security->decrypt($obj->Title);
																$dec_nationality = $security->decrypt($obj->Nationality);
																$dec_fname = $security->decrypt($obj->FamilyName);
																$dec_gname = $security->decrypt($obj->GivenName);
																$dec_jcuEmail = $security->decrypt($obj->JCUEmail);
																$dec_mobileph = $security->decrypt($obj->MobilePhone);
																$dec_homeph = $security->decrypt($obj->HomePhone);
																$dec_course = $security->decrypt($obj->Course);
																$dec_reason = $security->decrypt($obj->Reason);
																																
																//retrieving decrypted data 
																echo "<form action='pdfDownload_functions.php' method='post' class='form'>";
																echo "<h2 align ='center'>Request to Cancel Student Pass</h2>";
																echo "<fieldset><legend>Personal Details:</legend>";
																echo "<div class='half_box'>Student Number (8 digit number)</div><div class='half_box'>$obj->StudentNumber</div>";
																echo "<div class='half_box'>Fin Number (Student's Pass Number):</div><div class='half_box'>$dec_FIN</div>";
																echo "<div class='half_box'>Title:</div><div class='half_box'>$dec_title</div>";
																echo "<div class='half_box'>Nationality:</div><div class='half_box'>$dec_nationality</div>";
																echo "<div class='half_box'>Family Name:</div><div class='half_box'>$dec_fname</div>";
																echo "<div class='half_box'>Given Name: </div><div class='half_box'>$dec_gname</div>";
																echo "<div class='half_box'>JCU E-mail Address: </div><div class='half_box'>$dec_jcuEmail</div>";
																echo "<div class='half_box'>Mobile Phone: </div><div class='half_box'>$dec_mobileph</div>";
																echo "<div class='half_box'>Home Phone Number: </div><div class='half_box'>$dec_homeph</div>";
																echo "<div class='half_box'>Course Type: </div><div class='half_box'>$dec_course</div>";
																echo "<div class='half_box'>Student's Pass Expiry Date:</div><div class='half_box'>$obj->PassExpiryDate</div>";
																echo "</fieldset>";
																echo "<fieldset><legend>Required Documents & Other Information:</legend>";
																echo "<div class='half_box'>Reasons to Cancel Student's Pass:</div><div class='half_box'>$dec_reason</div>";
																echo "<div class='half_box'>When are you leaving Singapore?</div><div class='half_box'>$obj->LeaveDate</div>";
																$Cancel_ID = $obj->Cancel_ID;
																echo "<input type='hidden' name='Cancel_ID' value =$Cancel_ID>";
																echo "<div class='full_box' align='center'><input type='submit' value='Download' style ='width:150px; height:40px;' name='downlaod_cancelSP'/></div>";
																echo "</fieldset></form>";
															}
														}
														?>";
}
function showDeferExamFormDetails()
{
	document.getElementById("body_description").innerHTML = "<?php 
														$infoObj = new Select ();
														if ($result = $infoObj->getDeferExamFormData())
														{
															while ($obj = $result->fetch_object())
															{
																//decrypting data from database
																$security = new Security();
																$dec_title= $security->decrypt($obj->Title);
																$dec_fname = $security->decrypt($obj->FamilyName);
																$dec_gname = $security->decrypt($obj->GivenName);
																$dec_jcuEmail = $security->decrypt($obj->JCUEmail);
																//$dec_email = $security->decrypt($obj->Email):
																$dec_mobileph = $security->decrypt($obj->MobilePhone);
																$dec_homeph = $security->decrypt($obj->HomePhone);
																$dec_course = $security->decrypt($obj->Course);
																$dec_studymode = $security->decrypt($obj->StudyMode);
																$dec_defermentType = $security->decrypt($obj->DefermentType);
																$dec_studyperiod = $security->decrypt($obj->StudyPeriod);
																$dec_year = $security->decrypt($obj->Year);
																$dec_sub1 = $security->decrypt($obj->Subject1);
																$dec_lec1 = $security->decrypt($obj->Lecturer1);
																$dec_sub2 = $security->decrypt($obj->Subject2);
																$dec_lec2 = $security->decrypt($obj->Lecturer2);
																$dec_sub3 = $security->decrypt($obj->Subject3);
																$dec_lec3 = $security->decrypt($obj->Lecturer3);
																															
																//retrieving decrypted data
																echo "<form action='pdfDownload_functions.php' method='post' class='form'>";
																echo "<h2 align ='center'>Request for Deferring of a Formal Examination</h2>";
																echo "<fieldset><legend>Personal Details:</legend>";
																echo "<div class='half_box'>Student Number (8 digit number)</div><div class='half_box'>$obj->StudentNumber</div>";
																echo "<div class='half_box'>Title:</div><div class='half_box'>$dec_title</div>";
																echo "<div class='half_box'>Family Name:</div><div class='half_box'>$dec_fname</div>";
																echo "<div class='half_box'>Given Name:</div><div class='half_box'>$dec_gname</div>";
																echo "<div class='half_box'>JCU E-mail Address:</div><div class='half_box'>$dec_jcuEmail</div>";
																echo "<div class='half_box'>Personal E-mail Address:</div><div class='half_box'>$obj->Email</div>";
																echo "<div class='half_box'>Mobile Phone:</div><div class='half_box'>$dec_mobileph</div>";
																echo "<div class='half_box'>Home Phone Number: </div><div class='half_box'>$dec_homeph</div>";
																echo "<div class='half_box'>Course Type: </div><div class='half_box'>$dec_course</div>";
																echo "<div class='half_box'>Mode of Study:</div><div class='half_box'>$dec_studymode</div>";
																echo "</fieldset>";
																echo "<fieldset><legend>Deferment Request:</legend>";
																echo "<div class='half_box'>Deferment Type:</div><div class='half_box'>$dec_defermentType</div>";
																echo "<div class='half_box'>Study period(SP):</div><div class='half_box'>$dec_studyperiod</div>";
																echo "<div class='half_box'>Year: </div><div class='half_box'>$dec_year</div>";
																echo "<div class='quarter_box1'>Subject 1:</div><div class='quarter_box'>$dec_sub1</div><div class='quarter_box1'>Date of Exam:</div><div class='quarter_box1'>$obj->ExamDate1</div>";
																echo"<div class='quarter_box1'>Name of Lecturer:</div><div class='quarter_box2'>$dec_lec1</div>";
																echo "<div class='quarter_box1'>Subject 2:</div><div class='quarter_box'>$dec_sub2</div><div class='quarter_box1'>Date of Exam:</div><div class='quarter_box1'>$obj->ExamDate2</div>";
																echo "<div class='quarter_box1'>Name of Lecturer:</div><div class='quarter_box2'>$dec_lec2</div>";
																echo "<div class='quarter_box1'>Subject 3:</div><div class='quarter_box'>$dec_sub3</div><div class='quarter_box1'>Date of Exam:</div><div class='quarter_box1'>$obj->ExamDate3</div>";
																echo "<div class='quarter_box1'>Name of Lecturer:</div><div class='quarter_box2'>$dec_lec3</div>";
																$Defer_ID = $obj->Defer_ID;
																echo "<input type='hidden' name='Defer_ID' value =$Defer_ID>";
																echo "<div class='full_box' align ='center'><input type='submit' value='Download' style ='width:150px; height:40px;' name='download_deferexam'/></div>";
																echo "</fieldset></form>";
															}
														}
													?>";
}
function showStudentParticularsFormDetails()
{
	document.getElementById("body_description").innerHTML ="<?php 
														$infoObj = new Select();
														if ($result=$infoObj->getStudentParticularsFormData())
														{
															while ($obj=$result->fetch_object())
															{
																//decrypting data from database
																$security = new Security();
																$dec_FIN = $security->decrypt($obj->FinNumber);
																$dec_title= $security->decrypt($obj->Title);
																$dec_fname = $security->decrypt($obj->FamilyName);
																$dec_gname = $security->decrypt($obj->GivenName);
																//$dec_email = $security->decrypt($obj->Email);
																$dec_course = $security->decrypt($obj->Course);
																$dec_studymode = $security->decrypt($obj->StudyMode);
																$dec_address = $security->decrypt ($obj->Address);
																$dec_postalcode = $security->decrypt($obj->PostalCode);
																$dec_mobileph = $security->decrypt($obj->MobilePhone);
																$dec_emergencycontact = $security->decrypt($obj->EmergencyContact);
																$dec_relationship = $security->decrypt($obj->Relationship);
																$dec_contact_address = $security->decrypt($obj->ContactAddress);
																$dec_contact_postalcode = $security->decrypt($obj->ContactPostalCode);
																$dec_contact_phone = $security->decrypt($obj->ContactPhone);
																$dec_newtitle = $security->decrypt($obj->NewTitle);
																$dec_newfname = $security->decrypt($obj->NewFamilyName);
																$dec_newgname = $security->decrypt($obj->NewGivenName);
																
																															
																//retrieving decrypted data
																echo "<form action='pdfDownload_functions.php' method='post' class='form'>";
																echo "<h2 align ='center'>Student Particulars Form</h2>";
																echo "<fieldset><legend>Current Personal Details:</legend>";
																echo "<div class='half_box'>Student Number (8 digit number)</div><div class='half_box'>$obj->StudentNumber</div>";
																echo "<div class='half_box'>Fin Number (Student's Pass Number):</div><div class='half_box'>$dec_FIN</div>";
																echo "<div class='half_box'>Student's Pass Issued Date:</div><div class='half_box'>$obj->StudentPassIssueDate</div>";
																echo "<div class='half_box'>Title:</div><div class='half_box'>$dec_title</div>";
																echo "<div class='half_box'>Family Name:</div><div class='half_box'>$dec_fname</div>";
																echo "<div class='half_box'>Given Name:</div><div class='half_box'>$dec_gname</div>";
																echo "<div class='half_box'>Personal E-mail Address:</div><div class='half_box'>$obj->Email</div>";
																echo "<div class='half_box'>Course Title:</div><div class='half_box'>$dec_course</div>";
																echo "<div class='half_box'>Mode of Study:</div><div class='half_box'>$dec_studymode</div>";
																echo "</fieldset>";
																echo "<fieldset><legend>Residential Address in Singapore:</legend>";
																echo "<div class='full_box' align = 'center'><b>New residential address in Singapore</b></div>";
																echo "<div class='half_box'>Address:</div><div class='half_box'>$dec_address</div>";
																echo "<div class='half_box'>Postal Code:</div><div class='half_box'>$dec_postalcode</div>";
																echo "<div class='half_box'>Mobile Phone:</div><div class='half_box'>$dec_mobileph</div>";
																echo "<div class='full_box' align = 'center'><b>Emergency Contact</b></div>";
																echo "<div class='half_box'>Name of emergency contact:</div><div class='half_box'>$dec_emergencycontact</div>";
																echo "<div class='half_box'>Relationship to you:</div><div class='half_box'>$dec_relationship</div>";
																echo "<div class='half_box'>Address:</div><div class='half_box'>$dec_contact_address</div>";
																echo "<div class='half_box'>Postal code:</div><div class='half_box'>$dec_contact_postalcode</div>";
																echo "<div class='half_box'>Phone Number:</div><div class='half_box'>$dec_contact_phone</div>";
																echo "</fieldset>";
																echo "<fieldset><legend>Change of Name:</legend>";
																echo "<div class='half_box'>Title:</div><div class='half_box'>$dec_newtitle</div>";
																echo "<div class='half_box'>New Family Name:</div><div class='half_box'>$dec_newfname</div>";
																echo "<div class='half_box'>New Given Name:</div><div class='half_box'>$dec_newgname</div>";
																$Particulars_ID = $obj->Particulars_ID;
																echo "<input type='hidden' name='Particulars_ID' value =$Particulars_ID>";
																echo "<div class='full_box' align ='center'><input type='submit' value='Download' style ='width:150px; height:40px;' name='download_stuparticulars'/></div>";
																echo "</fieldset></form>";
															}
														}
													?>";
}
function showMajorChangeFormDetails()
{
	document.getElementById("body_description").innerHTML ="<?php 
														$infoObj = new Select ();
														if ($result = $infoObj->getChangeMajorFormData())
														{
															while ($obj = $result->fetch_object())
															{
																//decrypting data from database
																$security = new Security();
																$dec_title= $security->decrypt($obj->Title);
																$dec_nationality = $security->decrypt($obj->Nationality);
																$dec_fname = $security->decrypt($obj->FamilyName);
																$dec_gname = $security->decrypt($obj->GivenName);
																$dec_jcuEmail = $security->decrypt($obj->JCUEmail);
																$dec_mobileph = $security->decrypt($obj->MobilePhone);
																$dec_homeph = $security->decrypt($obj->HomePhone);
																$dec_course = $security->decrypt($obj->Course);
																$dec_major = $security->decrypt($obj->Major);
																$dec_adv_standing = $security->decrypt($obj->AdvStanding);
																$dec_newcourse = $security->decrypt($obj->NewCourse);
																$dec_newmajor = $security->decrypt($obj->NewMajor);
																$dec_studyperiod = $security->decrypt($obj->StudyPeriod);
																$dec_year = $security->decrypt($obj->Year);																
																															
																//retrieving decrypted data
																echo "<form action='pdfDownload_functions.php' method='post' class='form'>";
																echo "<h2 align='center'> Change Of Major Form </h2>";
																echo "<fieldset><legend>Personal Details:</legend>";
																echo "<div class='half_box'>Student Number (8 digit number) :</div><div class='half_box'>$obj->StudentNumber</div>";
																echo "<div class='half_box'>Title:</div><div class='half_box'>$dec_title</div>";
																echo "<div class='half_box'>Nationality:</div><div class='half_box'>$dec_nationality</div>";
																echo "<div class='half_box'>Family Name:</div><div class='half_box'>$dec_fname</div>";
																echo "<div class='half_box'>Given Name:</div><div class='half_box'>$dec_gname</div>";
																echo "<div class='half_box'>JCU E-mail Address:</div><div class='half_box'>$dec_jcuEmail</div>";
																echo "<div class='half_box'>Mobile Phone:</div><div class='half_box'>$dec_mobileph</div>";
																echo "<div class='half_box'>Home Phone Number:</div><div class='half_box'>$dec_homeph</div>";
																echo "</fieldset>";	
																echo "<fieldset><legend>Course Information:</legend>";	
																echo "<div class='full_box' align = 'center'><b>Current Course & Major</b></div>";
																echo "<div class='half_box'>Course Title:</div><div class='half_box'>$dec_course</div>";
																echo "<div class='half_box'>Major:</div><div class='half_box'>$dec_major</div>";
																echo "<div class='half_box'>Have you been granted any Advanced Standing?:</div><div class='half_box'>$dec_adv_standing</div>";
																echo "<div class='full_box' align = 'center'><b>Proposed Change of Major</b></div>";
																echo "<div class='half_box'>Course Title:</div><div class='half_box'>$dec_newcourse</div>";;
																echo "<div class='half_box'>Major:</div><div class='half_box'>$dec_newmajor</div>";
																echo "<div class='half_box'>Study Period(SP):</div><div class='half_box'>$dec_studyperiod</div>";
																echo "<div class='half_box'>Year:</div><div class='half_box'>$dec_year</div>";
																$Major_ID = $obj->Major_ID;
																echo "<input type='hidden' name='Major_ID' value =$Major_ID>";
																echo "<div class='full_box' align ='center'><input type='submit' value='Download' style ='width:150px; height:40px;' name='download_changeofmajors'/></div>";
																echo "</fieldset></form>";
															}
														}
													?>";
}
function showCourseTransferAppFormDetails()
{
	document.getElementById("body_description").innerHTML ="<?php 
														$infoObj = new Select ();
														if ($result = $infoObj->getCourseTransferApplicationFromData())
														{
															while ($obj = $result->fetch_object())
															{
																//decrypting data from database
																$security = new Security();
																$dec_title= $security->decrypt($obj->Title);
																$dec_nationality = $security->decrypt($obj->Nationality);
																$dec_fname = $security->decrypt($obj->FamilyName);
																$dec_gname = $security->decrypt($obj->GivenName);
																$dec_gname = $security->decrypt($obj->JCUEmail);
																$dec_mobileph = $security->decrypt($obj->MobilePhone);
																$dec_homeph  = $security->decrypt($obj->HomePhone);
																$dec_currentcoursecode = $security->decrypt($obj->CurrentCourseCode);
																$dec_currentcoursetitle = $security->decrypt($obj->CurrentCourseTitle);
																$dec_currentmajor = $security->decrypt($obj->CurrentMajor);
																$dec_showcase = $security->decrypt($obj->ShowCase);
																$dec_reason = $security->decrypt($obj->Reason);
																$dec_proposedcoursecode = $security->decrypt($obj->ProposedCourseCode);
																$dec_proposedcoursetitle = $security->decrypt($obj->ProposedCourseTitle);
																$dec_proposedmajor = $security->decrypt($obj->ProposedMajor);
																$dec_studyperiod = $security->decrypt($obj->StudyPeriod);
																$dec_year = $security->decrypt($obj->Year);
																$dec_studymode = $security->decrypt($obj->StudyMode);
																															
																															
																//retrieving decrypted data
																echo "<form action='pdfDownload_functions.php' method='post' class='form'>";
																echo "<h2 align='center'> Course Transfer Application </h2>";
																echo "<fieldset><legend>Personal Details:</legend>";
																echo "<div class='half_box'>Student Number (8 digit number) :</div><div class='half_box'>$obj->StudentNumber</div>";
																echo "<div class='half_box'>Title: </div><div class='half_box'>$dec_title</div>";
																echo "<div class='half_box'>Nationality: </div><div class='half_box'>$dec_nationality</div>";
																echo "<div class='half_box'>Family Name: </div><div class='half_box'>$dec_fname</div>";
																echo "<div class='half_box'>Given Name: </div><div class='half_box'>$dec_gname</div>";
																echo "<div class='half_box'>JCU E-mail Address: </div><div class='half_box'>$dec_gname</div>";
																echo "<div class='half_box'>Mobile Phone: </div><div class='half_box'>$dec_mobileph </div>";
																echo "<div class='half_box'>Home Phone Number: </div><div class='half_box'>$dec_homeph </div>";
																echo "</fieldset>";
																echo "<fieldset><legend>Course Information:</legend>";
																echo "<div class='full_box' align = 'center'><b>Current Course</b></div>";
																echo "<div class='half_box'>Course Code:</div><div class='half_box'>$dec_currentcoursecode</div>";
																echo "<div class='half_box'>Course Title:</div><div class='half_box'>$dec_currentcoursetitle</div>";
																echo "<div class='half_box'>Major:</div><div class='half_box'>$dec_currentmajor</div>";
																echo "<div class='half_box'>Are you required to show cause for this course?</div><div class='half_box'>$dec_showcase</div>";
																echo "<div class='half_box'>Statement of Reason:</div><div class='half_box'>$dec_reason</div>";
																echo "<div class='full_box' align = 'center'><b>Proposed Course</b></div>";
																echo "<div class='half_box'>Course Code:</div><div class='half_box'>$dec_proposedcoursecode</div>";
																echo "<div class='half_box'>Major:</div><div class='half_box'>$dec_proposedmajor</div>";
																echo "<div class='half_box'>Study Period(SP):</div><div class='half_box'>$dec_studyperiod</div>";
																echo "<div class='half_box'>Year:</div><div class='half_box'>$dec_year</div>";
																echo "<div class='half_box'>Study Mode:</div><div class='half_box'>$dec_studymode</div>";
																$Application_ID = $obj->Application_ID;
																echo "<input type='hidden' name='Application_ID' value =$Application_ID>";
																echo "<div class='full_box' align ='center'><input type='submit' value='Download' style ='width:150px; height:40px;' name='download_coursetransfer'/></div>";
																echo "</fieldset></form>";																
															}
														}
													?>";
}

function showEnquiryFormDetails()
{
	document.getElementById("body_description").innerHTML = "<?php
																
														$infoObj = new Select ();
														if ($result = $infoObj->getEnquiryFormData())
														{
															while ($obj = $result->fetch_object())
															{
																//decrypting data from database
																$security = new Security();
																$dec_enquiry_subject = $security->decrypt($obj->EnquirySubject);
																$dec_enquiry_issues = $security->decrypt($obj->EnquiryIssues);
																$dec_enquiry_message = $security->decrypt($obj->EnquiryMessage);
																
																//retrieving decrypted data
																echo "<div id = 'title'>&nbsp;&nbsp;Enquiry</div>";
																echo "<div style = 'width:100%; height;905px; background-color:#FFF;'>";
																echo "<form><div id = 'enquiry1'>&nbsp;&nbsp;<b>Subject</b>&ensp;:$dec_enquiry_subject</div>";
																echo "<div id = 'enquiry2'>&nbsp;&nbsp;<b>Issues</b>&ensp;&ensp;:$dec_enquiry_issues</div>";
																echo "<div align = 'center'>";
																echo "<textarea placeholder='$dec_enquiry_message' id='message'></textarea>";
																echo "</div></form>";
															}
														}
															?>";
}

function hovereffect(text)
{
	text.style.backgroundColor='#33389d';
	text.style.color='#fff';
}

function normaleffect(text)
{
	text.style.color='black';
	text.style.backgroundColor='#FFF';
}

function hover(text)
{
	text.style.backgroundColor='#F1F1F1';
}

function normal(text)
{
	text.style.backgroundColor='#FFF';
}
</script>