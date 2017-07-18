<?php 
if (!isset($_SESSION))
		{ session_start();}
require ("classes/dbConfig.php");

class DBquery
{ 
	function executeQuery($query)
	{
		if($result = $GLOBALS['db']->query($query))
		{
			return $result;
		}
		return false;
	}
}

class OTP extends Login //Generating OTP & sending Email
{
	public function OTP_generator() //generating random OTP 6-digit
	{
		$OTP= mt_rand(000000,999999);
		return $OTP;
	}
	public function mail_OTP($UserName,$Password,$mail,$OTP) //sending OTP code to email
	{
		
		//mail ($mail,'Your OTP Code',$OTP,'From:dns.ict2project@gmail.com');
		$data = $this->getStudentEmail($UserName,$Password);
		$fetch_data = $data->fetch_object();
		$FName = $fetch_data->FirstName;
				
		$message = "Dear ". $FName ."\n\n\t Are you logging into the JCU Student E-service Website? Here is the OTP code you'll need to complete the process:.\n\t" ;
		$message .= $OTP;
		$message .= "\n\n\t Please do not reply to this email as it is auto-generated.\n\nJCU Student E-service Website Support Team";
		//echo $message;
		mail ($mail,'Your OTP Code',$message,'From:dns.ict2project@gmail.com');
		
	}
}

class Login extends DBquery 
{
	public function loginUser($UserName, $Password)
	{
		$query = "SELECT * FROM jcu_db.students WHERE UserName = '$UserName' AND Password ='$Password'";
		if($this->executeQuery($query)->num_rows != 0)
		{			
			$this->executeQuery($query)->close();
			return true;
		}
		return false;
	}
	public function loginAdmin($UserName,$Password)
	{
		$query = "SELECT * FROM jcu_db.admin WHERE UserName = '$UserName' AND Password ='$Password'";
		if ($this->executeQuery($query)->num_rows !=0)
		{
			$this->executeQuery($query)->close();
			return true;
		}
		return false;
	}
	public function getStudentEmail ($UserName, $Password)//get student email to send OTP
	{
		$query = "SELECT * FROM jcu_db.students WHERE UserName = '$UserName' AND Password ='$Password'";
		if ($result = $this->executeQuery($query))
		{
			return $result;
		}
	}
}

class Check extends DBquery 
{
	public function checkStudentNumber ($StudentNumber) //Checking student number
	{
		$query = "SELECT * FROM jcu_db.students WHERE StudentNumber = '$StudentNumber'";
		if ($this->executeQuery($query)->num_rows!=0)
		{
			$this->executeQuery($query)->close();
			return true;
		}
		return false;
	}
/*	public function getNameEmail($UserName) //checking username
	{
		$query = "SELECT * FROM jcu_db.students WHERE UserName = '$UserName'";
		if ($result = $this->executeQuery($query))
		{
			return $result;
		}
	}*/
}
class getByID extends DBquery // getting forms data by ID
{
	public function getCancelStudentPassFormData ($Cancel_ID)
	{
		$query = "SELECT * FROM cancel_studentpass WHERE Cancel_ID = '$Cancel_ID'";
		if ($result = $this->executeQuery($query))
		{
			return $result;
		}
	}
	public function getDeferExamFormData($Defer_ID)
	{
		$query = "SELECT * FROM jcu_db.defer_exam WHERE Defer_ID = '$Defer_ID'";
		if ($result = $this->executeQuery($query))
		{
			return $result;
		}
	}
}

