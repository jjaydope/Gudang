<?php
if ($_GET['id_bagian']) {
    include "../koneksi.php";
    $qry_hapus = mysqli_query($conn, "delete from bagian where id_bagian='" . $_GET['id_bagian'] . "'");
    if ($qry_hapus) {
        echo "<script>alert('Sukses hapus bagian');location.href='../tampil_bagian.php';</script>";
    } else {
        echo "<script>alert('Gagal :( ');location.href='../tampil_bagian.php';</script>";
    }
}
