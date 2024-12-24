<?php
    require("../connection/koneksi.php");

    $username = $_POST['username'];
    $password = $_POST['password'];
    $fullname = $_POST['fullname'];

    $sql = "SELECT * FROM account WHERE username='" . $username . "'";
    $res = $conn->query($sql);
    $row_count = $res->rowCount();

    if($row_count > 0) {
        echo "Username taken!";
    }
    else {
        $sql = "INSERT INTO account(username, pass, full_name, join_date) VALUES('" . $username . "','" . $password 
        . "','" . $fullname . "','" . date('Y-m-d') . "')";
        if($conn->exec($sql)) {
            echo "Y";
        }
        else {
            echo "N";
        }
    }
?>