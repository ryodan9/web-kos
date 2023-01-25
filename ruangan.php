<?php
include 'config.php';

session_start();

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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
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
      <div class="jbt-room jumbotron-fluid" id="jumbotron" style="background-color: #74c1e5; height: 300px;">
        <div class="container">
            <div class="row" style="">
              <h1 class="display-4" style="margin-top: -10px; text-align: center;"><span>Let's Find your</span> Room, <br><span>For your Perfect</span> HOME</h1> 
            </div>
        </div>
      </div>

      <!-- end of JBT -->

      <!-- List Room -->
    
      <div class="list-room" style="margin-top: 200px; box-sizing: border-box;">
        <div class="container-fluid">

            <h2 style="margin-left: 5%;">List Ruangan </h2> <hr>
            <div class="row" style="margin-top: 40px; margin-left: 5%; margin-right: 5%;">
            <?php
            $result = mysqli_query($conn, "SELECT * from ruangan ORDER BY no_ruangan ASC");
            while($res = mysqli_fetch_array($result)) {
            ?>
                <div class="col-3" style="margin-bottom: 30px;">
                    <div class="room-card" style="height: 450px; width: 280px; background-color: white; border-radius: 25px; border: 1px solid grey; box-shadow: 0px 1px 2px black">
                        <img src="file/<?php echo $res['foto']; ?>" alt="" style="height: 250px; width: 280px; border: 1px solid black; border-radius: 25px 25px 0 0;">
                        <div class="desc-room" style="margin-left: 23px; margin-top: 10px;">
                         <div class="top-room" style="">
                            <h6 style="float:left;">Kamar No.<?php echo $res['no_ruangan']; ?></h6>
                            <button class="btn btn-outline-secondary btn-sm" style="margin-left: 60px;" disabled><?php echo $res['status']; ?></button>
                          </div>
                          <div class="bot-room" style="margin-top: -3px;">
                            <h6>Rp. <?php echo $res['harga']; ?></h6>
                            <i style="font-size:20px; margin-top: 10px; margin-left:0px;" class="fa fa-home"></i> Dapur
                            <br><i style="font-size:15px; margin-top: 10px; margin-left:0;" class="fa">&#xf1eb;</i> Wifi
                        
                              <a href="detail.php?no=<?php echo $res['no_ruangan']; ?>" class="btn btn-detail" style="background-color: #ff5a05; color: white; margin-top: 20px;">Lihat Kamar</a>
                            
                          </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                
            </div>
            <hr>
        </div>
      </div>

      <!-- end of room -->

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