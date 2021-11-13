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
        <div class="col-3 m-1">
                                     <?php  $obj->get_sidebar();
          ?>
        <!-- </div> -->
        </div>
        <!--Side bar end-->
        
    <!-- </div> -->
    <!--Pagination start-->
<!-- <div class="row"> -->
            <!-- <div> -->
                    
                <div class="col-8 mb-3" id="registration"><!--Registration form-->
                    

                        <div>       
                                <div class="card-header bg-info" >
                                Register user
                                </div>  
                            <span><?php if (isset($_GET['msg'])) {
                                                    ?><div class="alert alert-<?php echo $_REQUEST['class']; ?>" role="alert">
                                                        <?php  echo $_GET['msg'];?>
                                                    </div>
                                                <?php } 
                                            ?> </span>
                                            <div class="bg-info">
                                            <form action="process.php" method="POST" enctype="multipart/form-data">
                                            <div class="mb-3">
                                             <label for="first_name" class="form-label">First Name</label>
                                             <span class=""  id="msgfirstname" style="color: red;">*</span>
                                            <input type="text" class="form-control" id="rfirst_name" name="first_name" required="true">
                                            </div>
                                            <div class="mb-3">
                                             <label for="last_name" class="form-label">Last Name</label>
                                             <span class=""  id="msglastname" style="color: red;"></span>
                                            <input type="text" class="form-control" id="rlast_name" name="last_name">
                                            </div>
                                            <div class="mb-3">
                                             <label for="date_of_birth" class="form-label">Date of Birth</label>
                                             <span class=""  id="msgdob" style="color: red;">*</span>
                                            <input type="date" class="form-control" id="rdate_of_birth" name="date_of_birth" required="true">
                                            </div>
                                            <div class="mb-3">
                                             <label for="hometown" class="form-label">Home Town</label>
                                             <span class="" id="msghometown" style="color: red;">*</span>
                                            <!-- <input type="text" class="form-control" id="home_town" name="hometown" > -->
                                            <textarea class="form-control" id="rhome_town" name="hometown" required="trues"></textarea>
                                            </div>
                                             <label for="gender" class="form-label">Gender</label>
                                             <span class="" style="color: red;" id="msggender">*</span>
                                            <div class="form-check">
                                            <input class="form-check-input" type="radio" name="gender" id="rmale" value="male" checked>
                                            <label class="form-check-label" for="male">
                                            Male
                                            </label>
                                            </div>
                                            <div class="form-check">
                                            <label class="form-check-label" for="female"><input class="form-check-input" type="radio" name="gender" value="female" id="rfemale">Female
                                            </label>
                                            </div>
                                            <div class="dropdown">
                                            <label for="role" class="form-label">Role type</label>
                                            <span class="" style="color: red;" id="msgrole">*</span>
                                            <select name="role" class="dropdown" required="true">
                                                <option>Select role----</option>
                                                <option value="1" name="admin">Admin        
                                                </option>
                                                <option value="2" name="teacher">Teacher      
                                                </option>
                                                <option value="3" name="student">Student      
                                            </select>
                                            <!-- <input type="text" class="form-control" id="rrole" name="role"> -->
                                            </div>
                                            <label for="email" class="form-label">Email</label>
                                            <span class="" style="color: red;" id="msgemail">*</span>
                                            <input type="email" class="form-control" id="remail" name="email" required="true">               
                                            <label for="password" class="form-label">Password</label>
                                            <span class="" style="color: red;" id="msgpassword">*</span>
                                            <input type="password" class="form-control" id="rpassword" name="password" required="true">
                                            <label for="image" class="form-label">Image</label>
                                           </option>
                                            <span class="" style="color: red;" id="msgimage">*</span>
                                            <div class="input-group">
                                            <input type="file" class="form-control" name="image" id="rimage" required="true">
                                            <!-- <label class="input-group-text" for="image">Upload</label> -->
                                            </div>
                                            <center>    
                                            <input type="hidden" name="action" value="register">
                                            <input type="submit" class="btn btn-secondary mb-4" name="submit" value="Register"></center>
                                             </form> 
                                            </div>
                                            </div>

                                </div>
                            </div>



                <!-- </div>    -->
        <!-- <div class="col-9" id="users"> -->
                        <!--Data table ends-->
        <!-- </div> -->
                <!-- </div> -->
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
?>

                                <!--One section completed-->
