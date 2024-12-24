<?php
require("../../connection/koneksi.php");

$title = $_POST['title'];
$content = $_POST['content'];
$id = $_POST['id_thread'];

$sql = "UPDATE `thread` SET `title`='" . $title . "', `content`='" . $content . "' 
WHERE id='" . $id . "'";
$stmt = $conn->prepare($sql);
if ($stmt->execute()) {
    echo "Y";
    return;
}
echo "N";
