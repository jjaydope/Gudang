<?php
session_start();
include "koneksi.php";
$cart = @$_SESSION['cart'];
if (count($cart) > 0) {
    $tgl_minta = date('Y-m-d', mktime(0, 0, 0, date('m'), (date('d')), date('Y')));

    mysqli_query($conn, "insert into transaksi (NIP,tgl) value('" . $_SESSION['NIP'] . "','" . $tgl_minta . "')");

    $id = mysqli_insert_id($conn);
    foreach ($cart as $key_produk => $val_produk) {
        mysqli_query($conn, "insert into detail_transaksi (id_transaksi,id_barang,qty)
value('" . $id . "','" . $val_produk['id_barang'] . "','" . $val_produk['qty'] . "')");
    }
    unset($_SESSION['cart']);
    echo '<script>alert("Anda berhasil meminjam buku");location.href="histori_transaksi.php"</script>';
}
