<?php
    session_start();
    //query semua thread dengan account yang aktif di session
    require("../../connection/koneksi.php");
    $username = $_SESSION['username'];

    $threads = array();
    
    $sql = "SELECT * FROM thread
    WHERE id_account = (SELECT id FROM
    account WHERE username='" . $username . "')";
    $stmt = $conn->query($sql);
    $result = $stmt->fetchAll();
    $i = 1;
    foreach ($result as $row) {
        $threads[$i] = $row;
        $i++;
    }

    echo json_encode($threads);
?>