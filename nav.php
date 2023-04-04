<?php $currentPage = basename($_SERVER['PHP_SELF'], '.php'); ?>

<!-- navbar -->
<nav class="custom-navbar navbar navbar navbar-expand-md navbar-dark bg-dark" arial-label="navigation bar">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.html">navbar<span>.</span></a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="custom-navbar-nav navbar-nav ms-auto mb-2 mb-md-0">
                <li class="nav-item <?php if ($currentPage == 'index') {
                                        echo 'active';
                                    } ?>">
                    <a class="nav-link" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item <?php if ($currentPage == 'product_create') {
                                        echo 'active';
                                    } ?>">
                    <a class="nav-link" href="product_create.php">Create Product</a>
                </li>
                <li class="nav-item <?php if ($currentPage == 'product_read') {
                                        echo 'active';
                                    } ?>">
                    <a class="nav-link" href="product_read.php">Read Products</a>
                </li>
                <li class="nav-item <?php if ($currentPage == 'customer_create') {
                                        echo 'active';
                                    } ?>">
                    <a class="nav-link" href="customer_create.php">Create Customer</a>
                </li>
                <li class="nav-item <?php if ($currentPage == 'customer_read') {
                                        echo 'active';
                                    } ?>">
                    <a class="nav-link" href="customer_read.php">Read Customer</a>
                </li>
                <li class="nav-item <?php if ($currentPage == 'contact') {
                                        echo 'active';
                                    } ?>">
                    <a class="nav-link" href="contact.php">Contact Us</a>
                </li>
                <li class="nav-item <?php if ($currentPage == 'login') {
                                        echo 'active';
                                    } ?>">
                    <a class="nav-link" href="login.php">Log out</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- end Navbar -->