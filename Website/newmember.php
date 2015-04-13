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
  
  $name=$_POST['name'];
  $matric_number=$_POST['matric_number'];
  $password=$_POST['initial'];
  $email=$_POST['email'];
  $gender=$_POST['gender'];
  $school=$_POST['school'];
  $address=$_POST['address'];
  $birth_date=$_POST['bdate'];
  $phone=$_POST['phone'];
 
  
  if (!get_magic_quotes_gpc()) {
    $name = addslashes($name);
    $matric_number = addslashes($matric_number);
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


	$sql = "SELECT * FROM member where matric_number = '".$matric_number."' ";
    $checkmember = $db->query($slq);
	$ismember = $checkmember->num_rows;
	if ($ismember == 0 ) {
    $query = "insert into member( matric_number, name, password,gender,birth_date,school,address,email, phone) values('".$matric_number."','".$name."', '".$password."', '".$gender."','".$birth_date."','".$school."','".$address."','".$email."','".$phone."')";
	$result = $db->query($query);
	if ($result) {
      echo  $db->affected_rows." Registration Successful.<br>";
	  echo "Your Registered info is as follows:<br>";
	  echo"<div><table border=\"1\" bordercolor=\"#6495ED\" font color=\"#6495ED\">";
	  echo" <tr><td width=\"200\">User ID</td><td>".$matric_number."</td></tr>";
	  echo" <tr><td width=\"200\">Name</td><td>".$name."</td></tr>";
	  echo" <tr><td width=\"200\">Gender</td><td>".$gender."</td></tr>";
	  echo" <tr><td width=\"200\">Date of Birth</td><td>".$birth_date."</td></tr>";
	  echo" <tr><td width=\"200\">School</td><td>".$school."</td></tr>";
	  echo" <tr><td width=\"200\">Address</td><td>".$address."</td></tr>";
	  echo" <tr><td width=\"200\">Email</td><td>".$email."</td></tr>";
	  echo" <tr><td width=\"200\">Phone</td><td>".$phone."</td></tr></table>";
	  echo" You Can Change Your Personal Info at <a href=\"member.php\">View/Edit Personal Info</a><br></div>";
	  
	} else {
  	  echo "An error has occurred.  You are not registered.";
	}
	}
	else if ($ismember != 0 ) {
	echo "<h2>Sorry, Updating your info is unsuccessful.</h2>";
	echo "<p>You have already registered! You can not register twice.</p>";
     }
	

  

$db->close();
?>

</div>
</div>
</div> 

<div>
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