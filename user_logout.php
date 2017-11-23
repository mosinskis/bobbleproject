<?php

	include("connect-db.php");
	session_start();
	unset( $_SESSION );
	session_destroy();
	header('Location: user_login.php');
	exit;

?>