<?php
//Creating connection
$con = mysql_connect("localhost","root",""); 
if (!$con)
{
  echo "Failed to connect to MySQL: " . mysql_error() . "<br>";
}
$sql = "DROP DATABASE `jcu_db`";
if (mysql_query($sql,$con))
{
	echo "database drop successfully";
}
else{
echo "Error: " . mysql_error($con) . "<br>";
}
?>