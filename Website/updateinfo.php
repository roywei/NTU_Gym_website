<?php
	// Inialize session
	session_start();
?>
<html>
<head>
<title>Member Registration Results</title>
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
  
  $name=$_POST['name2'];
  $password=$_POST['initial'];
  $email=$_POST['email2'];
  $gender=$_POST['gender2'];
  $school=$_POST['school2'];
  $address=$_POST['address2'];
  $birth_date=$_POST['bdate2'];
  $phone=$_POST['phone2'];
  
  if (!get_magic_quotes_gpc()) {
    $name = addslashes($name);
    $password = addslashes($password);
	$email = addslashes($email);
	$gender = addslashes($gender);
	$school = addslashes($school);
	$address = addslashes($address);
	$phone = intval($phone);
  }

  @ $db = new mysqli('localhost', 'f33s28', 'weilai729', 'f33s28');

  if (mysqli_connect_errno()) {
     echo "Error: Could not connect to database.  Please try again later.";
     exit;
  }
  
 if (!isset($_SESSION["userid"])) { 
     echo "<h2 style=\"text-align:center; color:#6495ED;\">Sorry you hava not logged in.</h2>"; 
     echo "<p>If you are member, please log in using your registered Matric No.</p>";
	 echo "<p>If you are not member, welcome to <a href=\"register_form.php\">JOIN US</a>!</p>";
	 echo "<p>Thank you for visiting NTU Fitness Factory! Wish you a nice training journey here!</p>";
	 echo "<script language=javascript>alert('You have not logged in. Please log in.')</script>"; 
     exit;
  }
	$query_ = "SELECT * FROM member where matric_number = '".$_SESSION["userid"]."' AND password ='".$_SESSION["password"]."'";
    $result_ = $db->query($query_);
	$row = $result_->fetch_assoc();
	$membername = $row['name'];
	
	
	if (isset($_SESSION["userid"])){
	
    echo "<h1 style=\"text-align:center; color:#6495ED;\">Dear ".$_SESSION["membername"].",</h1>";	
	 if (!$name && !$email && !$gender && !$school && !$address && !$phone) {
     echo 'You have not entered any info, nothing is changed!';
     exit;
	 }
	 if ($name){
	 $query2 = " update member set name= '".$name."' where matric_number= '".$_SESSION["userid"]."'";
	 $result2 = $db->query($query2);
	 if($result2){
	 echo "<p>Your name has been updated to ".$name."!</p>";
	}
	 }
	 if ($email){
	 $query3 = " update member set email= '".$email."' where matric_number= '".$_SESSION["userid"]."'";
	 $result3 = $db->query($query3);
	  if($result3){
	 echo "<p>Your email has been updated to ".$email."!</p>";
	}
	 }
	if ($gender){
	 $query4= " update member set gender= '".$gender."' where matric_number= '".$_SESSION["userid"]."'";
	 $result4 = $db->query($query4);
	  if($result4){
	 echo "<p>Your gender has been updated to ".$gender." !</p>";
	}
	 }
	 if ($school){
	 $query5= " update member set school= '".$school."' where matric_number= '".$_SESSION["userid"]."'";
	 $result5 = $db->query($query5);
	  if($result5){
	echo "<p>Your school has been updated to ".$school."!</p>";
	}
	 }
	 if ($address){
	 $query6= " update member set address= '".$address."' where matric_number= '".$_SESSION["userid"]."'";
	 $result6 = $db->query($query6);
	  if($result6){
	 echo "<p>Your address has been updated to ".$address."!</p>";
	}
	 }
	 if ($phone){
	 $query7= " update member set phone= '".$phone."' where matric_number= '".$_SESSION["userid"]."'";
	 $result7 = $db->query($query7);
	  if($result7){
	 echo "<p>Your phone has been updated to ".$phone."!</p>"; 
}
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