<?php
	// Inialize session
	session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>LOG IN</title>
<meta charset="utf-8">
<link rel="stylesheet" href="csshome.css">
</head>


<div id="wrapper">
<br>
<div id="headerleft">

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

  // create short variable names
 
  $userid=$_POST['userid'];
  $password=$_POST['password'];
 
  if (!$userid || !$password) {
     echo 'You have not entered any required details. Please go back and try again.';
     exit;
  }

  
  if (!get_magic_quotes_gpc()) {
    
    $userid = addslashes($userid);
    $password = addslashes($password);
  }

  @ $db = new mysqli('localhost', 'f33s28', 'weilai729', 'f33s28');

  if (mysqli_connect_errno()) {
     echo "Error: Could not connect to database.  Please try again later.";
     exit;
  }

    
// for admin to update tables in database
if ($userid == "admin" && $password == "admin"){
   
    $isadmin = 1;
   
    $_SESSION['userid'] = $userid;
	$_SESSION['membername'] = "Administrator";
	$_SESSION['password'] = $password;
   
    setcookie("userid", $userid, strtotime( '+30 days' ), "/", "", "", TRUE);
	setcookie("membername", $membername, strtotime( '+30 days' ), "/", "", "", TRUE);
	setcookie("password", $password, strtotime( '+30 days' ), "/", "", "", TRUE);   

    
    echo "<h1 style=\"text-align:left; color:#6495ED;\"><span style=\"color:white; font-weight:normal;\">Dear </span>Administrator,</h1>";
    echo "<p style=\"text-align:left; color:white;\">This is the tables stored in database.</p>";


//print course information
        echo "<table bordercolor=\"#6495ED\"> ";	
        echo "<caption><font color=white>Courses</font></caption> ";     
	    echo "<tr bgcolor=\"#6495ED\">";
	    echo " <th>Course ID</th> ";
        echo " <th>Course Name</th>";
        echo " <th>Course Duration (hour)</th>";
        echo " <th>Starting Time</th>";
        echo " <th>Course Venue</th> ";
		echo " <th>Number of Vacancy </th> ";
		echo " <th>To Update</th> ";
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
		echo " <td><a href=\"admin_update.php\"><button name=\"adminupdate\" id=\"adminupdate\" type=\"submit\">Update Info</button></a></td>";

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
		echo " <th>To Update</th> ";

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
        echo " <td><a href=\"admin_update.php\"><button name=\"adminupdate\" id=\"adminupdate\" type=\"submit\">Update Info</button></a></td>";
        echo "</tr>";
		}
		
		echo "</table>";
		echo "<br/>";
		echo "<br/>";
     
}
 
