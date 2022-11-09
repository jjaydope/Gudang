<?php
if ($_POST) {
    $id_barang = $_POST['id_barang'];
    $nama_barang = $_POST['nama_barang'];
    $kode = $_POST['kode_barang'];
    $stok = $_POST['stok'];


    if (empty($nama_barang) || empty($stok)) {
        echo "<script>alert(' data harus diisi!');location.href='ubah_barang.php?id_barang=$id_barang'</script>";
    } else {
        include "../koneksi.php";
        $query = "UPDATE barang SET kode_barang ='$kode',nama_barang='$nama_barang',stok='$stok' where id_barang='$id_barang'";
        $update = mysqli_query($conn, $query);
        if ($update) {
            echo "<script>alert('Sukses update barang');location.href='../tampil_barang.php';</script>";
        } else {
            echo //mysqli_error($conn);
            "<script>alert('Gagal update barang');location.href='ubah_barang.php?id_barang=" . $id_barang . "';</script>";
        }
    }
}
