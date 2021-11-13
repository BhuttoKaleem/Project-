<?php 
interface settings{
	public function get_header(); //used in home and login page 
	public function get_footer(); //used in home and login page
	public function get_outer_header(); // same header but used when file is out of the folder when getting css file
	public function get_outer_footer(); // same footer but used when file is out of the folder when referencing with javascript file
	public function get_navbar(); 		//navbar used in almost every panel and in every page of the project
	public function get_sidebar();		//used in admin panel
}
class general_library implements settings{
	public function get_header(){
			?>
			<!DOCTYPE html>
			<html lang="en"> 
			<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title>learning management system</title>
			<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
			<!-- <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">  -->
			<!-- <link rel="stylesheet" type="text/css" href="DataTables/css/datatables.min.css"/> -->
			<!-- <script type="text/javascript" src="DataTables/datatables.min.js"></script> -->
			<!-- <link rel="stylesheet" type="text/css" href="DataTables/css/datatables.min.css"/> -->
			<!-- <script type="text/javascript" src="DataTables/js/data.js"></script>	 -->
			<!-- <link rel="stylesheet" type="text/css" href="DataTable/css/datatables.min.css"/> -->
			<!-- <script type="text/javascript" src="DataTables/js/data.js"></script>	 -->
			<link rel="stylesheet" type="text/css" href="DataTables/css/datatables.min.css"/>
			<script type="text/javascript" src="DataTables/js/data.js"></script>	
			<script type="text/javascript" language="javascript" class="init">
			$(document).ready(function() {
				$('#myTable').DataTable();
				} );
			</script>
	
 
			</head>
			<body>
			<div class="container-fluid mb-3 pb-3">

	<?php
		}
	public function get_footer(){
			?>
		</div>
		<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
		</body>
		</html>

	<?php  
		}
	

