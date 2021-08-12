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


if ( isset($_SESSION['userid']) ){
    
    $userid = $_SESSION['userid'];
    $chatList = getUnreadChatList($conn, $userid);

    if(!$chatList){
        echo  '<span>0</span>'; 
    } else {
        echo  '<span>' . sizeof($chatList) . '</span>'; 
    }
    
}