<!DOCTYPE html>
<html>
<head>
	<title>Workout Calendar</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
  <style>
    #newaccount{
      text-align: center;
    }
  </style>
</head>
<body>
	
	<div class="header">
      <?php //if logged in
      session_start();
        if(isset($_SESSION['firstname']) && isset($_SESSION['lastname'])){
      ?>

      	<a class="logout" href="logout.php">Log Out</a>

      <?php 
          print "<h1>Welcome to your Workout Calendar, ".ucfirst($_SESSION['firstname']) ." ". ucfirst($_SESSION['lastname']). "!</h1>";
      ?>
        <div class="tabs">
        <a href="index.php" class="tab" class="home">Home</a>
        <a href="calendar.php" class="tab" class="calendar">Calendar</a>
        <a href="collection.php" class="tab" class="collection">Collection</a>

      <?php
          print "<p id='newaccount'>Your account has been created.</p>";
        }else{
          header('Location: index.php');
        }
      ?>
  
    </div>

	
    
</body>
</html>