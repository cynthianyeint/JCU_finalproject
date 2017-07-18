<?php
//Creating connection
$con = mysql_connect("localhost","root",""); 
if (!$con)
  {
  echo "Failed to connect to MySQL: " . mysql_error() . "<br>";
 }
 
 //Creating database
$sql="CREATE DATABASE jcu_db";
if (mysql_query($sql,$con))
  {
  echo "Database created successfully.<br>";
  }
else
  {
  echo "Error creating database: " . mysql_error($con) . "<br>";
  }
  
//selecting database
  $sql = mysql_select_db ('jcu_db');
  
// Creating students table(login)
//darrenchowfei@jcu.edu.au
//zayyartun@jcu.edu.au

$sql="CREATE TABLE students(
StudentNumber INT(10) NOT NULL,
FirstName CHAR(30) NOT NULL,
LastName CHAR(30) NOT NULL,
UserName CHAR (30) NOT NULL,
JCUEmail CHAR (30)CHARACTER SET utf8 NOT NULL,
Password VARCHAR(40) CHARACTER SET utf8 NOT NULL,
PRIMARY KEY (StudentNumber))";
if (mysql_query($sql,$con))
  {
  echo "Students Table created successfully.<br>";
  
  }
else
  {
  echo "Error creating table: " . mysql_error($con) . "<br>";
  }
  
//Inserting dump data into students table
$password = '123';
$password_hash = md5($password);

$sql = "INSERT INTO students (`StudentNumber`,`FirstName`, `LastName`, `UserName`, `JCUEmail`,`Password`) VALUES
('12735860','Nyeint Nyeint Khin', '', 'jc246817', 'nyeintnyeintkhin@my.jcu.edu.au','$password_hash'),
('12735861','Darren', 'Chow Fei', 'jc249346', 'darren@my.jcu.edu.au','$password_hash'),
('12735862','Zay Yar Tun', '', 'jc249157', 'zayyartun@my.jcu.edu.au','$password_hash')";
if (mysql_query($sql,$con))
  {
  echo "Dump data inserted into 'Students' table successfully.<br>";
  }
else
  {
  echo "Inserting Data Error: " . mysql_error($con) . "<br>";

  }
//Creating admin table
$sql = "CREATE TABLE admin (
Admin_ID INT NOT NULL AUTO_INCREMENT,
UserName CHAR (30) NOT NULL,
Email CHAR (30) CHARACTER SET utf8 NOT NULL,
Password VARCHAR(40) CHARACTER SET utf8 NOT NULL,
PRIMARY KEY (Admin_ID))";
if (mysql_query($sql,$con))
  {
  echo "Admin Table created successfully.<br>";
  
  }
else
  {
  echo "Error creating table: " . mysql_error($con) . "<br>";
  }
//Inserting dump data into admin table
$adminpw = 'admin123';
$adminpw_hash = md5($adminpw);
$sql = "INSERT INTO admin(`UserName`, `Email`,`Password`) VALUES
('Student Service','student_service@gmail.com','$adminpw_hash')";
if (mysql_query($sql,$con))
  {
  echo "Dump data inserted into 'Admin' table successfully.<br>";
  }
else
  {
  echo "Inserting Data Error: " . mysql_error($con) . "<br>";

  }
//Creating Enrolment form table

