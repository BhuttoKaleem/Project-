<?php 
require_once("database/database_library.php");
$dobj = new database_library();
session_start();
if (!($_SESSION['user'])) {
    session_destroy();
    header("location:login.php?class=danger&msg=Unauthorized access");
}
else{

if (isset($_REQUEST['role_type']) && $_REQUEST['action']=='change_role' && $_REQUEST['role_type'] == 'teacher') {
	// var_dump($_REQUEST['role_type']);
	// die;
	$switch_user = $dobj->switch_user_role_id($_SESSION['user']['user_id'],2);
	$switch_user_role = mysqli_fetch_assoc($switch_user);
	$_SESSION['user']['user_role_id'] = $switch_user_role['user_role_id']; 

	$_SESSION['user']['role_id'] = 2;
	$_SESSION['user']['role_type'] = 'teacher';
	$_SESSION['user']['role_type'] = $_REQUEST['role_type'];
	header("location:teacher/teacher_dashboard.php");
	
}
else if (isset($_REQUEST['role_type']) && $_REQUEST['action']=='change_role' && $_REQUEST['role_type']=='student') {
	$switch_user = $dobj->switch_user_role_id($_SESSION['user']['user_id'],3);
	$switch_user_role = mysqli_fetch_assoc($switch_user);
	$_SESSION['user']['user_role_id'] = $switch_user_role['user_role_id']; 

	$_SESSION['user']['role_id'] = 3;
	$_SESSION['user']['role_type'] = 'student';
	$_SESSION['user']['role_type'] = $_REQUEST['role_type'];
	header("location:student/student_dashboard.php");
}

else if(isset($_REQUEST['role_type']) && $_REQUEST['action']=='change_role' && $_REQUEST['role_type']=='admin'){
	$switch_user = $dobj->switch_user_role_id($_SESSION['user']['user_id'],1);
	$switch_user_role = mysqli_fetch_assoc($switch_user);
	$_SESSION['user']['user_role_id'] = $switch_user_role['user_role_id']; 

	$_SESSION['user']['role_id'] = 1;
	$_SESSION['user']['role_type'] = 'admin';
	$_SESSION['user']['role_type'] = $_REQUEST['role_type'];
	header("location:admin/admin_dashboard.php");
}


}


 ?>