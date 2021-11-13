<?php
require_once("../database/database_library.php");
if (!($_SESSION['user']['role_type']=="admin")) {
    session_destroy();
    header("location:../login.php?class=danger&msg=Unauthorized access");
    die;
}
$dobj = new database_library();
// $time = date(D/m/Y/H/i/s/A);
$time = time();
if (isset($_REQUEST['submit']) && $_REQUEST['action']=='register') {
    // print_r($_POST);
    // print_r($_FILES);
     // die;
    $profile_image = $_FILES['image']['name'];
    extract($_POST);
    if (!is_dir('images')) {
            mkdir('images');
        }
        date_default_timezone_set("Asia/Karachi");
        $time = time();
        move_uploaded_file($_FILES['image']['tmp_name'], "../images/".$_FILES['image']['name']);
        // echo "File uploaded ";
        // }else{
            // echo"not uploaded";
        // }
        // $firstname, $lastname, $dateofbirth, $hometown, $gender, $email, $password, $image, $created_at
        $result = $dobj->admin_register($first_name,$last_name,$email,$password,$gender,$date_of_birth,$_FILES['image']['name'],$hometown,$time);
        if (isset($result)) {
           $role_assigned = $dobj->assign_user_roles($result,$role,$time);
         if ($role_assigned) {
             header("location:admin_registration.php?class=success&msg=Registered successful with role ");
          } 
          elseif (!$role_assigned) {
             header("location:admin_registration.php?class=danger&msg=Registration Failed");
          }
        }
}
if (isset($_REQUEST['update_user']) && $_REQUEST['action']=='update_user' && !($_FILES['image']['size']==0)) {
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
        move_uploaded_file($_FILES['image']['tmp_name'], "../images/".$_FILES['image']['name']);

   $result = $dobj->update_user_image($first_name,$last_name,$email,$password,$gender,$date_of_birth, $profile_image,$hometown,$time,$user_id);
   if ($result) {
       header("location:manage.php?class=success&msg=User Updated successfully");
   }
   else{
       header("location:manage.php?class=danger&msg=Updation failed");
}
}


if (isset($_REQUEST['update_user']) && $_REQUEST['action']=='update_user' && $_FILES['image']['size']==0) {
        // print_r($_FILES);
    // var_dump($_POST);
    // die;
    extract($_POST);
$result = $dobj->update_user($first_name, $last_name,$email, $password,$gender, $date_of_birth, $hometown, $time,$user_id);
      if ($result) {
       header("location:manage.php?class=success&msg=User Updated successfully");
   }
   else{
       header("location:edit.php?class=danger&msg=Updation failed");
   }


}


if (isset($_REQUEST['action']) && $_REQUEST['action']=='inactive') {
    // echo $_REQUEST['user_id'];
    // die;
    $result = $dobj->inactive_user($_REQUEST['user_id'],$time);
    if ($result) {
        header("location:manage.php?class=success&msg=user status updated to inactive");
    } 
    else{
        header("location:manage.php?class=danger&msg=failed to update status as inactive");
    }
}


if (isset($_REQUEST['action']) && $_REQUEST['action']=='inprocess') {
    $result = $dobj->batch_in_process($_REQUEST['batch_id'],$time);
    if($result){
        header("location:show_batches.php?class=success&msg=batch status has been updated to inprocess");
    }
    else if(!($result)){
        header("location:show_batches.php?class=danger&msg=Failed to update batch status");
    }
}


if (isset($_REQUEST['action'])&&$_REQUEST['action']=='completed') {
    $result = $dobj->batch_completed($_REQUEST['batch_id'],$time);
 if($result){
        header("location:show_batches.php?class=success&msg=batch status has been updated to completed");
    }
    else if(!($result)){
        header("location:show_batches.php?class=danger&msg=Failed in updating batch status");
    }   
}


if (isset($_REQUEST['action'])&&$_REQUEST['action']=='batchactive') {
    $result = $dobj->batch_active($_REQUEST['batch_id'],$time);
 if($result){
        header("location:show_batches.php?class=success&msg=batch status has been updated to active");
    }
    else if(!($result)){
        header("location:show_batches.php?class=danger&msg=Failed in updating batch status");
    }   
}
if (isset($_REQUEST['action'])&&$_REQUEST['action']=='courseactive') {
    $result = $dobj->course_active($_REQUEST['course_id'],$time);
 if($result){
        header("location:show_courses.php?class=success&msg=course status has been updated to active");
    }
    else if(!($result)){
        header("location:show_courses.php?class=danger&msg=Failed in updating course status");
    }   
}


