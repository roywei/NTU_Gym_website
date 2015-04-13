<?php
	// Inialize session
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Course Registration</title>
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
  

  @ $db = new mysqli('localhost', 'f33s28', 'weilai729', 'f33s28');


  if (mysqli_connect_errno()) {
     echo 'Error: Could not connect to database.  Please try again later.';
     exit;
  }

	$sqlcourse = "SELECT * FROM courses where course_id = \"ABC2\" ";
	$result = $db->query($sqlcourse);
	$row = $result->fetch_assoc();
	
	$courseid = $row['course_id'];
	$name = $row['course_name'];
	$duration = $row['course_duration'];
	$time = $row['course_time'];
	$venue = $row['course_venue'];
	$vacancy = $row['vacancy'];
	
   echo "<p style=\"text-align:left; color:white;\">This is our training schedule for this week.</p>";
   
	    // Print information  
		echo "<table bordercolor=\"#6495ED\"> ";
	    echo "<caption><font color=\"#6495ED\">Courses Schedule</font></caption> ";  
	    
	    echo "<tr bgcolor=\"#6495ED\">";
	    echo " <th>Course ID</th> ";
		echo " <th>Course Name</th>";
        echo " <th>Course Duration (hour)</th>";
        echo " <th>Starting Time</th>";
        echo " <th>Course Venue</th> ";
		echo " <th>Number of vacancy </th>";
		echo " <th>Register Course</th>";
        echo "</tr>";
       
	    echo "<tr>";
	    echo " <td>".$courseid."</td>";
        echo " <td>".$name."</td>";
        echo " <td>".$duration."</td>";
        echo " <td>".$time."</td>";
        echo " <td>".$venue."</td>";
		echo " <td>".$vacancy."</td>";
		echo "<td>";
		echo "<form action=\"courseregister.php\" method=\"get\" > ";
		echo "<button name=\"courseid\" id=\"".$courseid."\" type=\"submit\" value=\"".$courseid."\">REGISTER</button>";
		echo "</form>"; 
		echo "</td>";
        echo "</tr>";
        
	$sqlcourse = "SELECT * FROM courses where course_id = \"ABS1\" ";
	$result = $db->query($sqlcourse);
	$row = $result->fetch_assoc();
	
	$courseid = $row['course_id'];
	$name = $row['course_name'];
	$duration = $row['course_duration'];
	$time = $row['course_time'];
	$venue = $row['course_venue'];
	$vacancy = $row['vacancy'];          
		echo "<tr>";
		echo " <td>".$courseid."</td>";
        echo " <td>".$name."</td>";
        echo " <td>".$duration."</td>";
        echo " <td>".$time."</td>";
        echo " <td>".$venue."</td>";
		echo " <td>".$vacancy."</td>";
		echo "<td>";
		echo "<form action=\"courseregister.php\" method=\"get\" > ";
		echo "<button name=\"courseid\" id=\"".$courseid."\" type=\"submit\" value=\"".$courseid."\">REGISTER</button>";
		echo "</form>"; 
		echo "</td>";
        echo "</tr>";
		
	$sqlcourse = "SELECT * FROM courses where course_id = \"YDY4\" ";
	$result = $db->query($sqlcourse);
	$row = $result->fetch_assoc();
	
	$courseid = $row['course_id'];
	$name = $row['course_name'];
	$duration = $row['course_duration'];
	$time = $row['course_time'];
	$venue = $row['course_venue'];
	$vacancy = $row['vacancy'];
	 
        echo "<tr>";
	    echo " <td>".$courseid."</td>";
        echo " <td>".$name."</td>";
        echo " <td>".$duration."</td>";
        echo " <td>".$time."</td>";
        echo " <td>".$venue."</td>";
		echo " <td>".$vacancy."</td>";
		echo "<td>";
		echo "<form action=\"courseregister.php\" method=\"get\" > ";
		echo "<button name=\"courseid\" id=\"".$courseid."\" type=\"submit\" value=\"".$courseid."\">REGISTER</button>";
		echo "</form>"; 
		echo "</td>";
        echo "</tr>";
        
	$sqlcourse = "SELECT * FROM courses where course_id = \"YHY3\" ";
	$result = $db->query($sqlcourse);
	$row = $result->fetch_assoc();
	
	$courseid = $row['course_id'];
	$name = $row['course_name'];
	$duration = $row['course_duration'];
	$time = $row['course_time'];
	$venue = $row['course_venue'];
	$vacancy = $row['vacancy'];          
		echo "<tr>";
		echo " <td>".$courseid."</td>";
        echo " <td>".$name."</td>";
        echo " <td>".$duration."</td>";
        echo " <td>".$time."</td>";
        echo " <td>".$venue."</td>";
		echo " <td>".$vacancy."</td>";
		echo "<td>";
		echo "<form action=\"courseregister.php\" method=\"get\" > ";
		echo "<button name=\"courseid\" id=\"".$courseid."\" type=\"submit\" value=\"".$courseid."\">REGISTER</button>";
		echo "</form>"; 
		echo "</td>";
        echo "</tr>";	
		echo "</table>";
		
	
$db->close();
?>
	<br/>

<form action="courseregister.php" method="get" id="theForm">
<table align="center"> 
		<caption><font color="#6495ED">Course Registration</font></caption> 

<tr>
    <td style="border:0">Course ID:</td>
    <td style="border:0">
    <select name="courseid" id="courseid">
    <option value="nochoice">Please select your Course ID</option>
     <option value="ABS1">ABS1 Aerobics Body Step </option>
     <option value="ABC2">ABC2 Aerobics Body Combat </option>
     <option value="YHY3">YHY3 Yoga Hatha Yoga </option>
     <option value="YDY4">YDY4 Yoga Dynamic Yoga </option>
    </select>
    </td>     
</tr>
<tr>
    <td style="border:0" colspan="2"><input type="submit" value="Submit">&nbsp;&nbsp;&nbsp;&nbsp;<input type="reset" value="Reset"> 
    </td>
</tr>
</table>
</form>


<br>
  <h2 style="color:#6495ED; font-weight:bold;">Gentle Reminder:</h2>
   <p>Availability of each Course ID is subject to the VACANCY.</p>
    <p>Each member account can only register particular Course ID for one time.</p>
     <p>You could deregister courses just 2 hours before the starting time.</p>
   <p>Please come to the class on time and follow the instructions to get propper preparation.</p>
  <p>Thank you so much for visiting NTU Fitness Factory. We wish you a nice training journey!</p>
<br>
<br>

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