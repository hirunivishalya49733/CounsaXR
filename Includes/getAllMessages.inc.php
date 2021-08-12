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

if( isset($_SESSION['receiverid']) ){
    $reciverid = $_SESSION["receiverid"];
}
$senderid = $_SESSION["userid"];

$rows = getMessages($conn, $reciverid, $senderid);

if ( $rows ){
    foreach (array_reverse($rows) as $row){
        if ($row[1] == $reciverid){
    ?>
            <div class="row no-gutters">
                <div class="col-md-4">
                    <div class="chat-bubble chat-bubble--left" >
                        <?php echo $row[3]; ?>
                    </div>
                </div>
            </div>
    <?php } else { ?>
            <div class="row no-gutters">
                <div class="col-md-4 offset-md-7">
                    <div class="chat-blue chat-bubble--right" >
                    <?php echo $row[3]; ?>
                    </div>
            
                </div>
            </div>
    <?php }
    }
}