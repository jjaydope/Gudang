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
    <nav class="navbar navbar-dark bg-dark">
        <div class="container">
            <br>
            <a class="navbar-brand">Ubah Data Member</a>

        </div>
    </nav>
    <div class="container">
        <?php
        include "../koneksi.php";
        $qry_get_member = mysqli_query($conn, "select * from member where NIP = " . $_GET['NIP']);
        $dt_member = mysqli_fetch_array($qry_get_member);
        ?>
        <form action="proses_ubah_member.php" method="post">
            <input type="hidden" name="NIP" value="<?= $dt_member['NIP'] ?>">
            Nama :
            <input type="text" name="nama" value="<?= $dt_member['nama'] ?>" class="form-control">
            Bagian:
            <select name="id_bagian" class="form-control">

                <option></option>
                <?php include "../koneksi.php";
                $qry_bagian = mysqli_query($conn, "select * from bagian");
                while ($data_bagian = mysqli_fetch_array($qry_bagian)) {
                    echo '<option value="' . $data_bagian['id_bagian'] . '">' . $data_bagian['nama_bagian'] . '</option>';
                }
                ?>
            </select>

            password :
            <input type="password" name="password" value="<?= $dt_member['password'] ?>" class="form-control">
            <br>
            <input type="submit" name="simpan" value="Ubah member" class="btn btn-primary"> |
            <a href="../tampil_member.php" class="btn btn-warning">Kembali</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>

</html>