<?php
require_once( "fpdf/fpdf.php" );
require ("classes/dbClasses.php");

$security = new Security();

/*.......download functions for admin page(upload file).......*/
if(isset($_GET['Cancel_ID'])) 
{
    $Cancel_ID = intval($_GET['Cancel_ID']); //get ig
	if($Cancel_ID <= 0) {
        die('The ID is invalid!');
    }
    else 
	{
		$infoObj = new getByID ();
		if ($result = $infoObj->getCancelStudentPassFormData ($Cancel_ID))
		{
			while ($obj = $result->fetch_object())
			{
				
				
				// Print headers
                header("Content-Type: ". $obj->FileType);
                header("Content-Length: ". $obj->FileSize);
                header("Content-Disposition: attachment; FileName=".$obj->FileName);
			}
		}
    }
}
elseif(isset($_GET['Defer_ID'])) 
{
    $Defer_ID = intval($_GET['Defer_ID']); //get ig
	if($Defer_ID <= 0) {
        die('The ID is invalid!');
    }
    else 
	{
		$infoObj = new getByID ();
		if ($result = $infoObj->getDeferExamFormData($Defer_ID))
		{
			while ($obj = $result->fetch_object())
			{
				
				
				// Print headers
                header("Content-Type: ". $obj->FileType);
                header("Content-Length: ". $obj->FileSize);
                header("Content-Disposition: attachment; FileName=".$obj->FileName);
			}
		}
    }
}
/*.......pdf format for request for enrolment of subjects form.......*/
elseif (isset($_POST['download_enroll']))
{
	$pdf = new FPDF( 'P', 'mm', 'A4' );
	$pdf->AddPage();

	$pdf->Image( "JCUlogo.jpg", 0, 0, 60 ); //LOGO file , xpos, ypos,width
	$pdf->SetFont( 'Arial', 'B', 20);
	$pdf->Ln( 30 );
	$pdf->Cell( 0, 0, 'Request Form for Student Finances', 0, 0, 'C' ); //w,h,txt,border,ln,align,fill,link

	$pdf->SetFont( 'Arial', 'B', 15);
	$pdf->Write(10,'Personal Details');

	$Enroll_ID = $_POST['Enroll_ID'];
	$con = mysql_connect("127.0.0.1","root",""); //connecting server
	mysql_select_db('jcu_db',$con);  //selecting database
	$data = mysql_query("SELECT * FROM jcu_db.enrolments WHERE Enroll_ID = $Enroll_ID ");  
	while ($row = mysql_fetch_array($data))
	{
		$pdf->setFont("times","","12");
		
		$pdf->setXY(25, 70);
		$pdf->Cell(90, 10, "Student Number(8 digit number):", 0, 0, "L", 0);
		$pdf->Cell(90, 10,$row['StudentNumber'], 0, 0, "L", 0);
		
		$pdf->setXY(25, 80);
		$pdf->Cell(90, 10, "Title:", 0, 0, "L", 0);
		$pdf->Cell(90, 10,$security->decrypt($row['Title']), 0, 0, "L", 0);
		
		$pdf->setXY(25, 90);
		$pdf->Cell(90, 10, "Nationality:", 0, 0, "L", 0);
		$pdf->Cell(90, 10,$security->decrypt($row['Nationality']),  0, 0, "L", 0);
			
		$pdf->setXY(25, 100);
		$pdf->Cell(90, 10, "Family Name:", 0, 0, "L", 0);
		$pdf->Cell(90, 10, $security->decrypt($row['FamilyName']), 0, 0, "L", 0);
			
		$pdf->setXY(25,110);
		$pdf->Cell(90, 10, "Given Name:", 0, 0, "L", 0);
		$pdf->Cell(90, 10, $security->decrypt($row['GivenName']),  0, 0, "L", 0);
			
		$pdf->setXY(25, 120);
		$pdf->Cell(90, 10, "JCU E-mail Address:", 0, 0, "L", 0);
		$pdf->Cell(90, 10, $security->decrypt($row['JCUEmail']),  0, 0, "L", 0);
		
		$pdf->setXY(25, 130);
		$pdf->Cell(90, 10, "Mobile Phone:", 0, 0, "L", 0);
		$pdf->Cell(90, 10, $security->decrypt($row['MobilePhone']),  0, 0, "L", 0);
			
		$pdf->setXY(25, 140);
		$pdf->Cell(90, 10, "Home Phone Number:", 0, 0, "L", 0);
		$pdf->Cell(90, 10, $security->decrypt($row['HomePhone']),  0, 0, "L", 0);
			
		$pdf->setXY(25, 150);
		$pdf->Cell(90, 10, "Course Title:", 0, 0, "L", 0);
		$pdf->Cell(90, 10, $security->decrypt($row['Course']),  0, 0, "L", 0);
			
		$pdf->setXY(25, 160);
		$pdf->Cell(90, 10, "Major:", 0, 0, "L", 0);
		$pdf->Cell(90, 10, $security->decrypt($row['Major']),  0, 0, "L", 0);
		
		$pdf->setXY(25, 170);
		$pdf->Cell(90, 10, "Have you been granted any Advanced Standing?", 0, 0, "L", 0);
		$pdf->Cell(90, 10, $security->decrypt($row['AdvStanding']),  0, 0, "L", 0);
		
		$pdf->setXY(25, 180);
		$pdf->Cell(90, 10, "Did you apply for a trimester leave of absence:", 0, 0, "L", 0);
		$pdf->Cell(90, 10, $security->decrypt($row['TrimesterLeave']),  0, 0, "L", 0);
			
		$pdf->setXY(25, 190);
		$pdf->Cell(90, 10, "Mode of Study:", 0, 0, "L", 0);
		$pdf->Cell(90, 10, $security->decrypt($row['StudyMode']),  0, 0, "L", 0);

		$pdf->AddPage();

		$pdf->Image( "JCUlogo.jpg", 0, 0, 60 ); //LOGO file , xpos, ypos,width
		$pdf->SetFont( 'Arial', 'B', 20);
		$pdf->Ln( 30 );
		$pdf->Cell( 0, 0, 'Request for Enrolment of Subjects', 0, 0, 'C' ); //w,h,txt,border,ln,align,fill,link

		$pdf->SetFont( 'Arial', 'B', 15);
		$pdf->Write(10,'Enrolment Details');

		$pdf->setFont("times","","12");
		
		$pdf->setXY(25, 70);
		$pdf->Cell(90, 10, "Study Period (SP):",0, 0, "L", 0);
		$pdf->Cell(90, 10, $security->decrypt($row['StudyPeriod']) , 0, 0, "L", 0);
		
		$pdf->setXY (25,80);
		$pdf->Cell(90,10,"Year:",0, 0, "L", 0);
		$pdf->Cell(90,10, $security->decrypt($row['Year']) ,0, 0, "L", 0);
		
		$pdf->Write(10,'Subjects to be enrolled & withdrawn');
		
		$pdf->setXY(25,100);
		$pdf->Cell(60,10,"Subjects to be Enrolled",0, 0, "C", 0);
		$pdf->Cell(60,10,"Subjects to be Withdrawn",0, 0, "C", 0);
		$pdf->Cell(60,10,"Attendance Mode",0, 0, "C", 0);
		
		$pdf->setXY(25,110);
		$pdf->Cell(60,10,$security->decrypt($row['SubEnrol1']),0, 0, "C", 0);
		$pdf->Cell(60,10,$security->decrypt($row['SubWithdraw1']),0, 0, "C", 0);
		$pdf->Cell(60,10,$security->decrypt($row['Sub1AttendanceMode']),0, 0, "C", 0);
		
		$pdf->setXY(25,120);
		$pdf->Cell(60,10,$security->decrypt($row['SubEnrol2']),0, 0, "C", 0);
		$pdf->Cell(60,10,$security->decrypt($row['SubWithdraw2']),0, 0, "C", 0);
		$pdf->Cell(60,10,$security->decrypt($row['Sub2AttendanceMode']),0, 0, "C", 0);
		
		$pdf->setXY(25,130);
		$pdf->Cell(60,10,$security->decrypt($row['SubEnrol3']),0,0,"C",0);
		$pdf->Cell(60,10,$security->decrypt($row['SubWithdraw3']),0, 0, "C", 0);
		$pdf->Cell(60,10,$security->decrypt($row['Sub3AttendanceMode']),0, 0, "C", 0);
		
		$pdf->setXY(25,140);
		$pdf->Cell(60,10,$security->decrypt($row['SubEnrol4']),0, 0, "C", 0);
		$pdf->Cell(60,10,$security->decrypt($row['SubWithdraw4']),0, 0, "C", 0);
		$pdf->Cell(60,10,$security->decrypt($row['Sub4AttendanceMode']),0, 0, "C", 0);
		
		$pdf->setXY(25,150);
		$pdf->Cell(60,10,$security->decrypt($row['SubEnrol5']),0, 0, "C", 0);
		$pdf->Cell(60,10,$security->decrypt($row['SubWithdraw5']),0, 0, "C", 0);
		$pdf->Cell(60,10,$security->decrypt($row['Sub5AttendanceMode']),0, 0, "C", 0);
	}
		$pdf->Output( "Request_for_enrolment.pdf", "D" );
}
/*.......pdf format of Request Form for Student Finances.......*/
elseif (isset($_POST['download_stufinances']))
{
	$pdf = new FPDF( 'P', 'mm', 'A4' );
	$pdf->AddPage();

	$pdf->Image( "JCUlogo.jpg", 0, 0, 60 ); //LOGO file , xpos, ypos,width
	$pdf->SetFont( 'Arial', 'B', 20);
	$pdf->Ln( 30 );
	$pdf->Cell( 0, 0, 'Request Form for Student Finances', 0, 0, 'C' ); //w,h,txt,border,ln,align,fill,link

	$pdf->SetFont( 'Arial', 'B', 15);
	$pdf->Write(10,'Personal Details');

	$Finance_ID = $_POST['Finance_ID'];
	$con = mysql_connect("127.0.0.1","root",""); //connecting server
	mysql_select_db('jcu_db',$con);  //selecting database
	$data = mysql_query("SELECT * FROM jcu_db.student_finances WHERE Finance_ID = $Finance_ID "); 
	while ($row = mysql_fetch_array($data))
	{
		$pdf->setFont("times","","12");
		
		$pdf->setXY(25, 70);
		$pdf->Cell(90, 10, "Student Number(8 digit number):", 0, 0, "L", 0);
		$pdf->Cell(90, 10,$row['StudentNumber'], 0, 0, "L", 0);
		
		$pdf->setXY(25, 80);
		$pdf->Cell(90, 10, "FIN Number(Student's Pass number):", 0, 0, "L", 0);
		$pdf->Cell(90, 10,$security->decrypt($row['FinNumber']), 0, 0, "L", 0);
			
		$pdf->setXY(25, 90);
		$pdf->Cell(90, 10, "Title:", 0, 0, "L", 0);
		$pdf->Cell(90, 10,$security->decrypt($row['Title']), 0, 0, "L", 0);
			
		$pdf->setXY(25, 100);
		$pdf->Cell(90, 10, "Family Name:", 0, 0, "L", 0);
		$pdf->Cell(90, 10, $security->decrypt($row['FamilyName']), 0, 0, "L", 0);
			
		$pdf->setXY(25,110);
		$pdf->Cell(90, 10, "Given Name:", 0, 0, "L", 0);
		$pdf->Cell(90, 10, $security->decrypt($row['GivenName']),  0, 0, "L", 0);
			
		$pdf->setXY(25, 120);
		$pdf->Cell(90, 10, "JCU E-mail Address:", 0, 0, "L", 0);
		$pdf->Cell(90, 10, $security->decrypt($row['JCUEmail']),  0, 0, "L", 0);
		
		$pdf->setXY(25, 130);
		$pdf->Cell(90, 10, "Mobile Phone:", 0, 0, "L", 0);
		$pdf->Cell(90, 10, $security->decrypt($row['MobilePhone']),  0, 0, "L", 0);
			
		$pdf->setXY(25, 140);
		$pdf->Cell(90, 10, "Home Phone Number:", 0, 0, "L", 0);
		$pdf->Cell(90, 10, $security->decrypt($row['HomePhone']),  0, 0, "L", 0);
			
		$pdf->setXY(25, 150);
		$pdf->Cell(90, 10, "Passport No. :", 0, 0, "L", 0);
		$pdf->Cell(90, 10, $security->decrypt($row['Passport']),  0, 0, "L", 0);
			
		$pdf->setXY(25, 160);
		$pdf->Cell(90, 10, "Current Course Type:", 0, 0, "L", 0);
		$pdf->Cell(90, 10, $security->decrypt($row['Course']),  0, 0, "L", 0);
		
		$pdf->setXY(25, 170);
		$pdf->Cell(90, 10, "Mode of Study:", 0, 0, "L", 0);
		$pdf->Cell(90, 10,$security->decrypt($row['StudyMode']),  0, 0, "L", 0);

		$pdf->AddPage();

		$pdf->Image( "JCUlogo.jpg", 0, 0, 60 ); //LOGO file , xpos, ypos,width
		$pdf->SetFont( 'Arial', 'B', 20);
		$pdf->Ln( 30 );
		$pdf->Cell( 0, 0, 'Request Form for Student Finances', 0, 0, 'C' ); //w,h,txt,border,ln,align,fill,link

		$pdf->SetFont( 'Arial', 'B', 15);
		$pdf->Write(10,'Type of Request');

		$pdf->setFont("times","","12");
		
		$pdf->setXY(25, 70);
		$pdf->Cell(90, 10, "Type of Request:", 0, 0, "L", 0);
		$pdf->Cell(90, 10,$security->decrypt($row['RequestType']), 0, 0, "L", 0);
		
		$RequestType = $security->decrypt($row['RequestType']);
		if ($RequestType =='Extension of Payment')
		{
			$pdf->setXY(25,80);
			$pdf->Cell(90,10,"Period of Extension:",0,0,"L",0);
			$pdf->Cell(90,10,$security->decrypt($row['PeriodExtension']),0,0,"L",0);
			$pdf->setXY(25,90);
			$pdf->Cell(90,10,"Reason for Extension:",0,0,"L",0);
			$pdf->Cell(90,10,$security->decrypt($row['ExtensionReason']),0,0,"L",0);
			
		}
		elseif ($RequestType =='Waiving late fee charge')
		{
			$pdf->setXY(25,80);
			$pdf->Cell(90,10,"Reason:",0,0,"L",0);
			$pdf->Cell(90,10,$security->decrypt($row['WaivingLateReason']),0,0,"L",0);
		}
		elseif ($RequestType =='Refund due to excess payment')
		{
			$pdf->setXY(25,80);
			$pdf->Cell(90,10,"Reason:",0,0,"L",0);
			$pdf->Cell(90,10,$security->decrypt($row['RefundReason']),0,0,"L",0);
		}
		elseif ($security->decrypt($RequestType =='Others'))
		{
			$pdf->setXY(25,80);
			$pdf->Cell(90,10,"Reason:",0,0,"L",0);
			$pdf->Cell(90,10,$security->decrypt($row['OthersReason']),0,0,"L",0);
		}
	}
	$pdf->Output( "Request Form for Student Finances.pdf", "D" );
}
/*.......pdf format of Request to Cancel Student Pass Form.......*/
elseif (isset($_POST['downlaod_cancelSP']))
{
	$pdf = new FPDF( 'P', 'mm', 'A4' );
	$pdf->AddPage();

	$pdf->Image( "JCUlogo.jpg", 0, 0, 60 ); //LOGO file , xpos, ypos,width
	$pdf->SetFont( 'Arial', 'B', 20);
	$pdf->Ln( 30 );
	$pdf->Cell( 0, 0, 'Request to Cancel Student Pass', 0, 0, 'C' ); //w,h,txt,border,ln,align,fill,link

	$pdf->SetFont( 'Arial', 'B', 15);
	$pdf->Write(10,'Personal Details');
	
	$Cancel_ID = $_POST['Cancel_ID'];
	$con = mysql_connect("127.0.0.1","root",""); //connecting server
	mysql_select_db('jcu_db',$con);  //selecting database
	$data = mysql_query("SELECT * FROM jcu_db.cancel_studentpass WHERE Cancel_ID = $Cancel_ID "); 
	while ($row = mysql_fetch_array($data))
	{
		$pdf->setFont("times","","12");
		
		$pdf->setXY(25, 70);
		$pdf->Cell(90, 10, "Student Number(8 digit number):",0,0,"L",0);
		$pdf->Cell(90, 10,$row['StudentNumber'],0,0,"L",0);
		
		$pdf->setXY(25, 80);
		$pdf->Cell(90, 10, "FIN Number(Student's Pass number):",0,0,"L",0);
		$pdf->Cell(90, 10,$security->decrypt($row['FinNumber']),0,0,"L",0);
			
		$pdf->setXY(25, 90);
		$pdf->Cell(90, 10, "Title:",0,0,"L",0);
		$pdf->Cell(90, 10,$security->decrypt($row['Title']),0,0,"L",0);
		
		$pdf->setXY(25, 100);
		$pdf->Cell(90, 10, "Nationality:",0,0,"L",0);
		$pdf->Cell(90, 10, $security->decrypt($row['Nationality']),0,0,"L",0);
			
		$pdf->setXY(25, 110);
		$pdf->Cell(90, 10, "Family Name:",0,0,"L",0);
		$pdf->Cell(90, 10, $security->decrypt($row['FamilyName']),0,0,"L",0);
			
		$pdf->setXY(25,120);
		$pdf->Cell(90, 10, "Given Name:",0,0,"L",0);
		$pdf->Cell(90, 10, $security->decrypt($row['GivenName']),0,0,"L",0);
			
		$pdf->setXY(25, 130);
		$pdf->Cell(90, 10, "JCU E-mail Address:",0,0,"L",0);
		$pdf->Cell(90, 10, $security->decrypt($row['JCUEmail']),0,0,"L",0);
		
		$pdf->setXY(25, 140);
		$pdf->Cell(90, 10, "Mobile Phone:",0,0,"L",0);
		$pdf->Cell(90, 10, $security->decrypt($row['MobilePhone']),0,0,"L",0);
			
		$pdf->setXY(25, 150);
		$pdf->Cell(90, 10, "Home Phone Number:",0,0,"L",0);
		$pdf->Cell(90, 10, $security->decrypt($row['HomePhone']),0,0,"L",0);
			
		$pdf->setXY(25, 160);
		$pdf->Cell(90, 10, "Course Type:",0,0,"L",0);
		$pdf->Cell(90, 10, $security->decrypt($row['Course']),0,0,"L",0);
		
		$pdf->setXY(25, 170);
		$pdf->Cell(90, 10, "Student's Pass Expiry Date:",0,0,"L",0);
		$pdf->Cell(90, 10,$row['PassExpiryDate'],0,0,"L",0);
		$pdf->AddPage();

		$pdf->Image( "JCUlogo.jpg", 0, 0, 60 ); //LOGO file , xpos, ypos,width
		$pdf->SetFont( 'Arial', 'B', 20);
		$pdf->Ln( 30 );
		$pdf->Cell( 0, 0, 'Request to Cancel Student Pass',0,0,"L",0);

		$pdf->SetFont( 'Arial', 'B', 15);
		$pdf->Write(10,'Required Documents & Other Information');

		$pdf->setFont("times","","12");
		
		$pdf->setXY(25, 70);
		$pdf->Cell(90, 10, "Reasons to Cancel Student's Pass:",0,0,"L",0);
		$pdf->Cell(90, 10,$security->decrypt($row['Reason']),0,0,"L",0);
		
		$pdf->setXY(25,80);
		$pdf->Cell(90, 10, "When are you leaving Singapore?",0,0,"L",0);
		$pdf->Cell(90,10,$row['LeaveDate'],0,0,"L",0);
		
	}
	$pdf->Output( "Request to Cancel Student Pass.pdf", "D" );
}
/*.......pdf format of Request for Deferring of a Formal Examination Form.......*/
elseif (isset($_POST['download_deferexam']))
{
	$pdf = new FPDF( 'P', 'mm', 'A4' );
	$pdf->AddPage();

	$pdf->Image( "JCUlogo.jpg", 0, 0, 60 ); //LOGO file , xpos, ypos,width
	$pdf->SetFont( 'Arial', 'B', 20);
	$pdf->Ln( 30 );
	$pdf->Cell( 0, 0, 'Request for Deferring of a Formal Examination', 0, 0, 'C' ); //w,h,txt,border,ln,align,fill,link

	$pdf->SetFont( 'Arial', 'B', 15);
	$pdf->Write(10,'Personal Details');

	$Defer_ID = $_POST['Defer_ID'];
	$con = mysql_connect("127.0.0.1","root",""); //connecting server
	mysql_select_db('jcu_db',$con);  //selecting database
	$data = mysql_query("SELECT * FROM jcu_db.defer_exam WHERE Defer_ID = $Defer_ID "); 
	while ($row = mysql_fetch_array($data))
	{
		$pdf->setFont("times","","12");
		
		$pdf->setXY(25, 70);
		$pdf->Cell(90, 10, "Student Number(8 digit number):",0,0,"L",0);
		$pdf->Cell(90, 10,$row['StudentNumber'],0,0,"L",0);
		
		$pdf->setXY(25, 80);
		$pdf->Cell(90, 10, "Title:",0,0,"L",0);
		$pdf->Cell(90, 10,$security->decrypt($row['Title']),0,0,"L",0);
			
		$pdf->setXY(25, 90);
		$pdf->Cell(90, 10, "Family Name:",0,0,"L",0);
		$pdf->Cell(90, 10, $security->decrypt($row['FamilyName']),0,0,"L",0);
			
		$pdf->setXY(25,100);
		$pdf->Cell(90, 10, "Given Name:",0,0,"L",0);
		$pdf->Cell(90, 10, $security->decrypt($row['GivenName']),0,0,"L",0);
			
		$pdf->setXY(25, 110);
		$pdf->Cell(90, 10, "JCU E-mail Address:",0,0,"L",0);
		$pdf->Cell(90, 10, $security->decrypt($row['JCUEmail']),0,0,"L",0);
		
		$pdf->setXY(25, 120);
		$pdf->Cell(90, 10, "Personal E-mail Address:",0,0,"L",0);
		$pdf->Cell(90, 10, $row['Email'],0,0,"L",0);
		
		$pdf->setXY(25, 130);
		$pdf->Cell(90, 10, "Mobile Phone:",0,0,"L",0);
		$pdf->Cell(90, 10, $security->decrypt($row['MobilePhone']),0,0,"L",0);
			
		$pdf->setXY(25, 140);
		$pdf->Cell(90, 10, "Home Phone Number:",0,0,"L",0);
		$pdf->Cell(90, 10, $security->decrypt($row['HomePhone']),0,0,"L",0);
			
		$pdf->setXY(25, 150);
		$pdf->Cell(90, 10, "Course Type:",0,0,"L",0);
		$pdf->Cell(90, 10, $security->decrypt($row['Course']),0,0,"L",0);
		
		$pdf->setXY(25, 160);
		$pdf->Cell(90, 10, "Mode of Study:",0,0,"L",0);
		$pdf->Cell(90, 10,$security->decrypt($row['StudyMode']),0,0,"L",0);

		$pdf->AddPage();

		$pdf->Image( "JCUlogo.jpg", 0, 0, 60 ); //LOGO file , xpos, ypos,width
		$pdf->SetFont( 'Arial', 'B', 20);
		$pdf->Ln( 30 );
		$pdf->Cell( 0, 0, 'Request for Deferring of a Formal Examination', 0, 0, 'C' ); //w,h,txt,border,ln,align,fill,link

		$pdf->SetFont( 'Arial', 'B', 15);
		$pdf->Write(10,'Deferment Request');

		$pdf->setFont("times","","12");
		
		$pdf->setXY(25, 70);
		$pdf->Cell(90, 10, "Deferment Type:",0,0,"L",0);
		$pdf->Cell(90, 10,$security->decrypt($row['DefermentType']),0,0,"L",0);
		
		$pdf->setXY (25,80);
		$pdf->Cell(90,10,"Study Period:",0,0,"L",0);
		$pdf->Cell(90,10,$security->decrypt($row['StudyPeriod']),0,0,"L",0);
		
		$pdf->setXY (25,90);
		$pdf->Cell(90,10,"Year:",0,0,"L",0);
		$pdf->Cell(90,10,$security->decrypt($row['Year']),0,0,"L",0);
		
		$pdf->setXY (25,100);
		$pdf->Cell(90,10,"Subject 1:",0,0,"L",0);
		$pdf->Cell(90,10,$security->decrypt($row['Subject1']),0,0,"L",0);
		
		$pdf->setXY (25,110);
		$pdf->Cell(90,10,"Date of Exam:",0,0,"L",0);
		$pdf->Cell(90,10,$row['ExamDate1'],0,0,"L",0);
		
		$pdf->setXY (25,120);
		$pdf->Cell(90,10,"Name of Lecturer:",0,0,"L",0);
		$pdf->Cell(90,10,$security->decrypt($row['Lecturer1']),0,0,"L",0);
		
		$pdf->setXY (25,130);
		$pdf->Cell(90,10,"Subject 2:",0,0,"L",0);
		$pdf->Cell(90,10,$security->decrypt($row['Subject2']),0,0,"L",0);
		
		$pdf->setXY (25,140);
		$pdf->Cell(90,10,"Date of Exam:",0,0,"L",0);
		$pdf->Cell(90,10,$row['ExamDate2'],0,0,"L",0);
		
		$pdf->setXY (25,150);
		$pdf->Cell(90,10,"Name of Lecturer:",0,0,"L",0);
		$pdf->Cell(90,10,$security->decrypt($row['Lecturer2']),0,0,"L",0);
		
		$pdf->setXY (25,160);
		$pdf->Cell(90,10,"Subject 3:",0,0,"L",0);
		$pdf->Cell(90,10,$security->decrypt($row['Subject3']),0,0,"L",0);
		
		$pdf->setXY (25,170);
		$pdf->Cell(90,10,"Date of Exam:",0,0,"L",0);
		$pdf->Cell(90,10,$row['ExamDate3'],0,0,"L",0);
		
		$pdf->setXY (25,180);
		$pdf->Cell(90,10,"Name of Lecturer:",0,0,"L",0);
		$pdf->Cell(90,10,$security->decrypt($row['Lecturer3']),0,0,"L",0);
		
		
	}
	$pdf->Output( "Request for Deferring of a Formal Examination.pdf", "D" );
}
/*.......pdf format of Student Particulars Form.......*/
elseif (isset($_POST['download_stuparticulars']))
{
	$pdf = new FPDF( 'P', 'mm', 'A4' );
	$pdf->AddPage();

	$pdf->Image( "JCUlogo.jpg", 0, 0, 60 ); //LOGO file , xpos, ypos,width
	$pdf->SetFont( 'Arial', 'B', 20);
	$pdf->Ln( 30 );
	$pdf->Cell( 0, 0, 'Student Particulars Form', 0, 0, 'C' ); //w,h,txt,border,ln,align,fill,link

	$pdf->SetFont( 'Arial', 'B', 15);
	$pdf->Write(10,'Current Personal Details');

	$Particulars_ID = $_POST['Particulars_ID'];
	$con = mysql_connect("127.0.0.1","root",""); //connecting server
	mysql_select_db('jcu_db',$con);  //selecting database
	$data = mysql_query("SELECT * FROM jcu_db.student_particulars WHERE Particulars_ID = $Particulars_ID ");
	while ($row = mysql_fetch_array($data))
	{
		$pdf->setFont("times","","12");
		
		$pdf->setXY(25, 70);
		$pdf->Cell(90, 10, "Student Number(8 digit number):",0,0,"L",0);
		$pdf->Cell(90, 10,$row['StudentNumber'],0,0,"L",0);
		
		$pdf->setXY(25, 80);
		$pdf->Cell(90, 10, "FIN Number(Student's Pass number):",0,0,"L",0);
		$pdf->Cell(90, 10,$security->decrypt($row['FinNumber']),0,0,"L",0);
			
		$pdf->setXY(25, 90);
		$pdf->Cell(90, 10, "Student's Pass Issued Date:",0,0,"L",0);
		$pdf->Cell(90, 10,$row['StudentPassIssueDate'],0,0,"L",0);
			
		$pdf->setXY(25, 100);
		$pdf->Cell(90, 10, "Title:",0,0,"L",0);
		$pdf->Cell(90, 10,$security->decrypt($row['Title']),0,0,"L",0);
			
		$pdf->setXY(25, 110);
		$pdf->Cell(90, 10, "Family Name:",0,0,"L",0);
		$pdf->Cell(90, 10, $security->decrypt($row['FamilyName']),0,0,"L",0);
			
		$pdf->setXY(25,120);
		$pdf->Cell(90, 10, "Given Name:",0,0,"L",0);
		$pdf->Cell(90, 10, $security->decrypt($row['GivenName']),0,0,"L",0);
			
		$pdf->setXY(25, 130);
		$pdf->Cell(90, 10, "Personal E-mail Address:",0,0,"L",0);
		$pdf->Cell(90, 10, $row['Email'],0,0,"L",0);
		
		$pdf->setXY(25, 140);
		$pdf->Cell(90, 10, "Course Title:",0,0,"L",0);
		$pdf->Cell(90, 10, $security->decrypt($row['Course']),0,0,"L",0);
		
		$pdf->setXY(25, 150);
		$pdf->Cell(90, 10, "Mode of Study:",0,0,"L",0);
		$pdf->Cell(90, 10,$security->decrypt($row['StudyMode']),0,0,"L",0);

		$pdf->AddPage();

		$pdf->Image( "JCUlogo.jpg", 0, 0, 60 ); //LOGO file , xpos, ypos,width
		$pdf->SetFont( 'Arial', 'B', 20);
		$pdf->Ln( 30 );
		$pdf->Cell( 0, 0, 'Student Particulars Form', 0, 0, 'C' ); //w,h,txt,border,ln,align,fill,link

		$pdf->SetFont( 'Arial', 'B', 15);
		$pdf->Write(10,'New Residential Address in Singapore');
		$pdf->setFont("times","","12");
		$pdf->setXY(25, 70);
		$pdf->Cell(90, 10, "Address:",0,0,"L",0);
		$pdf->Cell(90, 10,$security->decrypt($row['Address']),0,0,"L",0);
		
		$pdf->setXY (25,80);
		$pdf->Cell(90,10,"Postal code:",0,0,"L",0);
		$pdf->Cell(90,10,$security->decrypt($row['PostalCode']),0,0,"L",0);
		
		$pdf->setXY (25,90);
		$pdf->Cell(90,10,"Mobile Phone:",0,0,"L",0);
		$pdf->Cell(90,10,$security->decrypt($row['MobilePhone']),0,0,"L",0);
		
		$pdf->setFont("times","B","12");
		$pdf->Write(10,'Emegency contact');
		
		$pdf->setFont("times","","12");
		$pdf->setXY (25,110);
		$pdf->Cell(90,10,"Name of emergency contact:",0,0,"L",0);
		$pdf->Cell(90,10,$security->decrypt($row['EmergencyContact']),0,0,"L",0);
		
		$pdf->setXY (25,120);
		$pdf->Cell(90,10,"Relationship to you:",0,0,"L",0);
		$pdf->Cell(90,10,$security->decrypt($row['Relationship']),0,0,"L",0);
		
		$pdf->setXY (25,130);
		$pdf->Cell(90,10,"Address:",0,0,"L",0);
		$pdf->Cell(90,10,$security->decrypt($row['ContactAddress']),0,0,"L",0);
		
		$pdf->setXY (25,140);
		$pdf->Cell(90,10,"Postal code:",0,0,"L",0);
		$pdf->Cell(90,10,$security->decrypt($row['ContactPostalCode']),0,0,"L",0);
		
		$pdf->setXY (25,150);
		$pdf->Cell(90,10,"Phone Number:",0,0,"L",0);
		$pdf->Cell(90,10,$security->decrypt($row['ContactPhone']),0,0,"L",0);
		
		$pdf->setFont("times","B","12");
		$pdf->Write(10,'Change of Name:');
		$pdf->Write(10,'Students who wish to change their name on University records should attach appropriate supporting documentation, such as a certified Passport copy.');
		
		$pdf->setFont("times","","12");
		$pdf->setXY (25,190);
		$pdf->Cell(90,10,"Title:",0,0,"L",0);
		$pdf->Cell(90,10,$security->decrypt($row['NewTitle']),0,0,"L",0);
		
		$pdf->setXY (25,200);
		$pdf->Cell(90,10,"New Family Name:",0,0,"L",0);
		$pdf->Cell(90,10,$security->decrypt($row['NewFamilyName']),0,0,"L",0);
		
		$pdf->setXY (25,210);
		$pdf->Cell(90,10,"New Given Name:",0,0,"L",0);
		$pdf->Cell(90,10,$security->decrypt($row['NewGivenName']),0,0,"L",0);
	}
	$pdf->Output( "Student Particulars Form.pdf", "D" );
}
/*.......pdf format of Change Of Major Form.......*/
elseif (isset($_POST['download_changeofmajors']))
{
	$pdf = new FPDF( 'P', 'mm', 'A4' );
	$pdf->AddPage();

	$pdf->Image( "JCUlogo.jpg", 0, 0, 60 ); //LOGO file , xpos, ypos,width
	$pdf->SetFont( 'Arial', 'B', 20);
	$pdf->Ln( 30 );
	$pdf->Cell( 0, 0, 'Change Of Major Form', 0, 0, 'C' ); //w,h,txt,border,ln,align,fill,link

	$pdf->SetFont( 'Arial', 'B', 15);
	$pdf->Write(10,'Personal Details');

	$Major_ID = $_POST['Major_ID'];
	$con = mysql_connect("127.0.0.1","root",""); //connecting server
	mysql_select_db('jcu_db',$con);  //selecting database
	$data = mysql_query("SELECT * FROM jcu_db.change_majors WHERE Major_ID = $Major_ID ");
	while ($row = mysql_fetch_array($data))
	{
		$pdf->setFont("times","","12");
		
		$pdf->setXY(25, 70);
		$pdf->Cell(90, 10, "Student Number(8 digit number):",0,0,"L",0);
		$pdf->Cell(90, 10,$row['StudentNumber'],0,0,"L",0);
		
		$pdf->setXY(25, 80);
		$pdf->Cell(90, 10, "Title:",0,0,"L",0);
		$pdf->Cell(90, 10,$security->decrypt($row['Title']),0,0,"L",0);
			
		$pdf->setXY(25, 90);
		$pdf->Cell(90, 10, "Nationality:",0,0,"L",0);
		$pdf->Cell(90, 10, $security->decrypt($row['Nationality']),0,0,"L",0);
			
		$pdf->setXY(25, 100);
		$pdf->Cell(90, 10, "Family Name:",0,0,"L",0);
		$pdf->Cell(90, 10, $security->decrypt($row['FamilyName']),0,0,"L",0);
			
		$pdf->setXY(25,110);
		$pdf->Cell(90, 10, "Given Name:",0,0,"L",0);
		$pdf->Cell(90, 10, $security->decrypt($row['GivenName']),0,0,"L",0);
			
		$pdf->setXY(25, 120);
		$pdf->Cell(90, 10, "JCU E-mail Address:",0,0,"L",0);
		$pdf->Cell(90, 10, $security->decrypt($row['JCUEmail']),0,0,"L",0);
		
		$pdf->setXY(25, 130);
		$pdf->Cell(90, 10, "Mobile Phone:",0,0,"L",0);
		$pdf->Cell(90, 10, $security->decrypt($row['MobilePhone']),0,0,"L",0);
			
		$pdf->setXY(25, 140);
		$pdf->Cell(90, 10, "Home Phone Number:",0,0,"L",0);
		$pdf->Cell(90, 10, $security->decrypt($row['HomePhone']),0,0,"L",0);
			
		$pdf->AddPage();

		$pdf->Image( "JCUlogo.jpg", 0, 0, 60 ); //LOGO file , xpos, ypos,width
		$pdf->SetFont( 'Arial', 'B', 20);
		$pdf->Ln( 30 );
		$pdf->Cell( 0, 0, 'Change Of Major Form', 0, 0, 'C' ); //w,h,txt,border,ln,align,fill,link

		$pdf->SetFont( 'Arial', 'B', 15);
		$pdf->Write(10,'Course Information');

		$pdf->setFont("times","","12");
		
		$pdf->setXY(10,70);
		$pdf->Write(10,'Current Course & Major');
		
		$pdf->setXY(25, 80);
		$pdf->Cell(90, 10, "Course Code:",0,0,"L",0);
		$pdf->Cell(90, 10,$security->decrypt($row['Course']),0,0,"L",0);
		
		$pdf->setXY (25,90);
		$pdf->Cell(90,10,"Course Title:",0,0,"L",0);
		$pdf->Cell(90,10,$security->decrypt($row['Course']),0,0,"L",0);
		
		$pdf->setXY (25,100);
		$pdf->Cell(90,10,"Major:",0,0,"L",0);
		$pdf->Cell(90,10,$security->decrypt($row['Major']),0,0,"L",0);
		
		$pdf->setXY (25,110);
		$pdf->Cell(90,10,"Have you been granted any Advanced Standing?:",0,0,"L",0);
		$pdf->Cell(90,10,$security->decrypt($row['AdvStanding']),0,0,"L",0);
		
		$pdf->Write(10,'Proposed Change of Major');
		
		$pdf->setXY (25,130);
		$pdf->Cell(90,10,"Course Title:",0,0,"L",0);
		$pdf->Cell(90,10,$security->decrypt($row['NewCourse']),0,0,"L",0);
		
		$pdf->setXY (25,140);
		$pdf->Cell(90,10,"Major:",0,0,"L",0);
		$pdf->Cell(90,10,$security->decrypt($row['NewMajor']),0,0,"L",0);
		
		$pdf->setXY (25,150);
		$pdf->Cell(90,10,"Study Period(SP):",0,0,"L",0);
		$pdf->Cell(90,10,$security->decrypt($row['StudyPeriod']),0,0,"L",0);
		
		$pdf->setXY (25,160);
		$pdf->Cell(90,10,"Year:",0,0,"L",0);
		$pdf->Cell(90,10,$security->decrypt($row['Year']),0,0,"L",0);
	}
	$pdf->Output( "Change Of Major Form.pdf", "D" );
}
/*.......pdf format of Course Transfer Application.......*/
elseif (isset($_POST['download_coursetransfer']))
{
	$pdf = new FPDF( 'P', 'mm', 'A4' );
	$pdf->AddPage();

	$pdf->Image( "JCUlogo.jpg", 0, 0, 60 ); //LOGO file , xpos, ypos,width
	$pdf->SetFont( 'Arial', 'B', 20);
	$pdf->Ln( 30 );
	$pdf->Cell( 0, 0, 'Course Transfer Application', 0, 0, 'C' ); //w,h,txt,border,ln,align,fill,link

	$pdf->SetFont( 'Arial', 'B', 15);
	$pdf->Write(10,'Personal Details');

	$Application_ID = $_POST['Application_ID'];
	$con = mysql_connect("127.0.0.1","root",""); //connecting server
	mysql_select_db('jcu_db',$con);  //selecting database
	$data = mysql_query("SELECT * FROM jcu_db.course_transfer_application WHERE Application_ID = $Application_ID ");
	while ($row = mysql_fetch_array($data))
	{
		$pdf->setFont("times","","12");
		
		$pdf->setXY(25, 70);
		$pdf->Cell(90, 10, "Student Number(8 digit number):",0,0,"L",0);
		$pdf->Cell(90, 10,$row['StudentNumber'],0,0,"L",0);
		
		$pdf->setXY(25, 80);
		$pdf->Cell(90, 10, "Title:",0,0,"L",0);
		$pdf->Cell(90, 10,$security->decrypt($row['Title']),0,0,"L",0);
			
		$pdf->setXY(25, 90);
		$pdf->Cell(90, 10, "Nationality:",0,0,"L",0);
		$pdf->Cell(90, 10, $security->decrypt($row['Nationality']),0,0,"L",0);
			
		$pdf->setXY(25, 100);
		$pdf->Cell(90, 10, "Family Name:",0,0,"L",0);
		$pdf->Cell(90, 10, $security->decrypt($row['FamilyName']),0,0,"L",0);
			
		$pdf->setXY(25,110);
		$pdf->Cell(90, 10, "Given Name:",0,0,"L",0);
		$pdf->Cell(90, 10, $security->decrypt($row['GivenName']),0,0,"L",0);
			
		$pdf->setXY(25, 120);
		$pdf->Cell(90, 10, "JCU E-mail Address:",0,0,"L",0);
		$pdf->Cell(90, 10, $security->decrypt($row['JCUEmail']),0,0,"L",0);
		
		$pdf->setXY(25, 130);
		$pdf->Cell(90, 10, "Mobile Phone:",0,0,"L",0);
		$pdf->Cell(90, 10, $security->decrypt($row['MobilePhone']),0,0,"L",0);
			
		$pdf->setXY(25, 140);
		$pdf->Cell(90, 10, "Home Phone Number:",0,0,"L",0);
		$pdf->Cell(90, 10, $security->decrypt($row['HomePhone']),0,0,"L",0);
			
		$pdf->AddPage();

		$pdf->Image( "JCUlogo.jpg", 0, 0, 60 ); //LOGO file , xpos, ypos,width
		$pdf->SetFont( 'Arial', 'B', 20);
		$pdf->Ln( 30 );
		$pdf->Cell( 0, 0, 'Course Transfer Application', 0, 0, 'C' ); //w,h,txt,border,ln,align,fill,link

		$pdf->SetFont( 'Arial', 'B', 15);
		$pdf->Write(10,'Course Information');

		$pdf->setFont("times","","12");
		
		$pdf->setXY(10,70);
		$pdf->Write(10,'Current Course');
		
		$pdf->setXY(25, 80);
		$pdf->Cell(90, 10, "Course Code:",0,0,"L",0);
		$pdf->Cell(90, 10,$security->decrypt($row['CurrentCourseCode']),0,0,"L",0);
		
		$pdf->setXY (25,90);
		$pdf->Cell(90,10,"Course Title:",0,0,"L",0);
		$pdf->Cell(90,10,$security->decrypt($row['CurrentCourseTitle']),0,0,"L",0);
		
		$pdf->setXY (25,100);
		$pdf->Cell(90,10,"Major:",0,0,"L",0);
		$pdf->Cell(90,10,$security->decrypt($row['CurrentMajor']),0,0,"L",0);
		
		$pdf->setXY (25,110);
		$pdf->Cell(90,10,"Are you required to show cause for this course?:",0,0,"L",0);
		$pdf->Cell(90,10,$security->decrypt($row['ShowCase']),0,0,"L",0);
		
		$pdf->setXY (25,120);
		$pdf->Cell(90,10,"Statement of Reason:",0,0,"L",0);
		$pdf->Cell(90,10,$security->decrypt($row['Reason']),0,0,"L",0);
		
		$pdf->Write(10,'Proposed Course');
		
		$pdf->setXY (25,140);
		$pdf->Cell(90,10,"Course Code:",0,0,"L",0);
		$pdf->Cell(90,10,$security->decrypt($row['ProposedCourseCode']),0,0,"L",0);
		
		$pdf->setXY (25,150);
		$pdf->Cell(90,10,"Course Title:",0,0,"L",0);
		$pdf->Cell(90,10,$security->decrypt($row['ProposedCourseTitle']),0,0,"L",0);
		
		$pdf->setXY (25,160);
		$pdf->Cell(90,10,"Major:",0,0,"L",0);
		$pdf->Cell(90,10,$security->decrypt($row['ProposedMajor']),0,0,"L",0);
		
		$pdf->setXY (25,170);
		$pdf->Cell(90,10,"Study Period(SP):",0,0,"L",0);
		$pdf->Cell(90,10,$security->decrypt($row['StudyPeriod']),0,0,"L",0);
		
		$pdf->setXY (25,180);
		$pdf->Cell(90,10,"Year:",0,0,"L",0);
		$pdf->Cell(90,10,$security->decrypt($row['Year']),0,0,"L",0);
		
		$pdf->setXY (25,190);
		$pdf->Cell(90,10,"Study Mode:",0,0,"L",0);
		$pdf->Cell(90,10,$security->decrypt($row['StudyMode']),0,0,"L",0);
		
	}
	$pdf->Output( "Course Transfer Application Form.pdf", "D" );
}
?>