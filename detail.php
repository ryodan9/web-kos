<?php
include 'config.php';

session_start();

$no = $_GET['no'];

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Beranda</title>

    <style>
      
    </style>
    
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top" style="background-color: white;">
        <div class="container">
          <div class="navbar-header">
            <img src="img/logo.png" alt="Logo" 
            width="50" height="50" align="left">
            <a class="navbar-brand" href="index.php">&#160; Kos Mak Ida</a>
          </div>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto px-1">
                <li class="nav-item ms-4">
                    <a class="nav-link" href="ruangan.php">List Ruangan</a>
                </li>
              <?php if(!isset($_SESSION['username'])) {

              ?>
              <li class="nav-item ms-4">
                <a class="nav-link login-button" href="login.php"><span>Login</span></a>
              </li>
              <?php } else {

              ?>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <?php echo $_SESSION['username'] ?>
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                  <li><a class="dropdown-item" href="#">Profile</a></li>
                  <li><hr class="dropdown-divider"></li>
                  <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
              </li>
              <?php } ?>
            </ul>
          </div>
        </div>
      </nav>
      <!-- end of header -->

      <!-- JBT -->
        <?php 

        $getFoto = mysqli_query($conn, "SELECT * from foto WHERE no_ruangan = '$no'");

        ?>
    
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <div class="carousel-indicators">
     <?php
        for($i=0; $i<$getFoto->num_rows;$i++){
            ?>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="<?php echo $i ?>" <?php if($i==0){ echo 'class="active" aria-current="true"';} ?> aria-label="Slide <?php echo $i+1; ?>"></button>
    <?php }?>
      </div>
      <div class="carousel-inner">
        <?php
          $counter = 1;
          
        while ($row = mysqli_fetch_array($getFoto)) {
        ?>
            <div class="carousel-item<?php if($counter <= 1){ echo ' active';} ?>">
                <img src="file/<?php echo $row['foto']; ?>" alt="" style="height:700px; width: 100%;">
            </div>
            
         <?php $counter++; }?>
 
      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
    </div>

    
        

      <!-- end of JBT -->
      <!-- tab -->
      <fieldset class="ignielMultiTab" style="margin-top: 0px;">
  
        <input id="tab1" name="mTab" type="radio" checked="checked"/>
        <label for="tab1">Informasi Kamar</label>
        
        <input id="tab2" name="mTab" type="radio"/>
        <label for="tab2">Penghuni</label>
        
        <div class="content">
            
            <div class="tab1">
            <?php 

            $getRuangan = mysqli_query($conn, "SELECT * from ruangan WHERE no_ruangan = '$no'");
            while($room = mysqli_fetch_array($getRuangan)) {
            ?>
            <div class="detail-room">
            <div class="container">
                
                <h3>Kamar No. <?php echo $room['no_ruangan']; ?></h3>
                <h4>Rp. <?php echo $room['harga']; ?> /bulan</h4>
                <button class="btn btn-outline-secondary btn-sm" 
                <?php if($room['status'] == "Tersedia"){ 
                    echo 'style="color: white; border: 1px solid green; background-color: green;"';}else{
                    echo 'style="color: white; border: 1px solid red; background-color: red;"';} ?> disabled><?php echo $room['status']; ?></button>
                <p style="margin-top: 30px; font-size: 20px;"><?php echo $room['deskripsi']; ?></p>
                
                <?php 
                if($room['status'] == "Tersedia"){
                ?>
                <button onclick="alert('Silahkan hubungi nomor kos untuk pemesanan kamar.')" class="btn btn-lg" style="margin-top: 30px; margin-left: 1100px;border-radius: 15px; color: white; background-color: #ff5a05">Pesan Kamar</button>
                <?php }else { ?>
                    <button onclick="alert('Kamar sudah ditempati.')" class="btn btn-lg" style="margin-top: 30px; margin-left: 1100px;border-radius: 15px; color: white; background-color: #ff5a05">Pesan Kamar</button>  
                <?php } ?>

            
            </div>
            </div>
            <?php } ?>
            </div>
            <div class="tab2">
            <?php 

            $getPenghuni = mysqli_query($conn, "SELECT * from profil INNER JOIN penghuni on penghuni.penghuni = profil.id WHERE no_ruangan = '$no'");
            while($row = mysqli_fetch_array($getPenghuni)) {
            ?>
              <div class="detail-penghuni">
                <div class="container">

                <button class="btn btn-sm disabled" style="color: white; background-color: #ff5a05; margin-bottom: 10px;">Tanggal Keluar: <?php echo date('d F Y', strtotime($row["tanggal_keluar"])); ?></button>  
                  <h5>Nama Penghuni : <?php echo $row['nama'] ?></h5>
                  <h5>Asal Kota : <?php echo $row['asal_kota'] ?></h5>
                  <h5>Umur : <?php echo $row['umur'] ?></h5>
                  <h5>Pekerjaan : <?php echo $row['pekerjaan'] ?></h5>
                </div>
              </div>
              <?php } ?>
            </div>

        </div>
    </fieldset>
    <!-- end tab -->

    <!-- footer -->

    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="col">
                    <h4>Maps</h4>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15843.735844308432!2d107.6241322!3d-6.898502!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x41da106c244ecb13!2sKosan%20Mak%20Ida!5e0!3m2!1sen!2sid!4v1674306592878!5m2!1sen!2sid" width="300" height="230" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
                <div class="col" style="margin-left: 30px; margin-top: 80px;">
                    <p class="alamat">
                        Kosak Mak Ida <br>
                        Gg. Gagak I No.1, Sukaluyu, Kecamatan Cibeunying <br>
                        Kota Bandung, Jawa Barat 40123
                    </p>
                    <p class="phone">
                        Phone : <br>
                        0878-2480-7924
                    </p>
                </div>
                <div class="col" style="margin-top: 150px; margin-left: 400px;">
                    <p class="credit">©Ricky Amedio Putra</p>
                </div>
            </div>
        </div>
    </div>

    <!-- end of footer -->

    <script>
        var nav = document.querySelector('nav'); // Identify target

        window.addEventListener('scroll', function(event) { // To listen for event
            event.preventDefault();

            if (window.scrollY <= 150) { // 
                nav.style.backgroundColor = '#fff'; // or default color
                nav.style.boxShadow = "0px 0px 0px black";
            } else {
                nav.style.backgroundColor = '#fff';
                nav.style.boxShadow = "1px 2px 15px black";
            }
        });
    </script>
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