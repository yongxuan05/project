<?php
session_start();
if (!isset($_SESSION['username'])) { // If the user is not logged in
    $_SESSION['not_authorized'] = "You are not authorized to access this page!";
    header('Location: login.php'); // Redirect to the login page
    exit;
}
?>

<!DOCTYPE HTML>
<html>

<head>
    <title>ProductDetails</title>
    <meta charset="utf-8">
    <!-- Latest compiled and minified Bootstrap CSS (Apply your Bootstrap here -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pathway+Extreme&display=swap" rel="stylesheet">

</head>

<body>
    <?php include 'nav.php' ?>


    <!-- container -->
    <div class="container" style="margin-top: 90px;">
        <div class="page-header">
            <h1>Details</h1>
        </div>

        <!-- PHP read one record will be here -->
        <?php
        // get passed parameter value, in this case, the record ID
        // isset() is a PHP function used to verify if a value is there or not
        $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

        //include database connection
        include 'config/database.php';

        // read current record's data
        try {
            // prepare select query
            $query = "SELECT id, name, catname, description, price, promotion_price, manufacture_date, expired_date FROM products WHERE id = ? LIMIT 0,1";
            $stmt = $con->prepare($query);

            // this is the first question mark
            $stmt->bindParam(1, $id);

            // execute our query
            $stmt->execute();

            // store retrieved row to a variable
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // values to fill up our form
            $name = $row['name'];
            $catname = $row['catname'];
            $description = $row['description'];
            $price = $row['price'];
            $promotion_price = $row['promotion_price'];
            $manufacture_date = $row['manufacture_date'];
            $expired_date = $row['expired_date'];
        }

        // show error
        catch (PDOException $exception) {
            die('ERROR: ' . $exception->getMessage());
        }
        ?>



        <!-- HTML read one record table will be here -->
        <!--we have our html table here where the record will be displayed-->
        <table class='table table-hover table-responsive table-bordered'>
            <tr>
                <td style="font-weight: bold;">Name</td>
                <td><?php echo htmlspecialchars($name, ENT_QUOTES);  ?></td>
            </tr>

            <tr>
                <td style="font-weight: bold;">Category</td>
                <td><?php echo htmlspecialchars($catname, ENT_QUOTES);  ?></td>
            </tr>

            <tr>
                <td style="font-weight: bold;">Description</td>
                <td><?php echo htmlspecialchars($description, ENT_QUOTES); ?></td>
            </tr>

            <tr>
                <td style="font-weight: bold;">Price</td>
                <td><?php echo number_format($price, 2);  ?></td>
            </tr>

            <tr>
                <td style="font-weight: bold;">Promotional Price</td>
                <td>
                    <?php
                    if (!empty($promotion_price)) {
                        echo htmlspecialchars($promotion_price, ENT_QUOTES);
                    } else {
                        echo "-";
                    }
                    ?>
                </td>
                </td>
            </tr>

            <tr>
                <td style="font-weight: bold;">Manufacture Date</td>
                <td><?php echo (($manufacture_date && $manufacture_date != '0000-00-00') ? $manufacture_date : '-'); ?></td>
            </tr>

            <tr>
                <td style="font-weight: bold;">Expiry Date</td>
                <td><?php echo (($expired_date && $expired_date != '0000-00-00') ? $expired_date : '-'); ?></td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <a href='product_read.php' class='btn btn-danger'>Back to read products</a>
                </td>
            </tr>
        </table>


    </div> <!-- end .container -->

</body>

</html>