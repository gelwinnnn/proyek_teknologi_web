<?php
$page = "comment.php";
require("navbar.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comment Dashboard</title>
</head>

<body>
    <div class="container-fluid p-3">
        <h2>Comment Dashboard</h2>
        <br>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Comment</th>
                    <th>Posted By</th>
                    <th>Thread Title</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT c.id, c.content, t.title, a.username FROM comment c
                JOIN account a ON c.id_account = a.id
                JOIN thread t ON c.id_thread = t.id
                ORDER BY c.id";
                $stmt = $conn->query($sql);
                $rows = $stmt->fetchAll();

                foreach ($rows as $row) {
                    echo "<tr>
                        <td>" . $row["content"] . "</td>
                        <td>" . $row["username"] . "</td>
                        <td>" . $row["title"] . "</td>
                        <td>
                            <button class='btn btn-danger' onclick='hapus(" . $row["id"] . ")'>Hapus</button>
                        </td>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

<script>
    function hapus(id) {
        if (confirm("Do you want to delete this comment?")) {
            var input = {
                "id": id
            };

            $.ajax({
                url: "ajax/deleteComment.php",
                type: "post",
                data: input,
                success: function(response) {
                    alert(response);
                    window.location.href = "comment.php";
                },
                error: function(responseData, textStatus, errorThrown) {
                    alert("Delete gagal.");
                }
            });
        }
    }
</script>

</html>