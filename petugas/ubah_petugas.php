<?php
session_start();
if ($_SESSION['role'] != 'admin') {
    echo "<script>alert('Role tidak benar');location.href='../tampil_member.php';</script>";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- css bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">
        <h2> ubah petugas </h2>
        <?php
        include "../koneksi.php";
        $qry_get_petugas = mysqli_query($conn, "select * from petugas where id_petugas = " . $_GET['id_petugas']);
        $dt_petugas = mysqli_fetch_array($qry_get_petugas);
        ?>
        <form action="proses_ubah_petugas.php" method="post">
            <input type="hidden" name="id_petugas" value="<?= $dt_petugas['id_petugas'] ?>">
            Username :
            <input type="text" name="username" value="<?= $dt_petugas['username'] ?>" class="form-control">
            password :
            <input type="password" name="password" value="<?= $dt_petugas['password'] ?>" class="form-control">
            Nama petugas :
            <input type="text" name="nama_petugas" value="<?= $dt_petugas['nama_petugas'] ?>" class="form-control">
            Role :
            <select name="role" class="form-control">
                <option></option>
                <option value="admin" <?php if ($dt_petugas['role'] == 'admin') {
                                            echo 'selected';
                                        } ?>>Admin</option>
                <option value="petugas" <?php if ($dt_petugas['role'] == 'petugas') {
                                            echo 'selected';
                                        } ?>>petugas</option>
            </select><br>

            <input type="submit" name="simpan" value="Ubah petugas" class="btn btn-primary">|
            <a href="../tampil_petugas.php" class="btn btn-warning">Kembali</a>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>