if (isset($_REQUEST['action'])&&$_REQUEST['action']=='courseinactive') {
    $result = $dobj->course_inactive($_REQUEST['course_id'],$time);
 if($result){
        header("location:show_courses.php?class=success&msg=course status has been updated to Inactive");
    }
    else if(!($result)){
        header("location:show_courses.php?class=danger&msg=Failed in updating course status");
    }   
}


if (isset($_REQUEST['action'])&&$_REQUEST['action']=='batchinactive') {
    $result = $dobj->batch_inactive($_REQUEST['batch_id'],$time);
 if($result){
        header("location:show_batches.php?class=success&msg=batch status has been updated to InActive");
    }
    else if(!($result)){
        header("location:show_batches.php?class=danger&msg=Failed in updating batch status");
    }   
}



if (isset($_REQUEST['action'])&&$_REQUEST['action']=='topicactive') {
    $result = $dobj->topic_active($_REQUEST['topic_id'],$time);
 if($result){
        header("location:show_topics.php?class=success&msg=topic status has been updated to active");
    }
    else if(!($result)){
        header("location:show_topics.php?class=danger&msg=Failed in updating topic status");
    }   
}



if (isset($_REQUEST['action'])&&$_REQUEST['action']=='topicinactive') {
    $result = $dobj->topic_inactive($_REQUEST['topic_id'],$time);
 if($result){
        header("location:show_topics.php?class=success&msg=Topic status has been updated to InActive");
    }
    else if(!($result)){
        header("location:show_batches.php?class=danger&msg=Failed in updating topic status");
    }   
}



if (isset($_REQUEST['action']) && $_REQUEST['action']=='active') {
        // echo $_REQUEST['user_id'];
    // die;
    $result = $dobj->active_user($_REQUEST['user_id'],$time);
    if ($result) {
        header("location:manage.php?class=success&msg=user status changed to active");
    }
    else{
        header("location:manage.php?class=danger&msg=failed to change status as active");
    }
}


if (isset($_REQUEST['action']) && $_REQUEST['action']=='add_batch') {
    $batch_search = $dobj->search_batch($_REQUEST['batch_title'],$_REQUEST['batch_description']);
    if ($batch_search->num_rows) {
        header("location:add_batch.php?class=danger&msg=Batch available with this title and description");
        die; 
    }
    // print_r($_POST);
    // die;
    $result = $dobj->add_batch($_REQUEST['batch_title'],$_REQUEST['batch_description'],$_REQUEST['batch_start_date'],$_REQUEST['batch_end_date'],$time);
    if ($result) {
        header("location:add_batch.php?class=success&msg=batch added");
    }
    if (!$result) {
        header("location:add_batch.php?class=danger&msg=batch not added");       
    }
}

if(isset($_REQUEST['update_batch'])){
// print_r($_POST);
$update_batch = $dobj->update_batch($_REQUEST['batch_title'],$_REQUEST['batch_description'],
    $_REQUEST['batch_start_date'],$_REQUEST['batch_end_date'],$_REQUEST['batch_id']);
if ($update_batch) {
    header("location:show_batches.php?class=success&msg=Batch has been updated!");
}
if (!($update_batch)) {
    header("location:show_batches.php?class=danger&msg=Batch Updation failed");
}
}


if(isset($_REQUEST['update_course'])){
// print_r($_POST);
// die;
$update_course = $dobj->update_course($_REQUEST['course_title'],$_REQUEST['course_description'],
    $_REQUEST['course_id']);
if ($update_course) {
    header("location:show_courses.php?class=success&msg=Course has been updated!");
}
if (!($update_course)) {
    header("location:show_courses.php?class=danger&msg=Course Updation failed");
}
}





if (isset($_REQUEST['action'])&&$_REQUEST['action']=='add_course') {
   $course_search =  $dobj->search_course($_REQUEST['course_title'],$_REQUEST['course_description']);
 if ($course_search->num_rows) {
        header("location:add_course.php?class=danger&msg=Course already available with this title and description");       
    die; 
 }
 $result = $dobj->add_course($_REQUEST['course_title'],$_REQUEST['course_description'],$time);
   if ($result) {
        header("location:add_course.php?class=success&msg=course added");
    }
    if (!$result) {
        header("location:add_course.php?class=danger&msg=course not added");       
    }
}



    if (isset($_REQUEST['action']) && $_REQUEST['action']=='assign_roles'){
     $search_role = $dobj->search_role($_REQUEST['user_id'],$_REQUEST['role']);
     // print_r($search_role);
     // die;
     if ($search_role->num_rows) {
         header("location:assign_roles.php?class=danger&msg= This user has already that role");
     }
     
     else if($result   =   $dobj->assign_user_roles($_REQUEST['user_id'], $_REQUEST['role'],$time)){

            if ($result) {
        header("location:assign_roles.php?class=success&msg=role assigned at user ".$_REQUEST['user_id']);
            } 
        if (!$result) {
        header("location:assign_roles.php?class=danger&msg=role not assigned at user ". $_REQUEST['user_id']);       
                }
            }

    }

