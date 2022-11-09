<?php
session_start();
if ($_SESSION['role'] != 'admin') {
  echo "<script>alert('Role tidak benar');location.href='../tampil_member.php';</script>";
}
?>
<!DOCTYPE html>
<html>

<head>
  <title>Petugas | Gudang</title>
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
      <h3>TAMBAH PETUGAS</h3>
    </div>
    <form action="proses_tambah_petugas.php" method="post" enctype="multipart/form-data">

      Username :
      <input type="varchar" name="username" value="" class="form-control">
      Password :
      <input type="password" name="password" value="" class="form-control">
      Nama Petugas :
      <input type="varchar" name="nama_petugas" value="" class="form-control">

      role :
      <select name="role" class="form-control">
        <option></option>
        <option value="admin">admin</option>
        <option value="petugas">petugas</option>
      </select>
      <br />
      <input type="submit" name="simpan" value="Tambah Petugas" class="btn btn-primary">
      <a href="../tampil_petugas.php" class="btn btn-danger">Kembali</a>
  </div>
  </div>
  </form>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
  </script>
</body>