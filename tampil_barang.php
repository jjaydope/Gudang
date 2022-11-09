<?php include 'koneksi.php'; ?>
<?php include 'header.php'; ?>
<!DOCTYPE html>
<html>

<head>
  <title>barang|Gudang</title>
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
      <h3>Data Barang</h3>
    </div>
    <!--Panel Form pencarian -->
    <div class="row">
      <div class="panel panel-default">
        <div class="panel-heading"><b>Pencarian</b></div>
        <div class="panel-body">
          <form class="form-inline">
            <div class="form-group">
              <select class="form-conntrol" id="Kolom" name="Kolom" required="">
                <?php
                $kolom = (isset($_GET['Kolom'])) ? $_GET['Kolom'] : "";
                ?>
                <option value="nama_barang" <?php if ($kolom == "nama_barang") echo "selected"; ?>>Nama</option>
              </select>
            </div>
            <div class="form-group">
              <input type="text" class="form-conntrol" id="KataKunci" name="KataKunci" placeholder="Kata kunci.." required="" value="<?php if (isset($_GET['KataKunci']))  echo $_GET['KataKunci']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Cari</button>
            <a href="tampil_barang.php" class="btn btn-danger">Reset</a>
          </form>
          <table class="table table-striped table-bordered table-hover">
            <thead>
              <tr>
                <th>Nomor</th>
                <th>Barang</th>
                <th>Kode Barang</th>
                <th>Barcode</th>
                <th>stok</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $page = (isset($_GET['page'])) ? (int) $_GET['page'] : 1;

              $kolomCari = (isset($_GET['Kolom'])) ? $_GET['Kolom'] : "";

              $kolomKataKunci = (isset($_GET['KataKunci'])) ? $_GET['KataKunci'] : "";

              // Jumlah data per halaman
              $limit = 5;
              $limitStart = ($page - 1) * $limit;

              //kondisi jika parameter pencarian kosong
              if ($kolomCari == "" && $kolomKataKunci == "") {
                $data_barang = mysqli_query($conn, "SELECT * FROM barang LIMIT " . $limitStart . "," . $limit);
              } else {
                //kondisi jika parameter kolom pencarian diisi
                $data_barang = mysqli_query($conn, "SELECT * FROM barang WHERE $kolomCari LIKE '%$kolomKataKunci%' LIMIT " . $limitStart . "," . $limit);
              }
              $no = $limitStart + 1;

              while ($d = mysqli_fetch_array($data_barang)) {
              ?>

                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $d['nama_barang']; ?></td>
                  <td><?php echo $d['kode_barang']; ?></td>
                  <td><img alt="<?= $d['kode_barang'] ?>" src="a/barcode.php?text=<?= $d['kode_barang'] ?>&print=true" /></td>
                  <td><?php echo $d['stok']; ?></td>

                  <td><a href="barang/ubah_barang.php?id_barang=<?= $d['id_barang'] ?>" class="btn btn-success">Ubah</a> |

                    <a href="barang/hapus_barang.php?id_barang=<?= $d['id_barang'] ?>" onclick="return confirm('Apakah anda yakin menghapus data ini?')" class="btn btn-danger">Hapus</a>
                  </td>
                </tr>
              <?php
              }
              ?>
            </tbody>
            <h5> kata kunci : <?php echo $kolomKataKunci; ?> </h5>
          </table>
          <a href="barang/tambah_barang.php" class="btn btn-dark">Tambah Barang</a> |
          <a href="add_barcode.php" class="btn btn-info">use barcode</a>
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
                  <li><a href="tampil_barang.php?page=<?php echo $LinkPrev; ?>">Previous</a></li>
                <?php
                } else {
                ?>
                  <li><a href="tampil_barang.php?Kolom=<?php echo $kolomCari; ?>&KataKunci=<?php echo $kolomKataKunci; ?>&page=<?php echo $LinkPrev; ?>">Previous</a></li>
              <?php
                }
              }
              ?>
              <?php
              //kondisi jika parameter pencarian kosong
              if ($kolomCari == "" && $kolomKataKunci == "") {
                $data_barang = mysqli_query($conn, "SELECT * FROM barang");
              } else {
                //kondisi jika parameter kolom pencarian diisi
                $data_barang = mysqli_query($conn, "SELECT * FROM barang WHERE $kolomCari LIKE '%$kolomKataKunci%'");
              }

              //Hitung semua jumlah data yang berada pada tabel Sisawa
              $JumlahData = mysqli_num_rows($data_barang);

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
                  <li<?php echo $linkActive; ?>><a href="tampil_barang.php?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>

                  <?php
                } else {
                  ?>
                    <li<?php echo $linkActive; ?>><a href="tampil_barang.php?Kolom=<?php echo $kolomCari; ?>&KataKunci=<?php echo $kolomKataKunci; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
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
                      <li><a href="tampil_barang.php?page=<?php echo $linkNext; ?>">Next</a></li>
                    <?php
                    } else {
                    ?>
                      <li><a href="tampil_barang.php?Kolom=<?php echo $kolomCari; ?>&KataKunci=<?php echo $kolomKataKunci; ?>&page=<?php echo $linkNext; ?>">Next</a></li>
                  <?php
                    }
                  }
                  ?>
            </ul>
          </div>
</body>

</html>