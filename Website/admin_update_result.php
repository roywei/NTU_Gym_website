<?php
	// Inialize session
	session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin Update Result</title>
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
	<div id="content" >


        <?php

//admin has not logged in
 if (!isset($_SESSION["userid"])) { 
     echo "<h2 style=\"text-align:center; color:#6495ED;\">Sorry, your updating is not successful.</h2>"; 
     echo "<p>Please log in with an valid admin id.</p>";
	 echo "<script language=javascript>alert('You have not logged in as Admin.')</script>"; 
     exit;
  }
  

  
  // print information if admin acccount
  echo "<h1 style=\"text-align:left; color:#6495ED;\"><span style=\"color:white; font-weight:normal;\">Dear </span>Administrator,</h1>";
  
  $id=$_POST['id'];
  $newvacancy=$_POST['newvacancy'];
  //type in new course time
    $newtime = $_POST['date'] . ' ' . $_POST['time'];
    $newtime = mysql_real_escape_string($newtime);
    $newtime = strtotime($newtime);
    $newtime = date('Y-m-d H:i:s',$newtime);
  //current datetime
    $current_date=date('Y-m-d H:i:s');
  	
	if (!get_magic_quotes_gpc()){
    
    $id = addslashes($id);
    $newtime= addslashes($newtime);
    $newvacancy = addslashes($newvacancy);  
  }
  
    if (!$id) {
    echo "<h2 style=\"text-align:center; color:#6495ED;\">Sorry, your updating is not successful.</h2>"; 
    echo 'You have not entered any details.  Please go back and try again.';
 	echo "<script language=javascript>alert('You have not entered any details.')</script>"; 
 	echo "<p>Go back <a href=\"admin_update.php\">UPDATE for ADMIN</a> and update other Courses</p>";
    exit;
   } 
   
  $diff0 = strtotime($newtime) - strtotime($current_date);
  $retval = bcdiv($diff0, (60 * 60));  
  //new datetime must be grater than current datetime
  if ($diff0 < 0) {
    echo "<h2 style=\"text-align:center; color:#6495ED;\">Sorry, your updating is not successful.</h2>"; 
    echo 'You must ensure that the new datetime is grater than today.';
 	echo "<script language=javascript>alert('New datetime is not valid.')</script>"; 
 	echo "<p>Go back <a href=\"admin_update.php\">UPDATE for ADMIN</a> and update other Courses</p>";
    exit;
   } 
 
 
 //Updating is successful
  //connecting database
  @ $db = new mysqli('localhost', 'f33s28', 'weilai729', 'f33s28');
  
  if (mysqli_connect_errno()) {
     echo "Error: Could not connect to database.  Please try again later.";
     exit;
  }

 
 //if it is from Courses 
 if ($id == "ABS1" || $id == "ABC2" ||  $id == "YHY3" || $id == "YDY4") {
   
    //check time difference
    //only overdue Course ID or Private Trainer ID can be changed
    $sqlcc = "SELECT * FROM courses where course_id like '%".$id."%'";
	$resultcc = $db->query($sqlcc);
	$row = $resultcc->fetch_assoc();
	$timecc = $row['course_time'];
  
    $diff = strtotime($current_date) - strtotime($timecc);
	$retval = bcdiv($diff, (60 * 60));  
   
   
   if ($diff < 0) {
    echo "<h2 style=\"text-align:center; color:#6495ED;\">Sorry, your updating is not successful.</h2>"; 
    echo "<p>Only overdue Course ID or Private Trainer ID can be changed.</p>";
    echo "<p>Go back <a href=\"admin_update.php\">UPDATE for ADMIN</a> and update other Courses</p>";
 	echo "<script language=javascript>alert('Selected Course ID or Private Trainer ID is not out of date.')</script>"; 
    exit;
   } else {
   
   //update tables in database
 $sql_new = "UPDATE courses SET course_time = '".$newtime."', vacancy = '".$newvacancy."' WHERE course_id = '".$id."'";
 $result_new = $db->query($sql_new);
 
  //update Course Registration, in this way, members can continue to register for new courses.
  $sql_update_member = "DELETE FROM course_registration WHERE course_id = '".$id."'";
  $result_update_member= $db->query($sql_update_member);
  
  
  //print table changed
  echo "<p style=\"text-align:left; color:white;\">This is updated result.</p>";  
  echo "<p>Go back <a href=\"admin_update.php\">UPDATE for ADMIN</a> and update other Courses</p>";
  echo "<br/>";

  echo "<table bordercolor=\"#6495ED\"> ";	
        echo "<caption><font color=white>Courses</font></caption> ";     
	    echo "<tr bgcolor=\"#6495ED\">";
	    echo " <th>Course ID</th> ";
        echo " <th>Course Name</th>";
        echo " <th>Course Duration (hour)</th>";
        echo " <th>Starting Time</th>";
        echo " <th>Course Venue</th> ";
		echo " <th>Number of Vacancy </th> ";
        echo "</tr>";
        
    $sql_change = "SELECT * FROM courses WHERE course_id = '".$id."'";
	$result_change = $db->query($sql_change);
	$row = $result_change->fetch_assoc();
	$courseid_change = $row['course_id'];
    $name_change = $row['course_name'];
	$duration_change = $row['course_duration'];
	$time_change = $row['course_time'];
	$venue_change = $row['course_venue'];
	$vacancy_change = $row['vacancy'];  
	       
	    echo "<tr>";
	    echo " <td>".$courseid_change."</td>";
        echo " <td>".$name_change."</td>";
        echo " <td>".$duration_change."</td>";
        echo " <td>".$time_change."</td>";
        echo " <td>".$venue_change."</td>";
		echo " <td>".$vacancy_change."</td>";
		echo "</tr>";
		echo "</table>";
		echo "<br/>";
   }

 }
 
 
 //if it is for Private Trainer 
 if ($id == "WL1" || $id == "ZX2" ||  $id == "ZB3") {  
 
    $sqlpp = "SELECT * FROM private_trainer where private_trainer_id like '%".$id."%'";
	$resultpp = $db->query($sqlpp);
	$row = $resultpp->fetch_assoc();
	$timepp = $row['available_training_time'];
  //check time difference
  //only overdue Course ID or Private Trainer ID can be changed
    $diff = strtotime($current_date) - strtotime($timepp);
	$retval = bcdiv($diff, (60 * 60));  
   
   
   if ($diff < 0) {
    echo "<h2 style=\"text-align:center; color:#6495ED;\">Sorry, your updating is not successful.</h2>"; 
    echo 'Only overdue Course ID or Private Trainer ID can be changed.';
    echo "<p>Go back <a href=\"admin_update.php\">UPDATE for ADMIN</a> and update other Courses</p>";
 	echo "<script language=javascript>alert('Selected Course ID or Private Trainer ID is not out of date.')</script>"; 
    exit;
   } else {
   
 $sql_new = "UPDATE private_trainer SET available_training_time = '".$newtime."', vacancy = '".$newvacancy."' WHERE private_trainer_id = '".$id."'";
 $result_new = $db->query($sql_new);
 
 //update Private Trainer Appointment in this way, members can continue to register for new courses.
  $sql_update_member = "DELETE FROM private_coach_appointment WHERE private_trainer_id = '".$id."'";
  $result_update_member= $db->query($sql_update_member);
  
  
  
//print table changed
  echo "<p style=\"text-align:left; color:white;\">This is updated result.</p>";  
  echo "<p>Go back <a href=\"admin_update.php\">UPDATE for ADMIN</a> and update other Courses</p>";
  echo "<br/>";
  
  echo "<table bordercolor=\"#6495ED\" align=\"center\"> ";
	    echo "<caption><font color=white>Private Training</font></caption> ";  
	    
	    echo "<tr bgcolor=\"#6495ED\">";
	    echo " <th>Private Trainer ID</th>"; 
		echo " <th>Trainer Name</th>"; 
		echo " <th>Starting Time</th>";
		echo " <th>Duration</th>";
		echo " <th>Price (SGD)</th>";
		echo " <th>Number of Vacancy</th>";

        echo "</tr>";
        
    $sql_change = "SELECT * FROM private_trainer WHERE private_trainer_id = '".$id."'";
	$result_change = $db->query($sql_change);    
	$row = $result_change->fetch_assoc();
	$privateid_change = $row['private_trainer_id'];
	$privatename_change = $row['trainer_name'];
	$duration_change = $row['training_duration'];
	$coursetime_change = $row['available_training_time'];
	$price_change = $row['price'];
	$vacancy_change = $row['vacancy'];  

	
	    echo "<tr>";
        echo " <td>".$privateid_change."</td>";
        echo " <td>".$privatename_change."</td>";
        echo " <td>".$coursetime_change."</td>";
        echo " <td>".$duration_change."</td>";
        echo " <td>".$price_change."</td>";
        echo " <td>".$vacancy_change."</td>";
        echo "</tr>";
		echo "</table>";
		echo "<br/>";
		echo "<br/>";
  }
  
}
  
  
  echo "<p style=\"text-align:left; color:white;\">These are all results in database.</p>";  

