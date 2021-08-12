<?php 

if(session_id() == ''){
    session_start();
}

if(!@include_once('functions.inc.php')) {
    include_once("functions.inc.php");
}
if(!@include_once('dbh.inc.php')) {
    include_once("dbh.inc.php");
}

$postDetails = getPostForPatient($conn, $slug);
$displayIndex = 0;

if( $postDetails ) {

foreach ($postDetails as $postDetail){
    if ( sizeof($postDetail)>0 ){
    $user = getUserDetail($conn, $postDetail[1]);
?>
    <!--card1-->
    <div class="col-12 col-sm-6 col-md-6 col-lg-3 mt-3">
        <a href="" data-toggle="modal" data-target="#exampleModalCenter1">
        <div class="card" style="max-height: 1000px;">
            <img class="center" style="border-radius: 80px;" src="images/mental/mental-1.jpg"></a>
            <hr id="hr1">
            <div class="card-body">
                <h5 class="card-title text-center">Dr.<?php echo $user["fullname"]; ?></h5>
                <p class="card-text"> <?php echo $postDetail[3]; ?> </p>
                <br>
                <p><?php echo $postDetail[4]; ?>
            </div>
            <div class="container">
                <i class="fas fa-star"></i>
                <span class="pl-1">5.0</span><div class="modal-footer"><a href="MessageBox.php"><button type="button" class="btn btn-primary">Message</button></a></div>
            </div>
        </div>
    </div>
  <!--end of card1-->
<?php } } } ?>