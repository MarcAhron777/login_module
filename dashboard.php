<?php

session_start();

if(!isset($_SESSION['user'])){

    header("Location: login.php");
    exit();

}

?>

<!DOCTYPE html>
<html>
<head>

    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="css/style.css">

</head>

<body class="bg-light">


<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">

    <div class="container">

        <a class="navbar-brand" href="#">
            Login System
        </a>


        <div class="d-flex">

            <a href="logout.php" class="btn btn-danger">
                Logout
            </a>

        </div>

    </div>

</nav>



<!-- Dashboard Content -->
<div class="container mt-5">


    <div class="row justify-content-center">


        <div class="col-md-8">


            <div class="card shadow">


                <div class="card-header bg-primary text-white">

                    <h3 class="mb-0">
                        Dashboard
                    </h3>

                </div>



                <div class="card-body text-center">


                    <h2>
                        Welcome,
                        <?php echo $_SESSION['user']; ?>
                    </h2>


                    <p class="text-muted">
                        You have successfully logged in to the system.
                    </p>


                    <hr>


                    <div class="row">


                        <div class="col-md-6">

                            <div class="card bg-light mb-3">

                                <div class="card-body">

                                    <h5>
                                        User Information
                                    </h5>

                                    <p>
                                        Name:
                                        <?php echo $_SESSION['user']; ?>
                                    </p>

                                    <p>
                                        Role:
                                        <?php echo $_SESSION['role']; ?>
                                    </p>

                                </div>

                            </div>

                        </div>



                        <div class="col-md-6">

                            <div class="card bg-light mb-3">

                                <div class="card-body">

                                    <h5>
                                        System Status
                                    </h5>

                                    <p class="text-success">
                                        Active Session
                                    </p>

                                    <p>
                                        Login successful
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="add_user.php" class="btn btn-success mt-3">
                        Add User
                    </a>

                    <a href="logout.php" class="btn btn-outline-danger mt-3">
                        Logout Account
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>