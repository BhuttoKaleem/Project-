<?php
require_once("database/database_library.php");
$dobj = new database_library();
if (!(isset($_SESSION['user']))) {
      header("location:login.php?class=danger&msg= Unauthorized access");
  }  
if (isset($_REQUEST['update_user']) && $_REQUEST['action']=='update_user' && $_FILES['image']['size']>0) {
    // print_r($_FILES);
    // var_dump($_POST);
    // die;
    $profile_image = $_FILES['image']['name'];
    extract($_POST);
    if (!is_dir('images')) {
            mkdir('images');
        }
        date_default_timezone_set("Asia/Karachi");
        // $time = time();
        move_uploaded_file($_FILES['image']['tmp_name'], "images/".$_FILES['image']['name']);

   $result = $dobj->update_user_image($first_name,$last_name,$email,$password,$gender,$date_of_birth, $profile_image,$hometown,$time,$_SESSION['user']['user_id']);
   if ($result) {
    // $_SESSION['msg']='Profile Updated successfully';
       header("location:profile.php?class=success&msg=Profile Updated successfully login again to see changes");
   }
   else{
    // $_SESSION['msg']='Updation failed';
       header("location:profile.php?class=danger&msg=Updation failed");
}
}


if (isset($_REQUEST['update_user']) && $_REQUEST['action']=='update_user' && $_FILES['image']['size']==0) {
        // print_r($_FILES);
    // var_dump($_POST);
    // die;
    extract($_POST);
$result = $dobj->update_user($first_name, $last_name,$email, $password,$gender, $date_of_birth, $hometown, $time,$_SESSION['user']['user_id']);
  if ($result) {
    // $_SESSION['msg']='Profile Updated successfully';
       header("location:profile.php?class=success&msg=Profile Updated successfully login again to see changes");
   }
   else{
    // $_SESSION['msg']='Updation failed';
       header("location:profile.php?class=danger&msg=Updation failed");
}


}
?>