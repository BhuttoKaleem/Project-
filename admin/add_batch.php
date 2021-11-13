<?php
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
        <div class="col-2 p-2 m-2 bg-info text-light text-center">Total Admins<?php  $count_admin = mysqli_fetch_assoc($admin = $dobj->count_admins());
                echo $count_admin['NUMBER_OF_ADMINS'];
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
                    
                <!-- <div class="col-8" id="registration">Registration form</div> -->
                <div class="col-8" id="registration"> <!--Registration form-->
                <?php   
                // if (isset($_REQUEST['action']) && $_REQUEST['action']=='add_batch') {
    ?>
    <div>
    <div class="card-header bg-info text-secondary">
        Add batch
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
         <label for="batch_title" class="form-label">Batch title</label>
         <span class=""  id="batch_title" style="color: red;">*</span>
         <input type="text" class="form-control" id="batch_title" name="batch_title" required="true">
         <label for="batch_description" class="form-label">Batch description</label>
         <span class=""  id="msgbatchdescription" style="color: red;">*</span>
         <textarea class="form-control" id="batch_description" name="batch_description" required="true"></textarea>
         <label for="batch_start_date" class="form-label">Batch start date</label>
         <span class=""  id="msgbatchstartdate" style="color: red;">*</span>
         <input type ="date" class="form-control" id="batch_start_date" name="batch_start_date" required="true">
         <label for="batch_end_date" class="form-label">Batch end date</label>
         <span class=""  id="msgbatchenddate" style="color: red;">*</span>
         <input type ="date" class="form-control" id="batch_end_date" name="batch_end_date" required="true">
                <center>    
        <input type="hidden" name="action" value="add_batch">
        <button type="submit" class="btn btn-secondary m-1" name="add_batch">Add batch</button></center>
        </div>
        </div>
    </form>
    </div>
        </div>
<?php
// }
?>

        <!-- <div class="col-9" id="users"> -->
                        <!--Data table ends-->
        <!-- </div> -->
                </div>
            <!-- </div> -->









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
        obj.open('POST','forms.php?action=registeruser');
        obj.setRequestHeader('Content-type','application/x-www-form-urlencoded');
        obj.send();
    }
    //show users from data base func
    function users(){
            var object;
            if (window.XMLHttpRequest) {
            object = new XMLHttpRequest();
            }
            else{
            object = new ActiveXObject('Microsoft.XMLHTTP');
            }
            object.onreadystatechange = function(){

            if (object.readyState == 4 && object.status == 200) {
            document.getElementById('registration').innerHTML = object.responseText;
            }
            }
            object.open('POST','manage.php?action=showusers');
            object.setRequestHeader('Content-type','application/x-www-form-urlencoded');
            object.send();
    }
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
            echo "you are logged in as ".$_SESSION['user']['role_type'] ."(<a href='../logout.php?action=logout' style='text-decoration:none'onclick='return logout()';>Log out</a>)";
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