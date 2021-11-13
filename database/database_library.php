<?php 
session_start();
date_default_timezone_set("Asia/Karachi");
interface db_settings {
	public function register($firstname, $lastname, $dateofbirth, $hometown, $gender, $email, $password, $image, $created_at);
	public function admin_register($firstname, $lastname, $dateofbirth, $hometown, $gender, $email, $password, $image, $created_at);
	public function login($email, $password);
	public function add_batch($batch_title,$batch_description,$batch_start_date,$batch_end_date,$created_at);
	public function add_course($course_title,$course_description,$created_at);
	public function assign_course($batch_id,$course_id,$number_of_topics,$created_at);
	public function add_topic($topic_title,$topic_description,$created_at);
	public function edit_user($user_id);
	public function get_batch_course();
	public function update_batch($batch_title,$batch_description,$batch_start_date,$batch_end_date,$batch_id);
	public function update_course($course_title,$course_description,$course_id);
	public function edit_topic($topic_title,$topic_description,$topic_id);
	public function update_user($firstname, $lastname,$email, $password,$gender, $dateofbirth, $hometown, $updated_at,$user_id);
	public function show_all_users();
	public function active_user($user_id,$updated_at);
	public function inactive_user($user_id,$updated_at);
	public function approve($user_id,$updated_at,$approved_by);
	public function disapprove($user_id,$updated_at);
}
class database_library implements db_settings{
protected $hostname    	= "localhost";  
protected $username    	= "root";  
protected $password    	= "";  
protected $dbname    	= "learning_management_system";  
protected $connection 	= null;
protected $query 		= null;
protected $result		= null;
		public function __construct(){
		$this->connection = mysqli_connect($this->hostname, $this->username, $this->password, $this->dbname);
			if (mysqli_errno($this->connection)) {
				?>
				<div style="color: red;">
					<?php 
					echo"There must be an error<br/>";
					echo "Error no".mysqli_connect_errno."error message".mysqli_connect_error; ?>
				</div>
				<?php
			}

		}
		public function count_students(){
			$this->query = "SELECT COUNT('user_id') AS NUMBER_OF_STUDENTS FROM users,roles,user_role WHERE 
	 	users.user_id = user_role.`user_id` AND roles.role_id = user_role.`role_id`
	 	AND roles.role_type = 'student'";
			return $this->result = mysqli_query($this->connection,$this->query);
		}
				public function count_teachers(){
			$this->query = "SELECT COUNT('user_id') AS NUMBER_OF_TEACHERS FROM users,roles,user_role WHERE 
	 		users.user_id = user_role.user_id AND roles.role_id = user_role.role_id
	 		AND roles.role_type = 'teacher'";
			return $this->result = mysqli_query($this->connection,$this->query);
		}
				public function count_admins(){
			$this->query = "SELECT COUNT('user_id') AS NUMBER_OF_ADMINS FROM users,roles,user_role WHERE 
	 		users.user_id = user_role.user_id AND roles.role_id = user_role.role_id
	 		AND roles.role_type = 'admin'";
			return $this->result = mysqli_query($this->connection,$this->query);
		}
		public function count_topics($batch_course_id){
			$this->query = "SELECT COUNT(topic_id) number_of_topics FROM batch_course_topic WHERE batch_course_id = '".$batch_course_id."'
			";
			return $this->result = mysqli_query($this->connection,$this->query);
		}
		// $first_name,$last_name,$email,$password,$gender,$date_of_birth,$profile_image,$hometown,$time
		// $first_name,$last_name,$email,$password,$gender,$date_of_birth,$profile_image,$hometown,$time
		// first_name  last_name  email password  gender  date_of_birth  image home_town 
		public function register($firstname, $lastname, $email, $password, $gender, $dateofbirth, $image, $hometown, $created_at){
			$this->query = "INSERT INTO users(first_name,  last_name,  email, password,  gender,  date_of_birth,  image, home_town, created_at) 
			VALUES('".$firstname."','".$lastname."','".$email."','".$password."','".$gender."','".$dateofbirth."','".$image."','".$hometown."',NOW())
			";
			return $this->result = mysqli_query($this->connection, $this->query);
		}

			public function assign_users_role(){
			$this->query = "SELECT * FROM users ORDER BY user_id DESC";	
		return	$this->result = mysqli_query($this->connection, $this->query);
			}

