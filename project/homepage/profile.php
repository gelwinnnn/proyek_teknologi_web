<?php
require("../connection/koneksi.php");
require("../include/index.php");
session_start();
$page = "profile.php";

if (!isset($_SESSION["username"])) {
    header("location: ../login/login.php");
}

$sql = "SELECT * FROM account WHERE username='" . $_SESSION["username"] . "'";
$stmt = $conn->query($sql);
$user = $stmt->fetch();

//upload profile picture to directory
if (isset($_POST["change-profile-picture"])) {
    // Check if the file input is set
    if (isset($_FILES['profile-picture-input'])) {
        $imageTempPath = $_FILES['profile-picture-input']['tmp_name'];
        $imageName = $_FILES['profile-picture-input']['name'];
        $uploadDirectory = "../assets/profile-picture/";
        $destination = $uploadDirectory . $imageName;

        // Move the uploaded image to the specified directory
        if (move_uploaded_file($imageTempPath, $destination)) {
            $sql = "UPDATE `account` SET `profile_picture_link`='" . $destination . "' WHERE id='"
                . $user["id"] . "'";
            $stmt = $conn->prepare($sql);
            if ($stmt->execute()) {
                header('location: profile.php');
            }
        }
    }
}

//change fullname
if (isset($_POST["change-full-name"])) {
    if (isset($_POST["full-name-input"])) {
        $sql = "UPDATE `account` SET `full_name`='" . $_POST["full-name-input"] . "' WHERE id='"
            . $user["id"] . "'";
        $stmt = $conn->prepare($sql);
        if ($stmt->execute()) {
            header('location: profile.php');
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../styles/styles.css">
    <style>
        .edit-profile-picture {
            position: relative;
            cursor: pointer;
        }

        .edit-profile-picture::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0);
            z-index: 1;
            transition: background-color 0.5s ease;
            /* Add a smooth transition effect */
        }

        .edit-profile-picture:hover::before {
            background-color: rgba(0, 0, 0, 0.5);
        }

        #drop-area {
            width: 300px;
            height: 300px;
            border: 2px dashed #fff;
            border-radius: 50%;
        }

        #img-view {
            width: 100%;
            height: 100%;
            border-radius: 50%;
            background-position: center;
            background-size: cover;
        }

        .edit-full-name {
            color: #575757;
        }

        .edit-full-name:hover {
            color: #0cd3ff;
            cursor: pointer;
        }

        .edit-thread:hover {
            color: #189cef;
            cursor: pointer;
        }

        .delete-thread:hover {
            color: #ff0000;
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
            <div class="col-2 d-none d-lg-block"></div>
            <div class="col-12 col-lg-8 d-flex align-items-center justify-content-center">
                <div class="row text-center d-flex align-items-center justify-content-center" style="width: 100%;">
                    <!-- Username -->
                    <div class="col-12 mt-5 mb-4">
                        <h1>@<?php echo $user['username'] ?></h1>
                    </div>

                    <!-- Profile Picture -->
                    <div class="col-12 mb-2">
                        <div class="rounded-circle container-fluid p-0 edit-profile-picture" style="width: 200px; height: 200px; overflow: hidden;
                        border: 3px solid #0cd3ff;" id='<?php echo $user['id'] ?>'>
                            <img src="
                            <?php
                            if ($user['profile_picture_link'] != "") {
                                echo $user['profile_picture_link'];
                            } else {
                                echo "../assets/bird-bg.jpg";
                            }
                            ?>
                            " alt="profile-picture" style="object-fit: cover; width: 100%; height: 100%;">
                        </div>
                    </div>

                    <!-- Full Name -->
                    <div class="col-12">
                        <h4 id="full-name-placeholder">
                            <?php echo $user['full_name'] ?>
                            <i class="fa-solid fa-pen-to-square fa-sm ms-1 edit-full-name" id="
                            <?php
                            echo $user['id'];
                            ?>  
                            "></i>
                        </h4>
                    </div>

                    <!-- Join Date -->
                    <div class="col-12 mb-4" style="color: #888;">
                        <?php
                        $originalDate = $user['join_date'];
                        $formattedDate = date('d F Y', strtotime($originalDate));
                        echo "<p>Joined $formattedDate</p>";
                        ?>
                    </div>

                    <!-- Threads  -->
                    <div class="row m-0 p-0" id="thread-section">

                        <?php
                        $sql = "SELECT * FROM thread WHERE id_account='" . $user['id'] . "'";
                        $stmt = $conn->query($sql);
                        $rows = $stmt->fetchAll();

                        foreach ($rows as $row) {
                        ?>
                            <div class="col-12 col-md-6 mb-2">
                                <div class="card m-1 p-3 text-start" style="border-radius: 20px;">
                                    <h1 class="m-0 ms-1 me-1 mb-2 thread-title"><?php echo $row['title']; ?></h1>
                                    <p class="m-0 ms-1 me-1 mb-3 thread-content"><?php echo $row['content']; ?></p>
                                    <div class="row text-center" id="<?php echo $row['id']; ?>">
                                        <div class="col-6">
                                            <i class="fa-solid fa-pen-nib edit-thread"></i>
                                        </div>
                                        <div class="col-6">
                                            <i class="fa-solid fa-trash-can delete-thread"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>

                    </div>

                </div>
            </div>
            <div class="col-2 d-none d-lg-block"></div>
        </div>
    </div>

    <!-- Edit Profile Picture Modal -->
    <div class="modal fade" id="edit-profile-picture-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: #2C3E50; color:#fff;">
                <div class="modal-header">
                    <img src="../assets/birdx-transparent.png" alt="" style="width: 50px;">
                    <h1 class="modal-title fs-5 center" id="staticBackdropLabel" style="text-align: center;">Upload Photo</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-center justify-content-center text-center">
                    <form action="profile.php" class="form" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="profile-picture-input" class="form-label" id="drop-area">
                                <input type="file" accept="image/*" class="form-control" id="profile-picture-input" name="profile-picture-input" hidden required>
                                <div id="img-view">
                                    <i class="fa-solid fa-cloud-arrow-up fa-6x d-flex justify-content-center 
                                    align-items-center mt-3" style="height:65%;"></i>
                                    <p class="m-0">Drag and drop or click here</p>
                                    <p>to upload image</p>
                                </div>
                            </label>
                        </div>
                        <button name="change-profile-picture" type="submit" class="btn float-center" style="background-color: #189cef; color:#fff;">Change Profile Picture</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Full Name Modal -->
    <div class="modal fade" id="edit-full-name-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: #2C3E50; color:#fff;">
                <div class="modal-header">
                    <img src="../assets/birdx-transparent.png" alt="" style="width: 50px;">
                    <h1 class="modal-title fs-5 center" id="staticBackdropLabel" style="text-align: center;">Edit Fullname</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="profile.php" class="form" method="post">
                        <div class="mb-3">
                            <label for="full-name-input" class="form-label">Fullname</label>
                            <input type="text" placeholder="fullname" class="form-control" name="full-name-input" id="full-name-input" required>
                        </div>
                        <button type="button" class="btn btn-secondary float-end" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn me-2 float-end" style="background-color: #189cef; color:#fff;" name="change-full-name">Change</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Thread Modal -->
    <div class="modal fade" id="edit-thread-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: #2C3E50; color:#fff;">
                <div class="modal-header">
                    <img src="../assets/birdx-transparent.png" alt="" style="width: 50px;">
                    <h1 class="modal-title fs-5 center" id="staticBackdropLabel" style="text-align: center;">Edit Thread</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="title-input" class="form-label">Title</label>
                        <input type="text" placeholder="title" class="form-control" id="title-input">
                    </div>
                    <div class="mb-3">
                        <label for="content-input" class="form-label">Content</label>
                        <input type="text" placeholder="content" class="form-control" id="content-input">
                    </div>
                    <button type="button" class="btn btn-secondary float-end" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn me-2 float-end" style="background-color: #189cef; color:#fff;" id="change-thread">Change</button>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    var currentThreadId;
    $(function() {
        //trigger edit profile pict modal
        $(".edit-profile-picture").click(function() {
            $("#edit-profile-picture-modal").modal("toggle");
        });

        //trigger edit full name
        $(".edit-full-name").click(function() {
            var fullname = $("#full-name-placeholder").text().trim();
            $("#full-name-input").val(fullname);
            $("#edit-full-name-modal").modal("toggle");
        });

        //trigger edit thread
        $(".edit-thread").click(function() {
            currentThreadId = $(this).parent().parent().attr("id");
            var cardElement = $(this).closest('.card');
            var threadTitleHTML = cardElement.find('.thread-title').html();
            var threadContentHTML = cardElement.find('.thread-content').html();
            $("#title-input").val(threadTitleHTML);
            $("#content-input").val(threadContentHTML);

            $("#edit-thread-modal").modal("toggle");
        });

        //change thread
        $("#change-thread").click(function() {
            var title = $("#title-input").val();
            var content = $("#content-input").val();
            console.log(currentThreadId);
            console.log(title + " " + content);

            //cek ada isinya ga
            if (title.length && content.length) {
                var input = {
                    "title": title,
                    "content": content,
                    "id_thread": currentThreadId
                }

                $.ajax({
                    url: "ajax/editThread.php",
                    type: "post",
                    data: input,
                    success: function(response) {
                        if (response === "Y") {
                            Swal.fire({
                                icon: "success",
                                title: "Completed",
                                text: "Thread edit success.",
                                timer: 1500
                            });

                            setTimeout(refreshPage, 1000);
                        } else {
                            Swal.fire({
                                icon: "error",
                                title: "Can't Edit Thread",
                                text: response,
                                timer: 1500
                            });
                        }
                    },
                    error: function(responseData, textStatus, errorThrown) {
                        Swal.fire({
                            icon: "error",
                            title: "Can't Edit Thread",
                            text: "AJAX error.",
                            timer: 1500
                        });
                    }
                });
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Can't Edit Thread",
                    text: "Please fill the input.",
                    timer: 1500
                });
            }

            $("#edit-thread-modal").modal("toggle");
        });

        //trigger delete thread
        $(".delete-thread").click(function() {
            currentThreadId = $(this).parent().parent().attr("id");

            if (confirm("Do you want to delete this thread?")) {
                var input = {
                    "id_thread": currentThreadId
                }
                //AJAX to delete thread
                $.ajax({
                    url: "ajax/deleteThreadById.php",
                    type: "post",
                    data: input,
                    success: function(response) {},
                    error: function(responseData, textStatus, errorThrown) {}
                });

                Swal.fire({
                    icon: "success",
                    title: "Completed",
                    text: "Thread deletion success.",
                    timer: 1500
                });

                setTimeout(refreshPage, 1000);
            }
        });
    });

    function refreshPage() {
        window.location.href = "profile.php";
    }

    //make drag & drop visual
    const dropArea = document.getElementById("drop-area");
    const inputFile = document.getElementById("profile-picture-input");
    const imageView = document.getElementById("img-view");

    inputFile.addEventListener("change", uploadImage);

    function uploadImage() {
        let imgLink = URL.createObjectURL(inputFile.files[0]);
        imageView.style.backgroundImage = `url(${imgLink})`;
        imageView.textContent = "";
        imageView.style.border = 0;
    }

    dropArea.addEventListener("dragover", function(e) {
        e.preventDefault();
    })
    dropArea.addEventListener("drop", function(e) {
        e.preventDefault();
        inputFile.files = e.dataTransfer.files;
        uploadImage();
    })
</script>

</html>