<?php
    include("conn.php");
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email AND password = :password;");
    $stmt->bindParam(":email", $_POST['email']);
    $stmt->bindParam(":password", $_POST['password']);
    $stmt->execute();
    $result = $stmt->fetch();

    session_start();

if ($result){
    $_SESSION['user_id'] = $result['user_id'];
    $_SESSION['role_id'] = $result['role_id'];
    header('location: ../index.php');
}
else{
    echo 'incorrect email or password';
}