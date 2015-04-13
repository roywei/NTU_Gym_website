<?php
	// Inialize session
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Course Registration Results</title>
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
      <li><a href="courseinfo.php">Course Info</a></li>
      <li><a href="courseregister3.php">Course Registration</a></li>
	</ul>
  </nav>	
    <br>  
<img src="man.png" width="200" height="320" align="bottom" alt="man1">

</div>
  
<div id="rightcolumn">
    <img src="SubBanner_Courses.png" width="800" height="287" alt="SubBanner_Courses">
	<div id="content">

<?php
  // create short variable names
  
//   $courseid=$_POST['courseid'];
  $courseid=$_GET['courseid'];
  
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


  if (!get_magic_quotes_gpc()){
    $courseid = addslashes($courseid);

  }


  @ $db = new mysqli('localhost', 'f33s28', 'weilai729', 'f33s28');


  if (mysqli_connect_errno()) {
     echo 'Error: Could not connect to database.  Please try again later.';
     exit;
  }

  
  if ($courseid=="nochoice"){
    echo "<h1 style=\"text-align:left; color:#6495ED;\"><span style=\"color:white; font-weight:normal;\">Dear </span>".$_SESSION["membername"].",</h1>";
    echo "<h2 style=\"text-align:center; color:#6495ED;\">Sorry, your registration is NOT successful.</h2>"; 
    echo "<p>You have not make any selection.</p>";
	echo "<p>Thank you for visiting NTU Fitness Factory! Wish you a nice training journey here!</p>";
	echo "<script language=javascript>alert('Dear ".$_SESSION["membername"].", you have not make any selection.')</script>"; 
  }
  else{
  
  
  //get each course information from database
  //course 1
 
	$sqlc1 = "SELECT * FROM courses where course_id like '%".$courseid."%'";
	$resultc1 = $db->query($sqlc1);
	$row = $resultc1->fetch_assoc();
	$name = $row['course_name'];
	$duration = $row['course_duration'];
	$time = $row['course_time'];
	$venue = $row['course_venue'];
	$vacancy = $row['vacancy'];
   

    $query = "SELECT * FROM member where matric_number ='".$_SESSION["userid"]."'";
    $result0 = $db->query($query);
	$row = $result0->fetch_assoc();
	$c_count = $row['c_count'];
	
    //check this user has registered for selected course_id or not 
    $query_c1 = "SELECT * FROM course_registration where matric_number = '".$_SESSION["userid"]."' AND course_id ='".$courseid."'";
    $result_c1= $db->query($query_c1);
	$isregist = $result_c1->num_rows;
	
    if ($isregist != 0){ 
    echo "<h1 style=\"text-align:left; color:#6495ED;\"><span style=\"color:white; font-weight:normal;\">Dear </span>".$_SESSION["membername"].",</h1>";
    echo "<h2 style=\"text-align:center; color:#6495ED;\">Sorry, your registration is NOT successful.</h2>"; 
    echo "<p>You have already registered this selected course_id.</p>";
	echo "<p>You can only register one course_id for one time. ";
	echo "You could go to <a href=\"viewregistration.php\">View/Edit Personal Information</a> to edit your personla training schedule.</p>";
	echo "<p>Thank you for visiting NTU Fitness Factory! Wish you a nice training journey here!</p>";
	echo "<script language=javascript>alert('Dear ".$_SESSION["membername"].", you have registered for this course.')</script>"; 
     } 
	
	//if existing registered member and hasnot registered for current course_id
    else if ($isregist == 0)
    {
	  if(($vacancy <= 0)){
	
	    // failed registration     
	    echo "<h1 style=\"text-align:left; color:#6495ED;\"><span style=\"color:white; font-weight:normal;\">Dear </span>".$_SESSION["membername"].",</h1>";
        echo "<h2 style=\"text-align:center; color:#6495ED;\">Sorry, your registration is NOT successful.</h2>"; 
		echo "<h2 style=\"text-align:center; color:#6495ED;\">Selected Course ID is FULLY registered.</h2>";
		echo "<p style=\"text-align:center;\">You could go to <a href=\"courseregister3.php\">Course Reigstration</a> to try other available Course ID</p>";
		echo "<p style=\"text-align:center;\">Or please wait for upcoming schedule for next week.</p>";
	
	   } else if(($vacancy > 0)){
	
	    // successful order  
	   echo "<h1 style=\"text-align:left; color:#6495ED;\"><span style=\"color:white; font-weight:normal;\">Dear </span>".$_SESSION["membername"].",</h1>";
	    echo "<h2 style=\"text-align:center; color:#6495ED;\">Congratulations, your registration is successful!</h2>"; 
	    echo '<p>Registration processed at '.date('H:i, jS F Y')."</p>"; 
	    
	    echo "<table bordercolor=\"#6495ED\" align=\"center\">";
	    echo "<caption style=\"text-align:center; color:white;\">This is the Course ID you have registered:</caption>";
	    echo "<tr bgcolor=\"#6495ED\">";
        echo " <th>Course ID</th>";
        echo " <th>Course Name</th>";
        echo " <th>Course Duration (hour)</th>";
        echo " <th>Starting Time</th>";
        echo " <th>Course Venue</th> ";
        echo "</tr>";
        
        echo " <tr><td>".$courseid."</td>";
        echo " <td>".$name."</td>"; 
        echo " <td>".$duration."</td>"; 
        echo " <td>".$time."</td>";
        echo " <td>".$venue."</td>";
        echo "</tr>";
        
        echo "</table>";
		
	            
		// update table courses for the number of vacancy
		$vacancy = $vacancy - 1;
		
		$sql2 = "UPDATE courses SET vacancy = '".$vacancy."' WHERE course_id = '".$courseid."'";
		$result2 = $db->query($sql2);
	   
	    
	    
	    //update times of registration for courses for this members 
	    //store the result in member table
	    $c_count = $c_count + 1;
	    
	    $sqlcount="UPDATE member SET c_count = '".$c_count."' where matric_number ='".$_SESSION["userid"]."'";
        $resultcount = $db->query($sqlcount);
        
        
		// insert into table course_registration for member
		$sql3 = "INSERT INTO course_registration (matric_number, course_id, course_time, registration_time) VALUES ('".$_SESSION["userid"]."','".$courseid."', '".$time."', '".$datetime."')";
        $result3 = $db->query($sql3);
        
	      if ($result3) {
              echo  "<p><span style=\"color:#6495ED; font-weight:bold;\">".$db->affected_rows." </span>registration record for your User ID is updated and inserted in database.</p>";
            } else {
  	          echo "<p>An error has occurred.  Registration record was not added.</p>";
            }
		} 
	echo "<h4 style=\"color:#6495ED; font-weight:bold;\">Gentle Reminder:</h4>";
	echo "<p>You could only deregister courses two hours prior the starting time of each course.</p>";
	echo "<p>Please come to the class on time and get propper preparation.</p>";
	echo "<p>Thank you so much. NTU Fitness Factory wish you have a nice training!</p>";		
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