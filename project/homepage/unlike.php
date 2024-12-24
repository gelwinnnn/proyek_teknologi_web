<?php
require("../connection/koneksi.php");
session_start();
$sql = "SELECT * FROM account WHERE username='" . $_SESSION["username"] . "'";
$stmt = $conn->query($sql);
$user = $stmt->fetch();

$id_account = $_GET["id_account"];
$id_thread = $_GET["id_thread"];

if($id_account == $user['id']){
    $sql = "DELETE FROM likes WHERE id_account='" . $id_account . "' AND 
    id_thread='" . $id_thread . "'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
}

header("location:index.php#thread" . $id_thread);