<?php
require ("classes/dbClasses.php");

if (isset($_POST['enroll']))
{
	/*$Fname = $_POST['fname'];	
	$key = 'D&Secdc';
	$enc_Fname = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $Fname, MCRYPT_MODE_CBC, md5(md5($key))));
	
	echo "User Entered: ". $Fname ."<br>";
	echo "Encrypted: ". $enc_Fname;
	
	
	$con = mysql_connect("127.0.0.1","root","");
	mysql_select_db('jcu_db',$con);
	$sql = "INSERT INTO test(FamilyName,GivenName)
			VALUES('$enc_Fname','test')";
		if (!mysql_query($sql,$con))
			{
				die('Error: ' . mysql_error($con));
			}
	
		mysql_close($con);*/
		$Fname = $_POST['fname'];	
		//$key = 'D&Secdc';
		//$enc_Fname = base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, md5($key), $Fname, MCRYPT_MODE_CBC, md5(md5($key))));
		$security = new Security();
		$enc_Fname = $security->encrypt($Fname);
		
		$insertObj = new Insert();
		$insertObj->insertTest($enc_Fname);
		header ("location:test2.php?status=submitted");

}

?>