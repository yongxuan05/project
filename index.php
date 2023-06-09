<?php
session_start();
if (!isset($_SESSION['username'])) { // If the user is not logged in
    $_SESSION['not_authorized'] = "You are not authorized to access this page!";
    header('Location: login.php'); // Redirect to the login page
    exit;
}
?>

<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://getbootstrap.com/docs/5.3/assets/css/docs.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <title>Home</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>

    <?php include 'nav.php' ?>

    <div class="container" style="margin-top: 100px; margin-bottom: 100px;">
        <div class="container" style="margin-bottom: 50px;">
            <?php include 'latest_order.php' ?>
        </div>
        <div class="container" style="margin-bottom: 50px;">
            <?php include 'latest_product.php' ?>
        </div>
        <div class="container" style="margin-bottom: 50px;">
            <?php include 'top_selling.php' ?>
        </div>
        <div class="container" style="margin-bottom: 50px;">
            <?php include 'lowest_selling.php' ?>
        </div>
        <div class="container" style="margin-bottom: 50px;">
            <?php include 'out_of_stock.php' ?>
        </div>
    </div>
</body>

</html>