$sql = "CREATE TABLE enrolments(
Enroll_ID INT NOT NULL AUTO_INCREMENT,
DateTime TIMESTAMP,
StudentNumber INT NOT NULL,
Title VARBINARY(50) NOT NULL,
Nationality VARBINARY(50) NOT NULL,
FamilyName VARBINARY(50) NOT NULL,
GivenName VARBINARY(50) NOT NULL,
JCUEmail VARCHAR (50) CHARACTER SET utf8 NOT NULL,
MobilePhone VARBINARY(50) NOT NULL,
HomePhone VARBINARY(50) NOT NULL,
Course VARBINARY(50) NOT NULL,
Major VARBINARY(50) NOT NULL,
AdvStanding VARBINARY(50) NOT NULL,
TrimesterLeave VARBINARY(50) NOT NULL,
StudyMode VARBINARY(50) NOT NULL,
StudyPeriod VARBINARY(50) NOT NULL,
Year VARBINARY(50) NOT NULL,
SubEnrol1 VARBINARY(50) NOT NULL,
SubWithdraw1 VARBINARY(50) NOT NULL,
Sub1AttendanceMode VARBINARY(50) NOT NULL,
SubEnrol2 VARBINARY(50) NOT NULL,
SubWithdraw2 VARBINARY(50) NOT NULL,
Sub2AttendanceMode VARBINARY(50) NOT NULL,
SubEnrol3 VARBINARY(50) NOT NULL,
SubWithdraw3 VARBINARY(50) NOT NULL,
Sub3AttendanceMode VARBINARY(50) NOT NULL,
SubEnrol4 VARBINARY(50) NOT NULL,
SubWithdraw4 VARBINARY(50) NOT NULL,
Sub4AttendanceMode VARBINARY(50) NOT NULL,
SubEnrol5 VARBINARY(50) NOT NULL,
SubWithdraw5 VARBINARY(50) NOT NULL,
Sub5AttendanceMode VARBINARY(50) NOT NULL,
PRIMARY KEY (Enroll_ID),
FOREIGN KEY (StudentNumber) REFERENCES students (StudentNumber)
)";

if (mysql_query($sql,$con))
  {
  echo "Enrolment Table created successfully";
  echo "<br>";
  }
else
  {
  echo "Error creating table: " . mysql_error($con) . "<br>";
  }
  
  //Creating Defer Exam form table

$sql = "CREATE TABLE defer_exam(
Defer_ID INT NOT NULL AUTO_INCREMENT,
DateTime TIMESTAMP,
StudentNumber INT NOT NULL,
Title VARBINARY(50) NOT NULL,
FamilyName VARBINARY(50) NOT NULL,
GivenName VARBINARY(50) NOT NULL,
JCUEmail VARCHAR(50) CHARACTER SET utf8 NOT NULL,
Email CHAR(50) CHARACTER SET utf8 NOT NULL,
MobilePhone VARBINARY(50) NOT NULL,
HomePhone VARBINARY(50) NOT NULL,
Course VARBINARY(50) NOT NULL,
StudyMode VARBINARY(50) NOT NULL,
DefermentType VARBINARY(50) NOT NULL,
StudyPeriod VARBINARY(50) NOT NULL,
Year VARBINARY(50) NOT NULL,
Subject1 VARBINARY(50) NOT NULL,
ExamDate1 DATE NOT NULL,
Lecturer1 VARBINARY(50) NOT NULL,
Subject2 VARBINARY(50) NOT NULL,
ExamDate2 DATE NOT NULL,
Lecturer2 VARBINARY(50) NOT NULL,
Subject3 VARBINARY(50) NOT NULL,
ExamDate3 DATE NOT NULL,
Lecturer3 VARBINARY(50) NOT NULL,
FileName VarChar(255) Not Null Default 'Untitled.txt',
FileType VarChar(50) Not Null Default 'text/plain',
FileSize BigInt Unsigned Not Null Default 0,
FileData MediumBlob Not Null,
PRIMARY KEY (DEFER_ID),
FOREIGN KEY (StudentNumber) REFERENCES students (StudentNumber)
)";

if (mysql_query($sql,$con))
  {
  echo "Defer Exam Table created successfully";
  echo "<br>";
  }
else
  {
  echo "Error creating table: " . mysql_error($con) . "<br>";
  }
  
  //Creating Cancel Student Pass form table

