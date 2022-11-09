<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    echo "<script>alert('Role tidak benar');location.href='../tampil_member.php';</script>";
}
?>

<!DOCTYPE html>
<html>

<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Gudang</title>
</head>

<body>
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand">Ubah Bagian </a>

        </div>
    </nav>
    <?php
    include "../koneksi.php";
    $qry_get_bagian = mysqli_query($conn, "select * from bagian where id_bagian = " . $_GET['id_bagian']);
    $dt_bagian = mysqli_fetch_array($qry_get_bagian);
    ?>
    <form action="proses_ubah_bagian.php" method="post">
        <input type="hidden" name="id_bagian" value="<?= $dt_bagian['id_bagian'] ?>">
        bagian :
        <input type="text" name="nama_bagian" value="<?= $dt_bagian['nama_bagian'] ?>" class="form-control">


        <input type="submit" name="simpan" value="Ubah bagian" class="btn btn-primary">
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>