<?php
require ("classes/dbClasses.php");
/*$con = mysql_connect("127.0.0.1","root","");
	mysql_select_db('jcu_db',$con);
$table = mysql_query ("SELECT * FROM test",$con);
	
	while ($row = mysql_fetch_array($table))
	{ 
		$name = $row['FamilyName'];
		
		echo "From Database  " . $name . "<br><br>";
		
		$key = 'D&Secdc';
		$decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($row['FamilyName']), MCRYPT_MODE_CBC, md5(md5($key))));
		echo "Decrypted: ". $decrypted. "<br><br>";
	}
		mysql_close($con);
*/

$infoObj = new Select();
if ($result = $infoObj->getTest())
{
	while ($obj= $result->fetch_object())
	{
		echo "hihi<br><br>";
		//echo $obj->GivenName."<br><br>";
		echo $obj->FamilyName."<br><br>";
		
		
		//$key = 'D&Secdc';
		//$decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($obj->FamilyName), MCRYPT_MODE_CBC, md5(md5($key))));
		
		
		$security = new Security();
		$decrypted = $security->decrypt($obj->FamilyName);
		
		echo "Decrypted: ". $decrypted. "<br><br>";
	}
}
														
?>