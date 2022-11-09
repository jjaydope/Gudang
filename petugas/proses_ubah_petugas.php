<?php
include '../koneksi.php';
$id_petugas=$_POST['id_petugas'];
$username=$_POST['username'];
$password=$_POST['password'];
$nama_petugas=$_POST['nama_petugas'];
$role=$_POST['role'];

$query="UPDATE petugas SET username='$username',password ='".md5($password)."',nama_petugas='$nama_petugas',role='$role' where id_petugas='$id_petugas'";
mysqli_query($conn, $query);

if($query){
    echo "<script>alert('Sukses edit user');location.href='../tampil_petugas.php';</script>";
    } else {
    echo "<script>alert('Gagal edit user');location.href='../tampil_petugas.php';</script>";
    }
?>