<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/PatientPage.css">
  <link rel="stylesheet" href="css/Footer.css">
  <link rel="stylesheet" href="css/Navigation.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
 	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
 	<link href="https://fonts.googleapis.com/css2?family=Monoton&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
	<title>HealthCoach Therapy | CounsaXR</title>
</head>
<body>

<!-- Header-->
<?php include_once("Header.php"); ?>
<?php 
if(session_id() == ''){
  session_start();
}
  if( !(isset($_SESSION["userid"])) ){
      header("location: index.php");
      exit();
  }
?>


</header>

<!--search button!-->
<div class="x"></div>
<section>  
   <div class="search">
    <form >
     <div>
          <input type="text" class="search-field name" style="border-style:groove;" placeholder="search by Doctor">
          <input type="text" class="search-field disease" style="border-style:groove;" placeholder="search by Disease">
          <select style="border-style:groove;">
            <option disabled selected>Location</option>
            <option>Colombo</option>
            <option>Kandy</option>
            <option>Galle</option>
            <option>Ampara</option>
            <option>Anuradhapura</option>
            <option>Badulla</option>
            <option>Batticaloa</option>
            <option>Gampaha</option>
            <option>Hambantota</option>
            <option>Jaffna</option>
            <option>Kalutara</option>
            <option>Kegalle</option>
            <option>Kilinochchi</option>
            <option>Kurunegala</option>
            <option>Mannar</option>
            <option>Matale</option>
            <option>Matara</option>
            <option>Monaragala</option>
            <option>Mulativu</option>
            <option>NuwaraEliya</option>
            <option>Polonnaruwa</option>
            <option>Puttalam</option>
            <option>Ratnpura</option>
            <option>Trincomalee</option>
            <option>Vavuniya</option>

          </select>
          <button style="border-style:groove"; class="search-btn" type="button">search</button>
        </div>
      
    </form>
  </div>

    </form>
  </div>
  </section>

<section>
  <div class="image">
    <img  src="images/healthcoach/healthcoach-logo1.jpg" class="d-block w-100">
  </div>  
</section>

<section>
  <div class="container pt-5">
    <hr id="hr2"><br>
    <h3 class="mt-3 text-center" style="letter-spacing: 2px;">Meet our Physical Therapists all by time!...</h3><br><br><hr id="hr2"><br>
  </div>
</section>

<!--Card_gigs-->
<section>
<div class="container-fluid mt-5 bgn row">

<?php
  $slug = "Health Coach"; 
  include_once "Includes/getPost.inc.php"; 
?>

</div>
<!--end of card2-->
<nav aria-label="Page navigation example" class="mt-3">
  <ul class="pagination justify-content-center">
    <li class="page-item disabled">
      <a class="page-link" href="#" tabindex="-1">Previous</a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>
</div>
</section>

<!-- Footer-->
<?php include_once("Footer.php"); ?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/2.0.2/anime.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script>
<script src="js/Message.js"></script>
<script src="js/Notification.js"></script>
<script src="js/logotext.js"></script>
</body>
</html>
