<?php
    include("conn.php");
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username AND password = :password;");
    $stmt->bindParam(":username", $_POST['username']);
    $stmt->bindParam(":password", $_POST['password']);
    $stmt->execute();
    $result = $stmt->fetch();

    session_start();

if ($result){
    $_SESSION['username'] = $result['username'];
}
else{
    echo 'no bitches?';
}