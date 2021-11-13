<?php 
// session_start();
require_once("general/general_library.php");
require_once("database/database_library.php");
$dobj = new database_library();
$obj  = new general_library();
$obj->get_header();
$obj->get_navbar();
?>
<div class="row">
	<div class="col-sm-3"></div>
		<div class="col-sm-6">
	

    <div>

                     <?php
                                            // if (isset($_REQUEST['action'])&&$_REQUEST['action']=='profile') {
                                            $result = $dobj->edit_user($_SESSION['user']['user_id']);
                                            if ($result->num_rows) {
                                            $row = mysqli_fetch_assoc($result);
                                            ?>
                                            <form action="profile_process.php" method="POST" enctype="multipart/form-data" onsubmit="return confirm_update();">
                        <span><?php if (isset($_REQUEST['msg'])){
						?><div class="alert alert-<?php echo $_REQUEST['class']; ?>" role="alert">
						<?php 
						echo $_REQUEST['msg'];
						// unset($_SESSION['msg']);
						?>
						</div>
						<?php } 
						?> 
						</span>
            <div class="mb-3">
             <label for="first_name" class="form-label">First Name</label>
             <!-- <span class=""  id="msgfirstname" style="color: red;">*</span> -->
            <input type="text" class="form-control" id="first_name" name="first_name" value="<?php echo $row['first_name']; ?>">
            </div>
            <div class="mb-3">
             <label for="last_name" class="form-label">Last Name</label>
             <!-- <span class=""  id="msglastname" style="color: red;"></span> -->
            <input type="text" class="form-control" id="last_name" name="last_name" value="<?php echo $row['last_name'] ?>">
            </div>
            <div class="mb-3">
             <label for="date_of_birth" class="form-label">Date of Birth</label>
             <!-- <span class=""  id="msgdob" style="color: red;">*</span> -->
            <input type="date" class="form-control" id="date_of_birth" name="date_of_birth" value="<?php echo $row['date_of_birth'] ?>">
            </div>
            <div class="mb-3">
             <label for="hometown" class="form-label">Home Town</label>
             <!-- <span class="" id="msghometown" style="color: red;">*</span> -->
            <!-- <input type="text" class="form-control" id="home_town" name="hometown" > -->
            <textarea class="form-control" id="home_town" name="hometown" ><?php echo $row['home_town']; ?></textarea>
            </div>
             <label for="gender" class="form-label">Gender</label>
             <!-- <span class="" style="color: red;" id="msggender">*</span> -->
            <div class="form-check">
            <!-- <input class="form-check-input" type="radio" name="gender" id="male" value="male" checked> -->
            <input class="form-check-input" type="radio" name="gender" id="male" value="Male" <?php if($row['gender']=='Male'){ ?> checked<?php } ?>>
            <label class="form-check-label" for="male">
            Male
            </label>
            </div>
            <div class="form-check">
            <label class="form-check-label" for="female"><input class="form-check-input" type="radio" name="gender" value="Female" id="female" <?php if($row['gender']=='Female'){  ?> checked <?php } ?>>Female
            </label>
            </div>
            <label for="email" class="form-label">Email</label>
            <!-- <span class="" style="color: red;" id="msgemail">*</span> -->
            <input type="text" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>">         
            <label for="password" class="form-label">Password</label>
            <!-- <ul><?php //echo $row['password'] ?></ul> -->
            <!-- <span class="" style="color: red;" id="msgpassword">*</span> -->
            <input type="password" class="form-control" id="password" name="password" value="<?php echo $row['password']; ?>">
            <label for="image" class="form-label">Image</label>
            <!-- <img src="../images/image.jpg"> -->
            <img src="images/<?php echo $row['image']; ?>" style="height: 75px; width: 75px" >
            <!-- <span class="" style="color: red;" id="msgimage">*</span> -->
            <div class="input-group">
            <input type="file" class="form-control" id="image" name="image">
            <!-- <label class="input-group-text" for="image">Upload</label> -->
            </div>
            <center>    
            <input type="hidden" name="action" value="update_user">
            <!-- <input type="hidden" name="user_id" value="<?php //echo $row['user_id']; ?>"> -->
            <button type="submit" class="btn btn-primary m-1" name="update_user">Update</button></center>
                </form>
    </div>
                                        <?php  
                                        }
                                        // header("location:assign_roles.php?action=edited_data&data=".$result);
                                        // }
                                    ?> 


<script type="text/javascript">
    function confirm_update() {
        if(confirm("Are you sure on updation of your profile!")){
            return true;
        }
        else{
            return false;
        }
    }
</script>









		</div>
		<div class="col-sm-2"></div>
</div>
<div class="row">
    <div class="col-12 bottom bg-dark text-light mt-5" style="height: 6rem;">
        <p class="text-center">
            <?php
            if (isset($_SESSION['user'])) {
            echo "you are logged in as ".$_SESSION['user']['role_type'] ."(<a href='../logout.php?action=logout' style='text-decoration:none'>Log out</a>)";
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
$obj->get_footer();
 ?>