<!DOCTYPE html>
<html>
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
		<h3>Dummy Add</h3>
		</div>

		<form action="proses_add.php" method="post" enctype="multipart/form-data">
        
            Nama Barang :
            <input type="varchar" name="nama" value="" class="form-control">
            kode :
            <input type="varchar" name="kode_barang" value="" class="form-control">
            Stok :
            <input type="integer" name="stok" value="" class="form-control">
            <div class="form-group">
                <img alt="testing" src="barcode.php?text=testing&print=true">
            </div>
			<br/>
			<input type="submit" name="simpan" value="Tambah Barang" class="btn btn-primary">
			<a href="dummy.php" class="btn btn-danger">Kembali</a>   
			</div>
			</div>
		</form>
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"crossorigin="anonymous">
		</script>
	</body>