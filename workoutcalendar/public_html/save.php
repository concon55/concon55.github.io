<?php
  include('config.php');
  session_start();


  $link = $_POST['link'];
  $user = $_SESSION['username'];
  
  if (isset($link)){
  	//check if duplicate
  	$data = file_get_contents($file_path.'/videos'.$user.'.txt');
  	$split_data = explode("\n", $data);
  	for($i=0; $i<sizeof($split_data); $i++){
  		if($split_data[$i] == $link){
  			echo "duplicate";
			exit;
  		}
  	}

    file_put_contents($file_path.'/videos'.$user.'.txt', $link."\n", FILE_APPEND);
    print "success";
  }
  
 ?>
