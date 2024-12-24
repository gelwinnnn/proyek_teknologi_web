<?php
require("../connection/koneksi.php");
require("../include/index.php");
session_start();
$page = "bookmark.php";

if (!isset($_SESSION["username"])) {
    header("location: ../login/login.php");
}

$sql = "SELECT * FROM account WHERE username='" . $_SESSION["username"] . "'";
$stmt = $conn->query($sql);
$user = $stmt->fetch();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookmark</title>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

</head>

<body>
    <!-- Navbar -->
    <?php
    require("navbar.php");
    ?>

    <div class="container-fluid">
        <?php
        $sql = "SELECT t.title, a.username, t.id, a.profile_picture_link FROM bookmark b
        JOIN thread t ON t.id = b.id_thread
        JOIN account a ON a.id = t.id_account
        WHERE b.id_account = '" . $user['id'] . "'";  
       
        $stmt = $conn->query($sql);
        $bookmarks = $stmt->fetchAll();
        $stmt = $conn->query($sql);
        $row_count = $stmt->rowCount();
        ?>

        <h1 class="mt-4 mb-5" style="text-align: center;"><?php echo $row_count ?> Bookmarked Posts.</h1>
        
        <div class="row">
            <div class="d-none col-1 d-lg-block"></div>
            <div class="col-12 col-lg-10">
                <div class="row d-flex align-items-center justify-content-center">
                    <?php
                        foreach($bookmarks as $bookmark){
                            ?>
                                <div class="col-6 p-0">
                                    <a href="index.php#thread<?php echo $bookmark['id']?>" style="text-decoration: none;">
                                        <div class="card m-2" style="border-radius: 20px; border: 2px solid #fc0">
                                            <div class="card-body m-2 p-0 ms-3">
                                                <div class="row d-flex align-items-center justify-content-center">
                                                    <div class="col-1 rounded-circle container-fluid p-0
                                                        align-items-center" style="width: 60px; height: 60px; overflow: hidden;
                                                        border: 1px solid #0cd3ff;">
                                                        <img src="
                                                            <?php
                                                            if ($bookmark['profile_picture_link'] != "") {
                                                                echo $bookmark['profile_picture_link'];
                                                            } else {
                                                                echo "../assets/bird-bg.jpg";
                                                            }
                                                            ?>
                                                            " style="object-fit: cover; width: 100%; height: 100%;">
                                                    </div>
                                                    <div class="col-10 text-center text-md-start">
                                                        <h5 class="m-0"><?php echo $bookmark['title']; ?></h5>
                                                        <p class="m-0">By @<?php echo $bookmark['username']; ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            <?php
                        }
                    ?>

                </div>
            </div>
            <div class="d-none col-1 d-lg-block"></div>
        </div>
    </div>
</body>

</html>