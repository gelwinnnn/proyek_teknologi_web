<?php
require("../connection/koneksi.php");
session_start();
$sql = "SELECT * FROM account WHERE username='" . $_SESSION["username"] . "'";
$stmt = $conn->query($sql);
$user = $stmt->fetch();

$id_account = $_GET["id_account"];
$id_thread = $_GET["id_thread"];

if($id_account == $user['id']){
    $sql = "INSERT INTO bookmark(id_account, id_thread) 
    VALUES('" . $id_account . "','" . $id_thread . "')";
    $conn->exec($sql);
}

header("location:index.php#thread" . $id_thread);