<?php
    $servername="localhost";
    $username="root";
    $password="";
    $database="project_forum";

    try{
        $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e) {
        echo "connection failed" . $e->getMessage();
    }
?>