
<?php 
// session_start();
require_once("../database/database_library.php");
if (!($_SESSION['user']['role_type']=="admin")) {
    session_destroy();
    header("location:../login.php?class=danger&msg=Unauthorized access");
}
else{
require_once("../general/general_library.php");
$dobj = new database_library();
$obj = new general_library();
$obj->get_outer_header();
$obj->get_outer_navbar();
    ?>
            <div class="row mb-5" style="height:100px">
        <div class="col-12 bg-info" style="">
            <div class="card-header bg-light mt-5 mb-1">
                <p><?php echo strtoupper($_SESSION['user']['first_name']." ".$_SESSION['user']['last_name'])."(".$_SESSION['user']['role_type'].")"; ?></p>
                <h3 class="text-info" style="text-align: center;">ADMIN DASHBOARD</h3>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-2"></div>
        <div class="col-2 p-2 m-2 bg-secondary text-light text-center">Total Students <?php $count_student = mysqli_fetch_assoc($student = $dobj->count_students()); 
        		echo $count_student['NUMBER_OF_STUDENTS'];
    			?></div>
        <div class="col-2 p-2 m-2 bg-success text-light text-center">Total Teachers<?php  $count_teacher =  mysqli_fetch_assoc($teacher = $dobj->count_teachers()) ;
        		echo $count_teacher['NUMBER_OF_TEACHERS']
    			?></div>
        <div class="col-2 p-2 m-2 bg-info text-light text-center">Total Admins <?php  $count_admin = mysqli_fetch_assoc($admin = $dobj->count_admins());
        		echo $count_admin['NUMBER_OF_ADMINS']

    			?></div>
        <div class="col-2"></div>
        <div class="col-2"></div>
    </div>
<div class="row">
    <!--Side bar start-->
        <div class="col-3 m-1">
                                     <?php  $obj->get_sidebar();
          
                                    // var_dump($dobj->select_topic());
                                     // die;
          ?>
        <!-- </div> -->

        </div>
        <!--Side bar end-->
        
    <!-- </div> -->
    <!--Pagination start-->
<!-- <div class="row"> -->
            <!-- <div> -->
                    
                <div class="col-8" id="registration"><!--Registration form-->
             <?php   
             // elseif (!(isset($_REQUEST['action']) && $_REQUEST['action']=='add_topics')) {                  
                ?>
	<div>
	<div class="card-header bg-info text-secondary">
		Assign course
			</div>
		<div class="mb-3">
			<span><?php if (isset($_GET['msg'])) {
				?><div class="alert alert-<?php echo $_REQUEST['class']; ?>" role="alert">
					<?php  echo $_GET['msg'];?>
				</div>
			<?php } 
		?> </span>
		<form action="process.php" method="POST">
		<div class="mb-3">
		 <label for="batch" class="form-label">Select Batch</label>
		 <span class=""  id="msgbatch" style="color: red;">*</span>
		<select class="form-control" id="select_batch" name="select_batch">
            <option>Select Batch</option>
            <?php  $select_batch = $dobj->select_batch();
             while($batch = mysqli_fetch_assoc($select_batch)){
             ?>
            <option name="batch_id" value="<?php echo $batch['batch_id']; ?>" required>
            <?php  
            echo $batch['batch_title']." ".$batch['batch_description'];
            ?>
            </option>
             <?php }
             ?>
        </select>
        <?php 
         ?>
		 <label for="select_course" class="form-label">Select course</label>
		 <span class=""  id="msgselectcourse" style="color: red;">*</span>
        <select class="form-control" id="select_course" name="select_course">
        <option>Select Course</option>
        <?php $select_course = $dobj->select_course();
        while($course = mysqli_fetch_assoc($select_course)){
        ?>
        <option name='course_id' value="<?php echo $course['course_id']; ?>" required>
        <?php  echo $course['course_title']." ".$course['course_description'];?>
        </option>
        <?php } ?>
        </select>
		 <label for="number_of_topics" class="form-label">Number of Topics</label>
		 <span class=""  id="msgnumberoftopic" style="color: red;">*</span>
		 <input type ="number" class="form-control" id="number_of_topics" name="number_of_topics" required="true">
		 <!-- <textarea class="form-control" id="course_description" name="course_description" required="true"></textarea> -->
		 <!-- <label for="course_start_date" class="form-label">Course start date</label> -->
		 <!-- <span class=""  id="msgcoursestartdate" style="color: red;">*</span> -->
		 <!-- <input type ="date" class="form-control" id="course_start_date" name="course_start_date" required="true"></textarea> -->
				<center>	
		<input type="hidden" name="action" value="assign_course">
		<button type="submit" class="btn btn-secondary m-1" name="assign_course">Assign course</button></center>
		</div>
		</div>
	</form>
	</div>

<?php // } ?>
                </div>   
        <!-- <div class="col-9" id="users"> -->
                        <!--Data table ends-->
        <!-- </div> -->
                </div>
            <!-- </div> -->




<div class="row">
    <div class="col-12 bottom bg-dark text-light mt-5" style="height: 6rem;">
        <p class="text-center">
            <?php
            if (isset($_SESSION['user'])) {
            echo "you are logged in as ".$_SESSION['user']['role_type'] ."(<a href='../logout.php?action=logout' style='text-decoration:none'onclick='return logout()'>Log out</a>)";
            } else{
            echo "You are not logged in";
            }
        ?>
        </p>
    <img src="">
    <img src="">
    <img src="">
    <p>&copy; hidaya institute of science & technology</p>
    </div>
</div>
<?php
$obj->get_outer_footer();
}
// }
 ?>