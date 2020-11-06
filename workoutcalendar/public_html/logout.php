<?php
	// start the session
	session_start();

	// delete the session cookie
	setcookie(session_name(), "", time()-3600, "/" );

	//clear session from globals
	session_unset();

	// just to be safe, delete the session superglobal as well
	$_SESSION = array();

	//clear session from server
	session_destroy();

	//back to home page
	header("Location: index.php?confirmation=loggedout");
?>