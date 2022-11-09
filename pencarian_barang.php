
<!DOCTYPE html>
<html>
	<head>
		 <link
		href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x"crossorigin="anonymous">
		 <title>Gudang</title>
	</head>
   
	<body>
    <div class="container">
       
		 <h3>Tampil Barang</h3>

		 <form action="pencarian_barang.php" method="get">
 		<label>Cari :</label>
 		<input type="text" name="cari">
		<input type="submit" value="Cari">
		</form>
		 
		 <table class="table table-hover table-striped">
		 <thead>
		 <tr>
		 <th>NO</th><th>Barang</th><th>stok</th><th>action</th>	
		 </tr>
</thead>
		 <?php 
			include "koneksi.php";           
		?>
        <tbody>
		 <?php 
         
 		if(isset($_GET['cari'])){
 		 $cari = $_GET['cari'];
  		$data = mysqli_query($conn,"select * from barang where nama_barang like '%".$cari."%'");    
 		}else{
  		$data = mysqli_query($conn,"select * from barang");  
 		}
 		$no = 1;
 		while($d = mysqli_fetch_array($data)){
            
 		?>

 		<tr>
  		<td><?php echo $no++; ?></td>
  		<td><?php echo $d['nama_barang']; ?></td>
  		<td><?php echo $d['stok']; ?></td>
		
		<td><a
		href="barang/ubah_barang.php?id_barang=<?=$d['id_barang']?>"
		class="btn btn-success">Ubah</a>  | 

        <a href="barang/hapus_barang.php?id_barang=<?=$d['id_barang']?>"
		onclick="return confirm('Apakah anda yakin menghapus data ini?')" class="btn btn-danger">Hapus</a></td>

		
     </td>
		 </tr>
		 <?php
		 }
		 ?>
        
		 </tbody>
		 </table>
		 <a href="barang/tambah_barang.php"
                    class="btn btn-dark">Tambah Barang</a>
		 <script
		src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"crossorigin="anonymous"></script>
	</body>
</html>