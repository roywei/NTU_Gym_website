<?php
	// Inialize session
	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>NTU Fitness Factory</title>
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
	<!-- flash banner-->
	<object width="1000" height="450" data="banner.swf" ></object>
	
	<div id="content" >
	<h1>About Us</h1>
	<p>
	NTU Fitness Factory is a website designed for the gym center in Nanyang Technological University. This website will publish information to introduce the gym center and to attract NTU students and staff to join as members. 
	Since only registered members can utilize the registration service on this web application, users can register their member accounts or update their personal information. Secondly, users can view brief introduction for each fitness class and the weekly updated schedule. Members can register any courses simply by typing in the respective Course ID. Thirdly, this web application also intends to provide online appointment with private fitness trainer. Members can book one-to-one training session with their interested coach. Besides the registration service, members also can cancel the registered courses, in this way, other members will have chance to join fully booked classes. In summary, NTU Fitness Factory will become the one-stop solution for all NTU staff and students who want to have a fit body.
	</p>

	<h1>Photo Gallery</h1>
	
	<img src="gallery1.jpg" height="300" width="480" id="img" align="left" alt="gallery1">
	<img src="gallery2.jpg" height="300" width="480" id="img" align="right"alt="gallery2">
	<img src="gallery3.jpg" height="300" width="480" id="img" align="left" alt="gallery3">
	<img src="gallery4.jpg" height="300" width="480" id="img" align="right" alt="gallery4">
	
	<p>
	NTU Fitness Factory is a website designed for the gym center in Nanyang Technological University. This website will publish information to introduce the gym center and to attract NTU students and staff to join as members. 
	Since only registered members can utilize the registration service on this web application,
	</p>
	
	<h1>Contact Us</h1>
	<!--google map-->
	<iframe align="right" width="300" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com.sg/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=ntu+hall+6&amp;aq=&amp;sll=1.346305,103.68115&amp;sspn=0.116697,0.195179&amp;ie=UTF8&amp;t=m&amp;ll=1.345637,103.68345&amp;spn=0.006436,0.006437&amp;z=16&amp;output=embed"></iframe><br /><p>
	Phone: (+65)87654321<br><br>
	Email: <a href="mailto:ntufitnessfactory@ntufitnessfactory.com" id="a">ntufitnessfactory@ntufitnessfactory.com</a><br><br>
	Location: 21 Nanyang Circle<br><br>
	Opening Hour: 09:00-22:00<br><br>
	<p>	
	<br><br><br><br>
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