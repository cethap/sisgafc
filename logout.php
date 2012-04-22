<?php
	session_start();
	unset($_SESSION['loggedIn']);
	include_once 'loginchecker.php';
?>
