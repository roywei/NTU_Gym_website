<?php
	// Inialize session
	session_start();
?>
<html>
<head>
<title>Appointment Results for Private Trainer</title>
<meta charset="utf-8">
<link rel="stylesheet" href="csshome.css">
</head>

<div id="wrapper">
<br>
<div id="headerleft">
<?php

	// Check username and password match
	if( isset($_SESSION["userid"]) )
		{		
		// display member name in the header
		
		echo "<span style=\"text-align:right; color:#A4A4A4;\">WELCOME</sapn>&nbsp;&nbsp;<span style=\"text-align:right; color:#6495ED;  font-weight:bold\">".$_SESSION['membername']."</span>&nbsp;&nbsp;&nbsp;<span style=\"text-align:right; color:#A4A4A4;\">｜</span>&nbsp;&nbsp;&nbsp;<a href=\"logout.php\">LOG OUT</a></span>";
		
		}
	else 
		{
	    echo "<span style=\"text-align:right;\"><a href=login_form.php>LOG IN</a>&nbsp;&nbsp;&nbsp;<span style=\"text-align:right; color:#A4A4A4;\">｜</span>&nbsp;&nbsp;&nbsp;<a href=register_form.php>REGISTER</a></span>";
		
		}
?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<!-- Search box //-->
<form id="searchthis" action="search.php" style="display:inline;" method="post">
<input id="namanyay-search-box" name="s" size="40" type="text" placeholder="Enter Courses/Trainer"/>
<input id="namanyay-search-btn" value="Search" type="submit"/>
</form>
</div> 
 </div> 


<body onload="scroller();">
	<!-- navigation bar with logo-->
	<nav id="nav">
	<ul>
		<img src="logo.png" height="60" width="350" id="imageleft" alt="logo">
		<li><a href="index.php">Home</a></li>
		<li><a href="courseinfo.php">Courses</a>
			<ul>
				<li><a href="courseinfo.php">Course Info</a></li>
				<li><a href="courseregister3.php">Course Reigstration</a></li>
			</ul>
		</li>
		<li><a href="trainerinfo.php">Private Trainer</a>
			<ul>
				<li><a href="trainerinfo.php">Trainer Info</a></li>
				<li><a href="appointment3.php">Schedule Appointment</a></li>
			</ul>
		</li>
		<li><a href="member.php">Member</a>
			<ul>
				<li><a href="member.php">View/Edit Personal Information</a></li>
				<li><a href="viewregistration.php">View/Edit Training Schedule</a></li>
			</ul>
		</li>
	</ul>
	</nav>
	
	
<!-- main content-->
<div id="wrapper">
<div id="leftcolumn">
    <nav id="nav2">
    <ul>
      <li><a href="trainerinfo.php">List of Trainers</a></li>
      <li><a href="appointment3.php">Schedule Appointment</a></li>
	</ul>
  </nav>	
    <br>    
  <img src="woman.png" width="200" height="300" align="bottom" alt="woman">
</div>
  
<div id="rightcolumn">
    <img src="SubBanner_Courses.png" width="800" height="287" alt="SubBanner_Courses">
	<div id="content">

