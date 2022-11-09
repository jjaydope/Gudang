<?php include "koneksi.php"; ?>
<?php include "header.php"; ?>

<!DOCTYPE html>

<html>

<head>
  <title>barang masuk|Gudang</title>
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
      <h3>Barang Masuk</h3>
    </div>
    <!-- form filter data berdasarkan range tanggal  -->
    <form action="tampil_barang_masuk.php" method="get">
      <div class="row g-3 align-items-center">
        <div class="col-auto">
          <label class="col-form-label">Periode</label>
        </div>
        <div class="col-auto">
          <input type="date" class="form-control" name="dari" required>
        </div>
        <div class="col-auto">
          -
        </div>
        <div class="col-auto">
          <input type="date" class="form-control" name="ke" required>
        </div>
        <div class="col-auto">
          <button class="btn btn-primary" type="submit">Cari</button>
          <a href="tampil_barang_masuk.php" class="btn btn-danger">Reset</a>
        </div>
      </div>
    </form>
    <table class="table table-striped table-bordered table-hover">
      <thead>

        <tr>
          <th>NO</th>
          <th>Barang</th>
          <th>Kode Barang</th>
          <th>Tanggal Masuk</th>
          <th>Jumlah Barang</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;

        $kolomCari = (isset($_GET['dari'])) ? $_GET['dari'] : "";

        $kolomKataKunci = (isset($_GET['ke'])) ? $_GET['ke'] : "";


        // Jumlah data per halaman
        $limit = 5;
        $limitStart = ($page - 1) * $limit;


        //kondisi jika parameter pencarian kosong
        if ($kolomCari == "" && $kolomKataKunci == "") {
          $data_barang_masuk = mysqli_query($conn, "SELECT * FROM barang_masuk order by tgl_masuk  LIMIT " . $limitStart . "," . $limit);
        } else {
          //kondisi jika parameter kolom pencarian diisi
          $data_barang_masuk = mysqli_query($conn, "SELECT * FROM barang_masuk  WHERE tgl_masuk between  '" . $_GET['dari'] . "' and '" . $_GET['ke'] . "'  LIMIT " . $limitStart . "," . $limit);
        }
        $no = $limitStart + 1;

        while ($d = mysqli_fetch_array($data_barang_masuk)) {
        ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td>
              <?php
              include "koneksi.php";
              $qry_get_barang = mysqli_query($conn, "select * from barang where id_barang='" . $d['id_barang'] . "'");
              $data_barang = mysqli_fetch_array($qry_get_barang);
              echo $data_barang['nama_barang'];
              ?>
              <!-- <?php echo $data_barang['id_barang'] ?> -->
            </td>
            <td>
              <?php
              include "koneksi.php";
              $qry_get_barang = mysqli_query($conn, "select * from barang where id_barang='" . $d['id_barang'] . "'");
              $data_barang = mysqli_fetch_array($qry_get_barang);
              echo $data_barang['kode_barang'];
              ?>
              <!-- <?php echo $data_barang['id_barang'] ?> -->
            </td>
            <td><?php echo date('d M Y', strtotime($d['tgl_masuk'])) ?></td>
            <td><?php echo $d['stok'] ?></td>

          </tr>
        <?php
        }
        ?>
      </tbody>
      <h5> Periode : <?php echo $kolomCari; ?> s.d. <?php echo $kolomKataKunci; ?> </h5>
    </table>
    <a href="barang/barang_masuk.php" class="btn btn-dark">Restock</a>
    <div align="right">
      <ul class="pagination">
        <?php
        // Jika page = 1, maka LinkPrev disable
        if ($page == 1) {
        ?>
          <!-- link Previous Page disable -->
          <li class="disabled"><a href="#">Previous</a></li>
          <?php
        } else {
          $LinkPrev = ($page > 1) ? $page - 1 : 1;

          if ($kolomCari == "" && $kolomKataKunci == "") {
          ?>
            <li><a href="tampil_barang_masuk.php?page=<?php echo $LinkPrev; ?>">Previous</a></li>
          <?php
          } else {
          ?>
            <li><a href="tampil_barang_masuk.php?dari=<?php echo $kolomCari; ?>&ke=<?php echo $kolomKataKunci; ?>&page=<?php echo $LinkPrev; ?>">Previous</a></li>
        <?php
          }
        }
        ?>
        <?php
        //kondisi jika parameter pencarian kosong
        if ($kolomCari == "" && $kolomKataKunci == "") {
          $data_barang_masuk = mysqli_query($conn, "SELECT * FROM barang_masuk");
        } else {
          //kondisi jika parameter kolom pencarian diisi
          $data_barang_masuk = mysqli_query($conn, "SELECT * FROM barang_masuk WHERE tgl_masuk between  '" . $_GET['dari'] . "' and '" . $_GET['ke'] . "' ");
        }

        //Hitung semua jumlah data yang berada pada tabel Sisawa
        $JumlahData = mysqli_num_rows($data_barang_masuk);

        // Hitung jumlah halaman yang tersedia
        $jumlahPage = ceil($JumlahData / $limit);

        // Jumlah link number 
        $jumlahNumber = 1;

        // Untuk awal link number
        $startNumber = ($page > $jumlahNumber) ? $page - $jumlahNumber : 1;

        // Untuk akhir link number
        $endNumber = ($page < ($jumlahPage - $jumlahNumber)) ? $page + $jumlahNumber : $jumlahPage;

        for ($i = $startNumber; $i <= $endNumber; $i++) {
          $linkActive = ($page == $i) ? ' class="active"' : '';

          if ($kolomCari == "" && $kolomKataKunci == "") {
        ?>
            <li<?php echo $linkActive; ?>><a href="tampil_barang_masuk.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>

            <?php
          } else {
            ?>
              <li<?php echo $linkActive; ?>><a href="tampil_barang_masuk.php?dari=<?php echo $kolomCari; ?>&ke<?php echo $kolomKataKunci; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
            <?php
          }
        }
            ?>

            <!-- link Next Page -->
            <?php
            if ($page == $jumlahPage) {
            ?>
              <li class="disabled"><a href="#">Next</a></li>
              <?php
            } else {
              $linkNext = ($page < $jumlahPage) ? $page + 1 : $jumlahPage;
              if ($kolomCari == "" && $kolomKataKunci == "") {
              ?>
                <li><a href="tampil_barang_masuk.php?page=<?php echo $linkNext; ?>">Next</a></li>
              <?php
              } else {
              ?>
                <li><a href="tampil_barang_masuk.php?dari=<?php echo $kolomCari; ?>&ke=<?php echo $kolomKataKunci; ?>&page=<?php echo $linkNext; ?>">Next</a></li>
            <?php
              }
            }
            ?>
      </ul>
    </div>
</body>

</html>