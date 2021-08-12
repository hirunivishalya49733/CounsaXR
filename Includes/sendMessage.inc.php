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


if(isset($_GET["action"])) {
    echo '<script> console.log("Hi") </script>';
    if($_GET["action"] == "sendMessage") {
        $msg = $_POST['msg'];

        if( !isset($_SESSION["userid"]) ){
            header("location: ../Login/Login.php");
            exit();
        }
        $senderid = $_SESSION["userid"];
        sendMessage($conn, $msg, $senderid);
        
    }else if($_GET["action"] == "openMessage") {
        $msg = $_POST['msg'];
        $receiverid = $msg['recevId'];
        $_SESSION["receiverid"] = $receiverid;
        echo '<script> console.log("Hi") </script>';
    }

}


