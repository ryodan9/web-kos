<?php

include '../config.php';

$jumlahfile = count($_FILES['foto']['name']);
$no_ruangan = $_POST['no_ruangan'];

for($i = 0; $i < $jumlahfile; $i++){
    $namafile = $_FILES['foto']['name'][$i];
    $tmp = $_FILES['foto']['tmp_name'][$i];

    move_uploaded_file($tmp, '../file/'.$no_ruangan.'-'.$namafile);
    $nama = $no_ruangan.'-'.$namafile;
    mysqli_query($conn, "INSERT INTO foto (foto, no_ruangan) VALUES('$nama',
                            '$_POST[no_ruangan]'
    )");
    header("Location: detail.php");
}

?>