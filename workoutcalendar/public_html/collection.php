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
      <div id="alreadyadded" class='hidden'>Video is already added.</div>
      <div id="collectionaddlink">
      Paste Youtube link to add video to collection.
      <form id="addLink">
        <input type="text" size="60" id="link">
        <button id="addbtn">Add</button>
      </form>
      </div>
      <div id="description">
      Select the dates that you want to add the video to.
      </div>

    <div id="videos">
      <?php
        // load saved videos
        include('config.php');
        session_start();
        $user = $_SESSION['username'];
        $data = file_get_contents($file_path.'/videos'.$user.'.txt');
        if($data != ''){
          $split_data = explode("\n", $data);
          $month = date('n');
          $year = date('Y');
          $month_alpha = date('F');
          $daysinmonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
          for($i=0; $i<sizeof($split_data)-1; $i++){
            $curr = explode(" ", $split_data[$i]);
            $video = $curr[0];
           
      ?>
          <div class="entry" data-link="<?php echo $video; ?>">
          <iframe class='allvideos'
          src="<?php echo $video; ?>">
          </iframe>
          <form class="selectdates" method="POST" action="adddates.php">
          <div class="monthname"><?php echo $month_alpha; ?></div>
          <input type="hidden" name="link" value= "<?php echo $video; ?>">
      <?php
      $k = 1;
        for($j=1; $j<$daysinmonth+1; $j++){
          $ischeck = $curr[$k];
      ?>

        <label class="daylabel" for="<?php echo $j; ?>"> <?php echo $j;?> </label>
        <?php
          if($j == $ischeck){
            $k++;
        ?>  
          <input class="checkboxes" type="checkbox" id="<?php echo $j; ?>" name="checked[]" value="<?php echo $j; ?>" checked="checked">
        <?php
          }else{
        ?>
        <input class="checkboxes" type="checkbox" id="<?php echo $j; ?>" name="checked[]" value="<?php echo $j; ?>" >
        <?php
          }
        ?>
        
      <?php
        }
      ?>
      <input type="submit" class="btn">
      </form>
      <button class="delete">Delete</button>
      </div>
      <?php
          }
        }
      ?>
      <!-- load new videos -->

    </div>

      <?php
        }else{ //if not logged in, go to home page
          header('Location: index.php');
        }
      ?>

      <script src="js/jquery-3.4.1.min.js"></script>
      <script>

        $(document).ready(function() {

          let allSavedDelete = document.querySelectorAll('.delete');
          for(let i =0; i<allSavedDelete.length; i++){
            allSavedDelete[i].onclick = function(e){
              deleteVideo(e);
            }
          }
          
          let addbtn = document.getElementById('addbtn');
          let alreadyadded = document.getElementById('alreadyadded');

          //save link when add button clicked 
          addbtn.onclick = function(event){
            let link = document.getElementById('link').value;
            link = link.replace("watch?v=", "embed/");
            for(let x=link.length; x>-1; x--){
              if(link[x] == "&"){ //remove parameters 
                link = link.substring(0, x);
                break;
              }
            }

            event.preventDefault();
            if(link.length>0){
              $.ajax({
                type: 'POST',
                url: 'save.php',
                data: {
                  link: link
                },
                success: function(data, status) {
                  if(data!=="duplicate"){
                    console.log(data);
                    createLink(link);
                    alreadyadded.classList.add('hidden');
                  }else{
                    alreadyadded.classList.remove('hidden');
                  }
                },
                error: function(request, data, status) {
                  console.log(data);
                }
              });
              document.getElementById('link').value=""; 
            }
            
          }

          function createNewCheckbox(id, link){
            var container = document.getElementById('form');
            var checkbox = document.createElement('input'); 
            checkbox.classList.add('checkboxes')
            checkbox.type= 'checkbox';
            checkbox.name = 'checked[]';
            checkbox.value = id; 
            return checkbox;
          }

          function createLabel(id){
            var label = document.createElement('label')
            label.htmlFor = id;
            label.classList.add('daylabel');
            label.appendChild(document.createTextNode(id));
            return label;
          }

          function daysInMonth(){
            var now = new Date();
            return new Date(now.getFullYear(), now.getMonth()+1, 0).getDate();
          }

          function deleteVideo(e){
            url = e.currentTarget.parentElement.dataset.link; //get link in this element
              $.ajax({
                type: 'POST',
                url: 'delete.php',
                data: {
                  url: url
                },
                success: function(data, status) {
                  console.log(data);
                  alreadyadded.classList.add('hidden');
                },
                error: function(request, data, status) {
                  console.log(data);
                }
              }); 

              e.currentTarget.parentElement.parentElement.removeChild(e.currentTarget.parentElement);
          }

          function createLink(data){
            let newElement = document.createElement('div'); //create entry
            newElement.dataset.link = data;

            let video = document.createElement('iframe');
            video.classList.add('allvideos');
            video.src = data;
            newElement.appendChild(video);
            let del = document.createElement('button'); //create delete button
            del.innerHTML = "Delete";
            del.classList.add('delete');

            //create checkboxes for days
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = 'adddates.php';
            let form_id = document.createElement('input');
            form_id.type = 'hidden';
            form_id.name = 'link';
            form_id.value = data;
            form.appendChild(form_id);

            form.classList.add('selectdates');
            let daysinmonth = daysInMonth();
            var monthNames = ["January", "February", "March", "April", "May", "June",
              "July", "August", "September", "October", "November", "December"
            ];
            var d = new Date();
            var n = d.getMonth();
            let month = document.createElement('div');
            month.classList.add('monthname');
            month.innerHTML = monthNames[n];
            form.appendChild(month);

            for(let i =1; i<daysinmonth+1; i++){
              form.appendChild(createLabel(i));
              form.appendChild(createNewCheckbox(i, data));
            }

            let submit = document.createElement('input');
            submit.type = 'submit';
            submit.classList.add('btn');
            form.appendChild(submit);
            newElement.appendChild(form);

            newElement.appendChild(del);
            newElement.classList.add('entry');
            document.getElementById('videos').appendChild(newElement);

            del.onclick= function(e){ //when delete button is clicked
              deleteVideo(e);
            }
          }
        });

      </script>
      
</body>
</html>