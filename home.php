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
<div class="col-sm-2"></div>
<div class="col-sm-8 mt-5 p-3">
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="assets/image(11).jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>First slide label</h5>
        <p>Some representative placeholder content for the first slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="assets/image(12).jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Second slide label</h5>
        <p>Some representative placeholder content for the second slide.</p>
      </div>
    </div>
    <div class="carousel-item">
      <img src="assets/image(7).jpg" class="d-block w-100" alt="...">
      <div class="carousel-caption d-none d-md-block">
        <h5>Third slide label</h5>
        <p>Some representative placeholder content for the third slide.</p>
      </div>
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</div>

<div class="col-sm-2"></div>    
</div>

<div class="row">
    <div class="col-2">
<!--         <div class="card">
        <div class="card-header">
        Navigation
        </div>
        <div class="card-body">
        <h5 class="card-title"></h5>
        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        <a href="#" class="btn btn-primary">Go to...</a>
        </div>
        </div> -->
    </div>
    <div class="col-8">
            <div class="accordion" id="accordionPanelsStayOpenExample">
    <div class="accordion-item" id="about">
    <h2 class="accordion-header" id="panelsStayOpen-headingOne">
    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
    About Us
    </button>
    </h2>
    <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
    <div class="accordion-body">
    <strong>This is the first item's accordion body.</strong> It is shown by default, until the collapse plugin adds the appropriate classes that we use to style each element. These classes control the overall appearance, as well as the showing and hiding via CSS transitions. You can modify any of this with custom CSS or overriding our default variables. It's also worth noting that just about any HTML can go within the <code>.accordion-body</code>, though the transition does limit overflow.
    </div>
    </div>
    </div>
  </div>
    <h1 class="display-1 text-success" id="contact">Contact Us</h1>
    <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
    </div>
    <div class="mb-3">
    <label for="exampleFormControlTextarea1" class="form-label">Query</label>
    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
    </div>
    <button class="btn btn-outline-success">Submit
      
    </button> 

        <h1 class="text-info" id="ourteam"> Our Team</h1>
    <div class="card mb-3" style="max-width: 100%;">
    <div class="row g-0">
    <div class="col-md-4">
    <img src="images/image.jpg" class="img-fluid rounded-start" alt="Image Not Found">
    </div>
    <div class="col-md-8">
    <div class="card-body">
    <h5 class="card-title">Mr.X</h5>
    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
    </div>
      </div>
    </div>
        <div class="card mb-3" style="max-width: 100%;">
    <div class="row g-0">
    <div class="col-md-4">
    <img src="images/image.jpg" class="img-fluid rounded-start" alt="Image Not Found">
    </div>
    <div class="col-md-8">
    <div class="card-body">
    <h5 class="card-title">Mr.Y</h5>
    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
    </div>
    </div>
      </div>
    </div>




    </div>
    <div class="col-2">
<!--         <div class="card">
        <div class="card-header">Quotes</div>
        <div class="card-body">
        <h5 class="card-title"></h5>
        <p class="card-text">Quote of the day with supporting text</p>
         <a href="#" class="btn btn-primary">Go somewhere</a> 
        </div>
        </div> -->
    </div>
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