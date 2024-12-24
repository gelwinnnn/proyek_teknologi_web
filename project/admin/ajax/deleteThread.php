<?php
    require("../../connection/koneksi.php");

    $sql = "DELETE FROM thread WHERE id='" . $_POST["id"] . "'";
    $stmt = $conn->prepare("$sql");
    $stmt->execute();
    echo "Berhasil didelete.";
?>