			public function select_students(){

			$this->query = "SELECT * FROM users INNER JOIN user_role
			INNER JOIN roles 
			ON users.`user_id` = user_role.`user_id`
			AND roles.`role_id` = user_role.`role_id`
			AND roles.role_type = 'student' ORDER BY users.user_id DESC";
			return $this->result = mysqli_query($this->connection,$this->query);
			}

			public function select_teachers(){
			$this->query = "SELECT * FROM users INNER JOIN user_role
			INNER JOIN roles 
			ON users.`user_id` = user_role.`user_id`
			AND roles.`role_id` = user_role.`role_id`
			AND roles.role_type = 'teacher'  ORDER BY users.user_id DESC";
			return $this->result = mysqli_query($this->connection,$this->query);
			}

			public function assign_user_roles($user_id,$role,$created_at){
				$this->query = "INSERT INTO user_role(user_id,role_id,created_at)VALUES('".$user_id."','".$role."',NOW())";
				return $this->result = mysqli_query($this->connection,$this->query);
			}
			public function show_users(){
				$this->query = "SELECT * FROM users WHERE is_approve = 'Pending' 
				OR is_approve = 'Rejected' OR is_approve = 'Approved'
				";
				return $this->result = mysqli_query($this->connection,$this->query);
			}
		public function show_all_users(){
			$this->query = "SELECT * FROM users
			INNER JOIN STATUS ON status.status_id = users.status_id
			ORDER BY users.user_id DESC
			";

			// $this->query = "SELECT * FROM users,status,user_role,roles
			// WHERE users.status_id=status.status_id
			// AND users.user_id = user_role.user_id 
			// AND roles.role_id = user_role.role_id ORDER BY users.user_id DESC";
		return	$this->result = mysqli_query($this->connection, $this->query);
		}

		public function login($email, $password){
			// $this->query = "SELECT * FROM users,user_role,roles,'status' WHERE email = '".$email."' AND password = '".$password."' AND status.status='active' AND users.user_id = user_role.user_id 
			// 				 AND roles.role_id = user_role.role_id";
			$this->query = "SELECT * FROM users	WHERE email = '".$email."' AND PASSWORD = '".$password."' 
			";
			return $this->result = mysqli_query($this->connection, $this->query);
		}

		public function online_users($user_id){
			$this->query = "SELECT * FROM users
			WHERE user_id = '".$user_id."'
			";
			return $this->result = mysqli_query($this->connection,$this->query);
		}

		public function login_user($user_id){
			$this->query = "SELECT * FROM 
			users,user_role,roles,status
			WHERE users.user_id = user_role.user_id  
			AND roles.role_id = user_role.role_id
			AND status.status_id = users.status_id
			AND users.user_id = '".$user_id."'
			";
			return $this->result = mysqli_query($this->connection,$this->query);
		}
		
		// 		public function inactive_batch($batch_id){
		// 		$this->query = "UPDATE batches SET status_id = '2' WHERE batch_id = '".$batch_id."'";
		// return	$this->result = mysqli_query($this->connection,$this->query);
		// }		

		public function batch_in_process($batch_id,$updated_at){
				$this->query = "UPDATE batches SET status_id = '6',updated_at = NOW() WHERE batch_id = '".$batch_id."'";
		return	$this->result = mysqli_query($this->connection,$this->query);
		}

		public function batch_active($batch_id,$updated_at){
				$this->query = "UPDATE batches SET status_id = '1',updated_at = NOW() WHERE batch_id = '".$batch_id."'";
		return	$this->result = mysqli_query($this->connection,$this->query);
		}
		public function topic_active($topic_id,$updated_at){
				$this->query = "UPDATE topics SET status_id = '1',updated_at = NOW() WHERE topic_id = '".$topic_id."'";
		return	$this->result = mysqli_query($this->connection,$this->query);
		}

		public function course_active($course_id,$updated_at){
				$this->query = "UPDATE courses SET status_id = '1',updated_at = NOW() WHERE course_id = '".$course_id."'";
		return	$this->result = mysqli_query($this->connection,$this->query);
		}

		public function course_inactive($course_id,$updated_at){
				$this->query = "UPDATE courses SET status_id = '2',updated_at = NOW() WHERE course_id = '".$course_id."'";
		return	$this->result = mysqli_query($this->connection,$this->query);
		}

		
		public function topic_inactive($topic_id,$updated_at){
				$this->query = "UPDATE topics SET status_id = '2',updated_at = NOW() WHERE topic_id = '".$topic_id."'";
		return	$this->result = mysqli_query($this->connection,$this->query);
		}

