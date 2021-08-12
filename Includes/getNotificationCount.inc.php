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


if ( isset($_SESSION["userid"]) ) {
    
    $userid = $_SESSION["userid"];
    $notificationcount = getCountUnreadNotifications($conn, $userid);

    if ( $notificationcount["count"] !== 0 ){
        echo  '<span>' . $notificationcount["count"] . '</span>';
    } else {
        echo  '<span>0</span>';
    }
}