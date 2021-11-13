 <?php 
// session_start();
 date_default_timezone_set("Asia/Karachi");
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
    <div class="row">
        <div class="col-2"></div>
        <div class="col-2 p-2 m-2 bg-secondary text-light text-center">Total Students <?php $count_student = mysqli_fetch_assoc($student = $dobj->count_students()); 
        		echo $count_student['NUMBER_OF_STUDENTS'];
    			?></div>
        <div class="col-2 p-2 m-2 bg-success text-light text-center">Total Teachers <?php  $count_teacher =  mysqli_fetch_assoc($teacher = $dobj->count_teachers()) ;
        		echo $count_teacher['NUMBER_OF_TEACHERS']
    			?></div>
        <div class="col-2 p-2 m-2 bg-info text-light text-center">Total Admins <?php  $count_admin = mysqli_fetch_assoc($admin = $dobj->count_admins());
        		echo $count_admin['NUMBER_OF_ADMINS']

    			?>        
                </div>
        <div class="col-2"></div>
        <div class="col-2"></div>
    </div>
<!-- <div class="row"> -->
    <div class="row mt-5">
    <!--Side bar start-->
        <div class="col-3 mt-1">
                        <?php  $obj->get_sidebar();
          ?>
        </div>

        <!-- </div> -->
        <!--Side bar end-->
        
    <!-- </div> -->
    <!--Pagination start-->
<!-- <div class="row"> -->
            <!-- <div> -->
                    
                <div class="col-9" id="registration"><!--Registration form-->
                	
			<?php 
			$resultbatch_course = $dobj->show_batch_course();
					// var_dump($resultbatches);
                    // die;
			// if ($resultbatches->num_rows) {
			// 	while($course = mysqli_fetch_assoc($resultbatches)){
   //                  // print_r($course);
			// 		// die;
			// 	}
			// }
			if($resultbatch_course->num_rows){
				
			?>	
 <table id="myTable"  width="100%" class=“display” data-page-length="10" data-order="[[ 1, &quot;asc&quot; ]]">
            <!-- <table class="table table-success"> -->
                <thead>
                    
                <tr>
                				<span><?php if (isset($_GET['msg'])) {
				?><div class="alert alert-<?php echo $_REQUEST['class']; ?>" role="alert">
					<?php  echo $_GET['msg'];?>
				</div>
			<?php } 
		?> </span>
            <!-- <th scope="col">Batch id</th> -->
            <th scope="col">Batch title</th>
            <th scope="col">Batch description</th>
            <!-- <th scope="col">Batch start date</th> -->
            <!-- <th scope="col">Batch end date</th> -->
            <th scope="col">Course title</th>
            <th scope="col">Course description</th>
            <th scope="col">No: of Topics</th> 
            <th scope="col">Status</th>
             <th scope="col">Add topic</th>
            <!-- <th scope="col">Created at</th> -->
            <!-- <th scope="col">Updated at</th> -->
             <!-- <th scope="col">Edit/Delete</th> -->
            <th scope="col">Manage status</th>                
            <!-- <th scope="col">Assign course</th> -->
            <!-- // <th scope="col">Is approved?</th> -->
        	</tr>
                </thead>
                <tbody>
                    
            <?php
				while($batch_course = mysqli_fetch_assoc($resultbatch_course)){
				// print_r($batch);
				// die;
                    ?>
                                    <tr>
                    <!-- <td> <?php //echo $batch['batch_id']; ?></td> -->
                     <td> <?php  echo $batch_course['batch_title']; ?></td> 
                     <td> <?php echo $batch_course['batch_description']; ?></td> 
                     <td> <?php  echo $batch_course['course_title']; ?></td> 
                     <td> <?php echo $batch_course['course_description']; ?></td> 
                     <td> <?php
                        $no_of_topics  = $dobj->count_topics($batch_course['batch_course_id']);
                        $number_of_topics = mysqli_fetch_assoc($no_of_topics);
                     echo $number_of_topics['number_of_topics']; 
                        ?>       
                     </td> 

                    <td> <?php echo $batch_course['status']; ?> </td> 
                    <td><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $batch_course['batch_course_id'];?>" data-bs-whatever="@mdo">Add Topic</button>
                    </td>

                    <td>
                    
                        <div class="dropdown">
                        <button class="nav-link btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Manage status
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <?php
                            if ($batch_course['status']=='Completed') {
                          ?>
                        <li ><a class="dropdown-item" href="process.php?action=batch_course_inprocess&batch_course_id=<?php  echo $batch_course['batch_course_id']; ?>">Inprocess</a></li>
                        <?php }

                            if ($batch_course['status']=='InProcess') {
                              ?>
                        <li ><a class="dropdown-item" href="process.php?action=batch_course_completed&batch_course_id=<?php  echo $batch_course['batch_course_id']; ?>">Completed</a></li>
                          <?php } 


                           // if (!($batch['status_id']==1 || $batch['status_id']==2 )) {
                        ?>
                        <!-- <li ><a class="dropdown-item" href="process.php?action=completed&batch_id=<?php //echo $batch['batch_id']; ?>">Completed</a></li> -->
                         <?php // }
                         ?>
                        </ul>
                    </div>
                    </td>
				</tr>

        <div class="modal fade" id="exampleModal<?php echo $batch_course['batch_course_id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Topic</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="process.php" method="POST">
                  <div class="mb-3">
                    <label for="topic_title" class="col-form-label">Topic Title</label>
                    <input type="text" class="form-control" id="topic_title" name="topic_title" required="true">
                  </div>
                  <div class="mb-3">
                    <label for="topic_description" class="col-form-label">Topic Description</label>
                    <textarea class="form-control" id="topic_description" name="topic_description" required="true"></textarea>
                  </div>
                    <div class="mb-3">
                        <!-- <label for="priority" class="col-form-label">Topic Priority</label> -->
                        <input type="hidden" class="form-control" id="priority" name="topic_priority" value="<?php echo ++$number_of_topics['number_of_topics']; ?>">
                        <input type="hidden" class="form-control" id="batch_course_id" name="batch_course_id" value="<?php echo$batch_course['batch_course_id']; ?>">
                        <input type="hidden" class="form-control" id="action" name="action" value="add_batch_course_topic">
                    </div>
              </div>
              <div class="modal-footer">
                <input type="submit" class="btn btn-primary" name="add_topic" value="Add Topic">
              </div>
            </div>
                </form>
          </div>
        </div>

 		<?php	
				}
			}
				 ?>	
                </tbody>
			</table>
                </div>   
        <!-- <div class="col-9" id="users"> -->
                        <!--Data table ends-->
        </div>
                <!-- </div> -->
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
 ?>

