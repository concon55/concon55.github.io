<!DOCTYPE html>
<html>
<head>
  <title>Workout Calendar</title>
  <link rel="stylesheet" type="text/css" href="styles.css">
  <style>
    #loginerror{
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
    
    <?php //check login status
      if($_GET['login'] == 'fail'){
        print "<div id='loginerror'>Incorrect username and/or password.</div>";
      }
    ?>

  <div class="form">

      <div class="forms">
      <form method="POST" action="login.php" id="loginform">
        <div id="logintitle">Login</div>
        Username: <input type="text" name="username"><br>
        Password: <input type="password" name="password"><br>
        <input class="submitbtn" type="submit">
      </form>
      </div>
      <div class="logsignlink"> <a id=signuplink href="signup.php">Sign Up</a></div>

    </div>
    
</body>
</html>