<?php
require("../connection/koneksi.php");
require("../include/index.php");
session_start();
$page = "search.php";

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
    <title>Search</title>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

</head>

<body>
    <!-- Navbar -->
    <?php
    require("navbar.php");
    ?>

    <div class="container-fluid">
        <input type="text" id="search-bar" class="form-control text-center
        mt-4 mb-3 mx-auto" placeholder="Search Thread Title" style="width: 70%;
        border-radius: 30px;">

        <h1 class="mb-5" style="text-align: center;" id="thread-found"></h1>

        <div class="row">
            <div class="d-none col-1 d-lg-block"></div>
            <div class="col-12 col-lg-10">
                <div class="row d-flex align-items-center justify-content-center" id="display-thread">

                </div>
            </div>
            <div class="d-none col-1 d-lg-block"></div>
        </div>
    </div>
</body>

<script>
    $(function() {
        $("#search-bar").on('input', function() {
            var threadCount = $("#thread-found");
            var threadDisplay = $("#display-thread");
            var keyword = $("#search-bar").val();

            //dapetin data thread dgn ajax
            var input = {
                "keyword": keyword
            }
            $.ajax({
                url: "ajax/getThreadByTitle.php",
                type: "post",
                data: input,
                success: function(response) {
                    var resp = JSON.parse(response);
                    var respLen = 0;
                    
                    $.each(resp, function(key, value){
                        respLen++;
                    });
                    threadCount.html(respLen + " Threads Found.")
                    threadDisplay.html("");

                    $.each(resp, function(key, value){
                        var profile_directory = "../assets/bird-bg.jpg";
                        if(value['profile_picture_link'] !== "") profile_directory = value['profile_picture_link'];

                        threadDisplay.append(`
                        <div class="col-6 p-0">
                            <a href="index.php#thread` + value['id'] + `" style="text-decoration: none;">
                                <div class="card m-2" style="border-radius: 20px; border: 2px solid #fc0">
                                    <div class="card-body m-2 p-0 ms-3">
                                        <div class="row d-flex align-items-center justify-content-center">
                                            <div class="col-1 rounded-circle container-fluid p-0
                                                align-items-center" style="width: 60px; height: 60px; overflow: hidden;
                                                border: 1px solid #0cd3ff;">
                                                <img src="` 
                                                    + profile_directory +
                                                    `" style="object-fit: cover; width: 100%; height: 100%;">
                                            </div>
                                            <div class="col-10 text-center text-md-start">
                                                <h5 class="m-0">` + value['title'] + `</h5>
                                                <p class="m-0">By @` + value['username'] + `</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>`);
                    });
                },
                error: function(responseData, textStatus, errorThrown) {
                }
            });
        })
    })
</script>

</html>