		public function batch_inactive($batch_id,$updated_at){
				$this->query = "UPDATE batches SET status_id = '2',updated_at = NOW() WHERE batch_id = '".$batch_id."'";
		return	$this->result = mysqli_query($this->connection,$this->query);
		}

		public function batch_completed($batch_id,$updated_at){
				$this->query = "UPDATE batches SET status_id = '3',updated_at = NOW() WHERE batch_id = '".$batch_id."'";
		return	$this->result = mysqli_query($this->connection,$this->query);
		}


		public function inactive_user($user_id,$updated_at){
				$this->query = "UPDATE users SET status_id = '2',updated_at = NOW() WHERE user_id = '".$user_id."'";
		return	$this->result = mysqli_query($this->connection,$this->query);
		}
		public function active_user($user_id,$updated_at){
				$this->query = "UPDATE users SET status_id = '1',updated_at=NOW() WHERE user_id = '".$user_id."'";
		return	$this->result = mysqli_query($this->connection,$this->query);
		}
		public function approve($user_id,$updated_at,$approved_by){
			// UPDATE users,user_role SET users.is_approve = 'Approved', users.approved_by=1, users.updated_at= NOW(),user_role.`user_id` = 11 WHERE users.user_id = 11 
					$this->query = "UPDATE users SET is_approve = 'Approved', approved_by='".$approved_by."', updated_at= NOW() WHERE user_id = '".$user_id."' ";
		   	$this->result = mysqli_query($this->connection, $this->query);
		  	if ($this->result) {
						$this->query = "INSERT INTO user_role(user_id,created_at)
						VALUES('".$user_id."',NOW())
						";
						return $this->result = mysqli_query ($this->connection,$this->query);
					}
		   	// $this->result = mysqli_query($this->connection, $this->query);
					// $this->query = "UPDATE users,user_role,roles SET users.is_approve = 'Approved', users.approved_by='".$approved_by."', users.updated_at= NOW(),user_role.user_id = '".$user_id."' ,user_role.updated_at = NOW() WHERE users.user_id = user_role.user_id
						// AND user_role.role_id = roles.role_id AND users.user_id = '".$user_id."' ";
		}
		public function disapprove($user_id,$updated_at){
					$this->query = "UPDATE users SET is_approve = 'Rejected',updated_at = NOW() WHERE user_id = '".$user_id."' ";
			return  $this->result = mysqli_query($this->connection, $this->query);
		}

		public function admin_register($firstname, $lastname,$email, $password,$gender, $dateofbirth, $image, $hometown, $created_at){			
					$this->query = "INSERT INTO users(first_name,last_name,email,password,gender,date_of_birth,image,home_town,is_approve,approved_by,created_at) 
			VALUES('".$firstname."','".$lastname."','".$email."','".$password."','".$gender."','".$dateofbirth."','".$image."','".$hometown."','Approved','".$_SESSION['user']['user_id']."',NOW())";
			 $this->result = mysqli_query($this->connection, $this->query);
			 return mysqli_insert_id($this->connection);
		}
	 	public function add_batch($batch_title,$batch_description,$batch_start_date,$batch_end_date,$created_at){
	 		$this->query = "INSERT INTO batches(batch_title, batch_description, batch_start_date, batch_end_date,created_at) 
	 			VALUES('".htmlspecialchars($batch_title,true)."','".htmlspecialchars($batch_description,true)."','".$batch_start_date."','".$batch_end_date."',NOW())";
	 			return $this->result = mysqli_query($this->connection,$this->query);
	 		}
	 	public function search_batch($batch_title,$batch_description){
	 		$this->query = "SELECT * FROM batches WHERE batch_title = '".$batch_title."'
	 		AND batch_description = '".$batch_description."'
	 		";
	 		return $this->result = mysqli_query($this->connection,$this->query);
	 	}

		public function get_batch_course(){
		$this->query = " SELECT * FROM batches 
		INNER JOIN batch_course INNER JOIN courses
		INNER JOIN STATUS
 		ON batches.`batch_id` = batch_course.`batch_id`
 		AND batch_course.`course_id` = courses.`course_id`
 		AND status.status_id = batch_course.`status_id` 
 		WHERE status.status_id = 6
 		";
 		return $this->result = mysqli_query($this->connection,$this->query);	
		}


