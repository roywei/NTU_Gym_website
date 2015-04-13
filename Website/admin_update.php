<?php
	// Inialize session
	session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Admin Update</title>
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

  @ $db = new mysqli('localhost', 'f33s28', 'weilai729', 'f33s28');

  if (mysqli_connect_errno()) {
     echo "Error: Could not connect to database.  Please try again later.";
     exit;
  }

    
// for admin to update tables in database
if (isset($_SESSION["userid"]) ){
   
    
    echo "<h1 style=\"text-align:left; color:#6495ED;\"><span style=\"color:white; font-weight:normal;\">Dear </span>Administrator,</h1>";
    echo "<p style=\"text-align:left; color:white;\">Please fill in the form to update.</p>";
     
}
 
			
	$db->close();
?>

<!-- this is form to update tables -->
<form action="admin_update_result.php" method="post" id="theForm">
<table align="center"> 
		<caption><font color="#6495ED">Update Tables in Database</font></caption> 
<tr>
    <td style="border:0">ID:</td>
    <td style="border:0">
    <select name="id" id="id">
    <option value="nochoice">Please select Course ID or Private Trainer ID</option>
     <option value="ABS1">ABS1 Aerobics Body Step </option>
     <option value="ABC2">ABC2 Aerobics Body Combat </option>
     <option value="YHY3">YHY3 Yoga Hatha Yoga </option>
     <option value="YDY4">YDY4 Yoga Dynamic Yoga </option>
     <option value="WL1">WL1 Aerobics Body Step</option>
     <option value="ZX2">ZX2 Aerobics Body Combat</option>
     <option value="ZB3">ZB3 Yoga Hatha Yoga</option>
    </select>
    </td>     
</tr>
<tr>
    <td style="border:0">Updated Training Date and Time</td>
    <td style="border:0"><input type="date" id="date" name="date"></td>
    <td style="border:0"><input type="time" id="time" name="time"></td>  
</tr>
<tr>
    <td style="border:0">Updated Vacancy</td>
    <td style="border:0"><input type="number" id="newvacancy" name="newvacancy" min="1" max="10"></td> 
</tr>

<tr>
    <td style="border:0" colspan="2"><input type="submit" value="Submit">&nbsp;&nbsp;&nbsp;&nbsp;
    <input type="reset" value="Reset">
    </td>
</tr>
</table>
</form>


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