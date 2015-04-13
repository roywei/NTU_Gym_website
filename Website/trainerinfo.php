<?php
	// Inialize session
	session_start();
?>
<html>
<head>
<title>Trainer Information</title>
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
    <img src="SubBanner_Trainer.png" width="800" height="287" alt="SubBanner_Trainer">
	<div id="content">
	<h1><font color="#6495ED">Why Personal Trainers?</font></h1>
	<img src="personal_trainer.jpg" width="320" height="220" id="floatright" alt="Personla Trainers">
	<p>Personal trainers are fitness professional involved in exercise prescription and instruction. 
	They motivate clients by setting goals and providing feedback and accountability to clients. 
	Trainers also measure their client's strengths and weaknesses with fitness assessments. 
	These fitness assessments may also be performed before and after an exercise program to measure their client's improvements in physical fitness. 
	They may also educate their clients in many other aspects of wellness besides exercise, including general health and nutrition guidelines. 
	Qualified personal trainers recognize their own areas of expertise. 
	<br/>
	NTU Fitness Factory has got an excellent trainer team to fulfil various of members' requirements. 
	Most of them have got professional training experience, powerful certifications and international awards. 
	Come and register our professional trainer courses.
	<br/>
	<h1><font color="#6495ED">Trainers' Profiles</font></h1> 
	<img src="trainer1.jpg" width="140" height="180" id="floatleft" alt="Trainer 1"> 
	<p>
	<h2><font color="#6495ED">&nbsp;&nbsp;&nbsp;Wei Lai</font></h2>
	<br/>
	<li>Trainer ID: WL1</li>
	<li>Training Field: Aerobics, power</li>
	<li>Certificates: Trainer A level</li>
	<li>Experience: 10 years</li>
	<li>Phone: 12345678 </li>
	<li>Email: abc_fitness@gmail.com </li>
	<br/><br/>
	</p>
	<img src="trainer2.jpg" width="140" height="180" id="floatleft" alt="Trainer 2"> 
	<p>
	<h2><font color="#6495ED">&nbsp;&nbsp;&nbsp;Zhang Bo</font></h2>
	<br/>
	<li>Trainer ID: ZB3</li>
	<li>Training Field: Yoga, Body Fit</li>
	<li>Certificates: International professional yoga certificate, First class trainer</li>
	<li>Experience: Learning Yoga in India for three years and Training experience in Singapore for five years.</li>
	<li>Phone: 12345678 </li>
	<li>Email: abc_fitness@gmail.com </li>
	<br/><br/>
	</p>
	<img src="trainer3.jpg" width="140" height="180" id="floatleft" alt="Trainer 3"> 
	<p>
	<h2><font color="#6495ED">&nbsp;&nbsp;&nbsp;Zeng Xinyi</font></h2>
	<br/>
	<li>Trainer ID: ZX2</li>
	<li>Training Field: Power, Building muscle</li>
	<li>Certificates: Trainer A level</li>
	<li>Experience: 8 years in China</li>
	<li>Phone: 12345678 </li>
	<li>Email: abc_fitness@gmail.com </li>
	<br/><br/>
	</p>
	
<!-- Data should be got from database-->
	<?php
  

  @ $db = new mysqli('localhost', 'f33s28', 'weilai729', 'f33s28');


  if (mysqli_connect_errno()) {
     echo 'Error: Could not connect to database.  Please try again later.';
     exit;
  }

	$sqltrainer = "SELECT * FROM private_trainer where private_trainer_id = \"WL1\" ";
	$result = $db->query($sqltrainer);
	$row = $result->fetch_assoc();
	
	$trainerid = $row['private_trainer_id'];
	$name = $row['trainer_name'];
	$duration = $row['training_duration'];
	$time = $row['available_training_time'];
	$price = $row['price'];
	$vacancy = $row['vacancy'];
	
   
	    // Print information  
		echo "<table bordercolor=\"#6495ED\"> ";
	    echo "<caption><font color=\"#6495ED\">Personal Trainer Schedules</font></caption> ";  
	    
	    echo "<tr bgcolor=\"#6495ED\">";
	    echo " <th>Private Trainer ID</td> ";
		echo " <th>Trainer Name</td>";
        echo " <th>Training Duration (hour)</td>";
        echo " <th>Training Time</td>";
        echo " <th>Price/hour</td> ";
		echo " <th>Number of vacancy </td> ";
		echo " <td>Registration</td> ";
        echo "</tr>";
       
	    echo "<tr>";
	    echo " <td>".$trainerid."</td>";
        echo " <td>".$name."</td>";
        echo " <td>".$duration."</td>";
        echo " <td>".$time."</td>";
        echo " <td>".$price."</td>";
		echo " <td>".$vacancy."</td>";
		echo " <td><a href=\"appointment3.php\">REGISTER</a></td>";
        echo "</tr>";
        
	$sqltrainer = "SELECT * FROM private_trainer where private_trainer_id = \"ZB3\" ";
	$result = $db->query($sqltrainer);
	$row = $result->fetch_assoc();
	
	$trainerid = $row['private_trainer_id'];
	$name = $row['trainer_name'];
	$duration = $row['training_duration'];
	$time = $row['available_training_time'];
	$price = $row['price'];
	$vacancy = $row['vacancy'];        
		echo "<tr>";
	    echo " <td>".$trainerid."</td>";
        echo " <td>".$name."</td>";
        echo " <td>".$duration."</td>";
        echo " <td>".$time."</td>";
        echo " <td>".$price."</td>";
		echo " <td>".$vacancy."</td>";
		echo " <td><a href=\"appointment3.php\">REGISTER</a></td>";
        echo "</tr>";
		
	
		
	$sqltrainer = "SELECT * FROM private_trainer where private_trainer_id = \"ZX2\" ";
	$result = $db->query($sqltrainer);
	$row = $result->fetch_assoc();
	
	$trainerid = $row['private_trainer_id'];
	$name = $row['trainer_name'];
	$duration = $row['training_duration'];
	$time = $row['available_training_time'];
	$price = $row['price'];
	$vacancy = $row['vacancy'];        
		echo "<tr>";
	    echo " <td>".$trainerid."</td>";
        echo " <td>".$name."</td>";
        echo " <td>".$duration."</td>";
        echo " <td>".$time."</td>";
        echo " <td>".$price."</td>";
		echo " <td>".$vacancy."</td>";
		echo " <td><a href=\"appointment3.php\">REGISTER</a></td>";
        echo "</tr>";
		
		echo "</table>";
		
$db->close();
?>
	<br/>
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