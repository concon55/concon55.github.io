<?php
	include('config.php');

	//grab user name and password from POST
	$username = $_POST['username'];
	$password = $_POST['password'];

	//validate data against accounts file
	$data = file_get_contents($file_path.'/accounts.txt');

	//isolate each user record in text file
	$split_data = explode("\n", $data);

	//visit every line
	for($i=0; $i<sizeof($split_data); $i++){
		//extract individual detail
		$curr = explode(",", $split_data[$i]);
		//if match, set cookies and log in
		if($username == $curr[0] && $password == $curr[1]){
			session_start(); 
			session_regenerate_id();
			$_SESSION['loggedin'] = 'yes';
			$_SESSION['firstname'] = $curr[2];
			$_SESSION['lastname'] = trim($curr[3]);
			$_SESSION['username'] = $username;

			header('Location: index.php?login=success');
			exit;
		}
	}

	//send back to index.php
	header('Location: loginpage.php?login=fail');

?>