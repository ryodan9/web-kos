<?php

include '../config.php';

session_start();

if ($_SESSION['username'] == "" or $_SESSION['username'] != "admin"){
    header("Location: loginadmin.php");
}

if (isset($_POST['tambah'])) {
    $no_ruangan = $_POST['no_ruangan'];
    $penghuni = $_POST['penghuni'];
    $tanggal_keluar = $_POST['tanggal_keluar'];

    mysqli_query($conn, "INSERT INTO penghuni(no_ruangan, penghuni, tanggal_keluar) VALUES ('$no_ruangan', '$penghuni', '$tanggal_keluar')");
    mysqli_query($conn, "UPDATE ruangan SET status = 'Ditempati' WHERE no_ruangan = '$no_ruangan'");
    header("Location: penghuni.php");
}

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $no = $_POST['no_ruangan'];
    $penghuni = $_POST['penghuni'];
    $tanggal_keluar = $_POST['tanggal_keluar'];

    mysqli_query($conn, "UPDATE penghuni SET no_ruangan = '$no',
                    penghuni = '$penghuni',
                    tanggal_keluar = '$tanggal_keluar'
                    WHERE id = '$id'");
    if($penghuni == ''){
        mysqli_query($conn, "UPDATE ruangan SET status = 'Tersedia' WHERE no_ruangan = '$no'");
    } else {
        mysqli_query($conn, "UPDATE ruangan SET status = 'Ditempati' WHERE no_ruangan = '$no'");
    }
    header("Location: penghuni.php");
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

                        <li class="sidebar-item">
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

                        <li class="sidebar-item active">
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
                <h3>Manajemen Penghuni</h3>
            </div>
            
            <!-- Modal Add -->
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#inlineForm">
                Tambah Penghuni
            </button>
            <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                    role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myModalLabel33">Tambah Penghuni</h4>
                            <button type="button" class="close" data-bs-dismiss="modal"
                                aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form action="" method="POST">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="no_ruangan">Ruangan :</label>
                                    <select class="form-select col-10" id="selectRuangan" name="no_ruangan" required>
                                        <option selected disabled>Choose...</option>
                                        <?php
                                            $getRuangan = mysqli_query($conn, "SELECT no_ruangan from ruangan");
                                            while($data = mysqli_fetch_array($getRuangan)){

                                            ?>
                                        <option value="<?php echo $data['no_ruangan']; ?>">Kamar <?php echo $data['no_ruangan']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="penghuni">Penghuni :</label>
                                    <select class="form-select col-10" id="inputGroupSelect01" name="penghuni" required>
                                        <option selected disabled>Choose...</option>
                                        <?php
                                            $getPenghuni = mysqli_query($conn, "SELECT id, nama from profil");
                                            while($peng = mysqli_fetch_array($getPenghuni)){

                                            ?>
                                        <option value="<?php echo $peng['id']; ?>"><?php echo $peng['nama']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="tanggal_keluar">Tanggal Keluar :</label>
                                    <input type="date" name="tanggal_keluar" class="form-control" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary"
                                    data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Close</span>
                                </button>
                                <button type="submit" name="tambah" class="btn btn-primary ml-1">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Tambah</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- end modal add -->
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
                                                        <th>Penghuni</th>
                                                        <th>Tanggal Keluar</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php

                                                    $result = mysqli_query($conn, "SELECT * from profil INNER JOIN penghuni on penghuni.penghuni = profil.id");
                                                    while($res = mysqli_fetch_array($result)) {
                                                    ?>
                                                    <tr>
                                                        <td class="text-bold-500"><?php echo $res['no_ruangan']; ?></td>
                                                        <td class="text-bold-500"><?php echo $res['nama']; ?></td>
                                                        <td><?php echo $res['tanggal_keluar']; ?></td>
                                                        <td>
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
                                                                            <div class="form-group">
                                                                                <label for="tanggal_keluar">Tanggal Keluar :</label>
                                                                                <input type="date" name="tanggal_keluar" value="<?php echo $res['tanggal_keluar']; ?>" class="form-control">
                                                                            </div>
                                                                            <input type="hidden" name="id" value="<?php echo $res['id']; ?>">
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
                                                        <a href="delete-penghuni.php?id=<?php echo $res['id'] ?>&no=<?php echo $res['no_ruangan'] ?>" class="btn btn-outline-danger">Delete</a>
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