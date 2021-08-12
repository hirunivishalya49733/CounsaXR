<?php

function emptyInputSignupAdmin($username, $useruid, $email, $pwd, $confirmpwd) {
    if(empty($username) || empty($useruid) || empty($email) || empty($pwd) || empty($confirmpwd)){
        return true;
    }
    return false;
}

function emptyInputSignupPatient($fullname, $username, $email, $birthdate, $avgearning, $occupation, $mobilenumber, $orientation, $relation, $isreligious, $evercounseled, $physicalhealth, $eatinghabbit, $isdepressed, $ispleasure, $sex, $pwd, $confirmpwd) {
    if(empty($fullname) || empty($username) || empty($email) || empty($birthdate) || empty($avgearning) || empty($occupation) || empty($mobilenumber) || empty($orientation) || empty($relation) || empty($isreligious) || empty($evercounseled) || empty($physicalhealth) || empty($eatinghabbit) || empty($isdepressed) || empty($ispleasure) || empty($sex) || empty($pwd)|| empty($confirmpwd)) {
        return true;
    }
    return false;
}

function emptyInputSignupCounselor($username, $fullname, $email, $appointedyear, $registrationnumber, $mobilenumber, $city, $pwd, $confirmpwd) {
    if(empty($username) || empty($fullname) || empty($email) || empty($appointedyear) || empty($registrationnumber) || empty($mobilenumber) || empty($city) || empty($pwd) || empty($confirmpwd)){
        return true;
    }
    return false;
}

function emptyInputPost($title, $detail) {
    if(empty($title) || empty($detail)){
        return true;
    }
    return false;
}

function emptyInputLogin($username, $pwd) {
    if(empty($username) || empty($pwd)){
        return true;
    }
    return false;
}

function invalidEmail($email) {
    if( !filter_var($email, FILTER_VALIDATE_EMAIL) ){
        return true;
    }
    return false;
}

function invalidUserName($username) {
    if(!preg_match('/^[a-zA-Z0-9]+/', $username)){
        return true;
    }
    return false;
}

function doesntMatchPassword($pwd, $confirmpwd) {
    if($pwd !== $confirmpwd){
        return true;
    }
    return false;
}

function existUser($conn, $username) {
    $sql = "SELECT userid FROM users WHERE username = ?;" ;
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        return "stmtfailed";
    }
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    if(!mysqli_fetch_assoc($resultData)){
        return false;
    }else{
        return true;
    }
    mysqli_stmt_close($stmt);

}

function existEmail($conn, $email) {
    $sql = "SELECT userid FROM users WHERE email = ?;" ;
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        return "stmtfailed";
    }
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    if(!mysqli_fetch_assoc($resultData)){
        return false;
    }else{
        return true;
    }
    mysqli_stmt_close($stmt);

}

function createPatient($conn, $fullname, $username, $email, $birthdate, $avgearning, $occupation, $mobilenumber, $orientation, $relation, $isreligious, $evercounseled, $physicalhealth, $eatinghabbit, $isdepressed, $ispleasure, $sex, $pwd) {
    $sql = "INSERT INTO users ( fullname, username, email, birthdate, avgearning, occupation, mobilenumber, orientation, relation, isreligious, evercounseled, physicalhealth, eatinghabbit, isdepressed, ispleasure, sex, pwd, usertype) VALUES( ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?);" ;
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../Register/Register.html?error=stmtfailed");
        exit();
    }

    $usertype = "PT";
    $hashpwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssssssssssssssssss", $fullname, $username, $email, $birthdate, $avgearning, $occupation, $mobilenumber, $orientation, $relation, $isreligious, $evercounseled, $physicalhealth, $eatinghabbit, $isdepressed, $ispleasure, $sex, $hashpwd, $usertype);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    header("location: ../Login/Login.html");
    exit();

}

function createAdmin($conn, $username, $useruid, $email, $pwd) {
    $sql = "INSERT INTO users (username, email, useruid, pwd, usertype) VALUES( ?, ?, ?, ?, ?);" ;
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signupAdmin.php?error=stmtfailed");
        exit();
    }

    $usertype = "AD";
    $hashpwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssss", $username, $email, $useruid, $hashpwd, $usertype);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    header("location: ../Login/Login.html");
    exit();

}

function createCounselor($conn, $username, $fullname, $email, $appointedyear, $registrationnumber, $mobilenumber, $city, $pwd) {
    $sql = "INSERT INTO users (username, fullname, email, appointedyear, registrationnumber, mobilenumber, city, pwd, usertype) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?);" ;
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../Register/Register.html?error=stmtfailed");
        exit();  
    }
    $usertype = "CN";
    $hashpwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssssssss", $username, $fullname, $email, $appointedyear, $registrationnumber, $mobilenumber, $city, $hashpwd, $usertype);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    header("location: ../Login/Login.html");
    exit();

}

function loginUser($conn, $username, $pwd) {
    $uidExist = existEmailorId($conn, $username);

    if($uidExist === false){
        header("location: ../Login/Login.html?error=unregisteredUser");
        exit();
    }else{
        $pwdHashed = $uidExist["pwd"];
        $checkpwd = password_verify($pwd, $pwdHashed);
        if($checkpwd === false){
            header("location: ../Login/Login.html?error=invalidloginInfo");
            exit();
        }else if($checkpwd === true){
            session_start();
            $_SESSION["userid"] = $uidExist["userid"];
            $_SESSION["username"] = $uidExist["username"];
            $_SESSION["usertype"] = $uidExist["usertype"];
            if ($_SESSION["usertype"] === "CN"){
                header("location: ../CounselorPage.php");
            }else{
                header("location: ../PatientPage.php");
            }
            exit();
        }
    }

}

