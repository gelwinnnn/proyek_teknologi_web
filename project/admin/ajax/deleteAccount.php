<?php
    require("../../connection/koneksi.php");

    $sql = "DELETE FROM account WHERE id='" . $_POST["id"] . "'";
    $stmt = $conn->prepare("$sql");
    $stmt->execute();
    echo "Berhasil didelete.";
?>