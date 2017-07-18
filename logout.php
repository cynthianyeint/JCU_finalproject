<?php
session_start();
if(isset($_SESSION['username']))
{    
    session_unset($_SESSION['username']);
	// remove all session variables


// destroy the session 
session_destroy(); 
}

header("location:login.php");

?>

