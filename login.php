

<?php 


	require_once("general/general_library.php");


	require_once("database/database_library.php");

	$dobj = new database_library();

	$obj = new general_library();

	$obj->get_header();

	$obj->get_navbar();

	?>
<div class="row mb-3">
	<div class="col-12 bg-info text-light" style="height: 5rem; text-align: center;">
		Learning management system
	</div>
</div>
	<div class="row">
			<div class="col-2 m-3"></div>
				<div class="col-8 bg-info m-3">
						<div class="card-header bg-info">
						Login Here
							<center><p><img src="assets/iconlms.png" style="height:3em; width: 4em;"></p></center>
						</div>
							<span><?php if (isset($_GET['msg'])) {
								?><div class="alert alert-<?php echo $_REQUEST['class']; ?>" role="alert">
								<?php 
								echo $_GET['msg'];
								?>
								</div>
								<?php } 
								?> 
							</span>
						<form class="px-4 py-3" action="login_process.php" method="POST">
						<div class="mb-3">
							<input type="hidden" name="action" value="login_">				
							<label for="email" class="form-label">Email</label>
							<input type="email" class="form-control" id="email" name="email" placeholder="email@example.com">
						</div>				
					    <div class="mb-3">
					      <label for="exampleDropdownFormPassword1" class="form-label">Password</label>
					      <input type="password" class="form-control" id="exampleDropdownFormPassword1" placeholder="Password" name="password">
					    </div>
						<div class="mb-3">
							<div class="form-check">
							<input type="checkbox" class="form-check-input" id="dropdownCheck" name="remember_me">
							<label class="form-check-label" for="dropdownCheck">
							Remember me
							</label>
						</div>
								<center>	
								<button type="submit" class="btn btn-secondary text-light " name="login">Login</button></center>
						</form>
							<div class="dropdown-divider"></div>
  								<a class="dropdown-item" href="#">New around here? Sign up</a>
  								<a class="dropdown-item" href="#">Forgot password?</a>
							</div>
				</div>
			<div class="col-2"></div>
	</div>


	<div class="col-12 fixed bg-dark text-light" style="height: 7rem;">
    	<p class="text-center">
		<?php
	
		if (isset($_SESSION['user'])) {
		echo $_SESSION['role_type'];
		} else{
		echo "You are not logged in";
		}
		?>
    	</p>
    	<span>
    	<img src="">
    	<img src="">
    	<img src="">
    	</span>
    	<p>&copy; hidaya institute of science & technology</p>
  	</div>





	<?php
	$obj->get_footer();
 ?>