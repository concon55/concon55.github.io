<?php
	include('config.php');

	//grab user info
	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$username = $_POST['username'];
	$password = $_POST['password'];

	//validate data against accounts file
	$data = file_get_contents($file_path.'/accounts.txt');
	$split_data = explode("\n", $data);
	//isolate each user record in text file
	if($split_data != ""){
		
		//visit every line
		for($i=0; $i<sizeof($split_data); $i++){
			//extract individual detail
			$curr = explode(",", $split_data[$i]);
			//if username is already taken, reload with error message
			if($username == $curr[0]){
				header('Location: signup.php?signup=usernameerror');
				exit;
			}
		}
	}	
	
	
	//login
	session_start(); 
	session_regenerate_id();
	$_SESSION['loggedin'] = 'yes';
	$_SESSION['firstname'] = $firstname;
	$_SESSION['lastname'] = $lastname;
	$_SESSION['username'] = $username;
	$newaccount = $username.','.$password.','.$firstname.','.$lastname."\n";
	file_put_contents($file_path.'/accounts.txt', $newaccount, FILE_APPEND);
	//send back to index.php
	header('Location: newuser.php');

?>