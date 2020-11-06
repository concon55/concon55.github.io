<?php
	include('config.php');
	session_start();
  	$user = $_SESSION['username'];
	$data = file_get_contents($file_path.'/videos'.$user.'.txt');
	$link = $_POST['link'];
	$checked = $_POST['checked'];
	
	$split_data = explode("\n", $data);
	$string_data;

	if(sizeof($checked) >0){
		for($i=0; $i<sizeof($split_data); $i++){
			$curr = explode(" ", $split_data[$i]);
			//if match, write dates to that video
			if($curr[0] == $link){
				foreach($checked as $day){
					$string_data.= $day." "; 
				}
				$string_data = $link. " ". $string_data."\n";
				$data = str_replace($split_data[$i]."\n", $string_data, $data);
				file_put_contents($file_path.'/videos'.$user.'.txt', $data);
				header("Location: collection.php?status=success");
				exit;
			}
		}
 	}else{ //if no checkboxes, then erase dates
 		for($i=0; $i<sizeof($split_data); $i++){
			$curr = explode(" ", $split_data[$i]);
			if($curr[0] == $link){
				$data = str_replace($split_data[$i]."\n", $link."\n", $data);
				file_put_contents($file_path.'/videos'.$user.'.txt', $data);
				header("Location: collection.php?status=erase");
				exit;
			}
		}
 	}

?>