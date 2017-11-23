<?php

function isProtected()
{
	if($_SESSION['user']['logged']!=1){
		header('Location: user_login.php');
		exit;
	}
}


?>