//print updated course information
        echo "<table bordercolor=\"#6495ED\"> ";	
        echo "<caption><font color=white>Courses</font></caption> ";     
	    echo "<tr bgcolor=\"#6495ED\">";
	    echo " <th>Course ID</th> ";
        echo " <th>Course Name</th>";
        echo " <th>Course Duration (hour)</th>";
        echo " <th>Starting Time</th>";
        echo " <th>Course Venue</th> ";
		echo " <th>Number of Vacancy </th> ";
        echo "</tr>";
        
     //there are four courses in total   
    $sql_admin_c = "SELECT * FROM courses";
	$result_admin_c = $db->query($sql_admin_c);
    for ($a=0; $a < 4; $a++){
	$row = $result_admin_c->fetch_assoc();
	$courseid_admin_c = $row['course_id'];
    $name_admin_c = $row['course_name'];
	$duration_admin_c = $row['course_duration'];
	$time_admin_c = $row['course_time'];
	$venue_admin_c = $row['course_venue'];
	$vacancy_admin_c = $row['vacancy'];  
	       
	    echo "<tr>";
	    echo " <td>".$courseid_admin_c."</td>";
        echo " <td>".$name_admin_c."</td>";
        echo " <td>".$duration_admin_c."</td>";
        echo " <td>".$time_admin_c."</td>";
        echo " <td>".$venue_admin_c."</td>";
		echo " <td>".$vacancy_admin_c."</td>";
		echo "</tr>";
		}
		
        echo "</table>";
        
        echo "<br/>";
		echo "<br/>";