		public function select_topic_file($topic_id,$file_name){
			$this->query = "SELECT * FROM topics,topic_file 
			WHERE topics.`topic_id` = topic_file.`topic_id`
			AND topics.`topic_id` = '".$topic_id."' 
			AND topic_file.`file_name` = '".$file_name."'
			";
			return $this->result = mysqli_query($this->connection,$this->query);
		}
		

		public function show_batch_course(){
		$this->query = " SELECT * FROM batches 
		INNER JOIN batch_course INNER JOIN courses
		INNER JOIN STATUS
 		ON batches.`batch_id` = batch_course.`batch_id`
 		AND batch_course.`course_id` = courses.`course_id`
 		AND status.status_id = batch_course.`status_id`;
 		";
 		return $this->result = mysqli_query($this->connection,$this->query);	
		}

		public function active_batch_course($batch_course_id){
			$this->query = "UPDATE batch_course SET status_id = 1,updated_at = NOW() WHERE batch_course_id = '".$batch_course_id."'
			";
			return $this->result = mysqli_query($this->connection,$this->query);
		}

		public function inactive_batch_course($batch_course_id){
			$this->query = "UPDATE batch_course SET status_id = 2,updated_at = NOW() WHERE batch_course_id = '".$batch_course_id."'
			";
			return $this->result = mysqli_query($this->connection,$this->query);
		}


		public function completed_batch_course($batch_course_id){
			$this->query = "UPDATE batch_course SET status_id = 3,updated_at = NOW() WHERE batch_course_id = '".$batch_course_id."'
			";
			return $this->result = mysqli_query($this->connection,$this->query);
		}

		public function inprocess_batch_course($batch_course_id){
			$this->query = "UPDATE batch_course SET status_id = 6,updated_at = NOW() WHERE batch_course_id = '".$batch_course_id."'
			";
			return $this->result = mysqli_query($this->connection,$this->query);
		}


		public function search_batch_course($batch_id,$course_id){
			$this->query = "SELECT * FROM batches INNER JOIN batch_course 
			INNER JOIN courses ON batches.batch_id = batch_course.batch_id
			AND courses.course_id = batch_course.course_id 
			WHERE batches.batch_id = '".$batch_id."' 
			AND courses.course_id = '".$course_id."'
			";
			return $result = mysqli_query($this->connection,$this->query);
		}
		public function search_role($user_id,$role_id){
		$this->query = "SELECT * FROM users INNER JOIN user_role INNER JOIN roles
		ON users.user_id = user_role.user_id AND user_role.role_id = roles.role_id WHERE users.user_id = '".$user_id."' AND roles.role_id = '".$role_id."' ";
		return $this->result = mysqli_query($this->connection,$this->query);
		}


	public function add_course($course_title,$course_description,$created_at){
		$this->query = "INSERT INTO courses(course_title,course_description,created_at) 
		VALUES('".htmlspecialchars($course_title,true)."','".htmlspecialchars($course_description,true)."',NOW())
		";
		return $this->result = mysqli_query($this->connection,$this->query);

	}

	public function search_course($course_title,$course_description){
		$this->query = "SELECT * FROM courses WHERE course_title = '".$course_title."'
		AND course_description = '".$course_description."'
		";
	return	$this->result = mysqli_query($this->connection,$this->query);
	}


	public function select_batch(){
				$this->query = "SELECT * FROM batches b
		INNER JOIN STATUS s	ON b.status_id = s.status_id
		WHERE b.status_id = 1 ORDER BY batch_id DESC";
		return	$this->result = mysqli_query($this->connection,$this->query);
	}

	public function select_course(){
		$this->query = "SELECT * FROM courses c
	INNER JOIN STATUS s
	ON c.status_id = s.status_id
	WHERE c.status_id = 1";
	return $this->result = mysqli_query($this->connection,$this->query);
	}

	public function show_batches(){
				$this->query = "SELECT * FROM batches,status WHERE batches.status_id = status.status_id ORDER BY batch_id DESC";
		return	$this->result = mysqli_query($this->connection,$this->query);
	}

	public function update_batch($batch_title,$batch_description,$batch_start_date,$batch_end_date,$batch_id){
		$this->query = "UPDATE batches SET batch_title='".htmlspecialchars($batch_title,true)."', batch_description='".$batch_description."', batch_start_date = '".$batch_start_date."',
		 	batch_end_date = '".$batch_end_date."',updated_at = NOW()
		 	WHERE batch_id = '".$batch_id."'
		";
		return $this->result = mysqli_query($this->connection,$this->query);
	}
	public function update_course($course_title,$course_description,$course_id){
		$this->query = "UPDATE courses SET course_title = '".htmlspecialchars($course_title,true)."',
		course_description = '".$course_description."' WHERE course_id = '".$course_id."'
		";
		return $this->result = mysqli_query($this->connection, $this->query);
	}



