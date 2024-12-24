<?php
    require("../../connection/koneksi.php");
    $thread_id = $_POST['id_thread'];

    $comments = array();
    
    $sql = "SELECT a.username, a.profile_picture_link, c.content FROM comment c
    JOIN account a ON c.id_account = a.id
    WHERE c.id_thread = '" . $thread_id . "'
    ORDER BY c.id DESC";
    $stmt = $conn->query($sql);
    $result = $stmt->fetchAll();
    $i = 1;
    foreach ($result as $row) {
        $comments[$i] = $row;
        $i++;
    }

    echo json_encode($comments);
?>