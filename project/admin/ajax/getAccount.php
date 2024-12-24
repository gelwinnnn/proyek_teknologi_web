<?php
    require("../../connection/koneksi.php");
    
    $account = array();
    $query = "SELECT * FROM `account` WHERE id='" . $_POST["id"] . "'";
    $stmt = $conn->query($query);
    $res = $stmt->fetchAll();
    
    foreach($res as $row)
    {
        $account[$row["id"]] = $row;
    }
    echo json_encode($account);
?>