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

    $notificationidset = getUnreadNotificationid($conn, $userid);

    if ($notificationidset) {
        foreach ($notificationidset as $notificationid){
            $notification = getUnreadNotificationDetails($conn, $notificationid[0]);
            if ($notification) {
            ?>
                <div class="notifi-item">
                    <img src="images/avatar1.png" alt="img">
                    <div class="text">
                    <h4><?php echo $notification["title"]; ?></h4>
                    <p><?php echo $notification["details"]; ?></p>
                    </div> 
                </div>
            <?php } 
        }
    } else { ?>
        <div class="text">
            <h5>There is no new notifications...</h5>
        </div> 

<?php }

}