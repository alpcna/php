<?php
	session_start();
	$_SESSION["girisyapti"] = 0;
	header("Location: giris.php");
	die();
?>