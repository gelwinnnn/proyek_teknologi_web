<?php
$page = "index.php";
require("navbar.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Homepage</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row mt-5">
            <div class="col-12 col-md-4 text-center">
                <i class="fa-solid fa-user mb-3 mt-5 fa-4x"></i>
                <h1 class="mt-3">
                    <?php
                    $sql = "SELECT * FROM account";
                    $stmt = $conn->query($sql);
                    $rows = $stmt->rowCount();
                    echo $rows;
                    ?>
                    Users
                </h1>
            </div>
            <div class="col-12 col-md-4 text-center">
                <i class="fa-brands fa-square-threads mb-3 mt-5 fa-4x"></i>
                <h1 class="mt-3">
                    <?php
                    $sql = "SELECT * FROM thread";
                    $stmt = $conn->query($sql);
                    $rows = $stmt->rowCount();
                    echo $rows;
                    ?>
                    Threads
                </h1>
            </div>
            <div class="col-12 col-md-4 text-center">
                <i class="fa-solid fa-comment mb-3 mt-5 fa-4x"></i>
                <h1 class="mt-3">
                    <?php
                    $sql = "SELECT * FROM comment";
                    $stmt = $conn->query($sql);
                    $rows = $stmt->rowCount();
                    echo $rows;
                    ?>
                    Comments
                </h1>
            </div>
        </div>
    </div>
</body>

</html>