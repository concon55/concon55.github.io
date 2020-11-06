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

        if($loggedin){
      ?>
      	<a class="logout" href="logout.php">Log Out</a>

      <?php //if logged in
          print "<h1>Welcome, ".ucfirst($_SESSION['firstname']) ." ". ucfirst($_SESSION['lastname']). "!</h1>";

      ?>  
        <div class="tabs">
        <a href="index.php" class="tab" class="home">Home</a>
        <a href="calendar.php" class="tab" class="calendar">Calendar</a>
        <a href="collection.php" class="tab" class="collection">Collection</a>
      </div>
      </div>

      <?php
        }else{ //if not logged in
      ?>
      <a class="login" href="loginpage.php">Login/Sign Up</a>
      <h1>Welcome to your Workout Calendar!</h1>


    </div>

    <div class="tabs">
    <a href="index.php" class="tab" class="home">Home</a>
    <a href="calendar.php" class="tab" class="calendar">Calendar</a>
  </div>

  <?php
        };
      ?>
      
      <img id='homeimage2' src="images/run.jpg">
      <div id='hometext1'>Let's work out!</div>
      <img id='homeimage1' src="images/dumbbells.jpg">
      <div id='hometext2'>Create your workout calendar now!</div>

      <video id='intro' width="300" muted loop autoplay>
      <source src="media/project.mp4" type="video/mp4" width="500">
      Your browser does not support the video tag.
      </video>
    
</body>
</html>