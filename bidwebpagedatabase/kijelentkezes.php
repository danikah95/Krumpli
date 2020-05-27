<?php
	include ("alert_insert.php");
	session_start();
	session_unset();
	session_destroy();
	//echo "Sikeres kijelentkezés!";
	//header('Location: index.html');
	fun_alert ("Sikeres kijelentkezés!", "index.php");
?>