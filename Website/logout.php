<?php
	// Inialize session
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>LOG OUT</title>
<meta charset="utf-8">
<link rel="stylesheet" href="csshome.css">
</head>


<div id="wrapper">
<br>
<div id="headerleft">

		<!--  To display user's name if logged in   -->			
<span style="text-align:right;"><a href="login_form.php">LOG IN&nbsp;&nbsp;&nbsp;｜</a>&nbsp;&nbsp;&nbsp;<a href="register_form.php">REGISTER</a></span>	
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
	<div id="content_login" >
            
        <?php

    // Check login or not
    if (!isset($_SESSION["userid"])) {
     echo "<script language=javascript>alert('You have not logged in.  Please log in.')</script>";  
     echo "<h2 style=\"text-align:center; color:#6495ED;\">Sorry, your registration is NOT successful.</h2>"; 
     echo "<p>If you are member, please log in using your registered Matric No.</p>";
	 echo "<p>If you are not member, please go to <a href=\"member.html\">MEMBER</a> for registration.</p>";
	 echo "<p>Thank you for visiting NTU Fitness Factory! Wish you a nice training journey here!</p>";
     exit;
  }
	if (isset($_SESSION["userid"])){		
		//get log in status in table MEMBER
		
		@ $db = new mysqli('localhost', 'f33s28', 'weilai729', 'f33s28');
		
        if (mysqli_connect_errno()) {
        echo "Error: Could not connect to database.  Please try again later.";
         exit;
         }
        
        $query_ = "SELECT * FROM member where matric_number = '".$_SESSION["userid"]."' AND password ='".$_SESSION["password"]."'";
        $result_ = $db->query($query_);
	     $row = $result_->fetch_assoc();
	     $membername = $row['name'];
	     $islogin = $row['islogin'];
	     
	     //update the log in status in table MEMBER
		$islogin=0;
	    $query_update = "UPDATE member SET islogin  = '".$islogin."' WHERE matric_number = '".$_SESSION["userid"]."'";
	    $result_update = $db->query($query_update);
    
		
		//set session data to an empty array
		 $_SESSION = array();

 		//destroy the session
 		session_destroy();

		echo "<h2 style=\"text-align:center; color:#6495ED;\">You have logged out.</h2>";
		
	
	
}
	
?>	
          
    </div>
    
	<!-- flash banner-->
	<object width="1000" height="450" data="banner.swf" ></object>
	
	<div id="content" >
	<h1>About Us</h1>
	<p>
	NTU Fitness Factory is a website designed for the gym center in Nanyang Technological University. This website will publish information to introduce the gym center and to attract NTU students and staff to join as members. 
	Since only registered members can utilize the registration service on this web application, users can register their member accounts or update their personal information. Secondly, users can view brief introduction for each fitness class and the weekly updated schedule. Members can register any courses simply by typing in the respective Course ID. Thirdly, this web application also intends to provide online appointment with private fitness trainer. Members can book one-to-one training session with their interested coach. Besides the registration service, members also can cancel the registered courses, in this way, other members will have chance to join fully booked classes. In summary, NTU Fitness Factory will become the one-stop solution for all NTU staff and students who want to have a fit body.
	</p>
<script>
  (function() {
    var cx = '010018886858764730720:0f6vzxjg0hm';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
        '//www.google.com/cse/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
  })();
</script>
<gcse:search></gcse:search>
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
	<img src="map.png" height="200" width="379" align="right" alt="map">
	<p>
	Phone: (+65)87654321<br><br>
	Email: <a href="mailto:ntufitnessfactory@ntufitnessfactory.com" id="a">ntufitnessfactory@ntufitnessfactory.com</a><br><br>
	Location: 21 Nanyang Circel<br><br>
	Opening Hour: 09:00-22:00<br><br>
	<p>
	
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