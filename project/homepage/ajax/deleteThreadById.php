<?php
require("../../connection/koneksi.php");

$id_thread = $_POST['id_thread'];

$sql = "DELETE FROM `thread` WHERE id='"
    . $id_thread . "'";
$stmt = $conn->prepare($sql);
$stmt->execute();

echo "success";