//print private trainer information
        echo "<table bordercolor=\"#6495ED\" align=\"center\"> ";
	    echo "<caption><font color=white>Private Training</font></caption> ";  
	    
	    echo "<tr bgcolor=\"#6495ED\">";
	    echo " <th>Private Trainer ID</th>"; 
		echo " <th>Trainer Name</th>"; 
		echo " <th>Starting Time</th>";
		echo " <th>Duration</th>";
		echo " <th>Price (SGD)</th>";
		echo " <th>Number of Vacancy</th>";

        echo "</tr>";
        
    $sql_admin_p = "SELECT * FROM private_trainer";
	$result_admin_p = $db->query($sql_admin_p);    
	for ($b=0; $b < 3; $b++){  
	$row = $result_admin_p->fetch_assoc();
	$privateid_admin_p = $row['private_trainer_id'];
	$privatename_admin_p = $row['trainer_name'];
	$duration_admin_p = $row['training_duration'];
	$coursetime_admin_p = $row['available_training_time'];
	$price_admin_p = $row['price'];
	$vacancy_admin_p = $row['vacancy'];  

	
	    echo "<tr>";
        echo " <td>".$privateid_admin_p."</td>";
        echo " <td>".$privatename_admin_p."</td>";
        echo " <td>".$coursetime_admin_p."</td>";
        echo " <td>".$duration_admin_p."</td>";
        echo " <td>".$price_admin_p."</td>";
        echo " <td>".$vacancy_admin_p."</td>";
        echo "</tr>";
		}
		
		echo "</table>";
		echo "<br/>";
		echo "<br/>";
     

			
	$db->close();
?>


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