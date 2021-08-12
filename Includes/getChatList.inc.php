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

if ( isset($_SESSION['userid']) ){
    $userid = $_SESSION['userid'];
    $chatList = getChatList($conn, $userid);

    if(!$chatList){
        exit();
    }

    $_SESSION["receiverid"] = $chatList[0][2];

    foreach ($chatList as $chatRow) {
        $userDetails = getUserDetail($conn, $chatRow[2]);

        if(!$userDetails){
            exit();
        }   ?>

        <div class="counselors counselors--onhover" id= "<?php echo $chatRow[2]; ?>" style="cursor:pointer;" onclick="openChat(this.id)">
            <img class="profile-image" src="images/physical/phy-1.png">
            <div class="text-message">
                <h6> <?php echo $userDetails['fullname']; ?></h6>
                <p class="text-muted"> <?php echo $chatRow[3] ?></p> 
            </div>
            <span class="message-time text-muted small"> <?php echo $chatRow[4] ?> </span>
        </div>
        <hr id="hr2">
<?php
    }
}
