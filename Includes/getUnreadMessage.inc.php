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


    if(!$chatList){ ?>
        <div class="text">
            <h5>There is no new messages...</h5>
        </div> 

<?php   } else{

        foreach ($chatList as $chatRow) {
            $userDetails = getUserDetail($conn,  $chatRow[1]);

            if(!$userDetails){ ?>
                <div class="text">
                    <h4>There is no new messages...</h4>
                </div> 

    <?php   } else {  ?>
                <a href="MessageBox.php">
                    <div class="notifi-item">
                        <img src="images/avatar1.png" alt="img">
                        <div class="text">
                            <h4><?php echo $userDetails['fullname']; ?></h4>
                            <p><?php echo $chatRow[3] ?></p>
                        </div> 
                    </div> 
                </a>
        <?php
            }
        }
    }
}