<?php

include '../config.php';

error_reporting(0);

session_start();

$id = $_SESSION['id'];

if ($_SESSION['username'] == "" or $_SESSION['username'] == "admin"){
    header("Location: index.php");
}

if (isset($_POST['simpan'])) {
    $simpan = mysqli_query($conn, "INSERT INTO profil(nama, asal_kota, umur, pekerjaan, no_hp, id_user) VALUES ('$_POST[nama]', 
                    '$_POST[asal_kota]', 
                    '$_POST[umur]', 
                    '$_POST[pekerjaan]', 
                    '$_POST[no_hp]', 
                    '$_POST[id_user]'
                    )");
    
    if($simpan){
        echo "<script>
            alert('Profil berhasil disimpan.');
            document.location='profil.php';
         </script>";
    }
    
}

if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $asal_kota = $_POST['asal_kota'];
    $umur = $_POST['umur'];
    $pekerjaan = $_POST['pekerjaan'];
    $no_hp = $_POST['no_hp'];
    $id_user = $_POST['id_user'];

    $edit = mysqli_query($conn, "UPDATE profil SET nama = '$nama',
                    asal_kota = '$asal_kota',
                    umur = '$umur',
                    pekerjaan = '$pekerjaan',
                    no_hp = '$no_hp',
                    id_user = '$id_user'
                    WHERE id = '$id'");
    
    if($edit){
        echo "<script>
            alert('Profil berhasil diubah.');
            document.location='profil.php';
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
                <div class="card-header">Informasi Akun</div>
                <div class="card-body">
                <?php
                    $profil = mysqli_query($conn, "SELECT * from profil WHERE id_user = '$id'");
                    if(mysqli_num_rows($profil)>0){
                        while($pro = mysqli_fetch_array($profil)) {
                ?>
                    <form action="" method="POST">
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputNama">Nama</label>
                            <input class="form-control" id="inputNama" type="text" name="nama" value="<?php echo $pro['nama'] ?>">
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputKota">Asal Kota</label>
                                <input class="form-control" id="inputKota" type="text" name="asal_kota" value="<?php echo $pro['asal_kota'] ?>">
                            </div>
                            
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputUmur">Umur</label>
                                <input class="form-control" id="inputUmur" type="number" name="umur" value="<?php echo $pro['umur'] ?>">
                            </div>
                        </div>
                        
                        <!-- Form Group -->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputPekerjaan">Pekerjaan</label>
                            <input class="form-control" id="inputPekerjaan" type="text" name="pekerjaan" value="<?php echo $pro['pekerjaan'] ?>">
                        </div>
                        <!-- Form Row-->
                        
                            <!-- Form Group (phone number)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputPhone">No Telepon</label>
                                <input class="form-control" id="inputPhone" type="text" name="no_hp" value="<?php echo $pro['no_hp'] ?>">
                            </div>
                
                        
                        <!-- Save changes button-->
                        <input type="hidden" name="id_user" value="<?php echo $_SESSION['id']; ?>">
                        <input type="hidden" name="id" value="<?php echo $pro['id'] ?>">
                        <button type="submit" class="btn btn-primary" name="edit" style="background-color: #ff5a05; border: none;">Simpan</button>
                    </form>
                    <?php }} else {?>
                        <h6>Lengkapi Biodata sebelum Memesan Kamar!</h6>
                        <form action="" method="POST">
                        <!-- Form Group (username)-->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputNama">Nama</label>
                            <input class="form-control" id="inputNama" type="text" name="nama">
                        </div>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputKota">Asal Kota</label>
                                <input class="form-control" id="inputKota" type="text" name="asal_kota">
                            </div>
                            
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputUmur">Umur</label>
                                <input class="form-control" id="inputUmur" type="number" name="umur">
                            </div>
                        </div>
                        
                        <!-- Form Group -->
                        <div class="mb-3">
                            <label class="small mb-1" for="inputPekerjaan">Pekerjaan</label>
                            <input class="form-control" id="inputPekerjaan" type="text" name="pekerjaan">
                        </div>
                        <!-- Form Row-->
                        
                            <!-- Form Group (phone number)-->
                            <div class="mb-3">
                                <label class="small mb-1" for="inputPhone">No Telepon</label>
                                <input class="form-control" id="inputPhone" type="text" name="no_hp">
                            </div>
                
                        
                        <!-- Save changes button-->
                        <input type="hidden" name="id_user" value="<?php echo $_SESSION['id']; ?>">
                        <button type="submit" class="btn btn-primary" name="simpan" style="background-color: #ff5a05; border: none;">Simpan</button>
                    </form>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <p class="login-register-text" style="margin-top: -10px;">Kembali ke beranda. <a href="../index.php">Kembali</a></p>
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