if(isset($_REQUEST['add_topic'])&&$_REQUEST['action']=='add_topic'){
    // print_r($_POST);    
    // die;
    $search_topic = $dobj->search_topic($_REQUEST['topic_title'],$_REQUEST['topic_description']);
    if ($select_topic->num_rows) {
        header("location:add_topic.php?class=danger&msg=Topic already available with this title and description");       
    die;
    }
    $result  = $dobj->add_topic($_REQUEST['topic_title'], $_REQUEST['topic_description'], $time);
    // for ($i=0; $i<=1; $i++) { 
        
    // }
    // add_batch_course_topic($batch_course_id,$topic_id,$created_at)
                if ($result) {
        header("location:add_topic.php?class=success&msg=topic added");
            } 
        if (!$result) {
        header("location:add_topic.php?class=danger&msg=topic already available");       
                }
}

if (isset($_REQUEST['assign_course']) && $_REQUEST['action']=='assign_course') {
    $search_batch_course = $dobj->search_batch_course($_REQUEST['select_batch'],$_REQUEST['select_course']);
    if($search_batch_course->num_rows){
        header("location:assign_batch_course.php?class=danger&msg= This batch already have that course");
    }
    else if ($batch_course_id = $dobj->assign_course($_REQUEST['select_batch'],$_REQUEST['select_course'],$_REQUEST['number_of_topics'],$time)){
      if (isset($batch_course_id)) {
        header("location:assign_batch_course_topic.php?action=add_topics&batch_course_id=".$batch_course_id."&number_of_topics=".$_REQUEST['number_of_topics']);
    }
    if (!isset($batch_course_id)) {
        header("location:assign_batch_course.php?class=danger&msg=course not assigned at batch". $_REQUEST['batch_id']);       
    }
                $select_topic = $dobj->select_topic();
                if ($select_topic->num_rows<$_REQUEST['number_of_topics']) {            
                 header("location:assign_batch_course.php?class=danger&msg=you gave more topics than available topics");
                }
            }
}


if (isset($_REQUEST['assign_topics'])&&$_REQUEST['action']=='assign_topics') {
    // echo"<pre>";
    // print_r($_POST);
    foreach ($_POST['select_topic'] as $key => $topic) {
        $topic_id = $_POST['select_topic'][$key];
        $topic_priority = $_POST['priority'][$key];
        // echo "<p/>Topic ID : ".$_POST['select_topic'][$key]."<p/>";
        // echo "<p/><b>PRIORITY ID</b> : ".$_POST['priority'][$key]."<p/>";
        $assign_batch_course_topic = $dobj->assign_batch_course_topic($_REQUEST['batch_course_id'],$topic_id,$topic_priority);
    }
    if ($assign_batch_course_topic) {
        header("location:assign_batch_course.php?class=success&msg=Batch has been added with topics");
    }
    // echo"</pre>";
}


if (isset($_REQUEST['action'])&& $_REQUEST['action']=='batch_course_inactive') {
    // print_r($_REQUEST['batch_course_id']);
   $inactive_batch_course = $dobj->inactive_batch_course($_REQUEST['batch_course_id']);
   if ($inactive_batch_course) {
       header("location:show_batch_course.php?class=success&msg=Status Updated to InActive");
   }
   if (!$inactive_batch_course) {
       header("location:show_batch_course.php?class=danger&msg=Status updation failed");
   }

}


if (isset($_REQUEST['action'])&& $_REQUEST['action']=='batch_course_active') {
    // print_r($_REQUEST['batch_course_id']);
   $active_batch_course = $dobj->active_batch_course($_REQUEST['batch_course_id']);
   if ($active_batch_course) {
       header("location:show_batch_course.php?class=success&msg=Status Updated to Active");
   }
   if (!$active_batch_course) {
       header("location:show_batch_course.php?class=danger&msg=Status updation failed");
   }

}


if (isset($_REQUEST['action'])&& $_REQUEST['action']=='batch_course_inprocess') {
    // print_r($_REQUEST['batch_course_id']);
   $inprocess_batch_course = $dobj->inprocess_batch_course($_REQUEST['batch_course_id']);
   if ($inprocess_batch_course) {
       header("location:show_batch_course.php?class=success&msg=Status Updated to InProcess");
   }
   if (!$inprocess_batch_course) {
       header("location:show_batch_course.php?class=danger&msg=Status updation failed");
   }

}


