<style>
    .active-color {
        color: #0cd3ff;
    }
</style>

<nav class="navbar navbar-expand-lg bg-body-tertiary sticky-top p-0 ">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            <img src="../assets/birdx-transparent.png" alt="birdx-logo" style="height: 55px;">
        </a>
        <div class="rounded-circle container-fluid p-0" style="width: 55px; height: 55px; overflow: hidden;
                        border: 1px solid #189cef;" id='<?php echo $user['id'] ?>'>
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
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0"></ul>
            <ul class="navbar-nav ms-2 me-lg-2 mb-3 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link
                    <?php
                    if ($page == 'index.php') {
                        echo 'active';
                    }
                    ?>
                    " href="index.php"><i class="fa-solid fa-house me-1
                    <?php
                    if ($page == 'index.php') {
                        echo 'active-color';
                    }
                    ?>
                    "></i>Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link
                    <?php
                    if ($page == 'search.php') {
                        echo 'active';
                    }
                    ?>
                    " href="search.php"><i class="fa-solid fa-magnifying-glass me-1
                    <?php
                    if ($page == 'search.php') {
                        echo 'active-color';
                    }
                    ?>
                    "></i>Search</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link
                    <?php
                    if ($page == 'notification.php') {
                        echo 'active';
                    }
                    ?>
                    " href="notification.php"><i class="fa-solid fa-bell me-1
                    <?php
                    if ($page == 'notification.php') {
                        echo 'active-color';
                    }
                    ?>
                    "></i>Notification</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link
                    <?php
                    if ($page == 'bookmark.php') {
                        echo 'active';
                    }
                    ?>
                    " href="bookmark.php"><i class="fa-solid fa-bookmark me-1
                    <?php
                    if ($page == 'bookmark.php') {
                        echo 'active-color';
                    }
                    ?>
                    "></i>Bookmark</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link
                    <?php
                    if ($page == 'profile.php') {
                        echo 'active';
                    }
                    ?>
                    " href="profile.php"><i class="fa-solid fa-user me-1
                    <?php
                    if ($page == 'profile.php') {
                        echo 'active-color';
                    }
                    ?>
                    "></i>Profile</a>
                </li>
                <li class="nav-item mt-2 mt-lg-0 ms-lg-3">
                    <a href="../login/logout.php" class="btn btn-danger">
                        Log Out &nbsp;
                        <i class="fa-solid fa-right-from-bracket"></i>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>