$sql = "CREATE TABLE cancel_studentpass(
Cancel_ID INT NOT NULL AUTO_INCREMENT,
DateTime TIMESTAMP,
StudentNumber INT NOT NULL,
FinNumber VARBINARY(50) NOT NULL,
Title VARBINARY(50) NOT NULL,
Nationality VARBINARY(50) NOT NULL,
FamilyName VARBINARY(50) NOT NULL,
GivenName VARBINARY(50) NOT NULL,
JCUEmail VARCHAR(50) CHARACTER SET utf8 NOT NULL,
MobilePhone VARBINARY(50) NOT NULL,
HomePhone VARBINARY(50) NOT NULL,
Course VARBINARY(50) NOT NULL,
PassExpiryDate DATE NOT NULL,
Reason VARBINARY(50) NOT NULL,
LeaveDate DATE NOT NULL,
FileName VarChar(255) Not Null Default 'Untitled.txt',
FileType VarChar(50) Not Null Default 'text/plain',
FileSize BigInt Unsigned Not Null Default 0,
FileData MediumBlob Not Null,
PRIMARY KEY (Cancel_ID),
FOREIGN KEY (StudentNumber) REFERENCES students (StudentNumber)
)";

if (mysql_query($sql,$con))
  {
  echo "Cancel Student Pass Table created successfully";
  echo "<br>";
  }
else
  {
  echo "Error creating table: " . mysql_error($con) . "<br>";
  }

  //Creating Cancel Student Finances form table

$sql = "CREATE TABLE student_finances(
Finance_ID INT NOT NULL AUTO_INCREMENT,
DateTime TIMESTAMP,
StudentNumber INT NOT NULL,
FinNumber VARBINARY(50) NOT NULL,
Title VARBINARY(50) NOT NULL,
FamilyName VARBINARY(50) NOT NULL,
GivenName VARBINARY(50) NOT NULL,
JCUEmail VARCHAR(50) CHARACTER SET utf8 NOT NULL,
MobilePhone VARBINARY(50) NOT NULL,
HomePhone VARBINARY(50) NOT NULL,
Passport VARBINARY(50) NOT NULL,
Course VARBINARY(50) NOT NULL,
StudyMode VARBINARY(50) NOT NULL,
RequestType VARBINARY(50) NOT NULL,
PeriodExtension VARBINARY(50) NOT NULL,
ExtensionReason VARBINARY(100) NOT NULL,
WaivingLateReason VARBINARY(100) NOT NULL,
RefundReason VARBINARY(100) NOT NULL,
OthersReason VARBINARY(100) NOT NULL,
PRIMARY KEY (Finance_ID),
FOREIGN KEY (StudentNumber) REFERENCES students (StudentNumber)
)";

if (mysql_query($sql,$con))
  {
  echo "Student finances Table created successfully";
  echo "<br>";
  }
else
  {
  echo "Error creating table: " . mysql_error($con);
  echo "<br>";
  }
  
  //Creating Cancel Student Particulars form table

$sql = "CREATE TABLE student_particulars(
Particulars_ID INT NOT NULL AUTO_INCREMENT,
DateTime TIMESTAMP,
StudentNumber INT NOT NULL,
FinNumber VARBINARY(50) NOT NULL,
StudentPassIssueDate DATE NOT NULL,
Title VARBINARY(50) NOT NULL,
FamilyName VARBINARY(50) NOT NULL,
GivenName VARBINARY(50) NOT NULL,
Email CHAR(50) CHARACTER SET utf8 NOT NULL,
Course VARBINARY(50) NOT NULL,
StudyMode VARBINARY(50) NOT NULL,
Address VARBINARY(50) NOT NULL,
PostalCode VARBINARY(50) NOT NULL,
MobilePhone VARBINARY(50) NOT NULL,
EmergencyContact VARBINARY(50) NOT NULL,
Relationship VARBINARY(50) NOT NULL,
ContactAddress VARBINARY(50) NOT NULL,
ContactPostalCode VARBINARY(50) NOT NULL,
ContactPhone VARBINARY(50) NOT NULL,
NewTitle VARBINARY(50) NOT NULL,
NewFamilyName VARBINARY(50) NOT NULL,
NewGivenName VARBINARY(50) NOT NULL,
PRIMARY KEY (Particulars_ID),
FOREIGN KEY (StudentNumber) REFERENCES students (StudentNumber)
)";

if (mysql_query($sql,$con))
  {
  echo "Student particulars table created successfully";
  echo "<br>";
  }