class SelectByStuNum extends DBquery // get forms data by student number & sort by Date/Time Descending order (for student profile page)
{
	public function getEnrollmentFormData ($StudentNumber)
	{
		$query = "SELECT * FROM jcu_db.enrolments WHERE StudentNumber = '$StudentNumber' ORDER BY DateTime DESC";
		if ($result = $this->executeQuery($query))
		{
			return $result;
			//echo "hi";
		}
	}
	public function getStudentFinancesFormData($StudentNumber)
	{
		$query = "SELECT * FROM jcu_db.student_finances WHERE StudentNumber = '$StudentNumber' ORDER BY DateTime DESC";
		if ($result = $this->executeQuery($query))
		{
			return $result;
		}
	}
	public function getCancelStudentPassFormData($StudentNumber)
	{
		$query = "SELECT * FROM jcu_db.cancel_studentpass WHERE StudentNumber = '$StudentNumber' ORDER BY DateTime DESC";
		if ($result = $this->executeQuery($query))
		{
			return $result;
		}
	}
	public function getDeferExamFormData($StudentNumber)
	{
		$query = "SELECT * FROM jcu_db.defer_exam WHERE StudentNumber = '$StudentNumber' ORDER BY DateTime DESC";
		if ($result = $this->executeQuery($query))
		{
			return $result;
		}
	}
	public function getChangeMajorFormData($StudentNumber)
	{
		$query = "SELECT * FROM jcu_db.change_majors WHERE StudentNumber = '$StudentNumber' ORDER BY DateTime DESC";
		if ($result = $this->executeQuery($query))
		{
			return $result;
		}
	}
	public function getStudentParticularsFormData($StudentNumber)
	{
		$query = "SELECT * FROM jcu_db.student_particulars WHERE StudentNumber = '$StudentNumber' ORDER BY DateTime DESC";
		if ($result = $this->executeQuery($query))
		{
			return $result;
		}
	}
	public function getCourseTransferApplicationFromData($StudentNumber)
	{
		$query = "SELECT * FROM jcu_db.course_transfer_application WHERE StudentNumber = '$StudentNumber' ORDER BY DateTime DESC";
		if ($result =$this->executeQuery($query))
		{
			return $result;
		}
	}
	public function getEnquiryFormData($StudentNumber)
	{
		$query = "SELECT * FROM jcu_db.enquiry WHERE StudentNumber = '$StudentNumber' ORDER BY DateTime DESC";
		if ($result = $this->executeQuery($query))
		{
			return $result;
		}
	}
}