	public function show_courses(){
				$this->query = "SELECT * FROM courses, status
				WHERE courses.status_id = status.status_id ORDER BY course_id DESC";
		return	$this->result = mysqli_query($this->connection,$this->query);
	}

	public function show_course(){
				$this->query = "SELECT * FROM courses,status WHERE courses.status_id = status.status_id 
				AND status.status = 'Active' ORDER BY course_id DESC";
		return	$this->result = mysqli_query($this->connection,$this->query);
	}


	public function assign_course($batch_id,$course_id,$number_of_topics,$created_at){
		$this->query = "INSERT INTO batch_course(batch_id,course_id,number_of_topics,created_at) 
		VALUES('".$batch_id."','".$course_id."','".$number_of_topics."',NOW())";
	$this->result = mysqli_query($this->connection,$this->query);
	return mysqli_insert_id($this->connection);
	}

	public function add_topic($topic_title,$topic_description,$created_at){
			$this->query = "INSERT INTO topics(topic_title,topic_description,created_at)
			VALUES('".$topic_title."','".$topic_description."',NOW())";
	return	$this->result = mysqli_query($this->connection,$this->query);
		// return mysqli_insert_id($this->connection);
	}

	public function search_topic($topic_title,$topic_description){
		$this->query = "SELECT * FROM topics WHERE topic_title = '".$topic_title."'
		AND topic_description = '".$topic_description."'
		";
		return $this->result = mysqli_query($this->connection,$this->query);
	}

	public function add_batch_course_topic($topic_title,$topic_description){
		$this->query = "INSERT INTO topics(topic_title,topic_description,status_id,created_at)
		VALUES('".$topic_title."','".$topic_description."','1',NOW())
		";
		$this->result = mysqli_query($this->connection,$this->query);
		return mysqli_insert_id($this->connection);
	}

	public function select_topic(){
	 $this->query = "SELECT * FROM topics t INNER JOIN STATUS s
	 ON t.status_id = s.status_id WHERE t.status_id =1";
	 return $this->result = mysqli_query($this->connection,$this->query);	
	}

	public function assign_batch_course_topic($batch_course_id,$topic_id,$priority){
		$this->query = "INSERT INTO batch_course_topic(batch_course_id,topic_id,topic_priority,created_at)
		VALUES('".$batch_course_id."','".$topic_id."','".$priority."',NOW())";
		return $this->result = mysqli_query($this->connection,$this->query);
	}

	public function edit_user($user_id){
				$this->query = "SELECT * FROM users WHERE user_id = '".$user_id."' ";
		return  $this->result = mysqli_query($this->connection,$this->query);
	}

	// public function search_users(){
	// 	$this->query = 
	// // }

