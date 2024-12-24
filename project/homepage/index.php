<?php
require("../connection/koneksi.php");
require("../include/index.php");
session_start();
$page = "index.php";

if (!isset($_SESSION["username"])) {
    header("location: ../login/login.php");
}

$sql = "SELECT * FROM account WHERE username='" . $_SESSION["username"] . "'";
$stmt = $conn->query($sql);
$user = $stmt->fetch();

//post a thread
if (isset($_POST["post-thread"])) {
    $title = $_POST["title-input"];
    $content = $_POST["content-input"];
    $user_id = $user["id"];
    $timezone = new DateTimeZone('Asia/Bangkok');
    $dateTimeObj = new DateTime('now', $timezone);
    $currentDateTime = $dateTimeObj->format("Y-m-d H:i:s");

    $sql = "INSERT INTO `thread`(`title`, `content`, `post_time`, `id_account`) 
    VALUES ('" . $title . "','" . $content . "','" . $currentDateTime . "','" . $user_id . "')";
    if ($conn->exec($sql)) {
        header("location: index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../styles/styles.css">
    <style>
        #do-like:hover {
            cursor: pointer;

        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <?php
    require("navbar.php");
    ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-3 d-none d-lg-block"></div>
            <div class="col-12 col-lg-6 d-flex align-items-center justify-content-center">
                <div class="row text-center" style="width: 100%;">
                    <!-- Post Button -->
                    <div class="col-12 mb-5 mt-2">
                        <button class="btn btn-primary m-3" style="background-color: #0cd3ff; border: 0; width: 80%; 
                        color: white; font-weight: bold; border-radius:30px;
                        font-size: 30px;" id="post-thread">
                            POST
                        </button>
                    </div>

                    <!-- Threads -->
                    <?php
                    $sql = "SELECT *, t.id AS thread_id FROM thread t 
                        JOIN account a ON t.id_account = a.id 
                        ORDER BY post_time DESC;";
                    $stmt = $conn->query($sql);
                    $threads = $stmt->fetchAll();

                    foreach ($threads as $thread) {
                    ?>
                        <div class="col-12 mb-4" id="thread<?php echo $thread['thread_id'] ?>">
                            <div class="card" style="border-radius:25px;">
                                <!-- Card Header -->
                                <div class="card-header">
                                    <div class="rounded-circle container-fluid p-0" style="width: 55px; height: 55px; overflow: hidden;
                                border: 1px solid #189cef;">
                                        <img src="
                                        <?php
                                        if ($thread['profile_picture_link'] != "") {
                                            echo $thread['profile_picture_link'];
                                        } else {
                                            echo "../assets/bird-bg.jpg";
                                        }
                                        ?>
                                        " alt="profile-picture" style="object-fit: cover; width: 100%; height: 100%;">
                                    </div>
                                    <p class="m-0" style="color:#666;">Posted by @<?php echo $thread['username']; ?></p>
                                    <p class="m-0" style="font-size: x-small;
                                    color: #888;"><?php echo $thread['post_time'] ?></p>
                                </div>

                                <!-- Card Body -->
                                <div class="card-body m-1" style="text-align: justify;">
                                    <!-- Thread Title -->
                                    <h5 class="card-title"><?php echo $thread['title'] ?></h5>
                                    <!-- Thread Content -->
                                    <div class="card-text"><?php echo $thread['content'] ?></div>
                                    <!-- Buttons -->
                                    <div class="row mt-3" style="text-align: center;">
                                        <!-- Like Button -->
                                        <div class="col-4">
                                            <?php
                                            $sql = "SELECT * FROM likes WHERE id_account='" .
                                                $user['id'] . "' AND id_thread = '" . $thread['thread_id'] . "'";
                                            $stmt = $conn->query($sql);
                                            $row_count = $stmt->fetchColumn();

                                            if ($row_count > 0) {
                                                echo '<a href="unlike.php?id_account=' . $user['id'] .
                                                    '&id_thread=' . $thread["thread_id"] . '">
                                                        <i class="fa-solid fa-heart" style="color: #df3a3a;"></i>
                                                    </a>';
                                            } else {
                                                echo '<a href="like.php?id_account=' . $user['id'] .
                                                    '&id_thread=' . $thread["thread_id"] . '">
                                                        <i class="fa-regular fa-heart" style="color: #333;"></i>
                                                    </a>';
                                            }
                                            ?>
                                        </div>

                                        <!-- Comment Button -->
                                        <div class="col-4">
                                            <button style="border: none; background: none; padding: 0;" onclick="showComment(<?php echo $user['id']; ?>, <?php echo $thread['thread_id']; ?>)">
                                                <i class="fa-regular fa-comment"></i>
                                            </button>
                                        </div>

                                        <!-- Bookmark Button -->
                                        <div class="col-4">
                                            <?php
                                            $sql = "SELECT * FROM bookmark WHERE id_account='" .
                                                $user['id'] . "' AND id_thread = '" . $thread['thread_id'] . "'";
                                            $stmt = $conn->query($sql);
                                            $row_count = $stmt->fetchColumn();

                                            if ($row_count > 0) {
                                                echo '<a href="unbook.php?id_account=' . $user['id'] .
                                                    '&id_thread=' . $thread["thread_id"] . '">
                                                        <i class="fa-solid fa-bookmark" style="color: #0cd3ff;"></i>
                                                    </a>';
                                            } else {
                                                echo '<a href="book.php?id_account=' . $user['id'] .
                                                    '&id_thread=' . $thread["thread_id"] . '">
                                                        <i class="fa-regular fa-bookmark" style="color: #333;"></i>
                                                    </a>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                </div>
            </div>
            <div class="col-3 d-none d-lg-block"></div>
        </div>
    </div>

    <!-- Post Thread Modal -->
    <div class="modal fade" id="post-thread-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: #2C3E50; color:#fff;">
                <div class="modal-header">
                    <img src="../assets/birdx-transparent.png" alt="" style="width: 50px;">
                    <h1 class="modal-title fs-5 center" id="staticBackdropLabel" style="text-align: center;">Post Thread</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="index.php" class="form" method="post">
                        <div class="mb-3">
                            <label for="title-input" class="form-label">Title</label>
                            <input type="text" placeholder="title" class="form-control" name="title-input" id="title-input" required>
                        </div>
                        <div class="mb-3">
                            <label for="content-input" class="form-label">Content</label>
                            <textarea placeholder="content" class="form-control" name="content-input" id="content-input" rows="4" required></textarea>
                        </div>
                        <button type="button" class="btn btn-secondary float-end" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn me-2 float-end" style="background-color: #189cef; color: #fff;" name="post-thread">Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Comment Modal -->
    <div class="modal fade" id="comment-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: #2C3E50; color:#fff;">
                <div class="modal-header">
                    <img src="../assets/birdx-transparent.png" alt="" style="width: 50px;">
                    <h1 class="modal-title fs-5 center" id="staticBackdropLabel" style="text-align: center;">Comments</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" style="max-height: 70vh; overflow-y: auto;">
                    <div class="row" id="comment-section">
                        <!-- Comments -->

                    </div>
                </div>
                <div class="modal-footer">
                    <div class="row" style="width: 100%;">
                        <div class="col-10 p-1">
                            <input type="text" placeholder="comment" id="comment-input" class="form-control m-2 ms-0">
                        </div>
                        <div class="col-2 p-1">
                            <button class="btn btn-primary m-2 ms-0 me-0" style="width: 100%;" onclick="postComment()">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    var current_id_user;
    var current_id_thread;

    $(function() {
        $("#post-thread").click(function() {
            $("#post-thread-modal").modal("toggle");
        });
    });

    function showComment(id_user, id_thread) {
        current_id_user = id_user;
        current_id_thread = id_thread;
        
        updateComment();
        $("#comment-modal").modal("toggle");
    }

    function postComment() {   
        var content = $("#comment-input").val();

        if (content.length > 0) {
            //post comment pakai AJAX

            var data = {
                "id_account": current_id_user,
                "id_thread": current_id_thread,
                "comment": content
            }
            $.ajax({
                url: "ajax/insertComment.php",
                type: "post",
                data: data,
                success: function(response){
                },  
                error: function(responseData, textStatus, errorThrown){
                }
            });

            setTimeout(updateComment, 350);
            $("#comment-input").val("");
        }
    }

    function updateComment() {
        $("#comment-input").val("");
        $("#comment-section").html("");

        //AJAX buat dapetin comment based on id_thread
        var data = {
            "id_thread": current_id_thread
        }
        $.ajax({
            url: "ajax/getCommentByThreadId.php",
            type: "post",
            data: data,
            success: function(response) {
                var resp = JSON.parse(response);

                $.each(resp, function(key, value) {
                    var directory = "../assets/bird-bg.jpg";
                    if (value['profile_picture_link'] != "")
                        directory = value['profile_picture_link'];

                    $("#comment-section").append(`
                        <div class="col-12">
                            <div class="card m-1" style="border: 1px dotted #0cd3ff">
                                <div class="card-body m-2 p-0 ms-3">
                                    <div class="row d-flex align-items-center justify-content-center">
                                        <div class="col-1 rounded-circle container-fluid p-0
                                            align-items-center" style="width: 60px; height: 60px; overflow: hidden;
                                            border: 1px solid #0cd3ff;">
                                            <img src="` + directory + `" style="object-fit: cover; width: 100%; height: 100%;">
                                        </div>
                                        <div class="col-10 text-start">
                                            <h5 class="m-0">@` + value['username'] + `</h5>
                                            <p class="m-0">` + value['content'] + `</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                });
            },
            error: function(responseData, textStatus, errorThrown) {}
        });
    }
</script>

</html>