<?php 
require_once("../database/database_library.php");
if (!($_SESSION['user']['role_type']=='student')) {
    session_destroy();
    header("location:../login.php?class=danger&msg=Unauthorized access");
die;
}
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
                <h3 class="text-info" style="text-align: center;">STUDENT DASHBOARD</h3>
            </div>
        </div>
    </div>


<!-- 
<div class="row" style="height:70px">
    <div class="col-12 bg-info" style="">
        <div class="card-header bg-light mt-5 mb-1">
            <p><?php//  echo strtoupper($_SESSION['user']['first_name']." ".$_SESSION['user']['last_name']); ?></p>
        </div>
    </div>
</div> -->
<div class="row">
    <div class="col-3">
            <div class="card m-3 mt-5">
            <div class="card-header bg-info">
            NAVIGATION
            </div>
            <div class="card-body">
            <blockquote class="blockquote mb-0">
            <!-- <p>A well-known quote, contained in a blockquote element.</p> -->
            <p><a href="student_dashboard.php">Dashboard</a></p>
            <p>Site home</p>
            <p>Site site pages</p>
            <p>my courses</p>
            <footer class="blockquote-footer"><cite title="Source Title"></cite></footer>
            </blockquote>
            </div>
            </div>

    </div>
    <div class="col-6 text-center mt-5">
        <div class="card-header">
            <p>WELCOME <?php echo strtoupper($_SESSION['user']['first_name']." ".$_SESSION['user']['last_name']); ?></p>
        </div>



            <div class="card m-3">
                <div class="card-header">
                Topics
                </div>
                <div class="card-body">
                <!-- <blockquote class="blockquote mb-0"> -->
                        <?php 

                      $user_course = $dobj->student_course($_SESSION['user']['user_id'],$_REQUEST['batch_course_id'],$_SESSION['user']['user_role_id']);
                        // var_dump($user_course);
                      $count = 0;

                      while($user_topics = mysqli_fetch_assoc($user_course)){
                    // $topic_files =  $dobj->get_student_topic_files($course_topic['topic_id']);
                         ?>
                        <div class="accordion  mb-5" id="accordionFlushExample">
              
                            <?php  
                      // var_dump($user_course);
                      ?>
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                    <!-- <?php //echo $user_topics['topic_title']; ?> -->
                        
                        
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    Topic #<?php echo ++$count ?>
                  </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                  <div class="accordion-body">
                    <?php 
                    
                    ?>
                    <center>
                    <table cellpadding="30px" cellpadding="5px">
                    <p> <?php  echo $user_topics['topic_title'].": ".$user_topics['topic_description'];  ?> </p> <?php

                    $topic_files =  $dobj->get_student_topic_files($user_topics['topic_id']);
                     while($topic_file = mysqli_fetch_assoc($topic_files)){
                     ?>
                     <tr>
                         
                     <td>
                      <img src="<?php 
                      if($topic_file['file_type']=='doc'){
                        echo "../assets/word_icon.png"; 
                      }
                      else if($topic_file['file_type']=='ppt' || $topic_file['file_type']=='pptx'){
                        echo "../assets/ppt_icon.png";
                      } 
                      else if($topic_file['file_type']=='pdf'){
                        echo "../assets/pdf_icon.png";
                      }
                      else if($topic_file['file_type']=='jpg'||$topic_file['file_type']=='jpeg'||$topic_file['file_type']=='png'){
                        echo "../assets/image_icon.png";
                      }
                      ?>
                      " style="width: 30px;height: 30px;">
                     </td>
                     <td>
                         
                      <a href="<?php echo '../teacher/'.$topic_file['file_path'].'/'.$topic_file['file_name'] ?>"><?php echo $topic_file['file_name']; ?></a>
                     </td>
                     </tr>
                  <?php } 
                  ?>
                    </table>
                    </center>
                  </div>
                </div>
              </div>
            

              <?php 

               ?>
            </div>
            <?php
          }
          ?>
            </div>
        </div>



    </div>
    <div class="col-3 mt-5">
        <div class="card m-3">
        <div class="card-header bg-info">
        PRIVATE FILES
        </div>
        <div class="card-body">
        <blockquote class="blockquote mb-0">
        <!-- <p>A well-known quote, contained in a blockquote element.</p> -->
        <footer class="blockquote-footer"><cite title="Source Title"></cite></footer>
        </blockquote>
        </div>
        </div>
        <div class="card m-3">
        <div class="card-header bg-info">
        CALENDARS
        </div>
        <div class="card-body">
        <blockquote class="blockquote mb-0">
        <!-- <p>A well-known quote, contained in a blockquote element.</p> -->
        <footer class="blockquote-footer"><cite title="Source Title"></cite></footer>
        </blockquote>
        </div>
        </div>
        <div class="card m-3">
        <div class="card-header bg-info">
        UPCOMING EVENTS
        </div>
        <div class="card-body">
        <blockquote class="blockquote mb-0">
        <!-- <p>A well-known quote, contained in a blockquote element.</p> -->
        <footer class="blockquote-footer"><cite title="Source Title"></cite></footer>
        </blockquote>
        </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="card text-center">
  <!-- <div class="card-header bg-info"> -->
    <!-- Featured -->
  <!-- </div> -->
  <div class="card-body bg-info">
    <h5 class="card-title">GOOD EDUCATION IS A TICKET TO QUALITY LIFE</h5>
    <p class="card-text">We will open the world of knowledge for you!... We outstrip social needs in education!</p>
    <a href="#" class="btn btn-primary">View more</a>
  </div>
  <!-- <div class="card-footer text-muted"> -->
    <!-- 2 days ago -->
  <!-- </div> -->
</div>
</div>
    <div class="row">
        <div class="col-12 bg-light">
            <h4>ALL ABOUT HIST</h4>
            <ul>
                <li><a href="FAQ.php" id="FAQ">What does hist stands for</a></li>
            </ul>
        </div>
    </div>




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

 ?>