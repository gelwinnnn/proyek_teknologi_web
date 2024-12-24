<?php
require("../connection/koneksi.php");
require("../include/index.php");
session_start();

//login admin
if (isset($_POST['login'])) {
    $sql = "SELECT * FROM `admin` WHERE username='" . $_POST['username'] . "' AND
    pass='" . $_POST['pass'] . "'";
    $stmt = $conn->query($sql);
    $row_count = $stmt->rowCount();
    $stmt = $conn->query($sql);
    $row = $stmt->fetch();

    if($row_count > 0){
        $_SESSION['admin_username'] = $row['username'];
        header("location:index.php");
    }
    else{
        echo "Invalid login.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
</head>

<body>
    <div class="container-fluid">
        <h1 class="text-center mt-3 mb-5">Login Admin</h1>
        <div class="row">
            <div class="col-1 col-lg-3"></div>
            <div class="col-10 col-lg-6">
                <form action="login.php" method="post">
                    <div class="m-2">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" class="form-control">
                    </div>
                    <div class="m-2 mb-4">
                        <label for="pass" class="form-label">Password</label>
                        <input type="password" name="pass" class="form-control">
                    </div>
                    <div class="m-2 d-flex justify-content-center">
                        <button type="submit" name="login" class="btn btn-primary"
                         style="width: 100%; text-align:center;">Login</button>
                    </div>
                </form>
            </div>
            <div class="col-1 col-lg-3"></div>
        </div>
    </div>
</body>

</html>