class Select extends DBquery // get forms data & sort by Date/Time Descending order (for admin page)
{
	public function getEnrollmentFormData ()
	{
		$query = "SELECT * FROM jcu_db.enrolments ORDER BY DateTime DESC";
		if ($result = $this->executeQuery($query))
		{
			return $result;
			//echo "hi";
		}
	}
	public function getStudentFinancesFormData()
	{
		$query = "SELECT * FROM jcu_db.student_finances ORDER BY DateTime DESC";
		if ($result = $this->executeQuery($query))
		{
			return $result;
		}
	}
	public function getCancelStudentPassFormData()
	{
		$query = "SELECT * FROM jcu_db.cancel_studentpass ORDER BY DateTime DESC";
		if ($result = $this->executeQuery($query))
		{
			return $result;
		}
	}
	public function getDeferExamFormData()
	{
		$query = "SELECT * FROM jcu_db.defer_exam ORDER BY DateTime DESC";
		if ($result = $this->executeQuery($query))
		{
			return $result;
		}
	}
	public function getChangeMajorFormData()
	{
		$query = "SELECT * FROM jcu_db.change_majors ORDER BY DateTime DESC";
		if ($result = $this->executeQuery($query))
		{
			return $result;
		}
	}
	public function getStudentParticularsFormData()
	{
		$query = "SELECT * FROM jcu_db.student_particulars ORDER BY DateTime DESC";
		if ($result = $this->executeQuery($query))
		{
			return $result;
		}
	}
	public function getCourseTransferApplicationFromData()
	{
		$query = "SELECT * FROM jcu_db.course_transfer_application ORDER BY DateTime DESC";
		if ($result =$this->executeQuery($query))
		{
			return $result;
		}
	}
	public function getEnquiryFormData()
	{
		$query = "SELECT * FROM jcu_db.enquiry ORDER BY DateTime DESC";
		if ($result = $this->executeQuery($query))
		{
			return $result;
		}
	}
}
class Insert extends DBquery
{
	public function insertEnrolmentData ($DateTime,$StudentNumber,$Title,$Nationality,$FamilyName,$GivenName,$JCUEmail,$MobilePhone,$HomePhone,
										$Course,$Major,$AdvStanding,$TrimesterLeave,$StudyMode,$StudyPeriod,$Year,
										$SubEnrol1,$SubWithdraw1,$Sub1AttendanceMode,$SubEnrol2,$SubWithdraw2,$Sub2AttendanceMode,
										$SubEnrol3,$SubWithdraw3,$Sub3AttendanceMode,$SubEnrol4,$SubWithdraw4,
										$Sub4AttendanceMode,$SubEnrol5,$SubWithdraw5,$Sub5AttendanceMode)
	{
		$query = "INSERT INTO jcu_db.enrolments
				(DateTime,StudentNumber,Title,Nationality,FamilyName,GivenName,JCUEmail,MobilePhone,HomePhone,Course,Major,AdvStanding,
				TrimesterLeave,StudyMode,StudyPeriod,Year,SubEnrol1,SubWithdraw1,Sub1AttendanceMode,
				SubEnrol2,SubWithdraw2,Sub2AttendanceMode,SubEnrol3,SubWithdraw3,Sub3AttendanceMode,
				SubEnrol4,SubWithdraw4,Sub4AttendanceMode,SubEnrol5,SubWithdraw5,Sub5AttendanceMode)
				
			VALUES (CURRENT_TIMESTAMP,'$StudentNumber','$Title','$Nationality','$FamilyName','$GivenName','$JCUEmail','$MobilePhone','$HomePhone',
				'$Course','$Major','$AdvStanding','$TrimesterLeave','$StudyMode','$StudyPeriod','$Year',
				'$SubEnrol1','$SubWithdraw1','$Sub1AttendanceMode','$SubEnrol2','$SubWithdraw2','$Sub2AttendanceMode',
				'$SubEnrol3','$SubWithdraw3','$Sub3AttendanceMode','$SubEnrol4','$SubWithdraw4',
				'$Sub4AttendanceMode','$SubEnrol5','$SubWithdraw5','$Sub5AttendanceMode')";
		if ($this->executeQuery($query))
		{
			return true;
		}
		return false;
	}
	public function insertStudentFinancesFormData($DateTime,$StudentNumber,$FinNumber,$Title,$FamilyName,$GivenName,$JCUEmail,
												$MobilePhone,$HomePhone,$Passport,$Course,$StudyMode,$RequestType,
												$PeriodExtension,$ExtensionReason,$WaivingLateReason,$RefundReason,$OthersReason)
	{
		$query = "INSERT INTO student_finances(DateTime,StudentNumber,FinNumber,Title,FamilyName,GivenName,JCUEmail,MobilePhone,HomePhone,
											Passport,Course,StudyMode,RequestType,PeriodExtension,ExtensionReason,
											WaivingLateReason,RefundReason,OthersReason)
				VALUES(CURRENT_TIMESTAMP,'$StudentNumber','$FinNumber','$Title','$FamilyName','$GivenName','$JCUEmail',
						'$MobilePhone','$HomePhone','$Passport','$Course','$StudyMode','$RequestType',
						'$PeriodExtension','$ExtensionReason','$WaivingLateReason','$RefundReason','$OthersReason')";
		if ($this->executeQuery($query))
		{
			return true;
		}
		return false;
	}
	public function insertCancelStudentPassFromData($DateTime,$StudentNumber,$FinNumber,$Title,$Nationality,$FamilyName,$GivenName,$JCUEmail,
												$MobilePhone,$HomePhone,$Course,$PassExpiryDate,$Reason,$LeaveDate,$FileName,$FileType,$FileSize,$FileData)
	{
		$query = "INSERT INTO jcu_db.cancel_studentpass(DateTime,StudentNumber,FinNumber,Title,Nationality,FamilyName,GivenName,JCUEmail,MobilePhone,
												HomePhone,Course,PassExpiryDate,Reason,LeaveDate,FileName,FileType,FileSize,FileData)
				VALUES(CURRENT_TIMESTAMP,'$StudentNumber','$FinNumber','$Title','$Nationality','$FamilyName','$GivenName','$JCUEmail',
						'$MobilePhone','$HomePhone','$Course','$PassExpiryDate','$Reason','$LeaveDate','$FileName','$FileType','$FileSize','$FileData')";
		if ($this->executeQuery($query))
		{
			return true;
		}
		return false;
	}
	public function insertDeferExamFormData($DateTime,$StudentNumber,$Title,$FamilyName,$GivenName,$JCUEmail,$Email,$MobilePhone,$HomePhone,
										$Course,$StudyMode,$DefermentType,$StudyPeriod,$Year,$Subject1,$ExamDate1,$Lecturer1,
										$Subject2,$ExamDate2,$Lecturer2,$Subject3,$ExamDate3,$Lecturer3,$FileName,$FileType,$FileSize,$FileData)
	{
		$query = "INSERT INTO jcu_db.defer_exam (DateTime,StudentNumber,Title,FamilyName,GivenName,JCUEmail,Email,MobilePhone,HomePhone,Course,
										StudyMode,DefermentType,StudyPeriod,Year,Subject1,ExamDate1,Lecturer1,
										Subject2,ExamDate2,Lecturer2,Subject3,ExamDate3,Lecturer3,FileName,FileType,FileSize,FileData)
				VALUES(CURRENT_TIMESTAMP,'$StudentNumber','$Title','$FamilyName','$GivenName','$JCUEmail','$Email','$MobilePhone','$HomePhone',
					'$Course','$StudyMode','$DefermentType','$StudyPeriod','$Year','$Subject1','$ExamDate1','$Lecturer1',
					'$Subject2','$ExamDate2','$Lecturer2','$Subject3','$ExamDate3','$Lecturer3','$FileName','$FileType','$FileSize','$FileData')";
		if ($this->executeQuery($query))
		{
			return true;
		}
		return false;
	}
	public function insertStudentParticularsFormData($DateTime,$StudentNumber,$FinNumber,$StudentPassIssueDate,$Title,$FamilyName,$GivenName,
												$Email,$Course,$StudyMode,$Address,$PostalCode,$MobilePhone,
												$EmergencyContact,$Relationship,$ContactAddress,$ContactPostalCode,$ContactPhone,
												$NewTitle,$NewFamilyName,$NewGivenName)
	{
		$query = "INSERT INTO jcu_db.student_particulars(DateTime,StudentNumber,FinNumber,StudentPassIssueDate,Title,FamilyName,GivenName,Email,
												Course,StudyMode,Address,PostalCode,MobilePhone,EmergencyContact,
												Relationship,ContactAddress,ContactPostalCode,ContactPhone,
												NewTitle,NewFamilyName,NewGivenName)
				VALUES(CURRENT_TIMESTAMP,'$StudentNumber','$FinNumber','$StudentPassIssueDate','$Title','$FamilyName','$GivenName',
						'$Email','$Course','$StudyMode','$Address','$PostalCode','$MobilePhone',
						'$EmergencyContact','$Relationship','$ContactAddress','$ContactPostalCode','$ContactPhone',
						'$NewTitle','$NewFamilyName','$NewGivenName')";
		if ($this->executeQuery($query))
		{
			return true;
		}
		return false;
	}
	public function insertChangeMajorFormData($DateTime,$StudentNumber,$Title,$Nationality,$FamilyName,$GivenName,$JCUEmail,
											$MobilePhone,$HomePhone,$Course,$Major,$AdvStanding,$NewCourse,$NewMajor,
											$StudyPeriod,$Year)
	{
		$query = "INSERT INTO jcu_db.change_majors(DateTime,StudentNumber,Title,Nationality,FamilyName,GivenName,JCUEmail,MobilePhone,HomePhone,
												Course,Major,AdvStanding,NewCourse,NewMajor,StudyPeriod,Year)
				VALUES (CURRENT_TIMESTAMP,'$StudentNumber','$Title','$Nationality','$FamilyName','$GivenName','$JCUEmail','$MobilePhone','$HomePhone',
						'$Course','$Major','$AdvStanding','$NewCourse','$NewMajor','$StudyPeriod','$Year')";
		if ($this->executeQuery($query))
		{
			return true;
		}
		return false;
	}
	public function insertCourseTransferFormData($DateTime,$StudentNumber,$Title,$Nationality,$FamilyName,$GivenName,$JCUEmail,$MobilePhone,$HomePhone,
												$CurrentCourseCode,$CurrentCourseTitle,$CurrentMajor,$ShowCase,$Reason,$ProposedCourseCode,
												$ProposedCourseTitle,$ProposedMajor,$StudyPeriod,$Year,$StudyMode)
	{
		$query ="INSERT INTO jcu_db.course_transfer_application(DateTime,StudentNumber,Title,Nationality,FamilyName,GivenName,JCUEmail,MobilePhone,HomePhone,
															CurrentCourseCode,CurrentCourseTitle,CurrentMajor,ShowCase,Reason,ProposedCourseCode,
															ProposedCourseTitle,ProposedMajor,StudyPeriod,Year,StudyMode)
				VALUES(CURRENT_TIMESTAMP,'$StudentNumber','$Title','$Nationality','$FamilyName','$GivenName','$JCUEmail','$MobilePhone','$HomePhone',
												'$CurrentCourseCode','$CurrentCourseTitle','$CurrentMajor','$ShowCase','$Reason','$ProposedCourseCode',
												'$ProposedCourseTitle','$ProposedMajor','$StudyPeriod','$Year','$StudyMode')";
		if ($this->executeQuery($query))
		{
			return true;
		}
		return false;
	}
	public function insertEnquiryFormData($DateTime,$EnquirySubject,$EnquiryIssues,$EnquiryMessage,$StudentNumber,$JCUEmail)
	{
		$query = "INSERT INTO jcu_db.enquiry(DateTime,EnquirySubject,EnquiryIssues,EnquiryMessage,StudentNumber,JCUEmail)
				VALUES(CURRENT_TIMESTAMP,'$EnquirySubject','$EnquiryIssues','$EnquiryMessage','$StudentNumber','$JCUEmail')";
		if ($this->executeQuery($query))
		{
			return true;
		}
		return false;
	}
}

class Security
{
	public function encrypt ($data)
	{
		$key = 'D&Secdc';
		$encrypted_data = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $data, MCRYPT_MODE_CBC, md5(md5($key))));
		return $encrypted_data;
	}
	public function decrypt($data)
	{
		$key = 'D&Secdc';
		$decrypted_data = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($data), MCRYPT_MODE_CBC, md5(md5($key))));
		return $decrypted_data;
	}
	
}
											
?>