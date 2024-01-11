<?php
session_start();
?>

<?php require __DIR__ . "/inc/header.php"; ?>
<link rel="stylesheet" href="css\style.css">

<div class="jumbotron text-center">
    <h1 class="display-4">Gourmet Grocer</h1>
    <p class="lead">Where Gourmet Meets Convenience</p>
    <a class="btn btn-primary btn-lg" href="login.php" role="button">Get Started</a>
</div>

<div class="container mt-4">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Check Out The Products</h5>
                        <p class="card-text">Check out our exquisite line of products.</p>
                        <a class="btn btn-primary" href="inventory.php" role="button">View Products</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Not a Member Already?</h5>
                        <p class="card-text">Not a member of this amazing place? Sign up today and join!</p>
                        <a class="btn btn-primary" href="register.php" role="button">Register Here</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
    

<?php require __DIR__ . "/inc/footer.php"; ?>