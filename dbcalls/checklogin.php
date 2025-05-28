<?php
    include("conn.php");
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_id = :user_id AND password = :password;");
    $stmt->bindParam(":user_id", $_POST['user_id']);
    $stmt->bindParam(":password", $_POST['password']);
    $stmt->execute();
    $result = $stmt->fetch();

    session_start();

if ($result){
    $_SESSION['user_id'] = $result['user_id'];
}
else{
    echo 'no account';
}