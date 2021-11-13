<?php  
require_once("../database/database_library.php");
if (!($_SESSION['user']['role_type']=="admin")) {
    session_destroy();
    header("location:../login.php?class=danger&msg=Unauthorized access");
    die;
}
require_once("../general/general_library.php");
$dobj = new database_library();
$obj = new general_library();
$obj->get_outer_header();
$obj->get_outer_navbar();
// if (isset($_REQUEST['action'])&& $_REQUEST['action'] == "showusers"){

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
        <div class="col-3 ">
 <?php  $obj->get_sidebar();
          ?>
        <!-- </div> -->
        </div>

        <div class="col-9">



    <!-- </div> -->
        <!--Side bar end-->
        <!-- <div class="row mt-2"> -->
            
        <!-- </div> -->
            <div class="col-9" id="registration">
                
            <!-- </div> -->
            <?php  
            $result = $dobj->show_users();
             // $result = $dobj->assign_users_role();
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

            <!-- <table class=" table table-success"> -->
            <thead>
                <tr>
            <th scope="col">S#</th>
            <th scope="col">Profile</th>
            <th scope="col">First Name</th>
            <th scope="col">Last Name</th>
            <th scope="col">Gender</th>
            <!-- <th scope="col">Date of Birth</th> -->
            <th scope="col">Home Town</th>
            <th scope="col">Email</th>
            <th scope="col">Is approved?</th>
            <!-- <th scope="col">Status</th> -->
            <!-- <th scope="col">Role</th> -->
            <!-- <th scope="col">Active/inactive</th> -->
            <th scope="col">Action</th>
            <!-- <th scope="col">Assign role</th>                </tr> -->
            <!-- <th scope="col">Update/Delete</th>             -->
            </tr>
            </thead>
            <tbody>
            <?php
                 while ($row = mysqli_fetch_assoc($result)) {
                $get_roles = $dobj->get_roles($row['user_id']);
                    ?>
                                    <tr>
                        <td> <?php echo ++$count; ?></td>
                <td><img src="../images/<?php echo $row['image']; ?>"style="width: 20px; height:20px;"></td>
                    <!-- <td> <?php //echo $row['user_id']; ?></td> -->
                    <td> <?php echo $row['first_name']; ?></td>
                    <td> <?php echo $row['last_name']; ?></td>
                    <td> <?php echo $row['gender']; ?></td>
                     <!-- <td> <?php //echo $row['date_of_birth']; ?></td> -->
                    <td> <?php echo $row['home_town'];  ?></td>
                    <td> <?php echo $row['email']; ?> </td>
                    <td> <?php echo $row['is_approve']; ?> </td>

                    <td>
                        <div class="dropdown">
                        <button class="nav-link btn btn-info dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <?php 
                            if ($row['is_approve']=='Pending' || $row['is_approve']=='Rejected') {
                                ?>
                        <li ><a class="dropdown-item" href="approve_process.php?action=approve&user_id=<?php echo $row['user_id']; ?>&user_email=<?php echo  $row['email']; ?>">approve</a></li>
                           <?php }
                           if ($row['is_approve']=='Pending') {
                             ?>
                        <!-- <li ><a class="dropdown-item" href="process.php?action=approve&user_id=<?php //echo $row['user_id']; ?>">pending</a></li> -->
                          <?php }
                          if ($row['is_approve']=='Pending' || $row['is_approve']=='Approved') {
                              
                          ?>
                        <li ><a class="dropdown-item" href="disapprove_process.php?action=disapprove&user_id=<?php  echo $row['user_id'];?>&user_email= <?php echo $row['email']; ?>">disapprove</a></li>
                         <?php }
                         ?>
                        </ul>
                    </div>
                    </td>

                </tr>
              <?php  
                 }
             ?>
            </tbody>
             </table>
            <!--data table starts-->

                
        </div>
    </div>
            <!-- </div>    -->
        <!-- <div class="col-9" id="users"> -->
                        <!--Data table ends-->
<!-- </div> -->
<!-- </div> -->
    <?php
// }








?>
<script type="text/javascript">
    //registeration of user func
    function register(){

        var obj;
        if (window.XMLHttpRequest) {
            obj = new XMLHttpRequest();
        }
        else{
            obj = new ActiveXObject('Microsoft.XMLHTTP');
        }
        obj.onreadystatechange = function(){

            if (obj.readyState == 4 && obj.status == 200) {
                document.getElementById('registration').innerHTML = obj.responseText;
            }
        }
        obj.open('POST','admin_registration.php?actionr=registeruser');
        obj.setRequestHeader('Content-type','application/x-www-form-urlencoded');
        obj.send();
    }
    //show users from data base func
    // function users(){
    //         var object;
    //         if (window.XMLHttpRequest) {
    //         object = new XMLHttpRequest();
    //         }
    //         else{
    //         object = new ActiveXObject('Microsoft.XMLHTTP');
    //         }
    //         object.onreadystatechange = function(){

    //         if (object.readyState == 4 && object.status == 200) {
    //         document.getElementById('registration').innerHTML = object.responseText;
    //         }
    //         }
    //         object.open('POST','manage.php?action=showusers');
    //         object.setRequestHeader('Content-type','application/x-www-form-urlencoded');
    //         object.send();
    // }
    //add batch form func
    function add_batch(){
        if (window.XMLHttpRequest) {
            obj = new XMLHttpRequest();
        }
        else{
            obj = new ActiveXObject('Microsoft.XMLHTTP');
        } 
        obj.onreadystatechange = function(){
            if (obj.readyState=4 && obj.status == 200) {
                document.getElementById('registration').innerHTML = obj.responseText;
            }
        }
            obj.open('POST','forms.php?action=add_batch');
            obj.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            obj.send();
    } 
    
    //add a course form func
    function add_course(){
        // alert('ok');
        var obj;
        if (window.XMLHttpRequest) {
            obj = new XMLHttpRequest();
        }
        else{
            obj = new ActiveXObject('Microsoft.XMLHTTP');
        } 
        obj.onreadystatechange = function(){
            if (obj.readyState=4 && obj.status == 200) {
                document.getElementById('registration').innerHTML = obj.responseText;
            }
        }
            obj.open('POST','forms.php?action=add_course');
            obj.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            obj.send();
    } 
    //add topic func
    function add_topic(){
      var obj;
        if (window.XMLHttpRequest) {
            obj = new XMLHttpRequest();
        }
        else{
            obj = new ActiveXObject('Microsoft.XMLHTTP');
        } 
        obj.onreadystatechange = function(){
            if (obj.readyState=4 && obj.status == 200) {
                document.getElementById('registration').innerHTML = obj.responseText;
            }
        }
            obj.open('POST','forms.php?action=add_topic');
            obj.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            obj.send();  
    }
</script>
<div class="row">
    <div class="col-12 bottom bg-dark text-light mt-5" style="height: 6rem;">
        <p class="text-center">
            <?php
            if (isset($_SESSION['user'])) {
            echo "you are logged in as ".$_SESSION['user']['first_name'] ."(<a href='../logout.php?action=logout' style='text-decoration:none'onclick='return logout()'>Log out</a>)";
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
// $abc = "Working";
// echo $abc;
$obj->get_outer_footer();
 ?>
