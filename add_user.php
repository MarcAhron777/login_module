<?php

include 'includes/db.php';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Add User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>


<body class="bg-light">

    <div class="container mt-5">

        <div class="row justify-content-center">

            <div class="col-md-5">


                <div class="card shadow">


                    <div class="card-header bg-success text-white">

                    <h3>Add User</h3>

                    </div>


                    <div class="card-body">
                        <form id="addUserForm">
                            <input type="text" name="fullname" class="form-control mb-3" placeholder="Full Name" required>
                            <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
                            <input type="text" name="username" class="form-control mb-3" placeholder="Username" required>
                            <input type="password" id="password" name="password" class="form-control mb-3" placeholder="Password" required>

                            <div id="passwordMessage"></div>

                            <select name="role" class="form-control mb-3">
                                <option value="Admin">Admin</option>
                                <option value="User">User</option>
                            </select>

                            <button class="btn btn-success w-100">Save User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let password = document.getElementById("password");
        password.addEventListener("input", function(){
            let value = password.value;
            let length = value.length >= 8;
            let upper = /[A-Z]/.test(value);
            let lower = /[a-z]/.test(value);
            let number = /[0-9]/.test(value);
            let special = /[@$!%*?&]/.test(value);

            document.getElementById("passwordMessage").innerHTML = `

            <div class="mt-2">

            <p class="${length ? 'text-success':'text-danger'}">
            ${length ? '✔':'❌'} At least 8 characters
            </p>

            <p class="${upper ? 'text-success':'text-danger'}">
            ${upper ? '✔':'❌'} Uppercase letter (A-Z)
            </p>

            <p class="${lower ? 'text-success':'text-danger'}">
            ${lower ? '✔':'❌'} Lowercase letter (a-z)
            </p>

            <p class="${number ? 'text-success':'text-danger'}">
            ${number ? '✔':'❌'} Number (0-9)
            </p>

            <p class="${special ? 'text-success':'text-danger'}">
            ${special ? '✔':'❌'} Special character (@$!%*?&)
            </p>

            </div>

            `;

        });

        $("#addUserForm").submit(function(e){

            e.preventDefault();


            let value = password.value;

            let pattern=/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&]).{8,}$/;


            if(!pattern.test(value)){

                alert("Please complete the password requirements.");
                return;

            }


            $.ajax({

                url:"save_user.php",

                type:"POST",

                data:$(this).serialize(),


                success:function(response){

                    alert(response);

                    $("#addUserForm")[0].reset();

                    $("#passwordMessage").html("");

                },


                error:function(){

                    alert("Something went wrong.");

                }

            });
        });
    </script>
</body>
</html>