<?php 	

if (isset($_REQUEST['action']) && $_REQUEST['action']=='logout') {
	session_start();
	session_destroy();
	header("location:login.php?msg=logout successful &class=danger");
}