	public function update_user_image($firstname, $lastname,$email, $password,$gender, $dateofbirth, $image, $hometown, $updated_at,$user_id){
	$this->query = "UPDATE users SET first_name = '".$firstname."', last_name='".$lastname."', email='".$email."',password = '".$password."', gender='".$gender."', date_of_birth='".$dateofbirth."',home_town='".$hometown."',image='".htmlspecialchars($image,true)."',updated_at='".$updated_at."' WHERE user_id='".$user_id."' ";
	return $this->result = mysqli_query($this->connection,$this->query);
	// first_name,last_name,email,password,gender,date_of_birth,image,home_town,created_at
	// }
}	
public function update_user($firstname, $lastname,$email, $password,$gender, $dateofbirth, $hometown, $updated_at,$user_id){
	$this->query = "UPDATE users SET first_name = '".htmlspecialchars($firstname,true)."', last_name='".htmlspecialchars($lastname,true)."',email='".htmlspecialchars($email,true)."',password='".htmlspecialchars($password,true)."',gender='".$gender."',date_of_birth='".htmlspecialchars($dateofbirth,true)."',home_town='".htmlspecialchars($hometown,true)."',updated_at='now' WHERE user_id='".$user_id."' ";
	return $this->result = mysqli_query($this->connection,$this->query);
	// first_name,last_name,email,password,gender,date_of_birth,image,home_town,created_at
	// }
}
public function get_roles($user_id){
	$this->query = "SELECT roles.role_type,user_role.user_role_id FROM users,roles,user_role WHERE users.user_id = user_role.user_id 
	AND roles.role_id = user_role.role_id 
	AND users.user_id = '".$user_id."' 
	";
	return $this->result = mysqli_query($this->connection,$this->query);
}
	// AND roles.role_type <> '".$_SESSION['user']['role_type']."' 

public function get_role($user_id){
	$this->query = "SELECT roles.role_type FROM users,roles,user_role WHERE users.user_id = user_role.user_id 
	AND roles.role_id = user_role.role_id  
	AND users.user_id = '".$user_id."' ";
	return $this->result = mysqli_query($this->connection,$this->query);
}


public function show_topics(){
			$this->query = "SELECT * FROM topics, status 
			WHERE status.status_id = topics.status_id ORDER BY topics.topic_id DESC";
	return  $this->result = mysqli_query($this->connection,$this->query);
}

public function enrollment($user_role_id,$batch_course_id){
	$this->query = "INSERT INTO user_role_batch_course_enrollment(user_role_id,batch_course_id,status_id,created_at)
	VALUES('".$user_role_id."','".$batch_course_id."','4',NOW())
	";
	return $this->result = mysqli_query($this->connection,$this->query);
}

public function disenroll($enrollment_id){
	$this->query = "UPDATE user_role_batch_course_enrollment SET status_id = 5 WHERE enrollment_id = '".$enrollment_id."'
	";
	return $this->result = mysqli_query($this->connection,$this->query);
}

public function enroll($enrollment_id){
	$this->query = "UPDATE user_role_batch_course_enrollment SET status_id = 4 WHERE enrollment_id = '".$enrollment_id."'
	";
	return $this->result = mysqli_query($this->connection,$this->query);
}

public function terminate($enrollment_id){
	$this->query = "UPDATE user_role_batch_course_enrollment SET status_id = 7 WHERE enrollment_id = '".$enrollment_id."'
	";
	return $this->result = mysqli_query($this->connection,$this->query);
}

public function enrollment_in($enrollment_id){
	$this->query = "
	SELECT * FROM users,user_role,roles,batches,courses,batch_course,user_role_batch_course_enrollment
WHERE users.`user_id` =  user_role.`user_id` 
AND roles.`role_id` = user_role.`role_id`
AND batches.`batch_id` = batch_course.`batch_id`
AND courses.`course_id` = batch_course.`course_id`
AND user_role.`user_role_id` = user_role_batch_course_enrollment.`user_role_id`
AND batch_course.`batch_course_id` = user_role_batch_course_enrollment.`batch_course_id`
AND user_role_batch_course_enrollment.`enrollment_id` = '".$enrollment_id."'
	";
return $result  = mysqli_query($this->connection,$this->query);
}


public function enrolled_users(){
	$this->query = "
			SELECT *
			FROM users 
			INNER JOIN user_role
			INNER JOIN roles  
			INNER JOIN user_role_batch_course_enrollment ube
			INNER JOIN batch_course
			INNER JOIN batches
			INNER JOIN courses
			INNER JOIN STATUS
			ON users.`user_id` = user_role.`user_id`
			AND roles.role_id = user_role.role_id
			AND batch_course.`batch_course_id` = ube.batch_course_id
			AND batches.`batch_id` = batch_course.`batch_id`
			AND courses.`course_id` = batch_course.`course_id`
			AND user_role.user_role_id = ube.user_role_id
			AND ube.status_id = status.status_id 
			ORDER BY users.user_id DESC
			";
			return $this->result = mysqli_query($this->connection,$this->query);
}

public function search_user_batch_course($user_id,$user_role_id){
		$this->query =	"SELECT batch_course.batch_course_id,batches.batch_description,courses.course_description FROM users,roles,user_role,batches,batch_course,courses,user_role_batch_course_enrollment,status
			WHERE users.user_id = user_role.user_id
			AND roles.role_id = user_role.role_id
			AND batches.`batch_id` = batch_course.`batch_id`
			AND courses.`course_id` = batch_course.`course_id`
			AND batch_course.status_id = status.status_id
			AND batch_course.`batch_course_id` = user_role_batch_course_enrollment.batch_course_id
			AND user_role.user_role_id = user_role_batch_course_enrollment.user_role_id
			AND user_role_batch_course_enrollment.status_id = 4
			AND batch_course.status_id = 6 
			AND user_role.user_role_id = '".$user_role_id."'
			AND users.user_id = '".$user_id."'
			";
			return $this->result = mysqli_query($this->connection,$this->query);
}


public function select_user_batch_course($user_id,$user_role_id){
		$this->query =	"SELECT batch_course.batch_course_id,batches.batch_description,courses.course_description FROM users,roles,user_role,batches,batch_course,courses,user_role_batch_course_enrollment,status
			WHERE users.user_id = user_role.user_id
			AND roles.role_id = user_role.role_id
			AND batches.`batch_id` = batch_course.`batch_id`
			AND courses.`course_id` = batch_course.`course_id`
			AND batch_course.status_id = status.status_id
			AND batch_course.`batch_course_id` = user_role_batch_course_enrollment.batch_course_id
			AND user_role.user_role_id = user_role_batch_course_enrollment.user_role_id
			AND user_role.user_role_id = '".$user_role_id."'
			AND users.user_id = '".$user_id."'
			";
			return $this->result = mysqli_query($this->connection,$this->query);
}


public function user_course($user_id,$batch_course_id,$user_role_id){
$this->query = "SELECT topics.topic_id,topics.topic_title,topics.topic_description,
status.status,batch_course_topic.status_id
FROM users 
INNER JOIN user_role INNER JOIN roles INNER JOIN batches 
INNER JOIN batch_course INNER JOIN courses 
INNER JOIN user_role_batch_course_enrollment
INNER JOIN batch_course_topic
INNER JOIN topics
INNER JOIN status
-- INNER JOIN topic_file
ON users.`user_id` = user_role.`user_id`
AND roles.`role_id` = user_role.`role_id`
AND batches.`batch_id` = batch_course.`batch_id`
AND courses.`course_id` = batch_course.`course_id`
AND user_role_batch_course_enrollment.`user_role_id` = user_role.`user_role_id`
AND user_role_batch_course_enrollment.`batch_course_id` = batch_course.`batch_course_id`
AND batch_course_topic.`batch_course_id` = batch_course.`batch_course_id`
AND batch_course_topic.`topic_id` = topics.`topic_id`
AND batch_course_topic.status_id = status.status_id
-- AND topics.topic_id = topic_file.topic_id
WHERE batch_course.batch_course_id = '".$batch_course_id."' 
AND user_role_batch_course_enrollment.status_id = 4
AND user_role.user_role_id = '".$user_role_id."' 
AND users.`user_id` = '".$user_id."'
ORDER BY batch_course_topic.topic_priority 
";
return $this->result = mysqli_query($this->connection,$this->query);
}




public function get_batch_course_students($batch_course_id){
$this->query = 
"	SELECT *
	FROM users 
	INNER JOIN user_role INNER JOIN roles INNER JOIN batches 
	INNER JOIN batch_course INNER JOIN courses 
	INNER JOIN user_role_batch_course_enrollment
	ON users.`user_id` = user_role.`user_id`
	AND roles.`role_id` = user_role.`role_id`
	AND batches.`batch_id` = batch_course.`batch_id`
	AND courses.`course_id` = batch_course.`course_id`
	AND user_role_batch_course_enrollment.`user_role_id` = user_role.`user_role_id`
	AND user_role_batch_course_enrollment.`batch_course_id` = batch_course.`batch_course_id`
	WHERE batch_course.batch_course_id = '".$batch_course_id."' 
	AND user_role_batch_course_enrollment.status_id = 4
	AND roles.`role_type` = 'student'
";
return $this->result = mysqli_query($this->connection,$this->query);

}

public function update_topic($status_id,$topic_id){
	$this->query = "UPDATE batch_course_topic SET status_id = '".$status_id."'
	WHERE topic_id = '".$topic_id."'
	";
	return $this->result = mysqli_query($this->connection,$this->query);
}

public function update_file($topic_file_id,$status_id,$topic_id){
	$this->query = "UPDATE topic_file SET status_id = '".$status_id."'
	WHERE topic_file_id = '".$topic_file_id."'
	AND topic_id = '".$topic_id."'
	";
	return $this->result = mysqli_query($this->connection,$this->query);
}

public function student_course($user_id,$batch_course_id,$user_role_id){
$this->query = "
SELECT topics.topic_id,topics.topic_title,topics.topic_description,
status.status,batch_course_topic.status_id
FROM users 
INNER JOIN user_role INNER JOIN roles INNER JOIN batches 
INNER JOIN batch_course INNER JOIN courses 
INNER JOIN user_role_batch_course_enrollment
INNER JOIN batch_course_topic
INNER JOIN topics
INNER JOIN status
-- INNER JOIN topic_file
ON users.`user_id` = user_role.`user_id`
AND roles.`role_id` = user_role.`role_id`
AND batches.`batch_id` = batch_course.`batch_id`
AND courses.`course_id` = batch_course.`course_id`
AND user_role_batch_course_enrollment.`user_role_id` = user_role.`user_role_id`
AND user_role_batch_course_enrollment.`batch_course_id` = batch_course.`batch_course_id`
AND batch_course_topic.`batch_course_id` = batch_course.`batch_course_id`
AND batch_course_topic.`topic_id` = topics.`topic_id`
AND batch_course_topic.status_id = status.status_id
-- AND topics.topic_id = topic_file.topic_id
WHERE batch_course.batch_course_id = '".$batch_course_id."' 
AND user_role_batch_course_enrollment.status_id = 4 
AND users.`user_id` = '".$user_id."'
AND user_role.user_role_id = '".$user_role_id."'
AND batch_course_topic.status_id =1
ORDER BY batch_course_topic.topic_priority 
";
return $this->result = mysqli_query($this->connection,$this->query);
}



public function add_topic_file($topic_id,$file_name,$file_path,$file_type){
$this->query = "INSERT INTO topic_file(topic_id,status_id,file_name,file_path,file_type,created_at)
VALUES('".$topic_id."','1','".$file_name."','".$file_path."','".$file_type."',NOW())
";
return $this->result = mysqli_query($this->connection,$this->query);
}





public function get_topic_files($topic_id){
		$this->query = "SELECT * FROM topic_file WHERE topic_id = '".$topic_id."' 
		";
return	$this->result = mysqli_query($this->connection,$this->query);
}


public function get_student_topic_files($topic_id){
		$this->query = "SELECT * FROM topic_file WHERE topic_id = '".$topic_id."'
		AND status_id = 1 
		";
return	$this->result = mysqli_query($this->connection,$this->query);
}


public function search_enrolled_user($batch_course_id,$user_role_id){
$this->query =" 
	SELECT * FROM users,user_role,roles,batches,courses,batch_course,user_role_batch_course_enrollment
WHERE users.`user_id` =  user_role.`user_id` 
AND roles.`role_id` = user_role.`role_id`
AND batches.`batch_id` = batch_course.`batch_id`
AND courses.`course_id` = batch_course.`course_id`
AND user_role.`user_role_id` = user_role_batch_course_enrollment.`user_role_id`
AND batch_course.`batch_course_id` = user_role_batch_course_enrollment.`batch_course_id`
AND user_role_batch_course_enrollment.`batch_course_id` = '".$batch_course_id."'
AND user_role_batch_course_enrollment.`user_role_id` = '".$user_role_id."'
";
return $this->result = mysqli_query($this->connection,$this->query);
}
 
public function search_enrolled_student($user_role_id,$role_id){
$this->query = "
SELECT * FROM users,user_role,roles,batches,courses,batch_course,user_role_batch_course_enrollment
WHERE users.`user_id` =  user_role.`user_id` 
AND roles.`role_id` = user_role.`role_id`
AND batches.`batch_id` = batch_course.`batch_id`
AND courses.`course_id` = batch_course.`course_id`
AND user_role.`user_role_id` = user_role_batch_course_enrollment.`user_role_id`
AND batch_course.`batch_course_id` = user_role_batch_course_enrollment.`batch_course_id`
AND user_role.user_role_id = '".$user_role_id."'
AND roles.role_id = '".$role_id."'
AND user_role_batch_course_enrollment.`status_id` = 4
";
return $this->result = mysqli_query($this->connection,$this->query);
}

public function switch_user_role_id($user_id,$role_id){
$this->query = "
	SELECT user_role_id FROM users,roles,user_role
	WHERE users.user_id = user_role.user_id
	AND roles.role_id = user_role.role_id
	AND users.user_id = '".$user_id."'
	AND roles.role_id = '".$role_id."'
";
return $this->result = mysqli_query($this->connection,$this->query);
}

public function edit_topic($topic_title,$topic_description,$topic_id){
	$this->query = "UPDATE topics SET topic_title = '".$topic_title."',
	topic_description ='".$topic_description."',updated_at = NOW() WHERE topic_id = '".$topic_id."'
	";
return $this->result = mysqli_query($this->connection,$this->query);
}




}

