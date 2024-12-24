<?php
$page = "thread.php";
require("navbar.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thread Dashboard</title>
</head>

<body>
    <div class="container-fluid p-3">
        <h2>Thread Dashboard</h2>
        <br>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Title</th>
                    <th>Content</th>
                    <th>Post Time</th>
                    <th>Posted By</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT t.id, t.title, t.content, t.post_time, a.username FROM thread t
                JOIN account a ON t.id_account = a.id
                ORDER BY t.post_time";
                $stmt = $conn->query($sql);
                $rows = $stmt->fetchAll();

                foreach ($rows as $row) {
                    echo "<tr>
                        <td>" . $row["title"] . "</td>
                        <td>" . $row["content"] . "</td>
                        <td>" . $row["post_time"] . "</td>
                        <td>" . $row["username"] . "</td>
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
        if (confirm("Do you want to delete this thread?")) {
            var input = {
                "id": id
            };

            $.ajax({
                url: "ajax/deleteThread.php",
                type: "post",
                data: input,
                success: function(response) {
                    alert(response);
                    window.location.href = "thread.php";
                },
                error: function(responseData, textStatus, errorThrown) {
                    alert("Delete gagal.");
                }
            });
        }
    }
</script>

</html>