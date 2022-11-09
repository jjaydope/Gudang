<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    echo "<script>alert('Role tidak benar');location.href='../tampil_member.php';</script>";
}
?>

<!DOCTYPE html>

<head>
    <title>Sup loser's</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- css bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <div align="center">
            <h3>edit</h3>
        </div>

        <body>
            <?php
            include "../koneksi.php";
            $qry_get_barang = mysqli_query($conn, "select * from barang where id_barang = " . $_GET['id_barang']);
            $dt_barang = mysqli_fetch_array($qry_get_barang);
            ?>
            <form action="proses_ubah_barang.php" method="post">
                <input type="hidden" name="id_barang" value="<?= $dt_barang['id_barang'] ?>">
                Barang :
                <input type="text" name="nama_barang" value="<?= $dt_barang['nama_barang'] ?>" class="form-control">
                Barang :
                <input type="char" name="kode_barang" value="<?= $dt_barang['kode_barang'] ?>" class="form-control">
                Stok :
                <input type="integer" name="stok" value="<?= $dt_barang['stok'] ?>" class="form-control">
                </br>
                <img alt="<?= $dt_barang['kode_barang'] ?>" src="../a/barcode.php?text=<?= $dt_barang['kode_barang'] ?>&print=true" />
                </br>
                <input type="submit" name="simpan" value="Ubah barang" class="btn btn-primary">
                <a href="../tampil_barang.php" class="btn btn-warning"> back </a>
            </form>
            <br />
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
        </body>

        </html>