<?php
  include('config.php');
  session_start();
  $user = $_SESSION['username'];
  $link = $_POST['url'];
  if (isset($link)){
  	$data = file_get_contents($file_path.'/videos'.$user.'.txt');
    $split_data = explode("\n", $data);
    for($i=0; $i<sizeof($split_data); $i++){
      $curr = explode(" ", $split_data[$i]);
      if($curr[0] == $link){
        $data = str_replace($split_data[$i]."\n", '', $data);
        file_put_contents($file_path.'/videos'.$user.'.txt', $data);
        print "deleted";
        exit;
      }
    }
  }
  
 ?>
