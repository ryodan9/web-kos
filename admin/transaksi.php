<?php

include '../config.php';

session_start();

if ($_SESSION['username'] == "" or $_SESSION['username'] != "admin"){
    header("Location: loginadmin.php");
}

if (isset($_POST['edit'])){
    $id = $_POST['id'];
    $no_ruangan = $_POST['no_ruangan'];
    $penghuni = $_POST['penghuni'];
    $tanggal_keluar = $_POST['tanggal_keluar'];

    mysqli_query($conn, "UPDATE penghuni SET no_ruangan = '$no_ruangan',
                    penghuni = '$penghuni',
                    tanggal_keluar = '$tanggal_keluar'
                    WHERE id = '$id'");
    mysqli_query($conn, "UPDATE pembayaran SET status = 'Diterima' WHERE no_ruangan = '$no_ruangan'");
    header("Location: transaksi.php");
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
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
                        <li class="sidebar-item ">
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

                        <li class="sidebar-item">
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

                        <li class="sidebar-item active ">
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
                <h3>Manajemen Transaksi</h3>
            </div>
            
            <div class="row" id="basic-table" style="margin-top: 20px;">
                            <div class="card">
    
                                <div class="card-content">
                                    <div class="card-body">
                                        <!-- Table with outer spacing -->
                                        <div class="table-responsive">
                                            <table class="table table-lg">
                                                <thead>
                                                    <tr>
                                                        <th>No. Ruangan</th>
                                                        <th>Nama</th>
                                                        <th>Harga</th>
                                                        <th>Bukti</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    $result = mysqli_query($conn, "SELECT * from profil INNER JOIN pembayaran on pembayaran.penghuni = profil.id WHERE status = 'Dibayar'");
                                                    while($res = mysqli_fetch_array($result)) {
                                                        $no = $res['no_ruangan'];
                                                    ?>
                                                    <tr>
                                                        <td class="text-bold-500"><?php echo $res['no_ruangan']; ?></td>
                                                        <td><?php echo $res['nama']; ?></td>
                                                        <?php 
                                                        $getHarga = mysqli_query($conn, "SELECT harga from ruangan WHERE no_ruangan = '$no'");
                                                        $row = mysqli_fetch_array($getHarga)
                                                        ?>
                                                        <td class="text-bold-500"><?php echo $row['harga']; ?></td>
                                                        <td><a href="../file/<?php echo $res['bukti_bayar']; ?>">Lihat Bukti</a></td>
                                                        <td>
                                    
                                                        <!-- Update -->
                                                        <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#inlineForm<?php echo $res['no_ruangan']; ?>">
                                                            Edit
                                                        </button>
                                                        <div class="modal fade text-left" id="inlineForm<?php echo $res['no_ruangan']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title" id="myModalLabel33">Edit</h4>
                                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                                            aria-label="Close">
                                                                            <i data-feather="x"></i>
                                                                        </button>
                                                                    </div>
                                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                                        <div class="modal-body">
                                                
                                                                        <input type="hidden" name="no_ruangan" value="<?php echo $res['no_ruangan']; ?>">
                                                                            <div class="form-group">
                                                                                <label for="penghuni">Penghuni :</label>
                                                                                <select class="form-select col-10" id="inputGroupSelect01" name="penghuni">
                                                                                    <option value="<?php echo $res['penghuni'] ?>" selected><?php echo $res['nama'] ?></option>
                                                                            
                                                            
                                                                                </select>
                                                                            </div>
                                                                            <?php 
                                                                            $getTanggal = mysqli_query($conn, "SELECT id, tanggal_keluar from penghuni WHERE no_ruangan = '$no'");
                                                                            $tgl = mysqli_fetch_array($getTanggal)
                                                                            ?>
                                                                            <div class="form-group">
                                                                                <label for="tanggal_keluar">Tanggal Keluar :</label>
                                                                                <input type="date" name="tanggal_keluar" value="<?php echo $tgl['tanggal_keluar']; ?>" class="form-control">
                                                                            </div>
                                                                            <input type="hidden" name="id" value="<?php echo $tgl['id']; ?>">
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-light-secondary"
                                                                                data-bs-dismiss="modal">
                                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                                <span class="d-none d-sm-block">Close</span>
                                                                            </button>
                                                                            <button type="submit" name="edit" class="btn btn-primary ml-1">
                                                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                                                <span class="d-none d-sm-block">Edit</span>
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end Update -->
                                                        </td>
                                                    </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
        </div>
    </div>
    <script src="../mazer-main/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="../mazer-main/dist/assets/js/bootstrap.bundle.min.js"></script>

    <script src="../mazer-main/dist/assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="../mazer-main/dist/assets/js/pages/dashboard.js"></script>

    <script src="../mazer-main/dist/assets/js/main.js"></script>
</body>

</html>