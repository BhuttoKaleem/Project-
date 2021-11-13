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
    <div class="row">
        <div class="col-2"></div>
        <div class="col-2 p-2 m-2 bg-secondary text-light text-center">Total Students <?php $count_student = mysqli_fetch_assoc($student = $dobj->count_students()); 
        		echo $count_student['NUMBER_OF_STUDENTS'];
    			?></div>
        <div class="col-2 p-2 m-2 bg-success text-light text-center">Total Teachers <?php  $count_teacher =  mysqli_fetch_assoc($teacher = $dobj->count_teachers()) ;
        		echo $count_teacher['NUMBER_OF_TEACHERS']
    			?></div>
        <div class="col-2 p-2 m-2 bg-info text-light text-center">Total Admins<?php  $count_admin = mysqli_fetch_assoc($admin = $dobj->count_admins());
        		echo $count_admin['NUMBER_OF_ADMINS']

    			?></div>
        <div class="col-2"></div>
        <div class="col-2"></div>
    </div>
<div class="row">
    <!--Side bar start-->
        <div class="col-3 m-1">
 <?php  $obj->get_sidebar();
          ?>
        </div>

        <!-- </div> -->
        <!--Side bar end-->
        
    <!-- </div> -->
    <!--Pagination start-->
<!-- <div class="row"> -->
            <!-- <div> -->
                    
                <div class="col-8" id="registration"><!--Registration form-->
                	
			<?php 
			$result = $dobj->show_topics();
            $count = 0;
					// var_dump($result);
                    // die;
                     // print_r($topic);
					 // die;
				// }
			// }	
			?>
 <table id="myTable"  width="100%" class=“display” data-page-length="10" data-order="[[ 1, &quot;asc&quot; ]]">
            	<thead>
                    
            <!-- <table class="table table-success"> -->
                <tr>
                				<span><?php if (isset($_GET['msg'])) {
				?><div class="alert alert-<?php echo $_REQUEST['class']; ?>" role="alert">
					<?php  echo $_GET['msg'];?>
				</div>
			<?php } 
		?> </span>
            <th scope="col">S#</th>
            <th scope="col">Topic title</th>
            <th scope="col">Topic description</th>
            <!-- <th scope="col">Batch start date</th> -->
            <!-- <th scope="col">Batch end date</th> -->
            <th scope="col">Created at</th>
            <th scope="col">Updated at</th>
            <th scope="col">Status</th>
            <th scope="col">Edit</th>
            <th scope="col">Manage status</th>                
            <!-- <th scope="col">Assign course</th> -->
            <!-- // <th scope="col">Is approved?</th> -->
             <!-- <th scope="col">Active/inactive</th> -->
        	</tr>
                </thead>
                <tbody>
                    
            <?php	
			if ($result->num_rows) {
				while($topic = mysqli_fetch_assoc($result)){
                    ?>
                                    <tr>
                    <td> <?php echo ++$count; ?></td>
                    <td> <?php echo $topic['topic_title']; ?></td>
                    <td> <?php echo $topic['topic_description']; ?></td>
                    <!-- <td> <?php  // echo $batch['batch_start_date']; ?></td> -->
                    <!-- <td> <?php // echo $batch['batch_end_date']; ?></td> -->
                    <td> <?php echo $topic['created_at'];  ?></td>
                    <td> <?php echo $topic['updated_at'] ?> </td>
                    <!-- <td> <?php //echo $row['is_approve']; ?> </td> -->
                    <td> <?php echo $topic['status']; ?> </td> 
                    <!-- <td> <?php //echo $batch['status_id']; ?> </td> -->
                    <td>
                        <!-- <a href="show_batches.php?batch_id=<?php // echo $batch['batch_id']; ?>&action=edit" class="btn btn-primary m-1">edit</a> -->
                        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal <?php // echo $batch['batch_id']; ?> " data-bs-whatever="@fat">edit</button> -->
                        <!-- <a href="#show_batches.php?batch_id=<?php // echo $batch['batch_id'] ?>&action=delete" class="btn btn-danger m-1">delete</a> -->
                        <!-- <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal <?php  //echo $batch['batch_id'] ?> " data-bs-whatever="@fat">delete</button> -->

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $topic['topic_id'];?>" data-bs-whatever="@getbootstrap">Edit</button>
                    <td>
                        <div class="dropdown">
                        <button class="nav-link btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Manage status
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <?php
                          if ($topic['status']=='InActive') {
                              ?>
                        <li ><a class="dropdown-item" href="process.php?action=topicactive&topic_id=<?php  echo $topic['topic_id']; ?>">active</a></li>
                          <?php }
                          if ($topic['status']=='Active') {
                        ?>
                        <li ><a class="dropdown-item" href="process.php?action=topicinactive&topic_id=<?php echo $topic['topic_id']; ?>">inactive</a></li>
                         <?php  }
                         ?>
                        </ul>
                    </div>
                    </td>


                    <div class="modal fade" id="exampleModal<?php echo $topic['topic_id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Topic</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="process.php" method="POST">
                  <div class="mb-3">
                    <label for="topic_title" class="col-form-label">Topic Title</label>
                    <input type="text" class="form-control" id="topic_title" name="topic_title" value="<?php echo $topic['topic_title']; ?>">
                  </div>
<!--                   <div class="mb-3">
                    <label for="batch_start_date" class="col-form-label">Batch Start Date</label>
                    <input type="date" class="form-control" id="batch_start_date" name="batch_start_date" value="<?php //echo $batch['batch_start_date']; ?>">
                  </div> -->
<!--                   <div class="mb-3">
                    <label for="batch_end_date" class="col-form-label">Batch End Date</label>
                    <input type="date" class="form-control" id="batch_end_date" name="batch_end_date" value="<?php// echo $batch['batch_end_date']; ?>">
                  </div> -->
                  <div class="mb-3">
                    <label for="topic_description" class="col-form-label">Topic Description</label>
                    <textarea class="form-control" id="topic_description" name="topic_description"><?php echo $topic['topic_description'];?></textarea>
                  </div>
              </div>
              <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
              <center>
                <input type="hidden" name="topic_id" value="<?php echo $topic['topic_id']; ?>">
                <input type="hidden" name="action" value="update_topic">
               <input type="submit" class="btn btn-primary" value="UPDATE" name="update_topic">
                </center>
              </div>
                </form>
            </div>
          </div>
        </div>

		<?php	
				}
			}
				 ?>	
				</tr>
                </tbody>
			</table>
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
 ?>