if (isset($_REQUEST['action'])&& $_REQUEST['action']=='batch_course_completed') {
    // print_r($_REQUEST['batch_course_id']);
   $completed_batch_course = $dobj->completed_batch_course($_REQUEST['batch_course_id']);
   if ($completed_batch_course) {
       header("location:show_batch_course.php?class=success&msg=Status Updated to Completed");
   }
   if (!$completed_batch_course) {
       header("location:show_batch_course.php?class=danger&msg=Status updation failed");
   }

}






if (isset($_REQUEST['enroll_student']) && $_REQUEST['action'] == 'enroll_student') {
    print_r($_POST);
    // die;
$search_enrolled_student = $dobj->search_enrolled_student($_REQUEST['user_role_id'],$_REQUEST['role_id']);
if ($search_enrolled_student->num_rows) {
        header("location:enroll_student.php?class=danger&msg=Student can not be re enrolled!");
        die;
}
    
$user_enrolled = $dobj->search_enrolled_user($_REQUEST['batch_course_id'],$_REQUEST['user_role_id']);
    if ($user_enrolled->num_rows) {
        header("location:enroll_student.php?class=danger&msg=This user is already enrolled in this batch");
        die;
    }
$enrollment = $dobj->enrollment($_REQUEST['user_role_id'],$_REQUEST['batch_course_id']);
if ($enrollment) {
    header("location:enroll_student.php?class=success&msg=Student Enrolled successfully");
}
if (!$enrollment) {
    header("location:enroll_student.php?class=danger&msg=Student Enrollment Failed");
}
}


if (isset($_REQUEST['action'])&&$_REQUEST['action']=='disenroll') {
    $disenroll = $dobj->disenroll($_REQUEST['enrollment_id']);
    if($disenroll){
        header("location:show_enrolled_users.php?class=success&msg=User has been disenrolled from Batch");
    }
    if (!$disenroll) {
        header("location:show_enrolled_users.php?class=danger&msg=Updation failed"); 
    }
}



if (isset($_REQUEST['action'])&&$_REQUEST['action']=='enroll') {
    $enroll = $dobj->enroll($_REQUEST['enrollment_id']);
    if($enroll){
        header("location:show_enrolled_users.php?class=success&msg=User has been enrolled in Batch");
    }
    if (!$enroll) {
        header("location:show_enrolled_users.php?class=danger&msg=Updation failed"); 
    }
}

if (isset($_REQUEST['action'])&&$_REQUEST['action']=='terminate') {
    $terminate = $dobj->terminate($_REQUEST['enrollment_id']);
    if($terminate){
        header("location:show_enrolled_users.php?class=success&msg=User has been Terminated from this Batch");
    }
    if (!$terminate) {
        header("location:show_enrolled_users.php?class=danger&msg=Updation failed"); 
    }
}



if (isset($_REQUEST['enroll_teacher']) && $_REQUEST['action'] == 'enroll_teacher') {
    print_r($_POST);
    // die;
    $user_enrolled = $dobj->search_enrolled_user($_REQUEST['batch_course_id'],$_REQUEST['user_role_id']);
    if ($user_enrolled->num_rows) {
        header("location:enroll_teacher.php?class=danger&msg=This user is already enrolled in this batch");
        die;
    }
$enrollment = $dobj->enrollment($_REQUEST['user_role_id'],$_REQUEST['batch_course_id']);
if ($enrollment) {
    header("location:enroll_teacher.php?class=success&msg=Teacher Enrolled successfully");
}

if (!$enrollment) {
    header("location:enroll_teacher.php?class=danger&msg=Teacher Enrollment Failed");
}

}


if (isset($_REQUEST['action']) && $_REQUEST['action']=='add_batch_course_topic') {
    var_dump($_POST);
    // die;
    $topic_id =  $dobj->add_batch_course_topic($_REQUEST['topic_title'],$_REQUEST['topic_description']);
    $topic_assign_batch_course = $dobj->assign_batch_course_topic($_REQUEST['batch_course_id'],$topic_id,$_REQUEST['topic_priority']);
    if ($topic_assign_batch_course) {
        header("location:show_batch_course.php?class=success&msg=Topic added to this batch course");
    }
    if (!$topic_assign_batch_course) {
        header("location:show_batch_course.php?class=danger&msg=Topic is already available");
    }
}

if (isset($_REQUEST['update_topic'])&&$_REQUEST['action']=='update_topic') {
    print_r($_POST);
    // die;
       $edit_topic =  $dobj->edit_topic($_REQUEST['topic_title'],$_REQUEST['topic_description'],$_REQUEST['topic_id']);
    if($edit_topic)
    {
        header("location:show_topics.php?class=success&msg=Topic Updated");
    }
    else{
        header("location:show_topics.php?class=danger&msg=Topic Updation failed");
    }
}






 ?>