else
  {
  echo "Error creating table: " . mysql_error($con);
  echo "<br>";
  }
  
  //Creating Cancel Change Majors form table
$sql = "CREATE TABLE change_majors(
Major_ID INT NOT NULL AUTO_INCREMENT,
DateTime TIMESTAMP,
StudentNumber INT NOT NULL,
Title VARBINARY(50) NOT NULL,
Nationality VARBINARY(50) NOT NULL,
FamilyName VARBINARY(50) NOT NULL,
GivenName VARBINARY(50) NOT NULL,
JCUEmail VARCHAR(50) CHARACTER SET utf8 NOT NULL,
MobilePhone VARBINARY(50) NOT NULL,
HomePhone VARBINARY(50) NOT NULL,
Course VARBINARY(50) NOT NULL,
Major VARBINARY(50) NOT NULL,
AdvStanding VARBINARY(50) NOT NULL,
NewCourse VARBINARY(50) NOT NULL,
NewMajor VARBINARY(50) NOT NULL,
StudyPeriod VARBINARY(50) NOT NULL,
Year VARBINARY(50) NOT NULL,
PRIMARY KEY (Major_ID),
FOREIGN KEY (StudentNumber) REFERENCES students (StudentNumber)
)";

if (mysql_query($sql,$con))
  {
  echo "Change of majors table created successfully";
  echo "<br>";
  }
else
  {
  echo "Error creating table: " . mysql_error($con);
  echo "<br>";
  }
  //Creating Cancel Course Transfer Applications form table
$sql = "CREATE TABLE course_transfer_application(
Application_ID INT NOT NULL AUTO_INCREMENT,
DateTime TIMESTAMP,
StudentNumber INT NOT NULL,
Title VARBINARY(50) NOT NULL,
Nationality VARBINARY(50) NOT NULL,
FamilyName VARBINARY(50) NOT NULL,
GivenName VARBINARY(50) NOT NULL,
JCUEmail VARCHAR(50) CHARACTER SET utf8 NOT NULL,
MobilePhone VARBINARY(50) NOT NULL,
HomePhone VARBINARY(50) NOT NULL,
CurrentCourseCode VARBINARY(50) NOT NULL,
CurrentCourseTitle VARBINARY(50) NOT NULL,
CurrentMajor VARBINARY(50) NOT NULL,
ShowCase VARBINARY(50) NOT NULL,
Reason VARBINARY(50) NOT NULL,
ProposedCourseCode VARBINARY(50) NOT NULL,
ProposedCourseTitle VARBINARY(50) NOT NULL,
ProposedMajor VARBINARY(50) NOT NULL,
StudyPeriod VARBINARY(50) NOT NULL,
Year VARBINARY(50) NOT NULL,
StudyMode VARBINARY(50) NOT NULL,
PRIMARY KEY (Application_ID),
FOREIGN KEY (StudentNumber) REFERENCES students (StudentNumber)
)";

if (mysql_query($sql,$con))
  {
  echo "Course Transfer Application table created successfully";
  echo "<br>";
  }
else
  {
  echo "Error creating table: " . mysql_error($con);
  echo "<br>";
  }
 //Creating enquiry form table
$sql = "CREATE TABLE enquiry(
Enquiry_ID INT NOT NULL AUTO_INCREMENT,
DateTime TIMESTAMP,
EnquirySubject VARBINARY(50) NOT NULL,
EnquiryIssues VARBINARY(50) NOT NULL,
EnquiryMessage VARBINARY(50) NOT NULL,
StudentNumber INT NOT NULL,
JCUEmail CHAR(30) CHARACTER SET utf8 NOT NULL,
PRIMARY KEY (Enquiry_ID),
FOREIGN KEY (StudentNumber) REFERENCES students (StudentNumber)
)";

if (mysql_query($sql,$con))
  {
  echo "Enquiry table created successfully";
  echo "<br>";
  }
else
  {
  echo "Error creating table: " . mysql_error($con);
  echo "<br>";
  }
  
  
  
  
  

?>