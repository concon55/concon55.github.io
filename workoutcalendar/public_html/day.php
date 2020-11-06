<!DOCTYPE html>
<html>
<head>
	<title>Workout Calendar</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>

	<div class="header">
      <?php 
        $loggedin = false; 
        if(isset($_COOKIE['PHPSESSID'])){
          session_start();
          if(isset($_SESSION['loggedin'])){
            $loggedin = true;
          }
        }

        if($loggedin){ //if logged in
      ?>
      	<a class="logout" href="logout.php">Log Out</a>

      <?php 
          print "<h1>Welcome, ".ucfirst($_SESSION['firstname']) ." ". ucfirst($_SESSION['lastname']). "!</h1>";

      ?>
      <div class="tabs">
	    <a href="index.php" class="tab" class="home">Home</a>
	    <a href="calendar.php" class="tab" class="calendar">Calendar</a>
	  	<a href="collection.php" class="tab" class="collection">Collection</a>
	  </div>
	  <h2 id='todaysworkout'> <?php  
	  	$day = $_GET['id'];
	  	$month_alpha = date('F');
	  	$today = date('j');
	  	if($day == $today){
	  		echo "Today's ";
	  	}else{
	  		echo $month_alpha.' '. $day;
	  	}
	  ?> Workout</h2>
	  <div id='videospage'>
	  <div id="todaysvideos">
	  <?php
	  	include('config.php');
	  	session_start();
	  	$user = $_SESSION['username'];
		$data = file_get_contents($file_path.'/videos'.$user.'.txt');
		$today = $_GET['id'];

		$split_data = explode("\n", $data);

		for($i=0; $i<sizeof($split_data)-1; $i++){
			if(strpos($split_data[$i], " ".$today." ")){
				$curr = explode(" ", $split_data[$i]);
				$link = $curr[0];

		?>
			<div class='vidbg'>
			<iframe class="showvid" allowfullscreen
	          src="<?php echo $link; ?>">
	         </iframe>
	         </div>

		<?php

			}
		}

	  ?>

	  
      </div>

      <div id='quote'>

      </div>
      </div>

	<?php 
        }else{ //if not logged in, go to home page
        	header('Location: index.php');
    	}	
    ?>

    <script>
    	let quote = document.getElementById('quote');
    	let randNum = parseInt(Math.random()*10+1);
    	let img = document.createElement('img');
 		img.id='quoteimg';
    	img.src = 'images/quotes/quote'+randNum+'.jpg';
    	quote.appendChild(img);

    </script>

    
	
</body>
</html>

