
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

    <center> <h3>Summer Ed.</h3> </center>
    <table class="table table-hover table-striped">
        <thead>
            <tr>
                <th>NO</th>
                <th>Barang</th>
                <th>Kode</th>
                <th>stok</th>
                <th>Barcode</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            include "../koneksi.php";
            $qry_paket=mysqli_query($conn,"select * from dummy");
            $no = 0;
            while($data_paket=mysqli_fetch_array($qry_paket)){
            $no++;?>
            <tr>
                <td><?=$no?></td>
                <td><?=$data_paket['nama']?></td> 
                <td><?=$data_paket['kode_barang']?></td>
                <td><?=$data_paket['stok']?></td>
                <td> 
                    <img alt="<?=$data_paket['kode_barang']?>" src="barcode.php?text=<?=$data_paket['kode_barang']?>&print=true" />
                </td>
                <td>
				<a href="edit_dummy.php?id_dummy=<?=$data_paket['id_dummy']?>" class="btn btn-success">Ubah</a>
			    </td>
                
                

            </tr>
            <?php 
            }
            ?>
        </tbody>
    </table>
    
    <div class="">
              <a href="add_dummy.php" class="btn btn-success">add</a>
              <a href="barcode.php" class="btn btn-info">print barcode</a>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>