<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>restock</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <!-- css bootstrap -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
</head>

<body>
  <div class="container">
    <div align="center">
      <h3>Restock Barang</h3>
    </div>
    <form action="proses_barang_masuk.php" method="post" enctype="multipart/form-data">


      barang :

      <select name="id_barang" id="nomor_surat" class="form-control">

        <option></option>

        <?php

        include "../koneksi.php";

        $qry_barang = mysqli_query($conn, "select * from barang");

        while ($data_barang = mysqli_fetch_array($qry_barang)) {

          echo '<option value="' . $data_barang['id_barang'] . '">' . $data_barang['nama_barang'] . '</option>';
        }

        ?>

      </select>
      tanggal:
      <input type="date" name="tgl_masuk" value="" class="form-control">
      Stok :
      <input type="integer" name="stok" value="" class="form-control">
      <br />
      <input type="submit" name="simpan" value="Tambah Barang" class="btn btn-primary">
      <a href="../tampil_barang_masuk.php" class="btn btn-danger">Kembali</a>
  </div>
  </div>
  </form>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
  </script>

  <script type="text/javascript">
    $(document).ready(function() {
      $('#nomor_surat').select2();
    });
  </script>
</body>