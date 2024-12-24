<?php
    require("../../connection/koneksi.php");

    $sql = "UPDATE `account` SET `pass`='" . $_POST["pass"] . "',
    `full_name`='" . $_POST["fullname"] . "' 
    WHERE id='" . $_POST["id"] . "'";
    $stmt = $conn->prepare("$sql");
    $stmt->execute();

    echo "Berhasil edit.";
?>