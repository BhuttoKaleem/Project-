<?php
// session_start();
require_once("database/database_library.php");
$obj =  new database_library(); 
if (isset($_REQUEST['login'])) {
 // print_r($_POST);
 // die;
	extract($_POST);
 $result = $obj->login($email, $password);
 	if($result->num_rows<1){
		header("location:login.php?class=danger&msg=Invalid email/password");
	}
if ($result->num_rows) {
	 // print_r($result);
	$row = mysqli_fetch_assoc($result);
	 // print_r($row);
	 // die;
	 if ($row['is_approve']=="Pending" || $row['is_approve']=="Rejected") {
 	 	header("location:login.php?class=danger&msg=Your request is not Approved yet");
 	 	die;
		}

	 if($row['status_id'] == 2)
	 {
	// var_dump($user_data['status'] == "InActive");
 	 header("location:login.php?class=danger&msg=Your account is not active yet");
 	die();
 	}
	$user = $obj->login_user($row['user_id']);
	$user_data  = mysqli_fetch_assoc($user);
	// echo "<pre>";
	// print_r($user_data);


	if ($user_data['role_type']=='admin' && ($user_data['is_approve']=='Approved')) {
 	$_SESSION['user'] = $user_data;
 	$data = $obj->get_roles($_SESSION['user']['user_id']);
 	$roles_get = array();
 	while($roles = mysqli_fetch_assoc($data)){
 		$roles_get[] = $roles['role_type'];
 	}
 	$_SESSION['roles'] = $roles_get;
 	// print_r($_SESSION['roles']);
 	// die;
 	header("location:admin/admin_dashboard.php");
 	}
 	else if ($user_data['role_type']=='teacher'&& ($user_data['is_approve']=='Approved')) {
 	$_SESSION['user'] = $user_data;
 	$data = $obj->get_roles($_SESSION['user']['user_id']);
 	$roles_get = array();
 	while($roles = mysqli_fetch_assoc($data)){
 		$roles_get[] = $roles['role_type'];
 	}
 	$_SESSION['roles'] = $roles_get;
 	header("location:teacher/teacher_dashboard.php");
 	}
 	else if ($user_data['role_type']=='student' && ($user_data['is_approve']=='Approved')) {
 	$_SESSION['user'] = $user_data;
 	$data = $obj->get_roles($_SESSION['user']['user_id']);
 	$roles_get = array();
 	while($roles = mysqli_fetch_assoc($data)){
 		$roles_get[] = $roles['role_type'];
 	}
 	$_SESSION['roles'] = $roles_get;
 		header("location:student/student_dashboard.php");
 	}
 	else if(!($user_data['role_type']=='student' || $user_data['role_type']=='teacher' || $user_data['role_type']=='admin')){
 	header("location:login.php?class=danger&msg=You don't have any role yet");
	}
 	else{
	header("location:login.php?class=danger&msg=Dear user Your Request is in process please wait");
 	}

// if ($row['is_approve']=='Pending'||$row['is_approve']=='Rejected') {
// 	// $_SESSION['user'] = $row;
// 	header("location:login.php?class=danger&msg=Dear user Your Request is in process please wait");
// }
// 	if ($row['is_approve']=='Rejected') {
// 	// $_SESSION['user'] = $row;
// 	header("location:login.php?class=danger&msg=Your request has been rejected");
// }
// 	elseif ($row['role_type']=='admin') {
// 	$_SESSION['user'] = $row;
// 	header("location:admin/admin_dashboard.php?user=$user");
// 	}
// 	elseif ($row['role_type']=='teacher') {
// 	$_SESSION['user'] = $row;
// 	header("location:teacher/teacher_dashboard.php");
// 	}
// 	elseif ($row['role_type']=='student') {
// 	$_SESSION['user'] = $row;
// 		header("location:student_dashboard.php");
// 	}
// 	// if ($row['is_approve']=='Pending') {
// 	// header("location:login.php?class=danger&msg=Your Request is on Pending please wait");
// 	// }
// 	// 	if ($row['is_approve']=='Rejected') {
// 	// 	header("location:login.php?class=danger&msg=Your request has been rejected");
// 	// }
// 	// 	if ($row['is_approve']=='Pending') {
// 	// header("location:login.php?class=danger&msg=Dear student Your Request is on Pending please wait");
// 	// }
// 	// if ( $row['is_approve']=='Rejected') {
// 	// header("location:login.php?class=danger&msg=Your request has been rejected");
// // }
// 	if($row['status_id']==null){
// 	header("location:login.php?class=danger&msg=Your account is not active");
// 	}
// 	if(!$row['role_type']=='student' || !$row['role_type']=='teacher' || !$row['role_type']=='admin'){
// 	header("location:login.php?class=danger&msg=You don't have any role yet");
// 	}
// 	// if($_SESSION['user']['status_id']!=1){
// 	// header("location:login.php?class=danger&msg=Your account is not active yet");
}

}
else{
	header("location:login.php?class=danger&msg=Unauthorized access");
}
 ?>
