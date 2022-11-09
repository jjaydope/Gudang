<?php

if ($_POST) {
    // detail transaction
    $qty = $_POST['qty'];
    $barang = $_POST['id_barang'];
    // transanction
    $member = $_POST['member'];
    $date = $_POST['tgl'];
    // session login petugas
    session_start();
    $petugas = $_SESSION['id_petugas'];

    include "qoneksi.php";
    $sql = "SELECT id_barang FROM barang where id_barang = '$barang[0]' ";
    $result = mysqli_query($conn, $sql);
    $sto    = mysqli_fetch_array($sql);
    $stok    = $sto['stok'];
    //menghitung sisa stok
    $sisa    = $stok - $qty;

    if ($stok < $qty) {
        echo "<script>alert('barang kurang');location.href='tambah_transaksi.php?total_pckg=1';</script>";
    } else {
        $insert_transaction = mysqli_query($conn, "insert into transaksi (id_petugas,NIP,tgl) value ('" . $petugas . "','" . $member . "','" . $date . "')");

        if ($insert_transaction) {
            echo "<script>alert('Transaksi berhasil');location.href='tampil_transaksi.php';</script>";
        } else {
            echo "<script>alert('Transaksi Gagal! silakan coba kembali!');location.href='tambah_transaksi.php?total_pckg=1';</script>";
        }
    }

    $id_transaction = mysqli_insert_id($conn);

    for ($i = 0; $i < count($qty); $i++)
        $insert_dtl_transaction = mysqli_query($conn, "insert into detail_transaksi (id_transaksi, id_barang, qty) value ('" . $id_transaction . "','" . $barang[$i] . "','" . $qty[$i] . "')");
    // echo "insert into detail_transaksi (id_transaksi, id_paket, qty) value ('".$id_transaction."','".$type[$i]."','".$qty[$i]."')";       
    if ($insert) {
        //update stok
        $upstok = mysqli_query($conn, "UPDATE barang SET stok='$sisa' WHERE id_barang='$barang'");
        echo "<script>alert('Transaksi Sukses');location.href='tampil_transaksi.php?total_pckg=1';</script>";
    } else {
        echo "<script>alert('Transaksi Gagal! silakan coba kembali!');location.href='tambah_transaksi.php?total_pckg=1';</script>";
    }
}
