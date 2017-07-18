<?php
require ("dbClasses.php");


$con = mysql_connect("127.0.0.1","root","");
	mysql_select_db('jcu_db',$con);
$table = mysql_query ("SELECT * FROM enrolments",$con);
	
	while ($row = mysql_fetch_array($table))
	{ 
		$name = $row['FamilyName'];
		
		echo "From Database  " . $name . "<br><br>";
		
		$key = 'D&Secdc';
		$decrypted = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, md5($key), base64_decode($row['FamilyName']), MCRYPT_MODE_CBC, md5(md5($key))));
		echo "Decrypted: ". $decrypted. "<br><br>";
	}
		mysql_close($con);
?>