function existEmailorId($conn, $username) {
    $sql = "SELECT * FROM users WHERE username = ? OR email = ?;" ;
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../Login/Login.html?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $username, $username);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        return false;
    }
    mysqli_stmt_close($stmt);
}

function createPost($conn, $slug, $details, $persona, $userid){
    $sql = "INSERT INTO post ( counselerid, category, details, persona, postdate) VALUES ( ?, ?, ?, ?, ?);" ;
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../CounselorPage.php?error=stmtfailed");
        exit();
    }

    $date = date("Y-m-d");

    mysqli_stmt_bind_param($stmt, "sssss", $userid, $slug, $details, $persona, $date);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    header("location: ../CounselorPage.php");
    exit();
}

function getPostForPatient($conn, $slug) {
    $sql = "SELECT * FROM post WHERE category = ?;" ;
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $slug);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_all($resultData)){
        return $row;
    }else{
        return false;
    }
    mysqli_stmt_close($stmt);
}

function getPostForCounselor($conn, $userid) {
    $sql = "SELECT * FROM post WHERE counselerid = ?;" ; 
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $userid);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_all($resultData)){
        return $row;
    }else{
        return false;
    }
    mysqli_stmt_close($stmt);
}

function getUserDetail($conn, $userid){
    $sql = "SELECT * FROM users WHERE userid = ?;" ;
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        exit();
    }
    mysqli_stmt_bind_param($stmt, "i", $userid);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        return false;
    }
    mysqli_stmt_close($stmt);
}

function sendMessage($conn, $msg, $sender) {		
    
    $recvId      = $msg['recvId'];
    $body        = $msg['body'];
    $status      = $msg['status'];
    $recvIsGroup = 0;

    if( isset($_SESSION['receiverid']) ){
        $recvId = $_SESSION["receiverid"];
    }
                            
    $sql = "INSERT INTO messages ( senderid, receiverid, messagecontent, messagetime, isread) VALUES ( ?, ?, ?, ?, ?);" ; // Change this ** counselorid **
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        exit();
    }
    $date = date("Y-m-d H:i:s");

    mysqli_stmt_bind_param($stmt, "sssss", $sender, $recvId, $body, $date, $status);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    header("Refresh:0; url=MessageBox.php");
    exit();

}

function getUnreadNotificationid($conn, $userid){
    $sql = "SELECT notificationid FROM notificationuser WHERE userid = ? AND isread = ?;" ;
    $stmt = mysqli_stmt_init($conn);
    $status = 1;
    if(!mysqli_stmt_prepare($stmt, $sql)){
        exit();
    }
    mysqli_stmt_bind_param($stmt, "si", $userid, $status);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    // mysqli_stmt_close($stmt);

    if($rows = mysqli_fetch_all($resultData)){
        return $rows;
    }else{
        return false;
    }
}

function getCountUnreadNotifications($conn, $userid){
    $sql = "SELECT COUNT(userid) as count FROM notificationuser WHERE userid = ? AND isread = ?" ;
    $stmt = mysqli_stmt_init($conn);
    $status = 1;
    if(!mysqli_stmt_prepare($stmt, $sql)){
        exit();
    }
    mysqli_stmt_bind_param($stmt, "si", $userid, $status);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    // mysqli_stmt_close($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        return false;
    }
}


function getUnreadNotificationDetails($conn, $notificationid){
    $sql = "SELECT * FROM notification WHERE notificationid = ?;" ;
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $notificationid);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);
    // mysqli_stmt_close($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        return false;
    }
}

function getUnreadChatList($conn, $sender) {
    $sql = "SELECT * FROM messages WHERE receiverid = ? AND isread = ? ORDER BY messagetime DESC;" ;
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        exit();
    }
    $isread = 1;
    mysqli_stmt_bind_param($stmt, "si", $sender, $isread);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    $recentMessages = [];
    $capturedUser = [];


    if($rows = mysqli_fetch_all($resultData)){
        foreach ($rows as $row){
            if( !in_array($row[2], $capturedUser) ){
                array_push($recentMessages, $row);
                array_push($capturedUser, $row[1]);
            }
        }
        return $recentMessages;
    }else{
        return false;
    }
}

function getChatList($conn, $sender) {
    $sql = "SELECT * FROM messages WHERE senderid = ? ORDER BY messagetime DESC;" ;
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        exit();
    }
    mysqli_stmt_bind_param($stmt, "s", $sender);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    $recentMessages = [];
    $capturedUser = [];

    mysqli_stmt_close($stmt);

    if($rows = mysqli_fetch_all($resultData)){
        foreach ($rows as $row){
            if( !in_array($row[2], $capturedUser) ){
                array_push($recentMessages, $row);
                array_push($capturedUser, $row[2]);
            }
        }
        return $recentMessages;
    }else{
        return false;
    }
}

function getMessages($conn, $senderid, $reciverid) {
    $sql = "SELECT * FROM messages WHERE (senderid = ? AND receiverid = ?) OR (senderid = ? AND receiverid = ?) ORDER BY messagetime DESC LIMIT 6;" ;
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ssss", $senderid, $reciverid, $reciverid, $senderid);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    if($rows = mysqli_fetch_all($resultData)){
        return $rows;
    }else{
        return false;
    }
    mysqli_stmt_close($stmt);
}