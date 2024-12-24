<?php
require("../connection/koneksi.php");
require("../include/index.php");
session_start();
$page = "notification.php";

if (!isset($_SESSION["username"])) {
    header("location: ../login/login.php");
}

$sql = "SELECT * FROM account WHERE username='" . $_SESSION["username"] . "'";
$stmt = $conn->query($sql);
$user = $stmt->fetch();

$sql_like = "SELECT t.title, a2.username, a2.profile_picture_link FROM likes l
JOIN thread t ON l.id_thread = t.id
JOIN account a ON t.id_account = a.id
JOIN account a2 ON l.id_account = a2.id
WHERE a.id = '" . $user['id'] . "'
ORDER BY l.id DESC
LIMIT 10";
$stmt_like = $conn->query($sql_like);
$likers = $stmt_like->fetchAll();

$sql_comment = "SELECT t.title, a2.username, a2.profile_picture_link, c.content FROM comment c
JOIN thread t ON c.id_thread = t.id
JOIN account a ON t.id_account = a.id
JOIN account a2 ON c.id_account = a2.id
WHERE a.id = '" . $user['id'] . "'
ORDER BY c.id DESC
LIMIT 10";
$stmt_comment = $conn->query($sql_comment);
$comments = $stmt_comment->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notification</title>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>

<body>
    <!-- Navbar -->
    <?php
    require("navbar.php");
    ?>

    <div class="container-fluid">
        <div class="row text-center">
            <div class="d-none col-1 d-lg-block"></div>

            <!-- Like Notif -->
            <div class="col-12 col-md-6 col-lg-5">
                <i class="fa-solid fa-heart fa-4x mb-4 mt-3" style="color: #df3a3a;"></i>

                <?php
                foreach ($likers as $liker) {
                ?>
                    <div class="card me-5 ms-5 ms-md-3 me-md-3 ms-lg-5 mel-lg-5 mb-2" style="border-radius: 20px;">
                        <div class="row p-2 d-flex align-items-center justify-content-center">
                            <div class="col-2 pe-0">
                                <div class="ms-2 me-4 rounded-circle container-fluid p-0 edit-profile-picture" style="width: 35px; height: 35px; overflow: hidden;
                                    border: 1px solid #0cd3ff;">
                                    <img src="<?php
                                                if ($liker['profile_picture_link'] != "") {
                                                    echo $liker['profile_picture_link'];
                                                } else {
                                                    echo "../assets/bird-bg.jpg";
                                                } ?>" style="object-fit: cover; width: 100%; height: 100%;">
                                </div>
                            </div>
                            <div class="col-10 text-start">
                                <p class="m-1 ms-2"><b>@<?php echo $liker['username'] ?></b>
                                    liked your thread "<?php echo $liker['title'] ?>"</p>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>

            <!-- Comment Notif -->
            <div class="col-12 col-md-6 col-lg-5">
                <i class="fa-solid fa-comments fa-4x mb-4 mt-3" style="color: #ffdd00;"></i>

                <?php
                foreach ($comments as $comment) {
                ?>
                    <div class="card me-5 ms-5 ms-md-3 me-md-3 ms-lg-5 mel-lg-5 mb-2" style="border-radius: 20px;">
                        <div class="row p-2 d-flex align-items-center justify-content-center">
                            <div class="col-2 pe-0">
                                <div class="ms-2 me-4 rounded-circle container-fluid p-0 edit-profile-picture" style="width: 35px; height: 35px; overflow: hidden;
                                    border: 1px solid #0cd3ff;">
                                    <img src="<?php
                                                if ($comment['profile_picture_link'] != "") {
                                                    echo $comment['profile_picture_link'];
                                                } else {
                                                    echo "../assets/bird-bg.jpg";
                                                } ?>" style="object-fit: cover; width: 100%; height: 100%;">
                                </div>
                            </div>
                            <div class="col-10 text-start">
                                <p class="m-1 ms-2"><b>@<?php echo $comment['username'] ?></b>
                                    commented "<?php echo $comment['content'] ?>"
                                    on your thread "<?php echo $comment['title'] ?>"</p>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>

            </div>

            <div class="d-none col-1 d-lg-block"></div>
        </div>
    </div>
</body>

</html>