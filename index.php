<?php

session_start();

require 'admin/counter.php';
$hit = new HitCounter();

$hit->Hitung();

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
    
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
          <div class="navbar-header">
            <img src="img/logo.png" alt="Logo" 
            width="50" height="50" align="left">
            <a class="navbar-brand" href="#">&#160; Kos Mak Ida</a>
          </div>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto px-1">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item ms-4">
                <a class="nav-link" href="ruangan.php">List Ruangan</a>
              </li>
              <li class="nav-item ms-4">
                <a class="nav-link" href="#about">About</a>
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
                  <li><a class="dropdown-item" href="user/profil.php">Profile</a></li>
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
      <div class="jumbotron jumbotron-fluid" id="jumbotron">
        <div class="container">
          <div class="row">
            <div class="col-6">
              <h1 class="display-4"><span>Let's Find your</span> Room, <br><span>For your Perfect</span> HOME</h1>
            </div>
            <div class="display-5">
                <p>Cari ruangan kos yang dapat anda tempati <br>
                dengan harga dan fasilitas terbaik, hanya di Mak Ida
            </p>
            </div>
            <a class="btn btn-start" href="#room">START</a>
        </div>
        </div>
      </div>

      <!-- end of JBT -->

      <!-- our room -->
      <div class="room" id="room">
        <div class="container">
            <h1>Our Room</h1>
            <div class="row" style="margin-top: 70px;">
                <div class="col">
                    <img src="img/halaman.jpg" alt="">
                </div>
                <div class="col">
                    <img src="img/tampilanluar.jpg" alt="">
                </div>
                <div class="col">
                    <img src="img/dapurkosan.jpg" alt="">
                </div>
                <div class="col">
                    <img src="img/IsiKamar.jpg" alt="">
                </div>
            </div>
            <div class="dot">
            <i style="font-size:18px" class="fa">&#xf111;</i>
            <i style="font-size:18px" class="fa">&#xf111;</i>
            <i style="font-size:18px" class="fa">&#xf111;</i>
            <i style="font-size:18px" class="fa">&#xf111;</i>
            <i style="font-size:18px" class="fa">&#xf111;</i>
            <i style="font-size:18px" class="fa">&#xf111;</i>
            </div>
            <a href="ruangan.php" class="btn btn-room">Cari Ruangan</a>
        </div>
      </div>
    
    <!-- end of room -->

    <!-- about -->
    <div class="about" id="about">
        <div class="container">
        <h1>Tentang Kos Mak Ida</h1>
        <div class="row row-about">
            <div class="col">
                Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aliquid, placeat assumenda! Ipsum nostrum illum id delectus optio neque sit molestias esse. Fugit sit aut enim repudiandae, eaque quo similique quis!
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Atque minus voluptatibus suscipit tempore! Fuga ab id quod. Fugit fugiat nihil, culpa, assumenda libero, commodi quis quo consequuntur facilis dolorum tempora!
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Soluta inventore a, fugit doloribus vero consectetur voluptas eum facere? Voluptatibus sequi non facilis autem! Nostrum soluta ut id, omnis quo porro!
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Excepturi, ducimus praesentium quisquam aspernatur officia, ipsam odio explicabo illum aut accusamus unde at, dignissimos amet non placeat similique nobis? Beatae, amet!
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Facere excepturi ea aut maxime nemo eaque, ab, ipsa quam esse mollitia molestias ullam, ipsum fuga veritatis impedit. Modi perspiciatis nihil alias.
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Voluptas magni, distinctio voluptate tenetur commodi, facilis alias saepe enim officia soluta totam libero, esse eius tempora sed! Nesciunt voluptates ullam maxime.
                Lorem ipsum, dolor sit amet consectetur adipisicing elit. Recusandae, nam fugiat eligendi quaerat repellat assumenda autem excepturi labore impedit, commodi maxime adipisci aliquam soluta, dolorum laborum tempora quia. Quidem, maiores.
            </div>
            <div class="col">
                <img src="img/about.jpg" alt="">
            </div>
        </div>
        </div>
    </div>

    <!-- end of about -->

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