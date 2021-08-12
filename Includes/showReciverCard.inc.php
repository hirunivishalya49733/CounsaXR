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
if(!@include_once('Includes/openChat.inc.php')) {
    include_once("Includes/openChat.inc.php");
}

if( isset($_SESSION['receiverid']) ){
    $reciverid = $_SESSION["receiverid"];
}

$row = getUserDetail($conn, $reciverid);

if( $row ){ ?>
    <div class="counselors no-gutters">
        <img class="profile-image" src="images/physical/phy-1.png">
        <div class="text-message">
            <h6> <?php echo $row['fullname']; ?> </h6>
            <p class="text-muted">Hello!. Im there to counsel you.</p> 
        </div>
        <span class="float-end"><i class="fas fa-sync-alt" onclick="window.location.reload();"></i></span>
    </div>
<?php 
}
