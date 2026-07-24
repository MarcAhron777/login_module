<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h3>Login</h3>
                    </div>

                    <div class="card-body">
                        <form id="loginForm">
                        <!-- <form action="authenticate.php" method="POST"> -->
                            <input type="text" name="username" class="form-control mb-3" placeholder="Username or Email">
                            <input type="password" name="password" class="form-control mb-3" placeholder="Password">

                            <div class="form-check mb-3">
                                <input type="checkbox" name="remember" class="form-check-input">
                                <label class="form-check-label">Remember Me</label>
                            </div>

                            <div id="message"></div>

                            <button class="btn btn-primary w-100"> Login </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.querySelector("form").onsubmit=function(){
            let u=document.getElementsByName("username")[0].value;
            let p=document.getElementsByName("password")[0].value;
            if(u=="" || p==""){
                alert("Please enter both username and password.");
                return false;
            }
        }

        $(document).ready(function(){
            $('#loginForm').submit(function(e) {
                e.preventDefault();

                let username = $("input[name='username']").val();
                let password = $("input[name='password']").val();

                if(username == "" || password == ""){
                    $("#message").html(
                        '<div class="alert alert-warning">Please enter both username and password.</div>'
                    );
                    return;
                }

                $.ajax({
                    url: "authenticate.php",
                    type: "POST",
                    data: $(this).serialize(),
                    success:function(response){
                        if(response.trim() == "success"){
                            window.location.href = "dashboard.php";
                        } else {
                            $("#message").html(
                                '<div class="alert alert-danger">'
                                + response +
                                '</div>'
                            );
                        }
                    },
                    error:function(){
                        $("#message").html(
                            '<div class="alert alert-danger">Server error.</div>'
                        );
                    }
                });
            });
        });
    </script>
</body>
</html>