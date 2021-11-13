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
        <div class="col-2 p-2 m-2 bg-success text-light text-center">Total Teachers <?php  $count_teacher =  mysqli_fetch_assoc($teacher = $dobj->count_teachers()) ;
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
        <div class="col-2 m-1">
                                   
          <?php  $obj->get_sidebar();
          ?>
        </div>
        <!--Side bar end-->
        
    <!-- </div> -->
    <!--Pagination start-->
<!-- <div class="row"> -->


       <?php // }
       ?> 
    <!-- </div> -->
  <!-- </div> -->
<!-- </div> -->


            <!-- <div> -->
                    
                <div class="col-sm-9" id="registration"><!--Registration form-->   
            
            <?php $result = $dobj->select_teachers();
            $count = 0;
                    // var_dump($result);
                ?> 
                            <span><?php if (isset($_GET['msg'])) {
                            ?><div class="alert alert-<?php echo $_REQUEST['class']; ?>" role="alert">
                            <?php 
                            echo $_GET['msg'];
                            ?>
                            </div>
                            <?php } 
                            ?> 
                            </span>
<table id="myTable"  width="100%" class=“display” data-page-length="10" data-order="[[ 1, &quot;asc&quot; ]]">
    <thead>
        
                <!-- <table class="table table-success"> -->
                    <tr>
                <th scope="col">S#</th>
                <th scope="col">Profile</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Gender</th>
                <!-- <th scope="col">Date of Birth</th> -->
                <th scope="col">Home Town</th>
                <th scope="col">Email</th>
                <!-- <th scope="col">Update/delete</th> -->
                <!-- <th scope="col">Status</th> -->
                <th scope="col">Role</th>
                <!-- <th scope="col">Active/inactive</th> -->
                <!-- <th scope="col">Action</th> -->
                <th scope="col">Enrolled In</th>
                <th scope="col">Batch/Course</th>                </tr>
    </thead>
    <tbody>
        
                <?php
                    $count = 0;
                     while ($row = mysqli_fetch_assoc($result)) {
                    $search_batch_course = $dobj->select_user_batch_course($row['user_id'],$row['user_role_id']);    
                    // $get_roles = $dobj->get_roles($row['user_id']);
                        // print_r($role['role_type']);
                        ?>
                                        <tr>
                        <td> <?php echo ++$count; ?></td>
                        <!-- <td> <?php //echo $row['user_id']; ?></td> -->
                         <!-- <td> <?php //echo ++$count; ?></td> -->
                <td><img src="../images/<?php echo $row['image']; ?>"style="width: 30px; height:30px;"></td>
                        <td> <?php echo $row['first_name']; ?></td>
                        <td> <?php echo $row['last_name']; ?></td>
                        <td> <?php echo $row['gender']; ?></td>
                         <!-- <td> <?php //echo $row['date_of_birth']; ?></td> -->
                        <td> <?php echo $row['home_town'];  ?></td>
                        <td> <?php echo $row['email']; ?> </td>
                        <td> <?php echo $row['role_type']; ?> </td>
                         <td> <?php  
                        while ($search_user_batch_course= mysqli_fetch_assoc($search_batch_course)){ 
                                 echo " ".$search_user_batch_course['batch_description']." ".$search_user_batch_course['course_description'];
                            }
                        // // print_r($role);
                         // die;
                            ?> 
                         </td> 
                        
                        <td>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $row['user_id'];?>" data-bs-whatever="@mdo">Enroll</button>

                        </td>
                         <!-- <input type="hidden" name="user_role_id" value=" <?php // echo $row['user_role_id']; ?> "> -->
                       
                        </tr>
            <!--modal-->

        <div class="modal fade" id="exampleModal<?php echo $row['user_id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Enrollment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="process.php" method="POST">
                  <div class="mb-3">
                       <!-- <label for="select_course" class="form-label">Select course</label> -->
                    <!-- <span class=""  id="msgselectcourse" style="color: red;">*</span> -->
                     <p> NAME: &nbsp; <?php echo $row['first_name'] ?> </p>   
                     <p> EMAIL: &nbsp; <?php echo $row['email'] ?> </p>   
                     <p> GENDER: &nbsp; <?php echo $row['gender'] ?> </p>     
                     <p> ROLE: &nbsp; <?php echo $row['role_type'] ?> </p>     
                     PROFILE PICTURE: &nbsp;<img src="../images/<?php  echo $row['image']; ?>" style="height: 75px; width: 75px" >
                     <!-- <p> <img src="../images/<?php //echo $row['image'];?> " > </p>    -->
<!--                     <table>
                        <tr>
                            <td>
                                <?php  //echo $row['first_name'] ?>
                            </td>
                        </tr>
                    </table> -->
                    <!-- <label for="recipient-name" class="col-form-label">Recipient:</label> -->
                    <!-- <input type="text" class="form-control" id="recipient-name"> -->
                  </div>
                  <div class="mb-3">
                    <label for="select_course" class="form-label">Select course</label>
                    <span class=""  id="msgselectcourse" style="color: red;">*</span>
                    <select class="form-control" id="select_course" name="batch_course_id" required="true">
                    <option>Select Batch</option>
                    <?php $select_batch_course = $dobj->get_batch_course();
                    while($batch_course = mysqli_fetch_assoc($select_batch_course)){
                    ?>
                    <option name='batch_course_id' value="<?php echo $batch_course['batch_course_id']; ?>">
                    <?php  echo $batch_course['course_description']." ".$batch_course['batch_description'];?>
                    </option>
                    <?php } ?>
                    </select>
                  </div>
                  <center> 
                    <input type="hidden" name="action" value="enroll_teacher">
                    <input type="hidden" name="user_role_id" value="<?php echo $row['user_role_id']; ?>">
                <button type="submit" class="btn btn-primary" name="enroll_teacher">Enroll</button>
                  </center>
                </form>
              </div>
              <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button> -->
              </div>
            </div>
          </div>
        </div>
                <?php  
                     
                     }
                 ?>
    </tbody>
                 </table>
        <!-- <div class="col-9" id="users"> -->
                        <!--Data table ends-->
        </div>
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