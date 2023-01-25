<?php

include '../config.php';

session_start();

if ($_SESSION['username'] == "" or $_SESSION['username'] != "admin"){
    header("Location: loginadmin.php");
}

// Data Ruangan
$getRuangan = mysqli_query($conn, "SELECT * from ruangan");
$countRuangan = mysqli_num_rows($getRuangan);

// Data Ruangan Keisi
$getIsi = mysqli_query($conn, "SELECT * from ruangan WHERE status = 'Ditempati'");
$countIsi = mysqli_num_rows($getIsi);

// Data User
$getUser = mysqli_query($conn, "SELECT * from users");
$countUsers = mysqli_num_rows($getUser);

// Data Transaksi
$getTransaksi = mysqli_query($conn, "SELECT * from pembayaran");
$countTransaksi = mysqli_num_rows($getTransaksi);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../mazer-main/dist/assets/vendors/simple-datatables/style.css">
    <link rel="stylesheet" href="../mazer-main/dist/assets/css/bootstrap.css">

    <link rel="stylesheet" href="../mazer-main/dist/assets/vendors/iconly/bold.css">

    <link rel="stylesheet" href="../mazer-main/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="../mazer-main/dist/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="../mazer-main/dist/assets/css/app.css">
    <link rel="shortcut icon" href="../mazer-main/dist/assets/images/favicon.svg" type="image/x-icon">
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            Admin
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-item active ">
                            <a href="indexadmin.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-title">Manajemen</li>

                        <li class="sidebar-item ">
                            <a href="ruangan.php" class='sidebar-link'>
                                <i class="bi bi-grid-1x2-fill"></i>
                                <span>Ruangan</span>
                            </a>
                        </li>

                        <li class="sidebar-item ">
                            <a href="detail.php" class='sidebar-link'>
                                <i class="bi bi-image-fill"></i>
                                <span>Detail Ruangan</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="penghuni.php" class='sidebar-link'>
                                <i class="bi bi-person-badge-fill"></i>
                                <span>Penghuni</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="transaksi.php" class='sidebar-link'>
                                <i class="bi bi-cash"></i>
                                <span>Transaksi</span>
                            </a>
                        </li>

                        <li class="sidebar-item  ">
                            <a href="logout.php" class='sidebar-link'>
                                <i class="bi bi-x-octagon-fill"></i>
                                <span>Logout</span>
                            </a>
                        </li>

                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>Profile Statistics</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-9">
                        <div class="row">
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon purple">
                                                    <i class="iconly-boldShow"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Total Kamar</h6>
                                                <h6 class="font-extrabold mb-0"><?php echo $countRuangan ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon blue">
                                                    <i class="iconly-boldProfile"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Kamar Terisi</h6>
                                                <h6 class="font-extrabold mb-0"><?php echo $countIsi ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon green">
                                                    <i class="iconly-boldAdd-User"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Total Users</h6>
                                                <h6 class="font-extrabold mb-0"><?php echo $countUsers ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-3 col-md-6">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon red">
                                                    <i class="iconly-boldBookmark"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">Transaksi</h6>
                                                <h6 class="font-extrabold mb-0"><?php echo $countTransaksi ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <section class="section">
                    <div class="card">
                        <div class="card-header">
                            Data User
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="table1">
                                <thead>
                                    
                                    <tr>
                                        <th>Username</th>
                                        
                                        <th>Status</th>
                                    </tr>
                                    
                                </thead>
                                <tbody>
                                <?php 

                                $result = mysqli_query($conn, "SELECT * from users");
                                while($res = mysqli_fetch_array($result)) {
                                ?>
                                    <tr>
                                        <td><?php echo $res['username']; ?></td>
                                       
                                        <td>
                                            <span class="badge bg-success">Active</span>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </section>
        </div>
    </div>
    <script>
        
        
        let table1 = document.querySelector('#table1');
        let dataTable = new simpleDatatables.DataTable(table1);
    
    </script>
    <script src="../mazer-main/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></scrip>
    <script src="../mazer-main/dist/assets/js/bootstrap.bundle.min.js"></script>

    <script src="../mazer-main/dist/assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="../mazer-main/dist/assets/js/pages/dashboard.js"></script>
    <script src="../mazer-main/dist/assets/vendors/simple-datatables/simple-datatables.js"></script>

    <script src="../mazer-main/dist/assets/js/main.js"></script>
</body>

</html>