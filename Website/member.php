<?php
	// Inialize session
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<title>Member</title>
<meta charset="utf-8">
<link rel="stylesheet" href="csshome.css">
<style>
.error {color: #FF0000;}
</style>
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

<!-- PHP form validation-->
<?php
// define variables and set to empty values
$initialErr=$secondErr=$nameErr = $emailErr = $genderErr = $addressErr =$bdateErr=$phoneErr=$schoolErr ="";
$initial2=$second2=$name2 = $email2 = $gender2 = $school2 = $address2 =$phone2= $bdate2="";

//connect to databse
@ $db = new mysqli('localhost', 'f33s28', 'weilai729', 'f33s28');
	if (mysqli_connect_errno()) {
     echo "Error: Could not connect to database.  Please try again later.";
     exit;
  }
  
 //validate form values
if ($_SERVER["REQUEST_METHOD"] == "POST")
{	
	//check password
	if (empty($_POST["initial2"]) && empty($_POST["second2"]))
     {$initialErr = "Password is not updated";}
	
   else if ( !empty($_POST["initial2"]) && !empty($_POST["second2"]))
     {
     $initial2 = test_input($_POST["initial2"]);
	 $second2 = test_input($_POST["second2"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{3,10}$/",$initial2))
       {
       $initialErr = "Wrong Password Format"; 
       }
	  else if($initial2===$second2){
	  $updatepassword = " update member set password= '".$initial2."' where matric_number= '".$_SESSION["userid"]."'";
	  $passwordresult = $db->query($updatepassword);
	  if($passwordresult){
	  $initialErr = "Password updated"; 
	  }
	  }
	  
	 else{
	 $secondErr="Second input doesn't match with first!";
	 }
     }
	 
	else if(!empty($_POST["initial2"]) && empty($_POST["second2"])){
	
	$secondErr="Please confirm password";
	
	}
	
	else{
	$initialErr = "Please input password"; 
	}
	
	
	//check name
   if (empty($_POST["name2"]))
     {$nameErr = "Name is not updated";}
   else
     {
     $name2 = test_input($_POST["name2"]);
     // check if name only contains letters and whitespace
     if (!preg_match("/^[A-Za-z \.\-]{2,40}$/",$name2))
       {
       $nameErr = "Only letters and white space allowed"; 
       }
	  else{
	  $updatename = " update member set name= '".$name2."' where matric_number= '".$_SESSION["userid"]."'";
	  $nameresult = $db->query($updatename);
	  if($nameresult){
	  $nameErr = "Name updated"; 
	  }
	  }
     }
   //check email
   if (empty($_POST["email2"]))
     {$emailErr = "Email is not updated";}
   else
     {
     $email2 = test_input($_POST["email2"]);
     // check if e-mail address syntax is valid
     if (!preg_match("/^[\w.-]+@[\w.-]+\.[A-Za-z]{2,6}$/",$email2))
       {
       $emailErr = "Invalid email format"; 
       }
	   else{
	  $updateemail = " update member set email= '".$email2."' where matric_number= '".$_SESSION["userid"]."'";
	  $emailresult = $db->query($updateemail);
	  if($emailresult){
	  $emailErr = "Email updated"; 
	  }
	  }
     }
     
	 //check gender
   if (empty($_POST["gender2"]))
     {$genderErr = "Gender is not updated";}
   else
     {
     $gender2 = test_input($_POST["gender2"]);
	  $updategender = " update member set gender= '".$gender2."' where matric_number= '".$_SESSION["userid"]."'";
	  $genderresult = $db->query($updategender);
	  if($genderresult){
	  $genderErr = "Gender updated"; 
	  }
	  }
     
	  //check phone
   if (empty($_POST["phone2"]))
     {$phoneErr = "Phone is not updated";}
   else
     {
     $phone2 = test_input($_POST["phone2"]);
     // check if phone syntax is valid
     if (!preg_match("/^\d{8}$/",$phone2))
       {
       $phoneErr = "Invalid phone format, 8 digits only"; 
       }
	   else{
	  $updatephone = " update member set phone= '".$phone2."' where matric_number= '".$_SESSION["userid"]."'";
	  $phoneresult = $db->query($updatephone);
	  if($phoneresult){
	  $phoneErr = "Phone updated"; 
	  }
	  }
     }
	 
	 	  //check school
   if (empty($_POST["school2"]))
     {$schoolErr = "School is not updated";}
   else
     {
     $school2 = test_input($_POST["school2"]);
     // check if school syntax is valid
     if (!preg_match("/^[A-Z]{2,5}$/",$school2))
       {
       $schoolErr = "Invalid School format, Capitalized Abbreviation"; 
       }
	   else{
	  $updateschool = " update member set school= '".$school2."' where matric_number= '".$_SESSION["userid"]."'";
	  $schoolresult = $db->query($updateschool);
	  if($schoolresult){
	  $schoolErr = "School updated"; 
	  }
	  }
     }
  
   if (empty($_POST["address2"]))
     {$addressErr = " Address is not updated";}
   else
     {$address2 = test_input($_POST["address2"]);
	  $updateaddress = " update member set address= '".$address2."' where matric_number= '".$_SESSION["userid"]."'";
	  $addressresult = $db->query($updateaddress);
	  if($addressresult){
	  $addressErr = "Address updated"; 
	  }
	 }

}

function test_input($data)
{
     $data = trim($data);
     $data = stripslashes($data);
     $data = htmlspecialchars($data);
     return $data;
}

echo "<h1 style=\"text-align:left; color:#6495ED;\"><span style=\"color:white; font-weight:normal;\">Dear </span>".$_SESSION["membername"].",</h1>";
?>
<p>At this page, you can view and change your registered information<br><br>------------------------------------------------------------<br></p>
<h1><font color="#6495ED">Form to Update Personal Info</font></h1>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="theForm2" name="theForm2">
<p>You must register first before  you can update your info<br>Please provide your user id(matric no.) and password<br>Only fill up fields you want to update</p>

<div><label for="initial2">New password </label><input type = "password" id = "initial2" name="initial2" size = "10" ><span class="error"><?php echo $initialErr;?></span></div>
<div><i><small>Note: Your password must contain 3-10 characters,at least 1 uppercase,1 lowercase, 1 number</small></i></div>
<div><label for="second2">Confirm new password</label><input type = "password" id = "second2"  name="second2" size = "10" ><span class="error"><?php echo $secondErr;?></span></div>
<div><label for="name2">Name </label><input type="text" name="name2" id="name2" ><span class="error"> <?php echo $nameErr;?></span></div>
<div><label for="email2">E-mail: </label><input type="text" name="email2" id="email2"><span class="error"><?php echo $emailErr;?></span></div>
<div><label for="gender2">Gender</label><select name="gender2" id="gender2" >
				<option value="">Gender</option> 
				<option value="M">Male</option> 
				<option value="F">Female</option> 
</select><span class="error"><?php echo $genderErr;?></span></div>
<div><label for="phone2">Phone</label><input type="text" name="phone2" id="phone2" value="<?php echo $phone2;?>"><span class="error"><?php echo $phoneErr;?></span></div>
<div><label for="school2">School </label><input type="text" name="school2" id="school2" value="<?php echo $school2;?>"><span class="error"><?php echo $schoolErr;?></span></div>				
<div><label for="address2">Address</label><input type="text2" name="address2" id="address2" value="<?php echo $address2;?>"><span class="error"><?php echo $addressErr;?></span></div>				
<div><input type="submit" value="Update Info" id="submit2" name="submit2"><input type="reset" value="Reset"> </div>
</form>

<?php
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
	$sql = "SELECT * FROM member WHERE matric_number = '".$_SESSION["userid"]."' ";
	$result = $db->query($sql);
	$row = $result->fetch_assoc();
	$membername = $row['name'];
	$matric_number=$row['matric_number'];
	$gender=$row['gender'];
	$birth_date=$row['birth_date'];
	$school=$row['school'];
	$address=$row['address'];
	$email=$row['email'];
	$phone=$row['phone'];
	$c_count = $row['c_count'];
	$p_count = $row['p_count'];
	
	  
	  echo "<br>------------------------------------------------------------<br><br>Your Registered info is as follows:<br>";
	  echo"<div><table border=\"1\" bordercolor=\"#6495ED\" font color=\"#6495ED\">";
	  echo" <tr><td width=\"200\">User ID</td><td>".$matric_number."</td></tr>";
	  echo" <tr><td width=\"200\">Name</td><td>".$membername."</td></tr>";
	  echo" <tr><td width=\"200\">Gender</td><td>".$gender."</td></tr>";
	  echo" <tr><td width=\"200\">Date of Birth</td><td>".$birth_date."</td></tr>";
	  echo" <tr><td width=\"200\">School</td><td>".$school."</td></tr>";
	  echo" <tr><td width=\"200\">Address</td><td>".$address."</td></tr>";
	  echo" <tr><td width=\"200\">Email</td><td>".$email."</td></tr>";
	  echo" <tr><td width=\"200\">Phone</td><td>".$phone."</td></tr></table>"; 
	  
?>
</div>
</div>
</div>

	<!-- footer for website-->
	<footer>
	<small><i>Copyright &copy; 2013 NTU Fitness Factory</i></small><br>
	Email: <a href="mailto:ntufitnessfactory@ntufitnessfactory.com" id="a">ntufitnessfactory@ntufitnessfactory.com</a>     Phone: (+65)87654321      Location: 21 Nanyang Circle.
	</footer>

	
	<!-- scrooling text-->
	<script id='scroolingtext' src="scroolingtext.js"></script>
	<div id="scroolingtext" >
	<p id="tabledata" align="center"> message goes here</p>
	</div>
</body>
</html>