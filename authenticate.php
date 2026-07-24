<?php
    session_start();
    include 'includes/db.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    if(empty($username) || empty($password)){

        echo "Please enter both username and password.";
        exit();

    }

    $sql = "SELECT * FROM users 
            WHERE username='$username' 
            OR email='$username'";

    $result = $conn->query($sql);


    if($result->num_rows > 0){

        $user = $result->fetch_assoc();
        
        if($user['failed_attempts'] >= 5){
            echo "Your account has been locked due to multiple failed login attempts.";
            exit();
        }
        // $password_hash = password_hash($user['password'], PASSWORD_DEFAULT);

        if(password_verify($password, $user['password'])){

            $reset = "UPDATE users 
                    SET failed_attempts = 0 
                    WHERE id=".$user['id'];

            $conn->query($reset);

            $_SESSION['user'] = $user['fullname'];
            $_SESSION['role'] = $user['role'];

            echo "success";
            // header("Location: dashboard.php");
            exit();


        } else {

            $attempt = $user['failed_attempts'] + 1;

            $update = "UPDATE users SET failed_attempts='$attempt' WHERE id=".$user['id'];

            $conn->query($update);

            if($attempt >= 5){
                echo "Your account has been locked due to multiple failed login attempts.";
            } else {
                echo "Invalid username or password.";
            }
        }

    } else {
        echo "Invalid username or password.";
    }
?>