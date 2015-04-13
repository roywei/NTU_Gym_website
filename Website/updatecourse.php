<?php
	// Inialize session
	session_start();
?>
<html>
<head>
<title>Course Dropping Results</title>
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
      <li><a href="member.php">View/Edit Personal Information</a></li>
      <li><a href="viewregistration.php">View/Edit Training Schedule</a></li>
	</ul>
  </nav>	
</div>
  
<div id="rightcolumn">
    <img src="SubBanner_Member.png" width="800" height="287" alt="SubBanner_Member">
<div id="content">


<?php
  // create short variable names
  
  

  $courseid=$_GET['courseid'];
  
  if (!isset($_SESSION["userid"])) {
     echo "<h2 style=\"text-align:center; color:#6495ED;\">Sorry you hava not logged in.</h2>"; 
     echo "<p>If you are member, please log in using your registered Matric No.</p>";
	  echo "<p>If you are not member, welcome to <a href=\"register_form.php\">JOIN US</a>!</p>";
	 echo "<p>Thank you for visiting NTU Fitness Factory! Wish you a nice training journey here!</p>";
	 echo "<script language=javascript>alert('You have not logged in. Please log in.')</script>";  
     exit;
  }
  
  if (!$courseid) {
     echo 'You have not entered any details.  Please go back and try again.';
     exit;
  }

  
  if (!get_magic_quotes_gpc()) {
   
    
	$courseid = addslashes($courseid);
  }

  @ $db = new mysqli('localhost', 'f33s28', 'weilai729', 'f33s28');

  if (mysqli_connect_errno()) {
     echo "Error: Could not connect to database.  Please try again later.";
     exit;
  }

	$query_ = "SELECT * FROM member where matric_number = '".$_SESSION["userid"]."' AND password ='".$_SESSION["password"]."'";
    $result_ = $db->query($query_);
	$row = $result_->fetch_assoc();
    $c_count = $row['c_count'];
	
	$current_date=date('Y-m-d H:i:s');
	
	$sql12 = "SELECT * FROM courses where course_id like '%".$courseid."%'";
	$result12 = $db->query($sql12);
	$row = $result12->fetch_assoc();
	$course_time = $row['course_time'];
	$diff = strtotime($course_time) - strtotime($current_date);


	//Check whether the user is dropping courses which start within 2 hours. 
	if ($diff < 7200){
	echo "<h1 style=\"text-align:left; color:#6495ED;\"><span style=\"color:white; font-weight:normal;\">Dear </span>".$_SESSION["membername"].",</h1>";    
     echo "<h2 style=\"text-align:center; color:#6495ED;\">Sorry, dropping courses is NOT successful.</h2>"; 
	echo "<p>You cannot drop a course which starts in 2 hours.</p>";
	echo "<p>Thank you for visiting NTU Fitness Factory!</p>";
	echo "<p>Wish you a nice training journey here!</p>";
	echo "<script language=javascript>alert('Dear ".$_SESSION["membername"].", you cannot drop a course which starts in 2 hours.')</script>"; 
	}
	 
	else {
	echo "<h1 style=\"text-align:left; color:#6495ED;\"><span style=\"color:white; font-weight:normal;\">Dear </span>".$_SESSION["membername"].",</h1>";    
	$sql10 = "SELECT * FROM courses where course_id like '%".$courseid."%'";
	$result = $db->query($sql10);
	$row = $result->fetch_assoc();
	$vacancy = $row['vacancy'];
			
		
	 if ($courseid){
	 $query2 = " DELETE FROM course_registration where matric_number= '".$_SESSION["userid"]."' AND course_id= '".$courseid."' ";
	 $result2 = $db->query($query2);
	 
	//update course vacancy		
	$vacancy = $vacancy+1;
	$query3 = "UPDATE courses SET vacancy  = '".$vacancy."' WHERE course_id = '".$courseid."'";
	$result3 = $db->query($query3);
	
	//update times of registration for courses for this members 
	//store the result in member table
	$c_count = $c_count - 1;
	    
	$sqlcount="UPDATE member SET c_count = '".$c_count."' where matric_number ='".$_SESSION["userid"]."'";
    $resultcount = $db->query($sqlcount);
        
	 
	 echo "<h2 style=\"text-align:center; color:#6495ED;\">Selected Course ID has been successfully dropped!</h2>";
	
	 
	 
	 //update course table
	 
	
	$sqlcourse = "SELECT * FROM course_registration where matric_number = '".$_SESSION["userid"]."' ";
	$resultcourse = $db->query($sqlcourse);
	$num_results_c = $resultcourse->num_rows;
	
	$sqlprivate = "SELECT * FROM private_coach_appointment where matric_number = '".$_SESSION["userid"]."' ";
	$resultprivate = $db->query($sqlprivate);
	$num_results_p = $resultprivate->num_rows;
	
	    // Print information  
// 	    if ($num_results_c!=0){
		echo "<table bordercolor=\"#6495ED\" align=\"center\"> ";
	    echo "<caption><font color=white>Updated Training Schedule - Courses: </font></caption> ";  
	    
	    echo "<tr bgcolor=\"#6495ED\">";
		echo " <th>Course ID</td>"; 
		echo " <th>Course Name</td>"; 
		echo " <th>Starting Time</td>";
		echo " <th>Duration</td>";
		echo " <th>Venue</td>";
        echo " <th>Registration Time</td>";
        echo "</tr>";
       
	for ($i=0; $i < $num_results_c; $i++){  
	
    $row = $resultcourse->fetch_assoc();
	$userid = $row['matric_number'];
	$courseid = $row['course_id'];
	$time = $row['registration_time'];
	$coursetime = $row['course_time'];
	
	//get course information from database to show
	$sqlshow_c = "SELECT * FROM courses where course_id like '%".$courseid."%'";
	$resultshow_c = $db->query($sqlshow_c);
	$row = $resultshow_c->fetch_assoc();
	$name = $row['course_name'];
	$duration = $row['course_duration'];
	$venue = $row['course_venue'];
	
	    echo "<tr>";
        echo " <td>".$courseid."</td>";
        echo " <td>".$name."</td>";
        echo " <td>".$coursetime."</td>";
        echo " <td>".$duration."</td>";
         echo " <td>".$venue."</td>";
        echo " <td>".$time."</td>";
        echo "</tr>";
		}
		
		echo "</table>";
// 		}
		
		echo "<br/>";
		echo "<br/>";
		
		// print private training table
// 		if ($num_results_p!=0){
		echo "<table bordercolor=\"#6495ED\" align=\"center\"> ";
	    echo "<caption><font color=white>Updated Training Schedule - Private Trainer: </font></caption> ";  
	    
	    echo "<tr bgcolor=\"#6495ED\">";
	    echo " <th>Private Trainer ID</td>"; 
		echo " <th>Trainer Name</td>"; 
		echo " <th>Starting Time</td>";
		echo " <th>Duration</td>";
		echo " <th>Price (SGD)</td>";
        echo " <th>Registration Time</td>";
        echo "</tr>";
       
	for ($j=0; $j < $num_results_p; $j++){  
	
    $row = $resultprivate->fetch_assoc();
	$privateid = $row['private_trainer_id'];
	$time = $row['registration_time'];
	$hour = $row['selected_hours'];
	$totalprice = $row['total_price'];
	$coursetime = $row['available_training_time'];
	
	//get private training information from database to show
	$sqlshow_p = "SELECT * FROM private_trainer where private_trainer_id like '%".$privateid."%'";
	$resultshow_p = $db->query($sqlshow_p);
	$row = $resultshow_p->fetch_assoc();
	$privatename = $row['trainer_name'];
	$duration = $row['training_duration'];
	
	
	
	    echo "<tr>";
        echo " <td>".$privateid."</td>";
        echo " <td>".$privatename."</td>";
        echo " <td>".$coursetime."</td>";
        echo " <td>".$duration."</td>";
        echo " <td>".$totalprice."</td>";
        echo " <td>".$time."</td>";
        echo "</tr>";
		}
		
		echo "</table>";

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