<?php
    include 'includes/db.php';

    $fullname=$_POST['fullname'];
    $email=$_POST['email'];
    $username=$_POST['username'];
    $password=$_POST['password'];
    $role=$_POST['role'];


    $check = "SELECT * FROM users WHERE username='$username' OR email='$email'";

    $result = $conn->query($check);


    if($result->num_rows > 0){
        echo "Username or email already exists.";
        exit();
    }

    $hash = password_hash($password, PASSWORD_DEFAULT);

    $sql="INSERT INTO users(fullname, email, username, password, role, failed_attempts) VALUES ('$fullname','$email','$username','$hash','$role',0)";

    if($conn->query($sql)){
        echo "User successfully added.";
    } else {
        echo "Error: ".$conn->error;
    }
?>