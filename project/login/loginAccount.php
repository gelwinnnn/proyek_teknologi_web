<?php
    require("../connection/koneksi.php");

    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM account WHERE username='" . $username . "' AND pass='" . $password . "'";
    $res = $conn->query($sql);
    $row_count = $res->rowCount();

    if($row_count > 0) {
        echo "Y";
    }
    else {
        echo "N";
    }
?>