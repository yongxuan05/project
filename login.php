<!DOCTYPE HTML>
<html>

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <!-- Latest compiled and minified Bootstrap CSS (Apply your Bootstrap here -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="style.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Archivo:wght@600&display=swap" rel="stylesheet">


</head>

<body>

    <!-- container -->
    <div class="container">

        <!-- html form to create product will be here -->
        <!-- PHP insert code will be here -->

        <?php
        session_start(); // Start the session

        if (isset($_POST['logout'])) { // If the user clicked the logout button
            session_unset(); // Unset all session variables
            session_destroy(); // Destroy the session
            header('Location: login.php'); // Redirect to the login page
            exit;
        }

        if (isset($_SESSION['not_authorized'])) { // If the user is not authorized
            echo "<div class='alert alert-danger'>Please Login, your are not authorized to access the page!!</div>";
            unset($_SESSION['not_authorized']); // Unset the session variable to prevent displaying the message again
        }

        //$_get (appear in url) and $_post (didnt appear in url) 是传送（隐形）
        if ($_POST) {
            // include database connection
            include 'config/database.php';
            try { //if insert wrong will go to catch

                // posted values
                $username = htmlspecialchars(strip_tags($_POST['username']));
                $Password = ($_POST['password']);

                // check if any field is empty
                if (empty($username)) {
                    $username_error = "Please enter Username";
                }

                if (empty($Password)) {
                    $Password_error = "Please enter Password";
                }
                // check if there are any errors
                if (!isset($username_error) && !isset($password_error)) {
                    $query = "SELECT * FROM customers WHERE username=:username";
                    $stmt = $con->prepare($query);
                    $stmt->bindParam(':username', $username);
                    $stmt->execute();

                    // check if any rows were returned
                    $result = $stmt->rowCount();
                    if ($result == 1) {
                        // fetch the data into an associative array
                        $user = $stmt->fetch(PDO::FETCH_ASSOC);

                        if ($user['Password'] == md5($Password)) {
                            if ($user['status'] === 'active') {
                                // set the session variable
                                $_SESSION['username'] = $username;

                                // redirect to dashboard
                                header("Location: index.php");
                                exit();
                            } else {
                                echo "<div class='alert alert-danger'>Your account is in inactive</div>";
                            }
                        } else {
                            echo "<div class='alert alert-danger'>Password is incorrect.</div>";
                        }
                    } else {
                        echo "<div class='alert alert-danger'>Invalid Username & Password.</div>";
                    }
                }
            } catch (PDOException $exception) {
                die('ERROR: ' . $exception->getMessage());
            }
        }
        ?>


        <!-- html form here where the customer information will be entered -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <section class="vh-100 gradient-custom">
                <div class="container py-4 h-80">
                    <div class="row d-flex justify-content-center align-items-center h-100">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="card bg-dark text-white" style="border-radius: 1rem;">
                                <div class="card-body p-5 text-center">

                                    <div class="mb-md-1 mt-md-4 pb-5">

                                        <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                        <p class="text-white-50 mb-5">Please enter your Email / Username and password!</p>

                                        <div class="form-outline form-white mb-4">
                                            <label class="form-label" for="typeEmailX">Email / Username</label>
                                            <td><input type="text" name='username' class="form-control form-control-lg" value="<?php echo isset($username) ? htmlspecialchars($username) : ''; ?>" />
                                                <?php if (isset($username_error)) { ?><span class="text-danger"><?php echo $username_error; ?></span><?php } ?></td>
                                        </div>

                                        <div class="form-outline form-white mb-4">
                                            <label class="form-label" for="typePasswordX">Password</label>
                                            <td><input type="password" name="password" class="form-control form-control-lg" value="<?php echo isset($Password) ? htmlspecialchars($Password) : ''; ?>" />
                                                <?php if (isset($Password_error)) { ?><span class="text-danger"><?php echo $Password_error; ?></span><?php } ?></td>
                                        </div>

                                        <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>

                                        <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>

                                    </div>

                                    <div>
                                        <p class="mb-0">Don't have an account? <a href="#!" class="text-white-50 fw-bold">Sign Up</a>
                                        </p>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>

    </div>
    <!-- end .container -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

</body>

</html>