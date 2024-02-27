<?php 
	
	session_start();
	unset($_SESSION["customerid"]);
	unset($_SESSION["customeremail"]);
	echo "<script>window.location.replace('login.php');</script>";

?>