	public function get_outer_header(){
			?>	
			<!DOCTYPE html>
			<html lang="en"> 

			<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=edge"> 
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<title>learning management system</title>
			<link rel="stylesheet" type="text/css" href="../bootstrap/css/bootstrap.min.css">
			<link rel="stylesheet" type="text/css" href="../DataTables/css/datatables.min.css"/>
			<script type="text/javascript" src="../DataTables/js/data.js"></script>	
			<script type="text/javascript" language="javascript" class="init">
			$(document).ready(function() {
				$('#myTable').DataTable();
				} );
			</script>
			</head>
			<body>
			<div class="container-fluid mb-3 pb-3">

	<?php
		}
	public function get_outer_footer(){
			?>
		</div>
		<script src="../bootstrap/js/bootstrap.bundle.min.js"></script>

		</body>
		</html>

	<?php 
	}
	public function get_navbar(){
			?>
	<div class="row">
		<div class="col-sm-12 top-fixed mb-1 text-light">
		<!-- <nav class="navbar navbar-expand-lg navbar-light bg-dark"> -->
		<nav class="navbar navbar-expand-lg navbar-light bg-dark">
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
		<img src="assets/iconlms.png" style="height:60px; ">
		<!-- <a class="navbar-brand text-light" href="#"></a> -->
		<ul class="navbar-nav me-auto mb-2 mb-lg-0">
		<li class="nav-item">
		<a class="nav-link active text-light" aria-current="page" href="home.php">Home</a>
		<!-- <a class="nav-link active text-light btn m-1" aria-current="page" href="home.php"><img src="assets/icon_home.png" style="height:25px; width: 25px;"></a> -->
		</li>
		<li class="nav-item">
		<a class="nav-link text-light" href="home.php#training_programs">Training Programs</a>
		</li>
		<li class="nav-item">
		<a class="nav-link text-light" href="home.php#ourteam">Our team</a>
		</li>
		<li class="nav-item">
		<a class="nav-link text-light" href="home.php#about">About Us</a>
		</li>
		<li class="nav-item">
		<a class="nav-link text-light" href="home.php#contact">Contact Us</a>
		</li>
		<li class="nav-item">
		<a class="nav-link text-light" href="home.php#FAQ">FAQ</a>
		</li>
			<?php if (isset($_SESSION['user']['role_type']) && $_SESSION['user']['role_type']=='admin') {
			?>
		<li class="nav-item">
		 <a class="nav-link text-light" href="admin/admin_dashboard.php">Dashboard</a> 
		</li>
			<?php } ?>
		<?php if (isset($_SESSION['user']['role_type']) && $_SESSION['user']['role_type']=='teacher') {
			?>
		<li class="nav-item">
		 <a class="nav-link text-light" href="teacher/teacher_dashboard.php">Dashoboard</a> 
		</li>
			<?php } ?>
		<?php if (isset($_SESSION['user']['role_type']) && $_SESSION['user']['role_type']=='student') {
			?>
		<li class="nav-item">
		 <a class="nav-link text-light" href="student/student_dashboard.php">Dashoboard</a> 
		</li>
			<?php } ?>  
		</ul>
		<?php 
		if(!(isset($_SESSION['user']))){
		 ?>
		<form class="d-flex">
		<!-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"> -->
			<!-- <a class=" btn-group btn btn-secondary text-light m-1" style="text-decoration: none;" href="javascript:history.back()">Back</a> -->
			<script type="text/javascript">
			// document.write('<a class=" btn-group btn btn-secondary text-light m-1" style="text-decoration: none;" href="' + document.referrer +'">Back</a>')
			</script>
		<a type="submit" class="btn btn-outline-success text-light"  href="login.php">  Login </a>
		<a type="submit" class="btn btn-outline-success text-light" href="registration.php">Register</a>
		</form>
		<?php  }
		else{
			?>
						<script type="text/javascript">
			// document.write('<a class=" btn-group btn btn-secondary text-light m-1" style="text-decoration: none;" href="' + document.referrer +'">Back</a>')
			</script>
			<a class=" text-light m-1" style="text-decoration: none;"> <?php echo strtoupper($_SESSION['user']['first_name']);?> </a>
			<!-- echo strtoupper($_SESSION['user']['first_name']); -->
			<img src="images/<?php echo $_SESSION['user']['image'];?>" style="height: 30px;" class="m-1">
		<div class="btn-group dropstart m-2">
  <button type="button" class="btn btn-secondary bg-info dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
  	Preferences
  </button>
  <ul class="dropdown-menu dropdown-menu-lg-end bg-info">
    <li><a class="dropdown-item" href="profile.php?action=profile">Profile</a></li>
    <li><a class="dropdown-item" href="logout.php?action=logout"onclick="return logout();">Logout</a></li>
    <script type="text/javascript">
    	function logout() {
    			
    			 if(confirm('Do you want to logout?'))
    			{
    			return  true;
    		}
    		else {
    			return  false;
    		}
    	}
    </script>
    <!-- <li><a class="dropdown-item" href="#">Menu item</a></li> -->
  </ul>
</div>
		<?php }
		?>
		</div>
		</nav>
		</div>
	</div>
		<?php
	}
	public function get_outer_navbar(){
			?>
			<div class="row">
		<div class="col-12 top-fixed mb-1">
		<nav class="navbar navbar-expand-lg navbar-light bg-dark">
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarTogglerDemo01">
		<img src="../assets/iconlms.png" style="height:60px; ">
		<ul class="navbar-nav me-auto mb-2 mb-lg-0">
		<li class="nav-item">
		<!-- <a class="nav-link active text-light btn " aria-current="page" href="../home.php"><img src="../assets/icon_home.png" style="height:25px; width: 25px;"></a> -->
		<a class="nav-link active text-light" aria-current="page" href="../home.php">Home</a>
		</li>
		<li class="nav-item">
		<a class="nav-link text-light" href="#training_programs">Training Programs</a>
		</li>
		<li class="nav-item">
		<a class="nav-link text-light" href="#ourteam">Our team</a>
		</li>
		<li class="nav-item">
		<a class="nav-link text-light" href="#about">About Us</a>
		</li>
		<li class="nav-item">
		<a class="nav-link text-light" href="#contact">Contact Us</a>
		</li>
		<li class="nav-item">
		<a class="nav-link text-light" href="#FAQ">FAQ</a>
		</li>
		<li class="nav-item">
		<a class="nav-link text-light" href=""></a>
		</li>
		<!-- <li class="nav-item"> -->
		<!-- <a class="nav-link text-light" href="manage_course.php">Manage Courses</a> -->
		<!-- </li> -->
			<?php //if (isset($_SESSION['user'])) {
			?>

			<?php //} ?> 
		</ul>
		<?php 
		if(!(isset($_SESSION['user']))){
		 ?>
		<form class="d-flex">
		<!-- <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"> -->
		<script type="text/javascript">
			// document.write('<a class=" btn-group btn btn-secondary text-light m-1" style="text-decoration: none;" href="' + document.referrer +'">Back</a>')
		</script>
		<a type="submit" class="btn btn-outline-success text-light"  href="../login.php">  Login </a>
		<a type="submit" class="btn btn-outline-success text-light" href="../registration.php">Register</a>
		</form>
		<?php  }
		else{
		?>
			<!-- <button class=" btn-group btn btn-secondary text-light m-1" style="text-decoration: none;" onclick="javascript:history.back()">Back</button> -->
			<script type="text/javascript">
			// document.write('<a class=" btn-group btn btn-secondary text-light m-1" style="text-decoration: none;" href="' + document.referrer +'">Back</a>')
			</script>
			<!-- <a class=" btn-group btn btn-secondary text-light m-1" style="text-decoration: none;" href="#./">Back</a> -->
			<a class=" text-light m-1" style="text-decoration: none;"> <?php echo strtoupper($_SESSION['user']['first_name']); ?> </a>
			<img src="../images/<?php echo $_SESSION['user']['image'];?>" style="height: 30px; ">
		
<!-- 
		<div class="btn-group m-2">
		<ul type="dropdown-menu" class="  bg-info" data-bs-toggle="" data-bs-display="" aria-expanded="">
		   </button> 
		  <select class="dropdown-menu dropdown-menu-end dropdown-menu-lg-start">		
		<option><li><a class="dropdown-item" href="profile.php?action=profile">Profile</a></li></option>
		<option><li><a class="dropdown-item" href="../logout.php?action=logout">Logout</a></li></option>
		</ul>
		</select>
		</div> -->
		<div class="btn-group dropstart m-2">
  <button type="button" class="btn btn-secondary bg-info dropdown-toggle" data-bs-toggle="dropdown" data-bs-display="static" aria-expanded="false">
  	Preferences
  </button>
  <ul class="dropdown-menu dropdown-menu-lg-end bg-info">
    <li><a class="dropdown-item" href="../profile.php?action=profile">Profile</a></li>
                 <li class="dropdown-item">Roles</li>
                <?php 

                if ($_SESSION['roles']){
                foreach($_SESSION['roles'] as $key => $value){
                	
                 ?>
                 <ul>
                 <li><a class="dropdown-item" href="../switch_role_process.php?role_type=<?php echo $value;?>&action=change_role" onclick="return switch_roles();"><?php echo $value;?></a></li>
                 </ul>
                <?php
            	}
                }
                ?>
    <li><a class="dropdown-item" href="../logout.php?action=logout" onclick="return logout();">Logout</a></li>
    <script type="text/javascript">
    	function switch_roles(){
    		if(confirm('Are you sure on switching your role?')){
    			return true;
    		}
    		else{
    			return false;
    		}
    	}
    </script>
    <script type="text/javascript">
    	function logout() {
    			
    			 if(confirm('Do you want to logout?'))
    			{
    			return  true;
    		}
    		else {
    			return  false;
    		}
    	}
    </script>

  </ul>
</div>

		<!-- </div> -->
		<!-- <a type="submit" class="btn btn-outline-info m-1" href="../logout.php?action=logout">logout</a> -->
		<?php 
		}
		?>
		</div>
		</nav>
		</div>
		</div>
		<?php
	}
public function get_sidebar(){
	?>
	<div>
 <!-- <nav class="navbar navbar-dark bg-dark"> -->
                <!-- <div class="container-fluid"> -->
                <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button> -->
                <!-- </div> -->
                                    <!-- </nav> -->
                <!-- <div class="collapse" id="navbarToggleExternalContent">
                <div class="bg-dark p-4">
                <h5 class="text-white h4">Manage </h5>
                <span class="text-muted"></span> -->
                <div class="card">
                <div class="card-header">
                Sidebar
                </div>
                <div class="card-body">
                <h5 class="card-title"></h5>
                <!-- <p class="card-text">With supporting text below as a natural lead-in to additional content.</p> -->
                <!-- <a href="#" class="btn btn-primary">Go somewhere</a> -->
                                                <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                Manage batches
                </button>
                 <ul class="dropdown-menu bg-info text-light" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item" href="show_batches.php">Show  Batches</a></li>
                 <li><a class="dropdown-item" href="show_batch_course.php">Show Batch Course </a></li>
                <li><a class="dropdown-item" href="add_batch.php">Add batch</a></li>
                <li><a class="dropdown-item" href="assign_batch_course.php">Assign Batch Course</a></li>
                <!-- <li><a class="dropdown-item" href="#process.php">show users</a></li> -->
                <!-- <li><button class="dropdown-item" onclick="add_batch();">add batch</button></li> -->
                </ul>
                        </div>

                                                    <!-- <div class="dropdown mt-2"> -->
                <!-- <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"> -->
                <!-- Switch Role -->
                <!-- </button> -->
                <!-- <ul class="dropdown-menu bg-info text-light" aria-labelledby="dropdownMenuButton1"> -->
                <?php 
                // foreach($_SESSION['roles'] as $key => $value){
                 ?>
                 <!-- <li><a class="dropdown-item" href="../switch_role_process.php?role_type=<?php echo $value;?>&action=change_role" onclick="return switch_roles();"><?php echo $value;?></a></li> -->
                <?php
            	// }
                ?>
                <!-- </ul> -->
                        <!-- </div> -->
                            <div class="dropdown mt-2">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Manage courses
                    </button>
                    <ul class="dropdown-menu bg-info text-light" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="show_courses.php">Show Courses</a></li>
                    <li><a class="dropdown-item" href="add_course.php">Add course</a></li>
                    <!-- <li><button class="dropdown-item" onclick="add_course();">add course</button></li> -->
                    </ul>
                            </div>
                                <div class="dropdown mt-2">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Manage topics
                    </button>
                    <ul class="dropdown-menu bg-info text-light" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="show_topics.php">Show topics</a></li>
                    <!-- <li><a class="dropdown-item" href="edit_topic.php">edit topic</a></li> -->
                    <li><a class="dropdown-item" href="add_topic.php">Add topic</a></li>
                    <!-- <li><button class="dropdown-item" onclick="add_topic();">add topic</button></li> -->
                    </ul>
                                </div>
                                <div class="dropdown mt-2">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                    Manage users
                    </button>
                    <ul class="dropdown-menu bg-info text-light" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="admin_registration.php">Register user</a></li>
                    <!-- <li><button class="dropdown-item btn-secondary" type="button" id="register" onclick="register();" >Register user</button></li> -->
                    <!-- <li><a class="dropdown-item btn-secondary" type="button" href="manage.php?action=showusers">show users</a></li> -->
                    <li><a class="dropdown-item btn-secondary" type="button" href="approve_users.php?action=approveusers">Pending users</a></li>
                    <li><a class="dropdown-item btn-secondary" type="button" href="assign_roles.php?action=showusers">Assign roles</a></li>
                    <li><a class="dropdown-item btn-secondary" type="button" href="manage.php?action=showusers"> Approved users</a></li>
                    <li><a class="dropdown-item" href="show_enrolled_users.php">Enrolled users</a></li>
                    <li><a class="dropdown-item" href="download_files.php?action=downloadexcel">Download user data in excel</a></li>
                    <li><a class="dropdown-item" href="download_files.php?action=downloadpdf">Download user data in pdf</a></li>
                    </ul>                  
                                </div>
                                <div class="dropdown mt-2">
                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                   	Course Enrollment
                    </button>
                    <ul class="dropdown-menu bg-info text-light" aria-labelledby="dropdownMenuButton1">
                    <li><a class="dropdown-item" href="enroll_student.php">Student Course Enrolment</a></li>
                    <li><a class="dropdown-item" href="enroll_teacher.php">Teacher Course Enrolment</a></li>
                    </ul>
                       
                                </div>
                </div>
                </div>
                </div>
                <!-- </div> -->
<?php
}




}


 