//this is for general users and members
    
    $query_0 = "SELECT * FROM member where matric_number = '".$userid."' ";
    $result_0= $db->query($query_0);
	$ismember = $result_0->num_rows;
	$row = $result_0->fetch_assoc();
	
	
	
	$query_ = "SELECT * FROM member where matric_number = '".$userid."' AND password ='".$password."'";
    $result_ = $db->query($query_);
	$ispassword = $result_->num_rows;
	$row = $result_->fetch_assoc();
	$membername = $row['name'];
	$islogin = $row['islogin'];
	$gender = $row['gender'];
	
		
	
	
	if ($ismember==0 && $isadmin==0){
	echo "<h1 style=\"text-align:left; color:#6495ED;\">Sorry, you have not registered as member.</h1>";
	echo "<p>Thank you for visiting NTU Fitness Factory! Wish you a nice training journey here!</p>";
	}
	else if ($ispassword==0 && $isadmin==0){
	echo "<h1 style=\"text-align:left; color:#6495ED;\">Sorry, your password is not correct.</h1>";
	echo "<p>Thank you for visiting NTU Fitness Factory! Wish you a nice training journey here!</p>";
	} 
	else if ($ispassword!=0 && $ismember!=0 && $isadmin ==0){
	
	//set the session variable
	$_SESSION['userid'] = $userid;
	$_SESSION['membername'] = $membername;
	$_SESSION['password'] = $password;
	
	setcookie("userid", $userid, strtotime( '+30 days' ), "/", "", "", TRUE);
	setcookie("membername", $membername, strtotime( '+30 days' ), "/", "", "", TRUE);
	setcookie("password", $password, strtotime( '+30 days' ), "/", "", "", TRUE);
	
	$islogin=1;
	$query_update = "UPDATE member SET islogin  = '".$islogin."' WHERE matric_number = '".$userid."'";
	$result_update = $db->query($query_update);

    echo "<h1 style=\"text-align:left; color:#6495ED;\"><span style=\"color:white; font-weight:normal;\">Dear </span>".$_SESSION["membername"].",</h1>";

    //print our popular courses
	echo "<p style=\"text-align:left; color:white;\">This is our most popular course for this week.</p>";
	echo "<p style=\"text-align:left; color:white;\">Limited vacancy, Sign up now!</p>";
	
    // select popular courses
    $sql_pop = "SELECT * FROM courses ORDER BY vacancy LIMIT 1";
	$result_pop = $db->query($sql_pop);
	$row = $result_pop->fetch_assoc();
	$courseid_popular = $row['course_id'];
    $name_popular = $row['course_name'];
	$duration_popular = $row['course_duration'];
	$time_popular = $row['course_time'];
	$venue_popular = $row['course_venue'];
	$vacancy_popular = $row['vacancy'];  


    //print course information
        echo "<table bordercolor=\"#6495ED\"> ";	
        echo "<caption><font color=white>Our Most Popular Course</font></caption> ";     
	    echo "<tr bgcolor=\"#6495ED\">";
	    echo " <th>Course ID</td> ";
        echo " <th>Course Name</th>";
        echo " <th>Course Duration (hour)</th>";
        echo " <th>Starting Time</th>";
        echo " <th>Course Venue</th> ";
		echo " <th>Number of vacancy </td> ";
		echo " <td>Registration</td> ";
        echo "</tr>";
       
	    echo "<tr>";
	    echo " <td>".$courseid_popular."</td>";
        echo " <td>".$name_popular."</td>";
        echo " <td>".$duration_popular."</td>";
        echo " <td>".$time_popular."</td>";
        echo " <td>".$venue_popular."</td>";
		echo " <td>".$vacancy_popular."</td>";
		
		echo " <td><a href=\"courseregister3.php\"><button name=\"viewpopular\" id=\"viewpopular\" type=\"submit\">VIEW</button></a></td>";
        echo "</tr>";
        echo "</table>";

        echo "<br/>";
		echo "<br/>";
	
	
	// print recomend courses
	echo "<p style=\"text-align:left; color:white;\">This is our recomendation courses for this week.</p>";
	echo "<p style=\"text-align:left; color:white;\">According to your personal particulars, we recomend these courses for you!</p>";
	
    // select popular courses
    //if gender is male, then provide Aerobics 1
    //if gender is female, then provide yoga 1
    if ($gender=="M"){
    $sql_rec = "SELECT * FROM courses where course_id='ABC2'";
	$result_rec = $db->query($sql_rec);
	$row = $result_rec->fetch_assoc();
	$courseid_rec = $row['course_id'];
    $name_rec = $row['course_name'];
	$duration_rec = $row['course_duration'];
	$time_rec = $row['course_time'];
	$venue_rec = $row['course_venue'];
	$vacancy_rec = $row['vacancy'];  
    }else if ($gender=="F"){ 
    $sql_rec = "SELECT * FROM courses where course_id='YDY4'";
	$result_rec = $db->query($sql_rec);
	$row = $result_rec->fetch_assoc();
	$courseid_rec = $row['course_id'];
    $name_rec = $row['course_name'];
	$duration_rec = $row['course_duration'];
	$time_rec = $row['course_time'];
	$venue_rec = $row['course_venue'];
	$vacancy_rec = $row['vacancy'];  
    }

    //print recomendation course information
        echo "<table bordercolor=\"#6495ED\"> ";	
        echo "<caption><font color=white>Our Recomendation Courses</font></caption> ";     
	    echo "<tr bgcolor=\"#6495ED\">";
	    echo " <th>Course ID</td> ";
        echo " <th>Course Name</th>";
        echo " <th>Course Duration (hour)</th>";
        echo " <th>Starting Time</th>";
        echo " <th>Course Venue</th> ";
		echo " <th>Number of vacancy </td> ";
		echo " <td>Registration</td> ";
        echo "</tr>";
       
	    echo "<tr>";
	    echo " <td>".$courseid_rec."</td>";
        echo " <td>".$name_rec."</td>";
        echo " <td>".$duration_rec."</td>";
        echo " <td>".$time_rec."</td>";
        echo " <td>".$venue_rec."</td>";
		echo " <td>".$vacancy_rec."</td>";
		
		echo " <td><a href=\"courseregister3.php\"><button name=\"viewpopular\" id=\"viewpopular\" type=\"submit\">VIEW</button></a></td>";
        echo "</tr>";
        echo "</table>";

        echo "<br/>";
		echo "<br/>";
		
		
		
	//print member's registered courses
	$sqlcourse = "SELECT * FROM course_registration where matric_number = '".$userid."' ";
	$resultcourse = $db->query($sqlcourse);
	$num_results_c = $resultcourse->num_rows;
	
	$sqlprivate = "SELECT * FROM private_coach_appointment where matric_number = '".$userid."' ";
	$resultprivate = $db->query($sqlprivate);
	$num_results_p = $resultprivate->num_rows;
	
	
	//print personal training schedule
	//member does not register any courses
	if ($num_results_c == 0 && $num_results_p == 0) { 
	echo "<p>You have not registed any courses.</p>";
	echo "<p>You could go to <a href=\"courseregister3.php\">COURSE</a> or <a href=\"appointment3.php\">PERSONAL TRAINING</a> to regist courses.</p>";
	echo "<p>Thank you for visiting NTU Fitness Factory! Wish you a nice training journey here!</p>";
	
     } else {
	echo "<p style=\"text-align:left; color:white;\">This is your personal training schedule for this week.</p>";
	echo "<p style=\"text-align:left; color:white;\">You have registered <span style=\"color:#6495ED; font-weight:bold;\">".$num_results_c." </span> COURSES and <span style=\"color:#6495ED; font-weight:bold;\">".$num_results_p." </span>PRIVATE TRAINING.</p>";   
	// Print information 
	echo "<table bordercolor=\"#6495ED\" align=\"center\"> ";
	echo "<caption><font color=white>Your Personal Schedule - Courses: </font></caption> ";   
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
// 	｝
		
		echo "<br/>";
		echo "<br/>";
		
		// print private training table
		//if ($num_results_p!=0) 
		 //{
		echo "<table bordercolor=\"#6495ED\" align=\"center\"> ";
	    echo "<caption><font color=white>Your Personal Schedule - Private Training: </font></caption> ";  
	    
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
		//｝
	}
	}
	
		
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