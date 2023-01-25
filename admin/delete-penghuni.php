<?php

include '../config.php';

$id = $_GET['id'];
$no = $_GET['no'];

mysqli_query($conn, "DELETE FROM penghuni WHERE id = '$id'");
mysqli_query($conn, "UPDATE ruangan SET status = 'Tersedia' WHERE no_ruangan = '$no'");
header("Location: penghuni.php");

?>