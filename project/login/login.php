<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../styles/styles.css">
    <style>
        .title {
            font-size: 2.25rem;
            font-weight: 700;
            color: black;
            text-align: center;
            margin: auto;
        }

        .split {
            height: 1000px;
        }

        .left {
            background: linear-gradient(rgba(0, 0, 0, 0),
                    rgba(0, 0, 0, 1)), url('../assets/bird-bg.jpg');
            background-size: cover;
            background-position: center;
        }

        .btn-styling {
            width: 250px;
            height: 60px;
            font-weight: 650;
            font-size: 20px;
            border-radius: 12px;
        }

        @media only screen and (min-width: 992px) {
            .split {
                height: 100vh;
            }
        }

        @media only screen and (max-width: 992px) {
            .left {
                height: 350px;
            }

            .right {
                height: 600px;
            }

            .center{
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <!-- Split -->
    <div class="container-fluid">
        <div class="row split">
            <div class="col-12 col-lg-8 left">
            </div>
            <div class="col-12 col-lg-4 right ps-5 pe-5">
                <img src="../assets/twix-logo.png" alt="twiX logo" class="center mt-4 mb-5" style="width: 230px;">
                <br>
                <h4 class="mb-3 center">Join now.</h4>
                <button id="signin" class="btn btn-styling center" style="background-color: #0cd3ff; color:#fff;">Sign In</button>
                <br><br><br>
                <h4 class="mb-3 center">Already have an account?</h4>
                <button id="login" class="btn btn-styling center" style="background-color: #ffffff; color:#0cd3ff; border: 1px solid #ccc;">Log In</button>
            </div>
        </div>
    </div>

    <!-- Sign in Modal -->
    <div class="modal fade" id="signin-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: #2C3E50; color:#fff;">
                <div class="modal-header">
                    <img src="../assets/birdx-transparent.png" alt="" style="width: 50px;">
                    <h1 class="modal-title fs-5 center" id="staticBackdropLabel" style="text-align: center;">Sign In</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" class="form">
                    <div class="mb-3">
                            <label for="fullname" class="form-label">Full Name</label>
                            <input type="text" class="form-control" id="signin-fullname" placeholder="full name">
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="signin-username" placeholder="username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="signin-password" placeholder="password">
                        </div>
                        <button type="button" class="btn btn-secondary float-end" data-bs-dismiss="modal">Cancel</button>
                        <button id="create-account" type="button" class="btn me-2 float-end" style="background-color: #189cef; color:#fff;">Create Account</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Log in Modal -->
    <div class="modal fade" id="login-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: #2C3E50; color:#fff;">
                <div class="modal-header">
                    <img src="../assets/birdx-transparent.png" alt="" style="width: 50px;">
                    <h1 class="modal-title fs-5 center" id="staticBackdropLabel" style="text-align: center;">Log In</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" class="form">
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="login-username" placeholder="username">
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="login-password" placeholder="password">
                        </div>
                        <button type="button" class="btn btn-secondary float-end" data-bs-dismiss="modal">Cancel</button>
                        <button id="login-account" type="button" class="btn me-2 float-end" style="background-color: #189cef; color:#fff;">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(function() {
            $("#signin").click(function() {
                $("#signin-username").val("");
                $("#signin-password").val("");
                $("#signin-fullname").val("");
                $("#signin-modal").modal("toggle");
            });

            $("#login").click(function() {
                $("#login-username").val("");
                $("#login-password").val("");
                $("#login-modal").modal("toggle");
            });

            $("#create-account").click(function() {
                var username = $("#signin-username").val();
                var password = $("#signin-password").val();
                var fullname = $("#signin-fullname").val();

                if (username.length && password.length && fullname.length) {
                    var input = {
                        "username": username, 
                        "password": password,
                        "fullname":fullname
                    };

                    $.ajax({
                        url: "createAccount.php", 
                        type: "post", 
                        data: input, 
                        success: function(response) { 
                            if(response === "Y")
                            {
                                Swal.fire({
                                    icon: "success",
                                    title: "Account Created",
                                    text: "Please log in.",
                                    timer: 1500
                                });
                            }
                            else if(response === "N")
                            {
                                Swal.fire({
                                    icon: "error",
                                    title: "Can't Create Account",
                                    text: "Error creating account.",
                                    timer: 1500
                                });
                            }
                            else
                            {
                                Swal.fire({
                                    icon: "error",
                                    title: "Can't Create Account",
                                    text: response,
                                    timer: 1500
                                });
                            }
                        },
                        error: function(responseData, textStatus, errorThrown) {
                            Swal.fire({
                                icon: "error",
                                title: "Can't Create Account",
                                text: "System error.",
                                timer: 1500
                            });
                        }
                    });
                } 
                else {
                    Swal.fire({
                        icon: "error",
                        title: "Can't Create Account",
                        text: "Please fill the input.",
                        timer: 1500
                    });
                }

                $("#signin-modal").modal("toggle");
            });

            $("#login-account").click(function() {
                var username = $("#login-username").val();
                var password = $("#login-password").val();

                if (username.length && password.length) {
                    var input = {
                        "username": username, 
                        "password": password
                    };

                    $.ajax({
                        url: "loginAccount.php", 
                        type: "post", 
                        data: input, 
                        success: function(response) { 
                            if(response === "Y")
                            {
                                Swal.fire({
                                    icon: "success",
                                    title: "Login Successful",
                                    text: "Directing to homepage...",
                                    timer: 1500,
                                    
                                });
                                
                                $.ajax({
                                    url: "saveUsername.php",
                                    type: "post",
                                    data: {"username": username},
                                    success: function(response) {
                                        console.log(response);
                                        window.location.href = "../homepage/index.php";
                                    },
                                    error: function(error) {
                                        console.log(error);
                                    }
                                });
                            }
                            else
                            {
                                Swal.fire({
                                    icon: "error",
                                    title: "Can't Login",
                                    text: "Username/password wrong.",
                                    timer: 1500
                                });
                            }
                        },
                        error: function(responseData, textStatus, errorThrown) {
                            Swal.fire({
                                icon: "error",
                                title: "Can't Login",
                                text: "System error.",
                                timer: 1500
                            });
                        }
                    });
                } 
                else {
                    Swal.fire({
                        icon: "error",
                        title: "Can't Login",
                        text: "Please fill the input.",
                        timer: 1500
                    });
                }

                $("#login-modal").modal("toggle");
            });
        });
    </script>
</body>

</html>