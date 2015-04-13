<?php
	// Inialize session
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Course Information</title>
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
	<h1><font color="#6495ED">Aerobics - Body Step</font></h1>
	<img src="Body-Step.jpg" width="320" height="220" id="floatright" alt="Body Step">
	<p>
	BODYSTEP™ is the energizing step workout that makes you feel liberated and alive, using a height-adjustable step and simple movements on, over and around the step. 
	Cardio blocks push fat burning systems into high gear followed by muscle conditioning tracks that shape and tone your body. 
	For those looking to increase the intensity and drive phenomenal results the circuit styled functional training of the BODYSTEP™ Athletic variation is ideal.
    <br/>
    <br/>
	Benefits:
	 <li> Burn lots of calories for a leaner body</li>
     <li> Improve your strength through core conditioning work</li>
     <li> Raise your overall fitness levels</li>
     <li> Improve your coordination</li>
     <li> Improve your bone health and density</li>
     <li> Increase your heart and lung capacity through a full-body cardio workout</li>
	</p>
	<br/>
	<h1><font color="#6495ED">Aerobics - Body Combat</font></h1>
	<img src="body_combat.jpg" width="320" height="220" id="floatright" alt="Body Combat">
	<p>
	BODYCOMBAT™ is the empowering cardio workout where you are totally unleashed. 
	This fiercely energetic program is inspired by martial arts and draws from a wide array of disciplines such as karate, boxing, taekwondo, tai chi and muay thai. 
	Supported by driving music and powerful instructors, you’ll strike, punch, kick and kata your way through calories to superior cardio fitness. <br/>
	<br/>
	Benefits:
	 <li> Gets you fighting fit and looking ripped</li>
     <li> Improves heart and lung function</li>
     <li> Tones and shapes key muscle groups</li>
     <li> Improves posture, core strength and stability</li>
     <li> Builds self-confidence, strength and power</li>
     </p>
	 
<!-- Data should be got from database-->
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
	
   
	    // Print information  
		echo "<table bordercolor=\"#6495ED\"> ";
	    echo "<caption><font color=\"#6495ED\">Body Step & Body Combat</font></caption> ";  
	    
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
	    echo " <td>".$courseid."</td>";
        echo " <td>".$name."</td>";
        echo " <td>".$duration."</td>";
        echo " <td>".$time."</td>";
        echo " <td>".$venue."</td>";
		echo " <td>".$vacancy."</td>";
		echo " <td><a href=\"courseregister3.php\">REGISTER</a></td>";
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
		
		echo " <td>".$courseid."</td>";
        echo " <td>".$name."</td>";
        echo " <td>".$duration."</td>";
        echo " <td>".$time."</td>";
        echo " <td>".$venue."</td>";
		echo " <td>".$vacancy."</td>";
		echo " <td><a href=\"courseregister3.php\">REGISTER</a></td>";
        echo "</tr>";
		
		echo "</table>";
		
$db->close();
?>
	<br/>
	<h1><font color="#F08080">Yoga - Dynamic Yoga</font></h1>
	<img src="dynamic_yoga.jpg" width="320" height="220" id="floatleft" alt="Dynamic Yoga">
	<p>Dynamic Yoga, based on the techniques of Astanga Vinyasa Yoga, is the fast, powerful form of yoga which has taken the yoga world by storm. 
	It is as effective a cardiovascular workout as a conventional exercise-to-music class.
	<br/>
	<br/>
	Benefits:
     <li> Improves heart and lung function</li>
     <li> Tones and shapes key muscle groups</li>
     <li> Improves posture, core strength and stability</li>
     <li> Builds self-confidence, strength and power</li>
     </p>
     <br/>
	<h1><font color="#F08080">Yoga - Hatha Yoga</font></h1>
	<img src="hatha_yoga.jpg" width="320" height="220" id="floatleft" alt="Hatha Yoga">
	<p>
	This form of yoga combines physical exercise and mental discipline, with the goal of integrating and invigorating both body and mind. 
	It has been shown that Hatha Yoga reduces stress, improve balance and flexibility, increase strength and reduce the risk of injury in daily life. It can reduce heart rate and blood pressure, and can help manage chronic diseases. Its psychological benefits can assist in weight loss by helping you to control appetite.
	<br/>
     </p>
	<?php
  
  @ $db = new mysqli('localhost', 'f33s28', 'weilai729', 'f33s28');


  if (mysqli_connect_errno()) {
     echo 'Error: Could not connect to database.  Please try again later.';
     exit;
  }

	$sqlcourse = "SELECT * FROM courses where course_id = \"YDY4\" ";
	$result = $db->query($sqlcourse);
	$row = $result->fetch_assoc();
	
	$courseid = $row['course_id'];
	$name = $row['course_name'];
	$duration = $row['course_duration'];
	$time = $row['course_time'];
	$venue = $row['course_venue'];
	$vacancy = $row['vacancy'];
	
   
	    // Print information  
		echo "<table bordercolor=\"#F08080\"> ";
	    echo "<caption><font color=\"#F08080\">Body Step & Body Combat</font></caption> ";  
	    
	    echo "<tr bgcolor=\"#F08080\">";
	    echo " <th>Course ID</td> ";
        echo " <th>Course Name</th>";
        echo " <th>Course Duration (hour)</th>";
        echo " <th>Starting Time</th>";
        echo " <th>Course Venue</th> ";
		echo " <th>Number of vacancy </td> ";
		echo " <td>Registration</td> ";
        echo "</tr>";
       
	    echo " <td>".$courseid."</td>";
        echo " <td>".$name."</td>";
        echo " <td>".$duration."</td>";
        echo " <td>".$time."</td>";
        echo " <td>".$venue."</td>";
		echo " <td>".$vacancy."</td>";
		echo " <td><a href=\"courseregister3.php\">REGISTER</a></td>";
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
		
		echo " <td>".$courseid."</td>";
        echo " <td>".$name."</td>";
        echo " <td>".$duration."</td>";
        echo " <td>".$time."</td>";
        echo " <td>".$venue."</td>";
		echo " <td>".$vacancy."</td>";
		echo " <td><a href=\"courseregister3.php\">REGISTER</a></td>";
        echo "</tr>";
		
		echo "</table>";
		
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