<?php
  // create short variable names
  $privateid=$_POST['privateid'];
  $trainhr=$_POST['trainhr'];
  $comments=$_POST['comments'];
  
  //get the registration date and time
	$datetime = $_POST['date'] . ' ' . $_POST['time'];
    $datetime = mysql_real_escape_string($datetime);
    $datetime = strtotime($datetime);
    $datetime = date('Y-m-d H:i:s',$datetime);
    
  if (!isset($_SESSION["userid"])) { 
     echo "<h2 style=\"text-align:center; color:#6495ED;\">Sorry, your registration is NOT successful.</h2>"; 
     echo "<p>If you are member, please log in using your registered Matric No.</p>";
	 echo "<p>If you are not member, welcome to <a href=\"register_form.php\">JOIN US</a>!</p>";
	 echo "<p>Thank you for visiting NTU Fitness Factory! Wish you a nice training journey here!</p>";
	 echo "<script language=javascript>alert('You have not logged in. Please log in first.')</script>"; 
     exit;
  }
  
  if (!$privateid || !$trainhr) {
     echo 'You have not entered any registration details.  Please go back and try again.';
     exit;
  }


  if (!get_magic_quotes_gpc()){
    
    $privateid = addslashes($privateid);
    $trainhr = addslashes($trainhr);
    $comments = addslashes($comments);
    
  }


  @ $db = new mysqli('localhost', 'f33s28', 'weilai729', 'f33s28');


  if (mysqli_connect_errno()) {
     echo 'Error: Could not connect to database.  Please try again later.';
     exit;
  }

  
	$sql = "SELECT * FROM private_trainer where private_trainer_id like '%".$privateid."%'";
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	$name = $row['trainer_name'];
	$available_training_time = $row['available_training_time'];
	$duration = $row['training_duration'];
	$time = $row['available_training_time'];
	$price = $row['price'];
	$vacancy = $row['vacancy'];

	$current_date=date('Y-m-d H:i:s');
	
	$diff = strtotime($time) - strtotime($current_date);
	$retval = bcdiv($diff, (60 * 60)); 
	
	
	//check registered member or not?
	$query = "SELECT * FROM member where matric_number ='".$_SESSION["userid"]."'";
    $result0 = $db->query($query);	
	$row = $result0->fetch_assoc();
	$p_count = $row['p_count'];
	
	//check this user has registered for selected course_id or not
	$query_ = "SELECT * FROM private_coach_appointment where matric_number = '".$_SESSION["userid"]."' AND course_id ='".$privateid."'";
    $result_ = $db->query($query_);
	$isregist = $result_->num_rows;
	
	//check discount, ir register for other course, you will get 20% off discount
	$query_discount = "SELECT * FROM private_coach_appointment where matric_number = '".$_SESSION["userid"]."'";
    $result_discount = $db->query($query_discount);
	$isdiscount = $result_discount->num_rows;
	
	if ($isregist != 0){ 
    echo "<h1 style=\"text-align:left; color:#6495ED;\"><span style=\"color:white; font-weight:normal;\">Dear </span>".$_SESSION["membername"].",</h1>";    
     echo "<h2 style=\"text-align:center; color:#6495ED;\">Sorry, your registration is NOT successful.</h2>"; 
    echo "<p>You have already registered this selected Course ID.</p>";
	echo "<p>You can only register one Course ID for one time. ";
	echo "You could go to <a href=\"viewregistration.php\">View/Edit Personal Training Schedule</a>.</p>";
	echo "<p>Thank you for visiting NTU Fitness Factory! Wish you a nice training journey here!</p>";
	 echo "<script language=javascript>alert('Dear ".$_SESSION["membername"].", you have registered for this course.')</script>"; 
     }
     
	//if existing registered member and has not registered for current course_id
	 if ($isregist == 0) {
	 
	 //check the time, member can only register private course 24 hours before
	 if ($diff > 86400) {
	
	if(($vacancy <= 0)){
	
	    // failed registration   
	   echo "<h1 style=\"text-align:left; color:#6495ED;\"><span style=\"color:white; font-weight:normal;\">Dear </span>".$_SESSION["membername"].",</h1>"; 
	    echo "<h2 style=\"text-align:center; color:#6495ED;\">Sorry, the private trainer time slot has already been registered.</h2>";
		echo "<p>You could go to <a href=\"appointment3.php\">Schedule Appointment</a> to try other available Private Trainer Course ID</p>";
		echo "<p>Or please wait for upcoming schedule for next week.</p>";
	} else if(($vacancy > 0)){
	
	echo "<h1 style=\"text-align:left; color:#6495ED;\"><span style=\"color:white; font-weight:normal;\">Dear </span>".$_SESSION["membername"].",</h1>";
	     
	      // Calculate the final price
	     if ($isdiscount==0){
		$total = $price * $trainhr ;
		echo "<h2 style=\"text-align:center; color:#6495ED;\">Congratulations, your registration is successful!</h2>"; 
		echo "<p style=\"text-align:center; color:#6495ED;\">You have received our 20% off vouncher, which will be used on your next registration!</p>";

		} else {
		$total = $price * $trainhr * 0.8 ; //discount
		echo "<h2 style=\"text-align:center; color:#6495ED;\">Congratulations, you have received our 20% off DISCOUNT!</h2>";
		echo "<p>*Price shown below is after discount*.</p>";
		}
		echo '<p>Registration processed at '.date('H:i, jS F Y')."</p>";
		
		
	    // successful order   
	    // print the details
	    
	    echo "<table bordercolor=\"#6495ED\" align=\"center\"> ";
	    echo "<caption><font color=white>Details for Registed Private Course:</font></caption> ";  
	    echo "<tr>";
		echo " <td style=\"text-align:left; color:#6495ED; font-weight:bold;\">Private Trainer ID</td>";
		echo " <td>".$privateid."</td>";
        echo "</tr>";
        
        echo "<tr>";
		echo "<td style=\"text-align:left; color:#6495ED;font-weight:bold;\">Trianer Name</td>";
		echo " <td>".$name."</td>";
        echo "</tr>";
        
        echo "<tr>";
		echo "<td style=\"text-align:left; color:#6495ED;font-weight:bold;\">Trainer Duration</td>";
		echo " <td>".$duration."</td>";
        echo "</tr>";
        
        echo "<tr>";
		echo "<td style=\"text-align:left; color:#6495ED;font-weight:bold;\">Training Time</td>  ";
		echo " <td>".$time."</td>";
        echo "</tr>";
        
        echo "<tr>";
		echo "<td style=\"text-align:left; color:#6495ED;font-weight:bold;\">Price for hour (SGD)</td> ";
		echo " <td>".$price."</td>";
        echo "</tr>";
        
        echo "<tr>";
		echo "<td style=\"text-align:left; color:#6495ED;font-weight:bold;\">Hour selected (Hour)</td>";
		echo " <td>".$trainhr."</td>";
        echo "</tr>";
        
        echo "<tr>";
		
		echo "<td style=\"text-align:left; color:#6495ED;font-weight:bold;\">Total Price (SGD)</td>";
		echo " <td>".$total."</td>";
        echo "</tr>";
        
        echo "<tr>";
		echo "<td style=\"text-align:left; color:#6495ED;font-weight:bold;\">Comments</td>";
		echo " <td>".$comments."</td>";
        echo "</tr>";
        
        
        echo "</table>";
        
        
		// update table courses for the number of occupancy
		$vacancy = $vacancy - 1;
		
		$sql2 = "UPDATE private_trainer SET vacancy = '".$vacancy."' WHERE private_trainer_id = '".$privateid."'";
		$result2 = $db->query($sql2);
	    
	    //update times of registration for private courses for this members 
	    //store the result in member table
	    $p_count = $p_count + 1;
	    
	    $sqlcount="UPDATE member SET p_count = '".$p_count."' where matric_number ='".$_SESSION["userid"]."'";
        $resultcount = $db->query($sqlcount);
        
        
		// insert into table course_registration for member
		$sql3="INSERT INTO private_coach_appointment (matric_number, private_trainer_id, available_training_time, registration_time, selected_hours, total_price, comments) VALUES ('".$_SESSION["userid"]."','".$privateid."', '".$available_training_time."', '".$datetime."','".$trainhr."','".$total."','".$comments."')";
        $result3 = $db->query($sql3);
	    if ($result3) {
              echo  "<p>".$db->affected_rows." registration records for your User ID is updated and inserted in database.</p>";
            } else {
  	          echo "<p>An error has occurred.  Registration record was not added.</p>";
            }


	echo "<h4>Gentle Reminder:</h4>";
	echo "<p>You could only deregister courses two hours prior the starting time of each course.</p>";
	echo "<p>Please come to the class on time and get propper preparation.</p>";
	echo "<p>Thank you so much. NTU Fitness Factory wish you have a nice training!</p>";	
		} 
	}
		else {
	echo "<h1 style=\"text-align:left; color:#6495ED;\"><span style=\"color:white; font-weight:normal;\">Dear </span>".$_SESSION["membername"].",</h1>";
	 echo "<h2 style=\"text-align:center; color:#6495ED;\">Sorry, the private trainer time slot has been expried.</h2>";
	 echo "<br><h2 style=\"text-align:center; color:#6495ED;\">You must register private course at least ONE day before.</h2>";
	  echo "<p>You could go to <a href=\"appointment3.php\">Schedule Appointment</a> to try other available Private Trainer Course ID</p>";
		echo "<p>Or please wait for upcoming schedule for next week.</p>"; 
	   
	    }
}
$db->close();
?>
    </div>
</div>


	<!-- footer for website-->
	<footer>
	<small><i>Copyright &copy; 2013 NTU Fitness Factory</i></small><br>
	Email: <a href="mailto:ntufitnessfactory@ntufitnessfactory.com" id="a">ntufitnessfactory@ntufitnessfactory.com</a>     Phone: (+65)87654321      Location: 21 Nanyang Circle.
	</footer>
	</div>
	
	<!-- scrooling text-->
	<script id='scroolingtext' src="scroolingtext.js"></script>
	<div id="scroolingtext" >
	<p id="tabledata" align="center"> message goes here</p>
	</div>
</body>
</html>