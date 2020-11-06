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
      <?php
        // display calendar
		include('config.php');
		$dayofweek_alpha = date('l');
		$dayofweek_num = date('w');
		$today = date('j');
		$month = date('n')+1;
		$firstdayofmonth_num = date('w', strtotime('first day of this month'));
		$month_alpha = date('F');
		$year = date('Y');
		$daysinmonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);

		print "<h2 id='month'>".$month_alpha."</h2>";
		?>

		<div id="calendar">
		<table id="caltable"> 
			  <tr>
			    <th>Monday</th>
			    <th>Tuesday</th>
			    <th>Wednesday</th>
			    <th>Thursday</th>
			    <th>Friday</th>
			    <th>Saturday</th>
			    <th>Sunday</th>
			  </tr>
	          <?php
	          	$i = 1; //once dates begin
	          	$curr = 1; //look for first day 
	          	$count = 1; //7 days a week
	          	while($i < $daysinmonth+1){
	          		if($count%7==0 ){ //new week
	      				print "<tr>";
	      			}
	      			if($curr<$firstdayofmonth_num){
	      				print "<td class='empty'></td>"; //before first day of week
	      				$curr++;
	      			}
	      			if($i == $today){
	      				// print "<td class='day' class='today' data-day='".$i."'>".$i."</td>";
	      				print "<td class='day' ><a id='today' class='daylink' href='day.php?id=".$i."'>".$i."</a></td>";
	      				$i++;
	      			}
	      			else if($curr>=$firstdayofmonth_num){ //print days
	      				print "<td class='day'><a class='daylink' href='day.php?id=".$i."'>".$i."</a></td>";
	      				$i++;
					}
					$count++;
					if($count%7==0){
						print "</tr>";
					}
	          	}
	          ?>
	  	</table>
	  	</div>

	<?php 
        }else{ //if not logged in, go to home page
    ?>

    	<a class="login" href="loginpage.php">Login/Sign Up</a>
      	<h1>Welcome to your Workout Calendar!</h1>
      	<div class="tabs">
		    <a href="index.php" class="tab" class="home">Home</a>
		    <a href="calendar.php" class="tab" class="calendar">Calendar</a>
	  	</div>
      	<p id="calMessage">You need to be logged in to access the calendar.</p>

    <?php
    	}
    ?>

	
</body>
</html>

