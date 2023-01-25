<?php

include '../config.php';

error_reporting(0);

session_start();

$id = $_SESSION['id'];

if ($_SESSION['username'] == "" or $_SESSION['username'] == "admin"){
    header("Location: index.php");
}

if (isset($_POST['bayar'])) {
    $nama_foto = $_FILES['bukti_bayar']['name'];

    $nama = 'Bukti_Pembayaran_'.$nama_foto;
    move_uploaded_file($_FILES['bukti_bayar']['tmp_name'], '../file/'.'Bukti_Pembayaran_'.$nama_foto);
    $bayar = mysqli_query($conn, "INSERT INTO pembayaran(penghuni, no_ruangan, bukti_bayar, status) VALUES ('$_POST[penghuni]', 
                    '$_POST[no_ruangan]', 
                    '$nama', 
                    '$_POST[status]'
                    )");
    
    if($bayar){
        echo "<script>
            alert('Pembayaran berhasil dikirim.');
            document.location='user-ruangan.php';
         </script>";
    }
    
}

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>User - Profile</title>
    
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
  <div class="container-xl px-4 mt-4">
    
    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link active ms-0" href="profil.php">Profile</a>
        <a class="nav-link" href="user-ruangan.php">Kamar Anda</a>
        <a class="nav-link" href="../logout.php">Logout</a>
    </nav>
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Profile Picture</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <img class="img-account-profile rounded-circle mb-2" src="http://bootdey.com/img/Content/avatar/avatar1.png" alt="">
                 
                    <!-- Profile picture help block-->
                    <h4>Selamat Datang, <?php echo $_SESSION['username']; ?>!</h4>
                    
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Informasi Kamar</div>
                <div class="card-body">
                    
                <?php
                    $result = mysqli_query($conn, "SELECT * from profil INNER JOIN penghuni on penghuni.penghuni = profil.id WHERE id_user ='$id'");
                    while($res = mysqli_fetch_array($result)) {
                ?>
                    <h5>Anda menempati Kamar No. <?php echo $res['no_ruangan']; ?></h5>
                    <h5>Tanggal Keluar: <?php echo date('d F Y', strtotime($res["tanggal_keluar"])); ?></h3>
                    <h6 style="margin-top: 20px;">Silahkan tambah waktu jika anda ingin memperpanjang.</h6>
                    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#large<?php echo $res['no_ruangan']; ?>">
                                                            Tambah
                                                        </button>
                                                        <div class="modal fade text-left" id="large<?php echo $res['no_ruangan']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg"
                                                                role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title" id="myModalLabel33">Pembayaran</h4>
                                                                        <button type="button" class="close" data-bs-dismiss="modal"
                                                                            aria-label="Close">
                                                                            <i data-feather="x">x</i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                    <form action="" method="POST" enctype="multipart/form-data">
                                                                        <div class="modal-body">
                                                                            <input type="hidden" name="penghuni" value="<?php echo $res['penghuni']; ?>">
                                                                            <input type="hidden" name="no_ruangan" value="<?php echo $res['no_ruangan']; ?>">
                                                                            <?php
                                                                            $no = $res['no_ruangan'];
                                                                            $getHarga = mysqli_query($conn, "SELECT harga from ruangan WHERE no_ruangan= '$no'");
                                                                            $row = mysqli_fetch_array($getHarga)
                                                                            ?>
                                                                            <p>Harga: <?php echo $row['harga'] ?>/bulan</p>
                                                                            <p>No Rekening : ....... BCA</p>
                                                                            
                                                                            <div class="form-group">
                                                                                <label for="foto">Bukti Pembayaran :</label>
                                                                                <input type="file" name="bukti_bayar" class="form-control" accept=".jpg" required>
                                                                            </div>
                                                                            <input type="hidden" name="status" value="Dibayar">
                                                                        </div>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-light-secondary"
                                                                                data-bs-dismiss="modal">
                                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                                <span class="d-none d-sm-block">Close</span>
                                                                            </button>
                                                                            <button type="submit" name="bayar" class="btn btn-primary ml-1">
                                                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                                                <span class="d-none d-sm-block">Bayar</span>
                                                                            </button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- end Update -->
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <p class="login-register-text" style="margin-top: 10px;">Kembali ke beranda. <a href="../index.php">Kembali</a></p>
</div>

    <!-- end of footer -->

    <script src="js/client-side.js"></script>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>