<?php 
require_once("database/database_library.php");
$dobj = new database_library();
if (isset($_REQUEST['register']) && $_REQUEST['action']=='register') {
	$file_size = $_FILES['image']['size'];
	$profile_image = $_FILES['image']['name'];
		extract($_POST);
		// echo $time;
	// var_dump($_FILES);
	// print_r($_POST);
		// die;
	// die;
	// var_dump($_FILES['image']['name']);
	// die();
	// extract($_POST);
	$gender = $_POST['gender']??null;
	// die;
	$pattern_name  		= "/^[A-Z]{1}[a-z]{2,}$/";
	$pattern_email 		= "/^[A-z]{1,}[a-z]{3,}\d{2,}[@]{1}(gmail|yahoo|hotmail|outlook)(.com|.net|.org|.edu)$/";
	# $pattern_password 	= "/[d]{3,}[A-Z]{1}[a-z]{2,}[d]{2}/";
	// $pattern_password 	= "/[d]{2,}[a-z]{2,}/";
	# $pattern_password 	= "/[d]{2,}[a-z]{2,}/";
	$resultfirstname 	= preg_match($pattern_name, $first_name);
	$resultlastname 	= preg_match($pattern_name, $last_name);
	$resultemail 		= preg_match($pattern_email, $email);
	// $resultpassword 	= preg_match($pattern_password, $password);
	$status = true;
	$errors = null;
	if ($first_name =="") {
			$status = false;
			// print_r($status);
			// die;	
			$errors = "<li>Please Enter First Name</li>";		
	}
	else if(!$resultfirstname){
			$status = false;	
			$errors .= "<li>First name contain characters only</li>";		
	}
	if ($last_name == "") {
		$status = true;
	}
	else if(!$resultlastname){
			$status = false;	
			$errors .= "<li>Last name contains characters only</li>";		
	}
	if ($date_of_birth == "") {
		$status = false;
		$errors .= "<li>Please Enter Date of birth</li>";		
	}
	if ($hometown == "") {
		$status = false;
		$errors .= "<li>Please Enter Date of birth</li>";			
	}
	if ($gender == null) {
		$status = false;
		$errors .="<li>Please specify Gender</li>";
	}
	if ($email == "") {
		$status = false;
		$errors .= "<li>Please Enter Email</li>";		
	}
	else if (!$resultemail) {
		$status  = false;
		$errors .="<li>Not valid Email</li>";
	}
	if ($password == "") {
		$status = false;
		$errors .= "<li>Please Enter Password</li>";
	}
	// else if(!$resultpassword) {
	// 	$status  = false;
	// 	$errors .= "<li>Not Strong password</li>";
	// } 
	if ($_FILES['image']['name']==null) {
		$status = false;
		$errors .= "<li>Enter Profile Image</li>";
	}
	else if ($file_size >= 8000000) {
		$status = false;
		$errors .="<li>File size must be less than 1 MB</li>";
	}

	// {
	// 		$status = true;	
	// }
	// if ($last_name == '') {
	// 	$status = true;
	// }

	if ($status == false) {
		header("location:registration.php?class=danger&msg=$errors");
	}
	else if($status == true){

	// $profile_image = $_FILES['image']['name'];
		if (!is_dir('images')) {
			mkdir('images');
		}
		date_default_timezone_set("Asia/Karachi");
		$time = time();
		move_uploaded_file($_FILES['image']['tmp_name'], "images"."/".$_FILES['image']['name']);
			// echo "Done";
		// }
		// echo "File uploaded ";
		// }else{
			// echo"not uploaded";
		// }
		// $firstname, $lastname, $dateofbirth, $hometown, $gender, $email, $password, $image, $created_at
		$result = $dobj->register($first_name,$last_name,$email,$password,$gender,$date_of_birth,$profile_image,$hometown,$time);
		print_r($profile_image.$first_name.$last_name.$email.$password.$gender.$date_of_birth.$hometown.$time);
		// var_dump($result);
		// die;
		if ($result) {
		 	header("location:registration.php?class=success&msg=Registered successfully");
		 } 
		 elseif (!$result) {
		 	header("location:registration.php?class=danger&msg=Registration Failed");
		 }
		
	}

}















// else {
// 	echo "access denied";
// }

 ?>