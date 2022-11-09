>
<?php

if ($_GET['NIP']) {
    include "../koneksi.php";
    $qry_hapus = mysqli_query($conn, "delete from member where NIP='" . $_GET['NIP'] . "'");
    if ($qry_hapus) {
        echo "<script>alert('Sukses hapus member');location.href='../tampil_member.php';</script>";
    } else {
        echo "<script>alert('Gagal :( ');location.href='../tampil_member.php';</script>";
    }
}
?>