<?php
	// Inialize session
	session_start();
?>
<html lang="en">
<head>
<title>NTU Fitness Factory</title>
<meta charset="utf-8">
<link rel="stylesheet" href="csshome.css">
</script>
</head>

<div id="wrapper">
<br>
<div id="headerleft"><?php

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
&nbsp	
<!-- Search box //-->
<form id="searchthis" action="search.php" style="display:inline;" method="post">
<input id="namanyay-search-box" name="s" size="40" type="text" placeholder="Enter Courses/Trainer"/>
<input id="namanyay-search-btn" value="Search" type="submit"/>

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
	<div id="content" >
	<h1>Your Search Result:
	</h1>
	<?php
	
	$output='';
	
	@ $db = new mysqli('localhost', 'f33s28', 'weilai729', 'f33s28');

	if (mysqli_connect_errno()) {
     echo "Error: Could not connect to database.  Please try again later.";
     exit;
	}
	
	if(!empty($_POST["s"])){ 
		$search = $_POST["s"];
		$search = preg_replace("#[^0-9a-z]#i","",$search);
		
		$search_db = "SELECT * FROM courses WHERE course_name LIKE '%$search%' ";
		$search_result = $db->query($search_db);
		$search_num = $search_result->num_rows;
		
		$search_db2 = "SELECT * FROM private_trainer WHERE trainer_name LIKE '%$search%' ";
		$search_result2 = $db->query($search_db2);
		$search_num2 = $search_result2->num_rows;
		
		if($search_num==0  && $search_num2==0){
			$output = 'There was no search result';
			print("$output");
		}
		else{
			for($i=1; $i<=$search_num; $i++){
				$row	= $search_result->fetch_assoc();
				$id		= $row['course_id'];
				$course = $row['course_name'];
				$hour	= $row['course_duration'];
				$time	= $row['course_time'];
				$venue	= $row['course_venue'];
				$output ='Result'.$i.': Course name is '.$course.',<br>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Time is '.$time.',<br>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Duration is '.$hour.',<br>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Venue is '.$venue.'.<br><br>';
				print("$output");
			}
			if($search_num!=0){
				echo"For more courses info, please visit <a href=\"courseinfo.php\">Course Info</a><br><br>";
			}
			
			for($i=1; $i<=$search_num2; $i++){
				$row2	 = $search_result2->fetch_assoc();
				$trainer = $row2['trainer_name'];
				$time2	 = $row2['available_training_time'];
				$hour2	 = $row2['training_duration'];
				$price	 = $row2['price'];
				$output ='Result'.$i.': Trainer name is '.$trainer.',<br>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Time is '.$time2.',<br>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Maximum duration is '.$hour2.',<br>&nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp &nbsp Price is '.$price.'/hour.<br><br>';
				print("$output");
			}
			
			if($search_num2!=0){
				echo"For more trainer info, please visit <a href=\"trainerinfo.php\">Trainer Info</a><br><br>";
			}
		}
		
		
		
	}
	
	else {
		echo"You have not entered any key word!";
	}
	
	
	?>
	</div> 
		
	<!-- footer for website-->
	<footer>
	<small><i>Copyright &copy; 2013 NTU Fitness Factory</i></small><br>
	Email: <a href="mailto:ntufitnessfactory@ntufitnessfactory.com" id="a">ntufitnessfactory@ntufitnessfactory.com</a>     Phone: (+65)87654321      Location: 21 Nanyang Circle.
	</footer>
</div>
<!-- div for scrolling text and search box-->
	<script id='scroolingtext' src="scroolingtext.js"></script>
	<div id="scroolingtext" >
	<p id="tabledata" class="para"> message goes here</p>
	</div>
</body>
</html>