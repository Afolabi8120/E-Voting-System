<?php
	$host = 'localhost';
	$username = 'root';
	$password = '';
	$database = 'evoting_db';

	$conn = mysqli_connect($host, $username, $password, $database);

	if(!$conn){
		die('Failed to connect to Database');
	}


?>