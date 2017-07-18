<?php
@$db = new mysqli("localhost","root","");
if($db->connect_errno){
	die( "Error:: Could not connect to database //dbsetup.php");
}
$db->select_db("jcu_db");
?>
