<?php
    require("../../connection/koneksi.php");
    $keyword = $_POST['keyword'];

    $threads = array();
    
    $sql = "SELECT t.title, t.id, a.username, a.profile_picture_link FROM `thread` t 
    JOIN account a ON t.id_account=a.id 
    WHERE title LIKE '%" . $keyword . "%';";
    $stmt = $conn->query($sql);
    $result = $stmt->fetchAll();
    foreach ($result as $row) {
        $threads[$row['id']] = $row;
    }

    echo json_encode($threads);
?>