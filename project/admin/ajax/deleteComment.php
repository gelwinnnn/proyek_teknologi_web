<?php
    require("../../connection/koneksi.php");

    $sql = "DELETE FROM comment WHERE id='" . $_POST["id"] . "'";
    $stmt = $conn->prepare("$sql");
    $stmt->execute();
    echo "Berhasil didelete.";
?>