<?php
	include_once('../includes/session.php');
	include_once('../includes/redirect.php');

	$_SESSION['fullname'] = null;
	$_SESSION['email'] = null;
	$_SESSION['password'] = null;
	$_SESSION['usertype'] = null;

	session_destroy();
	RedirectTo('index.php');
	


?>