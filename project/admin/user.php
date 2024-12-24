<?php
$page = "user.php";
require("navbar.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>

<body>
    <div class="container-fluid p-3">
        <h2>User Dashboard</h2>
        <br>

        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Username</th>
                    <th>Password</th>
                    <th>Full Name</th>
                    <th>Join Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM account
                ORDER BY join_date";
                $stmt = $conn->query($sql);
                $rows = $stmt->fetchAll();

                foreach ($rows as $row) {
                    echo "<tr>
                        <td>" . $row["username"] . "</td>
                        <td>" . $row["pass"] . "</td>
                        <td>" . $row["full_name"] . "</td>
                        <td>" . $row["join_date"] . "</td>
                        <td>
                            <button class='btn btn-primary' onclick='edit(" . $row["id"] . ")'>Edit</button>
                            <button class='btn btn-danger' onclick='hapus(" . $row["id"] . ")'>Hapus</button>
                        </td>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- modal untuk edit user -->
    <div class="modal fade" id="user-edit-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Edit User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 mb-2">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" id="pass-input">
                        </div>
                        <div class="col-12 mb-2">
                            <label class="form-label">Fullname</label>
                            <input type="text" class="form-control" id="fullname-input">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="change-user">Submit</button>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    var selectedId;

    $(function() {
        $("#change-user").click(function() {
            var password = $("#pass-input").val();
            var fullname = $("#fullname-input").val();

            var input = {
                "id": selectedId,
                "pass": password,
                "fullname": fullname
            };

            $.ajax({
                url: "ajax/editAccount.php",
                type: "post",
                data: input,
                success: function(response) {
                    alert(response)
                    window.location.href = "user.php";
                },
                error: function(responseData, textStatus, errorThrown) {
                    alert("Edit gagal.")
                }
            });

            $("#user-edit-modal").modal("toggle");
        });
    });

    function edit(id) {
        selectedId = id;

        var input = {
            "id": selectedId
        };

        $.ajax({
            url: "ajax/getAccount.php",
            type: "post",
            data: input,
            success: function(response) {
                var resp = JSON.parse(response);
                $.each(resp, function(key, value) {
                    $("#pass-input").val(value["pass"]);
                    $("#fullname-input").val(value["full_name"]);
                });
            },
            error: function(responseData, textStatus, errorThrown) {
                alert('AJAX Error');
            }
        });

        $("#user-edit-modal").modal("toggle");
    }

    function hapus(id) {
        if (confirm("Do you want to delete this user?")) {
            var input = {
                "id": id
            };

            $.ajax({
                url: "ajax/deleteAccount.php",
                type: "post",
                data: input,
                success: function(response) {
                    alert(response);
                    window.location.href = "user.php";
                },
                error: function(responseData, textStatus, errorThrown) {
                    alert("Delete gagal.");
                }
            });
        }
    }
</script>

</html>