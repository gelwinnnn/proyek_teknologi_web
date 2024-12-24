<?php
    require("../include/index.php");
    require("../connection/koneksi.php");

    session_start();
    if(!isset($_SESSION['admin_username'])){
        header("location: login.php");
    }
?>

<style>
    .active{
        text-decoration: underline;
    }
</style>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Welcome, <?php echo $_SESSION['admin_username']; ?></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link 
                    <?php
                        if($page == "index.php"){
                            echo "active";
                        }
                    ?>
                    " href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link 
                    <?php
                        if($page == "user.php"){
                            echo "active";
                        }
                    ?>
                    " href="user.php">User</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link
                    <?php
                        if($page == "thread.php"){
                            echo "active";
                        }
                    ?>
                    " href="thread.php">Thread</a>
                </li>
                <li class="nav-item me-2">
                    <a class="nav-link
                    <?php
                        if($page == "comment.php"){
                            echo "active";
                        }
                    ?>
                    " href="comment.php">Comment</a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-danger" href="logout.php">Log Out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>