<?php
session_start();
if ($_SESSION['status_login'] != true) {
    header('location: loginpetugas.php');
}
?>
<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Jujurly ak sgt tertekan🧑🏻‍❤️‍🧑🏽🧑🏻‍❤️‍🧑🏽</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light" style="box-shadow: 4px 4px 5px -4px;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">LAUNDRY</a>

            <button class="navbar-toggler" type="button" data-bs- toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="home.php">Home</a>
                    </li>

                    <?php
                    if ($_SESSION['role'] == 'admin') {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="tampil_petugas.php">Petugas</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="tampil_member.php">Member</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="tampil_barang.php">Barang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="tampil_barang_masuk.php">Barang Masuk</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="tampil_bagian.php">Bagian</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="tambah_transaksi.php?total_pckg=1">Transaksi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="tampil_transaksi.php">Laporan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="grafik_tgl.php">Grafik Periode</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="grafik.php">Grafik Barang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="kasir.php">Kasir</a>
                        </li>
                    <?php
                    }
                    ?>

                    <?php
                    if ($_SESSION['role'] == 'petugas') {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="tampil_member.php">Member</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="kasir.php">Transaksi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="tampil_transaksi.php">Laporan</a>
                        </li>
                    <?php
                    }
                    ?>

                    <?php
                    if ($_SESSION['role'] == 'owner') {
                    ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="tampil-transaksi.php">Laporan</a>
                        </li>
                    <?php
                    }
                    ?>

                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container bg-light rounded" style="margin-top:10px">