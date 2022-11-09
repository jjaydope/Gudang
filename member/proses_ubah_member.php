<?php
include '../koneksi.php';
$NIP=$_POST['NIP'];
$nama=$_POST['nama'];
$id_bagian=$_POST['id_bagian'];
$password=$_POST['password'];


$query="update member SET nama='$nama',id_bagian='$id_bagian',password ='".md5($password)."' where NIP='$NIP'";
mysqli_query($conn, $query);

if($query){
    echo "<script>alert('Sukses edit user');location.href='../tampil_member.php';</script>";
    } else {
    echo "<script>alert('Gagal edit user');location.href='../tampil_member.php';</script>";
    }
?>