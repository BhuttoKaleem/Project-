<?php 
require_once("general/general_library.php");
require_once("database/database_library.php");
	$dobj = new database_library();
	$obj = new general_library();
	$obj->get_header();
if (!(isset($_REQUEST['actionr']) && $_REQUEST['actionr'] == "registeruser")){
	$obj->get_navbar();

?>
		
<div class="row mt-2">
		<div class="col-3"></div>
	<div class="col-6 bg-info mb-3">
			<div class="card-header bg-info text-secondary">
		Register Here
			</div>
		<!-- <div class="mb-3"> -->
			<span><?php if (isset($_GET['msg'])) {
				?><div class="alert alert-<?php echo $_REQUEST['class']; ?>" role="alert">
					<?php  echo $_GET['msg'];?>
				</div>
			<?php } 
		?> </span>

		<form action="registration_process.php" method="POST" enctype="multipart/form-data" onsubmit="return formvalidate()">
		<div class="mb-3">
		 <label for="first_name" class="form-label">First Name</label>
		 <span class=""  id="msgfirstname" style="color: red;">*</span>
		<input type="text" class="form-control" id="first_name" name="first_name" placeholder="John">
		</div>
		<div class="mb-3">
		 <label for="last_name" class="form-label">Last Name</label>
		 <span class=""  id="msglastname" style="color: red;"></span>
		<input type="text" class="form-control" id="last_name" name="last_name" placeholder="Ramey">
		</div>
		<div class="mb-3">
		 <label for="date_of_birth" class="form-label">Date of Birth</label>
		 <span class=""  id="msgdob" style="color: red;">*</span>
		<input type="date" class="form-control" id="date_of_birth" name="date_of_birth">
		</div>
		<div class="mb-3">
		 <label for="hometown" class="form-label">Home Town</label>
		 <span class="" id="msghometown" style="color: red;">*</span>
		<!-- <input type="text" class="form-control" id="home_town" name="hometown" > -->
		<textarea class="form-control" id="home_town" name="hometown" placeholder="Block # Street ..."></textarea>
		</div>
		 <label for="gender" class="form-label">Gender</label>
		 <span class="" style="color: red;" id="msggender">*</span>
		<div class="form-check">
  		<!-- <input class="form-check-input" type="radio" name="gender" id="male" value="male" checked> -->
  		<input class="form-check-input" type="radio" name="gender" id="male" value="male">
  		<label class="form-check-label" for="male">
    	Male
  		</label>
  		</div>
		<div class="form-check">
  		<label class="form-check-label" for="female"><input class="form-check-input" type="radio" name="gender" value="female" id="female">Female
  		</label>
		</div>
		<label for="email" class="form-label">Email</label>
		<span class="" style="color: red;" id="msgemail">*</span>
		<input type="text" class="form-control" id="email" name="email" placeholder="John12@gmail.com">			
		<label for="password" class="form-label">Password</label>
		<span class="" style="color: red;" id="msgpassword">*</span>
		<input type="password" class="form-control" id="password" name="password">
		<label for="image" class="form-label">Image</label>
		<span class="" style="color: red;" id="msgimage">*</span>
		<div class="input-group">
        <input type="file" class="form-control" id="image" name="image">
        <!-- <label class="input-group-text" for="image">Upload</label> -->
        </div>
		<center>	
		<input type="hidden" name="action" value="register">
		<button type="submit" class="btn btn-light mb-1" name="register">Register</button></center>
			</form>
		</div>
		<div class="col-3"></div>
<div class="row">	
 	<div class="col-12 bottom-fixed bg-dark text-light p-1 m-1" style="height: 8rem;">
    	<p class="text-center">
		<?php
		if (isset($_SESSION['user'])) {
		echo $_SESSION['user_name'];
		} else{
		echo "You are not logged in";
		}
		?>
    	</p>
    	<span>
    	<!-- <img src="assets/fb.png"> -->
    	<!-- <img src="assets/linkedin.png"> -->
    	<img src="">
    	</span>
    	<p>&copy; hidaya institute of science & technology</p>
 	</div>
</div>

<?php 
}
?>
<script type="text/javascript">
	function formvalidate(){
		var flag = true;
		var firstname = document.getElementById('first_name').value;
		var lastname = document.getElementById('last_name').value;
		var dob = document.getElementById('date_of_birth').value;
		var hometown = document.getElementById('home_town').value;
		var male = document.getElementById('male').checked;
		var female = document.getElementById('female').checked;
		var email  = document.getElementById('email').value;
		var password = document.getElementById('password').value;
		var image = document.getElementById('image').value;
		// confirm(firstname);
		// alert(hometown+lastname+dob+hometown+male+email+password);
		var pattern_first_name = /^[A-Z]{1}[a-z]{2,}$/;
		var pattern_email = /^[A-z]{1,}[a-z]{3,}\d{2,}[@]{1}(gmail|yahoo|hotmail|outlook)(.com|.net|.org|.edu)$/;
		// var pattern_password = /[A-Z]{1}[a-z]{2,}[d]{2}/;
		// var result_first_name  = ;
			
			if (firstname == '') {
				flag = false;
				// alert(flag);
				document.getElementById('msgfirstname').innerHTML = "Please Enter First Name";
			}
			else if(!pattern_first_name.test(firstname)){
				flag = false;
				document.getElementById('msgfirstname').innerHTML = "Pattern not matched";
			}
			else{
				flag = true;
				document.getElementById('msgfirstname').innerHTML = "";
			}
			if (lastname=='') {
				flag = true;
				document.getElementById('msglastname').innerHTML = "";
			}
			else if (!pattern_first_name.test(lastname)){
				flag = false;
				document.getElementById('msglastname').innerHTML = "Pattern not matched";
			}
			 if (dob == '') {
			 	flag = false;
			 	document.getElementById('msgdob').innerHTML 	= "Please enter date of birth";
			 }
			else {
				flag = true;
				document.getElementById('msgdob').innerHTML 	= "";
			}

			 if (hometown == '') {
			 	flag = false;
			 	document.getElementById('msghometown').innerHTML = "Plase Enter Address";
			 }
			 else{
			 	flag = true;
			 	document.getElementById('msghometown').innerHTML = "";
			 }
			 if (!(male || female)) {
				flag = false;
				document.getElementById('msggender').innerHTML = "Please Specify Gender";
			}else{
				flag = true;
				document.getElementById('msggender').innerHTML = "";
			}
			 if (email == '') {
				flag = false;
				document.getElementById('msgemail').innerHTML = "Please Enter Email";
			 }
			 else if (!pattern_email.test(email)) {
			 	flag = false;
			 	document.getElementById('msgemail').innerHTML = "Patter not matched";
			 }
			else {
				flag = true;
				document.getElementById('msgemail').innerHTML = "";
			}
			 if (password == '') {
			 	flag = false;
			 	document.getElementById('msgpassword').innerHTML = "Please Enter password";
			 }
			 // else if(!pattern_password.test(password)){
			 // 	flag = false;
			 // 	document.getElementById('msgpassword').innerHTML = "Not strong Password";
			 // }
			 else{
			 	flag = true;
			 	document.getElementById('msgpassword').innerHTML = "";
			 }
			 if (image == '') {
			 	flag = false;
			 	document.getElementById('msgimage').innerHTML = "Please upload profile image";
			 }
			 else{
			 	flag = true;
			 	document.getElementById('msgimage').innerHTML = "";
			 }

			//alert(flag);
			
			return flag;
	}

</script>






<?php
 
	$obj->get_footer();
 ?>