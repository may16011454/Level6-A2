<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Admin Dashboard</title>
</head>

<?php require __DIR__ . "/inc/header.php"; ?>

<body>

    <div class="container mt-5">
        <h2 class="mb-4">Admin Dashboard</h2>

        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        Users
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Manage Users</h5>
                        <p class="card-text">View and manage user accounts.</p>
                        <a href="admin-members.php" class="btn btn-primary">Go to Users</a>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        Suppliers
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Manage Suppliers</h5>
                        <p class="card-text">View and manage suppliers</p>
                        <a href="admin-suppliers.php" class="btn btn-primary">Go to Suppliers</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        Catagories
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Manage Catagories</h5>
                        <p class="card-text">View and manage catagories</p>
                        <a href="admin-category.php" class="btn btn-primary">Go to Catagories</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header">
                        Equipment
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Manage Equipment</h5>
                        <p class="card-text">Add, edit, or delete Equipment in the inventory.</p>
                        <a href="admin-equipments.php" class="btn btn-primary">Go to Equipment</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>

</body>

</html>

<?php require __DIR__ . "/inc/footer.php"; ?>