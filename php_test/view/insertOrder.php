<?php
        require '../dto/orderDTO.php';
        session_start();
        $orderTbl=isset($_SESSION['orderTbl0'])?unserialize($_SESSION['orderTbl0']):new orderDTO();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Dashboard Overview">
    <meta name="author" content="Mihai Alexandru Paun">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="../assets/vendor/nucleo/css/nucleo.css" type="text/css">
    <link rel="stylesheet" href="../libs/fontawesome/css/all.min.css" type="text/css">
    <!-- Page plugins -->
    <!-- Argon CSS -->
    <link rel="stylesheet" href="../assets/css/argon.css?v=1.2.0" type="text/css">

    <title>Create Order</title>


</head>
<body>
<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="graph.php">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="insert.php">
                            <i class="ni ni-planet text-orange"></i>
                            <span class="nav-link-text">Add Customer</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="update.php">
                            <i class="ni ni-circle-08 text-pink""></i>
                            <span class="nav-link-text">Update Customer</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../index.php">
                            <i class="ni ni-single-02 text-yellow"></i>
                            <span class="nav-link-text">Profile</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="tables.html">
                            <i class="ni ni-bullet-list-67 text-default"></i>
                            <span class="nav-link-text">Customer Details</span>
                        </a>
                    </li>

                </ul>
                <!-- Divider -->
                <hr class="my-3">
            </div>
        </div>
    </div>
</nav>
<!-- Main content -->
<div class="main-content" id="panel">
    <!-- Topnav -->
    <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
        <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">

                <!-- Navbar links -->
                <ul class="navbar-nav align-items-center  ml-md-auto ">
                    <li class="nav-item d-xl-none">
                        <!-- Sidenav toggler -->
                        <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                                <i class="sidenav-toggler-line"></i>
                            </div>
                        </div>
                    </li>
            </div>
        </div>
    </nav>
    <!-- Header -->
    <div class="header bg-primary pb-6">
        <div class="container-fluid">
            <div class="header-body">
                <div class="row align-items-center py-4">
                    <div class="col-lg-6 col-7">
                        <h6 class="h2 text-white d-inline-block mb-0">Add Order</h6>
                        <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                                <li class="breadcrumb-item"><a href="../index.php">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Add Order</li>
                            </ol>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- Page content -->
    <div class="container-fluid pt-4">
        <div class="row">
            <div class="col-xl-8">
                    <div class="page-header">
                    </div>
                    <p>Please fill this form and submit to add new order record in the database.</p>
                    <form action="../index.php?act=insertOrder&id=<?php echo$_GET['id']?>" method="post" >
                        <div class="form-control-label" <?php echo (!empty($orderTbl->country_msg)) ? 'has-error' : ''; ?>>
                            <label>Country</label>
                            <input name="country" class="form-control" value="<?php echo $orderTbl->country; ?>">
                            <span class="help-block"><?php echo $orderTbl->country_msg;?></span>
                        </div>

                        <div class="form-control-label" <?php echo (!empty($orderTbl->device_msg)) ? 'has-error' : ''; ?>>
                            <label>Device</label>
                            <input name="device" class="form-control" value="<?php echo $orderTbl->device; ?>">
                            <span class="help-block"><?php echo $orderTbl->device_msg;?></span>
                        </div>

                        <div class="form-control-label" <?php echo (!empty($orderTbl->EAN_msg)) ? 'has-error' : ''; ?>>
                            <label>EAN</label>
                            <input name="EAN" class="form-control" value="<?php echo $orderTbl->EAN; ?>">
                            <span class="help-block"><?php echo $orderTbl->EAN_msg;?></span>
                        </div>
                        <div class="form-control-label" <?php echo (!empty($orderTbl->quantity_msg)) ? 'has-error' : ''; ?>>
                            <label>quantity</label>
                            <input name="quantity" class="form-control" value="<?php echo $orderTbl->quantity; ?>">
                            <span class="help-block"><?php echo $orderTbl->quantity_msg;?></span>
                        </div>

                        <div class="form-control-label" <?php echo (!empty($orderTbl->price_msg)) ? 'has-error' : ''; ?>>
                            <label>Price</label>
                            <input name="price" class="form-control" value="<?php echo $orderTbl->price; ?>">
                            <span class="help-block"><?php echo $orderTbl->price_msg;?></span>
                        </div>
                        <br/>
                        <input type="submit" name="addbtn" class="btn btn-primary" value="Submit">
                        <a href="../index.php" class="btn btn-default">Cancel</a>

                    </form>

      </div>
    </div>
        <!-- Footer -->
        <footer class="footer pt-4">
            <div class="row align-items-center justify-content-lg-between">
                <div class="col-lg-6">
                    <div class="copyright text-center  text-lg-left  text-muted">
                        &copy; 2020 <a href="https://www.linkedin.com/in/mihai-alexandru-paun/" class="font-weight-bold ml-1" target="_blank">Mihai Alexandru Paun</a>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                        <li class="nav-item">
                            <a href="#" class="nav-link" target="_blank">Github</a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
</div>
</div>
<!-- Argon Scripts -->
<!-- Core -->
<script src="../assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="../assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../assets/vendor/js-cookie/js.cookie.js"></script>
<script src="../assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js"></script>
<script src="../assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js"></script>
<!-- Optional JS -->
<script src="../assets/vendor/chart.js/dist/Chart.min.js"></script>
<script src="../assets/vendor/chart.js/dist/Chart.extension.js"></script>
<!-- Argon JS -->
<script src="../assets/js/argon.js?v=1.2.0"></script>
</body>

</html>