<?php
require("../../connection/koneksi.php");

$id_account = $_POST['id_account'];
$id_thread = $_POST['id_thread'];
$comment = $_POST['comment'];

$sql = "INSERT INTO `comment`(`id_account`, `id_thread`, `content`) 
VALUES ('" . $id_account . "','" . $id_thread . "','" . $comment . "')";
$stmt = $conn->exec($sql);
echo "comment inserted";
