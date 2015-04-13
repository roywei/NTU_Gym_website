<?php
	// Inialize session
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Schedule Appointment</title>
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
	<?php
  

  @ $db = new mysqli('localhost', 'f33s28', 'weilai729', 'f33s28');


  if (mysqli_connect_errno()) {
     echo 'Error: Could not connect to database.  Please try again later.';
     exit;
  }

   echo "<p style=\"text-align:left; color:white;\">This is our training schedule for this week.</p>";
   echo "<p style=\"color:#6495ED; font-weight:bold;\">Hot Promotion: Register more than one Private Training, you will get 20% off.</h1>";


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
		echo "<table bordercolor=\"#6495ED\" align=\"center\"> ";
	    echo "<caption><font color=\"#6495ED\">Personal Trainer Schedules</font></caption> ";  
	    
	    echo "<tr bgcolor=\"#6495ED\">";
	    echo " <th>Private Trainer ID</td> ";
		echo " <th>Trainer Name</td>";
        echo " <th>Training Duration (hour)</td>";
        echo " <th>Training Time</td>";
        echo " <th>Price/hour</td> ";
		echo " <th>Number of Vacancy </td> ";
        echo "</tr>";
       
	    echo "<tr>";
	    echo " <td>".$trainerid."</td>";
        echo " <td>".$name."</td>";
        echo " <td>".$duration."</td>";
        echo " <td>".$time."</td>";
        echo " <td>".$price."</td>";
		echo " <td>".$vacancy."</td>";
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
        echo "</tr>";
		
		echo "</table>";
		
$db->close();
?>
<br/>

<form action="appointment.php" method="post" id="theForm">
<table align="center"> 
		<caption><font color="#6495ED">Register for Private Trainers</font></caption> 
<tr>
    <td style="border:0">Private Trainer ID:</td>
    <td style="border:0">
    <select name="privateid" id="privateid">
    <option value="nochoice">Please select your Private Trainer ID</option>
     <option value="WL1">WL1 Aerobics Body Step</option>
     <option value="ZX2">ZX2 Aerobics Body Combat</option>
     <option value="ZB3">ZB3 Yoga Hatha Yoga</option>
    </select>
    </td>     
</tr>
<tr>
    <td style="border:0">Personal Training Hours:</td>
    <td style="border:0">
    <select name="trainhr" id="trainhr">
    <option value="1">1 hour</option>
     <option value="2">2 hours</option>
     <option value="3">3 hours</option>
    </select>
    </td>     
</tr>
<tr> 
     <td align="right" valign="top">Any message to trainer?</td>
     <td><textarea name="comments" id="comments" rows="4" cols="40" ></textarea></td>
  </tr>
<tr>
    <td style="border:0" colspan="2"><input type="submit" value="Submit">&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="reset" value="Reset">
    </td>
</tr>
</table>
</form>
	
	

<br>
  <h2 style="color:#6495ED; font-weight:bold;">Gentle Reminder:</h2>
   <p>Availability of each Private Trainer ID is subject to the VACANCY.</p>
   <p>Any Private Trainer ID can only be registered ONE day before the starting time.</p>
    <p>Each member account can only register particular Private Trainer ID for one time.</p>
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