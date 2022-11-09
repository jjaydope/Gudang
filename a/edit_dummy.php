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
    $qry_get_dummy=mysqli_query($conn,"select * from dummy where id_dummy = ". $_GET['id_dummy']);
    $dt_dummy=mysqli_fetch_array($qry_get_dummy);
    ?>
    <form action="proses_edit_dummy.php" method="post">
        <input type="hidden" name="id_dummy" value= "<?=$dt_dummy['id_dummy']?>">
        Barang :
        <input type="text" name="nama" value= "<?=$dt_dummy['nama']?>" class="form-control">
        kode :
        <input type="text" name="kode_barang" value= "<?=$dt_dummy['kode_barang']?>" class="form-control">
        Stok : 
        <input type="integer" name="stok" value= "<?=$dt_dummy['stok']?>" class="form-control">
    </br>
        <div class="form-group">
        <img alt="<?=$dt_dummy['kode_barang']?>" src="barcode.php?text=<?=$dt_dummy['kode_barang']?>&print=true" />
        </div>
        
    </br>
        <input type="submit" name="simpan" value="Ubah dummy" class="btn btn-primary">
        <a href="dummy.php" class="btn btn-warning"> back </a>
        </form>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>