<!DOCTYPE html>
<html>
<head>
	<title>Workout Calendar</title>
	<link rel="stylesheet" type="text/css" href="styles.css">
	<style>
		#signuperror{
			text-align: center;
			color: red;
			position: absolute;
			margin-top: 80px;
			left: 0;
			right: 0;
		}
	</style>
</head>
<body>
	
	<div class="header">
      <h1>Welcome to your Workout Calendar!</h1>
      <div class="tabs">
	    <a href="index.php" class="tab" class="home">Home</a>
	    <a href="calendar.php" class="tab" class="calendar">Calendar</a>
	  </div>
    </div>
    <?php
    	if(isset($_GET['signup'])){
    		print "<div id='signuperror'>Username is already taken.</div>";
    	}
    ?>
	<div class="form">
		<div class="forms">
		<form method="POST" action="createaccount.php" id="signupform">
	      	<div id="signuptitle">Sign Up</div>
	      	First Name: <input type="text" name="firstname" required><br>
	      	Last Name: <input type="text" name="lastname" required><br>
	        Username: <input type="text" name="username" required><br>
	        Password: <input type="password" name="password" required><br>
	        <input class="submitbtn" type="submit">
	    </form>
	    </div>
		<div class="logsignlink"> <a id=loginlink href="loginpage.php">Login</a></div>
    </div>
</body>
</html>