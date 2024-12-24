<?php
require("../../connection/koneksi.php");

$id = $_POST['id'];
$fullname = $_POST['fullname'];

$sql = "UPDATE `account` SET `full_name`='" . $fullname . "' WHERE id='"
    . $id . "'";
$stmt = $conn->prepare($sql);
if ($stmt->execute()) {
    echo $fullname;
    return;
}
echo "E";
