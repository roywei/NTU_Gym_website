<?php
	// Inialize session
	session_start();
?>
   <?php

    // Check login or not
	if( isset($_SESSION["userid"]) )
		{		
		echo "<h2 style=\"text-align:center; color:#6495ED;\">Dear ".$_SESSION['membername'].", you have logged in.</h2>";
		
		
		header("Refresh: 3; Location:index.php");
		header("Location:index.php");
		exit;
		}
?>   
<!DOCTYPE html>
<html lang="en">
<head>
<title>Register</title>
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
<input id="namanyay-search-btn" value="Search" type="submit" name="search_submit"/>
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
  <div id="wrapper_form">

<!--script to do form validation-->  
<script id='script1' src="register.js"></script>
<script id='script2' src="utilities.js"></script>
<script  id='script3' src="errorMessages.js"></script> 

<!--form to register as member-->
<h1>Register as Member</h1>
<form action="newmember.php" method="post" id="theForm">
<p>All fields are required.</p>

<div><label for="name">Name </label><input type="text" name="name" id="name" required></div>
<div><label for="matric_number">User Name(Matric No.): </label><input type="text" name="matric_number" id="matric_number" required></div>
<div><label for="initial">Your password </label><input type = "password" id = "initial" name="initial" size = "10" required></div>
<div><i><small>*Note: Your password must contain 3-10 characters,at least 1 uppercase,1 lowercase, 1 number</small></i></div>
<div><label for="second">Confirm your password</label><input type = "password" id = "second"  name="second" size = "10" required></div>
<div><label for="email">E-mail: </label><input type="text" name="email" id="email" required></div>
<div><label for="gender">Gender</label><select name="gender" id="gender" required>
				<option value="">Gender</option> 
				<option value="M">Male</option> 
				<option value="F">Female</option> 
</select></div>
<div><label for="bdate">Date of birth</label> <input type="date" name="bdate" id="bdate" required></div>
<div><label for="phone">Phone</label><input type="text" name="phone" id="phone" required></div>
<div><label for="school">School </label><input type="text" name="school" id="school" required></div>				
<div><label for="address">Address</label><input type="text" name="address" id="address" required></div>				
<div><input type="checkbox" name="terms" id="terms" required> I agree to the terms, whatever they are.</div>
<div><input type="submit" value="Register" id="submit" name="submit"><input type="reset" value="Reset"> </div>
</form>


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